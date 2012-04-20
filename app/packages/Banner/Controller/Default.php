<?php

class Banner_Controller_Default extends Aula_Controller_Action {
	
	private $bannerObj = Null;
	private $areaObj = Null;
	private $uploadObj = Null;
	
	protected function _init() {
		$this->bannerObj = new Banner_Model_Default ();
		$this->areaObj = new Banner_Model_Area ();
		
		//Upload Object
		$this->uploadObj = new Aula_Model_Upload ( 'uploadFile' );
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'fullPath' => array ('filePath', 0, $this->bannerObj->fullPath ), 'uploadFile' => array ('fileUploaded', 0, (! empty ( $_FILES ['uploadFile'] ['name'] ) ? $_FILES ['uploadFile'] ['name'] : '') ), 'link' => array ('url', 0 ), 'status' => array ('text', 0 ), 'bannerId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'title' => array ('text', 1 ), 'label' => array ('text', 1 ), 'area' => array ('numeric', 1 ), 'type' => array ('text', 1, $this->bannerObj->type ), 'object' => array ('text', 0 ), 'published' => array ('text', 0, $this->bannerObj->published ), 'approved' => array ('text', 0, $this->bannerObj->approved ), 'comment' => array ('text', 0, $this->bannerObj->comments ), 'option' => array ('text', 0, $this->bannerObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'publishFrom' => array ('shortDateTime', 0, $this->bannerObj->publishFrom ), 'publishTo' => array ('shortDateTime', 0, $this->bannerObj->publishTo ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//area list
		$this->areaList = '';
		$this->areaListResult = $this->areaObj->getAllBanner_areaOrderById ();
		if (! empty ( $this->areaListResult )) {
			foreach ( $this->areaListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['type'] ['value']) ? 'selected="selected"' : '';
				$this->areaList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->areaList = $this->areaList;
		
		//type list
		$this->typeList = '';
		$this->typeList .= '<option value="image file"' . ('image' == $this->view->sanitized ['type'] ['value'] ? 'selected="selected"' : '') . '>image file</option>';
		$this->typeList .= '<option value="image url"' . ('image' == $this->view->sanitized ['type'] ['value'] ? 'selected="selected"' : '') . '>image url</option>';
		$this->typeList .= '<option value="swf file"' . ('swf' == $this->view->sanitized ['type'] ['value'] ? 'selected="selected"' : '') . '>swf file</option>';
		$this->typeList .= '<option value="swf object"' . ('swf' == $this->view->sanitized ['type'] ['value'] ? 'selected="selected"' : '') . '>swf object</option>';
		$this->typeList .= '<option value="javascript code"' . ('javascript' == $this->view->sanitized ['type'] ['value'] ? 'selected="selected"' : '') . '>javascript code</option>';
		$this->view->typeList = $this->typeList;
	}
	
	public function listAction() {
	}

}
