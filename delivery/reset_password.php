<?php
session_start();

// Verify User Authentication
if (!isset($_SESSION["user_id"], $_SESSION["name"], $_SESSION["user_email"])) {
    // Redirect to login page or handle the case where the user is not authenticated
    header("Location: login.php");
    exit;
}

// Extract information from the session
$user_id = $_SESSION["user_id"];
$name = $_SESSION["name"];
$user_email = $_SESSION["user_email"];

// Database Connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "orderlist";

$conn = new mysqli($hostname, $username, $password, $database);

// Step 1: Check Database Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging Database Queries
$verifyQuery = "SELECT password FROM users WHERE email = ?";
$verifyStmt = mysqli_prepare($conn, $verifyQuery);

// Step 2: Check SQL Query
if (!$verifyStmt) {
    die("Error preparing query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($verifyStmt, 's', $user_email);
mysqli_stmt_execute($verifyStmt);
$result = mysqli_stmt_get_result($verifyStmt);

// Step 3: Check Error Log
if (!$result) {
    // Log the error
    error_log("Error fetching user information: " . mysqli_error($conn));
    die("Error fetching user information. Please try again later.");
}

if ($row = mysqli_fetch_assoc($result)) {
    $storedPassword = $row['password'];

    // Password Change Logic
    if (isset($_POST["change"])) {
        $cpassword = $_POST["cpassword"];
        $npassword = $_POST["passwordConfirm"];

        // Check if the new password is the same as the current password
        if ($cpassword == $npassword) {
            echo '<script>alert("New password must be different from the current password.");</script>';
        } else {
            // Verify current password
            if (password_verify($cpassword, $storedPassword)) {
                // Using prepared statement to update the password
                $updateQuery = "UPDATE users SET password = ? WHERE email=?";
                $stmt = mysqli_prepare($conn, $updateQuery);

                // Hash the new password before storing it
                $hashedPassword = password_hash($npassword, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, 'ss', $hashedPassword, $user_email);

                if (mysqli_stmt_execute($stmt)) {
                  echo '<script>
                          alert("Change Password Successfully! Please login again");
                          setTimeout(function() {
                              window.location.href = "login.php";
                          }, 1000); // Delay for 1 second (1000 milliseconds)
                      </script>';
                  exit;
              } else {
                  // Log the error for debugging
                  error_log("Error updating record: " . mysqli_error($conn));
                  echo '<script>alert("Error updating record. Please try again later.");</script>';
              }
              
              // Close the statement even if there's an error
              mysqli_stmt_close($stmt);
              
            } else {
                echo '<script>alert("Incorrect current password. Try again!");</script>';
            }
        }
    }

} else {
    // Improved Error Handling
    error_log("Error fetching user information: No rows returned");
    die("Error fetching user information. Please try again later.");
}

// Step 4: Close the database connection
$conn->close();
?>



<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Change Password </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../admin/vendors/feather/feather.css">
  <link rel="stylesheet" href="../admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../admin/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../admin/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../admin/images/favicon.png" />
    
    <title>Change Password</title>
    <style>
    * {
        box-sizing: border-box;
    }
    body {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        
    body {
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px 40px;
        width: 400px;
    }

    .lock-icon {
        font-size: 0.5rem;
    }

    h2 {
        font-size: 1.5rem;
        margin-top: 10 px;
        text-transform: uppercase;
    }

    p {
        font-size: 12px;
    }

    .passInput {
        margin-top: 15px;
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 15px;
        color: #333;
        outline: none;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        text-align: center;
    }

    button {
        margin-top: 15px;
        width: 100%;
        background-color: #3498db;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
    }

</style>
    
</head>

<body>

    <div class="card">
    <div class="brand-logo">
    <img src="image/change.jpg" alt="logo" height="150px" width="150px">
    </div>
    <br/>
    <p class="lock-icon"><i class="mdi mdi-lock-open-outline"></i></p>

        <h2>Change Password</h2>
        <p>Set Your New Password</p>
        <div class="form-container">
            <form action="" method="post">
                <input type="password" class="passInput" name="cpassword" placeholder="Current Password"  maxlength="15" required>
                <input type="password" class="passInput" name="password" placeholder="New Password" oninput="validatePassword()" maxlength="15" required>
                <input type="password" class="passInput" name="passwordConfirm" placeholder="Confirm Password" oninput="validatePassword()" maxlength="15" required>
                <small id="passwordHelp" class="form-text text-muted" style="color: red;"></small>
                <a href="login_forget.html">Forget password?</a>
                <div id="error-message" style="color: red;"></div> 
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="change" >Change Password</button>
                <a href="neweditprofile.php"><button class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn" type="button">Back</button></a>
            </form>
            
        </div>
    </div>
    <script>
        window.addEventListener('load', function () {
            document.body.style.opacity = 1;
        });
    </script>
    <script>
    function validatePassword() {
        var passwordInput = document.getElementsByName('password')[0];
        var confirmInput = document.getElementsByName('passwordConfirm')[0];
        var passwordHelp = document.getElementById('passwordHelp');
        var errorMessage = document.getElementById('error-message');

        // Password validation logic
        var hasUpperCase = /[A-Z]/.test(passwordInput.value);
        var hasLowerCase = /[a-z]/.test(passwordInput.value);
        var hasDigit = /\d/.test(passwordInput.value);
        var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordInput.value);

        if (
    passwordInput.value.length < 8 ||
    !hasUpperCase ||
    !hasLowerCase ||
    !hasDigit ||
    !hasSpecialChar
) {
    passwordInput.style.border = '2px solid red';
    passwordHelp.innerHTML = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character.';
    errorMessage.innerHTML = '';
} else if (passwordInput.value !== confirmInput.value) {
    passwordInput.style.border = '2px solid green';
    passwordHelp.innerHTML = 'Matches password requirements.';
    confirmInput.style.border = '2px solid red';
    errorMessage.innerHTML = 'Confirm Passwords do not match.';
} else {
    passwordInput.style.border = '2px solid green';
    passwordHelp.innerHTML = 'Matches password requirements. <i class="fas fa-check" style="color: green;"></i>';
    confirmInput.style.border = '2px solid green';
    errorMessage.innerHTML = '';
}

    }
</script>
<script>
        window.addEventListener('load', function () {
            document.body.style.opacity = 1;
        });
    </script>
<script src="../admin/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../admin/js/off-canvas.js"></script>
  <script src="../admin/js/hoverable-collapse.js"></script>
  <script src="../admin/js/template.js"></script>
  <script src="../admin/js/settings.js"></script>
  <script src="../admin/js/todolist.js"></script>
</body>
</html>