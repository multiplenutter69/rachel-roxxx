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

    /**
     * Returns the value present on a POST or GET. 
     * <br>The value returnedd is already been filtered
     * @param iteger $type The type of input to obtained. E.g: INPUT_POST
     * @param string $name The key of the position of the value on the
     * array
     * @return string Filtered input value
     */
    public function getInput($type, $name) {
        $input = filter_input($type, $name);
        return Security::cleanImput($input);
    }

    /**
     * Returns the instance of an object that will be loaded with the values of
     * the post recently made. <br>
     * <b>IMPORTANT:</b> This functionality requires that all of your attributes
     * be defined as private and that all of them must be accesible by a setter
     * @param string $name The name of the class that will intance the object
     * @return mix The instance of the object
     */
    public function getObject($name, $setter = "set"){
        $post = $_POST;

        try {
            $obj = new $name();
            foreach ($post as $k => $v) {
                $param = array(Security::cleanImput($v));
                call_user_func_array(array($obj, $setter . $k), $param);
            }
            $result = $obj;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

        return $result;
    }
    
    /**
     * Performs the load of a certain view
     * @param string $name The name of the view with or without extension
     * @param array $params Variables to be loaded on the view. The parameters
     * must come in a key value array. Once the view is loaded, parameters
     * will be extracted and will be available to be used on the view directly
     * (no array needed)
     */
    public function loadView($name, $params = array()) {

        if (!strpos($name, ".php")) {
            $name .= ".php";
        }

        if (!empty($params)) {
            extract($params);
        }

        if (file_exists(APPPATH . DS . "views" . DS . $name)) {
            if (!(require_once APPPATH . DS . "views" . DS . $name)) {
                throw new Exception(ERROR_108. $name . "<br>");
            }
        } else {
            throw new Exception(ERROR_108. $name . "<br>");
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
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

        return $result;
    }

}
