<?php

class Category_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $categoryObj = Null;
	private $categoryInfoObj = Null;
	private $categoryTypeObj = Null;

	protected function _init() {
		$this -> categoryObj = new Category_Model_Default();
		$this -> categoryInfoObj = new Category_Model_Info();
		$this -> categoryTypeObj = new Category_Model_Type();
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'type' => array('numeric', 1), 'parent' => array('numeric', 0, $this -> categoryObj -> parentId), 'showInMenu' => array('text', 0, $this -> categoryObj -> showInMenu), 'published' => array('text', 0, $this -> categoryObj -> published), 'approved' => array('text', 0, $this -> categoryObj -> approved), 'order' => array('numericUnsigned', 0, $this -> categoryObj -> order), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $this -> categoryInfoObj -> comments), 'option' => array('text', 0, $this -> categoryInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'pageTitle' => array('text', 0, $this -> categoryInfoObj -> pageTitle), 'metaTitle' => array('text', 0, $this -> categoryInfoObj -> metaTitle), 'metaKey' => array('text', 0, $this -> categoryInfoObj -> metaKey), 'metaDesc' => array('text', 0, $this -> categoryInfoObj -> metaDesc), 'metaData' => array('text', 0, $this -> categoryInfoObj -> metaData), 'publishFrom' => array('shortDateTime', 0, $this -> categoryInfoObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> categoryInfoObj -> publishTo), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			//$result = $this -> categoryObj -> find(( int )$_GET['id']) -> current();
			$result = $this -> categoryObj -> select() -> where('`id` = ?', (int)$_GET['id']) -> query() -> fetch();
			if (empty($this -> view -> sanitized['type']['value'])) {
				$this -> view -> sanitized['type']['value'] = $result['category_type_id'];
			}
			if (empty($this -> view -> sanitized['parent']['value']) && !$this -> isPagePostBack) {
				$this -> view -> sanitized['parent']['value'] = $result['parent_id'];
			}
		}
	}

	public function addAction() {
		$form = new Category_Form_DefaultAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$query = $this -> categoryObj -> getAdapter() -> query('UPDATE category SET `order`=1+`order`', array());
			$query -> execute();

			$_POST['mandatory']['author_id'] = $this -> userId;
			$lastInsertId = $this -> categoryObj -> insert($_POST['mandatory']);
			if ($lastInsertId !== false) {
				$_POST['optional']['category_id'] = $lastInsertId;
				$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
				$this -> categoryInfoObj -> insert(array_merge($_POST['optional'], $_POST['meta']));

				header('Location: /admin/handle/pkg/category/action/list');
				exit();
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('category/add.phtml');
		exit();
	}

	public function editAction() {
		$form = new Category_Form_DefaultAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {
			$category_id = (int)$_POST['mandatory']['id'];
			$categoryObjResult = $this -> categoryObj -> select() -> where('`id` = ?', $category_id) -> query() -> fetch();
			if ($categoryObjResult['order'] != $_POST['mandatory']['order']) {
				$query = $this -> categoryObj -> getAdapter() -> query('UPDATE category SET `order`=1+`order`', array());
				$query -> execute();
			}
			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$dataCategory = array('title' => $_POST['mandatory']['title'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'category_type_id' => $_POST['mandatory']['category_type_id'], 'parent_id' => $_POST['mandatory']['parent_id'], 'show_in_menu' => $_POST['mandatory']['show_in_menu'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved'], 'order' => $_POST['mandatory']['order']);
			$dataCategoryInfo = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], 'comments' => $_POST['optional']['comments'], 'options' => $_POST['optional']['options'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], );

			$this -> categoryObj -> update($dataCategory, '`id` = ' . $category_id);
			$this -> categoryInfoObj -> update($dataCategoryInfo, '`category_id` = ' . $category_id);

			header('Location: /admin/handle/pkg/category/action/list');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$categoryObjResult = $this -> categoryObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$categoryInfoObjResult = $this -> categoryInfoObj -> select() -> where('`category_id` = ?', $_GET['id']) -> query() -> fetch();
				if ($categoryObjResult !== false And $categoryInfoObjResult !== false) {
					unset($categoryInfoObjResult['id']);
					$publish_from = explode(' ', $categoryInfoObjResult['publish_from']);
					$publish_to = explode(' ', $categoryInfoObjResult['publish_to']);
					$categoryInfoObjResult['publish_from'] = $publish_from[0];
					$categoryInfoObjResult['publish_to'] = $publish_to[0];
					$categoryInfoObjResult['options'] = json_decode($categoryInfoObjResult['options']);

					$form -> populate($categoryObjResult);
					$form -> populate($categoryInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/category/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('category/update.phtml');
		exit();
	}

	public function recordsAction() {
		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');

		$categoryTypeObjResult = $this -> categoryTypeObj -> select() -> from(array('category_type'), array('id')) -> query() -> fetchAll();
		foreach ($categoryTypeObjResult as $key => $id) {
			$categoryObjResult = $this -> categoryObj -> select() -> from(array('category'), array('id', 'title', 'category_type_id')) -> where('`category_type_id` = ?', $id) -> query() -> fetchAll();
			foreach ($categoryObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['category_type_id'] => $value['title']));
			}
		}
		echo $data;
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryId -> value)) {
			foreach ($this->view->sanitized->categoryId->value as $id => $value) {
				$where = $this -> categoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryDelete = $this -> categoryObj -> delete($where);
			}
			if (!empty($categoryDelete)) {
				header('Location: /admin/handle/pkg/category/action/list/success/delete');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/category/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->categoryId->value as $id => $value) {
				//$categoryAprrove = $this -> categoryObj -> updateCategoryApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> categoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryAprrove = $this -> categoryObj -> update($data, $where);
			}
			if (!empty($categoryAprrove)) {
				header('Location: /admin/handle/pkg/category/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/category/action/list/');
		exit();
	}

	public function showInMenuAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->categoryId->value as $id => $value) {
				//$categoryShowInMenu = $this -> categoryObj -> updateCategoryShow_in_menuColumnById($id, $this -> view -> sanitized -> status -> value);\
				$data = array('show_in_menu' => $this -> view -> sanitized -> status -> value);
				$where = $this -> categoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryShowInMenu = $this -> categoryObj -> update($data, $where);
			}
			if (!empty($categoryShowInMenu)) {
				header('Location: /admin/handle/pkg/category/action/list/success/showInMenu');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/category/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->categoryId->value as $id => $value) {
				//$categoryPublish = $this -> categoryObj -> updateCategoryPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> categoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$categoryPublish = $this -> categoryObj -> update($data, $where);
			}
			if (!empty($categoryPublish)) {
				header('Location: /admin/handle/pkg/category/action/list/success/publish');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/category/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/category/action/';

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

		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		$cols = array_merge($this -> categoryInfoObj -> cols, $this -> categoryObj -> cols);

		foreach ($cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$categoryListResult = $this -> categoryObj -> getCategoryAndCategory_infoOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$categoryListResult = $this -> categoryObj -> getCategoryAndCategory_infoOrderByColumnWithLimit('id', 'DESC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> categoryObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($categoryListResult) and false != $categoryListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}
		$this -> view -> categoryList = $categoryListResult;

		$this -> view -> render('category/listCategory.phtml');
		exit();
	}

}
