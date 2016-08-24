<?php

/* 
 * Example file to demonstrate how to use the parser
 */

require_once './config.php';

$parserConfig = new ParserConfig();

$config = new Config();
$config->setCsvFile("employees_to_csv.csv");

$parser = new CSVParser($parserConfig);

$objectList = $parser->parseCSV($config);

if(!empty($objectList)){
    echo "CSV file successfully parsed to object.\n\n";
    print_r($objectList, false);
}else{
    echo "Failed to parse CSV file to object. Errors: \n";
    $errors = $parser->getErrors();
    foreach ($errors as $error) {
        echo $error;
    }
}