<?php 

session_start();

if (!$_SESSION["online"]) {
    header('Location: /index.php ');
}
$photo = $_SESSION['photo'];
if (empty($photo)) $photo = "anon.png";
$name = $_SESSION['name'];
$login = $_SESSION['login'];
$tab = $_GET['tab'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Новости</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Neucha&display=swap" rel="stylesheet">
        <link rel="stylesheet" media="screen,projection" href="css/bootstrap.css">  
        <link rel="stylesheet" media="screen,projection" href="css/main.css">
        <link rel="shortcut icon" href="/img/logo.png" type="image/png">
    </head>
    <body class="scroll" style="padding: 0px;">
        <div class="container">
            <div class="row">    
                <?php require_once 'left_menu.php';?>
                <div class="col" id="content" style="padding-left: 0; padding-right: 0; max-width: 675px; width: 675px; min-width: 500px;">
                    <div class="card">
                        <div class="card-header">
                            <div class="row" style="margin-left: 5px;">                           
                                <div class="spinner-grow" style="color: rgb(14, 143, 143);" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <h4><b>&#8194;Новости</b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="boxm" style="background-color: lightgray; border: 0px">                        
                        <div class="" style="padding: 0px;">
                            <div class="card" style="padding: 35px;  border-top: 0px">  
                                <form action="actions/new_post.php" method="post" enctype="multipart/form-data">
                                    <div class="row">                           
                                        <img src="img/users/<?php echo $photo; ?>" width="60px" height="60px" class="rounded-circle"  style="margin: 0px 10px;">
                                        <div class="col">
                                            <textarea type="text" autofocus maxlength="1024" name="text" class="form-control" placeholder="Есть чем поделиться?" style="border: 0px"></textarea>        
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <img src="img/img.png" width="40px" height="40px">
                                            <input type="file" name="picture" style="opacity: 0; width: 40px; height: 40px; margin-left:-40px;" accept=".jpg, .jpeg, .png">
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-outline-secondary" type="submit" id="send" style="border-radius: 30px;">Отправить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>  
                            <div style="background-color: white;"><br></div>
                            <div id="Dok"></div>        
                        </div>
                    </div>
                </div>                
                <div class="card" id="right" style="padding-left: 0; padding-right: 0; border: 0px;  max-width: 350px; width: 350px; min-width: 0px;">
                    <?php require_once 'right_menu.php';?>
                </div>
            </div>
        </div>          
        <div id="top"><small style="position: fixed; top: 5%; left: 18px">Наверх</small></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script> 
            function left() {
                if(dis0.innerHTML!=""){ 
                    right.innerHTML = "";
                    document.getElementById("left_menu").style.width = "75px"; 
                    document.getElementById("right").style.width = "0px"; 
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
                    $.post("right_menu.php", function( data ) {
                        right.innerHTML = data;
                        });
                    document.getElementById("left_menu").style.width = "225px"; 
                    document.getElementById("right").style.width = "350px"; 
                    document.getElementById("content").style.width = "675px";
                    document.getElementById("content").style.maxWidth = "675px"; 
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
            document.getElementById("hide").onclick = function () {left();};
            check_posts();
            setInterval("check_posts()", 10000);
            function check_posts() {
                $.ajax({
                url:"actions/check_posts.php",
                method:"POST",
                data:"tab=<?php echo $_GET['tab'];?>"
                }).done(function(data){
                    $('#Dok').html(data);
                })

            }
            update();
            setInterval("update()", 10000);
            function update() {
                $.post("/actions/activity.php?status=1");
            } 
            var top_show = 150; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
            var delay = 1000; // Задержка прокрутки
            $(document).ready(function() {
                document.getElementById("content").style.height = window.innerHeight;
                $(window).scroll(function () { // При прокрутке попадаем в эту функцию
                /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
                if ($(this).scrollTop() > top_show) $('#top').fadeIn();
                else $('#top').fadeOut();
                });
                $('#top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
                /* Плавная прокрутка наверх */
                $('body, html').animate({
                    scrollTop: 0
                }, delay);
                });
            });
        </script>
        <script src="js/main.js"></script>
    </body>
</html>