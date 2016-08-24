<?php

/**
 * Description of ArrayConfigParser
 *
 * @author Oyelaking
 */
class ArrayConfigParser implements ConfigParser {
    
    private $errors;

    public function parse($config) {
        return $this->initParserConfig($config);
    }

    protected function initParserConfig($config) {
        if(!$this->validate()){
            return false;
        }
        $parserConfig = new ParserConfig();
        $parserConfig->setHeaders(array_values($config['keys_and_headings']));
        $parserConfig->setKeys(array_keys($config['keys_and_headings']));
        return $parserConfig;
    }

    public function getErrors() {
        return $this->errors;
    }
    
    public function validate($config){
        if(empty($realConfig = $config['keys_and_headings'])){
            $this->errors[] = "No keys and headings config found in config";
        }
        
        return empty($this->errors);
    }
}
