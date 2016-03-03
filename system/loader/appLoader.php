<?php

/**
 * App configuration Loading
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
 * App User autoloading 
 */
foreach ($config["user_autoload"] as $folder) {
    $dir = APPPATH . DS . $folder;
    if (file_exists($dir)) {
        foreach (glob($dir . DS . "*.php") as $lib) {
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
    } else {
        echo ERROR_109 . " " . basename($folder) . "<br>";
        exit(1);
    }
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
