<?php
include '../../conn.php';
// Query to fetch all users from the 'users' table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if any users were found
if ($result->num_rows > 0) {
    $usersData = array();

    // Fetch each user's details and store them in the $usersData array
    while ($row = $result->fetch_assoc()) {
        $usersData[] = $row;
    }

    // Set the "Content-Type" header to specify JSON format
    header('Content-Type: application/json');

    // Convert the $usersData array to JSON format
    $json = json_encode($usersData);

    // Print the JSON data
    echo $json;
} else {
    echo "No users found.";
}

// Close the database conn
$conn->close();
?>