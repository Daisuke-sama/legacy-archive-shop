<?php
/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 02-Sep-16
 * Time: 7:35 PM
 */

// FRONT cntroller

// 1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once ROOT . '/components/Autoload.php';

// 3. Установка соединения с БД


// 4. Вызов Router
$route = new Router();
$route->run();