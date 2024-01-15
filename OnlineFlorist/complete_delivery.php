<?php 
    include "config.php";
    session_start();
	include "cart.class.php";
	$cart = new Cart();

    // Ensure necessary session variables exist
    if (isset($_SESSION['order_no']) && isset($_SESSION['total_amt']) && isset($_SESSION['products']) && isset($_SESSION['delivery_date']) && isset($_SESSION['delivery_time'])) {
        $order_no = $_SESSION['order_no'];
        $total_amt = $_SESSION['total_amt'];
        $products = $_SESSION['products'];
        $delivery_date = $_SESSION['delivery_date'];
        $delivery_time = $_SESSION['delivery_time'];
?>

?>
<html>
    <head>
        <title>Order Placed Successfully</title>
        <link rel="stylesheet" href="css/complete.css">

		<style>
		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 0 15px;
		}

		.invoice {
			border: 1px solid #4CAF50;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(76, 175, 80, 0.2);
			padding: 20px;
			background-color: #E8F5E9; /* Light green background */
		}

		.invoice-header {
			text-align: center;
			margin-bottom: 20px;
		}

		.invoice-title {
			font-size: 28px;
			margin-bottom: 10px;
			color: black; 
		}

		.invoice-details {
			font-size: 16px;
			color: black; 
		}

		.order-number {
			font-weight: bold;
		}

		.invoice-body {
			padding: 20px;
		}

		.order-details {
			margin-bottom: 30px;
		}

		.product-list {
			list-style: none;
			padding: 0;
		}

		.product-item {
			border-bottom: 1px solid #AED581; /* Lighter green */
			padding: 10px 0;
		}

		.product-name,
		.product-price,
		.product-quantity {
			margin: 5px 0;
			color: black; 
		}

		.total-amount {
			font-weight: bold;
			margin-top: 10px;
			font-size: 18px;
			color: black; 
		}

		.BTN
        {
            height: 30px;
            padding: 5px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .button
        {
            display: flex;
            justify-content: center;
            padding: 5px;
        }
		</style>
    </head>
    <body>
        <?php include "navbar.php"; ?>
		<br><br>
        <div class='container mt-5'>

			<div class='invoice'>
				<div class='invoice-header'>
					<h2 class='invoice-title'>Order Placed Successfully</h2>
					<div class='invoice-details'>
						<p class='order-number'>Invoice No: #<?php echo $order_no; ?></p>
					</div>
				</div>
				<div class='invoice-body'>
					<div class='order-details'>
						<h3>Order Details:</h3>							
						<ul class='product-list'>
							<?php foreach ($products as $product) : ?>
								<li class='product-item'>
									<p class='product-name'>Product Name: <?php echo $product['name']; ?></p>
									<p class='product-price'>Price: RM<?php echo $product['price']; ?></p>
									<p class='product-quantity'>Quantity: <?php echo $product['qty']; ?></p>
                                    <p>Delivery Date: <?php echo $delivery_date; ?></p>
                                    <p>Delivery Time: <?php echo $delivery_time; ?></p>
								</li>
							<?php endforeach; ?>
						</ul>
						<p class='total-amount'>Total: RM<?php echo $total_amt; ?></p>
					</div>
				</div>

				<div class="button">
					<button class="BTN" onclick="backtomenu()" id="hide1">Back To Menu</button>
					<button class="BTN" id="hide2" onclick="print_content()">Print as PDF</button>
				</div>
			</div>
		
			<script>
				function backtomenu()
				{
				window.location = "index.php";
				}	

				function print_content()
				{
				
					var hide1 = document.getElementById("hide1");
					var hide2 = document.getElementById("hide2");
				
					hide1.style.display = "none";
					hide2.style.display = "none";
					
					window.print();

					hide1.style.display = "block";
					hide2.style.display = "block";
				}
			</script>
		</div>		
		</div>
		
        <?php include "footer.php"; ?>

    </body>
</html>

<?php
    } else {
        // Handle the case where session data is missing
        echo "Session data not found. Please ensure the checkout process is completed.";
    }
?>
