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
 * @package Library
 * @subpackage Lookup
 * @name Lookup_Vehicle
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 

class Lookup_Vehicle {

	public $vehicleComboBox = array();

	public function __construct($view) {
		return $this -> vehicleComboBox = 
				array(
				'vehicle_status' => array(
					'' 			=> $view -> __('Root'),
					'Pending' 	=> $view -> __('ComboBox_Pending'), 
					'Sold' 		=> $view -> __('ComboBox_Sold'), 
					'Blocked' 	=> $view -> __('ComboBox_Blocked'),
					),
				'money_status' => array(
					'' 			=> $view -> __('Root'),
					'Pending' 	=> $view -> __('ComboBox_Pending'), 
					'Sold' 		=> $view -> __('ComboBox_Sold'), 
					'Blocked' 	=> $view -> __('ComboBox_Blocked'),
					),
				'gear_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Manual'), 
					2 	=> $view -> __('ComboBox_Automatic'), 
					3 	=> $view -> __('ComboBox_Triptronic'),
					4 	=> $view -> __('ComboBox_F1'),
					5 	=> $view -> __('ComboBox_SMG'),
					), 
				'seat_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Cloth'), 
					2 	=> $view -> __('ComboBox_Leather'), 
					3 	=> $view -> __('ComboBox_Any')
					), 
				'window_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Manual'), 
					2 	=> $view -> __('ComboBox_Electrical'), 
					), 
				'fuel_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Gas'), 
					2 	=> $view -> __('ComboBox_Hybrid'), 
					3 	=> $view -> __('ComboBox_Diesel'), 
					4 	=> $view -> __('ComboBox_Gasoline'), 
					), 
				'spare_tire' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Hanged'), 
					2 	=> $view -> __('ComboBox_Bottom'), 
					3 	=> $view -> __('ComboBox_Both'), 
					), 
				'contact_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Personal'), 
					2 	=> $view -> __('ComboBox_Business firm'), 
					), 
				);
	}

}
