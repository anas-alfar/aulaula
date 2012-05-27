<?php

class Estate_Controller_Livenear1Admin extends Aula_Controller_Action {

	private $livenear1Obj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> livenear1Obj = new Estate_Model_Livenear1();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'livenear1Id' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> livenear1Obj -> comments), 'option' => array('text', 0, $this -> livenear1Obj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> importExcelLink = '/admin/handle/pkg/estate-livenear1/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/estate-livenear1/action/exportcsv/';
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> livenear1Obj -> getLivenear1ById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('estate/viewLivenear1.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Estate_Form_Livenear1($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$livenear1Data = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, );
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$livenear1Data['options'] = json_encode($_POST[$language_id]['options']);
					$livenear1Data['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$livenear1Id = $this -> livenear1Obj -> insert($livenear1Data);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $livenear1Id);
					$this -> livenear1Obj -> update(array('hash_key' => $hash_key), '`id` = ' . $livenear1Id);
					$flag = false;
				} else {
					$livenear1Data['hash_key'] = $hash_key;
					$this -> livenear1Obj -> insert($livenear1Data);
				}
			}
			header('Location: /admin/handle/pkg/estate-livenear1/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/addLivenear1.phtml');
		exit();
	}

	public function editAction() {
		$form = new Estate_Form_SimpleLivenear1($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$livenear1Id = (int)$_POST['mandatory']['id'];

			$livenear1Data = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> livenear1Obj -> update($livenear1Data, '`id` = ' . $livenear1Id);

			header('Location: /admin/handle/pkg/estate-livenear1/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$livenear1ObjResult = $this -> livenear1Obj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($livenear1ObjResult !== false) {
					$livenear1ObjResult['options'] = json_decode($livenear1ObjResult['options']);

					$form -> populate($livenear1ObjResult);
				} else {
					header('Location: /admin/handle/pkg/estate-livenear1/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/updateLivenear1.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> livenear1Id -> value)) {
			foreach ($this -> view -> sanitized -> livenear1Id -> value as $id => $value) {
				$where = $this -> livenear1Obj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> livenear1Obj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/estate-livenear1/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/estate-livenear1/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/estate-livenear1/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> livenear1Obj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> livenear1Obj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$livenear1ListResult = $this -> livenear1Obj -> getAllLivenear1_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$livenear1ListResult = $this -> livenear1Obj -> getAllLivenear1_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> livenear1Obj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($livenear1ListResult) and false == $livenear1ListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> livenear1List = $livenear1ListResult;
		$this -> view -> render('estate/listLivenear1.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> livenear1Obj -> getAllLivenear1();
		$this -> exportSQL2CSV($allData, array('id', 'title', 'description', 'locale_id', 'hash_key', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Estate_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> livenear1Obj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/estate-livenear1/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/addLivenear1.phtml');
		exit();
	}

}
