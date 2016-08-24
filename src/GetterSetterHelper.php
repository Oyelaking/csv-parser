<?php

/**
 * GetterSetterHelper contains only static methods that help with determining 
 * the getter and setter names
 *
 * @author Oyelaking
 */
class GetterSetterHelper {

    public static function getSetterMethodName($propertyName) {
        //we gatta capitalize the first letter of the propertyName
        $propertyName{0} = strtoupper($propertyName{0});
        return "set" . $propertyName;
    }

    public static function getGetterMethodName($propertyName) {
        //we gatta capitalize the first letter of the propertyName
        $propertyName{0} = strtoupper($propertyName{0});
        return "get" . $propertyName;
    }

    public static function getPropertyName($methodName){
        $methodPrefix = substr($methodName, 0, 3);
        if($methodPrefix != "get" || $methodPrefix != "set"){
            return false;
        }
        $propertyName = substr($methodName, 3);
        $propertyName{0} = strtolower($propertyNamePart{0});
        return $propertyName;
    }
}
