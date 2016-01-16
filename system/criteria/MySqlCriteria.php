<?php

/**
 * Name         : MySqlCriteria.php
  * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Provides a collection of services to assists 
 *              : in the use of criteria objects to be used as filter mechanisms
 *              : when using relational databases
 * Notes        :
 */

require_once(dirname(__FILE__)."/IStefanCriteria.php");

class MySqlCriteria implements IStefanCriteria {

    private $criteria;

    public function __construct() {
        $this->criteria = "WHERE ";
    }

    /**
     * Adds the = operator on the query criteria
     * @param string $field The name of the column on the DB
     * @param string $value The value that the column must have
     */
    public function equal($field, $value) {
        $this->criteria .= ($field . " = '" . $value . "' ");
    }
    
    /**
     * Adds the > operator on the query criteria
     * @param string $field The name of the column on the DB
     * @param string $value The value that the column must have
     */
    public function more($field, $value) {
        $this->criteria .= ($field . " > " . $value . " ");
    }

    /**
     * Adds the < operator on the query criteria
     * @param string $field The name of the column on the DB
     * @param string $value The value that the column must have
     */
    public function less($field, $value) {
        $this->criteria .= ($field . " < " . $value . " ");
    }

    /**
     * Adds the >= operator on the query criteria
     * @param string $field The name of the column on the DB
     * @param string $value The value that the column must have
     */
    public function moreEqual($field, $value) {
        $this->criteria .= ($field . " >= " . $value . " ");
    }

     /**
     * Adds the <= operator on the query criteria
     * @param string $field The name of the column on the DB
     * @param string $value The value that the column must have
     */
    public function lessEqual($field, $value) {
        $this->criteria .= ($field . " <= " . $value . " ");
    }

     /**
     * Adds the IS NULL operator on the query criteria
     * @param string $field The name of the column on the DB
     */
    public function isNull($field) {
        $this->criteria .= ($field . " IS NULL ");
    }

    /**
     * Adds the IS NOT NULL operator on the query criteria
     * @param string $field The name of the column on the DB
     */
    public function isNotNull($field) {
        $this->criteria .= ($field . " IS NOT NULL ");
    }

    /**
     * Adds the LIMIT operator on the query criteria<br>
     * If only one argument is passed then, the LIMIT operator will determine
     * the range of rows that would be returned. Eg: LIMIT 1
     * <br>If two arguments are passed, then the LIMIT operator will perform
     * the usuall way (LIMIT 2,6)
     */
    public function limit() {
        if (func_num_args() < 2) {
            $this->criteria .= "LIMIT " . func_get_arg(0);
        } else {
            $this->criteria .= "LIMIT " . func_get_arg(0) . "," . func_get_arg(1);
        }
    }

    /**
     * Adds the AND operator on the query criteria<br>
     */
    public function andConectr() {
        $this->criteria .= "AND ";
    }
    /**
     * Adds the OR operator on the query criteria<br>
     */
    public function orConector() {
        $this->criteria .= "OR ";
    }

    /**
     * Adds the ORDER BY (upward) operator on the query criteria.<br>
     * The number of parameters passed as argument will determined the order
     * criteria. <br>Arguments need to passed as values separate by comas<br>
     * Eg: orderByAsc("name","age")
     */
    public function orderByAsc() {
        $orderBy = "ORDER BY ";
        for ($i = 0; $i < func_num_args(); $i++) {
            $orderBy .= (func_get_arg($i) . ",");
        }
        $this->criteria .= rtrim($orderBy, ",");
        $this->criteria .= " ASC ";
    }
    
    /**
     * Adds the ORDER BY (falling) operator on the query criteria.<br>
     * The number of parameters passed as argument will determined the order
     * criteria. <br>Arguments need to passed as values separate by comas<br>
     * Eg: orderByAsc("name","age")
     */
    public function orderByDesc() {
        $orderBy = "ORDER BY ";
        for ($i = 0; $i < func_num_args(); $i++) {
            $orderBy .= (func_get_arg($i) . ",");
        }
        $this->criteria .= rtrim($orderBy, ",");
        $this->criteria .= " DESC ";
    }

    /**
     * Returns the final criteria to be used as filter on the db query
     * @return string The final criteria
     */
    public function getCriteria() {
        return $this->criteria;
    }

}
