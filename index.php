<?php
session_start();

require ('vendor/autoload.php');
$GLOBALS['routes'] = require('config/routes.php');

// Initilize a loader
$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory('modules');
$loader->addDirectory('themes');
$loader->addDirectory('nui');
$loader->addDirectory('config');

$loader->setTempDirectory('nui/temp');
$loader->register();

// Handling the configuration files
$map = require('nui/config.map.php');

foreach ($map as $key => $config) {
    $handler = new Nui\Config\Handler();
    $handler->set($config);
    $handler->parse();
    $GLOBALS['settings'][$key] = ($handler->get());
}

// Starting a new app
$app = new Nui\Application();
$app->setRoutes($GLOBALS['routes']);

$GLOBALS['language_manager'] = new Nui\Environment\LanguageManager;

// Database configuration
if (isset($GLOBALS['settings']['main']->database['driver'])) {
    $database = new Nui\Config\Database;
    $GLOBALS['settings']['em'] = $database->handle();
}

try {
    $app->startSession();
} catch (Exception $e) {
    $controller = new Modules\Error\Controllers\Bootstrap();
    $controller->init($e);
}

$_SESSION['flash'] = [];