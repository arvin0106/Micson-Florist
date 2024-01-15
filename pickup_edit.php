<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form submitted";

    // Sanitize input data to prevent SQL injection
    $uid = mysqli_real_escape_string($con, $_POST['uid']);
    $firstName = mysqli_real_escape_string($con, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($con, $_POST['last_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $remark = mysqli_real_escape_string($con, $_POST['remark']);

    // Update data in the database
    $updateQuery = "UPDATE pickup_detail SET FIRST_NAME='$firstName', LAST_NAME='$lastName', EMAIL_ADDRESS='$email', PHONE='$phone', REMARK='$remark' WHERE UID='$uid'";
    $updateResult = mysqli_query($con, $updateQuery);

    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Data updated successfully
        header("Location: arvinpickup.php"); // Redirect to the pickup list page
        exit();
    } else {
        // Handle the error, display a message, or redirect as needed
        echo "Error: " . mysqli_error($con); // Add this line for debugging
    }
} else {
    // Retrieve data for the specified UID
    if (isset($_GET['uid'])) {
        $uid = mysqli_real_escape_string($con, $_GET['uid']);
        $query = "SELECT * FROM pickup_detail WHERE UID='$uid'";
        $result = mysqli_query($con, $query);
        $pickupData = mysqli_fetch_assoc($result);

        if (!$pickupData) {
            // Handle error, redirect, or show a message
        }
    } else {
        // Handle error, redirect, or show a message
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pick Up</title>
    <!-- Add your stylesheets and other head elements here -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>

<div class="container">
    <!-- ... Your existing navigation code ... -->

    <section class="main">
        <i><a class="logo">
            <img src="logo.jpeg" alt="">
            <span class="nav-item">Edit Pick Up</span>
        </a></i>

        <div class="main-table">
            <!-- Add your form for editing the data -->
            <form method="post" action="pickup_edit.php">
                <!-- Display the existing data for reference -->
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $pickupData['FIRST_NAME']; ?>" required>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $pickupData['LAST_NAME']; ?>" required>

                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" value="<?php echo $pickupData['EMAIL_ADDRESS']; ?>" required>

                <label for="phone">Contact Number:</label>
                <input type="text" name="phone" id="phone" value="<?php echo $pickupData['PHONE']; ?>" required>

                <label for="remark">Remark:</label>
                <input type="text" name="remark" id="remark" value="<?php echo $pickupData['REMARK']; ?>" required>

                <!-- Add a hidden field to pass UID for updating the correct record -->
                <input type="hidden" name="uid" value="<?php echo $pickupData['UID']; ?>">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </section>
</div>

<!-- Add your scripts and other body elements here -->
</body>
</html>
