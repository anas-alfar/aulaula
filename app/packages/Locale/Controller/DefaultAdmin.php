<?php

class Locale_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $localeObj = NULL;

	protected function _init() {
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'localeId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> localeObj -> comments), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> importExcelLink = '/admin/handle/pkg/locale/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/locale/action/exportcsv/';
	}

	public function addAction() {
		$form = new Locale_Form_Default($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$stmt = $this -> localeObj -> getAdapter() -> prepare('UPDATE locale SET `order`=`order`+1 WHERE `order` >= ?');
			$stmt -> execute(array($_POST['optional']['order']));

			$stmt -> execute(array($_POST['optional']['order']));

			$localeData = array('locale' => $_POST['mandatory']['locale'], 'title' => $_POST['mandatory']['title'], 'locale_title' => $_POST['mandatory']['locale_title'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved'], 'order' => $_POST['optional']['order'], 'comments' => $_POST['optional']['comments'], );
			$this -> localeObj -> insert($localeData);

			header('Location: /admin/handle/pkg/locale/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('locale/addLocale.phtml');
		exit();
	}

	public function editAction() {
		$form = new Locale_Form_Default($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$localeId = (int)$_POST['mandatory']['id'];
			$localeObjResult = $this -> localeObj -> select() -> where('`id` = ?', $localeId) -> query() -> fetch();
			if ($localeObjResult['order'] != $_POST['optional']['order']) {
				$stmt = $this -> localeObj -> getAdapter() -> prepare('UPDATE locale SET `order`=`order`+1 WHERE `order` >= ?');
				$stmt -> execute(array($_POST['optional']['order']));
			}

			$localeData = array('locale' => $_POST['mandatory']['locale'], 'title' => $_POST['mandatory']['title'], 'locale_title' => $_POST['mandatory']['locale_title'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved'], 'order' => $_POST['optional']['order'], 'comments' => $_POST['optional']['comments'], );
			$this -> localeObj -> update($localeData, '`id` = ' . $localeId);

			header('Location: /admin/handle/pkg/locale/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$localeObjResult = $this -> localeObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($localeObjResult !== false) {
					//$localeObjResult['options'] = json_decode($localeObjResult['options']);

					$form -> populate($localeObjResult);
				} else {
					header('Location: /admin/handle/pkg/locale/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('locale/updateLocale.phtml');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> localeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->localeId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> localeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$localePublish = $this -> localeObj -> update($data, $where);
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
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> localeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$localeAprrove = $this -> localeObj -> update($data, $where);
			}
			if (!empty($localeAprrove)) {
				header('Location: /admin/handle/pkg/locale/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/locale/action/list/');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> localeId -> value)) {
			foreach ($this -> view -> sanitized -> localeId -> value as $id => $value) {
				$where = $this -> localeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> localeObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/locale/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/locale/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/locale/action/';

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

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> localeObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> localeObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$localeListResult = $this -> localeObj -> getAllLocale_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$localeListResult = $this -> localeObj -> getAllLocale_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> localeObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($localeListResult) and false == $localeListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> localeList = $localeListResult;
		$this -> view -> render('locale/listLocale.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> localeObj -> getAllLocale();
		$this -> exportSQL2CSV($allData, array('id', 'locale', 'title', 'locale_title', 'published', 'approved', 'order', 'comments'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Locale_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> localeObj, false);
						if ($result == true) {
							header('Location: /admin/handle/pkg/locale/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('locale/addLocale.phtml');
		exit();
	}

}
