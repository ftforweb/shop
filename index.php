<?php
// Format: dd-mm-yyyy
/*$string = '06-11-2018';
//format  mm-dd -yyyy
$pattern = '/([0-9]{2}-([0-9]{2}-([0-9]{4})/';

$replacement = 'Month $2, Day $1, Year $3';
echo preg_replace($pattern, $replacement, $string);

die;*/

// FRONT CONTROLLER

// 1. Общие настройки

    ini_set('display_errors',1);
    error_reporting(E_ALL);

// 2. Подключение файлов системы
    define('ROOT', dirname(__FILE__));
    require_once (ROOT.'/components/Router.php');
    require_once (ROOT.'/components/Db.php' );
// 3. Установка соединения с бд

// 4. Вызов Router

$router = new Router();
$router->run();

require_once(ROOT. '/views/index.php');