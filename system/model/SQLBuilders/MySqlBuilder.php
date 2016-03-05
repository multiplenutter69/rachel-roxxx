<?php

/**
 * Name         : MySqlBuilder.php
 * Date         : March 2016
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */

require_once MODELPATH . DS . "SQLBuilders" . DS . "ISqlBuilder.php";

class MySqlBuilder implements ISqlBuilder {
    
    
    public function insert($obj, $filter = ReflectionProperty::IS_PRIVATE){
        
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties($filter);

        $query = "INSERT INTO " . get_class($obj) . "(";
        
        foreach ($props as $prop) {
            $query .= $prop->getName() . ",";
        }
        
        $query = trim($query, ",");
        $query .= ") VALUES(";
        
        foreach ($props as $prop) {
            $query .= "'" . call_user_func(array($obj, "get" . ucfirst($prop->getName()))) . "',";
        }
        $query = trim($query, ",");
        $query .= ")";
        
        return $query;
    }
    
    public function update($obj, $criteria = "" ,$filter = ReflectionProperty::IS_PRIVATE){
        
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties($filter);

        $query = "UPDATE " . get_class($obj) . "SET ";
        
        foreach ($props as $prop) {
            $query .= $prop->getName() . " = '" . call_user_func(array($obj, "get" . ucfirst($prop->getName()))) ."',";
        }
        
        $query = trim($query, ",");
        $query .= $criteria;
        
        return $query;
    }
    
    public function delete($obj, $criteria = ""){
        $query = "DELETE FROM " . get_class($obj) . " " . $criteria;
        return $query; 
    }
    
    public function select($fields, $from, $criteria = ""){
        $query = "SELECT ";
        foreach($fields as $field){
            $query .= $field . ",";
        }
        $query = trim($query, ",");
        $query .= " FROM " . $from . " " . $criteria;
        return $query;
    }
    
}
