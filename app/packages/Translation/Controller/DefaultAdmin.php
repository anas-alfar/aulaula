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
 * @package Aula_Translation
 * @subpackage Controller
 * @name Translation_Controller_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Translation_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $translationObj = Null;

	protected function _init() {
		$this -> localeObj = new Locale_Model_Default();
		$this -> translationObj = new Translation_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'translationId' => array('numeric', 0), 'Id' => array('numeric', 0), 'locale' => array('numeric', 0), 'token' => array('text', 1), 'label' => array('text', 1), 'translation' => array('text', 1), 'comment' => array('text', 0, $this -> translationObj -> comments), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//locale list
		$this -> localeList = '';
		//$this -> localeListResult = $this -> localeObj -> getAllLocaleOrderById();
		$this -> localeListResult = $this -> localeObj -> select() -> query() -> fetchAll();
		if (!empty($this -> localeListResult)) {
			foreach ($this->localeListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['locale']['value']) ? 'selected="selected"' : '';
				$this -> localeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> localeList = $this -> localeList;

		$this -> view -> importExcelLink = '/admin/handle/pkg/translation/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/translation/action/exportcsv/';
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> translationObj -> getTranslationById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('translation/viewTranslation.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Translation_Form_Default($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$translationData = array('label' => $_POST[$language_id]['label'], 'translation' => $_POST[$language_id]['translation'], 'locale_id' => $language_id, );
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$translationData['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$translationId = $this -> translationObj -> insert($translationData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $translationId);
					$this -> translationObj -> update(array('hash_key' => $hash_key), '`id` = ' . $translationId);
					$flag = false;
				} else {
					$translationData['hash_key'] = $hash_key;
					$this -> translationObj -> insert($translationData);
				}
			}
			header('Location: /admin/handle/pkg/translation/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('translation/addTranslation.phtml');
		exit();

	}

	public function editAction() {
		$form = new Translation_Form_SimpleDefault($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$translationId = (int)$_POST['mandatory']['id'];

			$translationData = array('label' => $_POST['mandatory']['label'], 'translation' => $_POST['mandatory']['translation'], 'locale_id' => $_POST['mandatory']['locale_id'], 'modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'comments' => $_POST['optional']['comments'], );
			$this -> translationObj -> update($translationData, '`id` = ' . $translationId);

			header('Location: /admin/handle/pkg/translation/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$translationObjResult = $this -> translationObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($translationObjResult !== false) {
					$translationObjResult['translate_id'] = $translationObjResult['id'];
					$form -> hash_key = $translationObjResult['hash_key'];
					$form -> createForm();
					$form -> populate($translationObjResult);
				} else {
					header('Location: /admin/handle/pkg/translation/action/list');
					exit();
				}
			}
		}
		$form -> setView($this -> view);
		$this -> view -> form = $form;
		$this -> view -> render('translation/updateTranslation.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> translationId -> value)) {
			foreach ($this->view->sanitized->translationId->value as $id => $value) {
				$where = $this -> translationObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> translationObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/translation/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/translation/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/translation/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> translationObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> translationObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$translationListResult = $this -> translationObj -> getAllTranslation_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$translationListResult = $this -> translationObj -> getAllTranslation_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> translationObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($translationListResult) and false == $translationListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> translationList = $translationListResult;
		$this -> view -> render('translation/listTranslation.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> translationObj -> getAllTranslation();
		$this -> exportSQL2CSV($allData, array('id', 'label', 'translation', 'locale_id', 'hash_key', 'comments'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Translation_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> translationObj, false);
						if ($result == true) {
							header('Location: /admin/handle/pkg/translation/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('translation/addTranslation.phtml');
		exit();
	}

}
