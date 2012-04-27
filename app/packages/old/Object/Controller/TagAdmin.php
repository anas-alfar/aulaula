<?php

class Object_Controller_TagAdmin extends Aula_Controller_Action {

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
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> tagObj = new Object_Model_Tag();

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
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'tagId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'titleArticle' => array('text', 0), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('text', 0), 'fullTextArticle' => array('text', 0), 'sourceArticle' => array('numeric', 0), 'createdDateArticle' => array('longDateTime', 0), 'publishFromArticle' => array('longDateTime', 0), 'publishToArticle' => array('longDateTime', 0), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('longDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('longDateTime', 0), 'publishToPhoto' => array('longDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('longDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('longDateTime', 0), 'publishToVideo' => array('longDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('numeric', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('longDateTime', 0), 'publishFromStatic' => array('longDateTime', 0), 'publishToStatic' => array('longDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parentDirectory' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'showInList' => array('text', 0), 'published' => array('text', 0), 'approved' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('longDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('longDateTime', 0), 'publishFrom' => array('longDateTime', 0), 'publishTo' => array('longDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => '', 'search' => '', 'dateAddedFrom' => array('longDateTime', 0), 'dateAddedTo' => array('longDateTime', 0), 'notification' => '', 'success' => '', 'error' => '', 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = array();
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//category list
		$this -> categoryList = '';
		$this -> categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		if (!empty($this -> categoryListResult)) {
			foreach ($this->categoryListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> categoryList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> categoryList = $this -> categoryList;

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

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == 'atTheBeginning') {
					$this -> view -> sanitized -> order -> value = '0';
				} else {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$result = $this -> tagObj -> insertIntoObject_tag(Null, $this -> view -> sanitized -> titleTag -> value, '0', $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> comment -> value);

				if ($result !== false) {
					$this -> view -> sanitized -> general -> successMessage = $this -> view -> __('Record successfully added');
					$this -> view -> sanitized -> general -> successMessageStyle = 'display: block;';
					if (isset($this -> view -> sanitized -> save) and (1 === $this -> view -> sanitized -> save)) {
						header('Location: /admin/handle/pkg/menu/action/list');
						exit();
					}
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

		$this -> view -> render('object/addTagObject.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == 'atTheBeginning') {
					$this -> view -> sanitized -> order -> value = '0';
				} else {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$result = $this -> tagObj -> updateObject_tagById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> titleTag -> value, '0', $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> comment -> value);

				if ($result !== false) {
					$this -> view -> sanitized -> general -> successMessage = $this -> view -> __('Record successfully added');
					$this -> view -> sanitized -> general -> successMessageStyle = 'display: block;';
					if (isset($this -> view -> sanitized -> save) and (1 === $this -> view -> sanitized -> save)) {
						header('Location: /admin/handle/pkg/menu/action/list');
						exit();
					}
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> tagObj -> getObject_tagDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'tagId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'titleArticle' => array('text', 0, $result['title']), 'aliasArticle' => array('text', 0, $result['alias']), 'introTextArticle' => array('text', 0, $result['intro_text']), 'fullTextArticle' => array('text', 0, $result['full_text']), 'sourceArticle' => array('numeric', 0, $result['source_id']), 'createdDateArticle' => array('longDateTime', 0, $result['created_date']), 'publishFromArticle' => array('longDateTime', 0, $result['publish_from']), 'publishToArticle' => array('longDateTime', 0, $result['publish_to']), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('longDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('longDateTime', 0), 'publishToPhoto' => array('longDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('longDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('longDateTime', 0), 'publishToVideo' => array('longDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('numeric', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('longDateTime', 0), 'publishFromStatic' => array('longDateTime', 0), 'publishToStatic' => array('longDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parentDirectory' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'showInList' => array('text', 0), 'published' => array('text', 0), 'approved' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('longDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('longDateTime', 0), 'publishFrom' => array('longDateTime', 0), 'publishTo' => array('longDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => '', 'search' => '', 'dateAddedFrom' => array('longDateTime', 0), 'dateAddedTo' => array('longDateTime', 0), 'notification' => '', 'success' => '', 'error' => '', 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('object/addTagObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$tagDelete = $this -> tagObj -> deleteFromObject_tagById($id);
			}
			if (!empty($tagDelete)) {
				header('Location: /admin/handle/pkg/object-tag/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-tag/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$tagPublish = $this -> tagObj -> updateObject_tagPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($tagPublish)) {
				header('Location: /admin/handle/pkg/object-tag/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-tag/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$tagAprrove = $this -> tagObj -> updateObject_tagApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($tagAprrove)) {
				header('Location: /admin/handle/pkg/object-tag/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-tag/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-tag/action/';
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
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrdeByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$tagListResult = $this -> tagObj -> getAllCategoryOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$tagListResult = $this -> tagObj -> getAllObject_tagOrderByIdWithLimit('DESC', $this -> start, $this -> limit);
		}

		//listing
		//		$objectListResult = $this->objectObj->getAllObjectOrderById ();
		//		$categoryListResult = $this->categoryObj->getAllCategoryOrderById ();
		//		$countOfObjectListResult = count ( $objectListResult );
		//		$countOfOCategoryListResult = count ( $categoryListResult );
		//		$category = '';
		$objectList = '';
		if (!empty($tagListResult) and false != $tagListResult) {
			foreach ($tagListResult as $key => $value) {
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="tagId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-tag/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listTagObject.phtml');
		exit();
	}

}
