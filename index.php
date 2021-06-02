<?php
require_once "config/config.php";
require_once "core/routes.php";
require_once "config/file.php";
require_once "controllers/users.php";
require_once "controllers/messages.php";

if (isset($_GET['c'])) {
    echo"Controles por url";
    $controller = loadController($_GET['c']);

    if (isset($_GET['a'])) {
        loadAction($_GET['a'], $controller);
    } else {
        loadAction(PRINCIPAL_ACTION, $controller);
    }
} else {
    echo"Controles por defecto";
    $controller = loadController(PRINCIPAL_CONTROLLER);
    $action = PRINCIPAL_ACTION;
    $controller->$action();
}

