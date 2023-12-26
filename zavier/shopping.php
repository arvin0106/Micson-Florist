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

<html>
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/shopping.css">
		<title>Micson Florist and Balloon</title>
		<script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
	</head>

    <body>
	<?php include "navbar.php"; ?>
        <div class='container mt-5 pb-5'>
			<h2 class='text-muted mb-4 text-center'>Shop</h2>
			<div class='row'>
				<?php foreach($data as $row): ?>
					<div class='col-md-3 mt-2'>
						<div class="card">
						  <img class="card-img-top" src="images/<?php echo $row["IMAGE"]; ?>" >
						  <div class="card-body">
							<h5 class="card-title"><?php echo $row["PRODUCT"]; ?></h5>
							<p class="card-text">
								Price RM <?php echo $row["PRICE"]; ?> 
							</p>
							<a href="view_details.php?id=<?php echo $row["PID"]; ?>" class='btn btn-primary  float-right' >View Details</a>
						  </div>
						</div>
					</div>	
				<?php endforeach; ?>
			</div>
		</div>

		<?php include "footer.php"; ?>
		
    </div>

    </body>
</html> 