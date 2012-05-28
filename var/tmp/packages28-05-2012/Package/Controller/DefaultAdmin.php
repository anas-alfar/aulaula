<?php

class Package_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $packageObj = Null;
	private $packageInfoObj = Null;
	private $actionObj = Null;
	private $classObj = Null;

	protected function _init() {
		$this -> packageObj = new Package_Model_Default();
		$this -> packageInfoObj = new Package_Model_Info();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'packageId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'deafultActionTitle' => array('text', 1, $this -> packageInfoObj -> defaultActionTitle), 'deafultActionName' => array('text', 1, $this -> packageInfoObj -> defaultActionName), 'version' => array('text', 1, $this -> packageInfoObj -> version), 'type' => array('text', 1, $this -> packageObj -> type), 'prerequisite' => array('numericUnsigned', 1, $this -> packageObj -> prerequisiteId), 'parent' => array('numericUnsigned', 1, $this -> packageObj -> prerequisiteId), 'defaultActionName' => array('text', 0, $this -> packageObj -> defaultActionName), 'version' => array('text', 0, $this -> packageObj -> version), 'approved' => array('text', 0, $this -> packageObj -> approved), 'published' => array('text', 0, $this -> packageObj -> published), 'showInMenu' => array('text', 0, $this -> packageObj -> showInMenu), 'comment' => array('text', 0, $this -> packageInfoObj -> comments), 'option' => array('text', 0, $this -> packageInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//type list
		$this -> packageList = '';
		$this -> packageListResult = $this -> packageObj -> getAllPackageOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->packageListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> packageList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> packageList = $this -> packageList;

		//prerequisite list
		$this -> prerequisiteList = '';
		$this -> prerequisiteListResult = $this -> packageObj -> getAllPackageOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->prerequisiteListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> prerequisiteList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> prerequisiteList = $this -> prerequisiteList;

		//type list
		$this -> typeList = '';
		$this -> typeListResult = array('Core' => $this -> view -> __('Core'), 'Module' => $this -> view -> __('Module'), 'Plugin' => $this -> view -> __('Plugin'));
		if (!empty($this -> typeListResult)) {
			foreach ($this->typeListResult as $key => $value) {
				$selectedItem = ($key == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> typeList .= '<option value="' . $key . '"' . $selectedItem . '>' . $value . '</option>';
			}
		}
		$this -> view -> type = $this -> typeList;

	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> packageObj -> insertIntoPackage(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> showInMenu -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> type -> value, $this -> view -> sanitized -> prerequisite -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				$result = $this -> packageInfoObj -> insertIntoPackage_info(Null, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> deafultActionTitle -> value, $this -> view -> sanitized -> deafultActionName -> value, $this -> view -> sanitized -> version -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/package/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/package/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('package/addPackage.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$resultInfo = $this -> packageInfoObj -> GetAllPackage_infoByPackage_idOrderById($this -> view -> sanitized -> Id -> value);
				$resultInfoId = $resultInfo[0]['id'];
				$result = $this -> packageObj -> updatePackageById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> showInMenu -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> type -> value, $this -> view -> sanitized -> prerequisite -> value);
				$result = $this -> packageInfoObj -> updatePackage_infoById($resultInfoId, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> deafultActionTitle -> value, $this -> view -> sanitized -> deafultActionName -> value, $this -> view -> sanitized -> version -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/package/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/package/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> packageObj -> getPackageDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$resultInfo = $this -> packageInfoObj -> GetAllPackage_infoByPackage_idOrderById(( int )$_GET['id']);
			$resultInfo = $resultInfo[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'packageId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'deafultActionTitle' => array('text', 1, $resultInfo['default_action_title']), 'deafultActionName' => array('text', 1, $resultInfo['default_action_name']), 'version' => array('text', 1, $resultInfo['version']), 'type' => array('text', 1, $result['type']), 'prerequisite' => array('numericUnsigned', 1, $resultInfo['prerequisite_id']), 'parent' => array('numericUnsigned', 1, $resultInfo['prerequisite_id']), 'showInMenu' => array('text', 0, $result['show_in_menu']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $resultInfo['comments']), 'option' => array('text', 0, $resultInfo['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('package/addPackage.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> packageId -> value)) {
			foreach ($this->view->sanitized->packageId->value as $id => $value) {
				$packageDelete = $this -> packageObj -> deleteFromPackageById($id);
			}
			if (!empty($packageDelete)) {
				header('Location: /admin/handle/pkg/package/action/list/success/delete');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/package/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/package/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}
		//sortin
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> defaultActionTitle -> cssClass = 'sort-title';
		$this -> view -> sort -> defaultActionTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/defaultActionTitle/asc';
		$this -> view -> sort -> defaultActionName -> cssClass = 'sort-title';
		$this -> view -> sort -> defaultActionName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/defaultActionName/asc';
		$this -> view -> sort -> version -> cssClass = 'sort-title';
		$this -> view -> sort -> version -> href = $this -> view -> sanitized -> actionURI -> value . 'list/version/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('title', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('title', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['defaultActionTitle']) && $_GET['defaultActionTitle'] == 'asc') {
			$this -> view -> sort -> defaultActionTitle -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> defaultActionTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/default_action_title/desc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('title', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['defaultActionTitle']) && $_GET['defaultActionTitle'] == 'desc') {
			$this -> view -> sort -> defaultActionTitle -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> defaultActionTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/default_action_title/asc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('title', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['defaultActionName']) && $_GET['defaultActionName'] == 'asc') {
			$this -> view -> sort -> defaultActionName -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> defaultActionName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/default_action_name/desc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('title', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['defaultActionName']) && $_GET['defaultActionName'] == 'desc') {
			$this -> view -> sort -> defaultActionName -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> defaultActionName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/defaultActionName/asc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('default_action_name', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['version']) && $_GET['version'] == 'asc') {
			$this -> view -> sort -> version -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> version -> href = $this -> view -> sanitized -> actionURI -> value . 'list/version/desc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('version', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['version']) && $_GET['version'] == 'desc') {
			$this -> view -> sort -> version -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> version -> href = $this -> view -> sanitized -> actionURI -> value . 'list/version/asc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('version', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('date_added', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('date_added', 'DESC', $this -> start, $this -> limit);
		} else {
			$packageListResult = $this -> packageObj -> getPackageAndPackage_infoOrderByColumnWithLimit('id', 'DESC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> packageObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$packageList = '';
		if (!empty($packageListResult) and false != $packageListResult) {
			foreach ($packageListResult as $key => $value) {
				$packageList .= '<tr>';
				$packageList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="packageId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$packageList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$packageList .= '<td class="jstalgntop">' . $value['default_action_name'] . '</td>';
				$packageList .= '<td class="jstalgntop">' . $value['default_action_title'] . '</td>';
				$packageList .= '<td class="jstalgntop">' . $value['version'] . '</td>';
				$packageList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$packageList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/package/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> packageList = $packageList;
		$this -> view -> render('package/listPackage.phtml');
		exit();
	}

}
