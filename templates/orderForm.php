<?php
    $ordArr = ["user" => "Имя", "email" => "e-mail", "date" => "Дата"];
    //var_dump($order,$ordMode);
?>
<br/>
<br/>
<div>
    Сортировка
    <select id="ordName">
        <?php foreach($ordArr as $k => $v): ?>
            <?php $buf = ($order===$k) ? "selected" : ""; ?>
            <option value="<?=$k?>" <?=$buf?> ><?=$v?></option>
        <?php endforeach; ?>
    </select>
    <select id="ordMode">
        <option value="">По возрастанию</option>
        <?php $buf = ($ordMode==="DESC") ? "selected" : ""; ?>
        <option value="DESC" <?=$buf?>>По убыванию</option>
    </select>
    <button id="btn-order" class="btn-primary">ok</button>
</div>