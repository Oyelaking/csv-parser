<?php

/**
 * CSVParser implements parsing for CSV files.
 *
 * @author Oyelaking
 */
class CSVParser {

    /**
     * Array of erros.
     * 
     * @var array 
     */
    protected $errors = [];

    /**
     *
     * @var type ParserConfig
     */
    protected $parserConfig;

    public function __construct(ParserConfig $config) {
        $this->parserConfig = $config;
    }

    /**
     * Reads from a csv file and creates a list of objects
     * 
     * @param Config $config
     */
    public function parseCSV(Config $config) {
        $fileReader = new CSVFileReader($config->getCsvFile());
        if($fileReader->getErrorMessage()){
            $this->errors[] = $fileReader->getErrorMessage();
            return false;
        }
        //get the headers
        $headers = $fileReader->getHeaders();
        //set the headers of parser config
        $this->parserConfig->setHeaders($headers);
        $formatter = new CSVFormatter();
        $list = [];
        while($row = $fileReader->readRow()){
            $formattedRow = $formatter->formatRow($row, $this->parserConfig);
            if(empty($formattedRow)){
                $this->errors[] = $formatter->getErrorMessage();
                return FALSE;
            }
        }
        return $list;
    }
    
    protected function validateCSVHeaders(array $headers){
        if(empty($headers)){
            $this->errors[] = "Headers is empty";
            return false;
        }
    }

    public function parseListToCSV(Config $config, array $list) {
        $fileWriter = new CSVFileWriter($config->getOutputCSVFile());
        if($fileWriter->getErrorMessage()){
            $this->errors[] = $fileWriter->getErrorMessage();
            return false;
        }
        //write headers
        $headerWriteStatus = $fileWriter->writeHeaders($this->parserConfig->getHeaders());
        if(!$headerWriteStatus){
            $this->errors[] = $fileWriter->getErrorMessage() 
                    ? : "Failed to write headers to csv file {$fileWriter->getFilePath()}";
            return false;
        }
        //now write the content
        $formatter = new ObjectFormatter();
        foreach ($list as $listRow) {
            $formattedRow = $formatter->formatRow($listRow, $this->parserConfig);
            if(empty($formattedRow)){
                $this->errors[] = $formatter->getErrorMessage();
                return false;
            }
            $fileWriter->writeToFile($formattedRow);
        }
        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

}
