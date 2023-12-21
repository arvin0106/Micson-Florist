<?php 
	include "config.php";
	session_start();
	
	include "cart.class.php";
	$cart=new Cart();
	
?>
<html>
	<head>
        <title>Checkout</title>
		<link rel="stylesheet" href="css/complete.css">

    </head>
    <body>
		<?php include "navbar.php"; ?>

		<br><br>

        <div class='container mt-5'>
			<h2 class='text-muted mb-4'>Order Placed Successfully</h2>
			<br>
			<div class='row'>

				<div class='col-md-12'>
						<div class='alert alert-success'>
							Your Order no is #<?php echo $_GET["order_no"];?>
							<br>Order Name:<?php echo $_GET['FIRST_NAME'] . ' ' . $_GET['LAST_NAME'] ?>
							<br>Email:<?php echo $_GET['EMAIL_ADDRESS'] ?>
							<br>Phone:<?php echo $_GET['PHONE'] ?>

						</div>
				</div>
					
			</div>
		</div>
		
        <?php include "footer.php"; ?>
        
    </div>

    </body>
</html> 