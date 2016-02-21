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

    public function getObject($name){
        $post = $_POST;

        try {
            $obj = new $name();
            foreach ($post as $k => $v) {
                $param = array(Security::cleanImput($v));
                call_user_func_array(array($obj, "set" . $k), $param);
            }
            $result = $obj;
        } catch (Exception $ex) {
            $result = null;
        }

        return $result;
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

    public function loadModel($model) {

        global $config;

        try {
            $driver = new $config["db_driver"];
            $driver->setServer = $config["db_server"];
            $driver->setUser = $config["db_user"];
            $driver->setPassword = $config["db_password"];
            $driver->setPort = $config["db_port"];
            $driver->setSchema = $config["db_schema"];
            $driver->setCharset = $config["db_charset"];

            $result = new $model();
            $result->setDriver($driver);
        } catch (Exception $ex) {
            $result = null;
        }

        return $result;
    }

}
