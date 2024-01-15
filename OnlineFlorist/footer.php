<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>    
    <style>
        /* Your CSS styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        .footer {
            background-color: #f9f9e6;
            color: #000000;
            position: scroll;
            width: 100%;
            bottom: 0;
            left: 0;
        }
        
        .footer .content {
            display: flex;
            justify-content: space-evenly;
            margin: 1.5rem;
        }
        
        .footer .content p {
            margin-bottom: 1.3rem;
        }
        
        .footer .content a {
            text-decoration: none;
            color: #000000;
        }
        
        .footer .content a:hover {
            border-bottom: 3px solid #971717;
        }
        
        .footer .content h4 {
            margin-bottom: 1.3rem;
            font-size: 19px;
        }
        
        footer {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        footer hr {
            margin: 2rem 0;
        }
        
        @media (max-width: 767px) {
            .footer .content {
                display: flex;
                flex-direction: column;
                font-size: 14px;
            }
        
            .footer {
                position: unset;
            }
        }
        
        @media (min-width: 768px) and (max-width: 1024px) {
            .footer .content,
            .footer {
                font-size: 14px;
            }
        }
        
        @media (orientation: landscape) and (max-height: 500px) {
            .footer {
                position: unset;
            }
        }
    </style>
</head>
<body>
    <!-- Your footer HTML code -->
    <div class="footer">
    <div class="content">

        <div class="social-media">
            <h4>Social</h4>
            <p><a href="https://www.facebook.com/people/Micsons-FloristBalloon/100088956023148/"><i class="fab fa-facebook"></i> Facebook</a></p>
            <p><a href="https://www.instagram.com/micsonsfloristballoon/"><i class="fab fa-instagram"></i> Instagram</a></p>
            <p><a href="https://api.whatsapp.com/send/?phone=601163187117&text&type=phone_number&app_absent=0"><i class="fab fa-whatsapp"></i> Whatsapp</a></p>
        </div>

        <div class="links">
            <h4>Quick links</h4>
            <p><a href="index.php">Home</a></p>
            <p><a href="shopping.php">Shop</a></p>
            <p><a href="about.php">About</a></p>
            <p><a href="contact.php">Contact</a></p>
            <p><a href="view_cart.php">Cart</a></p>

        </div>

        <div class="details">
            <h4 class="address">Address</h4>
            <p>
                NO83,JALAN MERDEKA<br>PERMAI 19,TAMAN MERDEKA<br>PERMAI 75350,MEAKA <br>
            </p>
            <h4 class="mobile">Mobile</h4>
            <p><a href="https://api.whatsapp.com/send/?phone=601163187117&text&type=phone_number&app_absent=0">011-6318-7117</a></p>
            <h4 class="mail">Email</h4>
            <p><a href="mailto:micsonsfloristballoon@gmail.com">micsonsfloristballoon@gmail.com</a></p>
        </div>
    </div>

    <footer>
        <hr />
        &copy; <?php echo date('Y'); ?> by micsonsfloristballoon
    </footer>
</div>

</body>
</html>
