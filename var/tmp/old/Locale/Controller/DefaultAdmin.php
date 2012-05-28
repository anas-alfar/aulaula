<?php

class Locale_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $localeObj = Null;

	protected function _init() {
		$this -> localeObj = new Locale_Model_Default();
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'localeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'locale' => array('text', 1), 'localeTitle' => array('text', 1), 'published' => array('text', 0, $this -> localeObj -> published), 'approved' => array('text', 0, $this -> localeObj -> approved), 'order' => array('numericUnsigned', 0, $this -> localeObj -> order), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $this -> localeObj -> comments), 'resetFilter' => array('', 0), 'search' => array('', 0), 'dateAddedFrom' => array('shortDateTime', 0), 'dateAddedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');

		//order list
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> localeObj -> getAllLocaleOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;
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
				$result = $this -> localeObj -> insertIntoLocale(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> localeTitle -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/locale/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/locale/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('locale/addLocale.phtml');
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
				$result = $this -> localeObj -> updateLocaleById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> localeTitle -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/locale/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/locale/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> localeObj -> getLocaleDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'localeId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'locale' => array('text', 1, $result['locale']), 'localeTitle' => array('text', 1, $result['title']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $result['comments']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'dateAddedFrom' => array('shortDateTime', 0), 'dateAddedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('locale/addLocale.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> localeId -> value)) {
			foreach ($this->view->sanitized->localeId->value as $id => $value) {
				$localeDelete = $this -> localeObj -> deleteFromLocaleById($id);
			}
			if (!empty($localeDelete)) {
				header('Location: /admin/handle/pkg/locale/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/locale/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> localeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->localeId->value as $id => $value) {
				$localePublish = $this -> localeObj -> updateLocalePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($localePublish)) {
				header('Location: /admin/handle/pkg/locale/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/locale/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> localeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->localeId->value as $id => $value) {
				$localeAprrove = $this -> localeObj -> updateLocaleApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
			}
			if (!empty($localeAprrove)) {
				header('Location: /admin/handle/pkg/locale/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/locale/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/locale/action/';
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
		$this -> view -> sort -> localeTitle -> cssClass = 'sort-title';
		$this -> view -> sort -> localeTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/localeTitle/asc';
		$this -> view -> sort -> showInMenu -> cssClass = 'sort-title';
		$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['localeTitle']) && $_GET['localeTitle'] == 'asc') {
			$this -> view -> sort -> localeTitle -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> localeTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/localeTitle/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByLocale_titleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['localeTitle']) && $_GET['localeTitle'] == 'desc') {
			$this -> view -> sort -> localeTitle -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> localeTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/localeTitle/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByLocale_titleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInMenu']) && $_GET['showInMenu'] == 'asc') {
			$this -> view -> sort -> showInMenu -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByShow_in_menuWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInMenu']) && $_GET['showInMenu'] == 'desc') {
			$this -> view -> sort -> showInMenu -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByShow_in_menuWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByIdWithLimit($this -> start, $this -> limit);
		}

		//listing
		$localeList = '';
		$localeIfnoList = '';
		if (!empty($localeListResult) and false != $localeListResult) {
			foreach ($localeListResult as $key => $value) {
				$localeList .= '<tr>';
				$localeList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="localeId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$localeList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$localeList .= '<td class="jstalgntop">' . $value['locale_title'] . '</td>';
				$localeList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$localeList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$localeList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$localeList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/locale/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$localeList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> localeList = $localeList;
		$this -> view -> render('locale/listLocale.phtml');
		exit();
	}

}
