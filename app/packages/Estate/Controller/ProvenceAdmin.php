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
* @package Aula_Estate_Controller_ProvenceAdmin
* @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
* @author Anas K. Al-Far <anas@al-far.com>
*
*/

class Estate_Controller_ProvenceAdmin extends Aula_Controller_Action {

	private $provenceObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> provenceObj = new Estate_Model_Provence();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'provenceId' => array('numeric', 0), 'id' => array('numeric', 0), 'estateTypeId' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> provenceObj -> comments), 'option' => array('text', 0, $this -> provenceObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/estate-provence/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/estate-provence/action/exportcsv/';
	}

	public function viewAction() {
		if ( isset($_GET['id']) and is_numeric($_GET['id']) ) {
			$result = $this -> provenceObj -> getProvenceById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('estate/viewProvence.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Estate_Form_Provence($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$provenceData = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, 'estate_location_id' => $_POST[$language_id]['estate_location_id_' . $language_id]);
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$provenceData['options'] = json_encode($_POST[$language_id]['options']);
					$provenceData['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$provenceId = $this -> provenceObj -> insert($provenceData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $provenceId);
					$this -> provenceObj -> update(array('hash_key' => $hash_key), '`id` = ' . $provenceId);
					$flag = false;
				} else {
					$provenceData['hash_key'] = $hash_key;
					$this -> provenceObj -> insert($provenceData);
				}
			}
			header('Location: /admin/handle/pkg/estate-provence/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/addProvence.phtml');
		exit();
	}

	public function editAction() {
		$form = new Estate_Form_SimpleProvence($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$provenceId = (int)$_POST['mandatory']['id'];

			$provenceData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'estate_location_id' => $_POST['mandatory']['estate_location_id'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> provenceObj -> update($provenceData, '`id` = ' . $provenceId);

			header('Location: /admin/handle/pkg/estate-provence/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$provenceObjResult = $this -> provenceObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($provenceObjResult !== false) {
					$provenceObjResult['options'] = json_decode($provenceObjResult['options']);

					$form -> locale_id = $provenceObjResult['locale_id'];
					$form -> createForm();
					$form -> populate($provenceObjResult);
				} else {
					header('Location: /admin/handle/pkg/estate-provence/action/list');
					exit();
				}
			}
		}
		$form -> setView($this -> view);
		$this -> view -> form = $form;
		$this -> view -> render('estate/updateProvence.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> provenceId -> value)) {
			foreach ($this -> view -> sanitized -> provenceId -> value as $id => $value) {
				$where = $this -> provenceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> provenceObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/estate-provence/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/estate-provence/action/list/');
		exit();
	}
	
	/*public function recordsAction() {
		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');
		
		$typeObj = new Estate_Model_Type();
		$locationObj = new Estate_Model_Location();

		$estateTypeObjResult = $typeObj -> select() -> from(array('estate_type'), array('id')) -> query() -> fetchAll();
		foreach ($estateTypeObjResult as $key => $id) {
			$estateLocationObjResult = $locationObj -> select() -> from(array('estate_location'), array('id', 'title', 'estate_type_id')) -> where('`estate_type_id` = ?', $id) -> query() -> fetchAll();
			foreach ($estateLocationObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['estate_type_id'] => $value['title']));
			}
		}
		echo $data;
	}*/

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/estate-provence/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> provenceObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> provenceObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$provenceListResult = $this -> provenceObj -> getAllProvence_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$provenceListResult = $this -> provenceObj -> getAllProvence_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> provenceObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> provenceObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($provenceListResult) and false == $provenceListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> provenceList = $provenceListResult;
		$this -> view -> render('estate/listProvence.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> provenceObj -> getAllProvence();
		$this -> exportSQL2CSV($allData, array('id', 'estate_location_id', 'title', 'description', 'estate_location_title', 'locale_id', 'hash_key', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Estate_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> provenceObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/estate-provence/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/addProvence.phtml');
		exit();
	}

}
