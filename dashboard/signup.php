<?php
// Include the database connection file
require_once '../conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = uniqid();
    
    // Get the user's IP address
    $ipAddress = 'dewd';//$_SERVER['REMOTE_ADDR'];

    // Check if email is already registered
    $checkEmailStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        // Email is already registered
        header('Location: ../dashboard/register.php?msg=email_registered');
        exit();
    }

    // Insert the user into the database with IP address
    $insertStmt = $conn->prepare("INSERT INTO users (name, email, password, username) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("ssss", $name, $email, $password, $username);

    if ($insertStmt->execute()) {
        // Start the session
        session_start();

        // Set session variables
        $_SESSION['id'] = $insertStmt->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;

        // Redirect to the dashboard page
        header('Location: ../dashboard?msg=Account created successfully');
        exit();
    } else {
        echo "Error: " . $insertStmt->error;
    }

    // Close the prepared statements
    $checkEmailStmt->close();
    $insertStmt->close();
}
?>
