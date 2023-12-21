<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM form WHERE reset_token_hash = ?";

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



?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset = "UTF-8">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>

<h1>Reset Password</h1>

<form method="post" action="process-reset-password.php">

<input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

<label for="password">New Password</label>
<input type="password" id="password" name="password">

<label for="password_confirmation">Repeat Password</label>
<input type="password" id="password_confirmation" name="password_confirmation">

<button>Send</button>
</form>

</body>
</html>
