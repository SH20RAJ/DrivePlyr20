<?php
session_start();
include '../../conn.php';

// Function to sanitize input data to prevent SQL injection
function sanitize_input($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// Check if the form is submitted and update user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $preRollURL = sanitize_input($_POST['pre_roll_url']);
    $midRollURL = sanitize_input($_POST['mid_roll_url']);
    $postRollURL = sanitize_input($_POST['post_roll_url']);
    $pauseRollURL = sanitize_input($_POST['pause_roll_url']);

    // Update the data in the users table (assuming you have a primary key, such as user_id)
    $user_id = $_SESSION['id']; // Replace 'id' with the actual session key storing the user_id
    $sql = "UPDATE users SET 
                pre_roll_url = '$preRollURL', 
                mid_roll_url = '$midRollURL', 
                post_roll_url = '$postRollURL', 
                pause_roll_url = '$pauseRollURL' 
            WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Data updated successfully
        echo "URLs updated successfully";
    } else {
        // Error occurred while updating data
        echo "Error updating URLs: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
