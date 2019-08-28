<?php

session_start();

require_once "db/db.php";
require_once "db/posts_db.php";


$id = $_GET['id'];
$query = "SELECT * FROM `news` WHERE id=$id";
$result = mysqli_query($linkp, $query);
$row = mysqli_fetch_array($result);
$path = '../img/'.$row['picture'];
if (!empty($row['picture']))
    unlink($path);
$query = "DELETE FROM `news` WHERE id=$id";
mysqli_query($linkp, $query);

$req = 'Location: /news.php';
header($req);
exit();
?>