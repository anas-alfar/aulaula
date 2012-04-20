<?php

class Theme_Controller_Layout extends Aula_Controller_Action {
	
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $layoutInfoObj = NULL;
	private $skinObj = NULL;
	private $skinInfoObj = NULL;
	private $templateObj = NULL;
	private $templateInfoObj = NULL;
	
	protected function _init() {
		$this->layoutObj = new Theme_Model_Layout ();
		$this->layoutInfoObj = new Theme_Model_LayoutInfo ();
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'layoutId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'title' => array ('text', 1 ), 'label' => array ('text', 1 ), 'description' => array ('text', 0 ), 'published' => array ('text', 0, $this->layoutObj->published ), 'approved' => array ('text', 0, $this->layoutObj->approved ), 'default' => array ('text', 0, $this->layoutObj->default ), 'order' => array ('numericUnsigned', 0, $this->layoutObj->order ), 'afterId' => array ('numeric', 0 ), 'publishFrom' => array ('shortDateTime', 0 ), 'publishTo' => array ('shortDateTime', 0 ), 'comment' => array ('text', 0, $this->layoutObj->comments ), 'option' => array ('text', 0, $this->layoutObj->options ), 'direction' => array ('text', 0, $this->layoutObj->direction ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//direction list
		$this->directionList = '';
		$this->directionListResult = array (0 => array ('id' => 'ltr', 'label' => 'Right to Left' ), 1 => array ('id' => 'rtl', 'label' => 'Left to Right ' ) );
		foreach ( $this->directionListResult as $key => $value ) {
			$selectedItem = ($value ['id'] == $this->view->sanitized ['direction'] ['value']) ? 'selected="selected"' : '';
			$this->directionList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $this->view->__ ( $value ['label'] ) . '</option>';
		}
		$this->view->directionList = $this->directionList;
		
		//order list
		$this->afterIdList = '';
		$this->afterIdListResult = $this->layoutObj->getAllTheme_layoutOrderById ();
		if (! empty ( $this->afterIdListResult )) {
			foreach ( $this->afterIdListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['afterId'] ['value']) ? 'selected="selected"' : '';
				$this->afterIdList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
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
	
	public function previewAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}
	
	public function saveAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}

}
