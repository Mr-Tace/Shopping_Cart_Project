<?php

session_start();

include("functions.php");
include("connection.php");

#$date = date("d-m-Y H:i:s");

$user_cart = get_cart($con);

$sql = "insert into user_history (cart_id, product_id) select * from cart_item where cart_id = '$user_cart[id]'";
$sql_del = "delete from cart_item where cart_id = '$user_cart[id]'";
#$sql = "delete from user_history";

if (mysqli_query($con, $sql)) {
    printf("New record created successfully\n");
	if (mysqli_query($con, $sql_del)) {
		printf("\nCart Cleared");
	} else {echo "Error: " . $sql . "
	" . mysqli_error($con);}
} else {
    echo "Error: " . $sql . "
" . mysqli_error($con);}

mysqli_close($con);

header("Location: index.php");

?>