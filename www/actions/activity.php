<?php

require_once "db/db.php";

session_start();

$status = $_GET['status'];
$login = $_SESSION['login'];

if ($status==1) {
    $query = "UPDATE users SET status=NOW() WHERE login='$login'";
	mysqli_query($link, $query);
}

?>