<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$action = (new \promo\Route())->action($uri);
echo $action->handle();
