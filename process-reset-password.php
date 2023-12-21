<?php

$token = $_POST["token"];
$password = $_POST["password"];
$password_confirmation = $_POST["password_confirmation"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM form
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

if (strlen($password) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $password)) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $password)) {
    die("Password must contain at least one number");
}

if ($password !== $password_confirmation) {
    die("Passwords must match");
}

// Update password without using password hash (not recommended)

$sql = "UPDATE form
        SET password_plain = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("si", $password, $user["id"]);

$stmt->execute();

echo "Password updated. You can now login.";
?>
