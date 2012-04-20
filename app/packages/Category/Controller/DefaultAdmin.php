	<?php
	
	class Category_Controller_DefaultAdmin extends Aula_Controller_Action {
		
		private $categoryObj = Null;
		private $categoryInfoObj = Null;
		private $categoryTypeObj = Null;
		
		protected function _init() {
			$this->categoryObj = new Category_Model_Default ();
			$this->categoryInfoObj = new Category_Model_Info ();
			$this->categoryTypeObj = new Category_Model_Type ();
			$this->defualtAdminAction = 'list';
			$this->view->sanitized = $_POST;
			$this->view->_init ();
			$this->fields = array ('actionURI' => array ('uri', 0 ), 'redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'categoryId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'title' => array ('text', 1 ), 'label' => array ('text', 1 ), 'description' => array ('text', 1 ), 'type' => array ('numeric', 1 ), 'parent' => array ('numeric', 0, $this->categoryObj->parentId ), 'showInMenu' => array ('text', 0, $this->categoryObj->showInMenu ), 'published' => array ('text', 0, $this->categoryObj->published ), 'approved' => array ('text', 0, $this->categoryObj->approved ), 'order' => array ('numericUnsigned', 0, $this->categoryObj->order ), 'afterId' => array ('numeric', 0 ), 'comment' => array ('text', 0, $this->categoryInfoObj->comments ), 'option' => array ('text', 0, $this->categoryInfoObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'pageTitle' => array ('text', 0, $this->categoryInfoObj->pageTitle ), 'metaTitle' => array ('text', 0, $this->categoryInfoObj->metaTitle ), 'metaKey' => array ('text', 0, $this->categoryInfoObj->metaKey ), 'metaDesc' => array ('text', 0, $this->categoryInfoObj->metaDesc ), 'metaData' => array ('text', 0, $this->categoryInfoObj->metaData ), 'publishFrom' => array ('shortDateTime', 0, $this->categoryInfoObj->publishFrom ), 'publishTo' => array ('shortDateTime', 0, $this->categoryInfoObj->publishTo ), 'btn_submit' => array ('', 0, 2 ) );
			$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
			$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
			$this->view->sanitized ['locale'] ['value'] = 1;
			
			if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
				$result = $this->categoryObj->find ( ( int ) $_GET ['id'] )->current ();
				if (empty ( $this->view->sanitized ['type'] ['value'] )) {
					$this->view->sanitized ['type'] ['value'] = $result ['type_id'];
				}
				if (empty ( $this->view->sanitized ['parent'] ['value'] ) && ! $this->isPagePostBack) {
					$this->view->sanitized ['parent'] ['value'] = $result ['parent_id'];
				}
			}
		}
		
		public function addAction() {
			echo '<br />' . __FUNCTION__;
			echo '<br />' . __CLASS__;
			echo '<br />' . __METHOD__;
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
					$result = $this->categoryObj->insertIntoCategory ( Null, $this->view->sanitized->title->value, $this->view->sanitized->label->value, $this->view->sanitized->description->value, $this->view->sanitized->type->value, $this->userId, $this->view->sanitized->parent->value, 0, $this->view->sanitized->showInMenu->value, $this->view->sanitized->published->value, $this->view->sanitized->approved->value, $this->view->sanitized->order->value );
					$this->view->sanitized->Id->value = $result [0];
					$result = $this->categoryInfoObj->insertIntoCategory_info ( Null, $this->view->sanitized->Id->value, '0', '0', '0', $this->view->sanitized->pageTitle->value, $this->view->sanitized->metaTitle->value, $this->view->sanitized->metaKey->value, $this->view->sanitized->metaDesc->value, $this->view->sanitized->metaData->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->publishFrom->value, $this->view->sanitized->publishTo->value );
					if ($result !== false) {
						$this->view->sanitized->general->successMessage = $this->view->__ ( 'Record successfully added' );
						$this->view->sanitized->general->successMessageStyle = 'display: block;';
						if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
							header ( 'Location: /admin/handle/pkg/category/action/list/s/1' );
							exit ();
						}
						header ( 'Location: /admin/handle/pkg/category/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
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
			
			$this->view->render ( 'category/addCategory.phtml' );
			exit ();
		}
		
		public function editAction() {
			if ($this->isPagePostBack) {
				$this->filterObj->trimData ( $this->view->sanitized );
				$this->filterObj->sanitizeData ( $this->view->sanitized );
				$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
				$this->view->arrayToObject ( $this->view->sanitized );
				if (empty ( $this->errorMessage )) {
					if ($this->view->sanitized->order->value == - 1) {
						$this->view->sanitized->order->value = $this->view->sanitized->afterId->value;
					}
					$result = $this->categoryObj->updateCategoryById ( $this->view->sanitized->Id->value, $this->view->sanitized->title->value, $this->view->sanitized->label->value, $this->view->sanitized->description->value, $this->view->sanitized->type->value, $this->userId, $this->view->sanitized->parent->value, 0, $this->view->sanitized->showInMenu->value, $this->view->sanitized->published->value, $this->view->sanitized->approved->value, $this->view->sanitized->order->value );
					$result = $this->categoryInfoObj->GetAllCategory_infoByCategory_idOrderById ( $this->view->sanitized->Id->value );
					$result = $this->categoryInfoObj->updateCategory_infoById ( $result [0] ['id'], $this->view->sanitized->Id->value, '0', '0', '0', $this->view->sanitized->pageTitle->value, $this->view->sanitized->metaTitle->value, $this->view->sanitized->metaKey->value, $this->view->sanitized->metaDesc->value, $this->view->sanitized->metaData->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->publishFrom->value, $this->view->sanitized->publishTo->value );
					if ($result !== false) {
						$this->view->sanitized->general->successMessage = $this->view->__ ( 'Record successfully added' );
						$this->view->sanitized->general->successMessageStyle = 'display: block;';
						if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
							header ( 'Location: /admin/handle/pkg/category/action/list/s/1' );
							exit ();
						}
						header ( 'Location: /admin/handle/pkg/category/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
						exit ();
					} else {
						$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
					}
				}
			} elseif (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
				$result = $this->categoryObj->getCategoryDetailsById ( ( int ) $_GET ['id'] );
				$result = $result [0];
				$resultInfo = $this->categoryInfoObj->GetAllCategory_infoByCategory_idOrderById ( ( int ) $_GET ['id'] );
				$resultInfo = $resultInfo [0];
				
				$resultInfo ['publish_from'] = substr ( $resultInfo ['publish_from'], 0, 10 );
				$resultInfo ['publish_to'] = substr ( $resultInfo ['publish_to'], 0, 10 );
				
				$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'categoryId' => array ('numeric', 0, $resultInfo ['category_id'] ), 'Id' => array ('numeric', 0, $result ['id'] ), 'token' => array ('text', 1 ), 'title' => array ('text', 1, $result ['title'] ), 'label' => array ('text', 1, $result ['label'] ), 'description' => array ('text', 1, $result ['description'] ), 'type' => array ('numeric', 1, $result ['type_id'] ), 'parent' => array ('numeric', 1, $result ['parent_id'] ), 'showInMenu' => array ('text', 0, $result ['show_in_menu'] ), 'published' => array ('text', 0, $result ['published'] ), 'approved' => array ('text', 0, $result ['approved'] ), 'order' => array ('numericUnsigned', 0, $result ['order'] ), 'afterId' => array ('numeric', 0 ), 'comment' => array ('text', 0, $resultInfo ['comments'] ), 'option' => array ('text', 0, $resultInfo ['options'] ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'pageTitle' => array ('text', 0, $resultInfo ['page_title'] ), 'metaTitle' => array ('text', 0, $resultInfo ['meta_title'] ), 'metaKey' => array ('text', 0, $resultInfo ['meta_key'] ), 'metaDesc' => array ('text', 0, $resultInfo ['meta_desc'] ), 'metaData' => array ('text', 0, $resultInfo ['meta_data'] ), 'publishFrom' => array ('shortDateTime', 0, $resultInfo ['publish_from'] ), 'publishTo' => array ('shortDateTime', 0, $resultInfo ['publish_to'] ), 'btn_submit' => array ('', 0, 2 ) );
				$this->view->sanitized = array ();
				$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
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
			
			$this->view->render ( 'category/addCategory.phtml' );
			exit ();
		}
		
		public function deleteAction() {
			$this->view->arrayToObject ( $this->view->sanitized );
			if (! empty ( $this->view->sanitized->categoryId->value )) {
				foreach ( $this->view->sanitized->categoryId->value as $id => $value ) {
					$where = $this->categoryObj->getAdapter ()->quoteInto ( 'id = ?', $id );
					$categoryDelete = $this->categoryObj->delete ( $where );
				}
				if (! empty ( $categoryDelete )) {
					header ( 'Location: /admin/handle/pkg/category/action/list/success/delete' );
					exit ();
				}
			}
			
			header ( 'Location: /admin/handle/pkg/category/action/list/' );
			exit ();
		}
		
		public function approveAction() {
			$this->view->arrayToObject ( $this->view->sanitized );
			if (! empty ( $this->view->sanitized->categoryId->value )) {
				$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
				foreach ( $this->view->sanitized->categoryId->value as $id => $value ) {
					//$categoryAprrove = $this -> categoryObj -> updateCategoryApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
					$data = array ('approved' => $this->view->sanitized->status->value );
					$where = $this->categoryObj->getAdapter ()->quoteInto ( 'id = ?', $id );
					$categoryAprrove = $this->categoryObj->update ( $data, $where );
				}
				if (! empty ( $categoryAprrove )) {
					header ( 'Location: /admin/handle/pkg/category/action/list/success/approve' );
					exit ();
				}
			}
			header ( 'Location: /admin/handle/pkg/category/action/list/' );
			exit ();
		}
		
		public function showInMenuAction() {
			$this->view->arrayToObject ( $this->view->sanitized );
			if (! empty ( $this->view->sanitized->categoryId->value )) {
				$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
				foreach ( $this->view->sanitized->categoryId->value as $id => $value ) {
					//$categoryShowInMenu = $this -> categoryObj -> updateCategoryShow_in_menuColumnById($id, $this -> view -> sanitized -> status -> value);\
					$data = array ('show_in_menu' => $this->view->sanitized->status->value );
					$where = $this->categoryObj->getAdapter ()->quoteInto ( 'id = ?', $id );
					$categoryShowInMenu = $this->categoryObj->update ( $data, $where );
				}
				if (! empty ( $categoryShowInMenu )) {
					header ( 'Location: /admin/handle/pkg/category/action/list/success/showInMenu' );
					exit ();
				}
			}
			header ( 'Location: /admin/handle/pkg/category/action/list/' );
			exit ();
		}
		
		public function publishAction() {
			$this->view->arrayToObject ( $this->view->sanitized );
			if (! empty ( $this->view->sanitized->categoryId->value )) {
				$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
				foreach ( $this->view->sanitized->categoryId->value as $id => $value ) {
					//$categoryPublish = $this -> categoryObj -> updateCategoryPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
					$data = array ('published' => $this->view->sanitized->status->value );
					$where = $this->categoryObj->getAdapter ()->quoteInto ( 'id = ?', $id );
					$categoryPublish = $this->categoryObj->update ( $data, $where );
				}
				if (! empty ( $categoryPublish )) {
					header ( 'Location: /admin/handle/pkg/category/action/list/success/publish' );
					exit ();
				}
			}
			
			header ( 'Location: /admin/handle/pkg/category/action/list/' );
			exit ();
		}
		
		public function orderAction() {
		}
		
		public function listAction() {
			$this->view->arrayToObject ( $this->view->sanitized );
			$this->view->sanitized->actionURI->value = '/admin/handle/pkg/category/action/';
			
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
					case 'showInMenu' :
						$this->view->successMessage = $this->view->__ ( 'Records successfully Updated' );
						break;
				}
			}
			
			//generate default sorting links
			$this->view->sort = ( object ) NULL;
			$cols = array_merge ( $this->categoryInfoObj->cols, $this->categoryObj->cols );
			
			foreach ( $cols as $col ) {
				/**
				 * adding the following two lines to prvent E_STRICT error
				 */
				$this->view->sort->{$col} = ( object ) NULL;
				$this->view->sort->{$col}->cssClass = 'sort-title-desc';
				$this->view->sort->{$col}->href = $this->view->sanitized->actionURI->value . 'list/col/' . $col . '/sort/desc';
			}
			
			if (isset ( $_GET ['col'] ) and (in_array ( $_GET ['col'], $cols ))) {
				$sort = 'ASC';
				$sortInvert = 'desc';
				$column = $_GET ['col'];
				if (isset ( $_GET ['sort'] ) and (0 === strcasecmp ( $_GET ['sort'], 'DESC' ))) {
					$sort = 'DESC';
					$sortInvert = 'asc';
				}
				$categoryListResult = $this->categoryObj->getCategoryAndCategory_infoOrderByColumnWithLimit ( $column, $sort, $this->start, $this->limit );
				$sort = strtolower ( $sort );
				$column = strtolower ( $column );
				$this->view->sort->{$column}->cssClass = 'sort-arrow-' . $sort;
				$this->view->sort->{$column}->href = $this->view->sanitized->actionURI->value . 'list/col/' . $column . '/sort/' . ($sortInvert);
			} else {
				$categoryListResult = $this->categoryObj->getCategoryAndCategory_infoOrderByColumnWithLimit ( 'id', 'DESC', $this->start, $this->limit );
			}
			
			$this->pagingObj->_init ( $this->categoryObj->totalRecordsFound );
			$this->view->paging = $this->pagingObj->paging;
			$this->view->arrayToObject ( $this->view->paging );
			
			if (empty ( $categoryListResult ) and false != $categoryListResult) {
				$this->view->notificationMessage = $this->view->__ ( 'Sorry, no records found' );
				$this->view->notificationMessageStyle = 'display: block;';
			}
			$this->view->categoryList = $categoryListResult;
			
			$this->view->render ( 'category/listCategory.phtml' );
			exit ();
		}
	
	}
