<?php

class Object_Controller_AbuseAdmin extends Aula_Controller_Action {
	
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
		
		$this->defualtAdminAction = 'list';
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
	
	public function editAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->abuseObj->updateObject_abuseById ( $this->view->sanitized->Id->value, $this->view->sanitized->object->value, $this->userId, $this->view->sanitized->aliasAbuse->value, $this->view->sanitized->emailAbuse->value, $this->view->sanitized->descAbuse->value, $this->view->sanitized->abuseType->value, $this->view->sanitized->locale->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->isAbuse->value, $this->view->sanitized->approved->value );
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/object-abuse/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/object-abuse/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
				}
			}
		} elseif (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->abuseObj->getObject_abuseDetailsById ( ( int ) $_GET ['id'] );
			$result = $result [0];
			
			$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'abuseId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0, $result ['id'] ), 'token' => array ('text', 1 ), 'author' => array ('numericUnsigned', 0, $result ['author_id'] ), 'aliasAbuse' => array ('text', 1, $result ['alias'] ), 'emailAbuse' => array ('email', 0, $result ['email'] ), 'descAbuse' => array ('text', 1, $result ['description'] ), 'isAbuse' => array ('text', 0, $result ['is_abuse'] ), 'object' => array ('numericUnsigned', 1 ), 'abuseType' => array ('numericUnsigned', 1, $result ['type_id'] ), 'approved' => array ('text', 0, $result ['approved'] ), 'comment' => array ('text', 0, $result ['comments'] ), 'option' => array ('text', 0, $result ['options'] ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'afterId' => array ('numeric', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
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
		
		$this->view->render ( 'object/addAbuseObject.phtml' );
		exit ();
	}
	
	public function deleteAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->abuseId->value )) {
			foreach ( $this->view->sanitized->abuseId->value as $id => $value ) {
				$abuseDelete = $this->abuseObj->deleteFromObject_abuseById ( $id );
			}
			if (! empty ( $abuseDelete )) {
				header ( 'Location: /admin/handle/pkg/object-abuse/action/list/success/delete' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/object-abuse/action/list/' );
		exit ();
	}
	
	public function isAbuseAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->abuseId->value )) {
			$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
			foreach ( $this->view->sanitized->abuseId->value as $id => $value ) {
				$isAbuse = $this->abuseObj->updateObject_abuseIs_abuseColumnById ( $id, $this->view->sanitized->status->value );
			}
			if (! empty ( $isAbuse )) {
				header ( 'Location: /admin/handle/pkg/object-abuse/action/list/success/isAbuse' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/object-abuse/action/list/' );
		exit ();
	}
	
	public function approveAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->abuseId->value )) {
			$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
			foreach ( $this->view->sanitized->abuseId->value as $id => $value ) {
				$abuseAprrove = $this->abuseObj->updateObject_abuseApprovedColumnById ( $id, $this->view->sanitized->status->value );
			}
			if (! empty ( $abuseAprrove )) {
				header ( 'Location: /admin/handle/pkg/object-abuse/action/list/success/approve' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/object-abuse/action/list/' );
		exit ();
	}
	
	public function listAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$this->view->sanitized->actionURI->value = '/admin/handle/pkg/object-abuse/action/';
		if (isset ( $_SERVER ['REQUEST_URI'] ) and ! empty ( $_SERVER ['REQUEST_URI'] )) {
			$this->view->sanitized->redirectURI->value = $_SERVER ['REQUEST_URI'];
		}
		
		if ($_GET ['success'] == 'approve') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Approved' );
			$this->view->successMessageStyle = 'display: block;';
		} elseif ($_GET ['success'] == 'delete') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Deleted' );
			$this->view->successMessageStyle = 'display: block;';
		}
		
		//sorting
		$this->view->sort->abuseType->cssClass = 'sort-title';
		$this->view->sort->abuseType->href = $this->view->sanitized->actionURI->value . 'list/abuseType/asc';
		$this->view->sort->IsAbuse->cssClass = 'sort-title';
		$this->view->sort->IsAbuse->href = $this->view->sanitized->actionURI->value . 'list/IsAbuse/asc';
		$this->view->sort->alias->cssClass = 'sort-title';
		$this->view->sort->alias->href = $this->view->sanitized->actionURI->value . 'list/alias/asc';
		$this->view->sort->IsAbuse->cssClass = 'sort-title';
		$this->view->sort->IsAbuse->href = $this->view->sanitized->actionURI->value . 'list/IsAbuse/asc';
		$this->view->sort->approved->cssClass = 'sort-title';
		$this->view->sort->approved->href = $this->view->sanitized->actionURI->value . 'list/approved/asc';
		$this->view->sort->dateAdded->cssClass = 'sort-title';
		$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/asc';
		
		if (isset ( $_GET ['abuseType'] ) && $_GET ['abuseType'] == 'asc') {
			$this->view->sort->abuseType->cssClass = 'sort-arrow-asc';
			$this->view->sort->abuseType->href = $this->view->sanitized->actionURI->value . 'list/abuseType/desc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oat.title', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['abuseType'] ) && $_GET ['abuseType'] == 'desc') {
			$this->view->sort->abuseType->cssClass = 'sort-arrow-desc';
			$this->view->sort->abuseType->href = $this->view->sanitized->actionURI->value . 'list/abuseType/asc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oat.title', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['alias'] ) && $_GET ['alias'] == 'asc') {
			$this->view->sort->alias->cssClass = 'sort-arrow-asc';
			$this->view->sort->alias->href = $this->view->sanitized->actionURI->value . 'list/alias/desc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.alias', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['alias'] ) && $_GET ['alias'] == 'desc') {
			$this->view->sort->alias->cssClass = 'sort-arrow-desc';
			$this->view->sort->alias->href = $this->view->sanitized->actionURI->value . 'list/alias/asc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.alias', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['IsAbuse'] ) && $_GET ['IsAbuse'] == 'asc') {
			$this->view->sort->IsAbuse->cssClass = 'sort-arrow-asc';
			$this->view->sort->IsAbuse->href = $this->view->sanitized->actionURI->value . 'list/IsAbuse/desc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.is_abuse', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['IsAbuse'] ) && $_GET ['IsAbuse'] == 'desc') {
			$this->view->sort->IsAbuse->cssClass = 'sort-arrow-desc';
			$this->view->sort->IsAbuse->href = $this->view->sanitized->actionURI->value . 'list/IsAbuse/asc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.is_abuse', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['approved'] ) && $_GET ['approved'] == 'asc') {
			$this->view->sort->approved->cssClass = 'sort-arrow-asc';
			$this->view->sort->approved->href = $this->view->sanitized->actionURI->value . 'list/approved/desc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.approved', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['approved'] ) && $_GET ['approved'] == 'desc') {
			$this->view->sort->approved->cssClass = 'sort-arrow-desc';
			$this->view->sort->approved->href = $this->view->sanitized->actionURI->value . 'list/approved/asc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.approved', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['dateAdded'] ) && $_GET ['dateAdded'] == 'asc') {
			$this->view->sort->dateAdded->cssClass = 'sort-arrow-asc';
			$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/desc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.date_added', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['dateAdded'] ) && $_GET ['dateAdded'] == 'desc') {
			$this->view->sort->dateAdded->cssClass = 'sort-arrow-desc';
			$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/asc';
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.date_added', 'DESC', $this->start, $this->limit );
		} else {
			$abuseListResult = $this->abuseObj->getObject_abuseAndObject_abuse_typeOrderByColumnWithLimit ( 'oa.id', 'DESC', $this->start, $this->limit );
		}
		
		$this->pagingObj->_init ( $this->abuseObj->totalRecordsFound );
		$this->view->paging = $this->pagingObj->paging;
		$this->view->arrayToObject ( $this->view->paging );
		
		//listing
		//$abuseListResult = $this->abuseObj->getAllObject_abuseOrderById ();
		//		$objectListResult = $this->objectObj->getAllObjectOrderById ();
		//$categoryListResult = $this->categoryObj->getAllCategoryOrderById ();
		//		$countOfObjectListResult = count ( $objectListResult );
		$abuseType = '';
		$objectList = '';
		if (! empty ( $abuseListResult ) and false != $abuseListResult) {
			foreach ( $abuseListResult as $key => $value ) {
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="abuseId[' . $value ['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $value ['title'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value ['alias'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this->view->__ ( $value ['is_abuse'] ) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this->view->__ ( $value ['approved'] ) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value ['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-abuse/action/edit/s/1/id/' . $value ['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this->view->notificationMessage = $this->view->__ ( 'Sorry, no records found' );
			$this->view->notificationMessageStyle = 'display: block;';
		}
		
		$this->view->objectList = $objectList;
		$this->view->render ( 'object/listAbuseObject.phtml' );
		exit ();
	}

}
