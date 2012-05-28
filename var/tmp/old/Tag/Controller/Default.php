<?php

class Tag_Controller_Default extends Aula_Controller_Action {

	private $tagObj = NULL;

	protected function _init() {
		$this -> tagObj = new Tag_Model_Default();
		
		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'tagId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'locale' => array('numericUnsigned', 0), 'titleTag' => array('text', 1), 'published' => array('text', 0, $this -> tagObj -> published), 'approved' => array('text', 0, $this -> tagObj -> approved), 'comment' => array('text', 0, $this -> tagObj -> comments), 'order' => array('numericUnsigned', 0, $this -> tagObj -> order), 'afterId' => array('numeric', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');

		//Fill in types list drop down menu
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> tagObj -> getAllTagOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;

	}

	public function checkValidAction() {
	}

	public function addAction() {
	}

	public function listAction() {
	}

	public function viewAction() {
	}

}
