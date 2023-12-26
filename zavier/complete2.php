<?php 
    include "config.php";
    session_start();
    
    include "cart.class.php";
    $cart = new Cart();

    if (isset($_SESSION['ORDER_NO'], $_SESSION['ORDER_DATE'], $_SESSION['CustomerID'])) {
        $Ordercode = $_SESSION['ORDER_NO'];
        $method = $_SESSION['ORDER_DATE'];
        $UID = $_SESSION['CustomerID'];
        
        // Fetch order details
        $query = "SELECT * FROM orders WHERE ORDER_NO='$Ordercode' AND UID='$UID'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Fetch order items/details associated with this order
            $orderDetailsQuery = "SELECT * FROM order_details WHERE OID = '{$row['OID']}'";
            $orderDetailsResult = mysqli_query($conn, $orderDetailsQuery);

            if ($orderDetailsResult) {
                // Start HTML structure for the invoice
?>
                <html>
                <head>
                    <title>Invoice</title>
                    <!-- Add your CSS styles here -->
                    <link rel="stylesheet" href="css/complete.css">

                    <style>
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
                <?php include "navbar.php"; ?>

                    <br><br>

                    <div class='container mt-5'>
                        <h2 class='text-muted mb-4'>Order Placed Successfully</h2>
                        <br>
                        <div class='row'>
                            <div class='col-md-12'>
                                    <div class='alert alert-success'>Your Order no is #<?php echo $_GET["order_no"];?></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="invoice-box">
                        <table>
                            <!-- Header -->
                            <tr class="top">
                                <!-- Your header content -->
                                <td colspan="4">
                                    <img src="images/Micson.png" alt="Company logo" style="width: 30%; max-width: 300px" />
                                </td>
                                <td>
                                    Invoice #: <?php echo $_GET["order_no"]; ?><br />
                                    Payment Date: <?php echo $row['ORDER_DATE'] ?><br />
                                </td>
                            </tr>

                            <!-- Addresses -->
                            <tr class="information">
                                <!-- Your address information -->
                                <td colspan="2">
                                    From:<br />
                                    NO83, JALAN MERDEKA<br />
                                    PERMAI 19, TAMAN MERDEKA<br />
                                    PERMAI 75350, MELAKA.
                                </td>
                                <td colspan="3">
                                    TO:<br />
                                    <?php echo $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'] ?><br />
                                    <?php echo $row['EMAIL_ADDRESS'] ?><br/>
                                    <?php echo $row['PHONE'] ?>
                                </td>
                            </tr>

                            <!-- Items -->
                            <tr class="heading">
                                <!-- Your item headings -->
                                <td>Item</td>
                                <td>Price</td>
                                <td>QTY</td>
                                <td>Subtotal</td>
                            </tr>
                            <?php
                            // Loop through fetched order details and display them in the invoice
                            while ($ro = mysqli_fetch_assoc($orderDetailsResult)) {
                            ?>
                                <!-- Display each item -->
                                <tr class="item">
                                    <!-- Display item details in respective columns -->
                                    <td><?php echo $ro['PNAME']; ?></td>
                                    <td><?php echo number_format($ro['PRICE'], 2); ?></td>
                                    <td><?php echo $ro['QTY']; ?></td>
                                    <td><?php echo number_format(($ro['PRICE'] * $ro['QTY']), 2); ?></td>
                                </tr>
                            <?php
                            }
                            ?>

                            <!-- Total -->
                            <tr class="total">
                                <td colspan="3"></td>
                                <td>Total:</td>
                                <!-- Assuming $all contains the total amount -->
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

                    <?php include "footer.php"; ?>

                </body>
                </html>
<?php
            } else {
                echo "Error fetching order details!";
            }
        } else {
            echo "Order not found!";
            exit();
        }
    }
?>
