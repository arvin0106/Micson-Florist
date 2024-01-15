<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

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

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['newName'];

        // Update the user's name in the database
        $updateSql = "UPDATE users SET name = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $newName, $user_id);
        $updateStmt->execute();

        // Close the prepared statement
        $updateStmt->close();
    }

    // Fetch user information from the database after the update
    $selectSql = "SELECT name FROM users WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $user_id);
    $selectStmt->execute();
    $selectStmt->bind_result($userName);
    $selectStmt->fetch();

    // Close the prepared statement and database connection
    $selectStmt->close();
    $conn->close();
    
    // Redirect back to the profile page
    echo '<script>
        alert("Edit Profile Name Sucessfully... ");
        window.location.href = "neweditprofile.php";
        </script>';
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
