<?php

session_start();

require_once "db/db.php";
require_once "db/posts_db.php";


$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = mysqli_query($linkp, $sql);
$row = mysqli_fetch_array($result);
$dislike = $row['adislike'] + 1;
$sql = "UPDATE news SET `adislike`=$dislike WHERE id=$id";
mysqli_query($linkp, $sql);

$req = 'Location: /news.php';
header($req);
exit();
?>