<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data to prevent SQL injection
    $userId = mysqli_real_escape_string($con, $_POST['user_id']);
    $firstName = mysqli_real_escape_string($con, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($con, $_POST['last_name']);
    $emailAddress = mysqli_real_escape_string($con, $_POST['email_address']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phone_number']);
    // Add other fields as needed

    // Update data in the database
    $updateQuery = "UPDATE users SET FIRST_NAME='$firstName', LAST_NAME='$lastName', EMAIL_ADDRESS='$emailAddress', PHONE='$phoneNumber' WHERE ID='$userId'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Data updated successfully
        header("Location: customer.php"); // Redirect to the customer list page
        exit();
    } else {
        // Handle the error, display a message, or redirect as needed
        echo "Error: " . mysqli_error($con); // Add this line for debugging
    }
} else {
    // Retrieve data for the specified ID
    if (isset($_GET['user_id'])) {
        $userId = mysqli_real_escape_string($con, $_GET['user_id']);
        $query = "SELECT * FROM users WHERE ID='$userId'";
        $result = mysqli_query($con, $query);
        $userData = mysqli_fetch_assoc($result);

        if (!$userData) {
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
    <title>Edit Customer</title>
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
            <span class="nav-item">Edit Customer</span>
        </a></i>

        <div class="main-table">
            <!-- Add your form for editing the data -->
            <form method="post" action="customer_edit.php">
                <!-- Display the existing data for reference -->
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $userData['FIRST_NAME']; ?>" required>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $userData['LAST_NAME']; ?>" required>

                <label for="email_address">Email Address:</label>
                <input type="email" name="email_address" id="email_address" value="<?php echo $userData['EMAIL_ADDRESS']; ?>" required>

                <label for="phone_number">Phone Number:</label>
                <input type="tel" name="phone_number" id="phone_number" value="<?php echo $userData['PHONE']; ?>" required>

                <!-- Add other fields with labels and input elements -->

                <!-- Add a hidden field to pass user ID for updating the correct record -->
                <input type="hidden" name="user_id" value="<?php echo $userData['ID']; ?>">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </section>
</div>

<!-- Add your scripts and other body elements here -->
</body>
</html>
