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
 * @name Vehicle_Controller_MakeAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Controller_MakeAdmin extends Aula_Controller_Action {

	private $makeObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> makeObj = new Vehicle_Model_Make();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'makeId' => array('numeric', 0), 'id' => array('numeric', 0), 'vehicleTypeId' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> makeObj -> comments), 'option' => array('text', 0, $this -> makeObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-make/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-make/action/exportcsv/';
	}

	public function viewAction() {
		if ( isset($_GET['id']) and is_numeric($_GET['id']) ) {
			$result = $this -> makeObj -> getMakeById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('vehicle/viewMake.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Vehicle_Form_Make($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$makeData = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, 'vehicle_type_id' => $_POST[$language_id]['vehicle_type_id_' . $language_id]);
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$makeData['options'] = json_encode($_POST[$language_id]['options']);
					$makeData['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$makeId = $this -> makeObj -> insert($makeData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $makeId);
					$this -> makeObj -> update(array('hash_key' => $hash_key), '`id` = ' . $makeId);
					$flag = false;
				} else {
					$makeData['hash_key'] = $hash_key;
					$this -> makeObj -> insert($makeData);
				}
			}

			header('Location: /admin/handle/pkg/vehicle-make/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addMake.phtml');
		exit();
	}

	public function editAction() {

		$form = new Vehicle_Form_SimpleMake($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$makeId = (int)$_POST['mandatory']['id'];

			$makeData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'vehicle_type_id' => $_POST['mandatory']['vehicle_type_id'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> makeObj -> update($makeData, '`id` = ' . $makeId);

			header('Location: /admin/handle/pkg/vehicle-make/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$makeObjResult = $this -> makeObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($makeObjResult !== false) {
					$makeObjResult['options'] = json_decode($makeObjResult['options']);
					
					$form->locale_id = $makeObjResult['locale_id'];
					$form-> createForm();
					$form -> populate($makeObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-make/action/list');
					exit();
				}
			}
		}
		$form -> setView($this -> view);
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateMake.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> makeId -> value)) {
			foreach ($this -> view -> sanitized -> makeId -> value as $id => $value) {
				$where = $this -> makeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> makeObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-make/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-make/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-make/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> makeObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> makeObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$makeListResult = $this -> makeObj -> getAllMake_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$makeListResult = $this -> makeObj -> getAllMake_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> makeObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> makeObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($makeListResult) and false == $makeListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> makeList = $makeListResult;
		$this -> view -> render('vehicle/listMake.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> makeObj -> getAllMake();
		$this -> exportSQL2CSV($allData, array('id', 'vehicle_type_id', 'title', 'description', 'vehicle_type_title', 'locale_id', 'hash_key', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Vehicle_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> makeObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/vehicle-make/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addMake.phtml');
		exit();
	}

}
