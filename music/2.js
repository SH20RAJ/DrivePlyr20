const searchInput = document.getElementById('searchInput');
const searchButton = document.getElementById('searchButton');
const playButton = document.getElementById('playButton');
const audioPlayer = document.getElementById('audioPlayer');
const songImage = document.getElementById('songImage');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');
const songSelector = document.getElementById('songSelector');
const bodyTag = document.getElementsByTagName('body')[0];
const progressBar = document.getElementById('progress-bar');
const currentTimeElement = document.getElementById('current-time');
const progressContainer = document.getElementById('progress-area');

let clicked = '' ;
let $ = document.querySelector;
let songs = [];
let currentSongIndex = 0;

const queries = [
    'darshan rawal', 'arijit', 'lofi', 'sad', 'love', 'tseries',
    'b praak', 'sony music', 'zee music', 'jubin', 'vishal mishra', 'armaan malik','honey singh','jalraj','new remix'
];
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

function fetchSongs(query,random,url) {
  url = (url)?url:`https://saavn.me/search/songs?query=${query}&page=1&limit=500`;
  console.log(url)
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'SUCCESS' && data.data && data.data.results) {
              if(random){
                songs = shuffleArray([...songs, ...data.data.results]);
              } else {
                songs = [...songs, ...data.data.results];
              };

              
              updateUI();
            }
        })
        .catch(error => {
            console.error('Error fetching songs:', error);
        });
}

function populateSongSelector() {
    songSelector.innerHTML = '';

    songs.forEach((song, index) => {
        const option = document.createElement('option');
        option.value = index;
        option.text = `${song.name} - ${song.primaryArtists}`;
        songSelector.appendChild(option);
    });
}
function secondsToMinSec(seconds) {
  const mins = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  const formattedTime = `${mins}:${secs < 10 ? '0' : ''}${secs}`;
  return formattedTime;
}
function loadSongDetails(index) {
    const selectedSong = songs[index];
    if (selectedSong) {
        audioPlayer.src = selectedSong.downloadUrl[4].link; // Using 320kbps quality
        audioPlayer.play();
        songImage.src = selectedSong.image[2].link; // Using 500x500 image
      console.log(selectedSong);
      window.currentsong = selectedSong;
      let str = selectedSong.primaryArtists;
      if(str.length > 10) str = str.substring(0,30)
      document.querySelector('#name').innerHTML = selectedSong.name;
       ;
      document.querySelector('#artist').innerHTML = str;
      document.querySelector('#max-duration').innerHTML = secondsToMinSec(selectedSong.duration); 
        // Update download button link
        const downloadButton = document.getElementById('downloadButton');
        downloadButton.onclick = () => downloadAudio(selectedSong);

      document.title = selectedSong.name;
      location.hash=selectedSong.id;

      document.body.style.backgroundImage= `url(${selectedSong.image[2].link})`;
      // Step 2: Blur the background image using CSS
document.body.style.backgroundSize = 'cover';
//document.body.style = 'blur(10px)'; // Adjust the blur intensity as needed
// Step 3: Add a class to remove the filter when scrolling down again


    }
}

function downloadAudio(song) {
  const audioUrl = song.downloadUrl[4].link; // Replace 4 with the appropriate index

  fetch(audioUrl)
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.blob();
    })
    .then((blob) => {
      const reader = new FileReader();
      reader.onload = function () {
        const base64Data = reader.result.split(',')[1]; // Extract the Base64 data

        // Create an anchor element to trigger the download
        const a = document.createElement('a');
        a.href = `data:audio/mp3;base64,${base64Data}`;
        a.download = `${song.name}.mp3`; // Set the desired filename

        // Trigger a click event on the anchor to initiate the download
        a.dispatchEvent(new MouseEvent('click'));

        // Cleanup
        URL.revokeObjectURL(a.href);
      };
      reader.readAsDataURL(blob);
    })
    .catch((error) => {
      console.error('Error downloading audio:', error);
    });
}


function updateUI() {
    loadSongDetails(currentSongIndex);
    songSelector.value = currentSongIndex;

    populateSongList(); // Call the function to populate the song list
}

