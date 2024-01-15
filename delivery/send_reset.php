<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "orderlist";

    $mysqli = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $email = $_POST["email"];

    // Assuming you have a 'users' table with an 'email' column
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $mail = require __DIR__ . "/mailer.php";

        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
        Click <a href="http://localhost/delivery/reset_forgot_password.php">here</a> 
        to reset your password.
        END;

        try {
            $mail->send();
            
            // Display a JavaScript alert
            echo '<script>alert("Message sent, please check your inbox.");</script>';
        } catch (Exception $e) {
            echo '<script>alert("Message could not be sent. Mailer error: {$mail->ErrorInfo}");</script>';
        }
    } else {
        echo '<script>alert("User not found."); window.location.href = "http://localhost/delivery/forgot_password.php";</script>';
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
