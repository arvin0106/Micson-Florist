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
    // Sanitize input data to prevent SQL injection
    $uid = mysqli_real_escape_string($con, $_POST['uid']);
    $firstName = mysqli_real_escape_string($con, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($con, $_POST['last_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $companyName = mysqli_real_escape_string($con, $_POST['company_name']);
    $addressLine1 = mysqli_real_escape_string($con, $_POST['shipping_address_line_1']);
    $addressLine2 = mysqli_real_escape_string($con, $_POST['shipping_address_line_2']);
    $countryRegion = mysqli_real_escape_string($con, $_POST['country_region']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
    $remark = mysqli_real_escape_string($con, $_POST['remark']);

    // Update data in the database
    $updateQuery = "UPDATE shipping_details SET 
        FIRST_NAME='$firstName', 
        LAST_NAME='$lastName', 
        EMAIL_ADDRESS='$email', 
        PHONE='$phone', 
        COMPANY_NAME='$companyName', 
        SHIPPING_ADDRESS_LINE_1='$addressLine1', 
        SHIPPING_ADDRESS_LINE_2='$addressLine2', 
        COUNTRY_REGION='$countryRegion', 
        STATE='$state', 
        CITY='$city', 
        POSTCODE='$postcode', 
        REMARK='$remark'
        WHERE UID='$uid'";

    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Data updated successfully
        header("Location: ship.php"); // Redirect to the shipment list page
        exit();
    } else {
        // Handle the error, display a message, or redirect as needed
        echo "Error: " . mysqli_error($con); // Add this line for debugging
    }
} else {
    // Retrieve data for the specified UID
    if (isset($_GET['uid'])) {
        $uid = mysqli_real_escape_string($con, $_GET['uid']);
        $query = "SELECT * FROM shipping_details WHERE UID='$uid'";
        $result = mysqli_query($con, $query);
        $shipmentData = mysqli_fetch_assoc($result);

        if (!$shipmentData) {
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
    <title>Edit Shipment</title>
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
            <span class="nav-item">Edit Shipment</span>
        </a></i>

        <div class="main-table">
            <!-- Add your form for editing the data -->
            <form method="post" action="shipedit.php " style="width: 20%;">
                <!-- Display the existing data for reference -->
                <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $shipmentData['FIRST_NAME']; ?>" required><br>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $shipmentData['LAST_NAME']; ?>" required><br>

                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" value="<?php echo $shipmentData['EMAIL_ADDRESS']; ?>" required><br>

                <label for="phone">Contact Number:</label>
                <input type="text" name="phone" id="phone" value="<?php echo $shipmentData['PHONE']; ?>" required><br>

                <label for="company_name">Company Name:</label>
                <input type="text" name="company_name" id="company_name" value="<?php echo $shipmentData['COMPANY_NAME']; ?>" required><br>

                <label for="shipping_address_line_1">Address Line 1:</label>
                <input type="text" name="shipping_address_line_1" id="shipping_address_line_1" value="<?php echo $shipmentData['SHIPPING_ADDRESS_LINE_1']; ?>" required><br>

                <label for="shipping_address_line_2">Address Line 2:</label>
                <input type="text" name="shipping_address_line_2" id="shipping_address_line_2" value="<?php echo $shipmentData['SHIPPING_ADDRESS_LINE_2']; ?>" required><br>

                <label for="country_region">Country Region:</label>
                <input type="text" name="country_region" id="country_region" value="<?php echo $shipmentData['COUNTRY_REGION']; ?>" required><br>

                <label for="state">State:</label>
                <input type="text" name="state" id="state" value="<?php echo $shipmentData['STATE']; ?>" required><br>

                <label for="city">City:</label>
                <input type="text" name="city" id="city" value="<?php echo $shipmentData['CITY']; ?>" required><br>

                <label for="postcode">Postcode:</label>
                <input type="text" name="postcode" id="postcode" value="<?php echo $shipmentData['POSTCODE']; ?>" required><br>


                <label for="remark">Remark:</label>
                <input type="text" name="remark" id="remark" value="<?php echo $shipmentData['REMARK']; ?>" required><br>

                <!-- Add a hidden field to pass UID for updating the correct record -->
                <input type="hidden" name="uid" value="<?php echo $shipmentData['UID']; ?>"><br>
                </div>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </section>
</div>

<!-- Add your scripts and other body elements here -->
</body>
</html>
