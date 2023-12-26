<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Product List</title>
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
              <i><a href="adminpage.html">
                <i class="fas fa-home"></i>
                <span class="nav-item">Home</span>
              </a></i>
              <i><a href="product.html">
                <i class="fas fa-boxes"></i>
                <span class="nav-item">Product List</span>
              </a></i>
              <i><a href="pickup.html">
                <i class="fas fa-handshake"></i>
                <span class="nav-item">Pick Up List</span>
              </a></i>
              <i><a href="ship.html">
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
              <i><a href="customer.html">
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
            <span class="nav-item">Product List</span>
          </a></i>
          <div class="main-table">
            <table>
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Product Name</th>
                  <th>Product Price</th>
                  <th>Image</th>
                  <th style="text-align: center;">Description</th>
                  <th>Delete</th> <!-- New column for delete button -->
                </tr>
              </thead>
              <tbody>
            <?php
              // Establish a connection to the database
              $con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

              // Fetch data from the "products" table
              $query = "SELECT * FROM products";
              $result = mysqli_query($con, $query);

              // Display data in the table
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['PID']}</td>";
                echo "<td>{$row['PRODUCT']}</td>";
                echo "<td>{$row['PRICE']}</td>";
                echo "<td style='text-align: center;'><img src='{$row['IMAGE']}' alt='{$row['PRODUCT']}' style='width: 100px; height: 100px;'></td>";
                echo "<td>{$row['DESCRIPTION']}</td>";
                echo "<td><button onclick='deleteProduct({$row['PID']})'>Delete</button></td>"; // Delete button
                echo "</tr>";
              }

              // Close the database connection
              mysqli_close($con);
            ?>
          </tbody>
            </table>

            <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="productImage" id="productImage" accept="image/*" required>
        <button type="button" onclick="uploadNewProduct()">Upload New Product</button>
    </form>
            
          </div>
       </section>
      </div>

    <script>
    function deleteProduct(productID) {
    // Confirm the deletion with the user
    if (confirm("Are you sure you want to delete this product?")) {
        // Create a FormData object to send data to the server
        const formData = new FormData();
        formData.append('productID', productID);

        // Send the data to the server using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_product.php', true);
        xhr.onload = function () {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
                // You can update the UI or perform any other actions
                // For simplicity, you can reload the page for demonstration purposes
                location.reload();
            } else {
                alert(response.message);
            }
        };

        // Send the data as a POST request
        xhr.send(formData);
    }
}

    function uploadNewProduct() {
        // Get values from the user
        const productName = prompt("Enter product name:");
        const productPrice = prompt("Enter product price:");
        const productDescription = prompt("Enter product description:");

        // Get the selected file
        const productImageInput = document.getElementById('productImage');
        const productImage = productImageInput.files[0];

        // Create a FormData object to send files
        const formData = new FormData();
        formData.append('productName', productName);
        formData.append('productPrice', productPrice);
        formData.append('productDescription', productDescription);
        formData.append('productImage', productImage);

        // Send the data to the server using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload_product.php', true);
        xhr.onload = function () {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
                // You can update the UI or perform any other actions
                // For simplicity, you can reload the page for demonstration purposes
                location.reload();
            } else {
                alert(response.message);
            }
        };

        // Send the data as a POST request
        xhr.send(formData);
    }
    </script>

    </body>
    </html></span>