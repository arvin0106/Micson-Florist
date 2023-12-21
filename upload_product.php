<?php
// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error($con));

// Upload product image
$uploadDir = "uploads/"; // Specify your upload directory
$uploadedFile = $_FILES['productImage']['tmp_name'];
$imageFileName = $uploadDir . uniqid() . basename($_FILES['productImage']['name']);

if (move_uploaded_file($uploadedFile, $imageFileName)) {
    // Insert the new product into the database
    $insertQuery = "INSERT INTO products (IMAGE) VALUES ('$imageFileName')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        $response = array("success" => true, "message" => "Product uploaded successfully.");
    } else {
        $response = array("success" => false, "message" => "Error uploading product: " . mysqli_error($con));
    }
} else {
    $response = array("success" => false, "message" => "Error uploading image.");
}

// Close the database connection
mysqli_close($con);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
