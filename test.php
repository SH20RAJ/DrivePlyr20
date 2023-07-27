<!DOCTYPE html>
<html>
<head>
    <title>Google Login Form</title>
</head>
<body>
    <h1>Google Login Form</h1>
    <div id="google-login-button"></div>
    <script>
        // Replace YOUR_CLIENT_ID with your actual Google OAuth client ID
        const CLIENT_ID = '911384899570-6qiojk3cl3e47jjorfj9att0l1a8gg59.apps.googleusercontent.com';
        
        // Load the Google API client library
        function loadGoogleApiClient() {
            const script = document.createElement('script');
            script.src = 'https://apis.google.com/js/api.js';
            script.onload = initializeGoogleLogin;
            document.head.appendChild(script);
        }

        // Initialize the Google Sign-In client
        function initializeGoogleLogin() {
            gapi.load('auth2', () => {
                gapi.auth2.init({
                    client_id: CLIENT_ID
                }).then(() => {
                    renderGoogleLoginButton();
                });
            });
        }

        // Render the Google login button
        function renderGoogleLoginButton() {
            gapi.signin2.render('google-login-button', {
                'scope': 'profile email',
                'width': 240,
                'height': 50,
                'longtitle': true,
                'theme': 'light',
                'onsuccess': onGoogleLoginSuccess,
                'onfailure': onGoogleLoginFailure
            });
        }

        // Callback function when Google login is successful
        function onGoogleLoginSuccess(googleUser) {
            const profile = googleUser.getBasicProfile();
            console.log('Logged in as: ' + profile.getName());
            console.log('Email: ' + profile.getEmail());
            // You can perform further actions here, like sending the user info to the server.
        }

        // Callback function when Google login fails
        function onGoogleLoginFailure(error) {
            console.log('Google login failed:', error);
        }

        // Load the Google API client library when the page loads
        window.onload = loadGoogleApiClient;
    </script>
</body>
</html>
