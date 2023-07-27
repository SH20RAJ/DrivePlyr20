<!DOCTYPE html>
<html>
<head>
  <title>Google Login Form</title>
</head>
<body>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <div id="g_id_onload"
       data-client_id="911384899570-6qiojk3cl3e47jjorfj9att0l1a8gg59.apps.googleusercontent.com"
       data-callback="handleCredentialResponse">
  </div>
  <div class="g_id_signin" data-type="standard"></div>

  <script>
    function handleCredentialResponse(response) {
      if (response.credential) {
        const credential = response.credential;
        const jwtToken = credential;

        // Decode and parse the JWT token to access user details
        const userTokenData = JSON.parse(atob(jwtToken.split('.')[1]));

        console.log(userTokenData)
        // Check if the required user details are available
        if (userTokenData.email && userTokenData.name) {
          const email = userTokenData.email;
          const fullName = userTokenData.name;
          const profilePicture = userTokenData.picture;

          // Log user details to the console
          console.log('Email: ' + email);
          console.log('Full Name: ' + fullName);
          console.log('Profile Picture: ' + profilePicture);
          // Perform further actions with the user details as needed
          // Now, let's post the data to the server using fetch
          const url = 'api/google.php'; // Replace this with the correct endpoint URL
          const data = {
            email: email,
            fullName: fullName,
            profilePicture: profilePicture
          };

          fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          })
          .then(response => response.json())
          .then(data => {
            // Handle the response from the server if needed
            console.log('Server Response:', data);
          })
          .catch(error => {
            console.error('Error posting data:', error);
          });
        } else {
          console.log('User details not available in the token.');
        }
      } else {
        // Handle the case where no credential is received or the user cancels the sign-in
        console.log('No credential received or user canceled the sign-in.');
      }
    }
  </script>
</body>
</html>
