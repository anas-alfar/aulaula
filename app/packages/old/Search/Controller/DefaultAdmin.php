<?php

class Search_Controller_DefaultAdmin extends Aula_Controller_Action {

	protected function _init() {

	}

	public function addAction() {
	}

	public function editAction() {
	}

	public function deleteAction() {
	}

	public function resultAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function formAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function viewAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function listAction() {
		$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
		$this -> view -> notificationMessageStyle = 'display: block;';
	}

}
