<?php

/**
 * Name         : stefanCollection.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Entity Class. Provides a collection of services to assists 
 *              : in the use of collections
 * Notes        :
 */

define("ASC",1);
define("DESC",2);

class stefanCollection 
{
   
    private $objects;
    private $count;
    
    function __construct() 
    {
        $this->count = 0;
        $this->objects = array();
    }
    
    function add($element)
    {
        $this->objects[] = $element;
        $this->count++;
    }
    
    function get($criteria)
    {
       return array_filter($this->objects,$criteria);
    }
    
    function getFirst($amount = 0)
    {
        if($amount > 0)
        {
            //LOS PRIMEROS X ELEMENTOS
            $result = $this->getByAmount($amount);
        }
        else
        {
            //LA PRIMER POSICION
            $result = $this->getByIndex(0);
        }
        
        return $result;
    }
    
    function getLast()
    {
        $reverse = array_reverse($this->objects);
        return $reverse[0];
    }
    
    function rem($index)
    {
        if(is_int($index))
        {
            //REMOVER POR POSICION
            $this->removeByIndex($index);
        }
        else
        {
            //REMOVER POR CONDICION
            $this->removeByCondition($index);
        }
    }
           
    function length()
    {
        return $this->count;
    }
    
    function sortBy($criteria)
    {
        $result = $this->qsort($this->objects,$criteria);
        foreach($this->objects as $index => $object)
        {
            $this->deleteElement($index);
        }
        $this->objects  = $result;
        $this->count    = count($result);
        
        return $this;
    }
    
    function getAll()
    {
        return $this->objects;
    }
    
    
    function orderBy($criteria)
    {
        echo "<hr>";
        echo "Stefan Collection - <b>ordderBy</b><br>"
        . "<p>Sorry! This method is not yet implemented....we apologize</p>";
        echo "<hr>";
    }

    
    
    
    
    
    
    private function isInArray($index)
    {
        return array_key_exists($index,$this->objects);
    }

    private function removeByIndex(int $index)
    {
        if($this->isInArray($index))
        {
            $this->deleteElement($index);
            
            //RE INDEXO EL ARRAY CON LOS ELEMENTOS NUEVOS
            $this->objects = array_values($this->objects);
        }
        else
        {
            throw new Exception("No existe elemento en esa posicion");
        }
    }
    
    private function removeByCondition($criteria)
    {
        $temp = array_filter($this->objects,$criteria);
        foreach($temp as $e)
        {
            $index = array_search($e, $this->objects);
            if($index != false)
            {
                $this->deleteElement($index);
            }
        }
        
        //RE INDEXO EL ARRAY CON LOS ELEMENTOS NUEVOS
        $this->objects = array_values($this->objects);
        
    }
    
    private function getByIndex($index)
    {
        if($this->isInArray($index))
        {
            $result = $this->objects[$index];
        }
        else
        {
            throw new Exception("No existe elemento en esa posicion");
        }
        
        return $result;
    }
    
    private function getByAmount(int $amount)
    {
        $result = array();
        $limit = $this->count > $amount ? $amount : $this->count;
        
        for($i = 0; $i < $limit; $i++)
        {
            $result[$i] = $this->objects[$i];
        }
        
        return $result;
    }
    
    private function deleteElement($index)
    {
        unset($this->objects[$index]);
        $this->count--;
    }
    
    private function qsort($array,$criteria)
    {
        if(count($array) > 1)  
        {
            $left   = array();
            $right  = array();
            
            reset($array);
            
            $pivot_key  = key($array);
            $pivot      = array_shift($array);
            
            foreach( $array as $index => $obj ) 
            {
                $valueObj   = call_user_func_array($criteria,array($obj));
                $valuePivot = call_user_func_array($criteria,array($pivot));
                
                if($valueObj < $valuePivot ) //$obj < $pivot )
                {
                    $left[$index] = $obj;
                }
                else
                {
                    $right[$index] = $obj;
                }
            }
            $result = array_merge($this->qsort($left,$criteria), array($pivot_key => $pivot), $this->qsort($right,$criteria));
        }
        else
        {
            //DEVUELVO EL MISMO ARRAY
            $result = $array;
        }
        return $result;
    }
        
}
