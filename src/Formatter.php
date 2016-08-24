<?php

/**
 * Interface for formatting the data.
 * 
 * @author Oyelaking
 */
interface Formatter {
   
    public function formatRow(array $row, ParserConfig $config);
    public function getErrorMessage();
    
}
