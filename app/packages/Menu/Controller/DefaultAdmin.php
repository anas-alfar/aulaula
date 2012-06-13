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
 * @package Menu
 * @subpackage Controller
 * @name Menu_Controller_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Menu_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $menuObj = Null;
	private $menuInfoObj = Null;
	private $menuTypeObj = Null;

	protected function _init() {
		$this -> menuObj = new Menu_Model_Default();
		$this -> menuInfoObj = new Menu_Model_Info();
		$this -> menuTypeObj = new Menu_Model_Type();
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'menuId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'label' => array('text', 1), 'link' => array('uri', 0), 'type' => array('numericUnsigned', 1), 'parent' => array('numericUnsigned', 0), 'subLevel' => array('numericUnsigned', 1, $this -> menuObj -> subLevel), 'published' => array('text', 0, $this -> menuTypeObj -> published), 'approved' => array('text', 0, $this -> menuTypeObj -> approved), 'order' => array('numericUnsigned', 0, $this -> menuTypeObj -> order), 'afterId' => array('numeric', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'comment' => array('text', 0, $this -> menuTypeObj -> comments), 'option' => array('text', 0, $this -> menuTypeObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> menuObj -> select() -> where('`id` = ?', (int)$_GET['id']) -> query() -> fetch();
			//$result = $this -> menuObj -> fetchRow($_GET['id']);
			if (empty($this -> view -> sanitized['type']['value'])) {
				$this -> view -> sanitized['type']['value'] = $result['menu_type_id'];
			}
			if (empty($this -> view -> sanitized['parent']['value']) && !$this -> isPagePostBack) {
				$this -> view -> sanitized['parent']['value'] = $result['parent_id'];
			}
		}
		//menu list
		$this -> menuTypeList = '';
		$this -> menuTypeListResult = $this -> menuTypeObj -> select();
		if (!empty($this -> menuTypeListResult)) {
			foreach ($this->menuTypeListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> menuTypeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> menuTypeList = $this -> menuTypeList;

		//parent list
		$this -> parentList = '';
		$this -> parentListResult = $this -> menuObj -> select();
		$this -> parentList = '<option value="0">' . $this -> view -> __('Root') . '</option>';
		if (!empty($this -> parentListResult)) {
			foreach ($this->parentListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['parent']['value']) ? 'selected="selected"' : '';
				$this -> parentList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['label'] . '</option>';
			}
		}
		$this -> view -> parentList = $this -> parentList;

		//order list
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> menuObj -> select();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult-> query() -> fetchAll() as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['label'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> menuObj -> getmenuById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('menu/viewMenu.phtml');
			exit();
		}
	}

