<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.07.2016
 * Time: 16:19
 */

namespace view;


class Login {
    private function head() {
        $titlePage = "Авторизация";
        include "templates/head.php";
        include "templates/header.php";
    }
    private function foot() {
        include "templates/footer.php";
    }
    public function showLogin($data) {
        extract($data);
        $this->head();
        include "templates/loginForm.php";
        $this->foot();
    }
}