<?php

function crawl_website($url, $limit) {
    $urls = [$url];
    $visitedUrls = [];

    while (!empty($urls) && $limit > 0) {
        $currentUrl = array_shift($urls);
        $visitedUrls[] = $currentUrl;

        $html = file_get_contents($currentUrl);
        $dom = new DOMDocument;
        libxml_use_internal_errors(true); // Ignore HTML parsing errors
        $dom->loadHTML($html);
        libxml_clear_errors();

        $links = $dom->getElementsByTagName('a');
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if (strpos($href, 'http') !== false) {
                $urls[] = $href;
            } elseif (strpos($href, '/') === 0) {
                $urls[] = $url . $href;
            }
        }

        $urls = array_unique($urls);
        $urls = array_diff($urls, $visitedUrls);

        $limit--;
    }

    return $visitedUrls;
}

function generate_sitemap($url, $limit) {
    $urls = crawl_website($url, $limit);

    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

    foreach ($urls as $url) {
        $urlElement = $xml->addChild('url');
        $urlElement->addChild('loc', htmlspecialchars($url));
        $urlElement->addChild('lastmod', date('Y-m-d'));
    }

    $sitemapContent = $xml->asXML();
    
    // Set appropriate headers for file download
    header('Content-Disposition: attachment; filename="sitemap.xml"');
    header('Content-Type: application/xml');
    header('Content-Length: ' . strlen($sitemapContent));
    
    // Output the sitemap content
    echo $sitemapContent;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $websiteUrl = $_POST['website_url'];
    $limit = intval($_POST['limit']);
    generate_sitemap($websiteUrl, $limit);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sitemap Generator</title>
</head>
<body>
    <h1>Sitemap Generator</h1>
    <p>Enter the website URL and limit of URLs to crawl.</p>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="website_url" placeholder="Website URL" required>
        <input type="number" name="limit" placeholder="Limit of URLs" required>
        <button type="submit">Generate Sitemap</button>
    </form>

    <?php
    // Show live crawling display
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $websiteUrl = $_POST['website_url'];
        $limit = intval($_POST['limit']);
        $visitedUrls = crawl_website($websiteUrl, $limit);
        ?>
        <h2>Live Crawling Display</h2>
        <ul>
            <?php foreach ($visitedUrls as $url) : ?>
                <li><?php echo htmlspecialchars($url); ?></li>
            <?php endforeach; ?>
        </ul>

        <?php if (!empty($visitedUrls)) : ?>
            <a href="sitemap.xml" download>Download Sitemap</a>
        <?php endif; ?>
    <?php } ?>
</body>
</html>
