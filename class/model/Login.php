<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.07.2016
 * Time: 16:19
 */

namespace model;


class Login {

    function __construct() {
        $this->db = new \core\IDB();
    }

    public function login($login,$pass) {
        $what = ['login','passwd','id'];
        $where = ['login'=>$login,'passwd'=>$pass];
        $orderColumn = "";
        $desc = "";
        $limit = "";
        $res = $this->db->select("users", $what, $where, $orderColumn, $desc, $limit);

        if ($res) {
            //echo "Авторизируем";
            \model\User::autUser($res[0]['id']);
            return 1;
        } else {
            return 0;
        }
    }
    public function logout() {
        \model\User::outUser();
    }
}