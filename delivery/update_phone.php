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
        $newPhone = $_POST['newPhone'];

        // Update the user's hp_number in the database
        $updateSql = "UPDATE users SET hp_number = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $newPhone, $user_id);
        $updateStmt->execute();

        // Close the prepared statement
        $updateStmt->close();
    }

    // Fetch user information from the database after the update
    $selectSql = "SELECT hp_number FROM users WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $user_id);
    $selectStmt->execute();
    $selectStmt->bind_result($userPhone);
    $selectStmt->fetch();

    // Close the prepared statement and database connection
    $selectStmt->close();
    $conn->close();
    
    // Redirect back to the profile page
    echo '<script>
        alert("Edit Phone Number Sucessfully... ");
        window.location.href = "neweditprofile.php";
        </script>';
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
