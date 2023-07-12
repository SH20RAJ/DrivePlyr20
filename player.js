// Get all the script tags with the 'data-type' attribute set to 'driveplyr'
const scriptTags = document.querySelectorAll('script[data-type="driveplyr"]');

// Iterate over each script tag
scriptTags.forEach((scriptTag) => {
  // Get the attributes from the script tag
  const videoID = scriptTag.getAttribute('data-id');
  const playerType = scriptTag.getAttribute('player');
  const height = scriptTag.getAttribute('data-height');
  const width = scriptTag.getAttribute('data-width');

  // Create the iframe element
  const iframe = document.createElement('iframe');
  iframe.setAttribute('src', `https://driveplyr.appspages.online/player.html?id=${videoID}&player=${playerType}`);
  iframe.setAttribute('height', height);
  iframe.setAttribute('width', width);

  // Get the parent element of the script tag
  const parentElement = scriptTag.parentNode;

  // Append the iframe to the parent element
  parentElement.appendChild(iframe);

  // Remove the script tag
  parentElement.removeChild(scriptTag);
});
