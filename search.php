<?php

define("DB_HOST", "localhost");
define("DB_NAME", "database");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");


$pdo = new PDO(
	"mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
	DB_USER, DB_PASSWORD, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	]
);

$stmt = $pdo->prepare("SELECT * FROM product WHERE name LIKE ? OR shelf LIKE ? ORDER BY id DESC");
$stmt->execute([
	"%".$_POST['search']."%", "%".$_POST['search']."%"
]);
$results = $stmt->fetchAll();
?>