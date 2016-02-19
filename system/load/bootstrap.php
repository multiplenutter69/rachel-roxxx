<?php
/**
 * Enviroment configuration
 */
if ($config["app_development"]) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    ini_set('error_log', DEBUGPATH . DS . "error.log");
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', DEBUGPATH . DS . "error.log");
}

/**
 * Library autoloading
 */
if ($config["app_libraries"] == "*") {
    foreach (glob(LIBRARYPATH . DS . "*.*") as $lib) {
        if (file_exists($lib)) {
            if (!(require_once $lib)) {
                echo ERROR_103 . " " . basename($lib) . "<br>";
            }
        } else {
            echo ERROR_103 . " " . basename($lib) . "<br>";
        }
    }
} else {
    foreach ($config["app_libraries"] as $lib) {
        if (file_exists(LIBRARYPATH . DS . $lib . ".php")) {
            if (!(require_once LIBRARYPATH . DS . $lib . ".php")) {
                echo ERROR_103 . " " . $lib . ".php <br>";
            }
        } else {
            echo ERROR_103 . " " . $lib . ".php <br>";
        }
    }
}

/**
 * App configuration loading
 */
if (file_exists(APPPATH . DS . "config" . DS . "config.php")) {
    if (!(require_once APPPATH . DS . "config" . DS . "config.php")) {
        echo ERROR_104 . "<br>";
        exit(1);
    }
} else {
    echo ERROR_104 . "<br>";
    exit(1);
}

$url = filter_input(INPUT_GET, "url");

/**
 * Special url views
 */
switch($url)
{
    case VIEW_VERSION:
        require_once DEBUGPATH . DS . "version.php";
        exit(1);
        break;
    case VIEW_WELCOME:
        require_once DEBUGPATH . DS . "welcome.php";
        exit(1);
        break;
    default:
        break;
}

echo $url. "<hr>";