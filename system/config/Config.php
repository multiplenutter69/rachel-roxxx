<?php

/**
 * Name         : Config.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Config class. This entity handles all the parametrization of
 *              : the project
 * Notes        :
 */

//PROJECT MODE
define("DEBUG",0);
define("RELEASE",1);

//PROJECT ENABLE
define("ENABLED",1);
define("DISABLED",0);

//HASH METHOD
define("MD5",1);
define("SHA256",2);
define("HAVALL11604",3);

//AES KEY
define("DEFAULT_AES_KEY","fbe07dfb68380f012ceffcca6031fbdf");


class Config {

    //PROJECT CONFIGURATION
    private $project = "";
    private $root = "";
    private $rootURL = "";
    private $projectEnalbe = ENABLE;
    private $projectMode = DEBUG;
    
    //SECURITY
    private $aesKey = DEFAULT_AES_KEY;
    private $hashMethod = SHA256;
    
    //DB CONFIGURATION
    private $dbServerHost = "";
    private $dbUserName = "";
    private $dbPort = "";
    private $dbPassword = "";
    private $dbSchema = "";
    private $dbCharset = "";

    /**
     * Loads the config from an XML file located at path.
     * <br>Suggested /aplication/config/config.xml
     * <br>XML file MUST be adecuate to an especific format defined at Readme.md 
     * @param string $path path to the file (with extension)
     */
    function __construct($path) {

        
        $configXML = simplexml_load_file($path);

        if (!$configXML) {

            $this->project = $configXML->params->param->project;
            $this->root = $configXML->params->param->root;
            $this->rootURL = $configXML->params->param->rootURL;
            
            $this->dbServerHost = $configXML->params->param->dbServerHost;
            $this->dbUserName = $configXML->params->param->dbUserName;
            $this->dbPort = $configXML->params->param->dbPort;
            $this->dbPassword = $configXML->params->param->dbPassword;
            $this->dbSchema = $configXML->params->param->dbSchema;
            $this->dbCharset = $configXML->params->param->dbCharset;
        }
    }

    public function getProject() {
        return $this->project;
    }

    public function getRoot() {
        return $this->root;
    }

    public function getRootURL() {
        return $this->rootURL;
    }

    public function getDbServerHost() {
        return $this->dbServerHost;
    }

    public function getDbUserName() {
        return $this->dbUserName;
    }

    public function getDbPort() {
        return $this->dbPort;
    }

    public function getDbPassword() {
        return $this->dbPassword;
    }

    public function getDbSchema() {
        return $this->dbSchema;
    }

    public function getDbCharset() {
        return $this->dbCharset;
    }

}
