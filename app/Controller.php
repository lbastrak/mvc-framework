<?php

namespace app;
use app\View;
use library\DB;

abstract class Controller
{
	public $route;
	public $view;
	
	public function __construct($route)
	{
		$this->route = $route;
		$this->view = new View($route);
		
	}
	public function LoadModel($name){
		$path = 'models\\'.ucfirst($name);
		if(class_exists($path)){
			return new $path;
		}
	}

}