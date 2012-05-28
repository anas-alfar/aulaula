<?php

class Aula_Controller_Default {

	public $settings = NULL;
	public $request = NULL;

	public function __construct() {
		if (method_exists($this, '_init')) {
			$this -> _init();
		}
		return $this;
	}

	protected function cleanData(&$blackList) {
		if (!empty($blackList)) {
			foreach ($blackList as $index => &$value) {
				if (is_array($value)) {
					$this -> cleanData($value);
				} else {
					$GLOBALS['AULA_BLACKLIST'][$index] = $value;
					$value = iconv('utf-8', 'utf-8//IGNORE', $value);
					$blackList[$index] = filter_var($value, FILTER_SANITIZE_STRING);
				}
			}
		}
	}

	protected function dispatcher() {
		$routerObj = new Aula_Model_Router($this);
		$this -> request = $routerObj -> routeRequest();
		$this -> request = $routerObj -> mapRequest();
		$this -> request -> adminPackage = $this -> settings -> code -> admin_package;
		$this -> request -> adminController = $this -> settings -> code -> default_admin_controller;
		$this -> request -> adminAction = $this -> settings -> code -> default_admin_action;
		$this -> request -> adminHandler = $this -> settings -> code -> default_admin_handler;
		if (!$this -> request = $routerObj -> loadController($this)) {
			header('Location: /');
			exit();
		}
	}
	
	protected function _resetDebugHandler () {
		restore_error_handler();
		restore_exception_handler();
	}
	
	public function setDebugMode() {
		if (( int )$this -> settings -> debug -> enabled) {
			/*
			 * Remember that the error_reporting value is an integer, not a string ie "E_ALL & ~E_NOTICE",
			 * so, error_reporting ( $this->settings->debug->level ); will not work , you should to convert
			 * the variable ($this->settings->debug->level ) form string to integer
			 * we need function to convert the string to integer , with caring of bitwise comparison
			 * array ('E_ERROR' => 1, 'E_WARNING' => 2, 'E_PARSE' => 4, 'E_NOTICE' => 8, 'E_CORE_ERROR' => 16, 'E_CORE_WARNING' => 32, 'E_COMPILE_ERROR' => 64, 'E_COMPILE_WARNING' => 128, 'E_USER_ERROR' => 256, 'E_USER_WARNING' => 512, 'E_USER_NOTICE' => 1024, 'E_ALL' => 2047 );
			 */
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
			set_error_handler("Aula_Model_Exception::aulaErrorsHandler");
			set_error_handler("Aula_Model_Exception::aulaErrorsHandler");
		} else {
			error_reporting(0);
			ini_set('display_errors', 'Off');
		}
	}

}
