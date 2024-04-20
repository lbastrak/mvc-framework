<?php
namespace app;

class View
{
	public $path;
	public $route;
	public $layout = 'default';
	public $footer = '';

	public function __construct($route) {
		
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
		View::check_csrf();
	}

	private static function check_csrf() {

		if(!isset($_COOKIE['_csrf']) || !isset($_SESSION['csrf'])) {

			unset($_COOKIE['_csrf']);
   			setcookie('_csrf', null, -1, '/');

			$token = create_token(60);
			setcookie('_csrf', $token, 0, '/');
			$_SESSION['csrf'] = $token;
			return $token;
		}
	}

	public function render($title, $vars = []) {
		
		
		if(file_exists('views/'.$this->path.'.php')) {

			extract($vars);
			ob_start();
			require 'views/'.$this->path.'.php';
			$content = ob_get_clean();
			require 'views/layouts/'.$this->layout.'.php';
			if($this->footer != '')
				require 'views/layouts/'.$this->footer.'.php';

		}else View::errorCode('504'); //Не найден вид
	}

	public static function errorCode($code,$message = "") {
		http_response_code($code);
		require 'views/main/error.php';
		exit;
	}

	public function location($location) {
		header("Location: $location");
		exit();
	}

	public static function csrf() {
		
		if(!isset($_COOKIE['_csrf']) || is_array($_COOKIE['_csrf']) || !preg_match("/^[A-z0-9]{60}$/", $_COOKIE['_csrf']) || $_COOKIE['_csrf'] != $_SESSION['csrf']) {
			$token = create_token(60);
			setcookie('_csrf', $token);
			$_SESSION['csrf'] = $token;
			return View::errorCode(500, 'invalid request');
		}
		return $_COOKIE['_csrf'];
	}

	public function link($action = '') {
		
		if($action == '')
			$action = $this->route['action'];
		
		$routes = require 'routes.php';
		foreach ($routes as $href => $route) {
			
			if($route['action'] == $action)
				return SITE_HOST . $href;
		}
		return false;
	}
}