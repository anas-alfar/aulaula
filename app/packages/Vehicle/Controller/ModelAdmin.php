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
 * @name Vehicle_Controller_ModelAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Controller_ModelAdmin extends Aula_Controller_Action {

	private $modelObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> modelObj = new Vehicle_Model_Model();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'modelId' => array('numeric', 0), 'id' => array('numeric', 0), 'vehicleTypeId' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> modelObj -> comments), 'option' => array('text', 0, $this -> modelObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-model/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-model/action/exportcsv/';
	}

	public function viewAction() {
		if ( isset($_GET['id']) and is_numeric($_GET['id']) ) {
			$result = $this -> modelObj -> getModelById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('vehicle/viewModel.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Vehicle_Form_Model($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$modelData = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, 'vehicle_make_id' => $_POST[$language_id]['vehicle_make_id_' . $language_id], );
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$modelData['options'] = json_encode($_POST[$language_id]['options']);
					$modelData['comments'] = $_POST[$language_id]['comments'];
				}

				if ($flag === true) {
					$modelId = $this -> modelObj -> insert($modelData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $modelId);
					$this -> modelObj -> update(array('hash_key' => $hash_key), '`id` = ' . $modelId);
					$flag = false;
				} else {
					$modelData['hash_key'] = $hash_key;
					$this -> modelObj -> insert($modelData);
				}
			}

			header('Location: /admin/handle/pkg/vehicle-model/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addModel.phtml');
		exit();
	}

	public function editAction() {
		$form = new Vehicle_Form_SimpleModel($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$modelId = (int)$_POST['mandatory']['id'];

			$modelData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'vehicle_make_id' => $_POST['mandatory']['vehicle_make_id'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> modelObj -> update($modelData, '`id` = ' . $modelId);

			header('Location: /admin/handle/pkg/vehicle-model/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$modelObjResult = $this -> modelObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($modelObjResult !== false) {
					$modelObjResult['options'] = json_decode($modelObjResult['options']);

					$form->locale_id = $modelObjResult['locale_id'];
					$form-> createForm();
					$form -> populate($modelObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-model/action/list');
					exit();
				}
			}
		}
		$form -> setView($this -> view);
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateModel.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> modelId -> value)) {
			foreach ($this -> view -> sanitized -> modelId -> value as $id => $value) {
				$where = $this -> modelObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> modelObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-model/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-model/action/list/');
		exit();
	}

	public function recordsAction() {
		$locale_id = $_GET['locale_id'];

		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');

		$typeObj = new Vehicle_Model_Type();
		$makeObj = new Vehicle_Model_Make();

		$vehicleTypeObjResult = $typeObj -> select() -> from(array('vehicle_type'), array('id')) -> query() -> fetchAll();
		foreach ($vehicleTypeObjResult as $key => $id) {
			$vehicleMakeObjResult = $makeObj -> select() -> from(array('vehicle_make'), array('id', 'title', 'vehicle_type_id')) -> where('`vehicle_type_id` = ?', $id) -> where('`locale_id` = ?', $locale_id) -> query() -> fetchAll();
			foreach ($vehicleMakeObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['vehicle_type_id'] => $value['title']));
			}
		}
		echo $data;
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-model/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> modelObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> modelObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$modelListResult = $this -> modelObj -> getAllModel_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$modelListResult = $this -> modelObj -> getAllModel_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> modelObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> modelObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($modelListResult) and false == $modelListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> modelList = $modelListResult;
		$this -> view -> render('vehicle/listModel.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> modelObj -> getAllModel();
		$this -> exportSQL2CSV($allData, array('id', 'vehicle_make_id', 'title', 'description', 'vehicle_make_title', 'locale_id', 'hash_key', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Vehicle_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> modelObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/vehicle-model/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addModel.phtml');
		exit();
	}

}
