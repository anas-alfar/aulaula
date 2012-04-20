<?php

class Object_Controller_Abuse extends Aula_Controller_Action {
	
	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $articleObj = NULL;
	private $commentObj = NULL;
	private $directoryObj = NULL;
	private $fileObj = NULL;
	private $photoObj = NULL;
	private $ratingObj = NULL;
	private $sourceInfoObj = NULL;
	private $sourceObj = NULL;
	private $staticObj = NULL;
	private $tagObj = NULL;
	private $typeObj = NULL;
	private $typeIfnoObj = NULL;
	private $urlObj = NULL;
	private $userFavouriteObj = NULL;
	private $videoObj = NULL;
	
	protected function _init() {
		//default objects
		$this->objectObj = new Object_Model_Default ();
		$this->objectInfoObj = new Object_Model_Info ();
		
		//objects
		$this->abuseObj = new Object_Model_Abuse ();
		$this->abuseTypeObj = new Object_Model_AbuseType ();
		
		//locale and category objects
		$this->categoryObj = new Category_Model_Default ();
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'abuseId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'author' => array ('numericUnsigned', 0, $this->userId ), 'aliasAbuse' => array ('text', 1 ), 'emailAbuse' => array ('email', 0 ), 'descAbuse' => array ('text', 1 ), 'isAbuse' => array ('text', 0, $this->abuseObj->isAbuse ), 'object' => array ('numericUnsigned', 1 ), 'abuseType' => array ('numericUnsigned', 1 ), 'approved' => array ('text', 0, $this->abuseObj->approved ), 'comment' => array ('text', 0, $this->abuseObj->comments ), 'option' => array ('text', 0, $this->abuseObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'afterId' => array ('numeric', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//category list
		$this->categoryList = '';
		$this->categoryListResult = $this->categoryObj->getAllCategoryOrderById ();
		if (! empty ( $this->categoryListResult )) {
			foreach ( $this->categoryListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['afterId'] ['value']) ? 'selected="selected"' : '';
				$this->categoryList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->categoryList = $this->categoryList;
		
		//template list
		$this->abuseTypeList = '';
		$this->abuseTypeListResult = $this->abuseTypeObj->getAllObject_abuse_typeOrderById ();
		if (! empty ( $this->abuseTypeListResult )) {
			foreach ( $this->abuseTypeListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['abuseType'] ['value']) ? 'selected="selected"' : '';
				$this->abuseTypeList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->abuseTypeList = $this->abuseTypeList;
		
		//layout list
		$this->objectList = '';
		$this->objectListResult = $this->objectObj->getAllObjectOrderById ();
		if (! empty ( $this->objectListResult )) {
			foreach ( $this->objectListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['object'] ['value']) ? 'selected="selected"' : '';
				$this->objectList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->objectList = $this->objectList;
	}
	
	public function addAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->abuseObj->insertIntoObject_abuse ( Null, $this->view->sanitized->object->value, $this->userId, $this->view->sanitized->aliasAbuse->value, $this->view->sanitized->emailAbuse->value, $this->view->sanitized->descAbuse->value, $this->view->sanitized->abuseType->value, $this->view->sanitized->locale->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->isAbuse->value, $this->view->sanitized->approved->value );
				$this->view->sanitized->Id->value = $result [0];
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/object-abuse/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/object-abuse/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on add record' );
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
		
		$this->view->render ( 'object/addAbuseObject.phtml' );
		exit ();
	}

}
