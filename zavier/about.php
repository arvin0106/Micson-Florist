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

</head>

<body>
  
  <?php include "navbar.php"; ?>

    <!--================== Home Section Starts from Here ==================-->
    <section id="home">
        <div class="home-left">
            <img src="images/about.webp" alt="">
        </div>
        <div class="home-right">
            <h2 class="home-heading">Welcome to Micson’s Florist&Balloon</h2>
            <p class="home-para">At Micson’s Florist&Balloon, we are passionate about creating beautiful floral 
                arrangements and eye-catching balloon displays that bring joy to our customers. Whether you need 
                a stunning bouquet to surprise a loved one, or a unique balloon arrangement to add some fun to 
                your event, we have you covered. Our team of experienced florists and balloon artists are dedicated 
                to providing the highest quality products and services to our customers. Contact us today to 
                discuss your needs and let us help you create the perfect floral or balloon display for your 
                special occasion.
            </p>
            <p class="home-para"><b>Visit us today and let the enchantment begin!</b></p>
            <p class="home-para">
                Address: NO83,JALAN MERDEKA PERMAI 19,TAMAN MERDEKA PERMAI 75350,MEAKA
                <br>Phone: 011-6318-7117
                <br>Email: micsonsfloristballoon@gmail.com
                <br>Operating Hours: [Shop Opening Hours]
            </p>
            

            <a href="contact.php" class="btn"> Contact Us</a>
        </div>
    </section>
    <!--================== Home Section Ends Here -->

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.737793715616!2d102.23714347472688!3d2.251653197728517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e5b5c0c077b9%3A0x70125210bc3ac9f8!2sMicson%E2%80%99s%20Florist%20%26%20Balloon!5e0!3m2!1sen!2smy!4v1699274575809!5m2!1sen!2smy" width="1550" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


    <!--================== Our Team Section Starts from Here ==================-->
    <section id="our-Team">
        <h2>Our Member</h2>
        <div class="teamContainer">
            <?php
                // Define team members using an associative array
                $teamMembers = array(
                    array("name" => "Zavier Ong", "role" => "Group Leader", "image" => "images/zavier.jpg"),
                    array("name" => "Kiew Pi Wei", "role" => "Group Member", "image" => "images/piwei.jpg"),
                    array("name" => "Yap Shi Tong", "role" => "Group Member", "image" => "images/yap.jpg")
                );

                // Loop through the team members and display their details
                foreach ($teamMembers as $member) {
                    echo "<div class='team-item'>";
                    echo "<img src='" . $member['image'] . "' alt=''>";
                    echo "<h5 class='member-name'>" . $member['name'] . "</h5>";
                    echo "<span class='role'>" . $member['role'] . "</span>";
                    echo "</div>";
                }
            ?>
        </div>
    </section>
    <!--================== Our Team Section Ends Here -->

    <?php include "footer.php"; ?>
    
    </div>

</body>
</html>
