<?php

/**
 * Name         : Criteria.php
 * Date         : March 2016
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */
class Criteria {

    /**
     * Generates a string thtat contains all the fields that shoud be place
     * after a SELECT statement. Each field will be obtained from the name
     * of the properties defined on the class
     * @param object $obj The object to which the method will extract all 
     * the properties names
     * @param type $filter The type of filter to be applied on the class. For
     * instance, sometimes it will be necesario to get all the names of the 
     * private properties only, and in another case all the types. 
     * <br>For more information about the filters, please take a look at the
     * ReflectionProperty in PHP oficial documentation
     * @return string String to be used after a SELECT statement
     */
    public static function generateFields($obj, $filter = ReflectionProperty::IS_PRIVATE) {

        $result = "";
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties($filter);

        foreach ($props as $prop) {
            $result .= $prop->getName() . ",";
        }

        return trim($result, ",");
    }

    /**
     * Get the table name from an Object. The table name should match the 
     * class name only in lower case letters
     * @param object $obj The object to wich the class name should be taken
     * @return string Class name lower case
     */
    public static function generateTable($obj) {
        return strtolower(get_class($obj));
    }

    /**
     * Generates the condition string to be used after the WHERE statement 
     * <br>Similar to prepared statements mechanisms, given an expresion string
     * full of tokens and an Object, the method will bind the property values 
     * with the special parts of the expresion string to create a new string 
     * using the tokens to mark the places where the values should be
     * @param string $exp The expresion to be evaluated. <br>
     * <b>Token Format:</b>  Should begin with ":" and be followed by the
     * property name to be binded.<br>
     * E.g : "age > :age and gender = :gender"
     * @param object $obj The object to bind the string with
     * @param string $getterType String with the prototipe of the class getter 
     * method
     * @return string The condition string
     */
    public static function generateCondition($exp, $obj, $getterType = "get") {

        $args = array($obj, $getterType);

        $result = preg_replace_callback('/:(\w+)/', function($matchs) use ($args) {
            return call_user_func(array($args[0], $args[1] . ucfirst($matchs[1])));
        }, $exp);

        return $result;
    }

}
