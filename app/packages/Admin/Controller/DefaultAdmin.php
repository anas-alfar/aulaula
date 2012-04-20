<?php

class Admin_Controller_DefaultAdmin extends Aula_Controller_Action {
	
	private $usersObj = NULL;
	
	protected function _init() {
		$this->defualtAction = 'login';
		$this->defualtAdminAction = 'login';
		$this->view->isBackendTheme = true;
		Zend_Registry::set ( 'settings-isBackendTheme', 1 );
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->usersObj = new User_Model_Default ();
		$this->authObj = new Aula_Model_Auth ();
		$this->authObj->_init ( $this->fc->settings->default_storage );
		
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'username' => array ('nickName', 1 ), 'password' => array ('password', 1 ), 'btn_submit' => array ('', 0 ), 'general' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
	}
	
	public function loginAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (true == $this->authObj->hasIdentity () and true === $this->isAdminLoggedIn) {
			header ( 'Location: /admin/dashboard' );
			exit ();
		} else {
			if (isset ( $_GET ['s'] ) and (1 === ( int ) $_GET ['s'])) {
				$this->view->sanitized->general->successMessage = $this->view->__ ( 'successfully logged out' );
				$this->view->sanitized->general->successMessageStyle = 'display: block;';
			}
			$this->view->arrayToObject ( $this->view->sanitized );
			$this->view->render ( 'login.phtml' );
		}
	}
	
	public function logoutAction() {
		if ($this->authObj->hasIdentity () === true) {
			$this->authObj->clearIdentity ();
		}
		header ( 'Location: /admin/login/s/1' );
		exit ();
	}
	
	public function dashboardAction() {
		if (true !== $this->authObj->hasIdentity () or true !== $this->isAdminLoggedIn) {
			header ( 'Location: /admin/login' );
			exit ();
		}
		//$this->view->render ( );
		$this->view->render ( 'dashboard.phtml' );
		exit ();
	}
	
	public function checkLoginAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->usersObj->read ( '`username` = ? AND `password` =? ', array ($this->view->sanitized->username->value, md5 ( $this->fc->settings->encryption->hash . $this->view->sanitized->password->value ) ) );
				//	$result = $this->usersObj->getUserDetailsByUsernameAndPassword ( $this->view->sanitized->username->value, md5 ( $this->fc->settings->encryption->hash . $this->view->sanitized->password->value ) );
				if ($result !== false) {
					$this->authObj->getStorage ()->write ( 'isLoggedIn', 1 );
					$this->authObj->getStorage ()->write ( 'username', $this->view->sanitized->username->value );
					$this->authObj->getStorage ()->write ( 'uid', $result [0] ['id'] );
					$this->authObj->getStorage ()->write ( 'c', $this->view->sanitized->username->value . '||||' . $result [0] ['id'] . '||||' . $result [0] ['user_level_id'] . '||||' . $result [0] ['email'] . '||||' . $result [0] ['fullname'] );
					$this->authObj->getStorage ()->write ( 's', md5 ( $this->fc->settings->encryption->hash . $this->view->sanitized->username->value . '||||' . $result [0] ['id'] . '||||' . $result [0] ['user_level_id'] . '||||' . $result [0] ['email'] . '||||' . $result [0] ['fullname'] ) );
					header ( 'Location: /admin/dashboard' );
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
	
	public function handle() {
		if (true !== $this->authObj->hasIdentity () or true !== $this->isAdminLoggedIn) {
			header ( 'Location: /admin/login' );
			exit ();
		}
		
		if (empty ( $_GET ['success'] ) || ! isset ( $_GET ['success'] )) {
			$_GET ['success'] = null;
		}
		
		if (isset ( $_GET ['pkg'] ) && ! empty ( $_GET ['pkg'] )) {
			$this->fc->request->controller = $_GET ['pkg'];
			$this->fc->request->action = $_GET ['action'];
			$this->fc->request->mapRequest ();
			$this->fc->request->controller .= 'Admin';
			//loadController
			$this->fc->request = $this->fc->request->loadController ( $this->fc );
		}
		header ( 'Location: /admin/dashboard' );
		exit ();
	}
}