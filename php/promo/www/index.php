<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../autoload.php';

$uriPath = parse_url($_SERVER['REQUEST_URI'])['path'];

$action = (new \promo\Route())->action($uriPath);
echo $action->run();
