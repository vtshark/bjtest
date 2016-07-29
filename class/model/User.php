<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.07.2016
 * Time: 18:30
 */

namespace model;


class User {
    public static function autUser($idUser) {
        $token = md5( "the".$idUser."prodigy" );
        setcookie("id",$idUser,null,"/");
        setcookie("token",$token,null,"/");
    }
    public static function getTrueUser() {
        if (isset($_COOKIE['id']) && (isset($_COOKIE['token']))) {
            return md5("the" . $_COOKIE['id'] . "prodigy") === $_COOKIE['token'];
        } else {
            return false;
        }
    }
    public static function outUser() {
        setcookie("id","",time() - 3600,"/");
    }

}