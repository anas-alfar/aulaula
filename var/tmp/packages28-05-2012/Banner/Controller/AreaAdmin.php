<?php

class Banner_Controller_AreaAdmin extends Aula_Controller_Action {

	private $bannerObj = Null;
	private $areaObj = Null;

	protected function _init() {
		$this -> areaObj = new Banner_Model_Area();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'areaId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'published' => array('text', 0, $this -> areaObj -> published), 'approved' => array('text', 0, $this -> areaObj -> approved), 'comment' => array('text', 0, $this -> areaObj -> comments), 'option' => array('text', 0, $this -> areaObj -> options), 'publishFrom' => array('text', 0, $this -> areaObj -> publishFrom), 'publishTo' => array('text', 0, $this -> areaObj -> publishTo), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['author']['value'] = 1;
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> areaObj -> getAreaById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('banner/viewArea.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Banner_Form_AreaAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$_POST['mandatory']['author_id'] = $this -> userId;

			$this -> areaObj -> insert(array_merge($_POST['mandatory'], $_POST['optional']));
			header('Location: /admin/handle/pkg/banner-area/action/list');
		}
		$this -> view -> form = $form;
		$this -> view -> render('banner/addArea.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
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
		 exit();*/

	}

	public function editAction() {
		$form = new Banner_Form_AreaAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {

			$dataBannerArea = array_merge($_POST['mandatory'], $_POST['optional']);

			$dataBannerArea['options'] = json_encode($dataBannerArea['options']);
			$dataBannerArea['modified_by'] = $this -> userId;
			$dataBannerArea['modified_time'] = new Zend_db_Expr("Now()");

			$this -> areaObj -> update($dataBannerArea, '`id` = ' . $dataBannerArea['id']);

			header('Location: /admin/handle/pkg/banner-area/action/list');
			exit();

		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$areaObjResult = $this -> areaObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				if ($areaObjResult !== false) {

					$publish_from = explode(' ', $areaObjResult['publish_from']);
					$publish_to = explode(' ', $areaObjResult['publish_to']);
					$areaObjResult['publish_from'] = $publish_from[0];
					$areaObjResult['publish_to'] = $publish_to[0];
					$areaObjResult['options'] = json_decode($areaObjResult['options']);

					$form -> populate($areaObjResult);
				} else {
					header('Location: /admin/handle/pkg/banner-area/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('banner/updateArea.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
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
		 exit();*/
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

	/*public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> bannerObj -> getAdapter() -> quoteInto('id = ?', $id);
				$bannerPublish = $this -> bannerObj -> update($data, $where);
			}
			if (!empty($bannerPublish)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/publish');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}*/

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/banner-area/action/';

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

		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		$cols = $this -> areaObj -> cols;

		foreach ($cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$areaListResult = $this -> areaObj -> select() -> from ('banner_area',new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->  where ('id > ?', 1)*/ -> order("$column $sort") -> limit("$this->start, $this->limit") -> query() -> fetchAll();
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$areaListResult = $this -> areaObj -> select() -> from ('banner_area',new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->  where ('id > ?', 1)*/ -> order("id DESC") -> limit("$this->start, $this->limit") -> query() -> fetchAll();
		}

		$this -> pagingObj -> _init($this -> areaObj -> getAdapter()-> fetchOne('SELECT FOUND_ROWS()'));
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($areaListResult) and false != $areaListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}
		$this -> view -> areaList = $areaListResult;
		$this -> view -> render('banner/listArea.phtml');
		exit();
	}

}
