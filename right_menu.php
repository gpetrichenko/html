<div class="card-body" style="border: 0px; background-color: white;">     
    <input type="text" class="btn" style="background-color: rgb(240,240,240); border-radius: 30px; width: 100%;" placeholder="Что хотите найти?"><br><br>
    <div class="card" style="background-color: rgb(240,240,240); border-radius: 30px; border: 0px;">
        <div class="card-header" style="background-color: rgb(240,240,240); border-radius: 30px 30px 0px 0px; border-button: 0px;">
            <h3><b>Лента</b><h3>
        </div>
        <div class="card-body" style="background-color: rgb(240,240,240); border-radius: 30px; border: 0px;">
            <a href="?tab=all" <?php if ($_GET['tab']==="all" || $_GET['tab']==="") echo 'class="active-link"';?>><h4>Новости</h4></a><hr>
            <a href="?tab=friends" <?php if ($_GET['tab']==="friends") echo 'class="active-link"';?>><h4>Друзья</h4></a><hr>
            <a href="?tab=random" <?php if ($_GET['tab']==="random") echo 'class="active-link"';?>><h4>Рандом</h4></a>
        </div>
    </div>    
</div> 