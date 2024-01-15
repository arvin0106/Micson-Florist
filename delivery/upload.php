<?php
// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_shopping_cart";

$con = mysqli_connect($hostname, $username, $password, $database);

if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Check if the file was uploaded without errors
    if (isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] == 0) {
        $target_dir = "uploads/"; // Specify the directory where you want to store the uploaded images
        $target_file = $target_dir . basename($_FILES['uploaded_image']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $target_file)) {
            // Update the database with the file name
            $sql_update = "UPDATE shipping_details SET file_name = '" . basename($_FILES['uploaded_image']['name']) . "' WHERE id = '$id'";
            mysqli_query($con, $sql_update);

            // Close the database connection
            mysqli_close($con);

            // Display the pop-up message using JavaScript and redirect to pageupload.php
            echo '<script>
                    alert("Done Image Upload Sucessfully... \n We sincerely appreciate your invaluable assistance.\n Thank you for your time and expertise.");
                    window.location.href = "newupload.php";
                  </script>';
                  
            exit(); // Terminate the script after displaying the message and redirecting
        }
    }
}

// Close the database connection
mysqli_close($con);
exit();
?>
