<?php

class Package_Controller_Default extends Aula_Controller_Action {

	private $packageObj = Null;
	private $packageInfoObj = Null;
	private $actionObj = Null;
	private $classObj = Null;

	protected function _init() {
		$this -> packageObj = new Package_Model_Default();
		$this -> packageInfoObj = new Package_Model_Info();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'packageId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'deafultActionTitle' => array('text', 1, $this -> packageInfoObj -> defaultActionTitle), 'deafultActionName' => array('text', 1, $this -> packageInfoObj -> defaultActionName), 'version' => array('text', 1, $this -> packageInfoObj -> version), 'type' => array('text', 1, $this -> packageObj -> type), 'prerequisite' => array('numericUnsigned', 1, $this -> packageObj -> prerequisiteId), 'parent' => array('numericUnsigned', 1, $this -> packageObj -> prerequisiteId), 'defaultActionName' => array('text', 0, $this -> packageObj -> defaultActionName), 'version' => array('text', 0, $this -> packageObj -> version), 'approved' => array('text', 0, $this -> packageObj -> approved), 'published' => array('text', 0, $this -> packageObj -> published), 'showInMenu' => array('text', 0, $this -> packageObj -> showInMenu), 'comment' => array('text', 0, $this -> packageInfoObj -> comments), 'option' => array('text', 0, $this -> packageInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//type list
		$this -> packageList = '';
		$this -> packageListResult = $this -> packageObj -> getAllPackageOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->packageListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> packageList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> packageList = $this -> packageList;

		//prerequisite list
		$this -> prerequisiteList = '';
		$this -> prerequisiteListResult = $this -> packageObj -> getAllPackageOrderById();
		if (!empty($this -> packageListResult)) {
			foreach ($this->prerequisiteListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> prerequisiteList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> prerequisiteList = $this -> prerequisiteList;

		//type list
		$this -> typeList = '';
		$this -> typeListResult = array('Core' => $this -> view -> __('Core'), 'Module' => $this -> view -> __('Module'), 'Plugin' => $this -> view -> __('Plugin'));
		if (!empty($this -> typeListResult)) {
			foreach ($this->typeListResult as $key => $value) {
				$selectedItem = ($key == $this -> view -> sanitized['type']['value']) ? 'selected="selected"' : '';
				$this -> typeList .= '<option value="' . $key . '"' . $selectedItem . '>' . $value . '</option>';
			}
		}
		$this -> view -> type = $this -> typeList;

	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

}
