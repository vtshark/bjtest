<?php
    $trueUser = \model\User::getTrueUser();
    if (!$trueUser): ?>

    <a href="<?=ROOT?>login/">Авторизация</a>

<?php else: ?>

    <a href="<?=ROOT?>login/logout">Выход</a>
<?php endif;
    include "templates/orderForm.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 div-msg">
            <?php if (!empty($arr_msg)): ?>

                <?php foreach ($arr_msg as $val): ?>
                    <div id="div-msg<?=$val['id']?>" class="div-tr">
                        <b><?=$val['user']?> : <?=$val['email']?> : <?=$val['date']?></b>
                        <br/>
                        <?=$val['msg']?>
                        <br/>
                        <?= \core\Img::getFoto($val['id'],$val['img']); ?>
                        <br/>
                        <br/>
                        <?php if ($trueUser): ?>

                            <button id="moder<?=$val['id']?>" class="btn-success" title="Одобрить">
                                <i class='fa fa-plus' id="moder<?=$val['id']?>"></i>
                            </button>

                            <button id="not-moder<?=$val['id']?>" class="btn-warning" title="Отклонить">
                                <i class='fa fa-minus' id="not-moder<?=$val['id']?>"></i>
                            </button>

                            <button id="edit<?=$val['id']?>" class="btn-primary edit-btn" title="Корректировать">
                                <i class='fa fa-edit' id="edit<?=$val['id']?>"></i>
                            </button>

                            <button id="del<?=$val['id']?>" class="btn-danger" title="Удалить">
                                <i class='fa fa-close' id="del<?=$val['id']?>"></i>
                            </button>

                            <?php if (!$val['adm_moder']): ?>
                                <div id="div-moder<?=$val['id']?>">отклонен</div>
                            <?php else: ?>
                                <div id="div-moder<?=$val['id']?>">принят</div>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ($val['adm_edited']): ?>
                            <div>изменен администратором</div>
                        <?php endif; ?>

                    </div>
                    <hr>
                <?php endforeach; ?>

            <?php endif;?>
        </div>
        <?=$info?>
        <div class="col-lg-5 col-md-5 col-sm-5">
            <?php include "addMsgForm.php"; ?>
        </div>

    </div>
</div>

<div id="div-preview" class="div-msg div-tr">
    preview
</div>