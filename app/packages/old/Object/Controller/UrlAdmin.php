<?php

class Object_Controller_UrlAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $urlObj = NULL;
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
	private $articleObj = NULL;
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
		$this -> urlObj = new Object_Model_Url();
		$this -> sourceObj = new Object_Model_Source();

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
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'urlId' => array('numeric', 0), 'category' => array('numericUnsigned', 1), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 0), 'published' => array('text', 0, $this -> urlObj -> published), 'approved' => array('text', 0, $this -> urlObj -> approved), 'showInObject' => array('text', 0, $this -> urlObj -> showInObject), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'title' => array('text', 0), 'label' => array('text', 0), 'titleArticle' => array('text', 0), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('text', 0), 'fullTextArticle' => array('text', 0), 'sourceArticle' => array('numeric', 0), 'createdDateArticle' => array('shortDateTime', 0), 'publishFromArticle' => array('shortDateTime', 0), 'publishToArticle' => array('shortDateTime', 0), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('shortDateTime', 0), 'publishToPhoto' => array('shortDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('shortDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('shortDateTime', 0), 'publishToVideo' => array('shortDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('text', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('shortDateTime', 0), 'publishFromStatic' => array('shortDateTime', 0), 'publishToStatic' => array('shortDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parent' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('shortDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> urlObj -> getObject_urlDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
			if (empty($this -> view -> sanitized['source']['value'])) {
				$this -> view -> sanitized['source']['value'] = $result['source_id'];
			}
			if (empty($this -> view -> sanitized['urlTypeUrl']['value'])) {
				$this -> view -> sanitized['urlTypeUrl']['value'] = $result['url_type'];
			}

			//locale list
			$this -> localeList = '';
			$this -> localeListResult = $this -> localeObj -> getAllLocaleOrderById();
			if (!empty($this -> localeListResult)) {
				foreach ($this->localeListResult as $key => $value) {
					$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
					$this -> localeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
				}
			}
			$this -> view -> localeList = $this -> localeList;

			//template list
			$this -> templateList = '';
			$this -> templateListResult = $this -> templateObj -> getAllTheme_templateOrderById();
			if (!empty($this -> templateListResult)) {
				foreach ($this->templateListResult as $key => $value) {
					$selectedItem = ($value['id'] == $this -> view -> sanitized['template']['value']) ? 'selected="selected"' : '';
					$this -> templateList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
				}
			}
			$this -> view -> templateList = $this -> templateList;

			//layout list
			$this -> layoutList = '';
			$this -> layoutListResult = $this -> layoutObj -> getAllTheme_layoutOrderById();
			if (!empty($this -> layoutListResult)) {
				foreach ($this->layoutListResult as $key => $value) {
					$selectedItem = ($value['id'] == $this -> view -> sanitized['layout']['value']) ? 'selected="selected"' : '';
					$this -> layoutList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
				}
			}
			$this -> view -> layoutList = $this -> layoutList;

			//skin list
			$this -> skinList = '';
			$this -> skinListResult = $this -> skinObj -> getAllTheme_skinOrderById();
			if (!empty($this -> skinListResult)) {
				foreach ($this->skinListResult as $key => $value) {
					$selectedItem = ($value['id'] == $this -> view -> sanitized['skin']['value']) ? 'selected="selected"' : '';
					$this -> skinList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
				}
			}
			$this -> view -> skinList = $this -> skinList;
		}
		//source list
		$this -> view -> sanitized['source']['value'] = isset($this -> view -> sanitized['source']['value']) ? $this -> view -> sanitized['source']['value'] : '';
		$this -> sourceUrlList = '';
		$this -> sourceUrlListResult = $this -> sourceObj -> getAllObject_sourceOrderById();
		if (!empty($this -> sourceUrlListResult)) {
			foreach ($this->sourceUrlListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['source']['value']) ? 'selected="selected"' : '';
				$this -> sourceUrlList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['name'] . '</option>';
			}
		}
		$this -> view -> sourceUrlList = $this -> sourceUrlList;

		//url type list
		$this -> view -> sanitized['url_type']['value'] = isset($this -> view -> sanitized['url_type']['value']) ? $this -> view -> sanitized['url_type']['value'] : '';
		$this -> urlTypeUrlList = '';
		$this -> urlTypeUrlList .= '<option value="Link"' . ('Link' == $this -> view -> sanitized['url_type']['value'] ? 'selected="selected"' : '') . '>Link</option>';
		$this -> urlTypeUrlList .= '<option value="Iframe"' . ('Iframe' == $this -> view -> sanitized['url_type']['value'] ? 'selected="selected"' : '') . '>Iframe</option>';
		$this -> urlTypeUrlList .= '<option value="YouTube"' . ('YouTube' == $this -> view -> sanitized['url_type']['value'] ? 'selected="selected"' : '') . '>YouTube</option>';
		$this -> view -> urlTypeUrlList = $this -> urlTypeUrlList;

		//category list
		$this -> view -> sanitized['category']['value'] = isset($this -> view -> sanitized['category']['value']) ? $this -> view -> sanitized['category']['value'] : '';
		$this -> categoryList = '';
		$this -> categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		if (!empty($this -> categoryListResult)) {
			foreach ($this->categoryListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['category']['value']) ? 'selected="selected"' : '';
				$this -> categoryList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> categoryList = $this -> categoryList;
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
				$result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> titleUrl -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceUrl -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
				$result = $this -> urlObj -> insertIntoObject_url(Null, $this -> view -> sanitized -> aliasUrl -> value, $this -> view -> sanitized -> introTextUrl -> value, $this -> view -> sanitized -> urlUrl -> value, $this -> view -> sanitized -> styleUrl -> value, $this -> userId, $this -> view -> sanitized -> sourceUrl -> value, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> urlTypeUrl -> value, $this -> view -> sanitized -> order -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-url/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-url/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on url record');
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

		$this -> view -> render('object/addUrlObject.phtml');
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
				$result = $this -> urlObj -> getObject_urlDetailsById(( int )$_GET['id']);
				$result = $result[0];
				$objectDetails = $this -> objectObj -> getObjectDetailsById($result['object_id']);
				$objectId = $objectDetails[0]['id'];
				$objectInfoDetails = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($objectId);
				$objectInfoId = $objectInfoDetails[0]['id'];
				$resultObject = $this -> objectObj -> updateObjectById($objectId, $this -> view -> sanitized -> titleUrl -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceUrl -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$result = $this -> objectInfoObj -> updateObject_infoById($objectInfoId, $objectId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
				$result = $this -> urlObj -> updateObject_urlById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> aliasUrl -> value, $this -> view -> sanitized -> introTextUrl -> value, $this -> view -> sanitized -> urlUrl -> value, $this -> view -> sanitized -> styleUrl -> value, $this -> userId, $this -> view -> sanitized -> sourceUrl -> value, $objectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> urlTypeUrl -> value, $this -> view -> sanitized -> order -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-url/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-url/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> urlObj -> getObject_urlDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$resultObject = $this -> objectObj -> getObjectDetailsById($result['object_id']);
			$resultObject = $resultObject[0];
			$resultObjectInfo = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($resultObject['id']);
			$resultObjectInfo = $resultObjectInfo[0];

			$result['taken_date'] = substr($result['taken_date'], 0, 10);
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$resultObject['created_date'] = substr($resultObject['created_date'], 0, 10);
			$resultObjectInfo['theme_publish_from'] = substr($resultObjectInfo['theme_publish_from'], 0, 10);
			$resultObjectInfo['theme_publish_to'] = substr($resultObjectInfo['theme_publish_to'], 0, 10);

			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'urlId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'showInObject' => array('text', 0, $result['show_in_object']), 'showInList' => array('text', 0, $resultObject['show_in_list']), 'titleUrl' => array('text', 0, $resultObject['title']), 'aliasUrl' => array('text', 0, $result['alias']), 'introTextUrl' => array('text', 0, $result['intro_text']), 'sourceUrl' => array('numeric', 0, $result['source_id']), 'urlUrl' => array('url', 0, $result['url']), 'styleUrl' => array('text', 0, $result['style']), 'urlTypeUrl' => array('text', 0, $result['url_type']), 'category' => array('numericUnsigned', 1, $result['category_id']), 'tag' => array('text', 0, $resultObject['tags']), 'originalAuthor' => array('text', 0, $resultObject['original_author']), 'createdDate' => array('shortDateTime', 0, $resultObject['created_date']), 'themePublishFrom' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_from']), 'themePublishTo' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_to']), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'parent' => array('numericUnsigned', 0, $resultObject['parent_id']), 'objectType' => array('numericUnsigned', 0, $resultObject['type_id']), 'showInList' => array('text', 0, $resultObject['show_in_list']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'pageTitle' => array('text', 0, $resultObject['page_title']), 'metaTitle' => array('text', 0, $resultObject['meta_title']), 'metaKey' => array('text', 0, $resultObject['meta_key']), 'metaDesc' => array('text', 0, $resultObject['meta_desc']), 'metaData' => array('text', 0, $resultObject['meta_data']), 'layout' => array('numericUnsigned', 0, $resultObjectInfo['layout_id']), 'template' => array('numericUnsigned', 0, $resultObjectInfo['template_id']), 'skin' => array('numericUnsigned', 0, $resultObjectInfo['skin_id']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('object/addUrlObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> urlId -> value)) {
			foreach ($this->view->sanitized->urlId->value as $id => $value) {
				$urlDelete = $this -> urlObj -> deleteFromObject_urlById($id);
			}
			if (!empty($urlDelete)) {
				header('Location: /admin/handle/pkg/object-url/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-url/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> urlId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->urlId->value as $id => $value) {
				$urlPublish = $this -> urlObj -> updateObject_urlPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($urlPublish)) {
				header('Location: /admin/handle/pkg/object-url/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-url/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> urlId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->urlId->value as $id => $value) {
				$urlAprrove = $this -> urlObj -> updateObject_urlApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($urlAprrove)) {
				header('Location: /admin/handle/pkg/object-url/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-url/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-url/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'approve') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'publish') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sorting
		//		$this->view->sort->category->cssClass = 'sort-title';
		//		$this->view->sort->category->href = $this->view->sanitized->actionURI->value . 'list/category/asc';
		$this -> view -> sort -> alias -> cssClass = 'sort-title';
		$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
		$this -> view -> sort -> showInObject -> cssClass = 'sort-title';
		$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		//		if (isset ( $_GET ['category'] ) && $_GET ['category'] == 'asc') {
		//			$this->view->sort->category->cssClass = 'sort-arrow-asc';
		//			$this->view->sort->category->href = $this->view->sanitized->actionURI->value . 'list/category/desc';
		//			$urlListResult = $this->urlObj->getAllObject_urlOrderByCategory_idWithLimit ( 'ASC', $this->start, $this->limit );
		//		} elseif (isset ( $_GET ['category'] ) && $_GET ['category'] == 'desc') {
		//			$this->view->sort->category->cssClass = 'sort-arrow-desc';
		//			$this->view->sort->category->href = $this->view->sanitized->actionURI->value . 'list/category/asc';
		//			$urlListResult = $this->urlObj->getAllObject_urlOrderByCategory_idWithLimit ( 'DESC', $this->start, $this->limit );
		//		} else
		if (isset($_GET['alias']) && $_GET['alias'] == 'asc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/desc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByAliasWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'desc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByAliasWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'asc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/desc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByShow_in_objectWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'desc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByShow_in_objectWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$urlListResult = $this -> urlObj -> getAllObject_urlOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> urlObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		$categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		$objectList = '';
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}

		if (!empty($urlListResult) and false != $urlListResult) {
			foreach ($urlListResult as $key => $value) {
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="urlId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				//			$objectList .= '<td class="jstalgntop">' . $category [$value ['category_id']] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['alias'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_object']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-url/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listUrlObject.phtml');
		exit();
	}

}
