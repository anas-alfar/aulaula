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
 * @package Aula_Category
 * @subpackage Controller
 * @name Category_Controller_TypeAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Category_Controller_TypeAdmin extends Aula_Controller_Action {

	private $categoryTypeObj = Null;
	private $categoryTypeInfoObj = Null;

	protected function _init() {
		$this -> categoryTypeObj = new Category_Model_Type();
		$this -> categoryTypeInfoObj = new Category_Model_TypeInfo();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryTypeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'showInMenu' => array('text', 0, $this -> categoryTypeObj -> showInMenu), 'published' => array('text', 0, $this -> categoryTypeObj -> published), 'approved' => array('text', 0, $this -> categoryTypeObj -> approved), 'comment' => array('text', 0, $this -> categoryTypeInfoObj -> comments), 'option' => array('text', 0, $this -> categoryTypeInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> categoryTypeObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> categoryTypeObj -> getCategoryTypeAndCategoryTypeInfoById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('category/viewType.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Category_Form_TypeAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$query = $this -> categoryTypeObj -> getAdapter() -> query('UPDATE category_type SET `order`=1+`order`', array());
			$query -> execute();

			$_POST['mandatory']['author_id'] = $this -> userId;
			$lastInsertId = $this -> categoryTypeObj -> insert($_POST['mandatory']);
			if ($lastInsertId !== false) {
				$_POST['optional']['category_type_id'] = $lastInsertId;
				$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
				$this -> categoryTypeInfoObj -> insert($_POST['optional']);

				header('Location: /admin/handle/pkg/category-type/action/list');
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('category/addType.phtml');
		exit();
	}

	public function editAction() {

		$form = new Category_Form_TypeAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {
			$categoryTypeId = (int)$_POST['mandatory']['id'];
			$categoryTypeObjResult = $this -> categoryTypeObj -> select() -> where('`id` = ?', $categoryTypeId) -> query() -> fetch();
			if ($categoryTypeObjResult['order'] != $_POST['mandatory']['order']) {
				$query = $this -> categoryTypeObj -> getAdapter() -> query('UPDATE category_type SET `order`=1+`order`', array());
				$query -> execute();
			}
			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$categoryTypeData = array('title' => $_POST['mandatory']['title'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'show_in_menu' => $_POST['mandatory']['show_in_menu'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved'], 'order' => $_POST['mandatory']['order']);

			$categoryTypeInfoData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'comments' => $_POST['optional']['comments'], 'options' => $_POST['optional']['options']);

			$this -> categoryTypeObj -> update($categoryTypeData, '`id` = ' . $categoryTypeId);
			$this -> categoryTypeInfoObj -> update($categoryTypeInfoData, '`category_type_id` = ' . $categoryTypeId);

			header('Location: /admin/handle/pkg/category-type/action/list');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {

				$categoryTypeResult = $this -> categoryTypeObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$categoryTypeInfoObjResult = $this -> categoryTypeInfoObj -> select() -> where('`category_type_id` = ?', $_GET['id']) -> query() -> fetch();

				if ($categoryTypeResult !== false And $categoryTypeInfoObjResult !== false) {
					unset($categoryTypeInfoObjResult['id']);
					$categoryTypeInfoObjResult['options'] = json_decode($categoryTypeInfoObjResult['options']);

					$form -> populate($categoryTypeResult);
					$form -> populate($categoryTypeInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/category-type/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('category/updateType.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 if (empty($this -> errorMessage)) {
		 if ($this -> view -> sanitized -> order -> value == -1) {
		 $this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
		 }
		 $result = $this -> categoryTypeObj -> updateCategory_typeById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> description -> value, $this -> userId, 0, $this -> view -> sanitized -> showInMenu -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
		 $result = $this -> categoryTypeInfoObj -> GetAllCategory_type_infoByCategory_type_idOrderById($this -> view -> sanitized -> Id -> value);
		 $result = $this -> categoryTypeInfoObj -> updateCategory_type_infoById($result[0]['id'], $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
		 if ($result !== false) {
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
		 header('Location: /admin/handle/pkg/category-type/action/list/s/1');
		 exit();
		 }
		 header('Location: /admin/handle/pkg/category-type/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 } else {
		 $this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
		 }
		 }
		 } elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
		 $result = $this -> categoryTypeObj -> getCategory_typeDetailsById(( int )$_GET['id']);
		 $result = $result[0];
		 $resultInfo = $this -> categoryTypeInfoObj -> GetAllCategory_type_infoByCategory_type_idOrderById(( int )$_GET['id']);
		 $resultInfo = $resultInfo[0];

		 $this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryTypeId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'description' => array('text', 1, $result['description']), 'showInMenu' => array('text', 0, $result['show_in_menu']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $resultInfo['comments']), 'option' => array('text', 0, $resultInfo['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

		 $this -> view -> sanitized = array();
		 $this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		 $this -> view -> sanitized['Id']['value'] = ( int )$_GET['id'];
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 } else {
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 }

		 if (!empty($this -> errorMessage)) {
		 foreach ($this->errorMessage as $key => $msg) {
		 $this -> view -> sanitized -> $key -> errorMessage = $msg;
		 $this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
		 }
		 }

		 $this -> view -> render('category/addCategoryType.phtml');
		 exit();*/
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryTypeId -> value)) {
			foreach ($this->view->sanitized->categoryTypeId->value as $id => $value) {
				$where = $this -> categoryTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryInfoDelete = $this -> categoryTypeObj -> delete($where);
			}
			if (!empty($categoryTypeDelete)) {
				header('Location: /admin/handle/pkg/category-type/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/category-type/action/list/');
		exit();
	}

	public function showInMenuAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryTypeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->categoryTypeId->value as $id => $value) {
				$data = array('show_in_menu' => $this -> view -> sanitized -> status -> value);
				$where = $this -> categoryTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryTypeShowInMenu = $this -> categoryTypeObj -> update($data, $where);
			}
			if (!empty($categoryTypeShowInMenu)) {
				header('Location: /admin/handle/pkg/category-type/action/list/success/showInMenu');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/category-type/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryTypeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->categoryTypeId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> categoryTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryTypePublish = $this -> categoryTypeObj -> update($data, $where);
			}
			if (!empty($categoryTypePublish)) {
				header('Location: /admin/handle/pkg/category-type/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/category-type/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryTypeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->categoryTypeId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> categoryTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryTypeAprrove = $this -> categoryTypeObj -> update($data, $where);
			}
			if (!empty($categoryTypeAprrove)) {
				header('Location: /admin/handle/pkg/category-type/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/category-type/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/category-type/action/';

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
				case 'showInMenu' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
					break;
			}
		}

		$this -> view -> sort = (object)NULL;

		foreach ($this -> categoryTypeObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> categoryTypeObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}

			$this -> categoryTypeObj -> _orderBy = "$column $sort";
			$this -> categoryTypeObj -> _limit = "{$this -> start}, {$this -> limit}";
			$categoryTypeListResult = $this -> categoryTypeObj -> read();
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$this -> categoryTypeObj -> _orderBy = "id DESC";
			$this -> categoryTypeObj -> _limit = "{$this -> start}, {$this -> limit}";
			$categoryTypeListResult = $this -> categoryTypeObj -> read();
		}

		$this -> pagingObj -> _init($this -> categoryTypeObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		if (empty($categoryTypeListResult) and false == $categoryTypeListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> categoryTypeList = $categoryTypeListResult;
		$this -> view -> render('category/listCategoryType.phtml');
		exit();
	}

}
