<?php
session_start();
function __autoload($className) {
    $className = str_replace("\\","/",$className);
    if (file_exists("class/$className.php")) {
        include "class/$className.php";
    } else {
        //exit ("Файл $className.php не найден!");
    }
}
define("ROOT", "/bjtest/");
