<?php

class Object_Controller_DirectoryAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $articleObj = NULL;
	private $commentObj = NULL;
	private $directoryObj = NULL;
	private $fileObj = NULL;
	private $photoObj = NULL;
	private $ratingObj = NULL;
	private $sourceInfoObj = NULL;
	private $sourceObj = NULL;
	private $staticObj = NULL;
	private $tagObj = NULL;
	private $typeObj = NULL;
	private $typeIfnoObj = NULL;
	private $urlObj = NULL;
	private $userFavouriteObj = NULL;
	private $videoObj = NULL;

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> directoryObj = new Object_Model_Directory();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//locale and category objects
		$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'directoryId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameDirectory' => array('codeConvention', 1), 'labelDirectory' => array('text', 1), 'descriptionDirectory' => array('text', 0), 'parent' => array('numeric', 0), 'category' => array('numeric', 1), 'size' => array('numeric', 0, $this -> directoryObj -> size), 'filesCount' => array('numeric', 0, $this -> directoryObj -> filesCount), 'showInObject' => array('text', 0, $this -> directoryObj -> showInObject), 'fullPath' => array('filePath', 0, $this -> directoryObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $this -> directoryObj -> objectId), 'published' => array('text', 0, $this -> directoryObj -> published), 'approved' => array('text', 0, $this -> directoryObj -> approved), 'comment' => array('text', 0, $this -> directoryObj -> comments), 'option' => array('text', 0, $this -> directoryObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> directoryObj -> getObject_directoryDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
			if (empty($this -> view -> sanitized['parent']['value']) && !$this -> isPagePostBack) {
				$this -> view -> sanitized['parent']['value'] = $result['parent_id'];
			}
		}
		//parent list
		$this -> parentDirectoryList = '';
		$this -> parentDirectoryListResult = $this -> directoryObj -> getAllObject_directoryOrderById();
		$this -> parentDirectoryList = '<option value="0">' . $this -> view -> __('Root') . '</option>';
		if (!empty($this -> parentDirectoryListResult)) {
			foreach ($this->parentDirectoryListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['parent']['value']) ? 'selected="selected"' : '';
				$this -> parentDirectoryList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['name'] . '</option>';
			}
		}
		$this -> view -> parentDirectoryList = $this -> parentDirectoryList;

		//category list
		$this -> categoryList = '';
		$this -> categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		if (!empty($this -> categoryListResult)) {
			foreach ($this->categoryListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['category']['value']) ? 'selected="selected"' : '';
				$this -> categoryList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> categoryList = $this -> categoryList;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> directoryObj -> insertIntoObject_directory(Null, $this -> view -> sanitized -> nameDirectory -> value, $this -> view -> sanitized -> labelDirectory -> value, $this -> view -> sanitized -> descriptionDirectory -> value, $this -> view -> sanitized -> parent -> value, $this -> userId, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> filesCount -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];

				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-directory/action/list/s/1');
						exit();
					} else {
						if (isset($_GET['s']) and $_GET['s'] == -1) {
							header('Location: /admin/handle/pkg/object-directory/action/edit/s/-1/id/' . $this -> view -> sanitized -> Id -> value);
							exit();
						}
						header('Location: /admin/handle/pkg/object-directory/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
						exit();
					}
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
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

		$this -> view -> render('object/addDirectoryObject.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> directoryObj -> updateObject_directoryById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameDirectory -> value, $this -> view -> sanitized -> labelDirectory -> value, $this -> view -> sanitized -> descriptionDirectory -> value, $this -> view -> sanitized -> parent -> value, $this -> userId, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> filesCount -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-directory/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-directory/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> directoryObj -> getObject_directoryDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'directoryId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', $result['author_id']), 'nameDirectory' => array('codeConvention', 1, $result['name']), 'labelDirectory' => array('text', 1, $result['label']), 'descriptionDirectory' => array('text', 0, $result['description']), 'parent' => array('numeric', 1, $result['parent_id']), 'category' => array('numeric', 1, $result['category_id']), 'size' => array('numeric', 0, $this -> directoryObj -> size), 'filesCount' => array('numeric', 0, $this -> directoryObj -> filesCount), 'showInObject' => array('text', 0, $result['show_in_object']), 'fullPath' => array('filePath', 0, $this -> directoryObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $result['object_id']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('object/addDirectoryObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$directoryDelete = $this -> directoryObj -> deleteFromObject_directoryById($id);
			}
			if (!empty($directoryDelete)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/delete');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$directoryShowInObject = $this -> directoryObj -> updateObject_directoryShow_in_objectColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($directoryShowInObject)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/showInObject');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$directoryPublish = $this -> directoryObj -> updateObject_directoryPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($directoryPublish)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$directoryAprrove = $this -> directoryObj -> updateObject_directoryApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($directoryAprrove)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-directory/action/';
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
		} elseif ($_GET['success'] == 'showInObject') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sorting
		$this -> view -> sort -> category -> cssClass = 'sort-title';
		$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
		$this -> view -> sort -> name -> cssClass = 'sort-title';
		$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/asc';
		$this -> view -> sort -> showInObject -> cssClass = 'sort-title';
		$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['category']) && $_GET['category'] == 'asc') {
			$this -> view -> sort -> category -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/desc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByCategory_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['category']) && $_GET['category'] == 'desc') {
			$this -> view -> sort -> category -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByCategory_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['name']) && $_GET['name'] == 'asc') {
			$this -> view -> sort -> name -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/desc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByNameWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['name']) && $_GET['name'] == 'desc') {
			$this -> view -> sort -> name -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/asc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByNameWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'asc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/desc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByShow_in_objectWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'desc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByShow_in_objectWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> directoryObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		$categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		$objectList = '';
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}

		if (!empty($directoryListResult) and false != $directoryListResult) {
			foreach ($directoryListResult as $key => $value) {
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="directoryId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $category[$value['category_id']] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['name'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_object']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-directory/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listDirectoryObject.phtml');
		exit();
	}

}
