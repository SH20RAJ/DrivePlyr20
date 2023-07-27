<?php
session_start();
require_once '../conn.php'; // Adjust the path to conn.php based on its location

// Sample data for testing
$email = 'test@example.com';
$fullName = 'John Doe';
$profilePicture = 'https://example.com/avatar.jpg';

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
    } else {
        // Data insertion failed
        echo json_encode(array('success' => false, 'message' => 'Failed to add data to database.'));
    }
}

$stmt->close();
$conn->close();
?>
