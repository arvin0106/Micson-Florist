<?php
include "config.php";
session_start();
include "cart.class.php";
$cart = new Cart();

if(isset($_POST["submit"])){
    // Extracting contact information
    $contactFirstName = mysqli_real_escape_string($con, $_POST["contact_first_name"]);
    $contactLastName = mysqli_real_escape_string($con, $_POST["contact_last_name"]);
    $contactEmail = mysqli_real_escape_string($con, $_POST["contact_email"]);
    $contactPhone = mysqli_real_escape_string($con, $_POST["contact_phone"]);

    // Extracting shipping information
    $shippingFirstName = mysqli_real_escape_string($con, $_POST["shipping_first_name"]);
    $shippingLastName = mysqli_real_escape_string($con, $_POST["shipping_last_name"]);
    $shippingEmail = mysqli_real_escape_string($con, $_POST["shipping_email"]);
    $shippingPhone = mysqli_real_escape_string($con, $_POST["shipping_phone"]);
    $shippingCompany = mysqli_real_escape_string($con, $_POST["shipping_company"]);
    $shippingAddress1 = mysqli_real_escape_string($con, $_POST["shipping_address_1"]);
    $shippingAddress2 = mysqli_real_escape_string($con, $_POST["shipping_address_2"]);
    $shippingCountry = mysqli_real_escape_string($con, $_POST["shipping_country"]);
    $shippingState = mysqli_real_escape_string($con, $_POST["shipping_state"]);
    $shippingCity = mysqli_real_escape_string($con, $_POST["shipping_city"]);
    $remark = mysqli_real_escape_string($con, $_POST["remark"]);
    $pickupDate = mysqli_real_escape_string($con, $_POST["pickup_date"]);
    $deliveryTime = mysqli_real_escape_string($con, $_POST["delivery_time"]);

    // Insert contact details into 'users' table
    $sqlContact = "INSERT INTO users (FIRST_NAME, LAST_NAME, EMAIL_ADDRESS, PHONE) 
        VALUES ('{$contactFirstName}', '{$contactLastName}', '{$contactEmail}', '{$contactPhone}')";

    if($con->query($sqlContact)){
        $uid = $con->insert_id;

        // Insert shipping details into 'shipping_details' table
        $sqlShipping = "INSERT INTO shipping_details (UID, FIRST_NAME, LAST_NAME, EMAIL_ADDRESS, PHONE, COMPANY_NAME, 
            SHIPPING_ADDRESS_LINE_1, SHIPPING_ADDRESS_LINE_2, COUNTRY_REGION, STATE, CITY, REMARK, PICKUP_DATE, DELIVERY_TIME) 
            VALUES ('{$uid}', '{$shippingFirstName}', '{$shippingLastName}', '{$shippingEmail}', '{$shippingPhone}', '{$shippingCompany}', 
            '{$shippingAddress1}', '{$shippingAddress2}', '{$shippingCountry}', '{$shippingState}', '{$shippingCity}', '{$remark}', '{$pickupDate}', '{$deliveryTime}')";

        if($con->query($sqlShipping)){
            $oid = $con->insert_id;

            // Insert order details into 'orders' table
            $order_no = rand(10000,100000);
            $total_amt = $cart->get_cart_total();
            $sqlOrder = "INSERT INTO orders (ORDER_NO, ORDER_DATE, UID, TOTAL_AMT) 
                VALUES ('{$order_no}', NOW(), '{$uid}', '{$total_amt}')";

            if($con->query($sqlOrder)){
                $oid = $con->insert_id;

                // Insert order item details into 'order_details' table
                $sqlOrderDetails = "INSERT INTO order_details (OID, PID, PNAME, PRICE, QTY, TOTAL) VALUES ";
                $rows = [];
                foreach($cart->get_all_items() as $item){
                    $rows[] = "('{$oid}', '{$item["id"]}', '{$item["name"]}', '{$item["price"]}', '{$item["qty"]}', '{$item["total"]}')";
                }
                $sqlOrderDetails .= implode(",", $rows);

                if($con->query($sqlOrderDetails)){
                    $cart->destroy();
                    header("location:complete.php?order_no={$order_no}");
                }
            }
        }
    }
}
?>



