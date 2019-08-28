<?php

session_start();

require_once "db/messages_db.php";

$cid =  $_POST['cid'];
$id_user = $_POST['id_user'];
$name = $_POST['name'];
$text = $_POST['text'];
$text = mysqli_real_escape_string($linkm, $text);
$text = str_replace('\n', '<br>', $text);
$text = preg_replace("/\s{2,}/"," ",$text);
$text = str_replace("<","&lt;",$text);
$text = str_replace(">","&gt;",$text);
$text = str_replace("&lt;br&gt;","<br>",$text);
if ((empty($text) || $text==' ') && empty($nameP)){    
    header('Location: /news.php ');
    exit();
}
$text = bin2hex($text);
$sql = "INSERT INTO $cid (`id`, `id_user`, `name`, `text`, `date`) VALUES (NULL, $id_user, '$name', '$text', NOW())";
$result = mysqli_query($linkm, $sql) or die("Ошибка " . mysqli_error($link));

?>