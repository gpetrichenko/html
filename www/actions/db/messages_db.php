<?php
$host='localhost';
$database = "messages";
$user='root';
$password='1234567890';
$linkm = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno())
{
  echo 'Ошибка подлючения к базе данных ('.mysqli_connect_errno().'): ('.mysqli_connect_error().')';
  exit();
}
?>
