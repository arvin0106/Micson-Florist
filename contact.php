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
    <title>Contact form</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>

    <style>

        body{
            background-color : ;
        }

        .form-container {
        margin: 2rem auto;
        max-width: 600px;
        padding: 0 20px;
        font-family: Arial, sans-serif;
        }

        h1 {
        text-align: center;
        margin-bottom: 20px;
        }

        h4 {
        text-align: center;
        margin-bottom: 20px;
        }

        form {
        display: flex;
        flex-direction: column;
        }

        label {
        margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
        margin-bottom: 10px;
        padding: 8px;
        width: 100%;
        border-radius: 4px;
        border: 1px solid #ccc;
        }

        input[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 265px;
        border-radius: 4px;
        cursor: pointer;
        }

        input[type="submit"]:hover {
        background-color: #0056b3;
        }
    </style>

</head>
<body>

  <?php include "navbar.php"; ?>
  <br>
  <h1>Contact Us</h1>
        <h4>Feel free to contact us and we will get back to you as soon as possible.</h4>
  <?php
    if (! empty($_POST["send"])) {
        $name = $_POST["userName"];
        $email = $_POST["userEmail"];
        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $conn = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die("Connection Error: " . mysqli_error($conn));
        $stmt = $conn->prepare("INSERT INTO tblcontact (user_name, user_email, subject,content) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $content);

        $stmt->execute();
        $message = "Your contact information is saved successfully.";
        $type = "success";
        $stmt->close();
        $conn->close();
    }
    require_once "contact-view.php";
    ?>

    <?php include "footer.php"; ?>
    
</body>
</html>
