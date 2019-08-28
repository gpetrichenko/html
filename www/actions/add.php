<?php

session_start();

require_once "db/messages_db.php";

$id = $_SESSION['id'];
$login = $_SESSION['login'];
$login_fd = $_SESSION['login_fd'];
$id_fd = $_SESSION['id_fd'];

$query = "UPDATE $login SET readit=1 WHERE id_friend='$id_fd'";
mysqli_query($linkm, $query);
$query = "UPDATE $login_fd SET readme=1 WHERE id_friend='$id'";
mysqli_query($linkm, $query);

$req = 'Location: /page.php?id='.$id_fd;
header($req);
exit();
?>