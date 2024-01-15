<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if product ID is set in the query string
if (!isset($_GET['uid'])) {
    // Redirect to product.php if product ID is not provided
    header("Location: product.php");
    exit();
}

// Retrieve admin name from session
$adminName = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

// Fetch product data based on the provided PID
$productId = mysqli_real_escape_string($con, $_GET['uid']);
$query = "SELECT * FROM products WHERE PID = '$productId'";
$result = mysqli_query($con, $query);

// Check if the product exists
if (mysqli_num_rows($result) == 0) {
    // Redirect to product.php if the product is not found
    header("Location: product.php");
    exit();
}

// Fetch product details
$productData = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Include any additional stylesheets or scripts as needed -->
</head>

<body>

    <div class="container">
        <!-- Header and Navigation code goes here -->

        <section class="main">
            <h1>Edit Product</h1>
            <form action="update_product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="productId" value="<?php echo $productData['PID']; ?>" />

                <!-- Display the previous image -->
                <label>Previous Image:</label></br>
                <img src="images/<?php echo $productData['IMAGE']; ?>" alt="Previous Image" style="width: 100px; height: 100px;"></br></br>
                
                <!-- Allow the user to upload a new image -->
                <label for="productImage">New Image:</label></br>
                <input type="file" id="productImage" name="productImage" accept="image/*" /></br></br>

                <label for="productName">Product Name:</label></br>
                <input type="text" id="productName" name="productName" value="<?php echo $productData['PRODUCT']; ?>" required /></br></br>

                <label for="productPrice">Product Price:</label></br>
                <input type="text" id="productPrice" name="productPrice" value="<?php echo $productData['PRICE']; ?>" required /></br></br>

                <label for="productDescription">Product Description:</label></br>
                <textarea id="productDescription" name="productDescription" required><?php echo $productData['DESCRIPTION']; ?></textarea></br></br>

                <!-- Add more fields as needed for other product attributes -->

                <button type="submit">Save Changes</button>
            </form>
        </section>
    </div>

    <!-- Include any additional scripts as needed -->

</body>

</html>
