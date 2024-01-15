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
    $database = "shipping_details";

    $con = mysqli_connect($hostname, $username, $password, $database);

    if (!$con) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }

    // Check if the file was uploaded without errors
    if (isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] == 0) {
        $id = $_POST['id'];
        $target_dir = "uploads/"; // Specify the directory where you want to store the uploaded images
        $target_file = $target_dir . basename($_FILES['uploaded_image']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $target_file)) {
            // Update the database with the file name
            $sql_update = "UPDATE shipping_details SET file_name = '" . basename($_FILES['uploaded_image']['name']) . "' WHERE delivery_id = '$delivery_id'";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Order List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: rgb(255, 255, 128);
            background-image: url('image/moto.jpg');
        }

        header {
            background-color: #333;
            color: white;
            padding: 1em;
            text-align: center;
            width: 100%;
        }

        .dashboard-container {
            display: flex;
            flex: 1;
        }

        nav {
            display: flex;
            flex-direction: column;
            background-color: #2c3e50;
            padding: 1em;
            width: 250px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
            color: white;
            align-items: center;
        }

        nav img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 1em;
        }

        nav a {
            text-decoration: none;
            color: #ecf0f1;
            display: flex;
            align-items: center;
            padding: 1em;
            margin: 0.5em 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #34495e;
        }

        .nav-item {
            margin-left: 10px;
        }

        .logout {
            margin-top: auto;
        }

        .dashboard-body {
            display: flex;
            flex-direction: column;
            padding: 20px;
            flex: 1;
        }

        #order {
            font-family: 'Arial', 'Helvetica', sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #order th, #order td {
            border: 1px solid #ddd;
            padding: 14px;
            text-align: left;
            background-color: #f2f2f2; /* Light grey background for <th> and <td> elements */
        }

        #order th {
            padding-top: 18px;
            padding-bottom: 18px;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        #order tr:nth-child(even) {
            background-color: #f5f7fa; /* Alternating background color for <tr> elements */
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
    <div class="dashboard-container">
    <nav>
            <i>
                <a class="logo3">
                    <img src="image/logo.jpeg" alt="">  
                </a>
            </i>
            <div>
                <h1><?php echo isset($_SESSION['name']) ? 'Hi, ' . $_SESSION['name'] : ''; ?></h1>
            </div>
            <a href="dashboard.php">
                <i class="fas fa-home"></i>
                <span class="nav-item">Home</span>
            </a>
            <a href="neweditprofile.php">
                <i class="fas fa-address-book"></i>
                <span class="nav-item">Edit Profile</span>
            </a>
            <a href="neworderlist.php">
                <i class="fas fa-clipboard-list"></i>
                <span class="nav-item">Delivery Order List</span>
            </a>
            <a href="newupload.php">
                <i class="fas fa-camera"></i>
                <span class="nav-item">Upload Order Image</span>
            </a>
            <a href="newhelp.php">
                <i class="fas fa-handshake"></i>
                <span class="nav-item">Contact Admin Service</span>
            </a>
            <a href="login.php" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Log out</span>
            </a>
    </nav>

        <div class="dashboard-body">
            <header>
                <h1><?php echo $welcomeMessage; ?></h1>
                <h3 id="current-time"></h3>
                <h3 id="battery-status"></h3>
            </header>
            <table id="order">
        <thead>
            <tr>
                <th>Delivery ID</th>
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
                $database = "db_shopping_cart";

                $con = mysqli_connect($hostname, $username, $password, $database);

                if (!$con) {
                    die("Database Connection Failed: " . mysqli_connect_error());
                }

                // Fetch data from the database
                

                $sql = "SELECT id, file_name, pickup_image FROM shipping_details";
$result = mysqli_query($con, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imagePath = "uploads/" . $row['file_name'];
        $pickupImagePath = !empty($row['pickup_image']) ? "uploads/" . $row['pickup_image'] : null;

        echo "<tr>
                <td>{$row['id']}</td>
                <td>
                    <form action='pickup.php' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='id' value='{$row['id']}'>
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
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='file' name='uploaded_image' accept='image/*'>
                        <input type='submit' value='Done'>
                    </form>
                </td>
                <td><img src='{$imagePath}' alt='Not Yet Done' class='thumbnail'></td>
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

            <!-- Add any additional content or elements as needed -->
        </div>
    </div>
    <script>
    // Current time display using JavaScript
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        timeElement.innerHTML = `Your Placing Time: ${now.toLocaleTimeString()}`;
    }

    // Battery status display using JavaScript
    function updateBatteryStatus() {
        navigator.getBattery().then(battery => {
            const batteryElement = document.getElementById('battery-status');
            batteryElement.innerHTML = `Battery Level: ${(battery.level * 100).toFixed(2)}%`;
        });
    }

    // Update time and battery status every second
    setInterval(() => {
        updateTime();
        updateBatteryStatus();
    }, 1000);

    // Initialize battery status on page load
    updateBatteryStatus();
</script>
</body>
</html>
