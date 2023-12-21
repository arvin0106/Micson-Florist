<?php
// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error($con));

// Fetch and display total Completed orders
$pickupOrderQuery = "SELECT COUNT(*) as total_pickup FROM pickup_detail";
$pickupOrderResult = mysqli_query($con, $pickupOrderQuery);

if (!$pickupOrderResult) 
{
    die('Error: ' . mysqli_error($con));
}
$pickupOrderData = mysqli_fetch_assoc($pickupOrderResult);

//ship
$shipOrderQuery = "SELECT COUNT(*) as total_ship FROM shipping_details";
$shipOrderResult = mysqli_query($con, $shipOrderQuery);

if (!$shipOrderResult) {
    die('Error: ' . mysqli_error($con));
}

$shipOrderData = mysqli_fetch_assoc($shipOrderResult);
?>

<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Admin Dashboard</title>
      <link rel="stylesheet" href="style.css" />
      <!-- Font Awesome Cdn Link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    </head>
    <body>

      <div class="container">
        <nav>
          <ul>
            <i><a class="logo2">
              <img src="logo.jpeg" alt="">  
            </a></i>
            <div class="adminname">
              <h1>Zavier</h1>
            </div>
            <i><a href="adminpage.php">
              <i class="fas fa-home"></i>
              <span class="nav-item">Home</span>
            </a></i>
            <i><a href="product.php">
              <i class="fas fa-boxes"></i>
              <span class="nav-item">Product List</span>
            </a></i>
            <i><a href="pickup.php">
              <i class="fas fa-handshake"></i>
              <span class="nav-item">Pick Up List</span>
            </a></i>
            <i><a href="ship.php">
              <i class="fas fa-truck"></i>
              <span class="nav-item">Shipment List</span>
            </a></i>
            <i><a href="deliverystaff.html">
              <i class="fas fa-people-carry"></i>
              <span class="nav-item">Delivery Staff List</span>
            </a></i>
            <i><a href="completeorder.html">
              <i class="fas fa-clipboard-list"></i>
              <span class="nav-item">Completed Order List</span>
            </a></i>
            <i><a href="customer.php">
              <i class="fas fa-address-book"></i>
              <span class="nav-item">Customer List</span>
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
            <span class="nav-item">DashBoard</span>
          </a></i>

          <div class="main-skills">
            <div class="card">
              <i class="fas fa-handshake"></i>
              <h3>Total PickUp Order</h3>
              <button><?php echo $pickupOrderData['total_pickup']; ?></button>

            </div>
            <div class="card">
              <i class="fas fa-truck"></i>
              <h3>Total Ship Order</h3>
              <button><?php echo $shipOrderData['total_ship']; ?></button>
            </div>
            <div class="card">
              <i class="fas fa-people-carry"></i>
              <h3>Total Delivery Staff</h3>
              <button>1</button>
            </div>
            <div class="card">
              <i class="fas fa-clipboard-list"></i>
              <h3>Completed Order</h3>
              <button>1</button>
            </div>
          </div>
          
        </section>
      </div>
    </body>
    </html></span>