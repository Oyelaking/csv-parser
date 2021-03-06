<?php

/**
 * Formats an object into an array for storing to a CSV file
 *
 * @author Oyelaking
 */
class ObjectFormatter implements Formatter {

    private $errorMessage = "";

    public function formatRow(array $row, ParserConfig $config) {
        if (!is_object($row) && !is_array($row)) {
            $this->errorMessage = "Invalid row type. Row should either "
                    . "be an array or object";
            return FALSE;
        }
        if (empty($config->getKeys())) {
            $this->errorMessage = "No property names specified for fetching object properties";
            return FALSE;
        }
        if (is_object($row)) {
            return $this->formatObject($row, $config->getKeys());
        } else {
            return $this->formatArray($row, $config->getKeys());
        }
    }

    protected function formatObject($obj, array $propertyNames) {
        $data = [];
        //create a reflector
        $reflector = new ReflectionClass($obj);
        foreach ($propertyNames as $name) {
            $hasProperty = $reflector->hasProperty($name);
            if (!$hasProperty) {
                $this->errorMessage = "The property $name does not exist in"
                        . " the object of type" . $reflector->getName();
                return FALSE;
            }
            $property = $reflector->getProperty($name);
            if ($property->isPublic()) {
                $data[] = $property->getValue();
            } else {
                $methodName = GetterSetterHelper::getGetterMethodName($name);
                $method = $reflector->getMethod($methodName);
                if (empty($method) || !$method->isPublic()) {
                    $this->errorMessage = "No public property $name for object "
                            . "of type " . $reflector->getName() . ", and no "
                            . "public getter method with name {$methodName} found";
                    return FALSE;
                }
                $data[] = $method->invoke($obj);
            }
        }
        return $data;
    }

    protected function formatArray($array, array $arrayKeys) {
        $data = [];
        foreach ($arrayKeys as $key) {
            $data[] = $array[$key];
        }
        return $data;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

}
