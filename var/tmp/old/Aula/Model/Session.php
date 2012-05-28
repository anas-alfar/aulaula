<?php

class Aula_Model_Session extends Aula_Model_Default {
	private $identityCheck = array ();
	
	public function _init() {
		$this->identityCheck = array ('isLoggedIn' => 0, 'username' => '' );
	}
	
	public function read($key = null) {
		if (! is_null ( $key ) and isset ( $_SESSION [$key] )) {
			return $_SESSION [$key];
		}
		return null;
	}
	
	public function write($key, $value) {
		if (isset ( $key ) and isset ( $value )) {
			return $_SESSION [$key] = $value;
		}
		return null;
	}
	
	public function clear($key) {
		if (! is_null ( $key ) and isset ( $_SESSION [$key] )) {
			session_unregister ( $key );
			session_unset ();
			session_destroy ();
			unset ( $_SESSION [$key] );
		}
		return null;
	}
	
	public function clearAll(&$_SESSION_ARRAY = NULL) {
		if (is_null ( $_SESSION_ARRAY )) {
			$_SESSION_ARRAY = $_SESSION;
		}
		if (! empty ( $_SESSION_ARRAY )) {
			foreach ( $_SESSION_ARRAY as $key => &$value ) {
				if (is_array ( $value )) {
					$this->clearAll ( $value );
				} else {
					session_unregister ( $key );
					unset ( $_SESSION_ARRAY [$key] );
				}
			}
		}
	}
	
	public function hasIdentity() {
		foreach ( $this->identityCheck as $key => $cond ) {
			if (isset ( $_SESSION [$key] ) and ($_SESSION [$key] != $cond)) {
				continue;
			}
			return false;
		}
		return true;
	}
}