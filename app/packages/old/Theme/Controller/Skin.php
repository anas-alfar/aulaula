<?php

class Theme_Controller_Skin extends Aula_Controller_Action {

	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $layoutInfoObj = NULL;
	private $skinObj = NULL;
	private $skinInfoObj = NULL;
	private $templateObj = NULL;
	private $templateInfoObj = NULL;

	protected function _init() {
		$this -> skinObj = new Theme_Model_Skin();
		$this -> skinInfoObj = new Theme_Model_SkinInfo();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'skinId' => array('numeric', 0), 'template' => array('numeric', 0), 'layout' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 0), 'published' => array('text', 0, $this -> skinObj -> published), 'approved' => array('text', 0, $this -> skinObj -> approved), 'default' => array('text', 0, $this -> skinObj -> default), 'order' => array('numericUnsigned', 0, $this -> skinObj -> order), 'afterId' => array('numeric', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'comment' => array('text', 0, $this -> skinObj -> comments), 'option' => array('text', 0, $this -> skinObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//order list
		$this -> skinList = '';
		$this -> skinListResult = $this -> skinObj -> getAllTheme_skinOrderById();
		if (!empty($this -> directionListResult)) {
			foreach ($this->skinListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> skinList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> skinList = $this -> skinList;
	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function previewAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function saveAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

}
