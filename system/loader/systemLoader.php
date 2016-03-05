<?php

/**
 * System Enviroment configuration
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
 * System Library Loading
 */
if ($config["app_libraries"] == "*") {
    foreach (glob(LIBRARYPATH . DS . "*.php") as $lib) {
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
 * System Collections Loading
 */
foreach (glob(COLLECTIONPATH . DS . "*.php") as $lib) {
    if (file_exists($lib)) {
        if (!(require_once $lib)) {
            echo ERROR_103 . " " . basename($lib) . "<br>";
        }
    } else {
        echo ERROR_103 . " " . basename($lib) . "<br>";
    }
}

/**
 * System Model RDB Driver Loading
 */
$driver = $config["db_driver"] . ".php";
$driverPath = MODELPATH . DS . "RDBDrivers" . DS . $driver;
if (file_exists($driverPath)) {
    if (!(require_once $driverPath)) {
        echo ERROR_113 . $driver . "<br>";
        exit(1);
    }
} else {
    echo ERROR_113 . $driver . "<br>";
    exit(1);
}

/**
 * System Model SQL Builders Loading
 */
$builder = substr($config["db_driver"], 0, 5) . "Builder.php";
$builderPath = MODELPATH . DS . "SQLBuilders" . DS . $builder;
if (file_exists($builderPath)) {
    if (!(require_once $builderPath)) {
        echo ERROR_113 . $builder . "<br>";
        exit(1);
    }
} else {
    echo ERROR_113 . $builder . "<br>";
    exit(1);
}

/**
 * System Model Loading
 */
if (file_exists(MODELPATH . DS . "StefanModel.php")) {
    if (!(require_once MODELPATH . DS . "StefanModel.php")) {
        echo ERROR_112 . "StefanModel.php<br>";
        exit(1);
    }
} else {
    echo ERROR_112 . "StefanModel.php<br>";
    exit(1);
}

/**
 *  System Controller Loading
 */
if (file_exists(CONTROLLERPATH . DS . "StefanController.php")) {
    if (!(require_once CONTROLLERPATH . DS . "StefanController.php")) {
        echo ERROR_107 . "StefanController.php<br>";
        exit(1);
    }
} else {
    echo ERROR_107 . "StefanController.php<br>";
    exit(1);
}