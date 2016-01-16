<?php

/**
 * Name         : SqlServerCriteria.php
 * Date         : 15-ene-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : 
 * Notes        :
 */

require_once(dirname(__FILE__)."/IStefanCriteria.php");

class SqlServerCriteria implements IStefanCriteria {

    private $criteria;

    public function __construct() {
        $this->criteria = "WHERE ";
    }

    public function equal($field, $value) {
        
    }

    public function more($field, $value) {
        
    }

    public function less($field, $value) {
        
    }

    public function moreEqual($field, $value) {
        
    }

    public function lessEqual($field, $value) {
        
    }

    public function isNull($field) {
        
    }

    public function isNotNull($field) {
        
    }

    public function limit() {
        
    }

    public function andConectr() {
        
    }

    public function orConector() {
        
    }

    public function orderByAsc() {
        
    }

    public function orderByDesc() {
        
    }

    public function getCriteria() {
        return $this->criteria;
    }

}
