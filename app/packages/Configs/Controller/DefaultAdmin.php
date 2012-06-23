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
 * @package Configs
 * @subpackage Controller
 * @name Configs_Controller_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Configs_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $configsObj = NULL;
	private $localeObj = NULL;

	protected function _init() {
		$this -> configsObj = new Configs_Model_Default();
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'configId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comments' => array('text', 0, $this -> configsObj -> comments), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-type/action/importcsv/';
		//$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-type/action/exportcsv/';
	}

	/*public function viewAction() {
	 if ( isset($_GET['id']) and is_numeric($_GET['id']) ) {
	 $result = $this -> typeObj -> getTypeById($_GET['id']);
	 $this -> view -> result = $result;
	 $this -> view -> render('vehicle/viewType.phtml');
	 exit();
	 }
	 }*/

	public function addAction() {
		$form = new Configs_Form_Default($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$configurationData = array();
			foreach ($_POST as $configurationName => $configurationValue) {
				if (!empty($configurationValue['option_title']) AND trim($configurationValue['option_value']) != '') {

					if (($configurationValue['group_id'] != 0) AND (empty($configurationValue['group_value']))) {
						$groupInfo = explode('-', $configurationValue['group_id']);
						$configurationData['group_id'] = $groupInfo[0];
						$configurationData['group_key'] = $groupInfo[1];
					} else {
						$configurationData['group_key'] = $configurationValue['group_key'];
						$currentMaxGroupId = $this -> configsObj -> getMaxGroupId();
						$configurationData['group_id'] = $currentMaxGroupId['group_id'] + 1;
					}

					$configurationData['option_value'] = trim($configurationValue['option_value']);
					$configurationData['option_hint'] = trim($configurationValue['option_hint']);
					$configurationData['option_status'] = (int)$configurationValue['option_status'];
					$configurationData['option_description'] = trim($configurationValue['option_description']);
					$configurationData['comments'] = trim($configurationValue['comments']);
					$configurationData['locale_id'] = (int)$configurationValue['locale_id'];
					$configurationData['permission_level_id'] = $this -> userId;

					$configurationData['option_title'] = $configurationData['group_key'] . '.' . $configurationValue['option_title'];
					if (trim($configurationValue['option_type']) != '') {
						$configurationData['option_title'] = $configurationData['group_key'] . '.' . $configurationValue['option_type'] . '.' . $configurationValue['option_title'];
					}
					$this -> configsObj -> insert($configurationData);
				}
			}
			header('Location: /admin/handle/pkg/configs/action/list/');
			exit();
		}

		$this -> view -> form = $form;
		$this -> view -> render('configs/add.phtml');
		exit();
	}

	public function showgroupAction() {
		if (isset($_GET['group_id']) AND is_numeric($_GET['group_id'])) {
			$group_id = $_GET['group_id'];
			$configsObjResult = $this -> configsObj -> getAllConfigs();
			$localeAvailable = $this -> localeObj -> getAllLocale();
			if ($configsObjResult) {
				$this -> view -> allLocale = $localeAvailable;
				$this -> view -> configsGroups = $configsObjResult;
				$this -> view -> render('configs/listGroups.phtml');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/configs/action/list');
		exit();
	}

	public function editAction() {
		$form = new Configs_Form_SimpleDefault($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) AND isset($_POST['firststep']) AND $_POST['firststep'] == 1) {
			if (isset($_POST['group_id']) and is_numeric($_POST['group_id']) AND isset($_POST['locale_id']) and is_numeric($_POST['locale_id'])) {
				$configsObjResult = $this -> configsObj -> getAllConfigsByGroupIdAndLocaleId($_POST['group_id'], $_POST['locale_id']);
				if ($configsObjResult !== false) {
					foreach ($configsObjResult as $key => $config) {
						$optionTypeArray = explode('.', $config['option_title']);
						array_shift($optionTypeArray);
						if (count($optionTypeArray) == 1) {
							$config['option_title'] = $optionTypeArray[0];
						} else {
							$config['option_type'] = $optionTypeArray[0];
							$config['option_title'] = $optionTypeArray[1];
						}
						$form -> addConfigSubForm($key, $config);
					}
				} else {
					header('Location: /admin/handle/pkg/configs/action/list');
					exit();
				}
			}
		} else {

			if (!empty($_POST) and $form -> isValid($_POST) AND !isset($_POST['firststep'])) {
				$configurationData = array();

				foreach ($_POST as $configurationName => $configurationValue) {
					if (!empty($configurationValue['option_title']) AND trim($configurationValue['option_value']) != '') {

						$configurationData['group_id'] = $configurationValue['group_id'];
						$configurationData['group_key'] = $configurationValue['group_key'];

						$configurationData['option_value'] = trim($configurationValue['option_value']);
						$configurationData['option_hint'] = trim($configurationValue['option_hint']);
						$configurationData['option_status'] = (int)$configurationValue['option_status'];
						$configurationData['option_description'] = trim($configurationValue['option_description']);
						$configurationData['comments'] = trim($configurationValue['comments']);
						$configurationData['locale_id'] = (int)$configurationValue['locale_id'];
						$configurationId = (int)$configurationValue['id'];

						$configurationData['option_title'] = $configurationData['group_key'] . '.' . $configurationValue['option_title'];
						if (trim($configurationValue['option_type']) != '') {
							$configurationData['option_title'] = $configurationData['group_key'] . '.' . $configurationValue['option_type'] . '.' . $configurationValue['option_title'];
						}
						$this -> configsObj -> update($configurationData, '`id` = ' . $configurationId);
					}
				}
				header('Location: /admin/handle/pkg/configs/action/list');
				exit();
			} else {
				exit ;
				if (isset($_POST['group_id']) and is_numeric($_POST['group_id']) AND isset($_POST['locale_id']) and is_numeric($_POST['locale_id'])) {
					$configsObjResult = $this -> configsObj -> getAllConfigsByGroupIdAndLocaleId($_POST['group_id'], $_POST['locale_id']);
					if ($configsObjResult !== false) {
						foreach ($configsObjResult as $key => $config) {
							$form -> addConfigSubForm($key, $config);
						}
					} else {
						header('Location: /admin/handle/pkg/configs/action/list');
						exit();
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('configs/update.phtml');
		exit();
	}

	public function statusAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> configId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == '1' ? '1' : '0';
			foreach ($this->view->sanitized->configId->value as $id => $value) {
				$data = array('option_status' => $this -> view -> sanitized -> status -> value);
				$where = $this -> configsObj -> getAdapter() -> quoteInto('id = ?', $id);
				$configStatus = $this -> configsObj -> update($data, $where);
			}
			if (!empty($configStatus)) {
				header('Location: /admin/handle/pkg/configs/action/list/success/status');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/configs/action/list/err');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/configs/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'status') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> configsObj -> cols as $col) {
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> configsObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$configsListResult = $this -> configsObj -> getAllConfigs_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$configsListResult = $this -> configsObj -> getAllConfigs_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> configsObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($configsListResult) and false == $configsListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> configList = $configsListResult;
		$this -> view -> render('configs/list.phtml');
		exit();
	}

}
