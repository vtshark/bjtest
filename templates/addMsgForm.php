<?php if (isset($error) && !empty($error)): ?>
    <br/>
    <div>
        <?php foreach ($error as $val): ?>
            <?=$val; ?><br/>
        <?php endforeach; ?>
    </div>
    <hr>
<?php endif;?>

<div class="add-form">

    <form action="<?=ROOT?>main/addMsg/" method="POST" enctype="multipart/form-data">

        <input name="idMsg" id="idMsg" hidden type="text" value="">
        Имя
        <br/>
        <input name="userName" id="userName" class="form-control" type="text" value="<?=$user?>">
        <br/>

        e-mail
        <br/>
        <input name="email" id="email" class="form-control" type="text" value="<?=$email?>">
        <br/>

        Текст сообщения<br/>
        <textarea name="newMsg" id="newMsg" class="form-control"><?=$msg?></textarea>
        <br/>

        Выбор изображения
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
        <input type="file" name="userFoto" id="userFoto"/>

        <br/>
        <button type="submit" class="btn-primary">Сохранить</button>

    </form>

    <br/>
    <br/>
    <button id="preview-btn" class="btn-primary">Предварительный просмотр</button>

</div>