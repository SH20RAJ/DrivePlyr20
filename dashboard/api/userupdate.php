<?php

include '../../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $avatar = $_POST["avatar"];
    $website= $_POST["website"];
    $description= $_POST["description"];

    $id = $_SESSION['id'];

    // Validate and sanitize the data (you should implement this)

    // Check if the username or email already exist
    $checkQuery = "SELECT id FROM users WHERE (username = ? OR email = ?) AND id <> ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ssi", $username, $email, $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        // Username or email already exist for another user
        echo "Username or email already exists for another user.";
        $checkStmt->close();
        $conn->close();
        exit();
    }

    $checkStmt->close();

    // Update data in the database
    $sql = "UPDATE users SET name=?, username=?, password=?, email=?, avatar=?, description=?, website=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $name, $username, $password, $email, $avatar, $description, $website, $id);
    

    // Assuming you have an 'id' parameter to identify the user to be updated
    // $id = 1; // No need for this line, as we already retrieved the ID from $_GET['id']
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Successful update
        echo "User data updated successfully.";
    } else {
        // Failed to update
        echo "Error updating user data.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
