<?php

class Category_Controller_Default extends Aula_Controller_Action {

	private $categoryObj = Null;
	private $categoryInfoObj = Null;
	private $categoryTypeObj = Null;
	private $categoryTypeInfoObj = Null;

	protected function _init() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		return;

		$this -> categoryObj = new Category_Model_Default();
		$this -> categoryInfoObj = new Category_Model_Info();
		$this -> categoryTypeObj = new Category_Model_Type();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'type' => array('numeric', 1), 'parent' => array('numeric', 0, $this -> categoryObj -> parentId), 'showInMenu' => array('text', 0, $this -> categoryObj -> showInMenu), 'published' => array('text', 0, $this -> categoryObj -> published), 'approved' => array('text', 0, $this -> categoryObj -> approved), 'order' => array('numericUnsigned', 0, $this -> categoryObj -> order), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $this -> categoryInfoObj -> comments), 'option' => array('text', 0, $this -> categoryInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'pageTitle' => array('text', 0, $this -> categoryInfoObj -> pageTitle), 'metaTitle' => array('text', 0, $this -> categoryInfoObj -> metaTitle), 'metaKey' => array('text', 0, $this -> categoryInfoObj -> metaKey), 'metaDesc' => array('text', 0, $this -> categoryInfoObj -> metaDesc), 'metaData' => array('text', 0, $this -> categoryInfoObj -> metaData), 'publishFrom' => array('shortDateTime', 0, $this -> categoryInfoObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> categoryInfoObj -> publishTo), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> categoryObj -> getCategoryDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['type']['value'])) {
				$this -> view -> sanitized['type']['value'] = $result['type_id'];
			}
			if (empty($this -> view -> sanitized['parent']['value']) && !$this -> isPagePostBack) {
				$this -> view -> sanitized['parent']['value'] = $result['parent_id'];
			}
		}
		//type list
		$this -> categoryTypeList = '';
		$this -> categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderById();
		if (!empty($this -> categoryTypeListResult)) {
			foreach ($this->categoryTypeListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> categoryTypeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> categoryTypeList = $this -> categoryTypeList;
		//parent list
		$this -> parentListResult = $this -> categoryObj -> getAllCategoryOrderById();
		$this -> parentList = '<option value="0">' . $this -> view -> __('Root') . '</option>';
		if (!empty($this -> parentListResult)) {
			foreach ($this->parentListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['parent']['value']) ? 'selected="selected"' : '';
				$this -> parentList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> parentList = $this -> parentList;

		//order list
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> categoryObj -> getAllCategoryOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;
	}

	public function addAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function editAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryId -> value)) {
			foreach ($this->view->sanitized->categoryId->value as $id => $value) {
				$categoryDelete = $this -> categoryObj -> deleteFromCategoryById($id);
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
				$categoryAprrove = $this -> categoryObj -> updateCategoryApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$categoryShowInMenu = $this -> categoryObj -> updateCategoryShow_in_menuColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$categoryPublish = $this -> categoryObj -> updateCategoryPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

}
