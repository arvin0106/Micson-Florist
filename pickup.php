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
        $pickupDate = mysqli_real_escape_string($con, $_POST["pickup_date"]); // Capture pickup_date
        
        // Insert contact details into 'users' table
        $sqlContact = "INSERT INTO users (FIRST_NAME, LAST_NAME, EMAIL_ADDRESS, PHONE) 
            VALUES ('{$contactFirstName}', '{$contactLastName}', '{$contactEmail}', '{$contactPhone}')";
        if($con->query($sqlContact)){
            $uid = $con->insert_id;

            // Insert pickup details into 'pickup_detail' table including the pickup_date
            $sqlPickupDetail = "INSERT INTO pickup_detail (UID, FIRST_NAME, LAST_NAME, EMAIL_ADDRESS, PHONE, REMARK, PICKUP_DATE) 
            VALUES ('{$uid}', '{$contactFirstName}', '{$contactLastName}', '{$contactEmail}', '{$contactPhone}', '{$_POST["remark"]}', '{$pickupDate}')";
           
            if($con->query($sqlPickupDetail)){
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
            /*date collum*/
            .form-control_1 {
            width: 206%; /* Fills the available space within the form-group */
            padding: 8px; /* Adjust padding as needed */
            }
        </style>

    </head>
    <body>
        <?php include "navbar.php"; ?>
        <div class='container mt-5'>
            <h2 class='text-muted mb-4'>Pick Up Details</h2>
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

                        <h2>Pickup Date</h2>
                        <div class='form-group col-md-6'>
                            <input type='date' name='pickup_date' class='form-control_1' required min='<?php echo date('Y-m-d'); ?>'>
                        </div>

                        <h2>Pickup Information</h2>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Pickup Location</th>
                                    <th>Business Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="center-align-multiline">
                                    <br><br><br><br>
                                    <b>For same day order placed after  <br>
                                    11am,can pickup between 2pm-6pm. <br>
                                    Sunday close at 4pm</b><br>
                                    <br><br>
                                    NO83, JALAN MERDEKA<br>
                                    PERMAI 19, TAMAN MERDEKA<br>
                                    PERMAI 75350, MEAKA
                                </td>

                                    <td>
                                        <table>
                                            <tr>
                                                <td>Monday</td>
                                                <td>09:00 - 18:00</td>
                                            </tr>
                                            <tr>
                                                <td>Tuesday</td>
                                                <td>09:00 - 18:00</td>
                                            </tr>
                                            <tr>
                                                <td>Wednesday</td>
                                                <td>09:00 - 18:00</td>
                                            </tr>
                                            <tr>
                                                <td>Thursday</td>
                                                <td>09:00 - 18:00</td>
                                            </tr>
                                            <tr>
                                                <td>Friday</td>
                                                <td>09:00 - 18:00</td>
                                            </tr>
                                            <tr>
                                                <td>Saturday</td>
                                                <td>09:00 - 18:00</td>
                                            </tr>
                                            <tr>
                                                <td>Sunday</td>
                                                <td>09:00 - 15:00</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Remark -->
                        <h2>Remark</h2>
                        <div class='form-group'>
                            <textarea class='form-control' name='remark' rows='3' placeholder='Add your remarks here...'></textarea>
                        </div>

                    
                    <?php include "creditcard.php"; ?>

                </div>
             </form>
            </div>
        </div>

        <?php include "footer.php"; ?>

    </div>

    </body>
</html>
