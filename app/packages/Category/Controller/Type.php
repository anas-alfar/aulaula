<?php

/**
*
* Aulaula
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0) that is
* bundled with this package in the file LICENSE.txt. It is also available through
* the world-wide-web at this URL: http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to obtain it
* through the world-wide-web, please send an email to license@aulaula.com
* so we can send you a copy immediately.
*
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade Aulaula to newer versions
* in the future. If you wish to customize Magento for your needs please refer to
* http://www.aulaula.com for more information.
*
* @category Aula
* @package Aula_Category_Controller_Type
* @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
* @author Anas K. Al-Far <anas@al-far.com>
*
*/

class Category_Controller_Type extends Aula_Controller_Action {

	private $categoryObj = Null;
	private $categoryInfoObj = Null;
	private $categoryTypeObj = Null;
	private $categoryTypeInfoObj = Null;

	protected function _init() {
		$this -> categoryTypeObj = new Category_Model_Type();
		$this -> categoryTypeInfoObj = new Category_Model_TypeInfo();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'categoryTypeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 1), 'showInMenu' => array('text', 0, $this -> categoryTypeObj -> showInMenu), 'published' => array('text', 0, $this -> categoryTypeObj -> published), 'approved' => array('text', 0, $this -> categoryTypeObj -> approved), 'comment' => array('text', 0, $this -> categoryTypeInfoObj -> comments), 'option' => array('text', 0, $this -> categoryTypeInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> categoryTypeObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//Fill in types list drop down menu
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> categoryTypeObj -> getAllCategory_typeOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;
	}

	public function addAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function editAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function deleteAction() {
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

}
