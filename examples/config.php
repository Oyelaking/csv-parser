<?php

/*
 * Configuration file for examples
 */

require_once '../csv_parser.php';

define("EXAMPLE_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("EXAMPLE_SRC_FOLDER", "src");
define("EXAMPLE__SRC_PATH", __DIR__ . DIRECTORY_SEPARATOR
        . EXAMPLE_SRC_FOLDER . DIRECTORY_SEPARATOR);

spl_autoload_register("example_autoload");

require_once EXAMPLE_PATH . "data" . DIRECTORY_SEPARATOR . "employee.php";

function example_autoload($className) {
    $path = EXAMPLE__SRC_PATH . $className . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
}
