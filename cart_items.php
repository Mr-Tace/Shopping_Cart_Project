<?php
session_start();

include("connection.php");
include("functions.php");

$result = display_format($con);
$user_cart = get_cart($con);
$sum = SumPrice($con, $user_cart);

//echo $user_cart['id']; //Για debugging

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>Cart Items</title>
</head>
<body class="bg-dark">
	<div class="container">
		<div class="row mt-5">
			<div class="col">
				<div class="card mt-5">
					<div class="card-header">
						<h2 class="display-6 text-center">Cart Items</h2>
					</div>
					<div class="card-body">
						<table class="table table-bordered text-center">
							<tr class="bg-dark text-white">
								<td> Cart_ID </td>
								<td> Product_ID </td>
								<td> Name </td>
								<td> Price </td>
							
							</tr>
							<tr>
							<?php
							
								while($row = mysqli_fetch_assoc($result)){
									if($row['cart_id'] === $user_cart['id']){
									
							?>
								<td><?php echo $row['cart_id']; ?></td>
								<td><?php echo $row['product_id']; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['price']; ?></td>
								
							</tr>
							<?php
									}
								}
								
								$srow = mysqli_fetch_assoc($sum);
								echo 'Products in Cart: ';
								echo $srow['SUM(price)'];
								echo ' €';
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<a href="index.php">Home</a>
</body>
</html>