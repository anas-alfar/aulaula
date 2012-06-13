<?php

/**
 *
 * Aulaula
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the file LICENSE.txt. It is also available through
 * the world-wide-web at this URL: http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@aulaula.com
 * so we can send you a copy immediately.
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Aulaula to newer versions
 * in the future. If you wish to customize Aulaula for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Aula - Core
 * @subpackage Model
 * @name Aula_Model_Session
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

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