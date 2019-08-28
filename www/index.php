<?php 

session_start();

if ($_SESSION["online"]) {
    header('Location: /news.php ');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reeply</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Underdog" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css">  
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="/img/logo.png" type="image/png">
    </head>
    <body>
        <nav class="navbar navbar-dark" style="background-color: rgb(6, 95, 95)">
            <div class="container">
                <a class="navbar-brand" href="/" style="margin-left: -5px">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;">
                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#1abc9c"><path d="M40.3125,13.4375c-2.96969,0 -5.375,2.40531 -5.375,5.375v137.0625c0,2.96969 2.40531,5.375 5.375,5.375h21.5c2.96969,0 5.375,-2.40531 5.375,-5.375v-48.375h10.03613l39.06323,51.6189c1.01588,1.34375 2.60339,2.1311 4.28845,2.1311h27.23718c2.06669,0 3.94991,-1.18468 4.84485,-3.04443c0.89494,-1.86244 0.64437,-4.06951 -0.64563,-5.68469l-37.57776,-47.005c19.31506,-5.84531 33.37854,-24.08731 33.37854,-45.04712c0,-25.93438 -20.92089,-47.03125 -46.63757,-47.03125h-39.36243h-9.01257zM40.3125,18.8125h12.48743h9.01257h39.36243c22.69325,0 41.26257,18.74531 41.26257,41.65625c0,21.70963 -16.68392,39.65297 -37.74048,41.47778l43.11548,53.92847h-27.23718l-40.67468,-53.75h-18.08814v53.75h-21.5zM61.8125,29.5625v61.8125h9.95215h23.3844c14.24375,0 25.78845,-13.83794 25.78845,-30.90625c0,-17.06831 -11.5447,-30.90625 -25.78845,-30.90625zM125.27319,34.20264c-0.68834,-0.01613 -1.38108,0.23083 -1.91589,0.74011c-1.075,1.02394 -1.11842,2.72004 -0.09448,3.79504c2.52625,2.65257 4.5837,6.87883 5.31201,9.6792c0.31444,1.21206 1.40502,2.01038 2.59827,2.01038c0.22575,0 0.45137,-0.03011 0.67712,-0.08923c1.43512,-0.37087 2.29471,-1.84027 1.92114,-3.27539c-1.06963,-4.10919 -3.78652,-9.05839 -6.61377,-12.03076c-0.51197,-0.53884 -1.19606,-0.81322 -1.8844,-0.82935zM67.1875,34.9375h27.96155c11.25525,0 20.41345,11.45413 20.41345,25.53125c0,14.07712 -9.1582,25.53125 -20.41345,25.53125h-23.3844h-4.57715zM75.25,37.625c-1.4835,0 -2.6875,1.204 -2.6875,2.6875c0,1.4835 1.204,2.6875 2.6875,2.6875h5.375c1.4835,0 2.6875,-1.204 2.6875,-2.6875c0,-1.4835 -1.204,-2.6875 -2.6875,-2.6875zM75.25,51.0625c-1.4835,0 -2.6875,1.204 -2.6875,2.6875c0,1.4835 1.204,2.6875 2.6875,2.6875h5.375c1.4835,0 2.6875,-1.204 2.6875,-2.6875c0,-1.4835 -1.204,-2.6875 -2.6875,-2.6875zM132.57458,55.3562c-1.48619,0.01344 -2.67725,1.225 -2.6665,2.7085c0.07525,9.58094 -2.79723,17.21356 -5.50623,21.15881c-0.8385,1.22281 -0.52469,2.89087 0.69812,3.73206c0.46225,0.31981 0.9929,0.47766 1.51697,0.47766c0.85731,0 1.69896,-0.41266 2.22034,-1.17053c3.17125,-4.61981 6.52911,-13.41205 6.4458,-24.23999c-0.01075,-1.4835 -1.22768,-2.56169 -2.7085,-2.66651zM75.25,64.5c-1.4835,0 -2.6875,1.204 -2.6875,2.6875c0,1.4835 1.204,2.6875 2.6875,2.6875h5.375c1.4835,0 2.6875,-1.204 2.6875,-2.6875c0,-1.4835 -1.204,-2.6875 -2.6875,-2.6875zM75.25,77.9375c-1.4835,0 -2.6875,1.204 -2.6875,2.6875c0,1.4835 1.204,2.6875 2.6875,2.6875h5.375c1.4835,0 2.6875,-1.204 2.6875,-2.6875c0,-1.4835 -1.204,-2.6875 -2.6875,-2.6875z"></path></g></g></svg>eeply</a>
                <input class="btn btn-search" name="searchText">
            </div>
        </nav>
        <p></p>
        <div class="container">                
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <h3>Reeply</h3>
                            <hr>
                            <p>Кажется покемоны что-то задумали -_-</p>
                            <hr>
                            <div class="timer">
                                <h1 class="countdown-title">До захвата планеты чебуреками</h1>
                                <div id="countdown" class="countdown">
                                    <div class="countdown-number">
                                        <span class="days countdown-time"></span>
                                        <span class="countdown-text">Дней</span>
                                    </div>
                                    <div class="countdown-number">
                                        <span class="hours countdown-time"></span>
                                        <span class="countdown-text">Часов</span>
                                    </div>
                                    <div class="countdown-number">
                                        <span class="minutes countdown-time"></span>
                                        <span class="countdown-text">Минут</span>
                                    </div>
                                    <div class="countdown-number">
                                        <span class="seconds countdown-time"></span>
                                        <span class="countdown-text">Секунд</span>
                                    </div>
                                </div>                                                    
                            </div>
                            <center><img src="img/giphy.gif" class="rounded" width="356px" height="124px" style="margin-top: -150px; opacity: 0.4"></center>               
                            <hr>                          
                        </div>
                    </div>
                </div>  
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="actions/auth.php" method="POST" class="was-validated">
                                <?php if ($_GET['error']==10) echo '<p class="error">Некорректные данные. Повторите попытку.</p>'; ?>
                                <input class="btn btn-rep form-control is-invalid" type="text" name="loginInput" placeholder="Логин, телефон или почту" value="<?php echo $_SESSION['login'];?>" required> 
                                <p></p>
                                <input class="btn btn-rep form-control is-invalid" type="password" name="passInput" placeholder="Пароль" value="<?php echo $_SESSION['pass'];?>" required> 
                                <p></p>
                                <div class="custom-control custom-switch">
                                    <form class="inline">
                                        <button class="btn btn-dark" style="background-color: rgb(6, 95, 95); width: 30%; margin-left:-35px;">Войти</button>&#8195;&#8195;&#8195;
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="cookieSafe">
                                        <label class="custom-control-label" for="customSwitch1">Чужой компьютер</label>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <form action="/actions/reg.php" method="POST" class="was-validated">
                                <?php if ($_GET['error']==22) echo '<p class="error">Пароли не совпадают. Повторите попытку.</p>'; 
                                if ($_GET['error']==11) echo '<p class="error">Некорректные данные. Повторите попытку.</p>'; 
                                if ($_GET['error']==55) echo '<p class="error">Такой логин уже существует. Повторите попытку.</p>'; 
                                if ($_GET['error']==33) echo '<p class="error">Ошибка сервера. Повторите попытку.</p>'; 
                                if ($_GET['error']==01) echo '<p class="success">Регистрация успешно завершена!</p>'; 
                                ?>
                                <h5 class="card-title">Всё ещё нет акаунта?</h5>
                                <p></p>
                                <input class="btn btn-rep form-control is-invalid" type="text" name="loginInput" placeholder="Логин" value="<?php echo $_SESSION['login'];?>" required> 
                                <p></p>
                                <input class="btn btn-rep form-control is-invalid" type="password" name="passInput" placeholder="Пароль" value="<?php echo $_SESSION['pass'];?>" required> 
                                <p></p>
                                <input class="btn btn-rep form-control is-invalid" type="password" name="passInput2" placeholder="Повторите пароль" required> 
                                <p></p>
                                <button class="btn btn-success">Продолжить регистрацию</button>
                            </form>
                        </div>
                    </div>
                </div>
                <img src="img/pokeball.png" id="pokeball" width="75px" height="75px" style="position:absolute; top: 0px; left: -100px; ">
            </div>       
        </div>
        <br>
        <script src="js/main.js"></script>
        <script>
            var hh = window.outerHeight-220;
            document.getElementById("pokeball").style.top = hh+"px"; 
            setInterval("movePokeball()", 5);
        </script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>