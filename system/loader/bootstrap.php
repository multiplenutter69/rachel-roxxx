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
 * System Library autoloading
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
 *  System Controller Loading
 */
if (file_exists(SYSPATH . DS . "controller" . DS . "StefanController.php")) {
    if (!(require_once SYSPATH . DS . "controller" . DS . "StefanController.php")) {
        echo ERROR_107 . "StefanController.php<br>";
        exit(1);
    }
} else {
    echo ERROR_107 . "StefanController.php<br>";
    exit(1);
}



/**
 * System Model Loading
 */


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

/**
 * App Controller Loading
 */
foreach (glob(APPPATH . DS . "controllers" . DS . "*.php") as $lib) {
    if (file_exists($lib)) {
        if (!(require_once $lib)) {
            echo ERROR_107 . " " . basename($lib) . "<br>";
            exit(1);
        }
    } else {
        echo ERROR_107 . " " . basename($lib) . "<br>";
        exit(1);
    }
}

/**
 * App entities Loading
 */
foreach (glob(APPPATH . DS . "entities" . DS . "*.php") as $lib) {
    if (file_exists($lib)) {
        if (!(require_once $lib)) {
            echo ERROR_109 . " " . basename($lib) . "<br>";
            exit(1);
        }
    } else {
        echo ERROR_109 . " " . basename($lib) . "<br>";
        exit(1);
    }
}


/**
 * View Loader
 */
if (file_exists(LOADPATH . DS . "viewLoader.php")) {
    if (!(require_once LOADPATH . DS . "viewLoader.php")) {
        echo ERROR_105 . "<br>";
        exit(1);
    }
} else {
    echo ERROR_105 . "<br>";
    exit(1);
}
