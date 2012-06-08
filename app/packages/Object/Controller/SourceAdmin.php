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
 * @package Aula_Object
 * @subpackage Controller
 * @name Object_Controller_SourceAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_SourceAdmin extends Aula_Controller_Action {

	private $sourceInfoObj = NULL;
	private $sourceObj = NULL;

	protected function _init() {
		$this -> sourceObj = new Object_Model_Source();
		$this -> sourceInfoObj = new Object_Model_SourceInfo();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'sourceId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameSource' => array('text', 1), 'descriptionSource' => array('text', 0), 'sourceType' => array('numericUnsigned', 1), 'countrySource' => array('numericUnsigned', 1), 'urlSource' => array('url', 1), 'timeDelay' => array('numericUnsigned', 0, $this -> sourceObj -> timeDelay), 'package' => array('numericUnsigned', 0, $this -> sourceObj -> packageId), 'published' => array('text', 0, $this -> sourceObj -> published), 'approved' => array('text', 0, $this -> sourceObj -> approved), 'order' => array('numeric', 0, $this -> sourceObj -> order), 'afterId' => array('numeric', 0), 'publishFrom' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishTo), 'comment' => array('text', 0, $this -> sourceInfoObj -> comments), 'option' => array('text', 0, $this -> sourceInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> sourceObj -> getSourceById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewSource.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Object_Form_Source($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$stmt = $this -> sourceObj -> getAdapter() -> prepare('UPDATE object_source SET `order`=`order`+1 WHERE `order` >= ?');
			$stmt -> execute(array($_POST['optional']['order']));

			$_POST['mandatory']['locale_id'] = $this -> fc -> settings -> locale -> available -> lang -> _1 -> default;
			$_POST['mandatory']['author_id'] = $this -> userId;

			$lastInsertId = $this -> sourceObj -> insert($_POST['mandatory']);
			if ($lastInsertId !== false) {
				$_POST['optional']['object_source_id'] = $lastInsertId;
				$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
				$this -> sourceInfoObj -> insert($_POST['optional']);
				header('Location: /admin/handle/pkg/object-source/action/list');
				exit();
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addSource.phtml');
		exit();
	}

	public function editAction() {
		$form = new Object_Form_Source($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {
			$objectSourceId = (int)$_POST['mandatory']['id'];
			$sourceObjResult = $this -> sourceObj -> select() -> where('`id` = ?', $objectSourceId) -> query() -> fetch();
			if ($sourceObjResult['order'] != $_POST['mandatory']['order']) {
				$stmt = $this -> sourceObj -> getAdapter() -> prepare('UPDATE object_source SET `order`=`order`+1 WHERE `order` >= ?');
				$stmt -> execute(array($_POST['optional']['order']));
			}
			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$dataSource = array('name' => $_POST['mandatory']['name'], 'description' => $_POST['mandatory']['description'], 'source_type' => $_POST['mandatory']['source_type'], 'url' => $_POST['mandatory']['url'], 'time_delay' => $_POST['mandatory']['time_delay'], 'order' => $_POST['mandatory']['order'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$dataSourceInfo = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], 'comments' => $_POST['optional']['comments'], 'options' => $_POST['optional']['options']);

			$this -> sourceObj -> update($dataSource, '`id` = ' . $objectSourceId);
			$this -> sourceInfoObj -> update($dataSourceInfo, '`object_source_id` = ' . $objectSourceId);

			header('Location: /admin/handle/pkg/object-source/action/list');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$sourceObjResult = $this -> sourceObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$sourceInfoObjResult = $this -> sourceInfoObj -> select() -> where('`object_source_id` = ?', $_GET['id']) -> query() -> fetch();
				if ($sourceObjResult !== false And $sourceInfoObjResult !== false) {
					unset($sourceInfoObjResult['id']);
					$publish_from = explode(' ', $sourceInfoObjResult['publish_from']);
					$publish_to = explode(' ', $sourceInfoObjResult['publish_to']);
					$sourceInfoObjResult['publish_from'] = $publish_from[0];
					$sourceInfoObjResult['publish_to'] = $publish_to[0];
					$sourceInfoObjResult['options'] = json_decode($sourceInfoObjResult['options']);

					$form -> populate($sourceObjResult);
					$form -> populate($sourceInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-source/action/list');
					exit();
				}
			}
		}

		$this -> view -> form = $form;
		$this -> view -> render('object/updateSource.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> sourceId -> value)) {
			foreach ($this->view->sanitized->sourceId->value as $id => $value) {
				$where = $this -> sourceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$sourceDelete = $this -> sourceObj -> delete($where);
			}
			if (!empty($sourceDelete)) {
				header('Location: /admin/handle/pkg/object-source/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-source/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> sourceId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->sourceId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> sourceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$sourcePublish = $this -> sourceObj -> update($data, $where);
			}
			if (!empty($sourcePublish)) {
				header('Location: /admin/handle/pkg/object-source/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-source/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> sourceId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->sourceId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> sourceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$sourceAprrove = $this -> sourceObj -> update($data, $where);
			}
			if (!empty($sourceAprrove)) {
				header('Location: /admin/handle/pkg/object-source/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-source/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-source/action/';

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
				case 'showInObject' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
					break;
			}
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this->sourceObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> sourceObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$sourceListResult = $this -> sourceObj -> getAllObject_SourceOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$sourceListResult = $this -> sourceObj -> getAllObject_SourceOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> sourceObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($sourceListResult) and false == $sourceListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $sourceListResult;
		$this -> view -> render('object/listSourceObject.phtml');
		exit();
	}

}
