<?php

interface IStefanDriver {
       
    public function executeNonQuery($query);
    public function executeQuery($query);
    public function executeTransaction($query = array());
    public function callNonQueryProcedure($procedure, $arg = array());
    public function callQueryProcedure($procedure, $arg = array());
}
