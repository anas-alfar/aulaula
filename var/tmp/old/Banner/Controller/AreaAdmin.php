<?php

class Banner_Controller_AreaAdmin extends Aula_Controller_Action {

	private $bannerObj = Null;
	private $areaObj = Null;

	protected function _init() {
		$this -> areaObj = new Banner_Model_Area();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'areaId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'published' => array('text', 0, $this -> areaObj -> published), 'approved' => array('text', 0, $this -> areaObj -> approved), 'comment' => array('text', 0, $this -> areaObj -> comments), 'option' => array('text', 0, $this -> areaObj -> options), 'publishFrom' => array('text', 0, $this -> areaObj -> publishFrom), 'publishTo' => array('text', 0, $this -> areaObj -> publishTo), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['author']['value'] = 1;
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> areaObj -> insertIntoBanner_Area(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/banner-area/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/banner-area/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('banner/addArea.phtml');
		exit();

	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> areaObj -> updateBanner_areaById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/banner-area/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/banner-area/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> areaObj -> getBanner_areaDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);

			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'areaId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'publishFrom' => array('text', 0, $result['publish_from']), 'publishTo' => array('text', 0, $result['publish_to']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

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

		$this -> view -> render('banner/addArea.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> areaId -> value)) {
			foreach ($this->view->sanitized->areaId->value as $id => $value) {
				$areaDelete = $this -> areaObj -> deleteFromBanner_areaById($id);
			}
			if (!empty($areaDelete)) {
				header('Location: /admin/handle/pkg/banner-area/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner-area/action/list/');
		exit();
	}

	public function showInMenuAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> areaId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->areaId->value as $id => $value) {
				$areaShowInMenu = $this -> areaObj -> updateBanner_areaShow_in_menuColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($areaShowInMenu)) {
				header('Location: /admin/handle/pkg/banner-area/action/list/success/showInMen');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner-area/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> areaId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->areaId->value as $id => $value) {
				$areaPublish = $this -> areaObj -> updateBanner_areaPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($areaPublish)) {
				header('Location: /admin/handle/pkg/banner-area/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner-area/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> areaId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->areaId->value as $id => $value) {
				$areaAprrove = $this -> areaObj -> updateBanner_areaApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($areaAprrove)) {
				header('Location: /admin/handle/pkg/banner-area/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner-area/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/banner-area/action/';
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
		} elseif ($_GET['success'] == 'showInMenu') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sortin
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
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$areaListResult = $this -> areaObj -> getAllBanner_areaOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> areaObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$label = '';
		$areaList = '';
		$areaIfnoList = '';
		if (!empty($areaListResult) and false != $areaListResult) {
			foreach ($areaListResult as $key => $value) {
				$areaList .= '<tr>';
				$areaList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="areaId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$areaList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$areaList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$areaList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$areaList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$areaList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/banner-area/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$areaList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> areaList = $areaList;
		$this -> view -> render('banner/listArea.phtml');
		exit();
	}

}
