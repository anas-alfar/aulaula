<?php

class Object_Controller_StaticAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $cfommentObj = NULL;
	private $directoryObj = NULL;
	private $fileObj = NULL;
	private $photoObj = NULL;
	private $ratingObj = NULL;
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
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> staticObj = new Object_Model_Static();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();
		$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0),'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'staticId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleStatic' => array('text', 1), 'aliasStatic' => array('text', 1), 'introTextStatic' => array('', 0), 'fullTextStatic' => array('', 1), 'urlStatic' => array('url', 1, $this -> staticObj -> url), 'sourceStatic' => array('numericUnsigned', 0, $this -> objectObj -> source), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> staticObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> staticObj -> published), 'approved' => array('text', 0, $this -> staticObj -> approved), 'comment' => array('text', 0, $this -> staticObj -> comments), 'option' => array('text', 0, $this -> staticObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> staticObj -> getObject_staticDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
		}
	}

	public function addAction() {
		/**
		 * @todo date_added enters 000000 in the database
		 */
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> titleStatic -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceStatic -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
				$result = $this -> staticObj -> insertIntoObject_static(Null, $this -> view -> sanitized -> aliasStatic -> value, $this -> view -> sanitized -> urlStatic -> value, $this -> view -> sanitized -> introTextStatic -> value, $this -> view -> sanitized -> fullTextStatic -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-static/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-static/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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
		$this -> view -> render('object/addStaticObject.phtml');
		exit();
	}

	public function editAction() {
		/**
		 * @todo date_added enters 000000 in the database
		 */
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> staticObj -> getObject_staticDetailsById(( int )$_GET['id']);
				$result = $result[0];
				$objectDetails = $this -> objectObj -> getObjectDetailsById($result['object_id']);
				$objectId = $objectDetails[0]['id'];
				$objectInfoDetails = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($objectId);
				$objectInfoId = $objectInfoDetails[0]['id'];
				$resultObject = $this -> objectObj -> updateObjectById($objectId, $this -> view -> sanitized -> titleStatic -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceStatic -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$result = $this -> objectInfoObj -> updateObject_infoById($objectInfoId, $objectId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
				$result = $this -> staticObj -> updateObject_staticById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> aliasStatic -> value, $this -> view -> sanitized -> urlStatic -> value, $this -> view -> sanitized -> introTextStatic -> value, $this -> view -> sanitized -> fullTextStatic -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $objectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-static/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-static/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> staticObj -> getObject_staticDetailsById(( int )$_GET['id']);

			//print_r($result);exit;
			$result = $result[0];
			$resultObject = $this -> objectObj -> getObjectDetailsById($result['object_id']);
			$resultObject = $resultObject[0];
			$resultObjectInfo = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($resultObject['id']);
			$resultObjectInfo = $resultObjectInfo[0];

			$result['taken_date'] = substr($result['taken_date'], 0, 10);
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$result['created_date'] = substr($result['created_date'], 0, 10);
			$resultObjectInfo['theme_publish_from'] = substr($resultObjectInfo['theme_publish_from'], 0, 10);
			$resultObjectInfo['theme_publish_to'] = substr($resultObjectInfo['theme_publish_to'], 0, 10);

			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'staticId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $resultObject['author_id']), 'titleStatic' => array('text', 1, $resultObject['title']), 'aliasStatic' => array('text', 1, $result['alias']), 'introTextStatic' => array('', 0, $result['intro_text']), 'fullTextStatic' => array('', 1, $result['full_text']), 'urlStatic' => array('url', 1, $result['url']), 'sourceStatic' => array('numericUnsigned', 0, $result['source_id']), 'category' => array('numericUnsigned', 1, $result['category_id']), 'tag' => array('text', 0, $resultObject['tags']), 'originalAuthor' => array('text', 0, $resultObject['original_author']), 'createdDate' => array('shortDateTime', 0, $result['created_date']), 'themePublishFrom' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_from']), 'themePublishTo' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_to']), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'parent' => array('numericUnsigned', 0, $resultObject['parent_id']), 'objectType' => array('numericUnsigned', 0, $resultObject['type_id']), 'showInList' => array('text', 0, $resultObject['show_in_list']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'pageTitle' => array('text', 0, $resultObject['page_title']), 'metaTitle' => array('text', 0, $resultObject['meta_title']), 'metaKey' => array('text', 0, $resultObject['meta_key']), 'metaDesc' => array('text', 0, $resultObject['meta_desc']), 'metaData' => array('text', 0, $resultObject['meta_data']), 'layout' => array('numericUnsigned', 0, $resultObjectInfo['layout_id']), 'template' => array('numericUnsigned', 0, $resultObjectInfo['template_id']), 'skin' => array('numericUnsigned', 0, $resultObjectInfo['skin_id']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('object/addStaticObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> staticId -> value)) {
			foreach ($this->view->sanitized->staticId->value as $id => $value) {
				$where = $this -> staticObj -> getAdapter() -> quoteInto('id = ?', $id);
				$staticDelete = $this -> staticObj -> delete($where);
			}
			if (!empty($staticDelete)) {
				header('Location: /admin/handle/pkg/object-static/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-static/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> staticId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->staticId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> staticObj -> getAdapter() -> quoteInto('id = ?', $id);
				$staticPublish = $this -> staticObj -> update($data, $where);
			}
			if (!empty($staticPublish)) {
				header('Location: /admin/handle/pkg/object-static/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-static/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> staticId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->staticId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> staticObj -> getAdapter() -> quoteInto('id = ?', $id);
				$staticAprrove = $this -> staticObj -> update($data, $where);
			}
			if (!empty($staticAprrove)) {
				header('Location: /admin/handle/pkg/object-static/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-static/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-static/action/';

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
			}
		}
		
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this->staticObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> staticObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$staticListResult = $this -> staticObj -> getAllStatic_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$staticListResult = $this -> staticObj -> getAllStatic_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}
		
		$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$categoryListResult = $this -> categoryObj -> read();
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}

		if (empty($staticListResult) and false == $staticListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> category = $category;
		$this -> view -> objectList = $staticListResult;
		$this -> view -> render('object/listStaticObject.phtml');
		exit();
	}

}
