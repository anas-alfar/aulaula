<?php

class Menu_Controller_Default extends Aula_Controller_Action {
	
	private $menuObj = Null;
	private $menuInfoObj = Null;
	private $menuTypeObj = Null;
	
	protected function _init() {
		$this->menuObj = new Menu_Model_Default ();
		$this->menuInfoObj = new Menu_Model_Info ();
		$this->menuTypeObj = new Menu_Model_Type ();
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'menuId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'label' => array ('text', 1 ), 'link' => array ('uri', 0 ), 'type' => array ('numericUnsigned', 1 ), 'parent' => array ('numericUnsigned', 0 ), 'subLevel' => array ('numericUnsigned', 1, $this->menuObj->subLevel ), 'published' => array ('text', 0, $this->menuTypeObj->published ), 'approved' => array ('text', 0, $this->menuTypeObj->approved ), 'order' => array ('numericUnsigned', 0, $this->menuTypeObj->order ), 'afterId' => array ('numeric', 0 ), 'publishFrom' => array ('shortDateTime', 0 ), 'publishTo' => array ('shortDateTime', 0 ), 'comment' => array ('text', 0, $this->menuTypeObj->comments ), 'option' => array ('text', 0, $this->menuTypeObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->menuObj->getMenuDetailsById ( ( int ) $_GET ['id'] );
			$result = $result [0];
			if (empty ( $this->view->sanitized ['type'] ['value'] )) {
				$this->view->sanitized ['type'] ['value'] = $result ['type_id'];
			}
			if (empty ( $this->view->sanitized ['parent'] ['value'] ) && ! $this->isPagePostBack) {
				$this->view->sanitized ['parent'] ['value'] = $result ['parent_id'];
			}
		}
		//menu list
		$this->menuTypeList = '';
		$this->menuTypeListResult = $this->menuTypeObj->getAllMenu_typeOrderById ();
		if (! empty ( $this->menuTypeListResult )) {
			foreach ( $this->menuTypeListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['type'] ['value']) ? 'selected="selected"' : '';
				$this->menuTypeList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->menuTypeList = $this->menuTypeList;
		
		//parent list
		$this->parentList = '';
		$this->parentListResult = $this->menuObj->getAllMenuOrderById ();
		$this->parentList = '<option value="0">' . $this->view->__ ( 'Root' ) . '</option>';
		if (! empty ( $this->parentListResult )) {
			foreach ( $this->parentListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['parent'] ['value']) ? 'selected="selected"' : '';
				$this->parentList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['label'] . '</option>';
			}
		}
		$this->view->parentList = $this->parentList;
		
		//order list
		$this->afterIdList = '';
		$this->afterIdListResult = $this->menuObj->getAllMenuOrderById ();
		if (! empty ( $this->afterIdListResult )) {
			foreach ( $this->afterIdListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['afterId'] ['value']) ? 'selected="selected"' : '';
				$this->afterIdList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['label'] . '</option>';
			}
		}
		$this->view->afterIdList = $this->afterIdList;
	}
	
	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}

}
