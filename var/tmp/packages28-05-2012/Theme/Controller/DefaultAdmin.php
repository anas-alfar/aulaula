<?php

class Theme_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $layoutInfoObj = NULL;
	private $skinObj = NULL;
	private $skinInfoObj = NULL;
	private $templateObj = NULL;
	private $templateInfoObj = NULL;

	protected function _init() {
		$this -> themeObj = new Theme_Model_Default();
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'themeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'template' => array('numeric', 1), 'layout' => array('numeric', 1), 'skin' => array('numeric', 1), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'comment' => array('text', 0, $this -> themeObj -> comments), 'option' => array('text', 0, $this -> themeObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

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
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$result = $this -> themeObj -> insertIntoTheme(Null, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, '0', '0', '0', $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/theme/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/theme/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('theme/addTheme.phtml');
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
				$result = $this -> themeObj -> updateThemeById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, '0', '0', '0', $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/theme/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/theme/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> themeObj -> getThemeDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'themeId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'layout' => array('numeric', 1, $result['layout_id']), 'template' => array('numeric', 1, $result['template_id']), 'skin' => array('numeric', 1, $result['skin_id']), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('theme/addTheme.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> themeId -> value)) {
			foreach ($this->view->sanitized->themeId->value as $id => $value) {
				$themeDelete = $this -> themeObj -> deleteFromThemeById($id);
			}
			if (!empty($themeDelete)) {
				header('Location: /admin/handle/pkg/theme/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/theme/action/list/');
		exit();

	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/theme/action/';
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
		$this -> view -> sort -> layout -> cssClass = 'sort-title';
		$this -> view -> sort -> layout -> href = $this -> view -> sanitized -> actionURI -> value . 'list/layout/asc';
		$this -> view -> sort -> template -> cssClass = 'sort-title';
		$this -> view -> sort -> template -> href = $this -> view -> sanitized -> actionURI -> value . 'list/template/asc';
		$this -> view -> sort -> skin -> cssClass = 'sort-title';
		$this -> view -> sort -> skin -> href = $this -> view -> sanitized -> actionURI -> value . 'list/skin/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['layout']) && $_GET['layout'] == 'asc') {
			$this -> view -> sort -> layout -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> layout -> href = $this -> view -> sanitized -> actionURI -> value . 'list/layout/desc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderByLayout_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['layout']) && $_GET['layout'] == 'desc') {
			$this -> view -> sort -> layout -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> layout -> href = $this -> view -> sanitized -> actionURI -> value . 'list/layout/asc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderByLayout_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['template']) && $_GET['template'] == 'asc') {
			$this -> view -> sort -> template -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> template -> href = $this -> view -> sanitized -> actionURI -> value . 'list/template/desc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderByTemplate_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['template']) && $_GET['template'] == 'desc') {
			$this -> view -> sort -> template -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> template -> href = $this -> view -> sanitized -> actionURI -> value . 'list/template/asc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderByTemplate_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['skin']) && $_GET['skin'] == 'asc') {
			$this -> view -> sort -> skin -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> skin -> href = $this -> view -> sanitized -> actionURI -> value . 'list/skin/desc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderBySkin_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['skin']) && $_GET['skin'] == 'desc') {
			$this -> view -> sort -> skin -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> skin -> href = $this -> view -> sanitized -> actionURI -> value . 'list/skin/asc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderBySkin_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$themeListResult = $this -> themeObj -> getAllThemeOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$themeListResult = $this -> themeObj -> getAllThemeOrderByIdWithLimit($this -> start, $this -> limit);

		}
		$this -> pagingObj -> _init($this -> themeObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		$layoutListResult = $this -> layoutObj -> getAllTheme_layoutOrderById();
		$skinListResult = $this -> skinObj -> getAllTheme_skinOrderById();
		$templateListResult = $this -> templateObj -> getAllTheme_templateOrderById();

		//listing
		$layout = array();
		$template = array();
		$skin = array();
		$countOfLayoutListResult = count($layoutListResult);
		$countOfTemplateListResult = count($templateListResult);
		$countOfSkinListResult = count($skinListResult);
		for ($i = 0; $i < $countOfLayoutListResult; $i++) {
			$layout[$layoutListResult[$i]['id']] = $layoutListResult[$i]['title'];
		}
		for ($i = 0; $i < $countOfTemplateListResult; $i++) {
			$template[$templateListResult[$i]['id']] = $templateListResult[$i]['title'];
		}
		for ($i = 0; $i < $countOfSkinListResult; $i++) {
			$skin[$skinListResult[$i]['id']] = $skinListResult[$i]['title'];
		}

		$themeList = '';
		if (!empty($themeListResult) and false != $themeListResult) {
			foreach ($themeListResult as $key => $value) {
				$themeList .= '<tr>';
				$themeList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="themeId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$themeList .= '<td class="jstalgntop">' . $layout[$value['layout_id']] . '</td>';
				$themeList .= '<td class="jstalgntop">' . $template[$value['template_id']] . '</td>';
				$themeList .= '<td class="jstalgntop">' . $skin[$value['skin_id']] . '</td>';
				$themeList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$themeList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/theme/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$themeList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> themeList = $themeList;
		$this -> view -> render('theme/listTheme.phtml');
		exit();
	}

}
