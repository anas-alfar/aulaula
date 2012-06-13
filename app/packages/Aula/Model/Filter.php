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
 * @name Aula_Model_Filter
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Aula_Model_Filter extends Aula_Model_Default {
	private $_unicode = '';
	
	public function __construct($_unicode = 'UTF-8') {
		$this->_unicode = $_unicode;
	}
	
	public function trimData(&$array) {
		if (! empty ( $array )) {
			foreach ( $array as $key => &$value ) {
				if (is_array ( $value )) {
					$this->trimData ( $value );
				} else {
					$array [$key] = trim ( $value );
				}
			}
		}
	}
	
	public function sanitizeData(&$array) {
		if (! empty ( $array )) {
			foreach ( $array as $key => &$value ) {
				if (is_array ( $value )) {
					$this->sanitizeData ( $value );
				} else {
					$array [$key] = htmlentities ( $value, ENT_COMPAT, $this->_unicode );
				}
			}
		}
	}
	
	public function unSanitizeData($data) {
		return html_entity_decode ( $data, ENT_COMPAT, $this->_unicode );
	}
	
	public function clear(&$array) {
		if (! empty ( $array )) {
			foreach ( $array as $key => &$value ) {
				if (is_array ( $value )) {
					$this->clear ( $value );
				} else {
					unset ( $array [$key] );
				}
			}
		}
	}
	
	public function &initData($fields, $array) {
		$arrayData = array ();
		if (! empty ( $fields )) {
			foreach ( $fields as $key => $value ) {
				if (isset ( $array [$key] ) and (! empty ( $array [$key] ))) {
					$arrayData [$key] ['value'] = $array [$key];
					//check this field if required or not, if yes, then we set required to 1
					//if not, we check if the user fill this optional field, if yes, 
					//then it becomes required, and there for we should validate
					//and since we already checked in the if statement above, 
					//then all fields pasased here shoudl be set to required
					//$arrayData [$key] ['required'] = $value [1];
					$arrayData [$key] ['required'] = 1;
					$arrayData [$key] ['errorMessage'] = '';
					$arrayData [$key] ['errorMessageStyle'] = 'display: none;';
					$arrayData [$key] ['successMessage'] = '';
					$arrayData [$key] ['successMessageStyle'] = 'display: none;';
				} else {
					//check if we have a default value passed tp this field, then we use it
					$arrayData [$key] ['value'] = (isset ( $value [2] ) ? $value [2] : '');
					$arrayData [$key] ['required'] = $value [1];
					$arrayData [$key] ['errorMessage'] = '';
					$arrayData [$key] ['errorMessageStyle'] = 'display: none;';
					$arrayData [$key] ['successMessage'] = '';
					$arrayData [$key] ['successMessageStyle'] = 'display: none;';
				}
			}
			return $arrayData;
		}
	}
	
	public function template(&$array, &$obj) {
		if (! empty ( $array )) {
			foreach ( $array as $key => &$value ) {
				if (is_array ( $value )) {
					$this->template ( $value, $obj );
				} else {
					$array [$key] = $obj->tempFunction ( $value );
				}
			}
		}
	}
}