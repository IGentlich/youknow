<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('MB_BASE_PATH', __DIR__.'/');

require_once(MB_BASE_PATH."bootstrap.php");
require_once(MB_BASE_PATH."launcher.php");

$launcher = new Launcher();
$launcher->start();