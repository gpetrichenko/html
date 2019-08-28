<div class="col" id="content" style="padding-left: 0; padding-right: 0; max-width: 975px; width: 975px; min-width: 500px;">
    <?php

    date_default_timezone_set('Asia/Tomsk'); 
    $name_fd = $row['name'];
    $name = $_SESSION['name'];
    $idi = $row['id_friend'];

    $id = $_SESSION['id'];

    $sql2 = "SELECT * FROM users WHERE id='$idi'";
    $result2 = mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
    $row2 = mysqli_fetch_array($result2);

    $friend_status = $row2['status'];
    $diff = strtotime (date("H:i")) - strtotime (date ("H:i", strtotime ($friend_status))); 
    
    $sql3 = "SELECT * FROM users_about WHERE id_user=$idi";
    $result3 = mysqli_query($link, $sql3) or die("Ошибка " . mysqli_error($link));
    $row3 = mysqli_fetch_array($result3);
    $photo = $row3['photo'];
    if (empty($photo)) $photo = "anon.png";
    printf('
    <div class="card" id="boxm">
        <div class="card">
            <div class="card-header">
                <div class="row"">                    
                    <div class="col-2">
                        <a href="messages.php"><button class="btn" style="margin: -5px 10px;" disabled><img src="https://img.icons8.com/wired/64/000000/back.png" width="30px" height="30px"> Назад</button></a>                                
                    </div>
                    <div class="col-8" style="margin-top: -15px">
                        <a href="page.php?id=%s"><button class="btn btn-block" disabled><b>%s</b></button></a>', $idi, $name_fd);                               
                        if ($diff >= -120 && $diff <= 120) echo '
                        <div class="row justify-content-center" style="margin-top: -10px;">
                            <div id="circle" style="margin-right: 10px;"></div>
                            <i  style="margin-top: 3px;">online</i>
                        </div>'; else echo '
                        <div class="row justify-content-center">
                            <i style="font-size: 13px;">был(-а) в сети '.date ("H:i", strtotime ($friend_status)).'</i>
                        </div>';
                        ?>
                    </div>
                    <div class="col-2" style="margin-top: -5px">
                        <div class="row justify-content-center">
                            <a href="page.php?id=<?php echo $idi;?>"><img src="img/users/<?php echo $photo;?>" width="45px" height="45px" class="rounded-circle"></a>  
                        </div>                        
                    </div>                
                </div>
            </div>                
        </div>
            <div class="scroll" id="scroll" style="margin-right: auto; margin-left: auto; margin-bottom: auto; width: 100%;"> 
                <div id="Dok"></div>
            </div>
            <div class="input-group">
                <textarea type="text" autofocus maxlength="1024"  id="text" class="form-control" placeholder="Введите сообщение"></textarea>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="send">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        var element = document.getElementById("scroll");
        element.scrollTop = element.scrollHeight;
    };
    resize()
    document.getElementsByTagName("BODY")[0].onresize = function() {resize()};
    function resize() {
        boxm.style.height=$(window).height()+"px";
    }
    function send() { 
        text = document.getElementById("text").value;
        $.post("/actions/send.php",
        {
            id_user: <?php echo $id;?>,
            name: "<?php echo $name; ?>",
            cid: "<?php echo $chat; ?>",
            text: text
        });
        document.getElementById("text").value = "";
        check_messages();
    };
    document.getElementById("send").onclick = function() { 
         send(); setTimeout(to_buttom, 100);
    };
    $("textarea").keypress(function(event) {
        if (event.keyCode==13) {
         send(); setTimeout(to_buttom, 100);
         return false;
         }
    });
    function to_buttom () {        
        var element = document.getElementById("scroll");
        element.scrollTop = element.scrollHeight;
    }
    $("textarea").keypress(function(event) {
        if (event.keyCode==10) {
        document.getElementById("text").value += "\r\n";
        return false;
        }
    });
    check_messages();
    setInterval("check_messages()", 1000);
    function check_messages() {
    $.post("actions/check_messages.php?chat=<?php echo $chat; ?>", function( data ) {
        Dok.innerHTML = data;
	    }); }
</script>
