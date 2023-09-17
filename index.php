<?php
session_start();

// Check if the user is logged in (session is set)
$isLoggedIn = isset($_SESSION['username']);
include 'func.php';
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <!-- Material Icons -->
    <noscript type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64bd1f4e71afd40013e96b95&product=sop' async='async'></noscript>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="https://bluredcodes.github.io/video556/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bluredcodes.github.io/video556/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://bluredcodes.github.io/video556/css/templatemo-style.css">
    <title>DrivePlyr</title>
    <style>

    </style>
<meta name="theme-color" content="#007bff">
<link rel="manifest" href="mainfest.json">
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-film mr-2"></i>
                DrivePlyr
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1 active" aria-current="page" href="music">Music</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="videos.html">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-3" href="../tos.php">About & DMCA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-4" href="mailto:mail@appspages.online">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
        <form class="d-flex tm-search-form" action="search.php">
            <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success tm-search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Videos & Posts
            </h2>
            <!-- <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
                </form>
            </div> -->
        </div>
        <div class="row tm-mb-90 tm-gallery" id="VideoList">
        	<!-- <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-03.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Clocks</h2>
                        <a href="photo-detail.html">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">18 Oct 2020</span>
                    <span>9,906 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-04.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Plants</h2>
                        <a href="photo-detail.html">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">14 Oct 2020</span>
                    <span>16,100 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-05.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Morning</h2>
                        <a href="photo-detail.html">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>12,460 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-06.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Pinky</h2>
                        <a href="photo-detail.html">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">10 Oct 2020</span>
                    <span>11,402 views</span>
                </div>
            </div>         -->
        </div> <!-- row -->
        <div class="row tm-mb-90">
            <div class="center col-12 d-flex justify-content-center align-items-center tm-paging-col">
                
                
                <a href="javascript:void(0);" onclick="fetchdata()" class="btn btn-primary tm-btn-next">Load More</a>
            </div>            
        </div>
    </div> <!-- container-fluid, tm-container-content -->

    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About DrivePlyr</h3>
                    <p>DrivePlyr is a video sharing platform that allows users to upload, share, and view videos.</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">Our Links</h3>
                    <ul class="tm-footer-links pl-0">
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Our Company</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
                        <li class="mb-2"><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                        <li class="mb-2"><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li class="mb-2"><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li class="mb-2"><a href="https://pinterest.com"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                    <a href="#" class="tm-text-gray text-right d-block mb-2">Terms of Use</a>
                    <a href="#" class="tm-text-gray text-right d-block">Privacy Policy</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
                    Copyright 2020 DrivePlyr Company. All rights reserved.
                </div>
                <div class="col-lg-4 col-md-5 col-12 px-5 text-right">
                    Designed by <a href="https://yotube.com/cxdiin" class="tm-text-gray" rel="sponsored" target="_parent">❤️</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

    <div class="row" id="videoList">
        <!-- Video items will be added here -->
    </div>

    <script>

        function convertToRelativeTime(dateString) {
            // Convert the date string to a Unix timestamp
            const timestamp = new Date(dateString).getTime();
        
            // Get the current timestamp
            const now = Date.now();
        
            // Calculate the time difference in milliseconds
            const diff = now - timestamp;
        
            // Define time intervals in milliseconds
            const minute = 60 * 1000;
            const hour = 60 * minute;
            const day = 24 * hour;
            const week = 7 * day;
            const month = 30 * day;
            const year = 365 * day;
        
            // Format the relative time string based on the time difference
            if (diff < minute) {
                return "Just now";
            } else if (diff < hour) {
                const minutes = Math.floor(diff / minute);
                return minutes + " minute" + (minutes > 1 ? "s" : "") + " ago";
            } else if (diff < day) {
                const hours = Math.floor(diff / hour);
                return hours + " hour" + (hours > 1 ? "s" : "") + " ago";
            } else if (diff < week) {
                const days = Math.floor(diff / day);
                return days + " day" + (days > 1 ? "s" : "") + " ago";
            } else if (diff < month) {
                const weeks = Math.floor(diff / week);
                return weeks + " week" + (weeks > 1 ? "s" : "") + " ago";
            } else if (diff < year) {
                const months = Math.floor(diff / month);
                return months + " month" + (months > 1 ? "s" : "") + " ago";
            } else {
                const years = Math.floor(diff / year);
                return years + " year" + (years > 1 ? "s" : "") + " ago";
            }
        }
        
        function formatViewsCount(views) {
            const suffixes = ['', 'k', 'M', 'B', 'T'];
            let suffixIndex = 0;
        
            while (views >= 1000 && suffixIndex < suffixes.length - 1) {
                views /= 1000;
                suffixIndex++;
            }
        
            // Format the views count to have at most one decimal point
            const formattedViews = views.toFixed(suffixIndex > 0 ? 1 : 0);
        
            // Append the appropriate suffix
            return formattedViews + suffixes[suffixIndex];
        }

        function fetchdata(url,limit){
            if(!limit)limit=`40`;
            if(!url)url = 'https://driveplyr.appspages.online/api/videos.php?limit=' + limit + '?fvgywevfgubg3w';
        // Fetch JSON data from the URL
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const videoList = document.getElementById('VideoList');

                // Iterate over the JSON data and create HTML elements for each video
                data.forEach(video => {
                    const videoItem = document.createElement('div');
                    videoItem.className = 'col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5';
                    if(!video.poster_url)video.poster_url = 'https://cdn.statically.io/og/theme=dark/'+video.title+'.png';
                    videoItem.innerHTML = `
                        <figure class="effect-ming tm-video-item">
                            <img style="height:222px" src="${video.poster_url}" alt="Image" class="img-fluid">
                            <figcaption class="d-flex align-items-center justify-content-center">
                                <h2>${video.title}</h2>
                                <a href="watch/${video.id}">View more</a>
                            </figcaption>                    
                        </figure>
                        <div class="d-flex justify-content-between tm-text-gray">
                            <span>${video.title} Views</span>
                            <span class="tm-text-gray-light">${convertToRelativeTime(video.date)}</span>
                            <span>${video.views} Views</span>
                        </div>
                    `;

                    videoList.appendChild(videoItem);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            }); 
        }

        fetchdata();
       
    </script>
</body>
</html>