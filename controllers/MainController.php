<?php

namespace controllers;

use app\Controller;
use models\Storage;
use models\Cells;
use models\User;
use Config;


class MainController extends Controller
{

	public function __construct($route) {
		
		parent::__construct($route);
	}

	public function welcomeAction() {

		$vars = [

		];

		return $this->view->render('Welcome - ' . Config::PROJECT_NAME, $vars);
	}
}
