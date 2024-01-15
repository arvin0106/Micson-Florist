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
    <title>Delivery Page</title>
    <style>
        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .thumbnail {
            max-width: 100px; /* Adjust the maximum width of the thumbnail */
            max-height: 100px; /* Adjust the maximum height of the thumbnail */
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
        }

        p {
            line-height: 1.6;
        }

        form {
            max-width: 400px;
            margin: auto;
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
            max-width: 35%;
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
        width: 10%;
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

    <section>
        <h2>Your Profile Picture</h2>
        <img src='<?php echo $profilePicture; ?>' alt='Profile Picture' class='thumbnail'>
        
        <form id="profilePictureForm" style="margin-top: 10px;" action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
            <input type="file" name="profilePicture" accept="image/*">
            <button type="submit" class="button-28">Upload</button>
        </form>
    </section>


    <section>
        <h2>Your Full Name</h2>
        <p>Name: <span id="userName" contenteditable="false"><?php echo $userName; ?></span>
            <button onclick="editSection('userName')" class="button-28">Edit</button>
        </p>
        <!-- Edit form with hidden input field for updating the name -->
        <form id="userNameForm" style="display: none;" action="update_name.php" method="post">
            <input type="text" name="newName" id="newName" value="<?php echo $userName; ?>">
            <button type="submit" class="button-28">Save</button>
        </form>
    </section>

    <section>
        <h2>Your IC Number</h2>
        <p>IC Number: <span id="userIC" contenteditable="false"><?php echo $userIC; ?></span>
            <button onclick="editSection('userIC')" class="button-28">Edit</button>
        </p>
        <!-- Edit form with hidden input field for updating ic_no -->
        <form id="userICForm" style="display: none;" action="update_ic.php" method="post">
            <input type="text" name="newIC" id="newIC" value="<?php echo $userIC; ?>">
            <button type="submit" class="button-28">Save</button>
        </form>
    </section>

    <section>
    <h2>Your Lesen Number</h2>
        <p>Lesen Number: <span id="userLesen" contenteditable="false"><?php echo $userLesen; ?></span>
            <button onclick="editSection('userLesen')" class="button-28">Edit</button>
        </p>
        <!-- Edit form with hidden input field for updating lesen_no -->
        <form id="userLesenForm" style="display: none;" action="update_lesen.php" method="post">
            <input type="text" name="newLesen" id="newLesen" value="<?php echo $userLesen; ?>">
            <button type="submit" class="button-28">Save</button>
        </form>
    </section>


    <section>
        <h2>Your Phone Number</h2>
        <p>Phone Number: <span id="userPhone" contenteditable="false"><?php echo $userPhone; ?></span>
            <button onclick="editSection('userPhone')" class="button-28">Edit</button>
            <br>
            <br>
            
        </p>
        <!-- Edit form with hidden input field for updating hp_number -->
        <form id="userPhoneForm" style="display: none;" action="update_phone.php" method="post">
            <input type="text" name="newPhone" id="newPhone" value="<?php echo $userPhone; ?>">
            <button type="submit" class="button-28">Save</button>
        </form>
    </section>
    <footer>
        <p>If you encounter any issues, please visit our contact page in the Help section. Kindly refrain from sharing your profile.</p>
    </footer>
<script>
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
