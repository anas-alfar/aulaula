<?php

class Waseet_Controller_CategoryAdmin extends Aula_Controller_Action {

	private $categoryObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> categoryObj = new Waseet_Model_Category();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> categoryObj -> comments), 'option' => array('text', 0, $this -> categoryObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> importExcelLink = '/admin/handle/pkg/waseet-category/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/waseet-category/action/exportcsv/';
	}

	public function viewAction() {
		if ( isset($_GET['id']) and is_numeric($_GET['id']) ) {
			$result = $this -> categoryObj -> getCategoryById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('waseet/viewCategory.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Waseet_Form_Category($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$categoryData = array('title' => $_POST[$language_id]['title'], 'description' => $_POST[$language_id]['description'], 'locale_id' => $language_id, );
					$locale_id = $language_id;
					continue;
				} else if ($language_id == 'optional_' . $locale_id) {
					$categoryData['options'] = json_encode($_POST[$language_id]['options']);
					$categoryData['comments'] = $_POST[$language_id]['comments'];

				}
				if ($flag === true) {
					$categoryId = $this -> categoryObj -> insert($categoryData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $categoryId);
					$this -> categoryObj -> update(array('hash_key' => $hash_key), '`id` = ' . $categoryId);
					$flag = false;
				} else {
					$categoryData['hash_key'] = $hash_key;
					$this -> categoryObj -> insert($categoryData);
				}
			}
			header('Location: /admin/handle/pkg/waseet-category/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('waseet/addCategory.phtml');
		exit();
	}

	public function editAction() {
		$form = new Waseet_Form_SimpleCategory($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$categoryId = (int)$_POST['mandatory']['id'];

			$categoryData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'locale_id' => $_POST['mandatory']['locale_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> categoryObj -> update($categoryData, '`id` = ' . $categoryId);

			header('Location: /admin/handle/pkg/waseet-category/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$categoryObjResult = $this -> categoryObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($categoryObjResult !== false) {
					$categoryObjResult['options'] = json_decode($categoryObjResult['options']);

					$form -> populate($categoryObjResult);
				} else {
					header('Location: /admin/handle/pkg/waseet-category/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('waseet/updateCategory.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> categoryId -> value)) {
			foreach ($this -> view -> sanitized -> categoryId -> value as $id => $value) {
				$where = $this -> categoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> categoryObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/waseet-category/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/waseet-category/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/waseet-category/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> categoryObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> categoryObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$categoryListResult = $this -> categoryObj -> getAllCategory_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$categoryListResult = $this -> categoryObj -> getAllCategory_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> categoryObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($categoryListResult) and false == $categoryListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> categoryList = $categoryListResult;
		$this -> view -> render('waseet/listCategory.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> categoryObj -> getAllCategory();
		$this -> exportSQL2CSV($allData, array('id', 'title', 'description', 'locale_id', 'hash_key', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Waseet_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> categoryObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/waseet-category/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('waseet/addCategory.phtml');
		exit();
	}

}
