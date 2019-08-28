<?php
session_start();

require_once "db/db.php";
require_once "salt.php";

$login = $_POST['loginInput'];
$_SESSION['login']=$login; 
$password = $_POST['passInput'];

$sql = "SELECT * FROM users WHERE login='$login'";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
$myrow = mysqli_fetch_array($result);
if (empty($myrow['id'])) {
    header('Location: /index.php?error=10 ');
    exit();
} 
$id = $myrow['id'];
$sql2 = "SELECT * FROM users_about WHERE id_user=$id";
$result2 = mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
$row2 = mysqli_fetch_array($result2);

if ($myrow['pass']==md5(md5($myrow['salt']).md5($password))) {
    if (mysqli_num_rows($result2) != 0) {
        $_SESSION['id']=$myrow['id']; 
        $_SESSION['name'] = $row2['fn'] . ' ' . $row2['sn'];
        $_SESSION['online']=1;
        $_SESSION['photo']=$row2['photo'];
        if(empty($_POST['cookieSafe'])) {
            $key = generateSalt();
            setcookie('login', $user['login'], time()+60*60*24*30);
            setcookie('key', $key, time()+60*60*24*30);
            $query = "UPDATE users SET cookie='$key', startTime=NOW() WHERE login='$login'";
            mysqli_query($link, $query);
        }
        header('Location: /news.php ');
        exit();
    } else {
        header('Location: /reg_form.php ');
        exit();
    }
} else {
    header('Location: /index.php?error=10 ');
    exit();
} 

?>