function populateSongList() {
    const songListContainer = document.getElementById('songList');
    songListContainer.innerHTML = ''; // Clear the container

    songs.forEach((song, index) => {
        const listItem = document.createElement('div');
        listItem.classList.add('song-item');
        listItem.innerHTML = `
        
      <li li-index="1" onclick="clicked(this)">
                <img style="display: inli;border-radius:10px;" height="40" src="${song.image[1].link}" alt="" srcset="">
<div class="row" style="width: 100%;
margin-left: 10px;">

                  <span>${song.name}</span>
                  <p>${song.primaryArtists}</p>
                </div>
                <span id="music-1" class="audio-duration" t-duration="3:36">${secondsToMinSec(song.duration)}</span>

              </li>`;
        listItem.addEventListener('click', () => {
            currentSongIndex = index;
            updateUI();
        });
        songListContainer.appendChild(listItem);
    });
}

// Automatically change song when the user selects a song from the selector
songSelector.addEventListener('change', () => {
    currentSongIndex = parseInt(songSelector.value);
    updateUI();
});

prevButton.addEventListener('click', () => {
    if (currentSongIndex > 0) {
        currentSongIndex--;
        updateUI();
    }
});

playButton.addEventListener('click', () => {
    if (audioPlayer.paused) {
        audioPlayer.play();
      playButton.innerHTML = 'pause';
    } else {
      audioPlayer.pause();
      playButton.innerHTML = 'play_arrow';
    }
});

nextButton.addEventListener('click', () => {
    if (currentSongIndex < songs.length - 1) {
        currentSongIndex++;
        updateUI();
    }
});

// Search button event listener
searchButton.addEventListener('click', () => {
    songs = [];currentSongIndex=0;fetchSongs(searchInput.value.trim());
});

// Update progress bar and time
function updateProgressBarAndTime() {
  const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
  progressBar.style.width = `${progress}%`;

  const minutes = Math.floor(audioPlayer.currentTime / 60);
  const seconds = Math.floor(audioPlayer.currentTime % 60);
  const formattedTime = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
  currentTimeElement.textContent = formattedTime;
}


// Update audio playback when clicking the progress bar
progressContainer.addEventListener('click', (event) => {
  const clickX = event.clientX - progressContainer.getBoundingClientRect().left;
  const percent = (clickX / progressContainer.offsetWidth) * 100;
  const newTime = (percent * audioPlayer.duration) / 100;
  audioPlayer.currentTime = newTime;
});

// Dragging functionality for the progress bar
let isDragging = false;

progressContainer.addEventListener('mousedown', (event) => {
  isDragging = true;
  updateProgress(event);
});

document.addEventListener('mousemove', (event) => {
  if (isDragging) {
    updateProgress(event);
  }
});

document.addEventListener('mouseup', () => {
  if (isDragging) {
    isDragging = false;
  }
});

function updateProgress(event) {
  const clickX = event.clientX - progressContainer.getBoundingClientRect().left;
  const percent = (clickX / progressContainer.offsetWidth) * 100;
  const newTime = (percent * audioPlayer.duration) / 100;
  audioPlayer.currentTime = newTime;
}

// Update progress and time as audio plays
audioPlayer.addEventListener('timeupdate', updateProgressBarAndTime);

// Auto-change song after completion
audioPlayer.addEventListener('ended', () => {
  if(window.looped){
    audioPlayer.looped =1;
    console.log(looped)
    audioPlayer.play()
  } else {
    if (currentSongIndex < songs.length - 1) {
        currentSongIndex++;
        updateUI();
    }
  }
    
});

document.getElementById('looper').addEventListener('click',()=>{
  if(!window.looped){
    window.looped=1;
    document.getElementById('looper').innerHTML = 'repeat_one';
  } else {
    window.looped=0;
    document.getElementById('looper').innerHTML = 'repeat';

  }
    
  })


// Initial fetch
fetchSongs(queries[Math.floor(Math.random() * queries.length)],true);
fetchSongs(queries[Math.floor(Math.random() * queries.length)],1);
fetchSongs(queries[Math.floor(Math.random() * queries.length)],true);
fetchSongs(queries[Math.floor(Math.random() * queries.length)],1);

// Log the complete JSON data
console.log(JSON.stringify(songs, null, 2));

// Store songs in local storage
localStorage.setItem('songs', JSON.stringify(songs));