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
 * @package Estate
 * @subpackage Model
 * @name Estate_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Estate_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'estate';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $id = NULL;
	public $money_status = 'Pending';
	public $status = 'Pending';
	public $approved = 'No';
	public $published = 'No';
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'job_card_number', 'contact_type', 'contact_nid_cr', 'contact_bb', 'contact_full_name', 'advertise_period', 'advertise_date', 'mobile_1', 'mobile_2', 'email', 'cost', 'swap', 'negotiable', 'longitude', 'latitude', 'location_id', 'provence_id', 'real_estate_for', 'real_estate_type_id', 'estimated_area', 'age', 'total_bed_rooms', 'total_bath_rooms', 'stories', 'furniture', 'air_condition_id', 'first_owner', 'master_bed_rooms', 'parking_garage', 'outdoor_amenities_id', 'club_house_gym', 'kitchen', 'pantries', 'powder_room', 'electricity', 'stone_cladding', 'wood_cladding', 'telephone_service', 'security', 'floor', 'front_yard', 'back_yard', 'swimming_pool', 'intercom', 'fire_alarm', 'fire_fighting', 'internet', 'flooring_type', 'built_in_clothes', 'fiber_optic', 'reflected_glass', 'maintenance', 'sub_rental', 'expatriate_owner_ship', 'majlas', 'car_shed', 'water_supply', 'drainage_type', 'fire_place', 'special_decoration', 'ceiling_type', 'dining_room', 'elevators', 'special_equipment', 'basement', 'roof_type', 'stores', 'housekeeping', 'garden', 'paved_road', 'electrical_garage_door', 'eco_green_building', 'cctv', 'building_permit_type_id', 'drainage', 'boundary', 'plants', 'water_well', 'ancillary_buildings_id', 'farmed', 'expatriate_ownership', 'details', 'live_near_1_id', 'live_near_2_id', 'live_near_3_id', 'live_near_4_id', 'longitude_1', 'latitude_1', 'longitude_2', 'latitude_2', 'longitude_3', 'latitude_3', 'longitude_4', 'latitude_4', 'money_status', 'status', 'created_by', 'created_date', 'modified_by', 'modified_date', 'locale_id', 'approved', 'approved_date', 'published', 'publish_date', 'comments', 'options', );

		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS 
  `id`,
  `job_card_number`,
  `contact_type`,
  `contact_nid_cr`,
  `contact_bb`,
  `contact_full_name`,
  `advertise_period`,
  `advertise_date`,
  `mobile_1`,
  `mobile_2`,
  `email`,
  `cost`,
  `swap`,
  `negotiable`,
  `longitude`,
  `latitude`,
  `location_id`,
  `provence_id`,
  `real_estate_for`,
  `real_estate_type_id`,
  `estimated_area`,
  `age`,
  `total_bed_rooms`,
  `total_bath_rooms`,
  `stories`,
  `furniture`,
  `air_condition_id`,
  `first_owner`,
  `master_bed_rooms`,
  `parking_garage`,
  `outdoor_amenities_id`
  `club_house_gym`,
  `kitchen`,
  `pantries`,
  `powder_room`,
  `electricity`,
  `stone_cladding`,
  `wood_cladding`,
  `telephone_service`,
  `security`,
  `floor`,
  `front_yard`,
  `back_yard`,
  `swimming_pool`,
  `intercom`,
  `fire_alarm`,
  `fire_fighting`,
  `internet`,
  `flooring_type`,
  `built_in_clothes`,
  `fiber_optic`,
  `reflected_glass`,
  `maintenance`,
  `sub_rental`,
  `expatriate_owner_ship`,
  `majlas`
  `car_shed`,
  `water_supply`,
  `drainage_type`
  `fire_place`,
  `special_decoration`,
  `ceiling_type`,
  `dining_room`,
  `elevators`,
  `special_equipment`,
  `basement`,
  `roof_type`
  `stores`,
  `housekeeping`,
  `garden`,
  `paved_road`,
  `electrical_garage_door`,
  `eco_green_building`,
  `cctv`,
  `building_permit_type_id`
  `drainage`,
  `boundary`,
  `plants`,
  `water_well`,
  `ancillary_buildings_id`,
  `farmed`,
  `expatriate_ownership`,
  `details`,
  `live_near_1_id`,
  `live_near_2_id`,
  `live_near_3_id`,
  `live_near_4_id`,
  `longitude_1`,
  `latitude_1`,
  `longitude_2`,
  `latitude_2`,
  `longitude_3`,
  `latitude_3`,
  `longitude_4`,
  `latitude_4`,
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

	public function getAllEstate_OrderByColumnWithLimit($column, $sorting, $start, $limit) {
		$start = ( int )($start);
		$limit = ( int )($limit);

		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);

		$result = $this -> select() -> from($this -> _name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *')) -> order("$column $sorting") -> limit("$start, $limit") -> query() -> fetchAll();

		return $result;
	}

	/*public function getAllType() {
	 $result = $this -> select() -> from($this -> _name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))

	 return $result;
	 }

	 public function getTypeById($id) {
	 $id = (int)$id;
	 $result = $this -> select() -> from($this -> _name) -> joinInner('locale', $this -> _name . '.locale_id=locale.id', array('title as locale_title')) -> where($this -> _name . '.id = ?', $id) -> setIntegrityCheck(false) -> query() -> fetch();

	 return $result;
	 }*/

}
