<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['adminID'])) {
    header("Location: loginadmin.php");
    exit();
}

// Retrieve user information from the session
$adminID = $_SESSION['adminID'];

// If the 'username' key is not set in the session, fetch it from the database
if (!isset($_SESSION['username'])) {
    // Fetch username from the database based on the user ID
    $result = mysqli_query($db, "SELECT username FROM admin WHERE adminID = $adminID");

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $_SESSION['username'] = $row['username'];
        } else {
            // Handle database fetch error
            echo "Error fetching username from the database.";
            exit();
        }
    } else {
        // Handle query execution error
        echo "Error: " . mysqli_error($db);
        exit();
    }
}
// Retrieve user information if needed
$username = $_SESSION['username'];
$adminID = $_SESSION['adminID'];
$name = $_SESSION['name'];


?>
