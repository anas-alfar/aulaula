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
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'menuTypeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'published' => array('text', 0, $this -> menuTypeObj -> published), 'approved' => array('text', 0, $this -> menuTypeObj -> approved), 'order' => array('numericUnsigned', 0, $this -> menuTypeObj -> order), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $this -> menuTypeObj -> comments), 'option' => array('text', 0, $this -> menuTypeObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//order list
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> menuTypeObj -> getAllMenu_typeOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$result = $this -> menuTypeObj -> insertIntoMenu_type(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> description -> value, $this -> userId, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/menu-type/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/menu-type/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on add record');
				}
			}
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}

		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
		}

		$this -> view -> render('menu/addMenuType.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$result = $this -> menuTypeObj -> updateMenu_typeById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> description -> value, $this -> userId, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/menu-type/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/menu-type/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> menuTypeObj -> getMenu_typeDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'menuTypeId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'description' => array('text', 1, $result['description']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('menu/addMenuType.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> menuTypeId -> value)) {
			foreach ($this->view->sanitized->menuTypeId->value as $id => $value) {
				$menuTypeDelete = $this -> menuTypeObj -> deleteFromMenu_typeById($id);
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
				$menuTypePublish = $this -> menuTypeObj -> updateMenu_typePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$menuTypeAprrove = $this -> menuTypeObj -> updateMenu_typeApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/menu-type/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'approve') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'publish') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sortin
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> label -> cssClass = 'sort-title';
		$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'asc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/desc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByLabelWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'desc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByLabelWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$menuTypeListResult = $this -> menuTypeObj -> getAllMenu_typeOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> menuTypeObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		$menuTypeList = '';
		if (!empty($menuTypeListResult) and false != $menuTypeListResult) {
			foreach ($menuTypeListResult as $key => $value) {
				$menuTypeList .= '<tr>';
				$menuTypeList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="menuTypeId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$menuTypeList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$menuTypeList .= '<td class="jstalgntop">' . $value['label'] . '</td>';
				$menuTypeList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$menuTypeList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$menuTypeList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$menuTypeList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/menu-type/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$menuTypeList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> menuTypeList = $menuTypeList;
		$this -> view -> render('menu/listMenuType.phtml');
		exit();
	}

}
