<?php

/**
 * Name         : UserController.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan 
 * Description  : 
 * Notes        :
 */

class UserController extends StefanController {
    public function listUsers() {
        
        $usuarios = array(
            array("nombre" => "Juan", "apellido" => "Perez", "edad" => 24),
            array("nombre" => "Carlos", "apellido" => "Garcia", "edad" => 18),
            array("nombre" => "Alberto", "apellido" => "Fernandez", "edad" => 32),
            );
        
        $arg = array();
        $arg["title"] = "Example App";
        $arg["tableCaption"] = "Listado de Usuarios de Ejemplo";
        $arg["data"] = $usuarios;
        $this->loadView("example", $arg);
    }
    
    public function user(){
        $this->loadView("exampleAdd");
    }
    
    public function addUser(){
        $user = new User();
        
        $user->setUser($this->getInput(INPUT_POST, "user"));
        $user->setPassword($this->getInput(INPUT_POST, "password"));
        
        $data = array();
        $data["user"] = $user;
        $this->loadView("exampleUserAdded", $data);
        
        
        
        
    }
    
}
