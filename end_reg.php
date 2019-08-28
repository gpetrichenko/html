<?php
session_start();

require_once "actions/db/db.php";
require_once "actions/salt.php";

$login = $_SESSION['login'];
$sql = "SELECT * FROM users WHERE login='$login'";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
$myrow = mysqli_fetch_array($result);

if (mysqli_num_rows($result) == 0) {
    header('Location: /index.php?error=11 ');  
    exit();
}

$id = $myrow['id'];
$fn = $_POST['fnInput'];
$sn = $_POST['snInput'];
$dof = $_POST['dofInput'];
$phone = $_POST['phoneInput'];
$email = $_POST['emailInput'];
$country = $_POST['countryInput'];
$city = $_POST['cityInput'];

if(isset($_FILES['photoInput']) && $_FILES['photoInput']['name'] != '') {
    $check = can_upload($_FILES['photoInput']);
    
    if($check === true){
      // загружаем изображение на сервер
      make_upload($_FILES['photoInput']);
    }
    else{
        $err = 'Location: /actions/reg_form.php?error='.$check;
        header($err);  
        exit();
	}	
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $_FILES['photoInput']['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// формируем уникальное имя картинки: случайное число и name
    $name = hash('md2', $_FILES['photoInput']['name']).'.'.$mime;
  }
function can_upload($file){
	// если имя пустое, значит файл не выбран
    if($file['name'] == '')
		return 'Вы не выбрали файл.';
	
	/* если размер файла 0, значит его не пропустили настройки 
	сервера из-за того, что он слишком большой */
	if($file['size'] == 0)
		return $file['name'];
	
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// объявим массив допустимых расширений
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
	
	// если расширение не входит в список допустимых - return
	if(!in_array($mime, $types))
		return 'Недопустимый тип файла.';
	
	return true;
  }
  
  function make_upload($file){	
	$path = 'img/users/';      
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// формируем уникальное имя картинки: случайное число и name
	$name = hash('md2', $file['name']).'.'.$mime;
	$targetPath = $path . $name;
	move_uploaded_file($file['tmp_name'], $targetPath);
  }

$sql = "INSERT INTO users_about (`id_user`, `fn`, `sn`, `dof`, `phone`, `email`, `country`, `city`, `photo`) VALUES('$id','$fn','$sn','$dof','$phone','$email','$country','$city', '$name')";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
if ($result==true) {
    header('Location: /index.php?error=01 '); 
    exit();
} else {
    header('Location: /actions/reg_form.php?error=Ошибка сервера ');  
    exit();
}
?>