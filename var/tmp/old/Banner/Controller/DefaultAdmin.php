<?php

class Banner_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $bannerObj = Null;
	private $areaObj = Null;
	private $uploadObj = Null;

	protected function _init() {
		$this -> bannerObj = new Banner_Model_Default();
		$this -> areaObj = new Banner_Model_Area();

		//Upload Object
		$this -> uploadObj = new Aula_Model_Upload('uploadFile');

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'fullPath' => array('filePath', 0, $this -> bannerObj -> fullPath), 'uploadFile' => array('fileUploaded', 0, (!empty($_FILES['uploadFile']['name']) ? $_FILES['uploadFile']['name'] : '')), 'link' => array('url', 0), 'status' => array('text', 0), 'bannerId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'area' => array('numeric', 1), 'type' => array('text', 1, $this -> bannerObj -> type), 'object' => array('text', 0), 'published' => array('text', 0, $this -> bannerObj -> published), 'approved' => array('text', 0, $this -> bannerObj -> approved), 'comment' => array('text', 0, $this -> bannerObj -> comments), 'option' => array('text', 0, $this -> bannerObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $this -> bannerObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> bannerObj -> publishTo), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//area list
		$this -> areaList = '';
		$this -> areaListResult = $this -> areaObj -> getAllBanner_areaOrderById();
		if (!empty($this -> areaListResult)) {
			foreach ($this->areaListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> areaList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> areaList = $this -> areaList;

		//type list
		$this -> typeList = '';
		$this -> typeList .= '<option value="image file"' . ('image' == $this -> view -> sanitized['type']['value'] ? 'selected="selected"' : '') . '>image file</option>';
		$this -> typeList .= '<option value="image url"' . ('image' == $this -> view -> sanitized['type']['value'] ? 'selected="selected"' : '') . '>image url</option>';
		$this -> typeList .= '<option value="swf file"' . ('swf' == $this -> view -> sanitized['type']['value'] ? 'selected="selected"' : '') . '>swf file</option>';
		$this -> typeList .= '<option value="swf object"' . ('swf' == $this -> view -> sanitized['type']['value'] ? 'selected="selected"' : '') . '>swf object</option>';
		$this -> typeList .= '<option value="javascript code"' . ('javascript' == $this -> view -> sanitized['type']['value'] ? 'selected="selected"' : '') . '>javascript code</option>';
		$this -> view -> typeList = $this -> typeList;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> uploadObj -> CheckIfThereIsFile() === TRUE) {
					if ($this -> uploadObj -> validatedSize()) {
						$this -> view -> sanitized -> size -> value = $this -> uploadObj -> size;
						$this -> view -> sanitized -> extension -> value = $this -> uploadObj -> extension;
						$this -> view -> sanitized -> mime -> value = $this -> uploadObj -> mime;
						$result = $this -> bannerObj -> insertIntoBanner(Null, $this -> view -> sanitized -> area -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> type -> value, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> link -> value, $GLOBALS['AULA_BLACKLIST']['object'], $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
						$this -> view -> sanitized -> Id -> value = $result[0];
						switch ($this->view->sanitized->mime->value) {
							case 'image/gif' :
							case 'image/jpg' :
							case 'image/jpeg' :
							case 'swf/jpeg' :
							case 'application/x-shockwave-flash' :
								$this -> uploadObj -> newFileName . PHP_EOL . $this -> uploadObj -> newFileName = parent::$encryptedDisk['banner'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
								$newFileUrl = parent::$encryptedUrl['banner'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
								$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
								if (true === $fileUploaded) {
									$this -> bannerObj -> updateBannerSizeColumnById($this -> view -> sanitized -> Id -> value, $this -> uploadObj -> size);
									$this -> bannerObj -> updateBannerFull_pathColumnById($this -> view -> sanitized -> Id -> value, $newFileUrl);
								}
								break;
							default :
								break;
						}
					}
				} else {
					$result = $this -> bannerObj -> insertIntoBanner(Null, $this -> view -> sanitized -> area -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> type -> value, '', '', '', $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> link -> value, $this -> view -> sanitized -> object -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
					$this -> view -> sanitized -> Id -> value = $result[0];
				}

				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/banner/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/banner/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('banner/addBanner.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> bannerObj -> updateBannerById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> area -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> type -> value, $this -> view -> sanitized -> link -> value, $this -> view -> sanitized -> object -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				if ($result !== false) {
					$this -> view -> sanitized -> general -> successMessage = $this -> view -> __('Record successfully added');
					$this -> view -> sanitized -> general -> successMessageStyle = 'display: block;';
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/banner/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/banner/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> bannerObj -> getBannerDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'link' => array('url', 0, $result['link']), 'status' => array('text', 0), 'bannerId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'area' => array('numeric', 1, $result['area_id']), 'type' => array('text', 1, $result['type']), 'object' => array('text', 1, $result['object']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'btn_submit' => array('', 0, 2));
			$this -> view -> sanitized = array();
			$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
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

		$this -> view -> render('banner/addBanner.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$bannerDelete = $this -> bannerObj -> deleteFromBannerById($id);
			}
			if (!empty($bannerDelete)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/delete');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$bannerAprrove = $this -> bannerObj -> updateBannerApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($bannerAprrove)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}

	public function showInMenuAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$bannerShowInMenu = $this -> bannerObj -> updateBannerShow_in_menuColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($bannerShowInMenu)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/showInMenu');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$bannerPublish = $this -> bannerObj -> updateBannerPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($bannerPublish)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/publish');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/banner/action/';
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

		//sortin
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> area -> cssClass = 'sort-title';
		$this -> view -> sort -> area -> href = $this -> view -> sanitized -> actionURI -> value . 'list/area/asc';
		$this -> view -> sort -> type -> cssClass = 'sort-title';
		$this -> view -> sort -> type -> href = $this -> view -> sanitized -> actionURI -> value . 'list/type/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['area']) && $_GET['area'] == 'asc') {
			$this -> view -> sort -> area -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> area -> href = $this -> view -> sanitized -> actionURI -> value . 'list/area/desc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByArea_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['area']) && $_GET['area'] == 'desc') {
			$this -> view -> sort -> area -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> area -> href = $this -> view -> sanitized -> actionURI -> value . 'list/area/asc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByArea_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['type']) && $_GET['type'] == 'asc') {
			$this -> view -> sort -> type -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> type -> href = $this -> view -> sanitized -> actionURI -> value . 'list/type/desc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByTypeWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['type']) && $_GET['type'] == 'desc') {
			$this -> view -> sort -> type -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> type -> href = $this -> view -> sanitized -> actionURI -> value . 'list/type/asc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByTypeWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$bannerListResult = $this -> bannerObj -> GetAllBannerOrderByIdWithLimit($this -> start, $this -> limit, 'DESC');
		}
		$this -> pagingObj -> _init($this -> bannerObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$modifiedTime = '';
		$bannerList = '';
		$bannerIfnoList = '';
		$answerListResult = $this -> areaObj -> GetAllBanner_areaOrderById();
		$countAnswerListResult = count($answerListResult);
		for ($i = 0; $i < $countAnswerListResult; $i++) {
			$answerList[$answerListResult[$i]['id']] = $answerListResult[$i]['title'];
		}

		if (!empty($bannerListResult) and false != $bannerListResult) {
			foreach ($bannerListResult as $key => $value) {
				$bannerList .= '<tr>';
				$bannerList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="bannerId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$bannerList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$bannerList .= '<td class="jstalgntop">' . $answerList[$value['area_id']] . '</td>';
				$bannerList .= '<td class="jstalgntop">' . $this -> view -> __($value['type']) . '</td>';
				$bannerList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$bannerList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$bannerList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$bannerList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/banner/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$bannerList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> bannerList = $bannerList;

		$this -> view -> render('banner/listBanner.phtml');
		exit();
	}

}
