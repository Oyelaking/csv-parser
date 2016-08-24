<?php

/**
 * CSVFormatter formats a line of a csv file to an object
 *
 * @author Oyelaking
 */
class CSVFormatter implements Formatter {

    const HEADER_TYPE_ASSOC = 1;
    const HEADER_TYPE_INDEXED = 2;
    const HEADER_TYPE_OBJECT = 3;

    protected $errorMessage = "";

    /**
     * 
     * @param array $row because this is coming from a csv file, it will 
     * definitely be an indexed array
     * @param ParserConfig $config
     * @return boolean
     */
    public function formatRow(array $row, ParserConfig $config) {
        if (empty($row)) {
            $this->errorMessage = "Row is empty";
            return FALSE;
        }
        return $this->format($row, $config->getHeaders());
    }

    /**
     * we need to break down each header and determine if it's an assoc array
     * column, an indexed array column or an object array column
     * 
     * @param type $headers
     */
    protected function format(array $row, $headers) {
        $cleanHeaders = array_combine(range(0, count($headers) - 1), $headers);
        $data = NULL;
        $type = $this->getHeaderType($cleanHeaders[0]);
        switch ($type) {
            case self::HEADER_TYPE_INDEXED:
                $data = $this->createIndexedArray($row, $cleanHeaders);
                break;

            case self::HEADER_TYPE_OBJECT:
                $data = $this->createObject($row, $cleanHeaders);
                break;

            case self::HEADER_TYPE_ASSOC:
                $data = $this->createAssocArray($row, $cleanHeaders);
            default:
                break;
        }
        return $data;
    }

    protected function createObject(array $row, array $headers) {
        try {
            $headerSplitted = explode(":", $headers[0]);
            $className = $headerSplitted[0];
            //create a reflector
            $reflector = new ReflectionClass($className);
            $object = $reflector->newInstance();
            $counter = -1;
            foreach ($headers as $header) {
                $counter++;
                $propertyName = explode(":", $header)[1];
                $property = $reflector->hasProperty($propertyName) 
                        ? $reflector->getProperty($propertyName) : null;
                if (empty($property)) {
                    $this->errorMessage = "The property $propertyName does not exist in"
                            . " the object of type" . $reflector->getName();
                    return FALSE;
                }elseif ($property->isPublic()) {
                    $property->setValue($object, $property->getValue($row[$counter]));
                } else {
                    $methodName = GetterSetterHelper::getSetterMethodName($propertyName);
                    $method = $reflector->getMethod($methodName);
                    if (empty($method) || !$method->isPublic()) {
                        $this->errorMessage = "No public property $propertyName for object "
                                . "of type " . $reflector->getName() . ", and no "
                                . "public getter method with name {$methodName} found";
                        return FALSE;
                    }
                    $method->invoke($object, $row[$counter]);
                }
            }
            return $object;
        } catch (Exception $exception) {
            $this->errorMessage = "Exception occured: " . $exception->getMessage();
        }
        return null;
    }

    protected function createIndexedArray(array $row, array $headers) {
        $array = [];
        $length = count($headers);
        for ($i = 0; $i < $length; $i++) {
            $row[$i] = !empty($row[$i]) ? $row[$i] : "";
        }
        return $array;
    }

    protected function createAssocArray($row, array $headers) {
        $array = [];
        $counter = 0;
        foreach ($headers as $header) {
            $row[$header] = !empty($row[$counter]) ? $row[$counter] : "";
            $counter++;
        }
        return $array;
    }

    protected function getHeaderType($header) {
        $type = self::HEADER_TYPE_ASSOC;        
        if (strpos($header, ":")) {
            $headerSplitted = explode(":", $header);
            if (is_numeric($headerSplitted[1])) {
                return self::HEADER_TYPE_INDEXED;
            } elseif (class_exists($headerSplitted[0])) {
                return self::HEADER_TYPE_OBJECT;
            }
        }
        return $type;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

}
