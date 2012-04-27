<?php

class Translation_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $translationObj = Null;

	protected function _init() {
		$this -> localeObj = new Locale_Model_Default();
		$this -> translationObj = new Translation_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'translationId' => array('numeric', 0), 'Id' => array('numeric', 0), 'locale' => array('numeric', 0), 'token' => array('text', 1), 'label' => array('text', 1), 'translation' => array('text', 1), 'comment' => array('text', 0, $this -> translationObj -> comments), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//locale list
		$this -> localeList = '';
		$this -> localeListResult = $this -> localeObj -> getAllLocaleOrderById();
		if (!empty($this -> localeListResult)) {
			foreach ($this->localeListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['locale']['value']) ? 'selected="selected"' : '';
				$this -> localeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> localeList = $this -> localeList;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> translationObj -> insertIntoTranslation(Null, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> translation -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> comment -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/translation/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/translation/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('translation/addTranslation.phtml');
		exit();

	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> translationObj -> updateTranslationById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> translation -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> comment -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/translation/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/translation/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> translationObj -> getTranslationDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'translationId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'locale' => array('numeric', 0, $result['locale_id']), 'token' => array('text', 1), 'label' => array('text', 1, $result['label']), 'translation' => array('text', 1, $result['translation']), 'comment' => array('text', 0, $result['comments']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('translation/addTranslation.phtml');
		exit();

	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> translationId -> value)) {
			foreach ($this->view->sanitized->translationId->value as $id => $value) {
				$translationDelete = $this -> translationObj -> deleteFromTranslationById($id);
			}
			if (!empty($translationDelete)) {
				header('Location: /admin/handle/pkg/translation/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/translation/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/translation/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sorting
		$this -> view -> sort -> label -> cssClass = 'sort-title';
		$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
		$this -> view -> sort -> translation -> cssClass = 'sort-title';
		$this -> view -> sort -> translation -> href = $this -> view -> sanitized -> actionURI -> value . 'list/translation/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['label']) && $_GET['label'] == 'asc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/desc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByLabelWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'desc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByLabelWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['translation']) && $_GET['translation'] == 'asc') {
			$this -> view -> sort -> translation -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> translation -> href = $this -> view -> sanitized -> actionURI -> value . 'list/translation/desc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByTranslationWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['translation']) && $_GET['translation'] == 'desc') {
			$this -> view -> sort -> translation -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> translation -> href = $this -> view -> sanitized -> actionURI -> value . 'list/translation/asc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByTranslationWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$translationListResult = $this -> translationObj -> getAllCategoryOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$translationListResult = $this -> translationObj -> getAllTranslationOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> translationObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$translationList = '';
		if (!empty($translationListResult) and false != $translationListResult) {
			foreach ($translationListResult as $key => $value) {
				$translationList .= '<tr>';
				$translationList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="translationId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$translationList .= '<td class="jstalgntop">' . $value['label'] . '</td>';
				$translationList .= '<td class="jstalgntop">' . $value['translation'] . '</td>';
				$translationList .= '<td class="jstalgntop">' . $value['modified_time'] . '</td>';
				$translationList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/translation/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$translationList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> translationList = $translationList;
		$this -> view -> render('translation/listTranslation.phtml');
		exit();
	}

}
