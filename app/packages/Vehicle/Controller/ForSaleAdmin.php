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
 * @subpackage Controller
 * @name Vehicle_Controller_ForSaleAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Controller_ForSaleAdmin extends Aula_Controller_Action {

	private $forSaleObj = NULL;
	private $typeObj = NULL;
	private $yearObj = NULL;
	private $makeObj = NULL;
	private $modelObj = NULL;
	private $vehicleLookupObj = NULL;

	protected function _init() {

		$this -> vehicleLookupObj = new Lookup_Vehicle($this -> view);
		
		//default objects
		$this -> forSaleObj = new Vehicle_Model_ForSale();
		$this -> typeObj = new Vehicle_Model_Type();
		$this -> yearObj = new Vehicle_Model_Year();
		$this -> modelObj = new Vehicle_Model_Model();
		$this -> makeObj = new Vehicle_Model_Make();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'forSaleId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> forSaleObj -> comments), 'option' => array('text', 0, $this -> forSaleObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-type/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-type/action/exportcsv/';
	}

	public function addAction() {
		$form = new Vehicle_Form_ForSale($this -> view);
		$form -> setLocale ($this -> fc -> settings);
		$form -> setLookup ( $this -> vehicleLookupObj -> vehicleComboBox );
		$form -> renderForm ();
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$vehiclForSaleData = array_merge(
				$_POST['main'], 
				$_POST['contact'], 
				$_POST['general'], 
				$_POST['specification'], 
				$_POST['extraFeature']
			);
			$vehiclForSaleData['created_by'] = $this -> userId;
			$vehiclForSaleData['options'] = json_encode($vehiclForSaleData['options']);
			$this -> forSaleObj -> insert($vehiclForSaleData);
			
			/* TODO
			 * check contact information from contact DB if new insert else update
			 */

			header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addForSale.phtml');
		exit();
	}
	
	public function editAction() {
		$form = new Vehicle_Form_ForSale($this -> view);
		$form -> setLocale ($this -> fc -> settings);
		$form -> setLookup ( $this -> vehicleLookupObj -> vehicleComboBox );
		$form -> renderForm ();
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$vehiclForSaleData = array_merge(
				$_POST['main'], 
				$_POST['contact'], 
				$_POST['general'], 
				$_POST['specification'], 
				$_POST['extraFeature']
			);
			$vehiclForSaleData['modified_by'] = $this -> userId;
			$vehiclForSaleData['modified_date'] = new Zend_db_Expr("Now()");
			$vehiclForSaleData['options'] = json_encode($vehiclForSaleData['options']);

			$this -> forSaleObj -> update($vehiclForSaleData, '`id` = ' . (int) $vehiclForSaleData['id']);

			header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$forSaleObjResult = $this -> forSaleObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($forSaleObjResult !== false) {
					$approved_date = explode(' ', $forSaleObjResult['approved_date']);
					$publish_date  = explode(' ', $forSaleObjResult['publish_date']);
					$advertise_date= explode(' ', $forSaleObjResult['advertise_date']);
					$forSaleObjResult['approved_date'] = $approved_date[0];
					$forSaleObjResult['publish_date']  = $publish_date[0];
					$forSaleObjResult['advertise_date']= $advertise_date[0];
					$forSaleObjResult['options'] = json_decode($forSaleObjResult['options']);
					
					/*
					 * TODO 
					 * pass the value for contact_nid_cr from db to comboBox not the result for it from vehicle_for_sale table
					 */
					$forSaleObjResult['contact_nid_cr'] = 111555;

					$form -> populate($forSaleObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-for-sale/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateForSale.phtml');
		exit();
	}

	public function getContactAjaxAction () {
		//print_r($_POST['contactNIDCR']);
		//echo "MOUSA";
		
		/*
		 * TODO
		 * fetch this array index value from contact table where contactNIDCR = $_POST['contactNIDCR']
		 * if its new record please pass '' to the array
		 */

		$arr = array(
		'contact_bb' => 3231213, 
		'contact_full_name' => 'Mohammad R. Mousa', 
		'mobile_1' => 078837191,
		'mobile_2' => 00962788837191,
		'email' => 'mohammad.riad@gmail.com',
		);
		echo json_encode($arr);
		exit;
	}

	public function getMakeAjaxAction() {
		$locale_id = (int) $_GET['locale_id'];

		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');

		$typeObj = new Vehicle_Model_Type();
		$makeObj = new Vehicle_Model_Make();

		$vehicleTypeObjResult = $typeObj -> select() -> from(array('vehicle_type'), array('id')) -> query() -> fetchAll();
		foreach ($vehicleTypeObjResult as $key => $id) {
			$vehicleMakeObjResult = $makeObj 
			-> select() 
			-> from(array('vehicle_make'), array('id', 'title', 'vehicle_type_id')) 
			-> where('`vehicle_type_id` = ?', $id) 
			-> where('`locale_id` = ?', $locale_id) 
			-> query() 
			-> fetchAll();
			foreach ($vehicleMakeObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['vehicle_type_id'] => $value['title']));
			}
		}
		echo $data;
	}

	public function getModelAjaxAction() {
		$locale_id = (int) $_GET['locale_id'];

		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');

		$makeObj  = new Vehicle_Model_Make();
		$modelObj = new Vehicle_Model_Model();

		$vehicleMakeObjResult = $makeObj -> select() -> from(array('vehicle_make'), array('id')) -> query() -> fetchAll();
		foreach ($vehicleMakeObjResult as $key => $id) {
			$vehicleModelObjResult = $modelObj 
			-> select() 
			-> from(array('vehicle_model'), array('id', 'title', 'vehicle_make_id')) 
			-> where('`vehicle_make_id` = ?', $id) 
			-> where('`locale_id` = ?', $locale_id) 
			-> query() 
			-> fetchAll();
			foreach ($vehicleModelObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['vehicle_make_id'] => $value['title']));
			}
		}
		echo $data;
	}
	
	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> forSaleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->forSaleId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> forSaleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$forSalePublish = $this -> forSaleObj -> update($data, $where);
			}
			if (!empty($forSalePublish)) {
				header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> forSaleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->forSaleId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> forSaleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$forSaleAprrove = $this -> forSaleObj -> update($data, $where);
			}
			if (!empty($forSaleAprrove)) {
				header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> forSaleId -> value)) {
			foreach ($this -> view -> sanitized -> forSaleId -> value as $id => $value) {
				$where = $this -> forSaleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt  = $this -> forSaleObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-for-sale/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-for-sale/action/';

		if (!empty($_GET['success'])) {
			$this -> view -> successMessageStyle = 'display: block;';
			switch ($_GET['success']) {
				case 'approve' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
					break;
				case 'publish' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
					break;
				case 'delete' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
					break;
			}
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> forSaleObj -> cols as $col) {
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> forSaleObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$forSaleListResult = $this -> forSaleObj -> getAllForSale_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$forSaleListResult = $this -> forSaleObj -> getAllForSale_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> forSaleObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		
		if (empty($forSaleListResult) and false == $forSaleListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		} else {

			foreach ($forSaleListResult as $key => $value) {
				$forSaleListResult[$key]['vehicle_type_title'] = $this -> typeObj -> getTypeTitleById($value['type_id']);
				$forSaleListResult[$key]['vehicle_year_title'] = $this -> yearObj -> getYearTitleById($value['year_id']);
				$forSaleListResult[$key]['vehicle_make_title'] = $this -> makeObj -> getMakeTitleById($value['make_id']);
				$forSaleListResult[$key]['vehicle_model_title']= $this -> modelObj -> getModelTitleById($value['model_id']);
				$forSaleListResult[$key]['contact_type_title'] = $this -> vehicleLookupObj -> vehicleComboBox['contact_type'][(int) $value['contact_type']];
			}

		}

		$this -> view -> forSaleList = $forSaleListResult;
		$this -> view -> render('vehicle/listForSale.phtml');
		exit();
	}

}