<?php
session_start();

require_once "db/db.php";
require_once "db/messages_db.php";
require_once "salt.php";

$login = $_POST['loginInput'];
$_SESSION['login'] = $login;
$password = $_POST['passInput'];
$password2 = $_POST['passInput2'];

if (empty($password) || empty($login)) {
    header('Location: /index.php?error=11 ');  
                    exit();
}

if ($password != $password2) {
    header('Location: /index.php?error=22 ');  
                    exit();
}

$query = 'SELECT * FROM users WHERE login="'.$login.'"';
$isLoginFree = mysqli_fetch_assoc(mysqli_query($link, $query));
if (!empty($isLoginFree)) {
    header('Location: /index.php?error=55 ');  
                    exit();
}

$salt = generateSalt();

$pass = md5(md5($salt).md5($password));

$sql = "INSERT INTO users (`login`, `pass`, `salt`) VALUES('$login','$pass','$salt')";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
if ($result==true) {
    $sql = "CREATE TABLE `messages`.`$login` ( `id` INT NOT NULL AUTO_INCREMENT , `chat` TEXT NOT NULL , `id_friend` TEXT NOT NULL , `name` TEXT NOT NULL, `readit` int(11) NOT NULL, `readme` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $result = mysqli_query($linkm, $sql) or die("Ошибка " . mysqli_error($link));
    if ($result==true) {
        header('Location: /reg_form.php '); 
        exit();
    } else {
        header('Location: /index.php?error=33 ');  
        exit();
    }
} else {
    header('Location: /index.php?error=33 ');  
    exit();
}
?>