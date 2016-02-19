<?php

/**
 * Name         : StefanTable.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Geenrates a <table> DOM
 * Notes        :
 */
//require_once(dirname(__FILE__) . "/StefanControl.php");
//require_once(dirname(__FILE__) . "/StefanPaginator.php");
//
//class StefanTable extends StefanControl {
//
//    private $control = "";
//    private $table = "";
//    private $tableHeader = "";
//    private $tableData = "";
//    private $tableFooter = "";
//    
//    private $paginator = null;
//
//    public function __construct($param = array()) {
//        $this->paginator = new StefanPaginator();
//        
//        $this->table = "<table ";
//        foreach ($param as $k => $v) {
//            $this->table .= $k . "='" . $v . "' ";
//        }
//        $this->table .= ">";
//        $this->conect();
//    }
//
//    public function setHeader($columns = array()) {
//        $this->tableHeader .= "<tr>";
//        foreach ($columns as $c) {
//            $this->tableHeader .= "<th>" . $c . "</th>";
//        }
//        $this->tableHeader .= "</tr>";
//        $this->conect();
//    }
//
//    public function setData($collection = null, $methods = array()) {
//        foreach ($collection->getAll() as $obj) {
//            $this->tableData .= "<tr>";
//            foreach ($methods as $method) {
//                $this->tableData .= "<td>" . call_user_func(array($obj, $method)) . "</td>";
//            }
//            $this->tableData .= "</tr>";
//        }
//        $this->conect();
//    }
//
//    public function setPaginator($paginator){
//        $this->paginator = $paginator;
//    }
//    
//    public function setFooter($columns, $q = "", $filter = 0) {
//
//        $this->tableFooter = "<tfoot>";
//
//        if ($this->paginator->isPaged()) {
//            $this->tableFooter .= "<tr>";
//            $this->tableFooter .= "<td colspan = '" . $columns . "' align = 'center'>";
//
//            if ($this->paginator->isFirstPage()) {
//                $this->tableFooter .= "< |";
//            } else {
//                $this->tableFooter .= "<a href='" . $this->paginator->getView() . "/" . ($this->paginator->getCurrentPage() - 1);
//                $this->tableFooter .= ($q != "") ? "/" . $q : "";
//                $this->tableFooter .= "'>< </a>|";
//            }
//
//            for ($i = 1; $i <= $this->paginator->getTotalPages(); $i++) {
//                if ($this->paginator->getCurrentPage() == $i) {
//                    $this->tableFooter .= $this->paginator->getCurrentPage() . "|";
//                } else {
//                    $this->tableFooter .= "<a href='" . $this->paginator->getView() . "/" . $i;
//                    $this->tableFooter .= ($q != "") ? "/" . $q : "";
//                    $this->tableFooter .= "'>" . $i . "</a>|";
//                }
//            }
//
//            if ($this->paginator->isFinalPage()) {
//                $this->tableFooter .= " >";
//            } else {
//                $this->tableFooter .= "<a href='" . $this->paginator->getView() . "/" . ($this->paginator->getCurrentPage() + 1);
//                $this->tableFooter .= ($q != "") ? "/" . $q : "";
//                $this->tableFooter .= "'> ></a>";
//            }
//            $this->tableFooter .= "</td>";
//            $this->tableFooter .= "</tr>";
//        }
//        $this->tableFooter .= "</tfoot>";
//        $this->conect();
//    }
//
//    public function display() {
//        echo $this->control;
//    }
//
//    public function getControl() {
//        return $this->control;
//    }
//
//    protected function conect() {
//        $this->control = $this->table . $this->tableHeader . $this->tableData . $this->tableFooter . "</table>";
//    }
//
//}
