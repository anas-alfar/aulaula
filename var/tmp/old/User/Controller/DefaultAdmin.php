<?php

class User_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $userObj = NULL;
	private $authObj = NULL;
	private $userInfoObj = NULL;
	private $userLevelObj = NULL;
	private $userLevelPermissionObj = NULL;
	private $errorMessage = Array();

	protected function _init() {
		$this -> userObj = new User_Model_Default();
		$this -> userInfoObj = new User_Model_Info();
		$this -> userLevelObj = new User_Model_Level();
		$this -> authObj = new Aula_Model_Auth();
		$this -> categoryObj = new Category_Model_Default();
		$this -> authObj -> _init($this -> fc -> settings -> default_storage);

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'username' => array('nickName', 1), 'password' => array('password', 1), 'confirmPassword' => array('password', 1), 'fullname' => array('text', 1), 'email' => array('email', 1), 'userLevel' => array('numeric', 0), 'dateOfBirth' => array('shortDateTime', 0), 'registrationDate' => array('shortDateTime', 0), 'company' => array('text', 0), 'department' => array('text', 0), 'position' => array('text', 0), 'homePhone' => array('numeric', 0), 'workPhone' => array('numeric', 0), 'workFax' => array('numeric', 0), 'mobile' => array('numeric', 0), 'blocked' => array('text', 0, $this -> userInfoObj -> blocked), 'confirmed' => array('text', 0, $this -> userInfoObj -> confirmed), 'approved' => array('text', 0, $this -> userInfoObj -> approved), 'comment' => array('text', 0, $this -> userInfoObj -> comments), 'option' => array('text', 0, $this -> userInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'general' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if ($this -> view -> sanitized -> password -> value != $this -> view -> sanitized -> confirmPassword -> value) {
				$this -> errorMessage['password'] = $this -> view -> __('please check that the two password are equivalent');
			}
			if (empty($this -> errorMessage)) {
				$password = md5($this -> fc -> settings -> hash . $this -> view -> sanitized -> password -> value);
				$result = $this -> userObj -> insertIntoUser(Null, $this -> view -> sanitized -> username -> value, $password, $this -> view -> sanitized -> fullname -> value, $this -> view -> sanitized -> email -> value, $this -> view -> sanitized -> userLevel -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				$result = $this -> userInfoObj -> insertIntoUser_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> dateOfBirth -> value, $this -> view -> sanitized -> registrationDate -> value, $this -> view -> sanitized -> lastLoginDate -> value, $this -> view -> sanitized -> company -> value, $this -> view -> sanitized -> department -> value, $this -> view -> sanitized -> position -> value, $this -> view -> sanitized -> homePhone -> value, $this -> view -> sanitized -> workPhone -> value, $this -> view -> sanitized -> workFax -> value, $this -> view -> sanitized -> mobile -> value, $this -> view -> sanitized -> blocked -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> confirmed -> value, $this -> view -> sanitized -> lockedBy -> value, $this -> view -> sanitized -> lockedTime -> value, $this -> view -> sanitized -> modifiedBy -> value, $this -> view -> sanitized -> modifiedTime -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/user/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/user/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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
		$this -> view -> render('user/addUser.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if ($this -> view -> sanitized -> password -> value != $this -> view -> sanitized -> confirmPassword -> value) {
				$this -> errorMessage['password'] = $this -> view -> __('please check that the two password are equivalent');
			}
			if (empty($this -> errorMessage)) {
				$password = md5($this -> fc -> settings -> hash . $this -> view -> sanitized -> password -> value);
				$result = $this -> userObj -> updateUserById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> username -> value, $password, $this -> view -> sanitized -> fullname -> value, $this -> view -> sanitized -> email -> value, $this -> view -> sanitized -> userLevel -> value);
				$resultInfo = $this -> userInfoObj -> getAllUser_infoByUser_idOrderById($this -> view -> sanitized -> Id -> value);
				$resultInfoId = $resultInfo[0]['id'];
				$result = $this -> userInfoObj -> updateUser_infoById($resultInfoId, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> dateOfBirth -> value, $this -> view -> sanitized -> registrationDate -> value, $this -> view -> sanitized -> lastLoginDate -> value, $this -> view -> sanitized -> company -> value, $this -> view -> sanitized -> department -> value, $this -> view -> sanitized -> position -> value, $this -> view -> sanitized -> homePhone -> value, $this -> view -> sanitized -> workPhone -> value, $this -> view -> sanitized -> workFax -> value, $this -> view -> sanitized -> mobile -> value, $this -> view -> sanitized -> blocked -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> confirmed -> value, $this -> view -> sanitized -> lockedBy -> value, $this -> view -> sanitized -> lockedTime -> value, $this -> view -> sanitized -> modifiedBy -> value, $this -> view -> sanitized -> modifiedTime -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/user/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/user/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> userObj -> getUserDetailsById(( int )$_GET['id']);
			//$this->view->sanitized = $result [0];
			$result = $result[0];
			$resultInfo = $this -> userInfoObj -> getAllUser_infoByUser_idOrderById(( int )$_GET['id']);
			$resultInfo = $resultInfo[0];
			$resultInfo['date_of_birth'] = substr($resultInfo['date_of_birth'], 0, 10);
			$resultInfo['registration_date'] = substr($resultInfo['registration_date'], 0, 10);
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'username' => array('nickName', 1, $result['username']), 'password' => array('password', 1, $result['password']), 'confirmPassword' => array('password', 1, $result['password']), 'fullname' => array('text', 1, $result['fullname']), 'email' => array('email', 1, $result['email']), 'userLevel' => array('numeric', 0, $result['user_level_id']), 'dateOfBirth' => array('shortDateTime', 0, $resultInfo['date_of_birth']), 'registrationDate' => array('shortDateTime', 0, $resultInfo['registration_date']), 'company' => array('text', 0, $resultInfo['company']), 'department' => array('text', 0, $resultInfo['department']), 'position' => array('text', 0, $resultInfo['position']), 'homePhone' => array('numeric', 0, $resultInfo['home_phone']), 'workPhone' => array('numeric', 0, $resultInfo['work_phone']), 'workFax' => array('numeric', 0, $resultInfo['work_fax']), 'mobile' => array('numeric', 0, $resultInfo['mobile']), 'blocked' => array('text', 0, $resultInfo['blocked']), 'confirmed' => array('text', 0, $resultInfo['confirmed']), 'approved' => array('text', 0, $resultInfo['approved']), 'comment' => array('text', 0, $resultInfo['comments']), 'option' => array('text', 0, $resultInfo['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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
		$this -> view -> render('user/addUser.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);

		if (!empty($this -> view -> sanitized -> userId -> value)) {
			foreach ($this->view->sanitized->userId->value as $id => $value) {
				$userDelete = $this -> userObj -> deleteFromUserById($id);
				$userInfoDelete = $this -> userInfoObj -> deleteFromUser_infoByUser_id($id);
			}
			if (!empty($userDelete)) {
				header('Location: /admin/handle/pkg/user/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user/action/list/');
		exit();
	}

	public function blockAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> userId -> value)) {
			foreach ($this->view->sanitized->userId->value as $id => $value) {
				$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
				$userId = $this -> userInfoObj -> GetAllUser_infoByUser_idOrderById($id);
				$userInfoBlock = $this -> userInfoObj -> updateUser_infoBlockedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($userInfoBlock)) {
				header('Location: /admin/handle/pkg/user/action/list/success/block');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user/action/list/');
		exit();
	}

	public function confirmAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> userId -> value)) {
			foreach ($this->view->sanitized->userId->value as $id => $value) {
				$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
				$userId = $this -> userInfoObj -> GetAllUser_infoByUser_idOrderById($id);
				$userInfoConfirm = $this -> userInfoObj -> updateUser_infoConfirmedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($userInfoConfirm)) {
				header('Location: /admin/handle/pkg/user/action/list/success/confirm');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> userId -> value)) {
			foreach ($this->view->sanitized->userId->value as $id => $value) {
				$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
				$userId = $this -> userInfoObj -> GetAllUser_infoByUser_idOrderById($id);
				$userInfoAprrove = $this -> userInfoObj -> updateUser_infoApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($userInfoAprrove)) {
				header('Location: /admin/handle/pkg/user/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user/action/list/');
		exit();
	}

	public function typeListAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/user/action/';

		//sortin
		$this -> view -> sort -> username -> cssClass = 'sort-title';
		$this -> view -> sort -> username -> href = $this -> view -> sanitized -> actionURI -> value . 'list/username/asc';
		$this -> view -> sort -> fullname -> cssClass = 'sort-title';
		$this -> view -> sort -> fullname -> href = $this -> view -> sanitized -> actionURI -> value . 'list/fullname/asc';
		$this -> view -> sort -> blocked -> cssClass = 'sort-title';
		$this -> view -> sort -> blocked -> href = $this -> view -> sanitized -> actionURI -> value . 'list/blocked/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> confirmed -> cssClass = 'sort-title';
		$this -> view -> sort -> confirmed -> href = $this -> view -> sanitized -> actionURI -> value . 'list/confirmed/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		$this -> view -> sort -> userLevel -> cssClass = 'sort-arrow-asc';
		$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/desc';
		$userListResult = $this -> userObj -> GetAllUserOrderByUser_level_idWithLimit('ASC', $this -> start, $this -> limit);

	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/user/action/';
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
		$this -> view -> sort -> username -> cssClass = 'sort-title';
		$this -> view -> sort -> username -> href = $this -> view -> sanitized -> actionURI -> value . 'list/username/asc';
		$this -> view -> sort -> fullname -> cssClass = 'sort-title';
		$this -> view -> sort -> fullname -> href = $this -> view -> sanitized -> actionURI -> value . 'list/fullname/asc';
		$this -> view -> sort -> userLevel -> cssClass = 'sort-title';
		$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/asc';
		$this -> view -> sort -> blocked -> cssClass = 'sort-title';
		$this -> view -> sort -> blocked -> href = $this -> view -> sanitized -> actionURI -> value . 'list/blocked/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> confirmed -> cssClass = 'sort-title';
		$this -> view -> sort -> confirmed -> href = $this -> view -> sanitized -> actionURI -> value . 'list/confirmed/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['username']) && $_GET['username'] == 'asc') {
			$this -> view -> sort -> username -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> username -> href = $this -> view -> sanitized -> actionURI -> value . 'list/username/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('username', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['username']) && $_GET['username'] == 'desc') {
			$this -> view -> sort -> username -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> username -> href = $this -> view -> sanitized -> actionURI -> value . 'list/username/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('username', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['fullname']) && $_GET['fullname'] == 'asc') {
			$this -> view -> sort -> fullname -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> fullname -> href = $this -> view -> sanitized -> actionURI -> value . 'list/fullname/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('fullname', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['fullname']) && $_GET['fullname'] == 'desc') {
			$this -> view -> sort -> fullname -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> fullname -> href = $this -> view -> sanitized -> actionURI -> value . 'list/fullname/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('fullname', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['userLevel']) && $_GET['userLevel'] == 'asc') {
			$this -> view -> sort -> userLevel -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('user_level_id', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['userLevel']) && $_GET['userLevel'] == 'desc') {
			$this -> view -> sort -> userLevel -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> userLevel -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userLevel/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('user_level_id', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['blocked']) && $_GET['blocked'] == 'asc') {
			$this -> view -> sort -> blocked -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> blocked -> href = $this -> view -> sanitized -> actionURI -> value . 'list/blocked/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('blocked', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['blocked']) && $_GET['blocked'] == 'desc') {
			$this -> view -> sort -> blocked -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> blocked -> href = $this -> view -> sanitized -> actionURI -> value . 'list/blocked/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('blocked', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['confirmed']) && $_GET['confirmed'] == 'asc') {
			$this -> view -> sort -> confirmed -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> confirmed -> href = $this -> view -> sanitized -> actionURI -> value . 'list/confirmed/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('confirmed', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['confirmed']) && $_GET['confirmed'] == 'desc') {
			$this -> view -> sort -> confirmed -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> confirmed -> href = $this -> view -> sanitized -> actionURI -> value . 'list/confirmed/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('confirmed', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('approved', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('approved', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('date_added', 'ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('date_added', 'DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$userListResult = $this -> userObj -> GetAllUserByUser_level_idOrderByIdWithLimit(( int )$_GET['id'], $this -> start, $this -> limit);
		} else {
			$userListResult = $this -> userObj -> getAllUserAndUser_infoOrderByColumnWithLimit('u.id', 'DESC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> userObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		$userLevelListResult = $this -> userLevelObj -> getAllUser_levelOrderById();

		//listing
		$countOfUserLevelListResult = count($userLevelListResult);
		$userList = '';
		$userInfoList = '';
		$userLevelList = '';
		$userLevel = array();
		$blocked = array();
		$approved = array();
		$confirmed = array();

		for ($i = 0; $i < $countOfUserLevelListResult; $i++) {
			$userLevel[$userLevelListResult[$i]['id']] = $userLevelListResult[$i]['title'];
		}

		if (!empty($userListResult) and false != $userListResult) {
			foreach ($userListResult as $key => $value) {
				$userList .= '<tr>';
				$userList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="userId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$userList .= '<td class="jstalgntop">' . $value['username'] . '</td>';
				$userList .= '<td class="jstalgntop">' . $value['fullname'] . '</td>';
				$userList .= '<td class="jstalgntop">' . $userLevel[$value['user_level_id']] . '</td>';
				$userList .= '<td class="jstalgntop">' . $this -> view -> __($value['blocked']) . '</td>';
				$userList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$userList .= '<td class="jstalgntop">' . $this -> view -> __($value['confirmed']) . '</td>';
				$userList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$userList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/user/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$userList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> userList = $userList;

		$this -> view -> render('user/listUser.phtml');
		exit();
	}

}
