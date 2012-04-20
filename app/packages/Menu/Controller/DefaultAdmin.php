<?php

class Menu_Controller_DefaultAdmin extends Aula_Controller_Action {
	
	private $menuObj = Null;
	private $menuInfoObj = Null;
	private $menuTypeObj = Null;
	
	protected function _init() {
		$this->menuObj = new Menu_Model_Default ();
		$this->menuInfoObj = new Menu_Model_Info ();
		$this->menuTypeObj = new Menu_Model_Type ();
		$this->defualtAdminAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('actionURI' => array ('uri', 0 ), 'redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'menuId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'label' => array ('text', 1 ), 'link' => array ('uri', 0 ), 'type' => array ('numericUnsigned', 1 ), 'parent' => array ('numericUnsigned', 0 ), 'subLevel' => array ('numericUnsigned', 1, $this->menuObj->subLevel ), 'published' => array ('text', 0, $this->menuTypeObj->published ), 'approved' => array ('text', 0, $this->menuTypeObj->approved ), 'order' => array ('numericUnsigned', 0, $this->menuTypeObj->order ), 'afterId' => array ('numeric', 0 ), 'publishFrom' => array ('shortDateTime', 0 ), 'publishTo' => array ('shortDateTime', 0 ), 'comment' => array ('text', 0, $this->menuTypeObj->comments ), 'option' => array ('text', 0, $this->menuTypeObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->menuObj->find ( ( int ) $_GET ['id'] )->current ();
			if (empty ( $this->view->sanitized ['type'] ['value'] )) {
				$this->view->sanitized ['type'] ['value'] = $result ['type_id'];
			}
			if (empty ( $this->view->sanitized ['parent'] ['value'] ) && ! $this->isPagePostBack) {
				$this->view->sanitized ['parent'] ['value'] = $result ['parent_id'];
			}
		}
		//menu list
		$this->menuTypeList = '';
		$this->menuTypeListResult = $this->menuTypeObj->select ();
		if (! empty ( $this->menuTypeListResult )) {
			foreach ( $this->menuTypeListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['type'] ['value']) ? 'selected="selected"' : '';
				$this->menuTypeList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->menuTypeList = $this->menuTypeList;
		
		//parent list
		$this->parentList = '';
		$this->parentListResult = $this->menuObj->select ();
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
		$this->afterIdListResult = $this->menuObj->select ();
		if (! empty ( $this->afterIdListResult )) {
			foreach ( $this->afterIdListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['afterId'] ['value']) ? 'selected="selected"' : '';
				$this->afterIdList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['label'] . '</option>';
			}
		}
		$this->view->afterIdList = $this->afterIdList;
	}
	
	public function addAction() {
		$form = new Menu_Form_AddAdmin ( $this->view );
		$form->setView ( $this->view );
		if ($form->isValid ( $_POST )) {
			//$form -> getValues();
		} else if ($this->isPagePostBack) {
			//$form -> getErrorMessages();
		//$form -> getValues();
		}
		$this->view->form = $form;
		$this->view->render ( 'menu/add.phtml' );
		exit ();
	}
	
	public function editAction() {
		$result = $this->menuInfoObj->getMenu_info ( 'Order by id' );
		print_R ( $result );
		exit ();
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				if ($this->view->sanitized->order->value == - 1) {
					$this->view->sanitized->order->value = $this->view->sanitized->afterId->value;
				}
				
				$result = $this->menuObj->updateMenu ( array ('label' => $this->view->sanitized->label->value, 'link' => $this->view->sanitized->link->value, 'type_id' => $this->view->sanitized->type->value, 'parent_id' => $this->view->sanitized->parent->value, 'package_id' => 0, 'sublevel' => $this->view->sanitized->subLevel->value, 'published' => $this->view->sanitized->published->value, 'approved' => $this->view->sanitized->approved->value, 'order' => $this->view->sanitized->order->value ), array ('id' => $this->view->sanitized->Id->value ) );
				$result = $this->menuInfoObj->select ( 'WHERE `menu_id` = ?', array ($this->view->sanitized->Id->value ) );
				$result = $this->menuObj->updateMenu_info ( array ('menu_id' => $this->view->sanitized->Id->value, 'comments' => $this->view->sanitized->comment->value, 'options' => $this->view->sanitized->option->value, 'publish_from' => $this->view->sanitized->publishFrom->value, 'publish_to' => $this->view->sanitized->publishTo->value ), array ('id' => $result [0] ['id'] ) );
				
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/menu/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/menu/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
				}
			}
		} elseif (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->menuObj->getMenuDetailsById ( ( int ) $_GET ['id'] );
			$result = $result [0];
			$resultInfo = $this->menuInfoObj->getMenu_info ( 'WHERE `menu_id` = ?', array ($_GET ['id'] ) );
			$resultInfo = $resultInfo [0];
			
			$resultInfo ['publish_from'] = substr ( $resultInfo ['publish_from'], 0, 10 );
			$resultInfo ['publish_to'] = substr ( $resultInfo ['publish_to'], 0, 10 );
			
			$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'menuId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0, $result ['id'] ), 'token' => array ('text', 1 ), 'label' => array ('text', 1, $result ['label'] ), 'link' => array ('uri', 0, $result ['link'] ), 'type' => array ('numericUnsigned', 1, $result ['type_id'] ), 'parent' => array ('numericUnsigned', 1, $result ['parent_id'] ), 'subLevel' => array ('numericUnsigned', 1, $result ['sublevel'] ), 'published' => array ('text', 0, $result ['published'] ), 'approved' => array ('text', 0, $result ['approved'] ), 'order' => array ('numericUnsigned', 0, $result ['order'] ), 'afterId' => array ('numeric', 0 ), 'publishFrom' => array ('shortDateTime', 0, $resultInfo ['publish_from'] ), 'publishTo' => array ('shortDateTime', 0, $resultInfo ['publish_to'] ), 'comment' => array ('text', 0, $resultInfo ['comments'] ), 'option' => array ('text', 0, $resultInfo ['options'] ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
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
		
		$this->view->render ( 'menu/addMenu.phtml' );
		exit ();
	}
	
	public function deleteAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->menuId->value )) {
			foreach ( $this->view->sanitized->menuId->value as $id => $value ) {
				$where = $this->menuObj->getAdapter ()->quoteInto ( 'id = ?', $id );
				$menuPublish = $this->menuObj->delete ( $where );
				$where = $this->menuObj->getAdapter ()->quoteInto ( 'menu_id = ?', $id );
				$menuInfoDelete = $this->menuInfoObj->delete ( $where );
			}
			if (! empty ( $menuDelete )) {
				header ( 'Location: /admin/handle/pkg/menu/action/list/success/delete' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/menu/action/list/' );
		exit ();
	}
	
	public function publishAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->menuId->value )) {
			$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
			foreach ( $this->view->sanitized->menuId->value as $id => $value ) {
				$data = array ('published' => $this->view->sanitized->status->value );
				$where = $this->menuObj->getAdapter ()->quoteInto ( 'id = ?', $id );
				$menuPublish = $this->menuObj->update ( $data, $where );
			
		//$menuPublish = $this -> menuObj -> update(array('published' => $this -> view -> sanitized -> status -> value), array ('id'=>$id));
			}
			if (! empty ( $menuPublish )) {
				header ( 'Location: /admin/handle/pkg/menu/action/list/success/publish' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/menu/action/list/err' );
		exit ();
	}
	
	public function approveAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->menuId->value )) {
			$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
			foreach ( $this->view->sanitized->menuId->value as $id => $value ) {
				$data = array ('approved' => $this->view->sanitized->status->value );
				$where = $this->menuObj->getAdapter ()->quoteInto ( 'id = ?', $id );
				$menuPublish = $this->menuObj->update ( $data, $where );
			
		//$menuPublish = $this -> menuObj -> update(array('approved' => $this -> view -> sanitized -> status -> value), array('id' => $id));
			}
			if (! empty ( $menuAprrove )) {
				header ( 'Location: /admin/handle/pkg/menu/action/list/success/approve' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/menu/action/list/err' );
		exit ();
	}
	
	public function orderAction() {
	}
	
	public function listAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$this->view->sanitized->actionURI->value = '/admin/handle/pkg/menu/action/';
		
		if (! empty ( $_GET ['success'] )) {
			$this->view->successMessageStyle = 'display: block;';
			switch ($_GET ['success']) {
				case 'approve' :
					$this->view->successMessage = $this->view->__ ( 'Records successfully Approved' );
					break;
				case 'publish' :
					$this->view->successMessage = $this->view->__ ( 'Records successfully Published' );
					break;
				case 'delete' :
					$this->view->successMessage = $this->view->__ ( 'Records successfully Deleted' );
					break;
			}
		}
		
		//generate default sorting links
		$this->view->sort = ( object ) NULL;
		foreach ( $this->menuObj->cols as $col ) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this->view->sort->{$col} = ( object ) NULL;
			$this->view->sort->{$col}->cssClass = 'sort-title-desc';
			$this->view->sort->{$col}->href = $this->view->sanitized->actionURI->value . 'list/col/' . $col . '/sort/desc';
		}
		
		if (isset ( $_GET ['col'] ) and (in_array ( $_GET ['col'], $this->menuObj->cols ))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET ['col'];
			if (isset ( $_GET ['sort'] ) and (0 === strcasecmp ( $_GET ['sort'], 'DESC' ))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$menuListResult = $this->menuObj->getAllMenuAndMenu_infoAndMenu_typeOrderByColumn ( $column, $sort, $this->start, $this->limit );
			$sort = strtolower ( $sort );
			$column = strtolower ( $column );
			$this->view->sort->{$column}->cssClass = 'sort-arrow-' . $sort;
			$this->view->sort->{$column}->href = $this->view->sanitized->actionURI->value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$menuListResult = $this->menuObj->getAllMenuAndMenu_infoAndMenu_typeOrderByColumn ( 'id', 'ASC', $this->start, $this->limit );
		}
		
		$this->pagingObj->_init ( $this->menuObj->totalRecordsFound );
		$this->view->paging = $this->pagingObj->paging;
		$this->view->arrayToObject ( $this->view->paging );
		
		//listing
		if (empty ( $menuListResult ) and false == $menuListResult) {
			$this->view->notificationMessage = $this->view->__ ( 'Sorry, no records found' );
			$this->view->notificationMessageStyle = 'display: block;';
		}
		
		$this->view->menuList = $menuListResult;
		$this->view->render ( 'menu/listMenu.phtml' );
		exit ();
	}

}
