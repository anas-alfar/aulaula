<?php

class Translation_Controller_Default extends Aula_Controller_Action {
	
	private $translationObj = Null;
	
	protected function _init() {
		$this->localeObj = new Locale_Model_Default ();
		$this->translationObj = new Translation_Model_Default ();
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'translationId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'locale' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'label' => array ('text', 1 ), 'translation' => array ('text', 1 ), 'comment' => array ('text', 0, $this->translationObj->comments ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//locale list
		$this->localeList = '';
		$this->localeListResult = $this->localeObj->getAllLocaleOrderById ();
		if (! empty ( $this->localeListResult )) {
			foreach ( $this->localeListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['locale'] ['value']) ? 'selected="selected"' : '';
				$this->localeList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->localeList = $this->localeList;
	}
	
	public function addAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->translationObj->insertIntoTranslation ( Null, $this->view->sanitized->label->value, $this->view->sanitized->translation->value, $this->view->sanitized->locale->value, $this->view->sanitized->comment->value );
				$this->view->sanitized->Id->value = $result [0];
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/translation/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/translation/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
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
		
		$this->view->render ( 'translation/addTranslation.phtml' );
		exit ();
	
	}
	
	public function editAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->translationObj->updateTranslationById ( $this->view->sanitized->Id->value, $this->view->sanitized->label->value, $this->view->sanitized->translation->value, $this->view->sanitized->locale->value, $this->view->sanitized->comment->value );
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/translation/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/translation/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
				}
			}
		} elseif (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->translationObj->getTranslationDetailsById ( ( int ) $_GET ['id'] );
			$result = $result [0];
			$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'translationId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0, $result ['id'] ), 'locale' => array ('numeric', 0, $result ['locale_id'] ), 'token' => array ('text', 1 ), 'label' => array ('text', 1, $result ['label'] ), 'translation' => array ('text', 1, $result ['translation'] ), 'comment' => array ('text', 0, $result ['comments'] ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
			$this->view->sanitized = array ();
			$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
			$this->view->sanitized ['Id'] ['value'] = ( int ) $_GET ['id'];
			$this->view->arrayToObject ( $this->view->sanitized );
		} else {
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		
		if (! empty ( $this->errorMessage )) {
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		
		$this->view->render ( 'translation/addTranslation.phtml' );
		exit ();
	
	}
	
	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}

}
