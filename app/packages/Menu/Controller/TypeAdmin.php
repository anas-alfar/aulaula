<?php

class Menu_Controller_TypeAdmin extends Aula_Controller_Action {

	private $menuObj = Null;
	private $menuInfoObj = Null;
	private $menuTypeObj = Null;

	protected function _init() {
		$this -> menuTypeObj = new Menu_Model_Type();
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0),'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'menuTypeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'published' => array('text', 0, $this -> menuTypeObj -> published), 'approved' => array('text', 0, $this -> menuTypeObj -> approved), 'order' => array('numericUnsigned', 0, $this -> menuTypeObj -> order), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $this -> menuTypeObj -> comments), 'option' => array('text', 0, $this -> menuTypeObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> menuTypeObj -> getTypeById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('menu/viewType.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Menu_Form_TypeAdmin($this -> view);
		$form -> setView($this -> view);
		
		if (!empty($_POST) and $form -> isValid($_POST)) {
			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$_POST['mandatory']['author_id'] = $this -> userId;

			$query = $this -> menuTypeObj -> getAdapter() -> query('UPDATE menu_type SET `order`=`order`+1', array());
			$query->execute(); 

			$lastInsertId = $this -> menuTypeObj -> insert(array_merge($_POST['mandatory'], $_POST['optional']));    //insert($_POST['mandatory']);
			header('Location: /admin/handle/pkg/menu-type/action/list');
		}
		$this -> view -> form = $form;
		$this -> view -> render('menu/addType.phtml');
		exit();
	}

	public function editAction() {
		$form = new Menu_Form_TypeAdmin($this -> view);
		$form -> setView($this -> view);

		 if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {
		 	$dataMenuType = array_merge($_POST['mandatory'], $_POST['optional']);
			$menuTypeObjResult = $this -> menuTypeObj -> select() -> where('`id` = ?', (int)$dataMenuType['id']) -> query() -> fetch();
			if ($menuTypeObjResult['order'] != $dataMenuType['order']) {
				$query = $this -> menuTypeObj ->getAdapter()->query('UPDATE menu_type SET `order`=1+`order`', array());
				$query->execute();
			}
			$dataMenuType['options']   		= json_encode( $dataMenuType['options'] );
			$dataMenuType['modified_by']  	= $this -> userId;
			$dataMenuType['modified_time']	= new Zend_db_Expr("Now()");

			$this -> menuTypeObj -> update($dataMenuType, '`id` = ' . $dataMenuType['id']);
			header('Location: /admin/handle/pkg/menu-type/action/list');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$menuTypeObjResult = $this -> menuTypeObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				if ($menuTypeObjResult !== false) {
					$menuTypeObjResult['options'] = json_decode($menuTypeObjResult['options']);
					$form -> populate($menuTypeObjResult);
				} else {
					header('Location: /admin/handle/pkg/menu-type/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('menu/updateType.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuTypeId -> value)) {
			foreach ($this->view->sanitized->menuTypeId->value as $id => $value) {
				$where = $this -> menuTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$menuTypeDelete = $this -> menuTypeObj -> delete($where);
			}
			if (!empty($menuTypeDelete)) {
				header('Location: /admin/handle/pkg/menu-type/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/menu-type/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuTypeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->menuTypeId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> menuTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$menuTypePublish = $this -> menuTypeObj -> update($data, $where);
			}
			if (!empty($menuTypePublish)) {
				header('Location: /admin/handle/pkg/menu-type/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/menu-type/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuTypeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->menuTypeId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> menuTypeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$menuTypeAprrove = $this -> menuTypeObj -> update($data, $where);
			}
			if (!empty($menuTypeAprrove)) {
				header('Location: /admin/handle/pkg/menu-type/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/menu-type/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/menu-type/action/';

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
		
		foreach ($this -> menuTypeObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> menuTypeObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}

			$this -> menuTypeObj -> _orderBy = "$column $sort";
			$this -> menuTypeObj -> _limit = "{$this -> start}, {$this -> limit}";
			$menuTypeListResult = $this -> menuTypeObj -> read();
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$this -> menuTypeObj -> _orderBy = "id DESC";
			$this -> menuTypeObj -> _limit = "{$this -> start}, {$this -> limit}";
			$menuTypeListResult = $this -> menuTypeObj -> read();
		}
		
		$this -> pagingObj -> _init($this -> menuTypeObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		if (empty($menuTypeListResult) and false == $menuTypeListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> menuTypeList = $menuTypeListResult;
		$this -> view -> render('menu/listMenuType.phtml');
		exit();
	}

}
