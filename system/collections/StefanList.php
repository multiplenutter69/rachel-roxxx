<?php

/**
 * Name         : StefanList.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Provides a collection of services to assists 
 *              : in the use of list collections
 * Notes        :
 */

define("ASC", 1);
define("DESC", 2);
define("EXCEPTION", "Unexisting Element");

class StefanList implements IStefanCollection {

    private $objects;
    private $count;

    function __construct() {
        $this->count = 0;
        $this->objects = array();
    }

    /**
     * Adds a new element on the collection
     * @param object $element The object to add
     */
    public function add($element) {
        $this->objects[] = $element;
        $this->count++;
    }

    /**
     * Performs a Filter operation on the collection
     * @param callback $criteria Callback function to be used to perform 
     * the filter. See array_filter for more information
     * @return array Array composed bye the filtered elements
     */
    public function get($criteria) {
        return array_filter($this->objects, $criteria);
    }

    /**
     * Returns the array of elements of the collection.<br>
     * This method is created to be used on a foreach operation. <br>
     * E.g: foreach($collection->getAll() as $object) ...
     * @return array The array of elements of the collection
     */
    public function getAll() {
        return $this->objects;
    }

    /**
     * Returns the first/s element/s of the collection
     * @param integer $amount If amount is not setted, the method return the first element 
     * of the collection.<br>If amout is setted, the method returns the first 
     * "amounts" elements of the collection
     * @return array The collection of elements desired
     */
    public function getFirst($amount = 0) {
        if ($amount > 0) {
            //THE FIRST X ELEMENTS
            $result = $this->getByAmount($amount);
        } else {
            //FIRST POSITION ONLY
            $result = $this->getByIndex(0);
        }

        return $result;
    }

    /**
     * Returns the last element of the collection
     * @return object The las element of the collection
     */
    public function getLast() {
        $reverse = array_reverse($this->objects);
        return $reverse[0];
    }

    /**
     * Removes an element from the collection.
     * <br>This method is overloaded and can suport, two types of remove methods:
     * by index or by condition. <br>If a number is passed as an argument, the
     * method will remove the element located on the "index" position just passed
     * <br>If a callback function is passed as an argument, there is posible to 
     * remove more than one element at a time
     * @param multi $index the index position of the elemente to be removed or a
     * callback function indicating which elements need to be remove
     */
    public function rem($index) {
        if (is_int($index)) {
            $this->removeByIndex($index);
        } else {
            $this->removeByCondition($index);
        }
    }

    /**
     * Returns the size of the collection
     * @return integer The number of elements that the collection has
     */
    public function length() {
        return $this->count;
    }

//    public function sortBy($criteria) {
//        $result = $this->qsort($this->objects, $criteria);
//        foreach ($this->objects as $index => $object) {
//            $this->deleteElement($index);
//        }
//        $this->objects = $result;
//        $this->count = count($result);
//
//        return $this;
//    }


    public function orderBy($criteria) {
        echo "<hr>";
        echo "Stefan Collection - <b>ordderBy</b><br>"
        . "<p>Sorry! This method is not yet implemented....we apologize</p>";
        echo "<hr>";
    }

    private function isInArray($index) {
        return array_key_exists($index, $this->objects);
    }

    private function removeByIndex(int $index) {
        if ($this->isInArray($index)) {
            $this->deleteElement($index);

            //RE INDEXO EL ARRAY CON LOS ELEMENTOS NUEVOS
            $this->objects = array_values($this->objects);
        } else {
            throw new Exception(EXCEPTION);
        }
    }

    private function removeByCondition($criteria) {
        $temp = array_filter($this->objects, $criteria);
        foreach ($temp as $e) {
            $index = array_search($e, $this->objects);
            if ($index != false) {
                $this->deleteElement($index);
            }
        }

        //INDEXING WITH NEW VALUES
        $this->objects = array_values($this->objects);
    }

    private function getByIndex($index) {
        if ($this->isInArray($index)) {
            $result = $this->objects[$index];
        } else {
            throw new Exception(EXCEPTION);
        }

        return $result;
    }

    private function getByAmount(int $amount) {
        $result = array();
        $limit = $this->count > $amount ? $amount : $this->count;

        for ($i = 0; $i < $limit; $i++) {
            $result[$i] = $this->objects[$i];
        }

        return $result;
    }

    private function deleteElement($index) {
        unset($this->objects[$index]);
        $this->count--;
    }

    private function qsort($array, $criteria) {
        if (count($array) > 1) {
            $left = array();
            $right = array();

            reset($array);

            $pivot_key = key($array);
            $pivot = array_shift($array);

            foreach ($array as $index => $obj) {
                $valueObj = call_user_func_array($criteria, array($obj));
                $valuePivot = call_user_func_array($criteria, array($pivot));

                if ($valueObj < $valuePivot) {
                    $left[$index] = $obj;
                } else {
                    $right[$index] = $obj;
                }
            }
            $result = array_merge($this->qsort($left, $criteria), array($pivot_key => $pivot), $this->qsort($right, $criteria));
        } else {
            //RETURN SAME ARRAY
            $result = $array;
        }
        return $result;
    }

}
