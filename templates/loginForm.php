
<div class = "container">
    <div class = "row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <img src="<?=ROOT?>static/img/ninja.png">
        </div>
        <div class = "col-lg-4 col-md-5 col-sm-6 col-xs-8">
            <a href="<?=ROOT?>">На главную</a>
            <br/><br/>
            <?php if (isset($error) && !empty($error)): ?>
                <div class="div-panel">
                    <?php foreach ($error as $val): ?>
                        <?=$val; ?><br/>
                    <?php endforeach; ?>
                </div>
                <hr>
            <?php endif; ?>
            <form action="<?=ROOT?>login" method ="POST">
                <input name="login" class="form-control" type="text" placeholder="Имя пользоваля" value="<?=$login?>"><br/>
                <input name="password" class="form-control" type="password" placeholder="Пароль"><br/><br/>
                <button class='btn btn-primary' type="submit">Войти</button>
            </form>
        </div>
    </div>
</div>