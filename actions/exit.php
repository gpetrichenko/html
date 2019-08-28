<?php
session_start();
$login = $_SESSION['login'];
session_destroy();

require_once "db/db.php";
require_once "salt.php";

if (!$_COOKIE["online"]) {
    header('Location: /index.php ');
    exit();
} 

$query = "UPDATE users SET stopTime=NOW() WHERE login='$login'";
mysqli_query($link, $query);

setcookie('online', '', time());
header('Location: /index.php ');
exit();


?>