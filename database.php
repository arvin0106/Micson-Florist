<?php

$mysqli = new mysqli("localhost", "root", "", "register");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

return $mysqli;
?>
