<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.07.2016
 * Time: 16:18
 */

namespace Controller;


use core\Controller;

class Login extends Controller {

    public function index()  {
        //если пользователь авторизирован перенапрявляем на главную
        if ( !\model\User::getTrueUser() ) {
            $res = [];
            $error = [];
            $login = $pass = "";

            if (isset($_POST['login'])) {
                $login = htmlspecialchars($_POST['login']);
                $pass = $_POST['password'];
                if (!$login) {
                    $error[] = "Введите логин!";
                }

                if (!$pass) {
                    $error[] = "Введите пароль!";
                }
                if (!$error) {
                    $this->model = new \model\Login();
                    $res = $this->model->Login($login, $pass);
                    //var_dump($res);
                    if (!$res) {
                        $error[] = "Не верные имя пользователя или пароль!";
                    } else {
                        header("location:" . ROOT);
                    }
                }
            }
            $res = compact('error', 'login');
            $this->view = new \view\Login();
            $this->view->showLogin($res);
        } else {

            header("location:" . ROOT);
        }
    }

    public function logout() {
        $this->model = new \model\Login();
        $this->model->logout();
        header("location:" . ROOT);
    }
}