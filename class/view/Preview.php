<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 09.07.2016
 * Time: 11:58
 */

namespace view;


class Preview {
    public function showForm($user,$email,$msg,$date) {
        include "templates/preview.php";
    }

}