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
 * @name Lookup_Estate
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 

class Lookup_Estate {

	public $estateComboBox = array();

	public function __construct($view) {
		return $this -> estateComboBox = 
				array(
				'contact_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Personal'), 
					2 	=> $view -> __('ComboBox_Business firm'), 
					), 
				'boundary' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_None'), 
					2 	=> $view -> __('ComboBox_Wall'), 
					3 	=> $view -> __('ComboBox_Fence'),
					4 	=> $view -> __('ComboBox_Others'),
					),
				'real_estate_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Residential'), 
					2 	=> $view -> __('ComboBox_Commercial'), 
					3 	=> $view -> __('ComboBox_Industrial'),
					4 	=> $view -> __('ComboBox_Recreational'),
					5 	=> $view -> __('ComboBox_Educational'),
					6 	=> $view -> __('ComboBox_Others'),
					),
				'real_estate_for' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Rent'), 
					2 	=> $view -> __('ComboBox_Sale'), 
					3 	=> $view -> __('ComboBox_Share'),
					),
				'Kitchen' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Internal'), 
					2 	=> $view -> __('ComboBox_External'), 
					3 	=> $view -> __('ComboBox_Both'), 
					), 
				'majlas' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Male'), 
					2 	=> $view -> __('ComboBox_Female'), 
					3 	=> $view -> __('ComboBox_Both'), 
					), 
				'drainage_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Pipe_Line'), 
					2 	=> $view -> __('ComboBox_Septic_Tank'), 
					), 
				'roof_type' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Clay Bricks'), 
					2 	=> $view -> __('ComboBox_GI_Sheet_Kerby'), 
					3 	=> $view -> __('ComboBox_regular'), 
					), 
				'paved_road' => array(
					'' 	=> $view -> __('Root'),
					1 	=> $view -> __('ComboBox_Clay Yes'), 
					2 	=> $view -> __('ComboBox_Mostly'), 
					), 
				'estate_status' => array(
					'' 			=> $view -> __('Root'),
					'Pending' 	=> $view -> __('ComboBox_Pending'), 
					'Rented' 	=> $view -> __('ComboBox_Rented'), 
					'Available' => $view -> __('ComboBox_Available'), 
					'Blocked' 	=> $view -> __('ComboBox_Blocked'),
					),
				'money_status' => array(
					'' 			=> $view -> __('Root'),
					'Pending' 	=> $view -> __('ComboBox_Pending'), 
					'Sold' 		=> $view -> __('ComboBox_Sold'), 
					'Blocked' 	=> $view -> __('ComboBox_Blocked'),
					),
				);
	}

}
