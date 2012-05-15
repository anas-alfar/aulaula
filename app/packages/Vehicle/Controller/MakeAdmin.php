<?php

class Vehicle_Controller_MakeAdmin extends Aula_Controller_Action {

	private $makeObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> makeObj = new Vehicle_Model_Make();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'makeId' => array('numeric', 0), 'id' => array('numeric', 0), 'vehicleTypeId' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> makeObj -> comments), 'option' => array('text', 0, $this -> makeObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-make/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-make/action/exportcsv/';
	}

	public function addAction() {
		$form = new Vehicle_Form_Make($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$makeData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'vehicle_type_id' => $_POST['mandatory']['vehicle_type_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> makeObj -> insert($makeData);

			header('Location: /admin/handle/pkg/vehicle-make/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addMake.phtml');
		exit();
	}

	public function editAction() {
		$form = new Vehicle_Form_Make($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$makeId = (int)$_POST['mandatory']['id'];

			$makeData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'vehicle_type_id' => $_POST['mandatory']['vehicle_type_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> makeObj -> update($makeData, '`id` = ' . $makeId);

			header('Location: /admin/handle/pkg/vehicle-make/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$makeObjResult = $this -> makeObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($makeObjResult !== false) {
					$makeObjResult['options'] = json_decode($makeObjResult['options']);

					$form -> populate($makeObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-make/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateMake.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> makeId -> value)) {
			foreach ($this -> view -> sanitized -> makeId -> value as $id => $value) {
				$where = $this -> makeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> makeObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-make/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-make/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-make/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> makeObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> makeObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$makeListResult = $this -> makeObj -> getAllMake_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$makeListResult = $this -> makeObj -> getAllMake_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> makeObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> makeObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($makeListResult) and false == $makeListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> makeList = $makeListResult;
		$this -> view -> render('vehicle/listMake.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> makeObj -> getAllMake();
		$this -> exportSQL2CSV($allData, array('id', 'vehicle_type_id', 'title', 'description', 'vehicle_type_title', 'locale_id', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Vehicle_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> makeObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/vehicle-make/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addMake.phtml');
		exit();
	}

}
