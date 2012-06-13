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
 * @name Aula_Model_Auth
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

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
