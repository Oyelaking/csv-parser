<?php

/**
 * Description of CMDArgumentParser
 *
 * @author Oyelaking
 */
class CLIArgumentParser {

    /**
     *
     * @var Config 
     */
    private $config;
    private $errors;
    private $isValid = false;

    public function __construct($cliArgs) {
        $this->errors = [];
        $this->parseCliParams($cliArgs);
    }

    protected function parseCliParams($cliArgs) {
        $params = [];
        for ($i = 1; $i < count($cliArgs); $i++) {
            $val = explode("=", ltrim($cliArgs[$i], '-'));
            $params[$val[0]] = $val[1];
        }
        if ($this->validate($params)) {
            //initialize the config object
            $this->initConfig();
        }
    }

    protected function initConfig($params) {
        $config = new Config();
        if(!empty($params['csvFile'])){
            $config->setCsvFile($params['csvFile']);
        }
        if(!empty($params['outputCSVFile'])){
            $config->setOutputCSVFile($params['outputCSVFile']);
        }
        if(!empty($params['configFile'])){
            $config->setConfigFile($params['configFile']);
        }
        $this->config = $config;
    }

    /**
     * 
     * @return Config
     */
    public function getConfig() {
        return $this->config;
    }

    public function setConfig($params) {
        $this->config = $params;
    }

    function getErrors() {
        return $this->errors;
    }

    /**
     * validates that the proper arguments have been passed.
     * 
     */
    public function validate($cmdParams) {
//        if (empty($cmdParams['configFile'])) {
//            $this->errors[] = "The CLI argument --configFile is required";
//        } elseif (!file_exists($cmdParams['configFile'])) {
//            $this->errors[] = "The config file {$cmdParams['configFile']} "
//                    . "does not exist or could not be found";
//        } elseif (!is_readable($cmdParams['configFile'])) {
//            $this->errors[] = "The config file {$cmdParams['configFile']} "
//                    . "is not readable";
//        }
        if (empty($cmdParams['csvFile'])) {
            $this->errors[] = "The CLI argument --csvFile is required";
        } elseif (!file_exists($cmdParams['csvFile'])) {
            $this->errors[] = "The CSV file {$cmdParams['csvFile']} "
                    . "does not exist or could not be found";
        } elseif (!is_readable($cmdParams['csvFile'])) {
            $this->errors[] = "The CSV file {$cmdParams['csvFile']} "
                    . "is not readable";
        }
        return empty($this->errors);
    }

    public function getIsValid() {
        return $this->isValid;
    }

}
