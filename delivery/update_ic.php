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
        $newIC = $_POST['newIC'];

        // Update the user's ic_no in the database
        $updateSql = "UPDATE users SET ic_no = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $newIC, $user_id);
        $updateStmt->execute();
        
        // Close the prepared statement
        $updateStmt->close();
    }

    // Fetch user information from the database after the update
    $selectSql = "SELECT ic_no FROM users WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $user_id);
    $selectStmt->execute();
    $selectStmt->bind_result($userIC);
    $selectStmt->fetch();

    // Close the prepared statement and database connection
    $selectStmt->close();
    $conn->close();
    
    // Redirect back to the profile page
    echo '<script>
        alert("Edit IC number Sucessfully... ");
        window.location.href = "neweditprofile.php";
        </script>';
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>