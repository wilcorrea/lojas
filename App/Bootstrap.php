<?php
    require 'App/Session.php';
    require 'App/Cookie.php';
    require 'App/Loader.php';
    require 'vendor/autoload.php';
	use App\Session;
	use App\Cookie;
    use App\Loader;
	
	Session::start();
	
    $loader = new Loader();
    $loader->register();
	
    $app = new DRouter\App();
    $app->render->setViewsFolder(__DIR__.'/Views/');
	$app->render->setAsGlobal(['root' => $app->root()]);
	
	$_SESSION['token'] = (!isset($_SESSION['token'])) ? hash('sha512', rand(10, 1000)) : $_SESSION['token'];
	
	$container = $app->getContainer();
	$container->db = $container->shared(function(){
		try {
			return new \PDO('mysql:host=localhost;dbname=sistema', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		} catch(\PDOException $e) {
			die($e->getMessage());
		}
	});