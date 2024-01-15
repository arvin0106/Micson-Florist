<?php
session_start();

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

if (isset($_GET['uid'])) {
  $uid = mysqli_real_escape_string($con, $_GET['uid']);

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pickup_date'])) {
    $filteredDate = mysqli_real_escape_string($con, $_GET['pickup_date']);
    $query = "SELECT * FROM pickup_detail WHERE UID = '$uid' AND PICKUP_DATE = '$filteredDate'";
} else {
    $query = "SELECT * FROM pickup_detail WHERE UID = '$uid'";
}

$result = mysqli_query($con, $query);
  $pickupData = mysqli_fetch_assoc($result);

    if (!$pickupData) {
        // Handle error, redirect, or show a message
    }
} else {
    // Handle error, redirect, or show a message
}

// Retrieve admin name from session
$adminName = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!-- Your HTML and the rest of the code here -->

<?php
// Fetch data from the "PICKUP" table for the entire table
$queryAll = "SELECT * FROM pickup_detail";
$resultAll = mysqli_query($con, $queryAll);
?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Pick Up List</title>
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
            <span class="nav-item">Pick Up List</span>
          </a></i>
          <div class="filter-form">
    <form method="get" action="arvinpickup.php">
    <label for="pickup_date">Filter by Pick Up Date:</label>
    <input type="date" id="pickup_date" name="pickup_date">
    <button type="button" onclick="showFilteredData()">Filter</button>
</form>
</div>
          <div class="main-table">
            <table>
              <thead>
                <tr>
                  <th>Invoice Numbe</th>
                  <th>Customer First Name</th>
                  <th>Customer Last Name</th>
                  <th>Email Address</th>
                  <th>Contack Number</th>
                  <th>Remark</th>
                  <th>Pickup Date</th>
                  <th>Status</th>
                  <th>Edit Status</th>
                  <th>EDIT</th>
                </tr>
              </thead>
              <tbody>
              <div id="toggleButton" onclick="toggleContainerVisibility()">
              <i class="fas fa-bars"></i>  Menu
              </div>
              <div id="popupContent" class="popup-content"></div>
              <?php
              // Establish a connection to the database
              $con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

              // Fetch data from the "PICKUP" table
              $query = "SELECT pickup_detail.*, orders.ORDER_NO FROM pickup_detail
          LEFT JOIN orders ON pickup_detail.UID = orders.UID";

$result = mysqli_query($con, $query);

// Display data in the table
while ($rowAll = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$rowAll['ORDER_NO']}</td>";
    echo "<td>{$rowAll['FIRST_NAME']}</td>";
    echo "<td>{$rowAll['LAST_NAME']}</td>";
    echo "<td>{$rowAll['EMAIL_ADDRESS']}</td>";
    echo "<td>{$rowAll['PHONE']}</td>";
    echo "<td>{$rowAll['REMARK']}</td>"; 
    echo "<td>{$rowAll['PICKUP_DATE']}</td>";
    echo "<td>{$rowAll['STATUS']}</td>";
    echo "<td><button onclick=\"markAsPickedUp('{$rowAll['UID']}')\">Picked Up</button></td>";
    echo "<td><button onclick=\"location.href='pickup_edit.php?uid={$rowAll['UID']}'\">Edit</button></td>";
    echo "</tr>";
}

// Close the database connection
mysqli_close($con);
            ?>
            <?php
// Close the database connection
?>
              </tbody>
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

    // Function to show the pop-up with filtered data
    function showFilteredData() {
        var popupContent = document.getElementById('popupContent');

        // Fetch and display the filtered data in the pop-up
        // You can use AJAX to fetch data from the server if needed
        // For simplicity, assuming you have a PHP file to handle data retrieval

        // Example using fetch and assuming fetchdata.php handles data retrieval
        fetch('fetchdata.php?pickup_date=' + document.getElementById('pickup_date').value)
            .then(response => response.text())
            .then(data => {
                popupContent.innerHTML = data;
                // Show the pop-up
                popupContent.style.display = 'block';
            });
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

    <script>
    function markAsPickedUp(uid) {
        // Use AJAX to update the database without refreshing the page
        fetch('mark_as_picked_up.php?uid=' + uid)
            .then(response => response.text())
            .then(data => {
                // You can handle the response if needed
                console.log(data);

                // Optionally, you can reload the page or update the UI accordingly
                location.reload();
            });
    }
</script>
    </body>
    </html></span>



    