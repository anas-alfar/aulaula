<?php

class Aula_Model_Auth extends Aula_Model_Default {
	
	private $_storageClass = NULL;
	private $_storageObj = NULL;
	
	public static $isLoggedIn = false;
	
	public function _init($storage = NULL) {
		$this->_storageClass = $storage;
		if (is_null ( $this->_storageClass )) {
			//initialize to the system default language
			$settings = Zend_Registry::get ( 'settings-basic' );
			$this->_storageClass = $settings->default_storage;
		}
		$this->setStorage ( $this->_storageClass );
	}
	
	public function getStorage() {
		if (is_null($this->_storageObj)) {
			$this->setStorage ( new $this->_storageClass () );
		}
		return $this->_storageObj;
	}
	
	public function setStorage($storage) {
		$this->_storageObj = new $storage ();
		$this->_storageObj->_init ();
	}
	
	public function hasIdentity() {
		return self::$isLoggedIn = $this->getStorage ()->hasIdentity ();
	}
	
	public function clearIdentity() {
		$this->getStorage ()->clearAll ();
	}
}
