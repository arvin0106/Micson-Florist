<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database configuration
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "orderlist";

        // Create a database connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle file upload
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
            $target_dir = "uploads/";  // Change this to the desired directory
            $target_file = $target_dir . basename($_FILES['profilePicture']['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            $validExtensions = array("jpg", "jpeg", "png", "gif");
            if (in_array($imageFileType, $validExtensions)) {
                // Move the uploaded file to the specified directory
                move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_file);

                // Store the result of basename($target_file) in a variable
                $filename = basename($target_file);

                // Update the user's profile picture in the database with only the filename
                $updateQuery = "UPDATE users SET profile_picture = ? WHERE id = ?";
                $stmtUpdate = $conn->prepare($updateQuery);
                $stmtUpdate->bind_param("ss", $filename, $user_id);
                $stmtUpdate->execute();

                // Close the prepared statement
                $stmtUpdate->close();
            }
        }

        // Close the database connection
        $conn->close();
    }

    // Redirect back to the profile page
    header("Location: neweditprofile.php");
    exit();
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
