<?php

    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);

    session_start();

    define('ROOT', dirname(__FILE__));

    require_once(ROOT.'/components/Autoloader.php');

    $autoloader = new Autoloader();
    $autoloader->initiate(ROOT);

    Developer::nocache();

    $router = new Router(ROOT);
    $router->start();
?>