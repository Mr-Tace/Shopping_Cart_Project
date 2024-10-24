<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$user_cart = get_cart($con);
	//$search = search_item($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>
	<style>
		a:link, a:visited {
		background-color: #f44336;
		color: white;
		padding: 14px 25px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		}

		a:hover, a:active {
		background-color: red;
	}
	</style>
	
	

<a href="cart_items.php">Δες το καρότσι</a>
<a href="logout.php">Logout</a>
<br>
<br>
Καλωσόρισες, <?php echo $user_data['user_name']; ?> 
<br>
Έχεις πάρει το καρότσι με νούμερο id: <?php echo $user_cart['id']; ?>
<br>
<br>

<form method="post">
		<input type="text" name="search" required/>
		<input type="submit" value="Search"/>
	</form>
	
<br>

<br>
<br>
<br>
</body>
</html>



<?php
if (isset($_POST['search'])) {
	require "search.php";
	if (count($results) > 0){
		foreach ($results as $r) {
			echo "<div>" . $r['name'] . " στο ράφι " . $r['shelf'] . "</div>";
		}	
	} else {echo "<div>No results found.</div>";}
}
?>