<?php

/**
 *
 * Aulaula
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the file LICENSE.txt. It is also available through
 * the world-wide-web at this URL: http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@aulaula.com
 * so we can send you a copy immediately.
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Aulaula to newer versions
 * in the future. If you wish to customize Aulaula for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package User
 * @subpackage Controller
 * @name User_Controller_LevelPermission
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class User_Controller_LevelPermission extends Aula_Controller_Action {
	
	private $userObj = NULL;
	private $userInfoObj = NULL;
	private $userLevelObj = NULL;
	private $userLevelPermissionObj = NULL;
	private $classObj = NULL;
	private $actionObj = NULL;
	
	protected function _init() {
		$this->userLevelObj = new User_Model_Level ();
		$this->userLevelPermissionObj = new User_Model_LevelPermission ();
		$this->classObj = new Package_Model_Class ();
		$this->actionObj = new Package_Model_Action ();
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'userLevelPermissionId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'userLevel' => array ('text', 1 ), 'class' => array ('numeric', 1 ), 'action' => array ('text', 0 ), 'permission' => array ('numeric', 1 ), 'comment' => array ('text', 0 ), 'option' => array ('text', 0 ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
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
		
		//class list
		$this->classList = '';
		$this->classListResult = $this->classObj->GetAllPackage_classOrderById ();
		if (! empty ( $this->classListResult )) {
			foreach ( $this->classListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['class'] ['value']) ? 'selected="selected"' : '';
				$this->classList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->classList = $this->classList;
	}
	
	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}

}
