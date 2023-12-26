<?php
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error($con));
$pickupOrderQuery = "SELECT COUNT(*) as total_pickup FROM pickup_detail";
$pickupOrderResult = mysqli_query($con, $pickupOrderQuery);
if (!$pickupOrderResult) 
{
    die('Error: ' . mysqli_error($con));
}
$pickupOrderData = mysqli_fetch_assoc($pickupOrderResult);
$shipOrderQuery = "SELECT COUNT(*) as total_ship FROM shipping_details";
$shipOrderResult = mysqli_query($con, $shipOrderQuery);

if (!$shipOrderResult) 
{
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
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

          <canvas id="barChart" width="400" height="200"></canvas>
          <script>
  // Get the context of the canvas element
  var ctx = document.getElementById('barChart').getContext('2d');

  // Data for the bar chart
  var data = {
    labels: ['Total PickUp Order', 'Total Ship Order', 'Total Delivery Staff', 'Completed Order'],
    datasets: [{
      label: 'Orders',
      data: [
        <?php echo $pickupOrderData['total_pickup']; ?>,
        <?php echo $shipOrderData['total_ship']; ?>,
        1, // Total Delivery Staff (replace with your actual data)
        1  // Completed Order (replace with your actual data)
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
      ],
      borderWidth: 1
    }]
  };

  // Configuration options
  var options = {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  // Create the bar chart
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
  });
</script>
          
        </section>
      </div>
    </body>
    </html></span>