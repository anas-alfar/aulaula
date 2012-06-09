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
 * in the future. If you wish to customize Magento for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Aula_Vehicle
 * @subpackage Controller
 * @name Vehicle_Controller_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Controller_Default extends Aula_Controller_Action {

	protected function _init() {
		
		$this -> view -> innerFooter = true;
	}

	public function defaultAction() {
		$vehicleFor = (isset($_GET['for']) and !empty($_GET['for'])) ? trim($_GET['for']) : 'sale';
		if (  !in_array($vehicleFor, array('rent', 'sale') ) ) {
			header ('Location: /');
			exit;
		}
		
		$this -> view -> vehicleFor = $vehicleFor;
		$this -> view -> render('vehicle.phtml');
	}

}
