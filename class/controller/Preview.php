<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 09.07.2016
 * Time: 11:52
 */

namespace Controller;


use core\Controller;

class Preview extends Controller {

    function index() {
        if (isset($_POST['msg'])) {
            $this->view = new \view\Preview();
            $user = isset($_POST['user']) ? htmlspecialchars($_POST['user']) : "";
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
            $msg = isset($_POST['msg']) ? htmlspecialchars($_POST['msg']) : "";
                $date = date("Y-m-d H:i:s");

            $this->view->showForm($user,$email,$msg,$date);
        }
    }
}