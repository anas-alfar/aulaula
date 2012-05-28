<?php

class User_Controller_DefaultAdmin extends Aula_Controller_Action {

	protected $userObj = NULL;
	protected $authObj = NULL;
	protected $userInfoObj = NULL;
	protected $userLevelObj = NULL;
	protected $userLevelPermissionObj = NULL;
	protected $errorMessage = Array();

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
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'username' => array('nickName', 1), 'password' => array('password', 1), 'confirmPassword' => array('password', 1), 'fullname' => array('text', 1), 'email' => array('email', 1), 'userLevel' => array('numeric', 0), 'dateOfBirth' => array('shortDateTime', 0), 'registrationDate' => array('shortDateTime', 0), 'company' => array('text', 0), 'department' => array('text', 0), 'position' => array('text', 0), 'homePhone' => array('numeric', 0), 'workPhone' => array('numeric', 0), 'workFax' => array('numeric', 0), 'mobile' => array('numeric', 0), 'blocked' => array('text', 0, $this -> userInfoObj -> blocked), 'confirmed' => array('text', 0, $this -> userInfoObj -> confirmed), 'approved' => array('text', 0, $this -> userInfoObj -> approved), 'comment' => array('text', 0, $this -> userInfoObj -> comments), 'option' => array('text', 0, $this -> userInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'general' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
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
				$where = $this -> userObj -> getAdapter() -> quoteInto('id = ?', $id);
				$userDelete = $this -> userObj -> delete($where);

				$where = $this -> userInfoObj -> getAdapter() -> quoteInto('user_id = ?', $id);
				$userInfoDelete = $this -> userInfoObj -> delete($where);				
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
				
				$data = array('blocked' => $this -> view -> sanitized -> status -> value);
				$where = $this -> userInfoObj -> getAdapter() -> quoteInto('user_id = ?', $id);
				$userInfoBlock = $this -> userInfoObj -> update($data, $where);
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
				
				$data = array('confirmed' => $this -> view -> sanitized -> status -> value);
				$where = $this -> userInfoObj -> getAdapter() -> quoteInto('user_id = ?', $id);
				$userInfoConfirm = $this -> userInfoObj -> update($data, $where);
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
				
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> userInfoObj -> getAdapter() -> quoteInto('user_id = ?', $id);
				$userInfoAprrove = $this -> userInfoObj -> update($data, $where);
			}
			if (!empty($userInfoAprrove)) {
				header('Location: /admin/handle/pkg/user/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/user/action/';

		if (!empty($_GET['success'])) {
			$this -> view -> successMessageStyle = 'display: block;';
			switch ($_GET['success']) {
				case 'approve' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
					break;
				case 'block' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Block');
					break;
				case 'delete' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
					break;
				case 'confirmed' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Confirmed');
					break;
			}
		}
		
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}
		
		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		$cols = array_merge($this->userObj->cols,$this->userInfoObj->cols);
		
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
			$userListResult = $this -> userObj -> getUserAndUser_infoOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$userListResult = $this -> userObj -> getUserAndUser_infoOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> userObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		
		$userLevelListResult = $this -> userLevelObj -> read();

		//listing
		$countOfUserLevelListResult = count($userLevelListResult);
		$userLevel = array();
		$blocked = array();
		$approved = array();
		$confirmed = array();

		for ($i = 0; $i < $countOfUserLevelListResult; $i++) {
			$userLevel[$userLevelListResult[$i]['id']] = $userLevelListResult[$i]['title'];
		}

		if (empty($userListResult) and false == $userListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> userList = $userListResult;
		$this -> view -> userLevelList = $userLevel;
		$this -> view -> render('user/listUser.phtml');
		exit();
	}

}
