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
 * @package Vehicle
 * @subpackage Model
 * @name Vehicle_Model_ForSale
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Model_ForSale extends Aula_Model_DbTable {

	protected $_name = 'vehicle_for_sale';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'job_car_number', 'contact_type', 'contact_nid_cr', 'contact_bb', 'contact_full_name', 'plate_number', 'advertise_period', 'advertise_date', 'mobile_1', 'mobile_2', 'email', 'cost', 'swap', 'negotiable', 'type_id', 'make_id', 'model_id', 'year_id', 'mileage', 'body_color_id', 'inside_color_id', 'gear_type_id', 'seat_type_id', 'number_of_cylinders', 'cd', 'dvd', 'gps', 'sunroof', 'Warranty_until', 'window_type_id', 'drag_system_id', 'fuel_type_id', 'fuel_tank_size', 'engine_size', 'horse_power', 'spare_tire_id', 'thermal_insulation_film', 'body_protective_film', 'vehicle_registration_expiry', 'insurance_type', 'abs', 'automatic_parking', 'parking_sensors', 'rear_camera', 'front_lights', 'led_rear_lights', 'sport_exhaust', 'alarm_system', 'portable_roof', 'airbags', 'driving_control_system', 'ir_monitor', 'bluetooth', 'ipod_port', 'usb_port', 'external_mirrors_heating', 'dimmed_glass', 'self_dimming_internal_mirror', 'electrical_seats', 'heated_seats', 'massage_in_seats', 'ventilated_seats', 'number_of_seats', 'number_of_doors', 'used_by_lady', 'gearbox_changed', 'accident_free', 'original_engine_changed', 'money_status', 'status', 'created_by', 'created_date', 'modified_by', 'modified_date', 'locale_id', 'approved', 'approved_date', 'published', 'publish_date', 'comments', 'options', );

		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS 
			  `id`, 
		  	  `job_car_number`, 
			  `contact_type`, 
			  `contact_nid_cr`, 
			  `contact_bb`, 
			  `contact_full_name`, 
			  `plate_number`, 
			  `advertise_period`, 
			  `advertise_date`, 
			  `mobile_1`, 
			  `mobile_2`, 
			  `email`, 
			  `cost`, 
			  `swap`, 
			  `negotiable`, 
			  `type_id`, 
			  `make_id`, 
			  `model_id`, 
			  `year_id`, 
			  `mileage`, 
			  `body_color_id`, 
			  `inside_color_id`, 
			  `gear_type_id`, 
			  `seat_type_id`, 
			  `number_of_cylinders`, 
			  `cd`, 
			  `dvd`, 
			  `gps`, 
			  `sunroof`, 
			  `Warranty_until`, 
			  `window_type_id`, 
			  `drag_system_id`, 
			  `fuel_type_id`, 
			  `fuel_tank_size`, 
			  `engine_size`, 
			  `horse_power`, 
			  `spare_tire_id`, 
			  `thermal_insulation_film`, 
			  `body_protective_film`, 
			  `vehicle_registration_expiry`, 
			  `insurance_type`, 
			  `abs`, 
			  `automatic_parking`, 
			  `parking_sensors`, 
			  `rear_camera`, 
			  `front_lights`, 
			  `led_rear_lights`, 
			  `sport_exhaust`, 
			  `alarm_system`, 
			  `portable_roof`, 
			  `airbags`, 
			  `driving_control_system`, 
			  `ir_monitor`, 
			  `bluetooth`, 
			  `ipod_port`, 
			  `usb_port`, 
			  `external_mirrors_heating`, 
			  `dimmed_glass`, 
			  `self_dimming_internal_mirror`, 
			  `electrical_seats`, 
			  `heated_seats`, 
			  `massage_in_seats`, 
			  `ventilated_seats`, 
			  `number_of_seats`, 
			  `number_of_doors`, 
			  `used_by_lady`, 
			  `gearbox_changed`, 
			  `accident_free`, 
			  `original_engine_changed`, 
			  `money_status`, 
			  `status`, 
			  `created_by`, 
			  `created_date`, 
			  `modified_by`, 
			  `modified_date`, 
			  `locale_id`, 
			  `approved`, 
			  `approved_date`, 
			  `published`, 
			  `publish_date`, 
			  `comments`, 
			  `options`, 
		';
		parent::__construct();
	}

	public function getAllForSale_OrderByColumnWithLimit($column, $sorting, $start, $limit) {
		$start = ( int )($start);
		$limit = ( int )($limit);

		$column  = mysql_real_escape_string($column);
		$sorting = mysql_real_escape_string($sorting);

		$result = $this 
		-> select() 
		-> from($this -> _name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))
		-> order("$column $sorting") 
		-> limit("$start, $limit") 
		-> query() 
		-> fetchAll();

		return $result;
	}

	public function getAllType() {
		$result = $this -> select() -> from($this -> _name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->      where ('id > ?', 1)*/
		-> query() -> fetchAll();

		return $result;
	}

	public function getTypeById($id) {
		$id = (int)$id;
		$result = $this -> select() -> from($this -> _name) -> joinInner('locale', $this -> _name . '.locale_id=locale.id', array('title as locale_title')) -> where($this -> _name . '.id = ?', $id) -> setIntegrityCheck(false) -> query() -> fetch();

		return $result;
	}

}
