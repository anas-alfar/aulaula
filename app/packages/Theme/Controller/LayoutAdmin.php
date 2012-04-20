<?php

class Theme_Controller_LayoutAdmin extends Aula_Controller_Action {
	
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
		
		$this->defualtAdminAction = 'list';
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
	
	public function addAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				if ($this->view->sanitized->order->value == - 1) {
					$this->view->sanitized->order->value = $this->view->sanitized->afterId->value;
				}
				
				$result = $this->layoutObj->insertIntoTheme_layout ( Null, $this->view->sanitized->title->value, $this->view->sanitized->label->value, $this->view->sanitized->description->value, '0', $this->view->sanitized->direction->value, $this->view->sanitized->published->value, $this->view->sanitized->approved->value, $this->view->sanitized->default->value, $this->view->sanitized->order->value );
				$this->view->sanitized->Id->value = $result [0];
				$result = $this->layoutInfoObj->insertIntoTheme_layout_info ( Null, $this->view->sanitized->Id->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->publishFrom->value, $this->view->sanitized->publishTo->value );
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/theme-layout/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/theme-layout/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
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
		
		$this->view->render ( 'theme/addLayout.phtml' );
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
				$resultInfo = $this->layoutInfoObj->GetAllTheme_layout_infoByLayout_idOrderById ( $this->view->sanitized->Id->value );
				$resultInfoId = $resultInfo [0] ['id'];
				$result = $this->layoutObj->updateTheme_layoutById ( $this->view->sanitized->Id->value, $this->view->sanitized->title->value, $this->view->sanitized->label->value, $this->view->sanitized->description->value, '0', $this->view->sanitized->direction->value, $this->view->sanitized->published->value, $this->view->sanitized->approved->value, $this->view->sanitized->default->value, $this->view->sanitized->order->value );
				$result = $this->layoutInfoObj->updateTheme_layout_infoById ( $resultInfoId, $this->view->sanitized->Id->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->publishFrom->value, $this->view->sanitized->publishTo->value );
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/theme-layout/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/theme-layout/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Invalid Login Credential' );
				}
			}
		} elseif (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->layoutObj->getTheme_layoutDetailsById ( ( int ) $_GET ['id'] );
			$result = $result [0];
			$resultInfo = $this->layoutInfoObj->GetAllTheme_layout_infoByLayout_idOrderById ( ( int ) $_GET ['id'] );
			$resultInfo = $resultInfo [0];
			$resultInfo ['publish_from'] = substr ( $resultInfo ['publish_from'], 0, 10 );
			$resultInfo ['publish_to'] = substr ( $resultInfo ['publish_to'], 0, 10 );
			$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'layoutId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0, $result ['id'] ), 'token' => array ('text', 1 ), 'title' => array ('text', 1, $result ['title'] ), 'label' => array ('text', 1, $result ['label'] ), 'description' => array ('text', 0, $result ['description'] ), 'published' => array ('text', 0, $result ['published'] ), 'approved' => array ('text', 0, $result ['approved'] ), 'default' => array ('text', 0, $result ['default'] ), 'order' => array ('numericUnsigned', 0, $result ['order'] ), 'afterId' => array ('numeric', 0, $result ['default'] ), 'publishFrom' => array ('shortDateTime', 0, $resultInfo ['publish_from'] ), 'publishTo' => array ('shortDateTime', 0, $resultInfo ['publish_to'] ), 'comment' => array ('text', 0, $resultInfo ['comments'] ), 'option' => array ('text', 0, $resultInfo ['options'] ), 'direction' => array ('text', 0, $result ['direction'] ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
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
		
		$this->view->render ( 'theme/addLayout.phtml' );
		exit ();
	
	}
	
	public function deleteAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->layoutId->value )) {
			foreach ( $this->view->sanitized->layoutId->value as $id => $value ) {
				$layoutDelete = $this->layoutObj->deleteFromTheme_layoutById ( $id );
			}
			if (! empty ( $layoutDelete )) {
				header ( 'Location: /admin/handle/pkg/theme-layout/action/list/success/delete' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/theme-layout/action/list/' );
		exit ();
	}
	
	public function publishAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->layoutId->value )) {
			$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
			foreach ( $this->view->sanitized->layoutId->value as $id => $value ) {
				$layoutPublish = $this->layoutObj->updateTheme_layoutPublishedColumnById ( $id, $this->view->sanitized->status->value );
			}
			if (! empty ( $layoutPublish )) {
				header ( 'Location: /admin/handle/pkg/theme-layout/action/list/success/publish' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/theme-layout/action/list/' );
		exit ();
	}
	
	public function approveAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->layoutId->value )) {
			$this->view->sanitized->status->value = $this->view->sanitized->status->value == 'Yes' ? 'Yes' : 'No';
			foreach ( $this->view->sanitized->layoutId->value as $id => $value ) {
				$layoutApprove = $this->layoutObj->updateTheme_layoutApprovedColumnById ( $id, $this->view->sanitized->status->value );
			}
			if (! empty ( $layoutApprove )) {
				header ( 'Location: /admin/handle/pkg/theme-layout/action/list/success/approve' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/theme-layout/action/list/' );
		exit ();
	}
	
	public function listAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$this->view->sanitized->actionURI->value = '/admin/handle/pkg/theme-layout/action/';
		if (isset ( $_SERVER ['REQUEST_URI'] ) and ! empty ( $_SERVER ['REQUEST_URI'] )) {
			$this->view->sanitized->redirectURI->value = $_SERVER ['REQUEST_URI'];
		}
		
		if ($_GET ['success'] == 'approve') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Approved' );
			$this->view->successMessageStyle = 'display: block;';
		} elseif ($_GET ['success'] == 'publish') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Published' );
			$this->view->successMessageStyle = 'display: block;';
		} elseif ($_GET ['success'] == 'delete') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Deleted' );
			$this->view->successMessageStyle = 'display: block;';
		}
		
		//sorting
		$this->view->sort->title->cssClass = 'sort-title';
		$this->view->sort->title->href = $this->view->sanitized->actionURI->value . 'list/title/asc';
		$this->view->sort->label->cssClass = 'sort-title';
		$this->view->sort->label->href = $this->view->sanitized->actionURI->value . 'list/label/asc';
		$this->view->sort->published->cssClass = 'sort-title';
		$this->view->sort->published->href = $this->view->sanitized->actionURI->value . 'list/published/asc';
		$this->view->sort->approved->cssClass = 'sort-title';
		$this->view->sort->approved->href = $this->view->sanitized->actionURI->value . 'list/approved/asc';
		$this->view->sort->dateAdded->cssClass = 'sort-title';
		$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/asc';
		/*
		 * @todo check that getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit exists?!
		 */
		if (isset ( $_GET ['title'] ) && $_GET ['title'] == 'asc') {
			$this->view->sort->title->cssClass = 'sort-arrow-asc';
			$this->view->sort->title->href = $this->view->sanitized->actionURI->value . 'list/title/desc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'title', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['title'] ) && $_GET ['title'] == 'desc') {
			$this->view->sort->title->cssClass = 'sort-arrow-desc';
			$this->view->sort->title->href = $this->view->sanitized->actionURI->value . 'list/title/asc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'title', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['label'] ) && $_GET ['label'] == 'asc') {
			$this->view->sort->label->cssClass = 'sort-arrow-asc';
			$this->view->sort->label->href = $this->view->sanitized->actionURI->value . 'list/label/desc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'label', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['label'] ) && $_GET ['label'] == 'desc') {
			$this->view->sort->label->cssClass = 'sort-arrow-desc';
			$this->view->sort->label->href = $this->view->sanitized->actionURI->value . 'list/label/asc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'label', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['published'] ) && $_GET ['published'] == 'asc') {
			$this->view->sort->published->cssClass = 'sort-arrow-asc';
			$this->view->sort->published->href = $this->view->sanitized->actionURI->value . 'list/published/desc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'published', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['published'] ) && $_GET ['published'] == 'desc') {
			$this->view->sort->published->cssClass = 'sort-arrow-desc';
			$this->view->sort->published->href = $this->view->sanitized->actionURI->value . 'list/published/asc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'published', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['approved'] ) && $_GET ['approved'] == 'asc') {
			$this->view->sort->approved->cssClass = 'sort-arrow-asc';
			$this->view->sort->approved->href = $this->view->sanitized->actionURI->value . 'list/approved/desc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'approved', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['approved'] ) && $_GET ['approved'] == 'desc') {
			$this->view->sort->approved->cssClass = 'sort-arrow-desc';
			$this->view->sort->approved->href = $this->view->sanitized->actionURI->value . 'list/approved/asc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'approved', 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['dateAdded'] ) && $_GET ['dateAdded'] == 'asc') {
			$this->view->sort->dateAdded->cssClass = 'sort-arrow-asc';
			$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/desc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'date_added', 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['dateAdded'] ) && $_GET ['dateAdded'] == 'desc') {
			$this->view->sort->dateAdded->cssClass = 'sort-arrow-desc';
			$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/asc';
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'date_added', 'DESC', $this->start, $this->limit );
		} else {
			$layoutListResult = $this->layoutObj->getTheme_layoutAndTheme_layout_infoOrderByColumnWithLimit ( 'id', 'DESC', $this->start, $this->limit );
		}
		$this->pagingObj->_init ( $this->layoutObj->totalRecordsFound );
		$this->view->paging = $this->pagingObj->paging;
		$this->view->arrayToObject ( $this->view->paging );
		
		//listing
		$layoutList = '';
		if (! empty ( $layoutListResult ) and false != $layoutListResult) {
			foreach ( $layoutListResult as $key => $value ) {
				$layoutList .= '<tr>';
				$layoutList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="layoutId[' . $value ['id'] . ']" id="check" value="Yes" /></td>';
				$layoutList .= '<td class="jstalgntop">' . $value ['title'] . '</td>';
				$layoutList .= '<td class="jstalgntop">' . $value ['label'] . '</td>';
				$layoutList .= '<td class="jstalgntop">' . $this->view->__ ( $value ['published'] ) . '</td>';
				$layoutList .= '<td class="jstalgntop">' . $this->view->__ ( $value ['approved'] ) . '</td>';
				$layoutList .= '<td class="jstalgntop">' . $value ['date_added'] . '</td>';
				$layoutList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/theme-layout/action/edit/s/1/id/' . $value ['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$layoutList .= '</tr>';
			}
		} else {
			$this->view->notificationMessage = $this->view->__ ( 'Sorry, no records found' );
			$this->view->notificationMessageStyle = 'display: block;';
		}
		
		$this->view->layoutList = $layoutList;
		
		$this->view->render ( 'theme/listLayout.phtml' );
		exit ();
	}

}
