<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("../../system/collections/stefanList.php");
require_once("../../system/gui/stefanSelect.php");

class Test {
    
    private $name;
    private $age;
    
    public function __construct() {
        $this->name = "John";
        $this->age = 24;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getAge(){
        return $this->age;
    }
}


$list = new stefanList();
$list->add(new Test());
$list->add(new Test());
$list->add(new Test());
$list->add(new Test());
$list->add(new Test());

$select = new stefanSelect(array("style" => "width:100%;","onchange" => "alert(123)"));
$select->setData($list, "getAge", "getName");
$select->display();





