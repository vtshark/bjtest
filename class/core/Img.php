<?php

namespace core;


class Img {
    public static function uploadFoto($uploadfile,$tmpfile,$w,$h) {
        $size = getimagesize($tmpfile);
        $koef = 1;
        if (($size[0]>$w) || ($size[0]>$h)) {
            if ($size[0]>$size[1])  {
                $koef = $w/$size[0];
            } else {
                $koef = $h/$size[1];
            }
            $w = (int)$size[0]*$koef;
            $h = (int)$size[1]*$koef;
        } else {
            $w = (int)$size[0];
            $h = (int)$size[1];
        }
        $new = imagecreatetruecolor($w,$h);
        //$im = imagecreatefromjpeg($tmpfile);
        $im = imagecreatefromstring(file_get_contents($tmpfile));
        imagecopyresampled($new,$im,0,0,0,0,$w,$h,$size[0],$size[1]);
        imagejpeg($new,$uploadfile);
    }
    public static function getFoto($idMsg,$fileName) {
        if ($fileName) {
            $img = "<img src='" . ROOT . "static/img/msg/$idMsg/$fileName'";

        } else {
            $img = "";
        }
        return $img;
    }

    public static function delImg($fileName) {
        if (file_exists($fileName)) {
            unlink($fileName);
        }

    }

    public static function addImg($file,$dir,$w,$h,$newName = null) {
        $error = "";
        $arrErrors = array(
            "Размер принятого файла превысил максимально допустимый размер - 5mb.",
            "Размер принятого файла превысил максимально допустимый размер - 5mb.",
            "Загружаемый файл был получен только частично.",
            "Файл не был загружен.",
            "отсутствует временная папка.",
            "Не удалось записать файл на диск",
            "PHP остановил загрузку файлов"
        );
        

        if ( $file['error'] == 0) {

            $fileName = $newName ? $newName : $file['name'];

            $tmpfile = $file['tmp_name'];
            $uploadfile = "$dir/".$fileName;

            self::uploadFoto($uploadfile, $tmpfile, $w, $h);
        } else {
            $numErr = $file['error'];
            $error = "Ошибка загрузки фото! №$numErr." . $arrErrors[$numErr - 1];
        }
        return $error;
        
    }
        
}