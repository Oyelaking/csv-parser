<?php

/**
 * Interface for formatting the data.
 * 
 * @author Oyelaking
 */
interface Formatter {
   
    public function formatRow($row, ParserConfig $config);
    public function getErrorMessage();
    
}
