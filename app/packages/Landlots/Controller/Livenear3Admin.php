<?php

class Landlots_Controller_Livenear3Admin extends Aula_Controller_Action {

	private $livenear3Obj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> livenear3Obj = new Landlots_Model_Livenear3();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'livenear3Id' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> livenear3Obj -> comments), 'option' => array('text', 0, $this -> livenear3Obj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/landlots-livenear3/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/landlots-livenear3/action/exportcsv/';
	}

	public function addAction() {
		$form = new Landlots_Form_Livenear3($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$livenear3Data = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, );
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$livenear3Data['options'] = json_encode($_POST[$language_id]['options']);
					$livenear3Data['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$livenear3Id = $this -> livenear3Obj -> insert($livenear3Data);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $livenear3Id);
					$this -> livenear3Obj -> update(array('hash_key' => $hash_key), '`id` = ' . $livenear3Id);
					$flag = false;
				} else {
					$livenear3Data['hash_key'] = $hash_key;
					$this -> livenear3Obj -> insert($livenear3Data);
				}
			}
			header('Location: /admin/handle/pkg/landlots-livenear3/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('landlots/addLivenear3.phtml');
		exit();
	}

	public function editAction() {
		$form = new Landlots_Form_SimpleLivenear3($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$livenear3Id = (int)$_POST['mandatory']['id'];

			$livenear3Data = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> livenear3Obj -> update($livenear3Data, '`id` = ' . $livenear3Id);

			header('Location: /admin/handle/pkg/landlots-livenear3/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$livenear3ObjResult = $this -> livenear3Obj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($livenear3ObjResult !== false) {
					$livenear3ObjResult['options'] = json_decode($livenear3ObjResult['options']);

					$form -> populate($livenear3ObjResult);
				} else {
					header('Location: /admin/handle/pkg/landlots-livenear3/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('landlots/updateLivenear3.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> livenear3Id -> value)) {
			foreach ($this -> view -> sanitized -> livenear3Id -> value as $id => $value) {
				$where = $this -> livenear3Obj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> livenear3Obj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/landlots-livenear3/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/landlots-livenear3/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/landlots-livenear3/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> livenear3Obj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> livenear3Obj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$livenear3ListResult = $this -> livenear3Obj -> getAllLivenear3_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$livenear3ListResult = $this -> livenear3Obj -> getAllLivenear3_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> livenear3Obj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($livenear3ListResult) and false == $livenear3ListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> livenear3List = $livenear3ListResult;
		$this -> view -> render('landlots/listLivenear3.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> livenear3Obj -> getAllLivenear3();
		$this -> exportSQL2CSV($allData, array('id', 'title', 'description', 'locale_id', 'locale_id', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Landlots_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> livenear3Obj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/landlots-livenear3/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('landlots/addLivenear3.phtml');
		exit();
	}

}
