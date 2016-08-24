<?php

/* 
 * This the CLI version of the program
 */

//require the config file
require_once __DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR
        . "config.php";

//check that this is being run from CLI
if($argc < 1){
    print_line("The program can only be run from CLI");
    exit();
}

//check that it's this file in particular that's being run
if(!preg_match("//", $argc[0])){
    print_line("To use this application from another application, include"
            . " csv_parser.php instead.");
    exit();
}

if($argc < 2){
    print_line("No arguments supplied to the program");
    exit();
}

$cliArgs = $argv;
//remove script name
unset($cliArgs[0]);
//parse argument
$argParser = new CLIArgumentParser($cliArgs);

if(!$argParser->getIsValid()){
    print_line("Invalid/incomplete command line arguments supplied.");
    print_line("Errors:");
    $errors = $argParser->getErrors();
    foreach ($errors as $error) {
        print_line($error);
    }
    exit();
}



function print_line($message){
    echo $message . "\n";
}