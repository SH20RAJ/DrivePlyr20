// Get all the script tags with the 'data-type' attribute set to 'driveplyr'
const dp_scriptTags = document.querySelectorAll('script[data-type="driveplyr"]');

// Iterate over each script tag
dp_scriptTags.forEach((scriptTag) => {
  // Get the attributes from the script tag
  const dp_videoID = scriptTag.getAttribute('data-id');
  const dp_playerType = scriptTag.getAttribute('player');
  const dp_height = scriptTag.getAttribute('data-height');
  const dp_width = scriptTag.getAttribute('data-width');
  const dp_playerid = scriptTag.getAttribute('data-id');

  // Create the iframe element
  const iframe = document.createElement('iframe');
  iframe.setAttribute('src', `https://driveplyr.appspages.online/player.html?id=${dp_videoID}&player=${dp_playerType}`);
  iframe.setAttribute('title', 'YouTube video player');
  iframe.setAttribute('frameborder', '0');
  iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
  iframe.setAttribute('allowfullscreen', '');

  // Set width and height attributes with default values if not provided
  iframe.setAttribute('width', dp_width || '560');
  iframe.setAttribute('height', dp_height || '315');

  // Get the parent element of the script tag
  const parentElement = document.getElementById('driveplyr' + dp_playerid);

  // Append the iframe to the parent element
  parentElement.appendChild(iframe);
});
