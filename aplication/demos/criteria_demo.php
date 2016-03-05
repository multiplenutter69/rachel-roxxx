<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("../../system/library/Criteria.php");

class Foo {
	private $id = 1;
	private $age = 24;
	
	public function getId() {return $this->id;}
	public function getAge() {return $this->age;}
}

$obj = new Foo();

$exp = "id = :id AND age > :age";
echo "SELECT " . 
		Criteria::generateFields($obj) . 
	" FROM " . 
		Criteria::generateTable($obj) . 
	" WHERE " .
	Criteria::generateCondition($exp, $obj) . "<br>" ;