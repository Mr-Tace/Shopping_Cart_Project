<?php

//$user_name=$_POST["user_name"];
$product_id=$_POST["product_id"];
$cart_id=$_POST["cart_id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";
$test = 100;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "insert into cart_item (product_id, cart_id) values ($product_id, $cart_id)";
//$sql = "insert into users (user_name) values ($user_name)";

echo($sql);

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "
" . mysqli_error($conn);
}

mysqli_close($conn);
?>
