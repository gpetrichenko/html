<?php 
session_start();
require_once "db/posts_db.php";
require_once "db/messages_db.php";
$login = $_SESSION['login'];
$id = $_SESSION['id'];
require_once "db/db.php";
    if ($_POST['tab']=='friends')
    {
        $sqli = "SELECT * FROM $login WHERE readit=1";
        $resulti = mysqli_query($linkm, $sqli) or die("Ошибка " . mysqli_error($linkm));  
        $id_friend .= "WHERE id_user=".$id;
        while($rowi = mysqli_fetch_array($resulti)){
            $id_friend.= " OR id_user=".$rowi['id_friend'];
        }
        $sqli = "SELECT * FROM news $id_friend ORDER BY id DESC";
    }
    else if (!empty($_POST['id'])) {
        $idi = $_POST['id'];
        $sqli = "SELECT * FROM news WHERE id_user=$idi ORDER BY id DESC";
    }
    else
        $sqli = "SELECT * FROM news ORDER BY id DESC";
        $resulti = mysqli_query($linkp, $sqli) or die("Ошибка " . mysqli_error($linkp));
        $none = 0;
        while($rowi = mysqli_fetch_array($resulti)){
            $none++;
            $idi = $rowi['id_user'];
            $sql3 = "SELECT * FROM users_about WHERE id_user=$idi";
            $result3 = mysqli_query($link, $sql3) or die("Ошибка " . mysqli_error($link));
            $row3 = mysqli_fetch_array($result3);
            $sql2 = "SELECT * FROM users WHERE id=$idi";
            $result2 = mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));
            $row2 = mysqli_fetch_array($result2);
            $photo = $row3['photo'];
            $text = hex2bin($rowi['text']);
            $text = str_replace('\"', '"', $text);
            $picture = $rowi['picture'];
            if($rowi['alike']!=0) $like = $rowi['alike'];
            else $like = "";
            if($rowi['adislike']!=0) $dislike = $rowi['adislike'];
            else $dislike = "";
            if (empty($photo)) $photo = "anon.png";
            echo '<div class="card" id="post" style="padding: 35px 35px 10px 35px;">  
                    <div class="row">                           
                        <a href="page.php?id='.$idi.'"><img src="img/users/'.$photo.'" width="60px" height="60px" class="rounded-circle"  style="margin: 0px 10px;"></a>
                        <div class="col">
                            <a href="page.php?id='.$idi.'"><b>'.$rowi['name'].' &#183; </b></a>
                            <a href="page.php?id='.$idi.'"><i><small>@'.$row2['login'].' <b>&#183;</b> </small></i></a>
                            <a href="#post='.$rowi['id'].'"><small class="text-muted">'.$rowi['date'].'</a></small>
                            <div>
                                <div class="card-body" style="margin-left: -20px; margin-top: -10px; word-wrap: break-word; word-break: break-all;">';
                    if (empty($text) && !empty($picture)) echo '<i><small>'.$rowi['name'].' поделился(-ась) фотографией</small></i>'; 
                    if (strlen($text) <= 300) echo '<h4>'.$text.'</h4>';                    
                    else if (strlen($text) <= 600) echo '<h5>'.$text.'</h5>';  
                    else echo '<h6>'.$text.'</h6>';
                                echo '</div></div></div></div>';
                    if (!empty($picture))
                        { 
                            echo '<center><img src="img/'.$picture.'" width="550" style="margin-bottom: 20px; margin-top: -10px;"></center>';
                        }
                        echo ' 
                    </div>
                    <div class="card" style="background-color: white; border-top: 0px;">
                        <div style="margin-left: auto; margin-right: auto; padding: 5px;">
                        <a href="actions/like_post.php?id='.$rowi['id'].'"><small class="text-mute">'.$like.' Нравится &#183;&#8194;</a></small>
                        <a href="actions/dislike_post.php?id='.$rowi['id'].'"><small class="text-mute">'.$dislike.' Не нравится&#8194;</a></small>';
                        if ($idi === $_SESSION['id']) echo '<a href="actions/delete_post.php?id='.$rowi['id'].'"><small class="text-mute">&#183; Удалить</a></small>';
            echo '</div></div>
            <div style="background-color: white;"><br></div>';
        }
        if($none == 0) {
            echo '<div class="card" style="padding: 35px;">  
                    <img src="img/empty.png" width="30%" height="30%" style="margin-left: auto; margin-right:auto;">
                  </div>'; 

        }

?>