/**
 * @todo: check and fix "UPDATE query issue" that doubles the value when update `order`=`order`+1
 * @todo: NEVER USE $_POST, use $this -> view -> sanitized instead
 */
	public function addAction() {
		$form = new Menu_Form_DefaultAdmin($this -> view);
		$form -> setView($this -> view);
		 if (!empty($_POST) and $form -> isValid($_POST)) {
			$stmt = $this -> menuObj -> getAdapter() -> prepare('UPDATE menu SET `order`=`order`+1 WHERE `order` >= ?');
			$stmt -> execute(array($_POST['mandatory']['order']));

			$lastInsertId = $this -> menuObj -> insert($_POST['mandatory']);
			if ($lastInsertId !== false) {
				$_POST['optional']['menu_id'] = $lastInsertId;
				$_POST['optional']['options'] = json_encode( $_POST['optional']['options'] );
				$this -> menuInfoObj -> insert($_POST['optional']);
				header('Location: /admin/handle/pkg/menu/action/list');
				exit();
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('menu/add.phtml');
		exit();
	}

	public function editAction() {
		$form = new Menu_Form_DefaultAdmin($this -> view);
		$form -> setView($this -> view);

		 if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id']) ) {
		 	$menu_id = (int) $_POST['mandatory']['id'];
			$menuObjResult = $this -> menuObj -> select() -> where('`id` = ?', $menu_id) -> query() -> fetch();
			if ($menuObjResult['order'] != $_POST['mandatory']['order']) {
				$query = $this -> menuObj ->getAdapter()->query('UPDATE menu SET `order`=1+`order`', array());
				$query->execute();
			}
			$_POST['optional']['options'] = json_encode( $_POST['optional']['options'] );
			$dataMenu = array('label' => $_POST['mandatory']['label'], 'link' => $_POST['mandatory']['link'], 'menu_type_id' => $_POST['mandatory']['menu_type_id'], 'sublevel' => $_POST['mandatory']['sublevel'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved'], 'order' => $_POST['mandatory']['order']);
			$dataMenuInfo = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], 'comments' => $_POST['optional']['comments'], 'options' => $_POST['optional']['options']);
			$this -> menuObj -> update($dataMenu, '`id` = ' . $menu_id);
			$this -> menuInfoObj -> update($dataMenuInfo, '`menu_id` = ' . $menu_id);
			header('Location: /admin/handle/pkg/menu/action/list');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$menuObjResult = $this -> menuObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$menuInfoObjResult = $this -> menuInfoObj -> select() -> where('`menu_id` = ?', $_GET['id']) -> query() -> fetch();
				if ($menuObjResult !== false And $menuInfoObjResult !== false) {
					unset($menuInfoObjResult['id']);
					$publish_from = explode(' ', $menuInfoObjResult['publish_from']);
					$publish_to = explode(' ', $menuInfoObjResult['publish_to']);
					$menuInfoObjResult['publish_from'] = $publish_from[0];
					$menuInfoObjResult['publish_to'] = $publish_to[0];
					$menuInfoObjResult['options'] = json_decode($menuInfoObjResult['options']);

					$form -> populate($menuObjResult);
					$form -> populate($menuInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/menu/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('menu/update.phtml');
		exit();
	}

	public function recordsAction() {
		$data = new Zend_Dojo_Data();
		$data->setIdentifier('name');

		$menuTypeObjResult 	= $this->menuTypeObj -> select() -> from(array( 'menu_type'), array('id')) -> query() -> fetchAll();
		foreach ( $menuTypeObjResult as $key => $id ) {
			$menuObjResult 	= $this->menuObj -> select() -> from(array('menu'), array('id','label', 'menu_type_id')) -> where('`menu_type_id` = ?', $id) -> query() -> fetchAll();
			foreach ($menuObjResult as $key2 => $value) {
				$data->addItem(array('name' => $value['id'], $value['menu_type_id'] => $value['label']));	
			}
		}
    	echo $data;
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuId -> value)) {
			foreach ($this->view->sanitized->menuId->value as $id => $value) {
				$where = $this -> menuObj -> getAdapter() -> quoteInto('id = ?', $id);
				$menuPublish = $this -> menuObj -> delete($where);
				$where = $this -> menuObj -> getAdapter() -> quoteInto('menu_id = ?', $id);
				$menuInfoDelete = $this -> menuInfoObj -> delete($where);
			}
			if (!empty($menuDelete)) {
				header('Location: /admin/handle/pkg/menu/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/menu/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->menuId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> menuObj -> getAdapter() -> quoteInto('id = ?', $id);
				$menuPublish = $this -> menuObj -> update($data, $where);
				//$menuPublish = $this -> menuObj -> update(array('published' => $this -> view -> sanitized -> status -> value), array ('id'=>$id));
			}
			if (!empty($menuPublish)) {
				header('Location: /admin/handle/pkg/menu/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/menu/action/list/err');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->menuId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> menuObj -> getAdapter() -> quoteInto('id = ?', $id);
				$menuPublish = $this -> menuObj -> update($data, $where);
				//$menuPublish = $this -> menuObj -> update(array('approved' => $this -> view -> sanitized -> status -> value), array('id' => $id));
			}
			if (!empty($menuAprrove)) {
				header('Location: /admin/handle/pkg/menu/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/menu/action/list/err');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/menu/action/';

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

		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		foreach ($this->menuObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> menuObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$menuListResult = $this -> menuObj -> getAllMenuAndMenu_infoAndMenu_typeOrderByColumn($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$menuListResult = $this -> menuObj -> getAllMenuAndMenu_infoAndMenu_typeOrderByColumn('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> menuObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		if (empty($menuListResult) and false == $menuListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> menuList = $menuListResult;
		$this -> view -> render('menu/listMenu.phtml');
		exit();
	}

}
