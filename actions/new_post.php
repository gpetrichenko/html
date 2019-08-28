<?php

session_start();

require_once "db/posts_db.php";

$id_user = $_SESSION['id'];
$name = $_SESSION['name'];
$text = $_POST['text'];
$text = mysqli_real_escape_string($linkp, $text);
$text = str_replace('\r\n', '<br>', $text);
$text = preg_replace("/\s{2,}/"," ",$text);
$text = str_replace("<","&lt;",$text);
$text = str_replace(">","&gt;",$text);
$text = str_replace("&lt;br&gt;","<br>",$text);
if ((empty($text) || $text==' ')&& empty($nameP)){    
    header('Location: /news.php ');
    exit();
}
$text = bin2hex($text);
if(isset($_FILES['picture']) && $_FILES['picture']['name'] != '') {
    $check = can_upload($_FILES['picture']);
    
    if($check === true){
      // загружаем изображение на сервер
      make_upload($_FILES['picture']);
    }
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $_FILES['picture']['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// формируем уникальное имя картинки: случайное число и name
    $nameP = hash('md2', $_FILES['picture']['name']).'.'.$mime;
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
	$path = '../img/';      
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// формируем уникальное имя картинки: случайное число и name
	$nameP = hash('md2', $file['name']).'.'.$mime;
	$targetPath = $path . $nameP;
	move_uploaded_file($file['tmp_name'], $targetPath);
  }

$sql = "INSERT INTO news (`id`, `id_user`, `name`, `text`, `date`, `picture`) VALUES (NULL, $id_user, '$name', '$text', NOW(), '$nameP')";
$result = mysqli_query($linkp, $sql) or die("Ошибка " . mysqli_error($linkp));
 
header('Location: /news.php ');
exit();
?>