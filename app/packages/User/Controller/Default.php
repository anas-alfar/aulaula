<?php

class User_Controller_Default extends Aula_Controller_Action {
	
	private $userObj = NULL;
	private $authObj = NULL;
	private $userInfoObj = NULL;
	private $userLevelObj = NULL;
	private $userLevelPermissionObj = NULL;
	private $errorMessage = Array ();
	
	protected function _init() {
		$this->userObj = new User_Model_Default ();
		$this->userInfoObj = new User_Model_Info ();
		$this->userLevelObj = new User_Model_Level ();
		$this->authObj = new Aula_Model_Auth ();
		$this->categoryObj = new Category_Model_Default ();
		$this->authObj->_init ( $this->fc->settings->default_storage );
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'userId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'username' => array ('nickName', 1 ), 'password' => array ('password', 1 ), 'confirmPassword' => array ('password', 1 ), 'fullname' => array ('text', 1 ), 'email' => array ('email', 1 ), 'userLevel' => array ('numeric', 0 ), 'dateOfBirth' => array ('shortDateTime', 0 ), 'registrationDate' => array ('shortDateTime', 0 ), 'company' => array ('text', 0 ), 'department' => array ('text', 0 ), 'position' => array ('text', 0 ), 'homePhone' => array ('numeric', 0 ), 'workPhone' => array ('numeric', 0 ), 'workFax' => array ('numeric', 0 ), 'mobile' => array ('numeric', 0 ), 'blocked' => array ('text', 0, $this->userInfoObj->blocked ), 'confirmed' => array ('text', 0, $this->userInfoObj->confirmed ), 'approved' => array ('text', 0, $this->userInfoObj->approved ), 'comment' => array ('text', 0, $this->userInfoObj->comments ), 'option' => array ('text', 0, $this->userInfoObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'general' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		//user level list
		$this->userLevelList = '';
		$this->userLevelListResult = $this->userLevelObj->GetAllUser_levelOrderById ();
		if (! empty ( $this->userLevelListResult )) {
			foreach ( $this->userLevelListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['userLevel'] ['value']) ? 'selected="selected"' : '';
				$this->userLevelList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->userLevelList = $this->userLevelList;
	}
	
	public function addAction() {
		$this->view->sanitized = $_POST;
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'agreement' => array ('text', 1 ), 'token' => array ('text', 1 ), 'username' => array ('nickName', 1 ), 'password' => array ('password', 1 ), 'confirmPassword' => array ('password', 1 ), 'fullname' => array ('text', 1 ), 'email' => array ('email', 1 ), 'mobile' => array ('numeric', 1 ), 'userLevel' => array ('numeric', 1, 2 ), 'blocked' => array ('text', 0, $this->userInfoObj->blocked ), 'confirmed' => array ('text', 0, $this->userInfoObj->confirmed ), 'approved' => array ('text', 0, $this->userInfoObj->approved ), 'comment' => array ('text', 0, $this->userInfoObj->comments ), 'option' => array ('text', 0, $this->userInfoObj->options ), 'notification' => array ('', 0 ), 'general' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if ($this->view->sanitized->password->value != $this->view->sanitized->confirmPassword->value) {
				$this->errorMessage ['password'] = $this->view->__ ( 'please check that the two password are equivalent' );
			}
			if (empty ( $this->errorMessage )) {
				$_longDateTime = date ( 'Y-m-d H:i:s' );
				$password = md5 ( $this->fc->settings->hash . $this->view->sanitized->password->value );
				$this->view->sanitized->comment->value = md5 ( $this->fc->settings->hash . $this->view->sanitized->username->value . $_longDateTime );
				$result = $this->userObj->insertIntoUser ( Null, $this->view->sanitized->username->value, $password, $this->view->sanitized->fullname->value, $this->view->sanitized->email->value, $this->view->sanitized->userLevel->value );
				$this->view->sanitized->Id->value = $result [0];
				$result = $this->userInfoObj->insertIntoUser_info ( NULL, $this->view->sanitized->Id->value, NULL, $_longDateTime, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $this->view->sanitized->mobile->value, $this->view->sanitized->blocked->value, $this->view->sanitized->approved->value, $this->view->sanitized->confirmed->value, NULL, NULL, NULL, NULL, $this->view->sanitized->comment->value, $this->view->sanitized->option->value );
				if ($result !== false) {
					$mail = mail ( $this->view->sanitized->email->value, $this->view->__ ( 'Qumra Registration Verification' ), $this->view->__ ( 'Click the link bellow to verify your subscription' ) . '<a href="http://www.qumraimages.org/user/verify/id/' . $this->view->sanitized->Id->value . '/hash/' . $this->view->sanitized->comment->value . '/"></a>' );
					$mail = mail ( $this->fc->settings->email->webamster, $this->view->__ ( 'New User Registration on Qumra' ), $this->view->__ ( 'Username:' ) . $this->view->sanitized->username->value . '<br />' . $this->view->__ ( 'Full Name:' ) . $this->view->sanitized->fullname->value . '<br />' . $this->view->__ ( 'Email:' ) . $this->view->sanitized->email->value . '<br />' . $this->view->__ ( 'Mobile:' ) . $this->view->sanitized->mobile->value . '<br />' );
					header ( 'Location: /user/thanks' );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on add record' );
				}
			}
		} else {
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		if (! empty ( $this->errorMessage )) {
			print_r ( $this->errorMessage );
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		$this->view->render ( 'register.phtml' );
		exit ();
	}
	
	public function listAction() {
		$userID = NULL;
		$userType = NULL;
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$userID = $_GET ['id'];
		} else {
			$userID = 1;
		}
		
		if (isset ( $_GET ['type'] ) and is_numeric ( $_GET ['type'] )) {
			$userType = $_GET ['type'];
		}
		
		$userList = '';
		$userListResult = $this->userObj->GetCleanUserAndUserInfoOrderByColumn ( 'u.user_level_id', 'DESC', 0, 99999 );
		if (! empty ( $userListResult )) {
			$this->view->userList = $userListResult;
			$this->view->arrayToObject ( $this->view->userList );
		} else {
			header ( 'Location: /' );
			exit ();
		}
		
		$photoObj = new Object_Model_Photo ();
		$photoDetailsResult = $photoObj->GetAllPhotoCleanByUserOrderByColumnWithLimit ( $userID, 'op.id', 0, 1 );
		
		if (empty ( $photoDetailsResult ) or false == $photoDetailsResult) {
			$photoDetailsResult = $photoObj->GetAllPhotoAndCategoryAndUserOrderByColumnWithLimit ( 'op.id', 0, 1 );
		}
		
		$photoDetails = $photoDetailsResult [0];
		$photoDetails ['url'] = parent::$encryptedUrl ['photo'] ['thumb-large'] [substr ( $photoDetails ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $photoDetails ['id'] ) . '.jpg';
		$photoDetails ['mediumUrl'] = parent::$encryptedUrl ['photo'] ['large-mini'] [substr ( $photoDetails ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $photoDetails ['id'] ) . '.jpg';
		$photoDetails ['largeUrl'] = parent::$encryptedUrl ['photo'] ['large'] [substr ( $photoDetails ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $photoDetails ['id'] ) . '.jpg';
		
		$this->view->photoDetails = $photoDetails;
		$this->view->arrayToObject ( $this->view->photoDetails );
		
		$this->view->render ( 'users-list.phtml' );
		exit ();
	}
	
	public function loginAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if ($this->authObj->hasIdentity () === true) {
			header ( 'Location: /object-photo/list/author/' . $this->userId );
			exit ();
		} else {
			if (isset ( $_GET ['s'] ) and is_numeric ( $_GET ['s'] )) {
				switch ($_GET ['s']) {
					case 1 :
						$this->view->sanitized->general->successMessage = $this->view->__ ( 'You have successfully logged out' );
						$this->view->sanitized->general->successMessageStyle = 'display: block;';
						break;
					case 2 :
						$this->view->sanitized->general->successMessage = $this->view->__ ( 'Your account has been verifyed.' );
						$this->view->sanitized->general->successMessageStyle = 'display: block;';
						break;
				}
			}
			$this->view->arrayToObject ( $this->view->sanitized );
			$this->view->render ( 'login.phtml' );
		}
	}
	
	public function logoutAction() {
		if ($this->authObj->hasIdentity () === true) {
			$this->authObj->clearIdentity ();
		}
		header ( 'Location: /user/login/s/1' );
		exit ();
	}
	
	public function checkLoginAction() {
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'token' => array ('text', 1 ), 'username' => array ('nickName', 1 ), 'password' => array ('password', 1 ), 'notification' => array ('', 0 ), 'general' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->userObj->getUserDetailsByUsernameAndPassword ( $this->view->sanitized->username->value, md5 ( $this->fc->settings->hash . $this->view->sanitized->password->value ) );
				if ($result !== false) {
					
					$this->authObj->getStorage ()->write ( 'isLoggedIn', 1 );
					$this->authObj->getStorage ()->write ( 'username', $this->view->sanitized->username->value );
					$this->authObj->getStorage ()->write ( 'uid', $result [0] ['id'] );
					$this->authObj->getStorage ()->write ( 'c', $this->view->sanitized->username->value . '||||' . $result [0] ['id'] . '||||' . $result [0] ['user_level_id'] . '||||' . $result [0] ['email'] . '||||' . $result [0] ['fullname'] );
					$this->authObj->getStorage ()->write ( 's', md5 ( $this->fc->settings->hash . $this->view->sanitized->username->value . '||||' . $result [0] ['id'] . '||||' . $result [0] ['user_level_id'] . '||||' . $result [0] ['email'] . '||||' . $result [0] ['fullname'] ) );
					
					header ( 'Location: /object-photo/list/author/' . $this->userId );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Invalid Login Credential' );
				}
			}
		} else {
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		
		if (! empty ( $this->errorMessage )) {
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		$this->view->render ( 'login.phtml' );
		exit ();
	}
	
	public function profileAction() {
		
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'userId' => array ('numeric', 1, $this->userId ), 'Id' => array ('numeric', 0, $this->userId ), 'token' => array ('text', 1 ), 'username' => array ('nickName', 1, $this->userName ), 'password' => array ('password', 0 ), 'confirmPassword' => array ('password', 0 ), 'fullname' => array ('text', 1, $this->userFullName ), 'email' => array ('email', 1, $this->userEmail ), 'userLevel' => array ('numeric', 0, $this->userLevel ), 'dateOfBirth' => array ('shortDateTime', 0 ), 'homePhone' => array ('numeric', 1 ), 'workFax' => array ('numeric', 1 ), 'mobile' => array ('numeric', 1 ), 'blocked' => array ('text', 0, $this->userInfoObj->blocked ), 'confirmed' => array ('text', 0, $this->userInfoObj->confirmed ), 'approved' => array ('text', 0, $this->userInfoObj->approved ), 'comment' => array ('text', 0, $this->userInfoObj->comments ), 'option' => array ('text', 0, $this->userInfoObj->options ), 'filePersonalResume' => array ('fileUploaded', 1 ), 'filePersonalPhoto' => array ('fileUploaded', 1 ), 'filePhoto_1' => array ('fileUploaded', 1 ), 'filePhoto_2' => array ('fileUploaded', 1 ), 'filePhoto_3' => array ('fileUploaded', 1 ), 'filePhoto_4' => array ('fileUploaded', 1 ), 'filePhoto_5' => array ('fileUploaded', 1 ), 'secretQuestion1' => array ('text', 0 ), 'secretQuestion2' => array ('text', 0 ), 'secretAnswer' => array ('text', 1 ), 'languages' => array ('text', 1 ), 'streetAddres' => array ('text', 1 ), 'city' => array ('alphabaticNumeric', 1 ), 'country' => array ('alphabaticNumeric', 1 ), 'postalCode' => array ('numeric', 1 ), 'company' => array ('text', 0 ), 'department' => array ('text', 0 ), 'position' => array ('text', 0 ), 'workPhone' => array ('numeric', 0 ), 'workbase' => array ('text', 0 ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'general' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		
		$this->view->sanitized = $_POST;
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		
		$countryObj = new Aula_Model_CountriesList ();
		
		$this->view->countriesList = '';
		$this->view->countriesListResult = $countryObj->enCountriesList ();
		asort ( $this->view->countriesListResult );
		foreach ( $this->view->countriesListResult as $key => $value ) {
			$selected = ($this->view->sanitized ['country'] ['value'] == $key) ? 'selected="selected"' : '';
			$this->view->countriesList .= '<option value="' . $key . '" ' . $selected . '>' . ucwords ( strtolower ( trim ( $value ) ) ) . '</option>';
		}
		
		$this->view->secretQuestionsList = '';
		$this->view->secretQuestionsListResult = array (1 => $this->view->__ ( 'Birth City' ), 2 => $this->view->__ ( 'Mother\'s Middle Name' ), 3 => $this->view->__ ( 'Father\'s Middle Name' ), 4 => $this->view->__ ( 'Pet\'s Name' ) );
		asort ( $this->view->secretQuestionsListResult );
		foreach ( $this->view->secretQuestionsListResult as $key => $value ) {
			$selected = ($this->view->sanitized ['secretQuestion1'] ['value'] == $key) ? 'selected="selected"' : '';
			$this->view->secretQuestionsList .= '<option value="' . $key . '" ' . $selected . '>' . ucwords ( strtolower ( trim ( $value ) ) ) . '</option>';
		}
		
		$this->view->languagesList = '';
		$this->view->languagesListResult = array ('English (United States)' => $this->view->__ ( 'English (United States)' ), 'Arabic' => $this->view->__ ( 'Arabic' ), 'Chinese (Simplified)' => $this->view->__ ( 'Chinese (Simplified)' ), 'Dutch' => $this->view->__ ( 'Dutch' ), 'English (United Kingdom)' => $this->view->__ ( 'English (United Kingdom)' ), 'French' => $this->view->__ ( 'French' ), 'German' => $this->view->__ ( 'German' ), 'Italian' => $this->view->__ ( 'Italian' ), 'Japanese' => $this->view->__ ( 'Japanese' ), 'Polish' => $this->view->__ ( 'Polish' ), 'Portuguese' => $this->view->__ ( 'Portuguese' ), 'Spanish' => $this->view->__ ( 'Spanish' ) );
		asort ( $this->view->languagesListResult );
		foreach ( $this->view->languagesListResult as $key => $value ) {
			$selected = ($this->view->sanitized ['languages'] ['value'] == $key) ? 'selected="selected"' : '';
			$this->view->languagesList .= '<option value="' . $key . '" ' . $selected . '>' . ucwords ( strtolower ( trim ( $value ) ) ) . '</option>';
		}
		
		$this->view->workBaseList = '';
		$this->view->workBaseListResult = array ('Middle East' => $this->view->__ ( 'Middle East' ), 'Europe' => $this->view->__ ( 'Europe' ), 'North America' => $this->view->__ ( 'North America' ), 'South America' => $this->view->__ ( 'South America' ), 'Africa' => $this->view->__ ( 'Africa' ), 'Asia' => $this->view->__ ( 'Asia' ) );
		asort ( $this->view->workBaseListResult );
		foreach ( $this->view->workBaseListResult as $key => $value ) {
			$selected = ($this->view->sanitized ['workbase'] ['value'] == $key) ? 'selected="selected"' : '';
			$this->view->workBaseList .= '<option value="' . $key . '" ' . $selected . '>' . ucwords ( strtolower ( trim ( $value ) ) ) . '</option>';
		}
		
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if ($this->view->sanitized->password->value != $this->view->sanitized->confirmPassword->value) {
				$this->errorMessage ['password'] = $this->view->__ ( 'please check that the two password are equivalent' );
			}
			if (empty ( $this->errorMessage )) {
				$password = md5 ( $this->fc->settings->hash . $this->view->sanitized->password->value );
				$result = $this->userObj->updateUserById ( $this->view->sanitized->Id->value, $this->view->sanitized->username->value, $password, $this->view->sanitized->fullname->value, $this->view->sanitized->email->value, $this->view->sanitized->userLevel->value );
				$resultInfo = $this->userInfoObj->getAllUser_infoByUser_idOrderById ( $this->view->sanitized->Id->value );
				$resultInfoId = $resultInfo [0] ['id'];
				$result = $this->userInfoObj->updateUser_infoById ( $resultInfoId, $this->view->sanitized->Id->value, $this->view->sanitized->dateOfBirth->value, $this->view->sanitized->registrationDate->value, $this->view->sanitized->lastLoginDate->value, $this->view->sanitized->company->value, $this->view->sanitized->department->value, $this->view->sanitized->position->value, $this->view->sanitized->homePhone->value, $this->view->sanitized->workPhone->value, $this->view->sanitized->workFax->value, $this->view->sanitized->mobile->value, $this->view->sanitized->blocked->value, $this->view->sanitized->approved->value, $this->view->sanitized->confirmed->value, $this->view->sanitized->lockedBy->value, $this->view->sanitized->lockedTime->value, $this->view->sanitized->modifiedBy->value, $this->view->sanitized->modifiedTime->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value );
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/user/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/user/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
				}
			}
		} else {
			$result = $this->userObj->getUserDetailsById ( ( int ) $this->userId );
			$result = $result [0];
			$resultInfo = $this->userInfoObj->getAllUser_infoByUser_idOrderById ( ( int ) $this->userId );
			$resultInfo = $resultInfo [0];
			$resultInfo ['date_of_birth'] = substr ( $resultInfo ['date_of_birth'], 0, 10 );
			$resultInfo ['registration_date'] = substr ( $resultInfo ['registration_date'], 0, 10 );
			$this->view->sanitized = array ();
			$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		if (! empty ( $this->errorMessage )) {
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		$this->view->render ( 'profile.phtml' );
		exit ();
	}
	
	public function contractAction() {
		$this->view->render ( 'contract.phtml' );
		exit ();
	}
	
	public function thanksAction() {
		$this->view->render ( 'user-thanks.phtml' );
		exit ();
	}
	
	public function verifyAction() {
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] ) and isset ( $_GET ['hash'] )) {
			$result = $this->userInfoObj->getUser_infoDetailsById ( $_GET ['id'] );
			if (! empty ( $result )) {
				if (0 === strcmp ( $result [0] ['comments'], $_GET ['hash'] )) {
					$this->userInfoObj->updateUser_infoConfirmedColumnById ( $_GET ['id'] );
					header ( 'Location: /user/login/s/2' );
					exit ();
				}
			}
		}
		header ( 'Location: /user/login' );
		exit ();
	}

}
