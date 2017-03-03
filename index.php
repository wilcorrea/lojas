<?php
    define('DIR', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);
	date_default_timezone_set('America/Sao_Paulo');
	
	include 'App/Bootstrap.php';
	include 'App/Routes.php';
	
    $app->run();