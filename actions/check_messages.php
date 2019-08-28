<?php 
require_once "/db/messages_db.php";
require_once "/db/db.php";
        $chat = $_GET['chat'];
        $sqli = "SELECT * FROM $chat";
        $resulti = mysqli_query($linkm, $sqli) or die("Ошибка " . mysqli_error($linkm));
        $temp_id = 0;
        $full = "";
        while($rowi = mysqli_fetch_array($resulti)){
            $text=$rowi['text'];
            $text = hex2bin($rowi['text']);
            $text = str_replace('\"', '"', $text);
            if($rowi['id_user'] === $temp_id)
                $full .= '<p style="margin-left: 77px;">'.$text.'</p>';
            else {
                $idi = $rowi['id_user'];
                $sql3 = "SELECT * FROM users_about WHERE id_user=$idi";
                $result3 = mysqli_query($link, $sql3) or die("Ошибка " . mysqli_error($link));
                $row3 = mysqli_fetch_array($result3);
                $photo = $row3['photo'];
                if (empty($photo)) $photo = "anon.png";
                $full .= '<br><div class="row justify-content-between"><div class="col-1"><a href="page.php?id='.$idi.'"><img src="img/users/'.$photo.'" width="65px" height="65px" class="rounded-circle"></a></div><div class="col-9"><a href="page.php?id='.$idi.'"><b>'.$rowi['name'].'</b></a></div><div class="col-2"><i style="font-size: 12px;">'.$rowi['date'].'</i></div></div><p style="margin-left: 77px; margin-top: -40px;">'.$text.'</p>';
            }
            $temp_id = $rowi['id_user'];
        }
        echo $full;
?>