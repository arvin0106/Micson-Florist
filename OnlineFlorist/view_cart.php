<?php
	include "config.php";
	session_start();
	
	include "cart.class.php";
	$cart=new Cart();
?>
<html>
	<head>
        <title>Cart</title>
		
		<link rel="stylesheet" href="css/view_cart.css">
		<script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<style>
			.btn-remove {
			display: inline-block;
			padding: 5px 10px;
			background-color: #FF7F7F; /* Red color */
			color: black;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.3s ease;
			}

			.btn-remove:hover {
			background-color: #cc0000; /* Darker red color on hover */
			}
		</style>
    </head>
    <body>
		<?php include "navbar.php"; ?>
        <div class='container mt-3'>
			<div class='row'>
				<div class='col-md-12'>
					<h2 class='text-muted mb-4'>Cart Items</h2>
					<?php if($cart->get_cart_total()>0): ?>
						
					<table class='table table-striped table-bordered'>
						<thead>
							<tr>
								<th colspan='2' class='text-center'>Product</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Total</th>
								<th>Action	</th>
							</tr>
						</thead>
						<tbody>
						<?php $items=$cart->get_all_items(); ?>
						<?php foreach($items as $item): ?>
							<tr>
								<td><img src='images/<?php echo $item["img"];?>' style='height:80px;' ></td>
								<td><?php echo $item["name"];?></td>
								<td>RM <?php echo $item["price"];?></td>
								<td>
									<input type='number' value='<?php echo $item["qty"];?>' class='qty' pid='<?php echo $item["id"]; ?>' min='1' max='10' oninput="this.value = !!this.value && Math.abs(this.value) <= 10 ? Math.abs(this.value) : 1;">
								</td>								
								<td>RM <span class='row_total'><?php echo $item["total"];?></span></td>
								<td><a href='remove.php?id=<?php echo $item["id"]; ?>' onclick="return confirm('Are You Sure?')" class="btn-remove">Remove</a></td>

							</tr>
						<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan='3'><a href='shopping.php' class="btn btn-success">Continue Shopping</a></td>
								<th>Total</th>
								<th>RM  <span id='total'><?php echo $cart->get_cart_total();?></span></th>
								<td><a href='checkout.php' class='btn btn-info' id='deliveryButton'>Delivery</a>
								<a href='pickup.php' class='btn btn-info'>Pick Up</a></td>
							</tr>
						</tfoot>
					</table>
					<?php else: ?>
						<div class='alert alert-warning'>Cart is empty...</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php include "footer.php"; ?>
		
    </div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".qty").change(function(){
				update_cart($(this));
			});

			$(".qty").keyup(function(){
				update_cart($(this));
			});

			$("#deliveryButton").click(function(){
				// Get the current total
				let currentTotal = parseFloat($("#total").text());

				// Add additional RM 5 for delivery
				let updatedTotal = currentTotal + 5;

				// Update the total displayed
				$("#total").text(updatedTotal);
			});

			function update_cart(cls){
				var pid = $(cls).attr("pid");
				var q = $(cls).val();

				$.ajax({
					url: "ajax_update_cart.php",
					type: "post",
					data: {id: pid, qty: q},
					success: function(res){
						console.log(res);
						var a = JSON.parse(res);
						$("#total").text(a.total);
						$(cls).closest("tr").find(".row_total").text(a.row_total);
					}
				});
			}
		});

	</script>

    </body>
</html> 