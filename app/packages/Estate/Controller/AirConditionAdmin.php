<?php

class Estate_Controller_AirConditionAdmin extends Aula_Controller_Action {

	private $airConditionObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> airConditionObj = new Estate_Model_AirCondition();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'airConditionId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> airConditionObj -> comments), 'option' => array('text', 0, $this -> airConditionObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/estate-air-condition/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/estate-air-condition/action/exportcsv/';
	}

	public function addAction() {
		$form = new Estate_Form_AirCondition($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$airConditionData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> airConditionObj -> insert($airConditionData);

			header('Location: /admin/handle/pkg/estate-air-condition/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/addAirCondition.phtml');
		exit();
	}

	public function editAction() {
		$form = new Estate_Form_AirCondition($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$airConditionId = (int)$_POST['mandatory']['id'];

			$airConditionData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> airConditionObj -> update($airConditionData, '`id` = ' . $airConditionId);

			header('Location: /admin/handle/pkg/estate-air-condition/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$airConditionObjResult = $this -> airConditionObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($airConditionObjResult !== false) {
					$airConditionObjResult['options'] = json_decode($airConditionObjResult['options']);

					$form -> populate($airConditionObjResult);
				} else {
					header('Location: /admin/handle/pkg/estate-air-condition/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/updateAirCondition.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> airConditionId -> value)) {
			foreach ($this -> view -> sanitized -> airConditionId -> value as $id => $value) {
				$where = $this -> airConditionObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> airConditionObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/estate-air-condition/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/estate-air-condition/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/estate-air-condition/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> airConditionObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> airConditionObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$airConditionListResult = $this -> airConditionObj -> getAllAirCondition_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$airConditionListResult = $this -> airConditionObj -> getAllAirCondition_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> airConditionObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($airConditionListResult) and false == $airConditionListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> airConditionList = $airConditionListResult;
		$this -> view -> render('estate/listAirCondition.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> airConditionObj -> getAllAirCondition();
		$this -> exportSQL2CSV($allData, array('id', 'title', 'description', 'locale_id', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Estate_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> airConditionObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/estate-air-condition/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('estate/addLivenear4.phtml');
		exit();
	}

}
