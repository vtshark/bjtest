<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.07.2016
 * Time: 14:35
 */

namespace view;


class Main {
    private function head() {
        $titlePage = "Тест BeeJee";
        include "templates/head.php";
        include "templates/header.php";
    }
    private function foot() {
        include "templates/footer.php";
    }
    public function mainPage($arr_msg, $arr_error = null, $page, $info, $order, $ordMode) {
        $this->head();
        $user = isset($arr_error['user']) ? $arr_error['user'] : "";
        $email = isset($arr_error['email']) ? $arr_error['email'] : "";
        $msg = isset($arr_error['msg']) ? $arr_error['msg'] : "";
        $error = isset($arr_error['error']) ? $arr_error['error'] : null;

        include "templates/mainPage.php";
        include "templates/numPages.php";
        $this->foot();
    }

}