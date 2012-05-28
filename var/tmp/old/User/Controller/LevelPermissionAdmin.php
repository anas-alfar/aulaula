<?php

class User_Controller_LevelPermissionAdmin extends Aula_Controller_Action {

	private $userObj = NULL;
	private $userInfoObj = NULL;
	private $userLevelObj = NULL;
	private $userLevelPermissionObj = NULL;
	private $classObj = NULL;
	private $actionObj = NULL;

	protected function _init() {
		$this -> userLevelObj = new User_Model_Level();
		$this -> userLevelPermissionObj = new User_Model_LevelPermission();
		$this -> classObj = new Package_Model_Class();
		$this -> actionObj = new Package_Model_Action();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userLevelPermissionId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'userLevel' => array('text', 1), 'class' => array('numeric', 1), 'action' => array('text', 0), 'permission' => array('numeric', 1), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//user level list
		$this -> userLevelList = '';
		$this -> userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
		if (!empty($this -> userLevelListResult)) {
			foreach ($this->userLevelListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['userLevel']['value']) ? 'selected="selected"' : '';
				$this -> userLevelList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> userLevelList = $this -> userLevelList;

		//class list
		$this -> classList = '';
		$this -> classListResult = $this -> classObj -> GetAllPackage_classOrderById();
		if (!empty($this -> classListResult)) {
			foreach ($this->classListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['class']['value']) ? 'selected="selected"' : '';
				$this -> classList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> classList = $this -> classList;
	}

	public function addAction() {
		/*
		 * @todo this function doesn't work
		 */
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				foreach ($this->view->sanitized->action->value as $action => $value) {
					$result = $this -> userLevelPermissionObj -> insertIntoUser_level_permission(Null, $this -> view -> sanitized -> userLevel -> value, $this -> view -> sanitized -> class -> value, $action, $this -> view -> sanitized -> permission -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				}

				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/user-level-permission/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/user-level-permission/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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
		$this -> view -> render('user/addUserLevelPermission.phtml');
		exit();
	}

	public function listActionsAction() {
		$id = ( int )$_POST['class_id'];
		$this -> actionList = '<input class="inptflx" type="text" value="" name="action" readonly="readonly" />';
		$this -> actionListResult = $this -> actionObj -> GetAllPackage_actionByClass_idOrderById($id);
		if (!empty($this -> actionListResult) and false != $this -> actionListResult) {
			$this -> actionList = '<input type="checkbox" name="selectAll" id="selectAll" />' . '<br />';
			foreach ($this->actionListResult as $key => $value) {
				//				$selectedItem = ($value ['id'] == $this->view->sanitized ['action'] ['value']) ? 'selected="selected"' : '';
				$this -> actionList .= '<input class="intchk fl" type="checkbox" name="action[' . $value['id'] . ']" id="action[' . $value['id'] . ']"  value="Yes" />';
				$this -> actionList .= '<label class="inptlabl fl" for="action[' . $value['id'] . ']">' . $value['action_title'] . '</label>' . '<br />';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		echo $this -> actionList;
		exit();
	}

	public function editAction() {
		/*
		 * @todo this function doesn't work
		 */
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				foreach ($this->view->sanitized->action->value as $action => $value) {
					$result = $this -> userLevelPermissionObj -> updateUser_level_permissionById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> userLevel -> value, $this -> view -> sanitized -> class -> value, $action, $this -> view -> sanitized -> permission -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				}
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/user-level-permission/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/user-level-permission/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> userLevelPermissionObj -> getUser_level_permissionDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userLevelPermissionId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'userLevel' => array('text', 1, $result['user_level_id']), 'class' => array('numeric', 1, $result['class_id']), 'action' => array('text', 0, $result['action_id']), 'permission' => array('numeric', 1, $result['permission']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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
		$this -> view -> render('user/addUserLevelPermission.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> userLevelPermissionId -> value)) {
			foreach ($this->view->sanitized->userLevelPermissionId->value as $id => $value) {
				$userLevelPermissionDelete = $this -> userLevelPermissionObj -> deleteFromUser_level_permissionById($id);
			}
			if (!empty($userLevelPermissionDelete)) {
				header('Location: /admin/handle/pkg/user-level-permission/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user-level-permission/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/user-level-permission/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'block') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Block');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'approve') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'confirmed') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Confirmed');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sortin
		$this -> view -> sort -> permission -> cssClass = 'sort-title';
		$this -> view -> sort -> permission -> href = $this -> view -> sanitized -> actionURI -> value . 'list/permission/asc';
		$this -> view -> sort -> userLevel -> cssClass = 'sort-title';
		$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/asc';
		$this -> view -> sort -> class -> cssClass = 'sort-title';
		$this -> view -> sort -> class -> href = $this -> view -> sanitized -> actionURI -> value . 'list/class/asc';
		$this -> view -> sort -> action_id -> cssClass = 'sort-title';
		$this -> view -> sort -> action_id -> href = $this -> view -> sanitized -> actionURI -> value . 'list/action_id/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['permission']) && $_GET['permission'] == 'asc') {
			$this -> view -> sort -> permission -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> permission -> href = $this -> view -> sanitized -> actionURI -> value . 'list/permission/desc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByPermissionWithLimit('ASC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['permission']) && $_GET['permission'] == 'desc') {
			$this -> view -> sort -> permission -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> permission -> href = $this -> view -> sanitized -> actionURI -> value . 'list/permission/asc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByPermissionWithLimit('DESC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['userLevel']) && $_GET['userLevel'] == 'asc') {
			$this -> view -> sort -> userLevel -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/desc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByUser_level_idWithLimit('ASC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['userLevel']) && $_GET['userLevel'] == 'desc') {
			$this -> view -> sort -> userLevel -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/asc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByUser_level_idWithLimit('DESC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['class']) && $_GET['class'] == 'asc') {
			$this -> view -> sort -> class -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> class -> href = $this -> view -> sanitized -> actionURI -> value . 'list/class/desc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByClass_idWithLimit('ASC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['class']) && $_GET['class'] == 'desc') {
			$this -> view -> sort -> class -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> class -> href = $this -> view -> sanitized -> actionURI -> value . 'list/class/asc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByClass_idWithLimit('DESC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['action_id']) && $_GET['action_id'] == 'asc') {
			$this -> view -> sort -> action_id -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> action_id -> href = $this -> view -> sanitized -> actionURI -> value . 'list/action_id/desc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByAction_idWithLimit('ASC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['action_id']) && $_GET['action_id'] == 'desc') {
			$this -> view -> sort -> action_id -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> action_id -> href = $this -> view -> sanitized -> actionURI -> value . 'list/action_id/asc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByAction_idWithLimit('DESC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		} else {
			$userLevelPermissionListResult = $this -> userLevelPermissionObj -> GetAllUser_level_permissionOrderByIdWithLimit($this -> start, $this -> limit);
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderById();
			$classListResult = $this -> classObj -> GetAllPackage_classOrderById();
			$actionListResult = $this -> actionObj -> GetAllPackage_actionOrderById();
		}
		$this -> pagingObj -> _init($this -> userLevelPermissionObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		$countOfUserLevelListResult = count($userLevelListResult);
		$countOfClassListResult = count($classListResult);
		$countOfActionListResult = count($actionListResult);
		$userList = '';
		$userLevelPermissionList = '';
		$userLevel = '';
		$class = '';
		$action = '';
		for ($i = 0; $i < $countOfUserLevelListResult; $i++) {
			$userLevel[$userLevelListResult[$i]['id']] = $userLevelListResult[$i]['title'];
		}
		for ($i = 0; $i < $countOfClassListResult; $i++) {
			$class[$classListResult[$i]['id']] = $classListResult[$i]['title'];
		}
		for ($i = 0; $i < $countOfActionListResult; $i++) {
			$action[$actionListResult[$i]['id']] = $actionListResult[$i]['action_title'];
		}

		foreach ($userLevelPermissionListResult as $key => $value) {
			$userLevelPermissionList .= '<tr>';
			$userLevelPermissionList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="userLevelPermissionId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
			$userLevelPermissionList .= '<td class="jstalgntop">' . $value['permission'] . '</td>';
			$userLevelPermissionList .= '<td class="jstalgntop">' . $userLevel[$value['user_level_id']] . '</td>';
			$userLevelPermissionList .= '<td class="jstalgntop">' . $class[$value['class_id']] . '</td>';
			$userLevelPermissionList .= '<td class="jstalgntop">' . $action[$value['action_id']] . '</td>';
			$userLevelPermissionList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/user-level-permission/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
			$userLevelPermissionList .= '</tr>';
		}
		$this -> view -> userLevelPermissionList = $userLevelPermissionList;

		$this -> view -> render('user/listUserLevelPermission.phtml');
		exit();
	}

}
