<?
namespace app;

class Router 
{
	protected $routes = [];
	protected $params = [];

	public function __construct()
	{
		$routes = require 'routes.php';
		foreach ($routes as $key => $value) {
			$this->add($key, $value);
		}
	}

    public function add($route, $params) {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match() {
        $parse = parse_url(preg_replace('/\/{2,}/', "", $_SERVER['REQUEST_URI']));
        $url = trim($parse['path'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

	public function run() {
		if($this->match()) {
			$path = 'controllers\\'.ucfirst($this->params['controller']).'Controller';			
			if(class_exists($path)){
				$action = $this->params['action'].'Action';
				if(method_exists($path, $action)){

					$controller = new $path($this->params);
					$controller->$action();
					
				}else View::errorCode('501');// Не найден Action
			}else View::errorCode('502');//Не найден Controller
		}else View::errorCode('404','Страница не найдена'); //Маршрут не найден!
	}
}