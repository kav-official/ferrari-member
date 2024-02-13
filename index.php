<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Origin, Cache-Control, X-Requested-With, Content-Type, Access-Control-Allow-Origin');
header('Access-Control-Allow-Methods: *');
header('Content-type: application/json');

require 'vendor/autoload.php';

//f3 bootstrap
$f3 = Base::instance();
$f3->config('config/config.ini');
$f3->config('config/routes.ini');

date_default_timezone_set($f3->get('TIMEZONE'));

$f3->run();