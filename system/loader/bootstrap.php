<?php

/**
 * System Loader
 */
if (file_exists(LOADPATH . DS . "systemLoader.php")) {
    if (!(require_once LOADPATH . DS . "systemLoader.php")) {
        echo ERROR_110 . "<br>";
        exit(1);
    }
} else {
    echo ERROR_110 . "<br>";
    exit(1);
}

/**
 * App Loader
 */
if (file_exists(LOADPATH . DS . "appLoader.php")) {
    if (!(require_once LOADPATH . DS . "appLoader.php")) {
        echo ERROR_110 . "<br>";
        exit(1);
    }
} else {
    echo ERROR_110 . "<br>";
    exit(1);
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
