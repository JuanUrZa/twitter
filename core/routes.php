<?php

function loadController($controller)
{
    $nameController = ucwords($controller) . "Controller";
    $FileController = "Controllers/" . ucwords($controller) . ".php";

    if (!is_file($FileController)) {
        $FileController = "Controllers/" . ucwords(PRINCIPAL_CONTROLLER) . ".php";
    }
    require_once $FileController;
    $controller = new $nameController();
    return $controller;
}

function loadAction($action, $controller)
{
    if (isset($action) && method_exists($controller, $action)) {
        $controller->$action();
    }
}
