<?php

class Package_Controller_Class extends Aula_Controller_Action {

	private $packageObj = Null;
	private $packageInfoObj = Null;
	private $actionObj = Null;
	private $classObj = Null;

	protected function _init() {
		$this -> packageObj = new Package_Model_Default();
		$this -> classObj = new Package_Model_Class();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'Id' => array('numeric', 0), 'classId' => array('numeric', 0), 'token' => array('text', 1), 'classTitle' => array('text', 1), 'className' => array('codeConvention', 1), 'classDescription' => array('text', 1), 'fileName' => array('filePath', 1), 'package' => array('numericUnsigned', 1), 'comment' => array('text', 0, $this -> classObj -> comments), 'option' => array('text', 0, $this -> classObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//package list
		$this -> packageList = '';
		$this -> packageListResult = $this -> packageObj -> getAllPackageOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->packageListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['package']['value']) ? 'selected="selected"' : '';
				$this -> packageList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> packageList = $this -> packageList;
	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

}
