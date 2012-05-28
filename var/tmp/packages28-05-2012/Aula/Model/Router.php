<?php

class Aula_Model_Router extends Aula_Model_Default {

	public $action = NULL;
	public $package = NULL;
	public $controller = NULL;
	public $controllerClass = NULL;
	public $adminAction = NULL;
	public $adminPackage = NULL;
	public $adminController = NULL;
	public $adminHandler = NULL;

	protected $_defaultAction = NULL;
	protected $_defaultPackage = NULL;
	protected $_defaultController = NULL;

	protected function _init() {
		$this -> _settings = Zend_Registry::get('settings-code');

		$this -> _defaultPackage = $this -> package = $this -> _settings -> default_package;
		$this -> _defaultController = $this -> controller = $this -> _settings -> default_controller;
		$this -> _defaultAction = $this -> action = $this -> _settings -> default_action;

		return $this;
	}

	public function routeRequest() {
		if (isset($_SERVER['HTTP_HOST']) and isset($_SERVER['SERVER_NAME']) and (0 === strcmp($_SERVER['HTTP_HOST'], $_SERVER['SERVER_NAME']))) {
			if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
				$request = $_SERVER['REQUEST_URI'];
				while (false !== strpos($request, '//')) {
					$request = str_replace('//', '/', $request);
				}
				$request = trim($request, '/');
				$request = explode('/', $request);

				if (is_array($request) && !empty($request)) {
					$_paramCount = sizeof($request);
					if ($_paramCount > 1) {
						$request = array_chunk($request, 2);
						$this -> controller = $request[0][0];
						$this -> action = $request[0][1];
						for ($i = 1; $i < $_paramCount; $i++) {
							if (isset($request[$i][0]) and isset($request[$i][1])) {
								$_GET[$request[$i][0]] = urldecode($request[$i][1]);
								$_REQUEST[$request[$i][0]] = urldecode($request[$i][1]);
							}
						}
					} else {
						if (isset($request[0]) && !empty($request[0])) {
							$this -> controller = $request[0];
							$this -> action = $this -> _defaultAction;
						}
					}

				}
			}
		} else {
			die('You are trying to hack the URL!');
		}

		return $this;
	}

	public function mapRequest() {
		//Make sure that URI is trimmed and lower case
		$this -> action = strtolower(trim($this -> action));
		$this -> controller = strtolower(trim($this -> controller));

		//Detect if the URI has (-) or (.) to identify the capital letters for classes names
		if (false !== strpos($this -> controller, '-')) {
			$this -> controller = explode('-', $this -> controller);
		} elseif (false !== strpos($this -> controller, '.')) {
			$this -> controller = explode('.', $this -> controller);
		} else {
			$_tmp = $this -> controller;
			$this -> controller = array($_tmp);
		}

		//Detect if the URI has (-) or (.) to identify the capital letters for functions names
		if (false !== strpos($this -> action, '-')) {
			$this -> action = explode('-', $this -> action);
		} elseif (false !== strpos($this -> action, '.')) {
			$this -> action = explode('.', $this -> action);
		} else {
			$_tmp = $this -> action;
			$this -> action = array($_tmp);
		}

		//Shift first element in the controller which represent the package name
		//JUST in case the controller is not the default controller
		//Otherwise, keep the package name to the default package name in the configuration file
		if (0 !== strcasecmp($this -> controller[0], $this -> _defaultController)) {
			$this -> package = ucfirst(array_shift($this -> controller));
		}

		//Concat all controller pecies to identidy the final controller class name
		if (empty($this -> controller)) {
			$this -> controller = $this -> _defaultController;
		} else {
			$this -> controller = array_map('ucfirst', $this -> controller);
			$this -> controller = implode('', $this -> controller);
		}

		//Concat all action pecies to identidy the final action function name
		if (empty($this -> action)) {
			$this -> action = $this -> _defaultAction;
		} else {
			$this -> action = array_map('ucfirst', $this -> action);
			$this -> action = implode('', $this -> action);
		}

		//Make sure that first charecter in the action/function is small letter
		$this -> action[0] = strtolower($this -> action[0]);
		return $this;
	}

	public function loadController($bootstrap) {
		//add the default postfix for functions
		$this -> action .= 'Action';
		
		//check out -if- the action belong to the admin area
		if (false !== stripos($this -> package, $this -> adminPackage)) {
			$this -> controllerClass = $this -> package . '_Controller_' . $this -> controller . 'Admin';
		} else {
			$this -> controllerClass = $this -> package . '_Controller_' . $this -> controller;
		}
		if (class_exists($this -> controllerClass)) {
			$obj = new $this->controllerClass($bootstrap);
			if (method_exists($obj, $this -> action)) {
				$obj -> {$this->action}();
				exit();
			}
			if (false !== stripos($this -> package, $this -> adminPackage)) {
				if (method_exists($obj, $this -> adminHandler)) {
					$obj -> {$this->adminHandler}();
					exit();
				}
			}
		} else {
			$this -> controllerClass = $this -> _settings -> default_package . '_Controller_' . $this -> _settings -> default_controller;
			if (class_exists($this -> controllerClass)) {
				$obj = new $this->controllerClass($bootstrap);
				if (method_exists($obj, $this -> action)) {
					$obj -> {$this->action}();
					exit();
				}
			}
		}
		return NULL;
	}

}
