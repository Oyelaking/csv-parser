<?php

/**
 * Description of ParserConfig
 *
 * @author Oyelaking
 */
class ParserConfig {

    /**
     *
     * @var array 
     */
    private $headers;

    /**
     *
     * @var array 
     */
    private $keys;

    public function __construct($object = null) {
        $this->setObject($object);
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getKeys() {
        return $this->keys;
    }

    public function setHeaders(array $headers) {
        $this->headers = $headers;
    }

    public function setKeys(array $keys) {
        $this->keys = $keys;
    }

    /**
     * 
     * @param type $object
     */
    public function setObject($object) {
        if (!empty($object) && is_object($object)) {
            return false;
        }
        $this->analyzeObject($object);
    }

    protected function analyzeObject($object) {
        $reflector = new ReflectionClass($object);
        //get the public properties
        $publicProperties = $reflector->getProperties(ReflectionProperty::IS_PUBLIC);
        $publicPropertyNames = [];
        //iterate over and remove resources
        foreach ($publicProperties as $key => $property) {
            if (is_resource($property->getValue())) {
                unset($publicProperties[$key]);
            }else{
                $publicPropertyNames[] = $property->getName();
            }
        }

        //check for properties with getter and setters
        $propectedProperties = $reflector->getProperties(
                ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED
        );
        foreach ($propectedProperties as $property) {
            $getterMethodName = GetterSetterHelper::getGetterMethodName($property->getName());
            $setterMethodName = GetterSetterHelper::getSetterMethodName($property->getName());

            //check if both setter and getter are available and public
            if (!$reflector->hasMethod($getterMethodName) || !$reflector->getMethod($getterMethodName)->isPublic()) {
                continue;
            }
            if (!$reflector->hasMethod($setterMethodName) || !$reflector->getMethod($setterMethodName)->isPublic()) {
                continue;
            }
            if (!in_array($property->getName(), $publicPropertyNames)) {
                $publicPropertyNames[] = $property->getName();
            }
        }
        $this->setKeys($publicPropertyNames);
        $headers = [];
        foreach ($publicPropertyNames as $propertyName) {
            $headers[] = $reflector->getName() . ":" . $propertyName;
        }
        $this->setHeaders($headers);
    }

}
