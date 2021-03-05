<?php

$router = $di->getRouter();

// Define your routes here

$router->add(
    "/mrp/:controller/:action/:params",
    array( "controller" => 1, "action" => 2, "params" => 3, "dir" => '$config->application->controllersMrpDir')
);

$router->add(
    "/mrp/:controller/",
    array( "controller" => 1, "action" => 'index', "dir" => '$config->application->controllersMrpDir')
);

$router->add(
    "/mrp/:controller",
    array( "controller" => 1, "action" => 'index', "dir" => '$config->application->controllersMrpDir')
);

$router->handle();
