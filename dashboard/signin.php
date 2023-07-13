<?php
// Include the database connection file
require_once '../conn.php';
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User exists, verify password
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        if ($password === $hashedPassword) {
            // Password is correct
            //echo "Sign-in successful!";

            // Set session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];

            // Redirect to the dashboard page
            header('Location: ../dashboard/');
            exit();
        } else {
            // Invalid password
            echo "Invalid email or password";
        }
    } else {
        // User does not exist
        echo "Invalid email or password";
    }

    // Close the prepared statement
    $stmt->close();
}
?>
