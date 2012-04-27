<?php

class Package_Controller_ActionAdmin extends Aula_Controller_Action {

	private $packageObj = Null;
	private $packageInfoObj = Null;
	private $actionObj = Null;
	private $classObj = Null;

	protected function _init() {
		$this -> packageObj = new Package_Model_Default();
		$this -> classObj = new Package_Model_Class();
		$this -> actionObj = new Package_Model_Action();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'actionId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'actionTitle' => array('text', 1), 'actionName' => array('codeConvention', 1), 'actionDescription' => array('text', 1), 'fileName' => array('filePath', 1), 'package' => array('numericUnsigned', 1), 'class' => array('numericUnsigned', 1), 'comment' => array('text', 0, $this -> classObj -> comments), 'option' => array('text', 0, $this -> classObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//package
		$this -> packageList = '';
		$this -> packageListResult = $this -> packageObj -> getAllPackageOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->packageListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['package']['value']) ? 'selected="selected"' : '';
				$this -> packageList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> packageList = $this -> packageList;

		//class
		$this -> classList = '';
		$this -> classListResult = $this -> classObj -> getAllPackage_classOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->classListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['class']['value']) ? 'selected="selected"' : '';
				$this -> classList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> classList = $this -> classList;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> actionObj -> insertIntoPackage_action(Null, $this -> view -> sanitized -> actionTitle -> value, $this -> view -> sanitized -> actionName -> value, $this -> view -> sanitized -> actionDescription -> value, $this -> view -> sanitized -> fileName -> value, $this -> view -> sanitized -> package -> value, $this -> view -> sanitized -> class -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/package-action/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/package-action/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('package/addAction.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> actionObj -> updatePackage_actionById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> actionTitle -> value, $this -> view -> sanitized -> actionName -> value, $this -> view -> sanitized -> actionDescription -> value, $this -> view -> sanitized -> fileName -> value, $this -> view -> sanitized -> package -> value, $this -> view -> sanitized -> class -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/package-action/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/package-action/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> actionObj -> getPackage_actionDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'actionId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'actionTitle' => array('text', 1, $result['action_title']), 'actionName' => array('codeConvention', 1, $result['action_name']), 'actionDescription' => array('text', 1, $result['action_description']), 'fileName' => array('filePath', 1, $result['file_name']), 'package' => array('numericUnsigned', 1, $result['package_id']), 'class' => array('numericUnsigned', 1, $result['class_id']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('package/addAction.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> actionId -> value)) {
			foreach ($this->view->sanitized->actionId->value as $id => $value) {
				$actionDelete = $this -> actionObj -> deleteFromPackage_actionById($id);
			}
			if (!empty($actionDelete)) {
				header('Location: /admin/handle/pkg/package-action/action/list/success/delete');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/pacakge-action/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/package-action/action/';
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
		$this -> view -> sort -> actionTitle -> cssClass = 'sort-title';
		$this -> view -> sort -> actionTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/actionTitle/asc';
		$this -> view -> sort -> actionName -> cssClass = 'sort-title';
		$this -> view -> sort -> actionName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/actionName/asc';
		$this -> view -> sort -> package -> cssClass = 'sort-title';
		$this -> view -> sort -> package -> href = $this -> view -> sanitized -> actionURI -> value . 'list/package/asc';
		$this -> view -> sort -> {'class'} -> cssClass = 'sort-title';
		$this -> view -> sort -> {'class'} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/class/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['actionTitle']) && $_GET['actionTitle'] == 'asc') {
			$this -> view -> sort -> actionTitle -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> actionTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/actionTitle/desc';
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByAction_titleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['actionTitle']) && $_GET['actionTitle'] == 'desc') {
			$this -> view -> sort -> actionTitle -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> actionTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/actionTitle/asc';
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByAction_titleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['actionName']) && $_GET['actionName'] == 'asc') {
			$this -> view -> sort -> actionName -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> actionName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/actionName/desc';
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByAction_NameWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['actionName']) && $_GET['actionName'] == 'desc') {
			$this -> view -> sort -> actionName -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> actionName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/actionName/asc';
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByAction_NameWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['package']) && $_GET['package'] == 'asc') {
			$this -> view -> sort -> package -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> package -> href = $this -> view -> sanitized -> actionURI -> value . 'list/package/desc';
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderByPackage_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['package']) && $_GET['package'] == 'desc') {
			$this -> view -> sort -> package -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> package -> href = $this -> view -> sanitized -> actionURI -> value . 'list/package/asc';
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderByPackage_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['class']) && $_GET['class'] == 'asc') {
			$this -> view -> sort -> class -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> class -> href = $this -> view -> sanitized -> actionURI -> value . 'list/class/desc';
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderByClass_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['class']) && $_GET['class'] == 'desc') {
			$this -> view -> sort -> class -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> class -> href = $this -> view -> sanitized -> actionURI -> value . 'list/class/asc';
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderByClass_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$actionListResult = $this -> actionObj -> getAllPackage_actionOrderByIdWithLimit($this -> start, $this -> limit);

		}

		$this -> pagingObj -> _init($this -> actionObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		$packageListResult = $this -> packageObj -> getAllPackageOrderById();
		$classListResult = $this -> classObj -> getAllPackage_classOrderById();

		//listing
		$countOfPackageListResult = count($packageListResult);
		$countOfClassListResult = count($classListResult);
		$packageTitle = array();
		$defaultActionTitle = '';
		$classTitle = array();
		for ($i = 0; $i < $countOfPackageListResult; $i++) {
			$packageTitle[$packageListResult[$i]['id']] = $packageListResult[$i]['title'];
		}
		for ($i = 0; $i < $countOfClassListResult; $i++) {
			$classTitle[$classListResult[$i]['id']] = $classListResult[$i]['title'];
		}
		$actionList = '';
		if (!empty($actionListResult) and false != $actionListResult) {
			foreach ($actionListResult as $key => $value) {
				$actionList .= '<tr>';
				$actionList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="actionId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$actionList .= '<td class="jstalgntop">' . $value['action_title'] . '</td>';
				$actionList .= '<td class="jstalgntop">' . $value['action_name'] . '</td>';
				$actionList .= '<td class="jstalgntop">' . $packageTitle[$value['package_id']] . '</td>';
				$actionList .= '<td class="jstalgntop">' . $classTitle[$value['class_id']] . '</td>';
				$actionList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$actionList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/package-action/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$actionList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> actionList = $actionList;
		$this -> view -> render('package/listPackageAction.phtml');
		exit();
	}

}
