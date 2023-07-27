<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'conn.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $email = $_POST['email'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $profilePicture = $_POST['profilePicture'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

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
    } else {
        // User does not exist, insert the data into the 'users' table

        // Set the username based on the email (use email without the domain for all emails except 'xyz@gmail.com')
        $domain = explode('@', $email)[1]; // Get the domain part of the email
        $username = ($domain === 'gmail.com') ? explode('@', $email)[0] : '';

        // Convert the avatar URL to remove the "=s96-c" part
        $profilePicture = preg_replace('/=s\d+-c$/', '', $profilePicture);

        // Insert the data into the 'users' table
        $insertQuery = "INSERT INTO users (name, username, email, avatar, date, ip) VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('sssss', $fullName, $username, $email, $profilePicture, $ip);

        if ($stmt->execute()) {
            // Data insertion successful

            // Set session variables
            $_SESSION['id'] = $stmt->insert_id; // Get the inserted user's ID
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $fullName;

            echo json_encode(array('success' => true, 'message' => 'New user registered and logged in.'));
        } else {
            // Data insertion failed
            echo json_encode(array('success' => false, 'message' => 'Failed to add data to database.'));
        }
    }

    $stmt->close();
} else {
    // Invalid request method
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

$conn->close();
?>
