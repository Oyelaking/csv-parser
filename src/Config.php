<?php

/**
 * Description of Config
 *
 * @author Oyelaking
 */
class Config {
    
    private $csvFile;
    private $configFile;
    private $outputCSVFile;
    
    public function getCsvFile() {
        return $this->csvFile;
    }

    public function getConfigFile() {
        return $this->configFile;
    }

    public function getOutputCSVFile() {
        return $this->outputCSVFile;
    }

    public function setCsvFile($csvFile) {
        $this->csvFile = $csvFile;
    }

    public function setConfigFile($configFile) {
        $this->configFile = $configFile;
    }

    public function setOutputCSVFile($outputCSVFile) {
        $this->outputCSVFile = $outputCSVFile;
    }

}