<html>
	<head>
		<meta charset="UTF-8">
        <title>Checkout</title>
		<link rel="stylesheet" href="css/checkout.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Inconsolata'>
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
		<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
		<style>
			.form-group col-md-5
			{
            width: 206%; /* Fills the available space within the form-group */
            padding: 8px; /* Adjust padding as needed */
            }
		</style>
    </head>
    <body>
		
	<?php include "navbar.php"; ?>

    <div class='container mt-5'>
    <h2 class='text-muted mb-4'>Delivery Details</h2>
    <div class='row'>
        <div class='col-md-6 mx-auto'>
            <form method='post' action='<?php echo $_SERVER["REQUEST_URI"];?>' autocomplete="off">
                <!-- Contact Information -->
                <h2>Contact Information</h2>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label>First Name</label>
                        <input type='text' name='contact_first_name' class='form-control' required placeholder='First Name'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label>Last Name</label>
                        <input type='text' name='contact_last_name' class='form-control' required placeholder='Last Name'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label>Email Address</label>
                        <input type='email' name='contact_email' class='form-control' required placeholder='Email Address'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label>Phone</label>
                        <input type='text' name='contact_phone' class='form-control' required placeholder='Phone'>
                    </div>
                </div>
                
                <!-- Shipping Address -->
				<h2>Shipping Address</h2>
				<div class='form-row'>
					<div class='form-group col-md-6'>
						<label>First Name</label>
						<input type='text' name='shipping_first_name' class='form-control' required placeholder='First Name'>
					</div>
					<div class='form-group col-md-6'>
						<label>Last Name</label>
						<input type='text' name='shipping_last_name' class='form-control' required placeholder='Last Name'>
					</div>
					<div class='form-group col-md-6'>
						<label>Email Address</label>
						<input type='email' name='shipping_email' class='form-control' required placeholder='Email Address'>
					</div>
					<div class='form-group col-md-6'>
						<label>Phone</label>
						<input type='text' name='shipping_phone' class='form-control' required placeholder='Phone'>
					</div>
					<div class='form-group col-md-6'>
						<label>Company Name (Optional)</label>
						<input type='text' name='shipping_company' class='form-control' placeholder='Company Name'>
					</div>
					<div class='form-group col-md-6'>
						<label>Address Line 1</label>
						<input type='text' name='shipping_address_1' class='form-control' required placeholder='Address Line 1'>
					</div>
					<div class='form-group col-md-6'>
						<label>Address Line 2 (Optional)</label>
						<input type='text' name='shipping_address_2' class='form-control' placeholder='Address Line 2'>
					</div>
					<div class='form-group col-md-6'>
						<label>Country Region</label>
						<select name='shipping_country' class='form-control' required>
							<option value=''>Select Country</option>
							<option value='Malaysia'>Malaysia</option>
							<!-- Add more countries here if needed -->
						</select>
					</div>
					
					<div class='form-group col-md-6'>
						<label>State</label>
						<select name='shipping_state' class='form-control' required>
							<option value='' selected disabled>Select State</option>
							<option value='Johor'>Johor</option>
							<option value='Kedah'>Kedah</option>
							<option value='Kelantan'>Kelantan</option>
							<option value='Melaka'>Melaka</option>
							<option value='Negeri Sembilan'>Negeri Sembilan</option>
							<option value='Pahang'>Pahang</option>
							<option value='Perak'>Perak</option>
							<option value='Perlis'>Perlis</option>
							<option value='Penang'>Penang</option>
							<option value='Sabah'>Sabah</option>
							<option value='Sarawak'>Sarawak</option>
							<option value='Selangor'>Selangor</option>
							<option value='Terengganu'>Terengganu</option>
							<option value='Kuala Lumpur'>Kuala Lumpur</option>
							<option value='Labuan'>Labuan</option>
							<option value='Putrajaya'>Putrajaya</option>
						</select>
					</div>

					<div class='form-group col-md-6'>
						<label>City</label>
						<input type='text' name='shipping_city' class='form-control' required placeholder='City'>
					</div>
					<div class='form-group col-md-6'>
						<label>Postcode</label>
						<input type='text' name='shipping_postcode' class='form-control' required placeholder='Postcode'>
					</div>
				</div>

				<h2>Delivery Date</h2>
				<div class='form-group col-md-6'>
					<input type='date' name='pickup_date' class='form-control_1' required min='<?php echo date('Y-m-d'); ?>'>
				</div>

				<br>

				<h2>Delivery Time</h2>
				<div class='form-group col-md-5'>
						<select name='delivery_time' class='form-control' required>
							<option value='10:00 - 15:00'>10:00 - 15:00</option>
							<option value='14:00 - 18:00'>14:00 - 18:00</option>
						</select>
				</div>
				<br>

                <!-- Remark -->
                <h2>Remark</h2>
                <div class='form-group'>
                    <textarea class='form-control' name='remark' rows='3' placeholder='Add your remarks here...'></textarea>
                </div>
				
				<?php include "creditcard.php"; ?>
		
			</form>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>

    </body>
</html> 