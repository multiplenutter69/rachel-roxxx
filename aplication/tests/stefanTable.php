<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../../system/collections/stefanList.php");
require_once("../../system/gui/stefanTable.php");

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


$list = new StefanList();
$list->add(new Test());
$list->add(new Test());
$list->add(new Test());
$list->add(new Test());
$list->add(new Test());

$paginator = new StefanPaginator();
$paginator->setTotalPages(3);
$paginator->setView("stefanTable.php");
$paginator->setCurrentPage(1);


$table = new StefanTable(array("style" => "border: 1px solid black;"));
$table->setHeader(array("Nombre", "Edad"));
$table->setData($list, array("getName", "getAge"));
$table->setPaginator($paginator);
$table->setFooter(2);
$table->display();


