<?php 

session_start();

if (!$_SESSION["online"]) {
    header('Location: /index.php ');
}

$id_fd = $_GET['id'];
$_SESSION['id_fd'] = $id_fd;
$id = $_SESSION['id'];
$login = $_SESSION['login'];
$name = $_SESSION['name'];

$sum = ((($id*$id_fd)*($id+$id_fd)))*($id+$id_fd);
$cid = "cid_".$sum;
if ($id == $id_fd) {
    header('Location: /my_page.php ');
    exit();
}
if (empty($id_fd)) {
    header('Location: /404.php ');
    exit();
}
require_once "/actions/db/db.php";
require_once "/actions/db/messages_db.php";
$sql = "SELECT * FROM users WHERE id=$id_fd";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_array($result);

if (empty($row['id'])) {
    header('Location: /404.php ');
    exit();
}
$login_fd = $row['login'];
$_SESSION['login_fd'] = $login_fd;
$sql2 = "SELECT * FROM users_about WHERE id_user=$id_fd";
$result2 = mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
$row2 = mysqli_fetch_array($result2);

$user_status = $row['status'];
$name_fd = $row2['fn'] . ' ' . $row2['sn'];

$sql3 = "SELECT * FROM $login WHERE id_friend=$id_fd";
$result3 = mysqli_query($linkm, $sql3) or die("Ошибка " . mysqli_error($link));
if(mysqli_num_rows($result3)==0){
    $sql4 = "CREATE TABLE `messages`.`$cid` ( `id` INT NOT NULL AUTO_INCREMENT , `id_user` TEXT NOT NULL , `name` TEXT NOT NULL , `text` TEXT NOT NULL , `date` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $result4 = mysqli_query($linkm, $sql4) or die("Ошибка " . mysqli_error($link));
    $sql4 = "INSERT INTO `$login` (`id`, `chat`, `id_friend`, `name`) VALUES (NULL, '$cid', '$id_fd', '$name_fd')";
    $result4 = mysqli_query($linkm, $sql4) or die("Ошибка " . mysqli_error($link));
    $sql4 = "INSERT INTO `$login_fd` (`id`, `chat`, `id_friend`, `name`) VALUES (NULL, '$cid', '$id', '$name')";
    $result4 = mysqli_query($linkm, $sql4) or die("Ошибка " . mysqli_error($link));
} else {
$row3 = mysqli_fetch_array($result3);
}
$sqlr = "SELECT * FROM $login_fd WHERE readme=1";
$resultr = mysqli_query($linkm, $sqlr) or die("Ошибка " . mysqli_error($link));
$readers = mysqli_num_rows($resultr);
$sqlr = "SELECT * FROM $login_fd WHERE readit=1";
$resultr = mysqli_query($linkm, $sqlr) or die("Ошибка " . mysqli_error($link));
$read = mysqli_num_rows($resultr);
$img = $row2['photo'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $name_fd; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Underdog" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css">  
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="/img/logo.png" type="image/png">
    </head>
    <body>
        <div class="container">
            <div class="row">    
                <?php require_once 'left_menu.php';?>
                <div class="col" id="content" style="padding-left: 0; padding-right: 0; max-width: 975px; width: 975px; min-width: 500px;">
                    <div class="card">
                        <div class="card-header">
                            <div class="row" style="margin-left: -45px;"> 
                                <div class="col-2"><a href="news.php"><button class="btn" style="margin: -5px 10px;" disabled><img src="https://img.icons8.com/wired/64/000000/back.png" width="30px" height="30px"> Назад</button></a></div>
                                <div class="col-10" style="margin-left: -15px;"><h4><b><?echo $name_fd?></b></h4></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="img/users/<?php if(empty($row2['photo'])) echo 'anon.png'; else echo $row2['photo'];?>" width="225px" height="225px" class="rounded-circle">
                                </div>
                                <div class="col-3"> 
                                    <p>Логин:</p>
                                    <p>Читателей:</p>
                                    <p>Читатает:</p>
                                    <p>Последняя активность:</p>
                                    <?php 
                                    if($row3['readit']==0) echo '<form action="/actions/add.php"><button class="btn" type="submit" style="background-color: rgb(49, 255, 83); width: 200px;">Читать</button></form>';
                                    else echo '<form action="/actions/delete.php"><button class="btn" type="submit" style="background-color: rgb(255, 49, 49);  width: 200px;">Отписаться</button></form>';
                                    ?>
                                </div>                                
                                <div class="col-6">
                                    <p>@<?echo $login_fd;?></p>
                                    <p><?echo $readers;?></p>
                                    <p><?echo $read;?></p>
                                    <?php 
                                        date_default_timezone_set('Asia/Tomsk'); 
                                        $diff = strtotime (date("H:i")) - strtotime (date ("H:i", strtotime ($user_status)));
                                        if ($diff >= -120 && $diff <= 120) {echo '
                                        <div class="row">
                                            <div class="col-1">
                                                <div id="circle" style="margin-top: 5px;"></div>
                                            </div>
                                            <i style="margin-left: -5px;">online</i>
                                        </div>';} else {
                                            echo '<i style="font-size: 13px;">был(-а) в сети ';
                                            echo date ("H:i", strtotime ($user_status));
                                            echo '</i>';  
                                        }?> <p></p>  
                                    <a href="messages.php?chat=<?php echo $cid; ?>"><button class="btn" type="submit" style="background-color: rgb(217, 238, 238); width: 200px;">Написать</button></a>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: rgb(95, 202, 238);"><b>Мои мысли</b></h4>
                        </div>
                    </div>
                    <div id="Dok"></div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script>
            update();
            setInterval("update()", 10000);

            function update() {
                $.post("/actions/activity.php?status=1");
            }
            document.getElementById("hide").onclick = function () { left(); };
            function left() {
                if(dis0.innerHTML!=""){ 
                    document.getElementById("left_menu").style.width = "75px"; 
                    document.getElementById("content").style.width = "1125px"; 
                    document.getElementById("content").style.maxWidth = "1125px"; 
                    dis0.innerHTML = "";           
                    dis1.innerHTML = "";           
                    dis2.innerHTML = "";           
                    dis3.innerHTML = "";           
                    dis4.innerHTML = "";           
                    dis5.innerHTML = "";           
                    dis6.innerHTML = "";        
                    dis7.innerHTML = "";
                } else {
                    document.getElementById("left_menu").style.width = "225px"; 
                    document.getElementById("content").style.width = "975px";
                    document.getElementById("content").style.maxWidth = "975px"; 
                    dis0.innerHTML = "eeply";           
                    dis1.innerHTML = "Новости";           
                    dis2.innerHTML = "Профиль";           
                    dis3.innerHTML = "Сообщения";           
                    dis4.innerHTML = "Настройки";           
                    dis5.innerHTML = "Сервисы";           
                    dis6.innerHTML = "Выход";       
                    dis7.innerHTML = "Скрыть";
                }
            }      
            check_posts();
            setInterval("check_posts()", 10000);
            function check_posts() {
                $.ajax({
                url:"actions/check_posts.php",
                method:"POST",
                data:"id=<?php echo $id_fd;?>"
                }).done(function(data){
                    $('#Dok').html(data);
                })

            }
        </script>
        <script src="js/bootstrap.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>