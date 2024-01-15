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
    
    
    <h2>Please Keep Safety Ride...</h2>
    <table id="order">
        <thead>
            <tr>
                <th>Delivery ID</th>
                <th>Order ID</th>
                <th>Date and Time</th>
                <th>Customer First Name</th>
                <th>Customer Last Name</th>
                <th>Customer Address</th>
                <th>Customer Phone.No</th>
                <th>Customer Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database = "orderlist";

            $con = mysqli_connect($hostname, $username, $password, $database);

            if (!$con) {
                die("Database Connection Failed: " . mysqli_connect_error());
            }

            // Fetch data 
            $sql = "SELECT delivery_id, OID, date, first_name, last_name, cus_address, cus_hp, cus_email FROM cus_details";
            $result = mysqli_query($con, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['delivery_id']}</td>
                            <td>{$row['OID']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['cus_address']}</td>
                            <td>{$row['cus_hp']}</td>
                            <td>{$row['cus_email']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No orders found</td></tr>";
            }

            // Close the database connection
            mysqli_close($con);
            ?>
        </tbody>
    </table>
    <footer>
    <p>If have any issue in page please visit our contact at Help page. Kindly please do not share your profile.</p>
    </footer>
</body>
</html>
