<?php
// Include the database connection file
require_once '../conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert the user into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
              $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
      header('Location : ../dashboard');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>