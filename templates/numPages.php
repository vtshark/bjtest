<br/>

<?php
    $trueUser = \model\User::getTrueUser();
    if ($trueUser) {
        //если авторизированы - считываем кол-во всех сообщений
        $kol = \Model\Main::countAllMsg();
    } else {
        //только прошедшие модерацию
        $kol = \Model\Main::countMsg();
    }
    //var_dump($kol);
    /// на странице будет выводится по 5 сообщений

    $page1 = ($page == 1) ? $page : $page - 1;
    $page2 = ($page*5 < $kol) ? $page + 1 : $page;
    $pageEnd = ceil($kol/5);
    //var_dump($pageEnd);
    $strOrd = ($order) ? "/$order/$ordMode" : "";
?>
<div class="center">

    <?php if ($kol > 5): ?>
        <button onclick="location='<?=ROOT."main/index/1{$strOrd}"?>'"
                type="button" class="btn btn-default btn-2x">
            1
        </button>

        <button onclick="location='<?=ROOT."main/index/{$page1}{$strOrd}"?>'"
                type="button" class="btn btn-default btn-2x">
            <
        </button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <?php
        $i = ($page > 3) ? ($page - 2) : 1;
        $j = $page + 2;
        while ($i <= $pageEnd && $i <= $j ) {
            $class = ($page == $i) ? "btn btn-primary":"btn btn-default";
            echo "<button onclick=location='".ROOT  ."main/index/{$i}{$strOrd}'
                type='button' class='$class btn-2x'>".$i."</button>&nbsp;";
            $i++;
        }
        ?>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="location='<?=ROOT."main/index/{$page2}{$strOrd}"?>'"
                type="button" class="btn btn-default btn-2x">
            >
        </button>

        <button onclick="location='<?=ROOT."main/index/{$pageEnd}{$strOrd}"?>'"
                type="button" class="btn btn-default btn-2x">
            <?=$pageEnd?>
        </button>
    <?php endif;?>
</div>