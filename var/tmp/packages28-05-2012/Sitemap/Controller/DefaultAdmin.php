<?php

class Sitemap_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $articleObj = NULL;

	protected function _init() {
		$this -> articleObj = new Object_Model_Article();
		$this -> categoryObj = new Category_Model_Default();
		$this -> defualtAdminAction = 'view';
	}

	public function viewAction() {
	}

	public function generateAction() {
	}

}
