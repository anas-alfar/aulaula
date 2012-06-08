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
 * @package Aula_Object
 * @subpackage Controller
 * @name Object_Controller_Comment
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_Comment extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $commentObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();
		//objects
		$this -> commentObj = new Object_Model_Comment();
		$this -> articleObj = new Object_Model_Article();
		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();

		/* @var $fields Object_Controller_Comment */
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'object' => array('numericUnsigned', 0), 'dateAddedFromSearch' => array('text', 0), 'dateAddedToSearch' => array('text', 0), 'publishedSearch' => array('text', 0), 'approvedSearch' => array('text', 0), 'articleTitleSearch' => array('text', 0), 'userIdSearch' => array('text', 0), 'contentSearch' => array('text', 0), 'btn_search' => array('text', 0), 'webpage' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'emailSearch' => array('text', 0), 'status' => array('text', 0), 'title' => array('text', 0), 'content' => array('text', 0), 'commentId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'userId' => array('text', 0), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleComment' => array('text', 0), 'emailComment' => array('email', 0), 'email' => array('email', 0), 'webpageComment' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'contentComment' => array('', 1), 'approved' => array('text', 0, $this -> commentObj -> approved), 'published' => array('text', 0, $this -> commentObj -> approved), 'comment' => array('text', 0, $this -> commentObj -> comments), 'option' => array('text', 0, $this -> commentObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['author']['value'] = 1;
		$this -> view -> sanitized['locale']['value'] = 1;

		//objects list
		$this -> objectList = '';
		/*$this->objectListResult = $this->objectObj->getAllObjectOrderById ();
		 if (! empty ( $this->objectListResult )) {
		 foreach ( $this->objectListResult as $key => $value ) {
		 $selectedItem = ($value ['id'] == $this->view->sanitized ['object'] ['value']) ? 'selected="selected"' : '';
		 $this->objectList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
		 }
		 }*/
		$this -> view -> objectList = $this -> objectList = array();
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$objectId = $this -> articleObj -> getObject_articleDetailsById(( int )$_GET['article-id']);
				$objectId = $objectId[0]['object_id'];
				$result = $this -> commentObj -> insertIntoObject_comment(Null, $objectId, $this -> view -> sanitized -> userId -> value, $this -> view -> sanitized -> titleComment -> value, $this -> view -> sanitized -> contentComment -> value, "", $this -> view -> sanitized -> webpageComment -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					header('Location: /object-article/comments-thanks/id/' . ( int )$_GET['article-id']);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on add record');
				}
			}
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}

		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
			header('Location: /object-article/view/id/' . ( int )$_GET['article-id'] . '/comment/error#commentErrorMessage');
			exit();
		}
	}

	public function listAction() {
                echo '<br />' . __FUNCTION__;
                echo '<br />' . __CLASS__;
                echo '<br />' . __METHOD__; 
                exit ();
	}

	public function viewAction() {
                echo '<br />' . __FUNCTION__;
                echo '<br />' . __CLASS__;
                echo '<br />' . __METHOD__; 
                exit ();
	}

}
