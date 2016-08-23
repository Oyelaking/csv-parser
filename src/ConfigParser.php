<?php

/**
 * Description of ConfigParser
 *
 * @author Oyelaking
 */
Interface ConfigParser {
    
    public function parse($config);
    public function getErrors();
}
