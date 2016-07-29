<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.07.2016
 * Time: 14:31
 */

namespace model;


class Main {
    private $db;

    function __construct() {
        $this->db = new \core\IDB();
    }

    //сообщения прошедшие модерацию
    public function getMessages($page = 1, $ord = "id", $ordMode) {

        $what = "";
        $where = ['adm_moder' => 1];
        $orderColumn = $ord;
        $desc = $ordMode;
        $limit = [($page-1)*5,5];
        $res = $this->db->select("msg", $what, $where, $orderColumn, $desc, $limit);
        return $res;

    }

    //все сообщения
    public function getAllMessages($page = 1, $ord = "id", $ordMode) {

        $what = "";
        $where = "";
        $orderColumn = $ord;
        $desc = $ordMode;
        $limit = [($page-1)*5,5];
        $res = $this->db->select("msg", $what, $where, $orderColumn, $desc, $limit);
        return $res;

    }

    //выбор сообщения по id
    public function getMsg($idMsg) {

        $what = "";
        $where = ['id' => $idMsg];
        $orderColumn = "id";
        $desc = "";
        $limit = "";
        $res = $this->db->select("msg", $what, $where, $orderColumn, $desc, $limit);
        return $res[0];

    }

    //добавление сообщения
    public function addMsg($user, $email, $msg, $foto) {
        $img = $foto['name'] ? $foto['name'] : "";
        $id = $this->db->insert('msg',
            ['user' => $user, 'email' => $email, 'msg' => $msg, 'img' => $img]
        );

        ///загрузка картинки
        $err = null;
        if ($foto && $id) {
            $dir = "static/img/msg/" . $id;
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $err = \core\Img::addImg($foto,$dir,320,240);
            if ($err) {
                $what = ['img' => ""];
                $where = ["id" => $id];
                $this->db->update("msg", $what, $where);
            }

        }

        return $err;
    }

    //добавление сообщения
    public function editMsg($id,$user,$email,$msg) {

        $what = ['user' => $user, 'email' => $email, 'msg' => $msg, 'adm_edited' => 1];
        $where = ["id" => $id];
        $this->db->update("msg", $what, $where);

    }
    //удаление сообщения
    public function delMsg($idMsg) {

        $res = $this->getMsg($idMsg);
        $img = $res['img'];
        if ($img) {
            $img = "static/img/msg/$idMsg/$img";
            \core\Img::delImg($img);
            rmdir("static/img/msg/$idMsg/");
        }


        if ($idMsg) {
            $where = ["id" => $idMsg];
            $this->db->delete("msg", $where);
        }

    }

    //модерация сообщения
    public function moder($id,$param) {
        $what = ["adm_moder" => $param];
        $where = ["id" => $id];
        $this->db->update("msg", $what, $where);
    }

    //количество всех сообщениий в базе
    public static function countAllMsg() {
        $db = new \core\IDB();
        $res = $db->countAllrec("msg","");
        return $res;
    }

    //количество сообщениий прошедших модерацию
    public static function countMsg() {
        $db = new \core\IDB();
        $where = ['adm_moder' => 1];
        $res = $db->countAllrec("msg",$where);
        return $res;
    }
}