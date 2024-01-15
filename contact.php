<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve admin name from session
$adminName = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Add any other logic you need for product.php

?>
<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Contact Message</title>
      <link rel="stylesheet" href="style.css" />
      <!-- Font Awesome Cdn Link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
      <style>
        /* Your existing styles */

        body {
            background: rgb(239, 228, 191);
            min-height: 100vh;
        }

        th, td {
            border: 2px solid #000; /* Add this line to make the border bold */
            padding: 8px;
            text-align: left;
            }

        .container {
            display: flex;
            min-height: 100vh;
        }

        nav {
            position: relative;
            top: 0;
            bottom: 0;
            height: 1000px;
            left: 0;
            background: rgb(235, 211, 145);
            width: 500px;
            overflow: hidden;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
            flex: 0 0 330px; /* Set the initial state to visible */
        }

        /* Add the new styles */
        #toggleButton {
            position: fixed;
            top: 20px;
            left: 20px;
            cursor: pointer;
            z-index: 999;
        }
    </style>
    </head>
    <body>

      <div class="container">
      <nav>
          <ul>
            <i><a class="logo2">
              <img src="logo.jpeg" alt="">  
            </a></i>
            <div class="adminname">
              <h1><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></h1>
            </div>
            <i><a href="adminpage.php">
              <i class="fas fa-home"></i>
              <span class="nav-item">Home</span>
            </a></i>
            <i><a href="product.php">
              <i class="fas fa-boxes"></i>
              <span class="nav-item">Product List</span>
            </a></i>
            <i><a href="complete.php">
              <i class="fas fa-clipboard-list"></i>
              <span class="nav-item">Order List</span>
            </a></i>
            <i><a href="arvinpickup.php">
              <i class="fas fa-handshake"></i>
              <span class="nav-item">Pick Up List</span>
            </a></i>
            <i><a href="ship.php">
              <i class="fas fa-truck"></i>
              <span class="nav-item">Shipment List</span>
            </a></i>
            <i><a href="deliverystaff.php">
              <i class="fas fa-people-carry"></i>
              <span class="nav-item">Delivery Staff List</span>
            </a></i>
            <i><a href="customer.php">
              <i class="fas fa-address-book"></i>
              <span class="nav-item">Customer List</span>
            </a></i>
            <i><a href="contact.php">
              <i class="fas fa-phone"></i>
              <span class="nav-item">Contact Message</span>
            </a></i>
            <i><a href="login.php" class="logout">
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-item">Log out</span>
            </a></i>
          </ul>
        </nav>

        <section class="main">
          <i><a class="logo">
            <img src="logo.jpeg" alt="">
            <span class="nav-item">Contact Message</span>
          </a></i>
          <div class="main-table">
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>User's Name</th>
                  <th>User's Email</th>
                  <th>Subject</th>
                  <th>Content</th>
                  <th>Reply</th>
                </tr>
              </thead>
              <tbody>
              <?php
              // Establish a connection to the database
              $con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

              // Fetch data from the "PICKUP" table
              $query = "SELECT * FROM tblcontact";
              $result = mysqli_query($con, $query);

              // Display data in the table
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['contact_id']}</td>";
                echo "<td>{$row['user_name']}</td>";
                echo "<td>{$row['user_email']}</td>";
                echo "<td>{$row['subject']}</td>";
                echo "<td>{$row['content']}</td>";
                echo "<td><button onclick=\"location.href='contactreply.php?contact_id={$row['contact_id']}'\">Reply</button></td>";
                echo "</tr>";
            }
            
            // Close the database connection
            mysqli_close($con);
            ?>
              </tbody>
              <div id="toggleButton" onclick="toggleContainerVisibility()">
              <i class="fas fa-bars"></i>  Menu
              </div>
            </table>
          </div>
       </section>
      </div>
      <script>

        var originalFlex = '0 0 330px';
        function toggleContainerVisibility() {
        var nav = document.querySelector('.container nav');
        var currentFlex = window.getComputedStyle(nav).getPropertyValue('flex');
        
        // Toggle between the original width and 0px
        nav.style.flex = (currentFlex === '0 0 0px' || currentFlex === '0px 0px 0px') ? originalFlex : '0 0 0px';
        }
    </script>

<script>
  var originalFlex = '0 0 330px';

  function toggleContainerVisibility() {
    var nav = document.querySelector('.container nav');
    var currentFlex = window.getComputedStyle(nav).getPropertyValue('flex');

    // Toggle between the original width and 0px
    nav.style.flex = (currentFlex === '0 0 0px' || currentFlex === '0px 0px 0px') ? originalFlex : '0 0 0px';
  }

</script>
    </body>
    </html></span>