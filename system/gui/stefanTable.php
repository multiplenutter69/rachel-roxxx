<?php

/**
 * Name         : stefanPaginator.php
 * Date         : 13-ene-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : 
 * Notes        :
 */
class stefanTable {

    private $table = "";
    private $tableHeader = "";
    private $tableData = "";
    private $tableFooter = "";

    public function __construct($param = array()) {
        $this->table = "<table ";
        foreach ($param as $k => $v) {
            $this->table .= $k . "='" . $v . "' ";
        }
        $this->table .= ">" . 
                $this->tableHeader .
                $this->tableData .
                $this->tableFooter .
                "</table>";
    }

    public function setHeader($columns = array()) {
        $this->tableHeader .= "<tr>";
        foreach ($columns as $c) {
            $this->tableHeader .= "<th>" . $c . "</th>";
        }
        $this->tableHeader .= "</tr>";
    }

    public function setData($collection, $methods = array()) {
        
        $resultText = "";

        foreach ($collection->getAll() as $obj) {
            try {
                call_user_method($textMethod, $obj, &$resultText);

                $this->options .= "<option value=" . $resultValue . ">" . $resultText . "</option>";
            } catch (Exception $ex) {
                echo "<hr>Error "  . $ex->getCode() . " : ". $ex->getMessage() . "<hr>";
            }
        }
    }

    public function display() {
        echo $this->table;
    }

}
