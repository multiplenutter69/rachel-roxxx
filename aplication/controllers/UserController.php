<?php

/**
 * Name         : UserController.php
 * Date         : 18-feb-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : 
 * Notes        :
 */
class UserController extends StefanController {
    public function listUsers() {
        
        
        
        $arg = array();
        $arg["title"] = "New Title";
        
        $this->loadView("example", $arg);
        
    }
}
