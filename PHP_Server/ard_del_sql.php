<?php

$product_id=$_POST["product_id"];

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


$sql = "DELETE FROM cart_item WHERE product_id = $product_id";

if (mysqli_query($conn, $sql)) {
echo "Record deleted successfully";
} else {
echo "Error deleting record: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
