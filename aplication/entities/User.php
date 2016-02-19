<?php

/**
 * Name         : User.php
 * Date         : 18-feb-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : 
 * Notes        :
 */
class User {
    private $user;
    private $password;
    
    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }


    
}
