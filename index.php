<?php
//==============================================================================
// User seteable core configuration
// WARNING : A misuse of this global variable could result in a critical
// error and a total malfunction of the framework...so be carefull
//==============================================================================

$config = array();
/**
 * The folder where the aplication is going to be. Sugested name "aplication"
 */
$config["app_folder"] = "aplication";
/**
 * The folder where all the framework is going to be. 
 * Sugested name "system"
 */
$config["system_folder"] = "system";
/**
 * Indicates whether the application is enable for use or not. In the case that
 * the application is not able for use, the system redirects to a 
 * "not available" view
 */
$config["app_enable"] = true;
$config["app_enable_view"] = "";
/**
 * Indicates whether the application is running on a development enviroment or
 * in a production enviroment. In production enviroments (false) errors ar not 
 * shown on the views and are log in a log file. 
 * In development enviroments (true) errors are also log in a log file, but 
 * there are shown on the view 
 */
$config["app_development"] = true;
/**
 * Needed libraries for your application. If yo want all the libraries to load
 * automatically, set the variable to "*", otherwise, you must form an array()
 * in which each element is a library file (name only, no extension)
 * E.g: 
 *  - All libraries $config["app_libraries"] = "*";
 *  - Just the two I nedd $config["app_libraries"] = array("Validator", "Email");
 * 
 * Library names should be the same as the files existing on system/library 
 * folder
 * 
 */
$config["app_libraries"] = "*";
/**
 * The value of the key to be ussed on all the encryption process. 
 * Encryption is made using AES security
 */
$config["aes_key"] = "stefanframework";
//==============================================================================
// System core configuration. Don't mess with this, don't be a little bitch
//==============================================================================

/**
 * Systeam definitionS
 */
define("SF_VERSION_NUMBER", "3.0");
define("SF_VERSION", "Rachel Roxxx");

define("DS", DIRECTORY_SEPARATOR);
define("APPPATH" , dirname(__FILE__) . DS . $config["app_folder"]);
define("SYSPATH", dirname(__FILE__) . DS . $config["system_folder"]);

define("LOADPATH", SYSPATH . DS . "load");
define("LIBRARYPATH", SYSPATH . DS . "library");
define("DEBUGPATH", SYSPATH . DS . "debug");

define("VIEW_VERSION", "system/version");
define("VIEW_WELCOME", "");

/**
 * Error definition
 */
define("ERROR_101", "<b>Error - 101:</b> System could not find bootstrap file");
define("ERROR_102", "<b>Error - 102:</b> System could not perform autoloading process");
define("ERROR_103", "<b>Error - 103:</b> System could not load library ");
define("ERROR_104", "<b>Error - 104:</b> System could not load aplication config");

/**
 * Bootstrap launch
 */
if (file_exists(LOADPATH . DS . "bootstrap.php")) {
    if (!(require_once LOADPATH . DS . "bootstrap.php")){
        echo ERROR_101 . "<br>";
        exit(1);
    }
} else {
    echo ERROR_101 . "<br>";
    exit(1);
}

