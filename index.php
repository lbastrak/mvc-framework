<?php
/**
* (Model–view–controller) Framework 
* @author Arkady Paramazyan <arkadlk.456@mail.ru>
* @version 3.22
*/

require __DIR__ . '/config.php';
require __DIR__ . '/library/Dev.php';

define('SITE_HOST', siteHost());

date_default_timezone_set(Config::timezone);

use app\Router;

spl_autoload_register( function($class) {
	    $path = str_replace('\\', '/', $class.'.php');
	    if (file_exists($path)) {
	        require $path;
	    }
	}
);

session_name('_qv_sessid');
session_start();

$router = new Router;
$router->run();


