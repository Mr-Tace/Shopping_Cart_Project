<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}


function get_cart($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from cart where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_cart = mysqli_fetch_assoc($result);
			return $user_cart;
		}
	}
}


function display_format($con) //Παίρνει πληροφορίες για το κάθε ID στο καλάθι (Όνομα, Τιμή)
{
	$query = "SELECT cart_id, product_id, name, price
	FROM cart_item LEFT JOIN product 
	ON cart_item.product_id = product.id";
	$result = mysqli_query($con,$query);
	return $result;
}


function SumPrice($con, $user_cart)
{
	$query = "SELECT SUM(price)
	FROM cart_item INNER JOIN product 
	ON cart_item.product_id = product.id
	WHERE cart_item.cart_id = ";
	$sprice = $query . $user_cart['id'];
	$sum = mysqli_query($con,$sprice);
	return $sum;
}


function search($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from products limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$search_item = mysqli_fetch_assoc($result);
			return $search_item;
		}
	}
}


function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}