<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $welcomeMessage = "Welcome Back, " . $_SESSION['name'];
    $user_id = $_SESSION['user_id'];

    // Database configuration
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "orderlist";

    // Create a database connection
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $sqlProfilePicture = "SELECT profile_picture FROM users WHERE id = ?";
    $stmtProfilePicture = $conn->prepare($sqlProfilePicture);
    $stmtProfilePicture->bind_param("i", $user_id);
    $stmtProfilePicture->execute();
    $stmtProfilePicture->store_result();

    if ($stmtProfilePicture->num_rows > 0) {
        $stmtProfilePicture->bind_result($profilePicture);
        $stmtProfilePicture->fetch();
    } else {
            // Handle the case when profile picture information is not found
            $profilePicture = "default.jpg"; // Provide a default image path or handle accordingly
        }

        // Close the prepared statement for profile picture
        $stmtProfilePicture->close();
    
    // lisen pic
    $sqlLicensePicture = "SELECT license_pic FROM users WHERE id = ?";
    $stmtLicensePicture = $conn->prepare($sqlLicensePicture);
    $stmtLicensePicture->bind_param("i", $user_id);
    $stmtLicensePicture->execute();
    $stmtLicensePicture->store_result();

    if ($stmtLicensePicture->num_rows > 0) {
        $stmtLicensePicture->bind_result($licensePicture);
        $stmtLicensePicture->fetch();
    } else {
        // Handle the case when license picture information is not found
        $licensePicture = "default_license.jpg"; // Provide a default image path or handle accordingly
    }

    // Close the prepared statement for license picture
    $stmtLicensePicture->close();
    // end of lisen pic


    // Fetch user information from the database using prepared statement for name
    $sqlName = "SELECT name FROM users WHERE id = ?";
    $stmtName = $conn->prepare($sqlName);
    $stmtName->bind_param("i", $user_id);
    $stmtName->execute();
    $stmtName->store_result();

    if ($stmtName->num_rows > 0) {
        $stmtName->bind_result($userName);
        $stmtName->fetch();
    } else {
        // Handle the case when user information is not found
        $userName = "User Not Found";
    }

    // Close the prepared statement for name
    $stmtName->close();

    // Fetch user information from the database using prepared statement for ic_no
    $sqlIC = "SELECT ic_no FROM users WHERE id = ?";
    $stmtIC = $conn->prepare($sqlIC);
    $stmtIC->bind_param("i", $user_id);
    $stmtIC->execute();
    $stmtIC->store_result();

    if ($stmtIC->num_rows > 0) {
        $stmtIC->bind_result($userIC);
        $stmtIC->fetch();
    } else {
        // Handle the case when user information is not found
        $userIC = "IC Not Found";
    }

    // Close the prepared statement for ic_no
    $stmtIC->close();

    $sqlLesen = "SELECT lesen_number FROM users WHERE id = ?";
    $stmtLesen = $conn->prepare($sqlLesen);
    $stmtLesen->bind_param("i", $user_id);
    $stmtLesen->execute();
    $stmtLesen->store_result();

    if ($stmtLesen->num_rows > 0) {
        $stmtLesen->bind_result($userLesen);
        $stmtLesen->fetch();
    } else {
        // Handle the case when user information is not found
        $userLesen = "Lesen Not Found";
    }

    // Close the prepared statement for lesen_number
    $stmtLesen->close();


    // Fetch user information from the database using prepared statement for hp_number
    $sqlPhone = "SELECT hp_number FROM users WHERE id = ?";
    $stmtPhone = $conn->prepare($sqlPhone);
    $stmtPhone->bind_param("i", $user_id);
    $stmtPhone->execute();
    $stmtPhone->store_result();

    if ($stmtPhone->num_rows > 0) {
        $stmtPhone->bind_result($userPhone);
        $stmtPhone->fetch();
    } else {
        // Handle the case when user information is not found
        $userPhone = "Phone Number Not Found";
    }

    // Close the prepared statement for hp_number
    $stmtPhone->close();

    // Close the database connection
    $conn->close();
} else {
    header("Location: login.php");
    exit();
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
        header {
            background-color: #333;
            color: white;
            padding: 1em;
            text-align: center;
            width: 100%;
        }
        
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

        .dashboard-container {
                    display: flex;
                    flex: 1;
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

        ul {
            list-style-type: square;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .error p {
                    color:#FF0000;
                    font-size:20px;
                    font-weight:bold;
                    margin:50px;
                }
                 
        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }


        #profilePicture {
            max-width: 150px;
            margin-bottom: 10px;
        }

        #profilePictureForm {
            display: flex;
            flex-direction: column;
        }


        h1 {
            color: #fff;
        }

        h2 {
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 20px;
            font-size: 35px;
        }

        p {
            line-height: 1.6;
            font-family: Times, serif;
            font-size: 20px;
        }

        form {
            max-width: 400px;
            margin: left;
        }

        label {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        img {
            margin-top: 20px;
        }

        .button-28 {
            appearance: none;
            background-color: transparent;
            border: 2px solid #1A1A1A;
            border-radius: 15px;
            box-sizing: border-box;
            color: #3B3B3B;
            cursor: pointer;
            display: inline-block;
            font-family: Roobert,-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            font-size: 16px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            min-height: 60px;
            min-width: 0;
            outline: none;
            padding: 16px 24px;
            text-align: center;
            text-decoration: none;
            transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: auto;
            will-change: transform;
        }

        .button-28:disabled {
            pointer-events: none;
        }

        .button-28:hover {
            color: #fff;
            background-color: #1A1A1A;
            box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
            transform: translateY(-2px);
        }

        .button-28:active {
            box-shadow: none;
            transform: translateY(0);
        }

        .enlarged-thumbnail {
            width:300px;
            height: 300px;
        }

        .enlarged-thumbnail1 {
            width:500px;
            height: 300px;
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

            <div class="dashboard-card">
            <section>
                <h2> Profile Picture</h2>
                <?php
                // Display the image path and check if the file exists
                $imagePath = "uploads/" . $profilePicture;

                if (file_exists($imagePath)) {
                    echo "<img src='$imagePath' alt='Profile Picture' class='enlarged-thumbnail'>";
                } else {
                    echo "<p>Profile picture not found</p>";
                }
                ?>
                <form id="profilePictureForm" style="margin-top: 10px;" action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profilePicture" accept="image/*">
                    <button type="submit" class="button-28">Confirm Changes</button>
                </form>
            </section>

            <section>
                <h2>Full Name</h2>
                <p>Mr.<span id="userName" contenteditable="false"><?php echo $userName; ?></span></p>
                    <button onclick="editSection('userName')" class="button-28">Edit</button>
                
                <!-- Edit form with hidden input field for updating the name -->
                <form id="userNameForm" style="display: none;" action="update_name.php" method="post">
                    <input type="text" name="newName" id="newName" value="<?php echo $userName; ?>">
                    <button type="submit" class="button-28">Save</button>
                </form>
            </section>

            <section>
                <h2> Password</h2>
                    <p>Click the button if you want to change</p>
                    <a href="reset_password.php"> <button class="button-28">Edit</button></a>
                    
            </section>

            <section>
                <h2>Identity Card Number</h2>
                <p>Your IC Number: <span id="userIC" contenteditable="false"><?php echo $userIC; ?></span></p>
                    <button onclick="editSection('userIC')" class="button-28">Edit</button>
                
                <!-- Edit form with hidden input field for updating ic_no -->
                <form id="userICForm" style="display: none;" action="update_ic.php" method="post">
                    <input type="tel"  name="newIC" id="newIC"  minlength="12" maxlength="12" pattern="[0-9]+" value="<?php echo $userIC; ?>">
                    <button type="submit" class="button-28">Save</button>
                </form>
            </section>

            <section>
                <h2>Lesen Card Number</h2>
                    <p>Your Lesen Number: <span id="userLesen" contenteditable="false"><?php echo $userLesen; ?></span></p>
                        <button onclick="editSection('userLesen')" class="button-28">Edit</button>
                
                <!-- Edit form with hidden input field for updating lesen_no -->
                <form id="userLesenForm" style="display: none;" action="update_lesen.php" method="post">
                    <input type="text" name="newLesen" id="newLesen" minlength="17" maxlength="17" value="<?php echo $userLesen; ?>">
                    <button type="submit" class="button-28">Save</button>
                </form>
            </section>

            <section class="profile-section">
                <h2>License Picture</h2>
                <?php
                // Display the image path and check if the file exists
                $imagePath = "uploads/" . $licensePicture;

                if (file_exists($imagePath)) {
                    echo "<div class='profile-picture-container'>";
                    echo "<img src='$imagePath' alt='License Picture' class='enlarged-thumbnail'>";
                    echo "</div>";
                } else {
                    echo "<p>License picture not found</p>";
                }
                ?>
                <form id="licensePictureForm" style="margin-top: 10px;" action="upload_license_picture.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="licensePicture" accept="image/*">
                    <button type="submit" class="button-28">Confirm Changes</button>
                </form>
            </section>


            <section>
                <h2>Handphone or Phone Number</h2>
                <p>Your Phone Number: <span id="userPhone" contenteditable="false"><?php echo $userPhone; ?></span></p>
                    <button onclick="editSection('userPhone')" class="button-28">Edit</button>
                    
                
                <!-- Edit form with hidden input field for updating hp_number -->
                <form id="userPhoneForm" style="display: none;" action="update_phone.php" method="post">
                    <input type="tel" name="newPhone" id="newPhone" minlength="10" maxlength="11" pattern="[0-9]+" value="<?php echo $userPhone; ?>">
                    <button type="submit" class="button-28">Save</button>
                </form>
            </section>
        </div>
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

    function editSection(sectionId) {
        var contentElement = document.getElementById(sectionId);
        var editForm = document.getElementById(sectionId + 'Form');

        // Toggle between view and edit modes
        if (contentElement.contentEditable === 'true') {
            contentElement.contentEditable = 'false';
            editForm.style.display = 'none';
        } else {
            contentElement.contentEditable = 'true';
            editForm.style.display = 'block';
        }
    }
</script>
</body>
</html>
