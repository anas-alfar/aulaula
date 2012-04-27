<?php

class Object_Controller_SourceAdmin extends Aula_Controller_Action {

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

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		// $this -> objectObj = new Object_Model_Default();
		// $this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> sourceObj = new Object_Model_Source();
		$this -> sourceInfoObj = new Object_Model_SourceInfo();

		//country object
		//$this -> countryObj = new Aula_Model_CountriesList();

		//category object
		//$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0) , 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'sourceId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameSource' => array('text', 1), 'descriptionSource' => array('text', 0), 'sourceType' => array('numericUnsigned', 1), 'countrySource' => array('numericUnsigned', 1), 'urlSource' => array('url', 1), 'timeDelay' => array('numericUnsigned', 0, $this -> sourceObj -> timeDelay), 'package' => array('numericUnsigned', 0, $this -> sourceObj -> packageId), 'published' => array('text', 0, $this -> sourceObj -> published), 'approved' => array('text', 0, $this -> sourceObj -> approved), 'order' => array('numeric', 0, $this -> sourceObj -> order), 'afterId' => array('numeric', 0), 'publishFrom' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishTo), 'comment' => array('text', 0, $this -> sourceInfoObj -> comments), 'option' => array('text', 0, $this -> sourceInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				//insertIntoObject_source ($Id , $Name , $Description , $Source_type , $Url , $Author_id , $Locale_id , $Country_id , $Package_id  = '0',
				//$Time_delay  = '0', $Published  = 'No', $Approved  = 'No', $Order  = '0')
				//insertIntoObject_source_info ($Id, $Comments , $Options, $Publish_from  = '0000-00-00 00:00:00', $Publish_to )
				$result = $this -> sourceObj -> insertIntoObject_source(Null, $this -> view -> sanitized -> nameSource -> value, $this -> view -> sanitized -> descriptionSource -> value, $this -> view -> sanitized -> sourceType -> value, $this -> view -> sanitized -> urlSource -> value, $this -> userId, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> countrySource -> value, $this -> view -> sanitized -> package -> value, $this -> view -> sanitized -> timeDelay -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];

				$result = $this -> sourceInfoObj -> insertIntoObject_source_info(Null, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> save) and (1 === $this -> view -> sanitized -> save)) {
						header('Location: /admin/handle/pkg/object-source/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-source/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on add record');
				}
			}
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}
		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
		}

		$this -> view -> render('object/addSourceObject.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$resultInfo = $this -> sourceInfoObj -> getAllObject_source_infoBySource_idOrderById($this -> view -> sanitized -> Id -> value);
				$resultInfo = $resultInfo[0];
				$resultInfoId = $resultInfo['id'];

				$result = $this -> sourceObj -> updateObject_sourceById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameSource -> value, $this -> view -> sanitized -> descriptionSource -> value, $this -> view -> sanitized -> sourceType -> value, $this -> view -> sanitized -> urlSource -> value, $this -> userId, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> countrySource -> value, $this -> view -> sanitized -> package -> value, $this -> view -> sanitized -> timeDelay -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				$result = $this -> sourceInfoObj -> updateObject_source_infoById($resultInfoId, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-source/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-source/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> sourceObj -> getObject_sourceDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$resultInfo = $this -> sourceInfoObj -> getAllObject_source_infoBySource_idOrderById(( int )$_GET['id']);
			$resultInfo = $resultInfo[0];
			$resultInfo['publish_from'] = substr($resultInfo['publish_from'], 0, 10);
			$resultInfo['publish_to'] = substr($resultInfo['publish_to'], 0, 10);

			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'sourceId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $result['author_id']), 'nameSource' => array('text', 1, $result['name']), 'descriptionSource' => array('text', 0, $result['description']), 'sourceType' => array('numericUnsigned', 1, $result['source_type']), 'countrySource' => array('numericUnsigned', 1, $result['country_id']), 'urlSource' => array('url', 1, $result['url']), 'timeDelay' => array('numericUnsigned', 0, $result['time_delay']), 'package' => array('numericUnsigned', 0, $result['package_id']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'order' => array('numeric', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'publishFrom' => array('shortDateTime', 0, $resultInfo['publish_from']), 'publishTo' => array('shortDateTime', 0, $resultInfo['publish_to']), 'comment' => array('text', 0, $resultInfo['comments']), 'option' => array('text', 0, $resultInfo['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
			$this -> view -> sanitized = array();
			$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
			$this -> view -> sanitized['Id']['value'] = ( int )$_GET['id'];
			$this -> view -> arrayToObject($this -> view -> sanitized);
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}

		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
		}

		$this -> view -> render('object/addSourceObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> sourceId -> value)) {
			foreach ($this->view->sanitized->sourceId->value as $id => $value) {
				$where = $this -> sourceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$sourceDelete = $this -> sourceObj -> delete($where);
			}
			if (!empty($sourceDelete)) {
				header('Location: /admin/handle/pkg/object-source/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-source/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> sourceId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->sourceId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> sourceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$sourcePublish = $this -> sourceObj -> update($data, $where);
			}
			if (!empty($sourcePublish)) {
				header('Location: /admin/handle/pkg/object-source/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-source/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> sourceId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->sourceId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> sourceObj -> getAdapter() -> quoteInto('id = ?', $id);
				$sourceAprrove = $this -> sourceObj -> update($data, $where);
			}
			if (!empty($sourceAprrove)) {
				header('Location: /admin/handle/pkg/object-source/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-source/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-source/action/';

		if (!empty($_GET['success'])) {
			$this -> view -> successMessageStyle = 'display: block;';
			switch ($_GET['success']) {
				case 'approve' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
					break;
				case 'publish' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
					break;
				case 'delete' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
					break;
				case 'showInObject' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
					break;
			}
		}
		
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}
		
		$this -> view -> sort = (object)NULL;
		foreach ($this->sourceObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> sourceObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$sourceListResult = $this -> sourceObj -> getAllObject_SourceOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$sourceListResult = $this -> sourceObj -> getAllObject_SourceOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}
		
		$this -> pagingObj -> _init($this -> sourceObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($sourceListResult) and false == $sourceListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $sourceListResult;
		$this -> view -> render('object/listSourceObject.phtml');
		exit();
	}

}
