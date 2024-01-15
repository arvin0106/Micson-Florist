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
        main {
            padding: 20px;
        }
        
        .dashboard-card {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: square;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
        .extra-spacing {
    margin-right: 1300px;
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
        <span class="extra-spacing"></span>
        <a href="reset_password.php">Reset Password</a>
    </header>
    
    <nav>
        <a href="pageprofile.php">Profile</a>
        <a href="pageorderlist.php">Order List</a>
        <a href="pageupload.php">Image Complete</a>
        <a href="pagehelp.php">Help</a>
    </nav>
    

    <main>
        <div class="dashboard-card">
            <h2>Phone Number ~ </h2>
            <ul>
                <li>Micson Florist : <a href="tel:06-3456789">06-345 6789</a></li>
                <li>Mr. Zavier : <a href="tel:011-10872888">011-1087 2888</a></li>
                <li>Mr. Kiew : <a href="tel:011-10872888">011-1087 2888</a></li>
                <li>Mr. Yap : <a href="tel:011-10872888">011-1087 2888</a></li>
            </ul>
        </div>

        <div class="dashboard-card">
            <h2>Email Address ~ </h2>
            <ul>
                <li>Micson Florist : <a href="mailto:micsonflorist@gmail.com">micsonflorist@gmail.com</a></li>
                <li>Mr. Zavier : <a href="mailto:1211206041@student.mmu.edu.my">1211206041@student.mmu.edu.my</a></li>
                <li>Mr. Kiew : <a href="mailto:1211206750@student.mmu.edu.my">1211206750@student.mmu.edu.my</a></li>
                <li>Mr. Yap : <a href="mailto:1211206750@student.mmu.edu.my">1211206750@student.mmu.edu.my</a></li>
            </ul>
        </div>
    </main>
<footer>
    <p>If have any issue in page please visit our contact at Help page. Kindly please do not share your profile.</p>
    </footer>
</body>
</html>
