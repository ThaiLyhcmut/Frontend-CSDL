<?php
// public/index.php

// Autoload classes
require_once './vendor/autoload.php';
require_once './config/setResposHandler.php';
require_once './config/header.php';
// Include necessary files
require_once './core/App.php';
require_once './core/Controller.php';
require_once './core/Model.php';
require_once './core/Router.php';

// Create the app and run it
$app = new App();
$app->run();
