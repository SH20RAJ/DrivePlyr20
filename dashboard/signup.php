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

    // Check if email is already registered
    $checkEmailStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        // Email is already registered
        header('Location: ../?msg=email_registered');
        exit();
    }

    // Insert the user into the database
    $insertStmt = $conn->prepare("INSERT INTO users (name, email, password, username) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("ssss", $name, $email, $password, $username);

    if ($insertStmt->execute()) {
        // Start the session
        session_start();

        // Set session variables
        $_SESSION['user_id'] = $insertStmt->insert_id;
        $_SESSION['username'] = $username;

        // Redirect to the dashboard page
        header('Location: ../dashboard');
        exit();
    } else {
        echo "Error: " . $insertStmt->error;
    }

    // Close the prepared statements
    $checkEmailStmt->close();
    $insertStmt->close();
}
?>