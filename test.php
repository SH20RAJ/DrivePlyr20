<?php
// Online PHP compiler to run PHP program online
// Print "Hello World!" message

$id='1';
    // Use the $id parameter in the API URL
    $api_url = 'https://driveplyr.appspages.online/dashboard/api/user.php?id=' . $id;
    
    // Fetch the API response as a JSON string
     $api_response = file_get_contents($api_url);

print_r($api_response);


?>
