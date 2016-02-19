<?php

/**
 * Name         : StefanController.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan 
 * Description  : 
 * Notes        :
 */
class StefanController {

    public function getInput($type, $name) {
        $input = filter_input($type, $name);
        return Security::cleanImput($input);
    }

    public function loadView($name, $params = array()) {

        if (!strpos($name, ".php")) {
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
