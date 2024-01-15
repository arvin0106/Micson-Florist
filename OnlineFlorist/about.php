<?php 
	include "config.php";
	session_start();
	  
	include "cart.class.php";
	$cart=new Cart();
  
	$data=[];
	$sql="select * from products";
	$res=$con->query($sql);
	if($res->num_rows>0){
		while($row=$res->fetch_assoc()){
			$data[]=$row;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> About Us Page Design </title>
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
        src="https://kit.fontawesome.com/66aa7c98b3.js"
        crossorigin="anonymous"
    ></script>
    <style>
    .btn {
        display: inline-block;
        padding: 5px 110px;
        text-decoration: none;
        background-color: #ffd700; /* Light yellow color */
        color: black;
        border: 1px solid #ffd700; /* Same color as the background */
        border-radius: 15px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn:hover {
        background-color: #e5c100; /* Slightly darker yellow on hover */
        color: #fff;
    }
</style>

    
</head>

<body>
  
  <?php include "navbar.php"; ?>

    <!--================== Home Section Starts from Here ==================-->
    <section id="home">
        <div class="home-left">
            <img src="images/about.webp" alt=""><br><br>
            <a href="contact.php" class="btn"> Contact Us</a>
        </div>
        <div class="home-right">
            <h2 class="home-heading">Welcome to Micson’s Florist&Balloon</h2>
            <p class="home-para">"Our passion lies in crafting exquisite floral arrangements, captivating balloon displays, and indulgent flower soaps that enchant and delight. Nestled in the heart of Melaka, we take pride in curating stunning bouquets and distinctive balloon arrangements that bring joy to every occasion. Our specialty lies in offering luxurious flower soaps alongside our array of floral and balloon creations. Moreover, we're thrilled to provide complimentary delivery within the Melaka area for purchases exceeding RM50, ensuring your special moments are accompanied by seamless service and premium quality. Reach out to us today, and let our dedicated team help you fashion the perfect floral or balloon display for your cherished moments."
            </p>
            <p class="home-para"><b>Visit us today and let the enchantment begin!</b></p>
            <p class="home-para">
                Address: <b>NO83,JALAN MERDEKA PERMAI 19,TAMAN MERDEKA PERMAI 75350,MEAKA</b>
                <br>Phone: <b><a href="https://api.whatsapp.com/send/?phone=601163187117&text&type=phone_number&app_absent=0">011-6318-7117</a></b>
                <br>Email: <b>micsonsfloristballoon@gmail.com</b>
            </p>
            
            
        </div>
    </section>
    <!--================== Home Section Ends Here -->
    <br>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.737793715616!2d102.23714347472688!3d2.251653197728517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e5b5c0c077b9%3A0x70125210bc3ac9f8!2sMicson%E2%80%99s%20Florist%20%26%20Balloon!5e0!3m2!1sen!2smy!4v1699274575809!5m2!1sen!2smy" width="1550" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <?php include "footer.php"; ?>
    
    </div>

</body>
</html>
