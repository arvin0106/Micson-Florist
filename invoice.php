<?php
include "config.php";
session_start();

if (isset($_SESSION['ORDER_NO'], $_SESSION['ORDER_DATE'], $_SESSION['CustomerID'])) {
    $Ordercode = $_SESSION['ORDER_NO'];
    $method = $_SESSION['ORDER_DATE'];
    $UID = $_SESSION['CustomerID'];

    // Fetch order details
    $query = "SELECT * FROM orders WHERE ORDER_NO='$ORDER_NO' AND UID='$UID'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // ... (other order details)

        // Update order status to 'completed'
        $updateQuery = "UPDATE orders SET STATUS='Completed' WHERE ORDER_NO='$ORDER_NO' AND UID='$UID'";
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Order status updated successfully
            echo "Order completed!";
            // Here you might redirect the user to a thank-you page or show a success message.
        } else {
            // Handle error updating order status
            echo "Error updating order status!";
        }
    } else {
        // Handle error if order not found
        echo "Order not found!";
        exit();
    }
} else {
    // Handle error if session variables not set
    echo "Session variables not set!";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Invoice</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
        .BTN
        {
            height: 30px;
            padding-left: 6px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .button
        {
            display: flex;
            justify-content: center;
            padding-left: 6px;
        }
        </style>
	</head>

	<body>
            
    <div class="invoice-box">
    <table>
        <!-- Header -->
        <tr class="top">
            <td colspan="5">
                <table>
                    <tr>
                        <td class="title">
                            <img src="images/Micson.png" alt="Company logo" style="width: 30%; max-width: 300px" />
                        </td>
                        <td>
                            Invoice #: <?php echo $_GET["order_no"];?><br />
                            Payment Date: <?php echo $row['ORDER_DATE'] ?><br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Addresses -->
        <tr class="information">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            From:<br />
                            NO83, JALAN MERDEKA<br />
                            PERMAI 19, TAMAN MERDEKA<br />
                            PERMAI 75350, MELAKA.
                        </td>
                        <td>
                            TO:<br />
                            <?php echo $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'] ?><br />
                            <?php echo $row['EMAIL_ADDRESS'] ?><br/>
                            <?php echo $row['PHONE'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Items -->
        <tr class="heading">
            <td>Item</td>
            <td>Price</td>
            <td>QTY</td>
            <td>Subtotal</td>
        </tr>
        <?php
        // Loop through order details
        while ($ro = mysqli_fetch_assoc($resu)) {
            ?>
            <tr class="item">
                <td><?php echo $ro['PNAME'] ?></td>
                <td><?php echo number_format($ro['PRICE'], 2); ?></td>
                <td><?php echo $ro['QTY'] ?></td>
                <td><?php echo number_format(($ro['PRICE'] * $ro['QTY']), 2); ?></td>
            </tr>
        <?php }; ?>

        <!-- Total -->
        <tr class="total">
            <td colspan="3"></td>
            <td>Total:</td>
            <td>RM <?php echo number_format($all, 2) ?></td>
        </tr>
    </table>
</div>

        <br>
        <br>
        <br>
        <div class="button">
            <button class="BTN" onclick="backtomenu()" id="hide1">Back To Menu</button>
            <br>
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
	</body>
</html>