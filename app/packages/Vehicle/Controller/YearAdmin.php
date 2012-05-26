<?php

class Vehicle_Controller_YearAdmin extends Aula_Controller_Action {

	private $yearObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> yearObj = new Vehicle_Model_Year();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'yearId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> yearObj -> comments), 'option' => array('text', 0, $this -> yearObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-year/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-year/action/exportcsv/';
	}

	public function addAction() {
		$form = new Vehicle_Form_Year($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$yearData = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, );
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$yearData['options'] = json_encode($_POST[$language_id]['options']);
					$yearData['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$yearId = $this -> yearObj -> insert($yearData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $yearId);
					$this -> yearObj -> update(array('hash_key' => $hash_key), '`id` = ' . $yearId);
					$flag = false;
				} else {
					$yearData['hash_key'] = $hash_key;
					$this -> yearObj -> insert($yearData);
				}
			}			
			
			header('Location: /admin/handle/pkg/vehicle-year/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addYear.phtml');
		exit();
	}

	public function editAction() {
		$form = new Vehicle_Form_SimpleYear($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$yearId = (int)$_POST['mandatory']['id'];

			$yearData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> yearObj -> update($yearData, '`id` = ' . $yearId);

			header('Location: /admin/handle/pkg/vehicle-year/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$yearObjResult = $this -> yearObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($yearObjResult !== false) {
					$yearObjResult['options'] = json_decode($yearObjResult['options']);

					$form -> populate($yearObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-year/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateYear.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> yearId -> value)) {
			foreach ($this -> view -> sanitized -> yearId -> value as $id => $value) {
				$where = $this -> yearObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> yearObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-year/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-year/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-year/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> yearObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> yearObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$yearListResult = $this -> yearObj -> getAllYear_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$yearListResult = $this -> yearObj -> getAllYear_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> yearObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($yearListResult) and false == $yearListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> yearList = $yearListResult;
		$this -> view -> render('vehicle/listYear.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> yearObj -> getAllYear();
		$this -> exportSQL2CSV($allData, array('id', 'title', 'description', 'locale_id', 'hash_key', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Vehicle_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> yearObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/vehicle-year/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addYear.phtml');
		exit();
	}

}
