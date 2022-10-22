<?php

use DBConnection\DBConnect;
use Slim\Container;
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/configs/Auth.php';

$container = New Container();
$DBConnect = new DBConnect();
global $pdo;
global $auth;
$pdo = $DBConnect;
$auth = new Auth();
/**
 * @return DBConnect
 */
$container['DBConnect'] = $DBConnect;
return $container;