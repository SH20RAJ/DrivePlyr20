// Function to fetch and add new data
function fetchAndAddData() {
    fetch('https://driveplyr.appspages.online/api/feeds.php')
      .then((response) => response.text())
      .then((data) => {
        // Append the new data to the 'vdc' element
        document.getElementById('vdc').insertAdjacentHTML('beforeend', data);
      })
      .catch((error) => {
        console.error('Error fetching data:', error);
      });
  }
  
  // Function to check if the user has scrolled to the bottom of the page
  function isBottomReached() {
    const scrollY = window.scrollY || window.pageYOffset;
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;
    
    // Adjust this value to control when to load more data, for example, 100 pixels from the bottom
    const threshold = 100;
    
    return scrollY + windowHeight >= documentHeight - threshold;
  }
  
  // Add a scroll event listener
  window.addEventListener('scroll', () => {
    if (isBottomReached()) {
      fetchAndAddData();
    }
  });
  
  // Initial data load
  fetchAndAddData();
  