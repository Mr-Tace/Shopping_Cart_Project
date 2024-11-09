<?php
session_start();

include("connection.php");
include("functions.php");

$result = history_display_format($con);
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
	<title>User History</title>
</head>
<body class="bg-dark">
	<div class="container">
		<div class="row mt-5">
			<div class="col">
				<div class="card mt-5">
					<div class="card-header">
						<h2 class="display-6 text-center">User History</h2>
					</div>
					<div class="card-body">
						<table class="table table-bordered text-center">
							<tr class="bg-dark text-white">
								<td> Date</td>
								<td> Product ID</td>
								<td> Cart ID</td>
								<td> Name </td>
								<td> Price </td>
							
							</tr>
							<tr>
							
							<?php
							
								while($row = mysqli_fetch_assoc($result)){
									if($row['cart_id'] === $user_cart['id']){
									
							?>
								<td><?php echo $row['date']; ?></td>
								<td><?php echo $row['product_id']; ?></td>
								<td><?php echo $row['cart_id']; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['price']; ?></td>
								
							</tr>
							
							<?php
									}
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<br>
	
	<a href="index.php">Home</a>
	<a href="cart_items.php">Cart</a>
	
</body>
</html>