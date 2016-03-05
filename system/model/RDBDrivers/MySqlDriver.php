<?php

/**
 * Name         : MySqlDriver.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */

require_once MODELPATH . DS . "RDBDrivers" . DS . "IStefanDriver.php";

class MySqlDriver implements IStefanDriver {

    private $dbHandler;
    
    private $server;
    private $user;
    private $password;
    private $schema;
    private $charset;
    
    public function __construct() {
        $this->server = "";
        $this->user = "";
        $this->password = "";
        $this->schema = "";
        $this->charset = "";
             
        $this->dbHandler = null;
    }
    
    private function connect() {
        $conn = mysql_connect($this->server, $this->user, $this->password);
        if ($conn != false) {
            if (mysql_select_db($this->schema, $conn)) {
                mysql_set_charset($this->charset);
                $this->dbHandler = $conn;
            }
        }
    }

    private function disconnect() {
        mysql_close($this->dbHandler);
    }

    private function map($tempResult) {

        $result = array();
        $temp = mysql_fetch_array($tempResult);

        if ($temp != false) {

            $rows = array();
            $index = 0;

            while ($temp) {
                $rows[$index] = $temp;
                $temp = mysql_fetch_array($tempResult);
                $index++;
            }
         
            $result = array();
            $index = 0;
            foreach ($rows as $row) {
                while (list($key, $val) = each($row)) {
                    $result[$index][$key] = $val;
                }
                $index++;
            }
        } 
        
        return $result;
    }

    public function executeNonQuery($query){
        $result = false;
                
        $this->connect();
        if($this->dbHandler != null){
            $result = mysql_query($query, $this->dbHandler);
            $this->disconnect();
        }  else {
               throw new Exception(ERROR_201, 201);
        }
        
        return $result;
    }
        
    public function executeQuery($query) {
        $result = array();

        $this->connect();
        if ($this->dbHandler != null) {
            $tempResult = mysql_query($query, $this->dbHandle);
            $result = $this->map($tempResult);
            $this->disconnect();
        } else {
            throw new Exception(ERROR_201, 201);
        }

        return $result;
    }

    public function executeTransaction($query = array()) {
        $result = false;
        $this->connect();
        if ($this->dbHandler != null) {
            mysql_query("BEGIN");
            foreach ($query as $q) {
                $tempResult = mysql_query($q);

                if ($tempResult == false) {
                    $trans = false;
                    break;
                }
            }

            if ($trans) {
                mysql_query("COMMIT");
                $result = true;
            } else {
                mysql_query("ROLLBACK");
                $result = false;
            }

            $this->disconnect();
        } else {
            throw new Exception(ERROR_201, 201);
        }
        return $result;
    }

    public function callNonQueryProcedure($procedure, $arg = array()) {
        $query = "CALL " . $procedure . "(";

        foreach ($arg as $a) {
            $query .= ($a . ",");
        }
        $query = trim($query, ",");
        $query .= ");";

        return $this->executeNonQuery($query);
    }
    public function callQueryProcedure($procedure, $arg = array()){
         $query = "CALL " . $procedure . "(";

        foreach ($arg as $a) {
            $query .= ($a . ",");
        }
        $query = trim($query, ",");
        $query .= ");";

        return $this->executeQuery($query);
    }
    
    //==========================================================================
    public function setServerHost($server) {
        $this->server = $server;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSchema($schema) {
        $this->schema = $schema;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }



}
