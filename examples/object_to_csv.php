<?php

/* 
 * Example file to demonstrate object to csv conversion
 */

require_once './config.php';

$parserConfig = new ParserConfig();

$parserConfig->setObject(new Employee());

$config = new Config();
$config->setOutputCSVFile("employees_to_csv.csv");

$parser = new CSVParser($parserConfig);

$parseStatus = $parser->parseListToCSV($config, $employees);

if($parseStatus){
    echo "Object list was successfully parsed to csv. Check the outpu"
    . "t file employees_to_csv.csv\n";
}else{
    echo "Failed to parse object list to csv. Errors:\n";
    $errors = $parser->getErrors();
    foreach ($errors as $error) {
        echo $error;
    }
}