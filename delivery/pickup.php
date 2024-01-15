<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "db_shopping_cart";

    $con = mysqli_connect($hostname, $username, $password, $database);

    if (!$con) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }

    // Get delivery_id from the form
    $id = $_POST['id'];

    // Check if the pickup image file was uploaded without errors
    if (isset($_FILES['pickup_image']) && $_FILES['pickup_image']['error'] == 0) {
        $target_dir = "uploads/"; // Specify the directory where you want to store the uploaded pickup images
        $target_file = $target_dir . basename($_FILES['pickup_image']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['pickup_image']['tmp_name'], $target_file)) {
            // Update the database with the pickup image file name
            $sql_update = "UPDATE shipping_details SET pickup_image = '" . basename($_FILES['pickup_image']['name']) . "' WHERE id = '$id'";
            mysqli_query($con, $sql_update);

            // Close the database connection
            mysqli_close($con);

            // Redirect back to the original page or display a success message
            echo '<script>
                    alert("Pick-Up Image Upload Sucessfully... \n Please Keep Safety Ride");
                    window.location.href = "newupload.php";
                  </script>';
            exit();
        }
    }
} else {
    
    exit();
}
?>
