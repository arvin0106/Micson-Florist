<?php
session_start();

// Check if the session is set
if (isset($_SESSION['name'])) {
    $welcomeMessage = "Welcome Back, " . $_SESSION['name'] . "";
} else {
    // Redirect to the login page if the session is not initialized
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "orderlist";

    $con = mysqli_connect($hostname, $username, $password, $database);

    if (!$con) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }

    // Check if the file was uploaded without errors
    if (isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] == 0) {
        $delivery_id = $_POST['delivery_id'];
        $target_dir = "uploads/"; // Specify the directory where you want to store the uploaded images
        $target_file = $target_dir . basename($_FILES['uploaded_image']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $target_file)) {
            // Update the database with the file name
            $sql_update = "UPDATE cus_details SET file_name = '" . basename($_FILES['uploaded_image']['name']) . "' WHERE delivery_id = '$delivery_id'";
            mysqli_query($con, $sql_update);

            // Close the database connection
            mysqli_close($con);

            // Display the pop-up message using JavaScript
            echo '<script>alert("Upload successful! Please refresh the page.");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delivery Page</title>
    <style>
        #order {
            font-family: 'Arial', 'Helvetica', sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #order td, #order th {
            border: 1px solid #ddd;
            padding: 14px;
            text-align: left;
        }

        #order th {
            padding-top: 18px;
            padding-bottom: 18px;
            background-color: #2c3e50; 
            color: #ecf0f1; 
        }

        #order tr:nth-child(even) {
            background-color: #f5f7fa;
        }

        #order tr:hover {
            background-color: #dcdde1;
        }

        .thumbnail {
            max-width: 100px; /* Adjust the maximum width of the thumbnail */
            max-height: 100px; /* Adjust the maximum height of the thumbnail */
        }
    </style>
</head>
<body>
    <link rel="stylesheet" href="hfer.css">
    <header>
        <h1><?php echo $welcomeMessage; ?></h1>
        <form action="logout.php" method="post">
            <button class="button-89" role="button">Logout</button>
        </form>
    </header>
    <nav>
        <a href="pageprofile.php">Profile</a>
        <a href="pageorderlist.php">Order List</a>
        <a href="pageupload.php">Image Complete</a>
        <a href="pagehelp.php">Help</a>
    </nav>
    
    
    <table id="order">
        <thead>
            <tr>
                <th>Delivery ID</th>
                <th>Order ID</th>
                <th>Upload Pick Image</td>
                <th>Pick Image</td>
                <th>Upload Done Image</th>
                <th>Done Image</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                // Database connection
                $hostname = "localhost";
                $username = "root";
                $password = "";
                $database = "orderlist";

                $con = mysqli_connect($hostname, $username, $password, $database);

                if (!$con) {
                    die("Database Connection Failed: " . mysqli_connect_error());
                }

                // Fetch data from the database
                

                $sql = "SELECT delivery_id, OID, date, file_name, pickup_image FROM cus_details";
$result = mysqli_query($con, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imagePath = "uploads/" . $row['file_name'];
        $pickupImagePath = !empty($row['pickup_image']) ? "uploads/" . $row['pickup_image'] : null;

        echo "<tr>
                <td>{$row['delivery_id']}</td>
                <td>{$row['OID']}</td>
                <td>
                    <form action='pickup.php' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='delivery_id' value='{$row['delivery_id']}'>
                        <input type='file' name='pickup_image' accept='image/*'>
                        <input type='submit' value='Pickup Image'>
                    </form>
                </td>
                <td>";

        // Check if there is a pickup image for the current row
        if (!empty($pickupImagePath)) {
            echo "<img src='{$pickupImagePath}' alt='Pickup Image' class='thumbnail'>";
        } else {
            echo "No Pickup Image";
        }

        echo "</td>
                <td>
                    <form action='upload.php' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='delivery_id' value='{$row['delivery_id']}'>
                        <input type='file' name='uploaded_image' accept='image/*'>
                        <input type='submit' value='Done'>
                    </form>
                </td>
                <td><img src='{$imagePath}' alt='Image' class='thumbnail'></td>
              </tr>";

        
    }
} else {
    echo "<tr><td colspan='10'>No orders found</td></tr>";
}

                // Close the database connection
                mysqli_close($con);
            ?>
        </tbody>
    </table>
<footer>
        <p>If you have any issue on the page, please visit our contact at the Help page. Kindly please do not share your profile.</p>
    </footer>
</body>
</html>
