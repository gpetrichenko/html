<?php

session_start();

require_once "db/db.php";
require_once "db/posts_db.php";


$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = mysqli_query($linkp, $sql);
$row = mysqli_fetch_array($result);
$like = $row['alike'] + 1;
$sql = "UPDATE news SET `alike`=$like WHERE id=$id";
mysqli_query($linkp, $sql);

$req = 'Location: /news.php';
header($req);
exit();
?>