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
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> sourceObj = new Object_Model_Source();
		$this -> sourceInfoObj = new Object_Model_SourceInfo();

		//country object
		$this -> countryObj = new Aula_Model_CountriesList();

		//category object
		$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'sourceId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameSource' => array('text', 1), 'descriptionSource' => array('text', 0), 'sourceType' => array('numericUnsigned', 1), 'countrySource' => array('numericUnsigned', 1), 'urlSource' => array('url', 1), 'timeDelay' => array('numericUnsigned', 0, $this -> sourceObj -> timeDelay), 'package' => array('numericUnsigned', 0, $this -> sourceObj -> packageId), 'published' => array('text', 0, $this -> sourceObj -> published), 'approved' => array('text', 0, $this -> sourceObj -> approved), 'order' => array('numeric', 0, $this -> sourceObj -> order), 'afterId' => array('numeric', 0), 'publishFrom' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishTo), 'comment' => array('text', 0, $this -> sourceInfoObj -> comments), 'option' => array('text', 0, $this -> sourceInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//countrySource list
		$this -> countryList = '';
		$this -> countryListResult = $this -> countryObj -> enCountriesList();
		if (!empty($this -> countryListResult)) {
			foreach ($this->countryListResult as $key => $value) {
				$selectedItem = ($key == $this -> view -> sanitized['countrySource']['value']) ? 'selected="selected"' : '';
				$this -> countryList .= '<option value="' . $key . '"' . $selectedItem . '>' . $value . '</option>';
			}
		}
		$this -> view -> countryList = $this -> countryList;

		//Source Type List
		$this -> sourceTypeList = '';
		$this -> sourceTypeResult = array('rss' => 'rss', 'atom' => 'atom', 'csv' => 'csv', 'webservice' => 'webservice', 'twitt' => 'twitt', 'youtube' => 'youtube', 'flicker' => 'flicker');
		if (!empty($this -> sourceTypeResult)) {
			foreach ($this->sourceTypeResult as $key => $value) {
				$selectedItem = ($key == $this -> view -> sanitized['sourceType']['value']) ? 'selected="selected"' : '';
				$this -> countryList .= '<option value="' . $key . '"' . $selectedItem . '>' . $value . '</option>';
			}
		}
		$this -> view -> sourceTypeList = $this -> sourceTypeList;
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
				$sourceDelete = $this -> sourceObj -> deleteFromObject_sourceById($id);
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
				$sourcePublish = $this -> sourceObj -> updateObject_sourcePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$sourceAprrove = $this -> sourceObj -> updateObject_sourceApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
		$this -> view -> sort -> name -> cssClass = 'sort-title';
		$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/asc';
		$this -> view -> sort -> description -> cssClass = 'sort-title';
		$this -> view -> sort -> description -> href = $this -> view -> sanitized -> actionURI -> value . 'list/description/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['description']) && $_GET['description'] == 'asc') {
			$this -> view -> sort -> description -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> description -> href = $this -> view -> sanitized -> actionURI -> value . 'list/description/desc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByDescriptionWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['description']) && $_GET['description'] == 'desc') {
			$this -> view -> sort -> description -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> description -> href = $this -> view -> sanitized -> actionURI -> value . 'list/description/asc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByDescriptionWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['name']) && $_GET['name'] == 'asc') {
			$this -> view -> sort -> name -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/desc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByNameWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['name']) && $_GET['name'] == 'desc') {
			$this -> view -> sort -> name -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/asc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByNameWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$sourceListResult = $this -> sourceObj -> getAllObject_sourceOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> sourceObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		$countOfSourceIfnoListResult = count($sourceListResult);
		$objectList = '';
		if (!empty($sourceListResult) and false != $sourceListResult) {
			foreach ($sourceListResult as $key => $value) {
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="sourceId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $value['name'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['description'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-source/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listSourceObject.phtml');
		exit();
	}

}
