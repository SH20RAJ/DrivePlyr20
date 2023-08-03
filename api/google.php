<?php
// Set headers to allow cross-origin requests
header("Access-Control-Allow-Origin: https://codexdindia.blogspot.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

session_start();
require_once '../conn.php'; // Adjust the path to conn.php based on its location
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data sent from the client-side
    $jsonData = file_get_contents('php://input');

    // Convert the JSON data to an associative array
    $data = json_decode($jsonData, true);

    // Validate data (you should implement proper validation based on your requirements)
    $email = $data['email'] ?? '';
    $fullName = $data['fullName'] ?? '';
    $profilePicture = $data['profilePicture'] ?? '';
}

// Validate data (you should implement proper validation based on your requirements)

// Check if the email exists in the 'users' table
$selectQuery = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    // User with this email already exists, log in the user

    // Set session variables
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['name'] = $user['name'];

    echo json_encode(array('success' => true, 'message' => 'User logged in successfully.'));
    $data['Type'] = 'User Login';
} else {
    // User does not exist, insert the data into the 'users' table

    // Set the username based on the email (use email without the domain for all emails except 'xyz@gmail.com')
    $domain = explode('@', $email)[1]; // Get the domain part of the email
    $username = ($domain === 'gmail.com') ? explode('@', $email)[0] : '';

    // Convert the avatar URL to remove the "=s96-c" part
    $profilePicture = preg_replace('/=s\d+-c$/', '', $profilePicture);
// Insert the data into the 'users' table
$insertQuery = "INSERT INTO users (name, username, email, avatar, date, last_online_date, ip) VALUES (?, ?, ?, ?, NOW(), NOW(), ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param('sssss', $fullName, $username, $email, $profilePicture, $_SERVER['REMOTE_ADDR']); // Using REMOTE_ADDR to get user's IP

    if ($stmt->execute()) {
        // Data insertion successful

        // Set session variables
        $_SESSION['id'] = $stmt->insert_id; // Get the inserted user's ID
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $fullName;

        echo json_encode(array('success' => true, 'message' => 'New user registered and logged in.'));
        $data['Type'] = 'New User Login';
    } else {
        // Data insertion failed
        echo json_encode(array('success' => false, 'message' => 'Failed to add data to database.'));
        $data['Type'] = 'Failed to insert into db';
    }
}
//<?php
// API endpoint URL
$url = 'https://getintotouch.sh20raj.com/api.php?id=1479193538';

// Data to send in the POST request
//$data = array(
 //   'New User Registration on DrivePlyr' => 'sh20raj',
 //   'param2' => 'value2',
    // Add more parameters and their values as needed
//);

// Initialize cURL session
$curl = curl_init();

// Set the cURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and store the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
  //  echo 'cURL Error: ' . curl_error($curl);
}

// Close cURL session
curl_close($curl);

// Output the API response
//echo $response;
//?

$stmt->close();
$conn->close();
?>
