<?php

class Vehicle_Controller_ModelAdmin extends Aula_Controller_Action {

	private $modelObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	protected function _init() {
		//default objects
		$this -> modelObj = new Vehicle_Model_Model();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'modelId' => array('numeric', 0), 'id' => array('numeric', 0), 'vehicleTypeId' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> modelObj -> comments), 'option' => array('text', 0, $this -> modelObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		
		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-model/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-model/action/exportcsv/';
	}

	public function addAction() {
		$form = new Vehicle_Form_Model($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$modelData = array(
			'title' => $_POST['mandatory']['title'], 
			'description' => $_POST['mandatory']['description'], 
			'vehicle_make_id' => $_POST['mandatory']['vehicle_make_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> modelObj -> insert($modelData);

			header('Location: /admin/handle/pkg/vehicle-model/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addModel.phtml');
		exit();
	}

	public function editAction() {
		$form = new Vehicle_Form_Model($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$modelId = (int)$_POST['mandatory']['id'];

			$modelData = array('title' => $_POST['mandatory']['title'], 'description' => $_POST['mandatory']['description'], 'vehicle_make_id' => $_POST['mandatory']['vehicle_make_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> modelObj -> update($modelData, '`id` = ' . $modelId);

			header('Location: /admin/handle/pkg/vehicle-model/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$modelObjResult = $this -> modelObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();

				if ($modelObjResult !== false) {
					$modelObjResult['options'] = json_decode($modelObjResult['options']);

					$form -> populate($modelObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-model/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateModel.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> modelId -> value)) {
			foreach ($this -> view -> sanitized -> modelId -> value as $id => $value) {
				$where = $this -> modelObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> modelObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-model/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-model/action/list/');
		exit();
	}
	
	public function recordsAction() {
		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');
		
		$typeObj = new Vehicle_Model_Type();
		$makeObj = new Vehicle_Model_Make();

		$vehicleTypeObjResult = $typeObj -> select() -> from(array('vehicle_type'), array('id')) -> query() -> fetchAll();
		foreach ($vehicleTypeObjResult as $key => $id) {
			$vehicleMakeObjResult = $makeObj -> select() -> from(array('vehicle_make'), array('id', 'title', 'vehicle_type_id')) -> where('`vehicle_type_id` = ?', $id) -> query() -> fetchAll();
			foreach ($vehicleMakeObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['vehicle_type_id'] => $value['title']));
			}
		}
		echo $data;
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-model/action/';

		if (!empty($_GET['success']) AND $_GET['success'] == 'delete') {
			$this -> view -> successMessageStyle = 'display: block;';
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> modelObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> modelObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$modelListResult = $this -> modelObj -> getAllModel_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$modelListResult = $this -> modelObj -> getAllModel_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> modelObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		//$this -> pagingObj -> _init($this -> modelObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($modelListResult) and false == $modelListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> modelList = $modelListResult;
		$this -> view -> render('vehicle/listModel.phtml');
		exit();
	}

	public function exportcsvAction() {
		set_time_limit(0);
		$allData = $this -> modelObj -> getAllModel();
		$this -> exportSQL2CSV($allData, array('id', 'vehicle_make_id', 'title', 'description', 'vehicle_make_title', 'locale_id', 'comments', 'options'), __CLASS__);
	}

	public function importcsvAction() {
		$form = new Vehicle_Import_CSV($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload('file');
			if ($uploadObj -> CheckIfThereIsFile() === true) {
				if ($uploadObj -> validatedMime()) {
					if ($uploadObj -> validatedSize()) {
						$result = $this -> importCSV2SQL($_FILES['file']['tmp_name'], $this -> modelObj);
						if ($result == true) {
							header('Location: /admin/handle/pkg/vehicle-model/action/list/');
							exit();
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addModel.phtml');
		exit();
	}

}
