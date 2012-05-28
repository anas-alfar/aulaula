<?php

class Category_Controller_TypeAdmin extends Aula_Controller_Action {

	private $categoryObj = Null;
	private $categoryInfoObj = Null;
	private $categoryTypeObj = Null;
	private $categoryTypeInfoObj = Null;

	protected function _init() {
		$this -> categoryTypeObj = new Category_Model_Type();
		$this -> categoryTypeInfoObj = new Category_Model_TypeInfo();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryTypeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'showInMenu' => array('text', 0, $this -> categoryTypeObj -> showInMenu), 'published' => array('text', 0, $this -> categoryTypeObj -> published), 'approved' => array('text', 0, $this -> categoryTypeObj -> approved), 'comment' => array('text', 0, $this -> categoryTypeInfoObj -> comments), 'option' => array('text', 0, $this -> categoryTypeInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> categoryTypeObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//Fill in types list drop down menu
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderById();
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
				$result = $this -> categoryTypeObj -> insertIntoCategory_type(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> description -> value, $this -> userId, 0, $this -> view -> sanitized -> showInMenu -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				$result = $this -> categoryTypeInfoObj -> insertIntoCategory_type_info(Null, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/category-type/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/category-type/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('category/addCategoryType.phtml');
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
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryTypeId -> value)) {
			foreach ($this->view->sanitized->categoryTypeId->value as $id => $value) {
				$categoryTypeDelete = $this -> categoryTypeObj -> deleteFromCategory_typeById($id);
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
				$categoryTypeShowInMenu = $this -> categoryTypeObj -> updateCategory_typeShow_in_menuColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($categoryTypeShowInMenu)) {
				header('Location: /admin/handle/pkg/category-type/action/list/success/showInMen');
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
				$categoryTypePublish = $this -> categoryTypeObj -> updateCategory_typePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$categoryTypeAprrove = $this -> categoryTypeObj -> updateCategory_typeApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
		} elseif ($_GET['success'] == 'showInMenu') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sortin
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> label -> cssClass = 'sort-title';
		$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
		$this -> view -> sort -> showInMenu -> cssClass = 'sort-title';
		$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'asc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/desc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByLabelWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'desc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByLabelWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInMenu']) && $_GET['showInMenu'] == 'asc') {
			$this -> view -> sort -> showInMenu -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/desc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByShow_in_menuWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInMenu']) && $_GET['showInMenu'] == 'desc') {
			$this -> view -> sort -> showInMenu -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/asc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByShow_in_menuWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$categoryTypeListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> categoryTypeObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$label = '';
		$modifiedTime = '';
		$categoryTypeList = '';
		$categoryTypeIfnoList = '';
		if (!empty($categoryTypeListResult) and false != $categoryTypeListResult) {
			foreach ($categoryTypeListResult as $key => $value) {
				$categoryTypeList .= '<tr>';
				$categoryTypeList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="categoryTypeId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$categoryTypeList .= '<td class="jstalgntop">' . $this -> view -> cleanHtml($value['title']) . '</td>';
				$categoryTypeList .= '<td class="jstalgntop">' . $this -> view -> cleanHtml($value['label']) . '</td>';
				$categoryTypeList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_menu']) . '</td>';
				$categoryTypeList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$categoryTypeList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$categoryTypeList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$categoryTypeList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/category-type/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$categoryTypeList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> categoryTypeList = $categoryTypeList;
		$this -> view -> render('category/listCategoryType.phtml');
		exit();
	}

}
