<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Pick Up List</title>
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
            <span class="nav-item">Pick Up List</span>
          </a></i>
          <div class="main-table">
            <table>
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer First Name</th>
                  <th>Customer Last Name</th>
                  <th>Email Address</th>
                  <th>Contack Number</th>
                  <th>Remark</th>
                  <th>CREATED_AT</th>
                </tr>
              </thead>
              <tbody>
              <?php
              // Establish a connection to the database
              $con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

              // Fetch data from the "PICKUP" table
              $query = "SELECT * FROM pickup_detail";
              $result = mysqli_query($con, $query);

              // Display data in the table
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['UID']}</td>";
                echo "<td>{$row['FIRST_NAME']}</td>";
                echo "<td>{$row['LAST_NAME']}</td>";
                echo "<td>{$row['EMAIL_ADDRESS']}</td>";
                echo "<td>{$row['PHONE']}</td>";
                echo "<td>{$row['REMARK']}</td>"; 
                echo "<td>{$row['CREATED_AT']}</td>";
                echo "</tr>";
              }

              // Close the database connection
              mysqli_close($con);
            ?>
              </tbody>
            </table>
          </div>
       </section>
      </div>
    </body>
    </html></span>