<?php

class Object_Controller_TypeAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $InfoObj = NULL;
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

	//theme s
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//locale
	private $lcoaleObj = NULL;

	//category
	private $categoryObj = NULL;

	protected function _init() {
		// type
		$this -> typeObj = new Object_Model_Type();

		// type info
		$this -> typeInfoObj = new Object_Model_TypeInfo();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'typeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'titleArticle' => array('text', 0), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('text', 0), 'fullTextArticle' => array('text', 0), 'sourceArticle' => array('numeric', 0), 'createdDateArticle' => array('longDateTime', 0), 'publishFromArticle' => array('longDateTime', 0), 'publishToArticle' => array('longDateTime', 0), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('longDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('longDateTime', 0), 'publishToPhoto' => array('longDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('longDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('longDateTime', 0), 'publishToVideo' => array('longDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('numeric', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('longDateTime', 0), 'publishFromStatic' => array('longDateTime', 0), 'publishToStatic' => array('longDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parentDirectory' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'showInList' => array('text', 0), 'published' => array('text', 0), 'approved' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('longDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('longDateTime', 0), 'publishFrom' => array('longDateTime', 0), 'publishTo' => array('longDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//locale list
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> typeObj -> getAllObject_typeOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> localeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;

	}

	public function addAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> render('object/addObjectType.phtml');
		exit();
	}

	public function editAction() {
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> typeId -> value)) {
			foreach ($this->view->sanitized->typeId->value as $id => $value) {
				$typeDelete = $this -> typeObj -> deleteFromObject_typeById($id);
			}
			if (!empty($typeDelete)) {
				header('Location: /admin/handle/pkg/object-type/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-type/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> typeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->typeId->value as $id => $value) {
				$typePublish = $this -> typeObj -> updateObject_typePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($typePublish)) {
				header('Location: /admin/handle/pkg/object-type/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-type/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> typeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->typeId->value as $id => $value) {
				$typeAprrove = $this -> typeObj -> updateObject_typeApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($typeAprrove)) {
				header('Location: /admin/handle/pkg/object-type/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-type/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-type/action/';
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
		$this -> view -> sort -> category -> cssClass = 'sort-title';
		$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
		$this -> view -> sort -> alias -> cssClass = 'sort-title';
		$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['category']) && $_GET['category'] == 'asc') {
			$this -> view -> sort -> category -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/desc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderById();
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderByTitle ('ASC');
		} elseif (isset($_GET['category']) && $_GET['category'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderById();
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderByTitleWithLimit ( 'DESC', $this->start, $this->limit );
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'asc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/desc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'desc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrdeByTitleWithLimit('DESC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$articleListResult = $this -> typeObj -> getAllObject_type_infoOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		} else {
			$articleListResult = $this -> typeObj -> getAllObject_typeOrderByIdWithLimit('DESC', $this -> start, $this -> limit);
			//			$typeInfoListResult = $this->typeInfoObj->getAllObject_type_infoOrderById ();
		}

		//listing
		$typeListResult = $this -> typeObj -> getAllObject_typeOrderById();
		$typeList = '';
		$typeIfnoList = '';
		if (!empty($typeListResult) and false != $typeListResult) {
			foreach ($typeListResult as $key => $value) {
				$typeList .= '<tr>';
				$typeList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="typeId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$typeList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$typeList .= '<td class="jstalgntop">' . $value['label'] . '</td>';
				$typeList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$typeList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$typeList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$typeList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-type/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$typeList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> typeList = $typeList;

		$this -> view -> render('object/listObjectType.phtml');
		exit();
	}

}
