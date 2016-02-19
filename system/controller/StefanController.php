<?php

/**
 * Name         : StefanController.php
 * Date         : 18-feb-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : 
 * Notes        :
 */
class StefanController {

    public function loadView($name, $params = array()) {
        
        if(!strpos($name, ".php")){
            $name .= ".php";
        }
        
        if (!empty($params)) {
            extract($params);
        }
        
        if (file_exists(APPPATH . DS . "views" . DS . $name)) {
            if (!(require_once APPPATH . DS . "views" . DS . $name)) {
                echo ERROR_108 . $name . "<br>";
                exit(1);
            }
        } else {
            echo ERROR_108 . $name . "<br>";
            exit(1);
        }
    }

}
