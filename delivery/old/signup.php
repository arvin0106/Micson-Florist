<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "orderlist";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data and perform basic validation
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
$password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';

// Validate the data (add more validation as needed)
if (empty($name) || empty($email) || empty($password)) {
    die("Please fill in all the fields");
}

// Hash the password for security
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Prepare and execute the SQL statement using prepared statements
$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $passwordHash);

if ($stmt->execute()) {
    echo "User registered successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
