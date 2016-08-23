<?php

spl_autoload_register("csv_parser_autoloader");

//define useful constants
define("BASE_PATH", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("SRC_FOLDER", "src");
define("SRC_PATH", BASE_PATH . SRC_FOLDER . DIRECTORY_SEPARATOR);


function csv_parser_autoloader($className){
    $path = SRC_PATH . $className . ".php";
    if(file_exists($path)){
        require_once $path;
    }    
}