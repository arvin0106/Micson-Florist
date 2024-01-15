<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "orderlist";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // input from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // data from the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //check password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, login the user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            // go welcome page
            header("Location: dashboard.php");
            exit(); 
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
    $conn->close();
}
?>
