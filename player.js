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
  iframe.setAttribute('height', dp_height);
  iframe.setAttribute('width', dp_width);

  // Get the parent element of the script tag
  const parentElement = document.getElementById('driveplyr'+dp_playerid);

  // Append the iframe to the parent element
  parentElement.appendChild(iframe);

});
