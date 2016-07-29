<?php

namespace Controller;

use core\Controller;

///конроллер по умолчанию///
class Main extends Controller {

    public function index($param = null)  {

        $page = isset($param[0]) ? $param[0] : 1;
        $order = isset($param[1]) ? $param[1] : "date";
        $ordMode = isset($param[2]) ? $param[2] : "DESC";
        $this->showMainPage(null,$page,null,$order,$ordMode);
    }

    public function addMsg() {
        $page = 1;
        $order = "date";
        $ordMode = "DESC";
        $res = null;
        $info = "";
        if (isset($_POST['newMsg'])) {

            $error = [];

            $user = isset($_POST['userName']) ? htmlspecialchars($_POST['userName']) : "";
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
            $msg = isset($_POST['newMsg']) ? htmlspecialchars($_POST['newMsg']) : "";

            if (!$user) {
                $error[] = "Введите имя!";
            }
            if ((!$email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $error[] = "Не корректный e-mail!";
            }
            if (!$msg) {
                $error[] = "Введите текст сообщениея!";
            }

            $res = compact('error','user','email','msg');

            $this->model = new \model\Main();
            if (!$error) {
                if (!$_POST['idMsg']) {
                    $foto = !empty($_FILES['userFoto']['name']) ? $_FILES['userFoto'] : null;
                    $this->model->addMsg($user,$email,$msg,$foto);
                    $info = "Сообщение сохранено и будет доступно после проверки";
                } else {
                    $this->model->editMsg($_POST['idMsg'],$user,$email,$msg);
                }

                $res['user'] = $res['email'] = $res['msg'] = "";
            }

        }
        $this->showMainPage($res,$page,$info,$order,$ordMode);
    }

    public function delMsg() {
        if (isset($_POST['id']) && \model\User::getTrueUser() ) {
            $this->model = new \model\Main();
            $this->model->delMsg($_POST['id']);

        }
    }

    public function moder() {
        if (isset($_POST['id']) && \model\User::getTrueUser() ) {
            $this->model = new \model\Main();
            $this->model->moder($_POST['id'],1);
        }
    }

    public function notmoder() {
        if (isset($_POST['id']) && \model\User::getTrueUser() ) {
            $this->model = new \model\Main();
            $this->model->moder($_POST['id'],0);
        }
    }

    public function getmsg() {
        if (isset($_POST['id']) && \model\User::getTrueUser() ) {
            $this->model = new \model\Main();
            $res = $this->model->getMsg($_POST['id']);
            $res = json_encode($res);
            echo $res;
        }
    }
    private function showMainPage($error,$page,$info,$order,$ordMode) {
        $this->model = new \model\Main();
        //если не авторизированы то показываем сообщения не пройденные модерацию
        if (!\model\User::getTrueUser()) {
            $arr_msg = $this->model->getMessages($page,$order,$ordMode);
        } else {
            $arr_msg = $this->model->getAllMessages($page,$order,$ordMode);
        }

        $this->view = new \view\Main();
        $this->view->mainPage($arr_msg,$error,$page,$info,$order,$ordMode);
    }
}