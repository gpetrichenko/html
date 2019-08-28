
                <div class="col" id="content" style="padding-left: 0; padding-right: 0; max-width: 975px; width: 975px; min-width: 500px;">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row" style="margin-left: 5px;">                           
                                        <div class="spinner-grow" style="color: rgb(14, 143, 143);" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <h4><b>&#8194;Сообщения</b></h4>
                                    </div>
                                </div>
                            </div>
                            <input class="list-group-item list-group-item-action">
                            <div class="list-group">    
                            <?php 
                                $sql = "SELECT * FROM $login";
                                $result = mysqli_query($linkm, $sql) or die("Ошибка " . mysqli_error($link));  
                                while ($row = mysqli_fetch_array($result)) {
                                    $chat = $row['chat'];  
                                    $sql2 = "SELECT * FROM $chat ORDER BY id DESC";   
                                    $result2 = mysqli_query($linkm, $sql2) or die("Ошибка " . mysqli_error($link));  
                                    $row2 = mysqli_fetch_array($result2);
                                    $idi = $row['id_friend'];
                                    $sql3 = "SELECT * FROM users_about WHERE id_user=$idi";
                                    $result3 = mysqli_query($link, $sql3) or die("Ошибка " . mysqli_error($link));
                                    $row3 = mysqli_fetch_array($result3);
                                    $photo = $row3['photo'];
                                    if (empty($row2['text'])) {$text = "У вас пока нет сообщений с этим пользователем!"; $date="";}
                                    else {     
                                        $date = $row2['date'];                               
                                        $text = $row2['text'];
                                        $text = hex2bin($text); 
                                        $text = str_replace('<br>', ' ', $text);
                                        $text = str_replace('\"', '"', $text);
                                        if (strlen($text) >= 120){
                                            $text = substr($text,0,120);
                                            $text .= "...";
                                        }
                                        if ($row2['id_user'] === $id)
                                            $text = "<i>Вы: ".$text."</i>";
                                    } 
                                    if (empty($photo)) $photo = "anon.png";
                        printf('<a href="messages.php?chat=%s" class="list-group-item list-group-item-action">   
                                    <div class="row">                             
                                        <img src="img/users/%s" width="60px" height="60px" class="rounded-circle"  style="margin-left: 10px;">
                                        <div class="col">
                                            <div class="d-flex w-100 justify-content-between" style="margin-top: 10px;">
                                                <b>%s</b>
                                                <small class="text-muted">%s</small>
                                            </div>
                                            <p>%s</p>
                                        </div>
                                    </div>
                                </a>',
                                    $chat, $photo, $row['name'], $date, $text);}
                                    ?> 
                            </div>
                </div>