<?php

$url = filter_input(INPUT_GET, "url");

/**
 * Special views
 */
if (!$config["app_enable"]) {
    if ($config["app_enable_view"] != "") {
        require_once APPPATH . DS . "views" . DS . $config["app_enable_view"];
        exit(1);
    } else {
        require_once DEBUGPATH . DS . "enable.php";
        exit(1);
    }
}

if ($url == VIEW_VERSION) {
    require_once DEBUGPATH . DS . "version.php";
    exit(1);
}

if ($url == VIEW_WELCOME) {
    if ($config["app_welcome_view"] != "") {
        require_once APPPATH . DS . "views" . DS . $config["app_welcome_view"];
        exit(1);
    } else {
        require_once DEBUGPATH . DS . "welcome.php";
        exit(1);
    }
}

/**
 * App Views
 */
$urlArray = explode("/", $url);

$controller = $urlArray[0];
array_shift($urlArray);
$action = $urlArray[0];
array_shift($urlArray);
$arguments = $urlArray;

$obj = new $controller();

if (method_exists($controller, $action)) {
    call_user_func_array(array($obj, $action), $arguments);
} else {
    echo ERROR_106 . $action . "<br>";
    exit(1);
}

