<?php

class Banner_Controller_Area extends Aula_Controller_Action {
	
	private $bannerObj = Null;
	private $areaObj = Null;
	
	protected function _init() {
		$this->areaObj = new Banner_Model_Area ();
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'areaId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'title' => array ('text', 1 ), 'label' => array ('text', 1 ), 'published' => array ('text', 0, $this->areaObj->published ), 'approved' => array ('text', 0, $this->areaObj->approved ), 'comment' => array ('text', 0, $this->areaObj->comments ), 'option' => array ('text', 0, $this->areaObj->options ), 'publishFrom' => array ('text', 0, $this->areaObj->publishFrom ), 'publishTo' => array ('text', 0, $this->areaObj->publishTo ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['author'] ['value'] = 1;
		$this->view->sanitized ['locale'] ['value'] = 1;
	}
	
	public function listAction() {
	}

}
