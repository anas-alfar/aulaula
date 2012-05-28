<?php

class Aula_Model_Cookie extends Aula_Model_Default {
	private $expire = '';
	private $path = '';
	private $domain = '';
	private $secure = '';
	private $httponly = '';
	private $expiredTime = '';
	private $identityCheck = array ();
	
	public function _init($expire = 3600, $path = '/', $domain = NULL, $secure = false, $httponly = false) {
		if (is_null ( $domain )) {
			//initialize to the system default language
			$settings = Zend_Registry::get ( 'settings' );
			$this->_storageClass = $settings->cookie_domain;
		}
		$this->expiredTime = time () - 2592000;
		$this->setCookieParameters ( $expire, $path, $domain, $secure, $httponly );
		$this->identityCheck = array ('isLoggedIn' => false, 'username' => '' );
	}
	
	public function setCookieParameters($expire = 3600, $path = '/', $domain = NULL, $secure = false, $httponly = false) {
		if (is_null ( $domain )) {
			//initialize to the system default language
			$settings = Zend_Registry::get ( 'settings' );
			$this->_storageClass = $settings->cookie_domain;
		}
		$this->expire = time () + $expire;
		$this->path = $path;
		$this->domain = $domain;
		$this->secure = $secure;
		$this->httponly = $httponly;
	}
	
	public function read($key = null) {
		if (! is_null ( $key ) and isset ( $_COOKIE [$key] )) {
			return $_COOKIE [$key];
		}
		return null;
	}
	
	public function write($key, $value) {
		if (isset ( $key ) and isset ( $value )) {
			return setcookie ( $key, $value, $this->expire, $this->path, $this->domain, $this->secure, $this->httponly );
		}
		return null;
	}
	
	public function clear($key) {
		if (! is_null ( $key ) and isset ( $_COOKIE [$key] )) {
			setcookie ( $key, null, $this->expiredTime );
		}
		return null;
	}
	
	public function clearAll(&$_COOKIE) {
		if (! empty ( $_COOKIE )) {
			foreach ( $_COOKIE as $key => &$value ) {
				if (is_array ( $value )) {
					$this->clearAll ( $value );
				} else {
					setcookie ( $key, null, $this->expiredTime );
				}
			}
		}
	}
	
	public function hasIdentity() {
		foreach ( $this->identityCheck as $key => $cond ) {
			if (isset ( $_COOKIE [$key] ) and ($_COOKIE [$key] != $cond)) {
				continue;
			}
			return false;
		}
		return true;
	}
}