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
 * in the future. If you wish to customize Aulaula for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Object
 * @subpackage Controller
 * @name Object_Controller_Static
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_Static extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $staticObj = NULL;

	//theme objects
	/*private $themeObj = NULL;
	 private $layoutObj = NULL;
	 private $skinObj = NULL;
	 private $templateObj = NULL;

	 //locale object
	 private $lcoaleObj = NULL;

	 //category object
	 private $categoryObj = NULL;*/

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> staticObj = new Object_Model_Static();

		//theme objects
		/*$this -> templateObj = new Theme_Model_Template();
		 $this -> layoutObj = new Theme_Model_Layout();
		 $this -> skinObj = new Theme_Model_Skin();

		 //locale and category objects
		 $this -> localeObj = new Locale_Model_Default();
		 $this -> categoryObj = new Category_Model_Default();

		 $this -> defualtAction = 'list';

		 $this -> view -> sanitized = $_POST;
		 $this -> view -> _init();
		 $this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'staticId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleStatic' => array('text', 1), 'aliasStatic' => array('text', 1), 'introTextStatic' => array('', 0), 'fullTextStatic' => array('', 1), 'urlStatic' => array('url', 1, $this -> staticObj -> url), 'sourceStatic' => array('numericUnsigned', 0, $this -> objectObj -> source), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> staticObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> staticObj -> published), 'approved' => array('text', 0, $this -> staticObj -> approved), 'comment' => array('text', 0, $this -> staticObj -> comments), 'option' => array('text', 0, $this -> staticObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		 $this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		 if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
		 $this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		 }
		 if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
		 $this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		 }
		 $this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		 $this -> view -> sanitized['locale']['value'] = 1;
		 if (isset($_GET['id']) and is_numeric($_GET['id'])) {
		 $result = $this -> staticObj -> getObject_staticDetailsById(( int )$_GET['id']);
		 $result = $result[0];
		 if (empty($this -> view -> sanitized['category']['value'])) {
		 $this -> view -> sanitized['category']['value'] = $result['category_id'];
		 }
		 }
		 //category list
		 $this -> categoryList = '';
		 $this -> categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		 if (!empty($this -> categoryListResult)) {
		 foreach ($this->categoryListResult as $key => $value) {
		 $selectedItem = ($value['id'] == $this -> view -> sanitized['category']['value']) ? 'selected="selected"' : '';
		 $this -> categoryList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
		 }
		 }
		 $this -> view -> categoryList = $this -> categoryList;

		 //template list
		 $this -> templateList = '';
		 $this -> templateListResult = $this -> templateObj -> getAllTheme_templateOrderById();
		 if (!empty($this -> templateListResult)) {
		 foreach ($this->templateListResult as $key => $value) {
		 $selectedItem = ($value['id'] == $this -> view -> sanitized['template']['value']) ? 'selected="selected"' : '';
		 $this -> templateList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
		 }
		 }
		 $this -> view -> templateList = $this -> templateList;

		 //layout list
		 $this -> layoutList = '';
		 $this -> layoutListResult = $this -> layoutObj -> getAllTheme_layoutOrderById();
		 if (!empty($this -> layoutListResult)) {
		 foreach ($this->layoutListResult as $key => $value) {
		 $selectedItem = ($value['id'] == $this -> view -> sanitized['layout']['value']) ? 'selected="selected"' : '';
		 $this -> layoutList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
		 }
		 }
		 $this -> view -> layoutList = $this -> layoutList;

		 //skin list
		 $this -> skinList = '';
		 $this -> skinListResult = $this -> skinObj -> getAllTheme_skinOrderById();
		 if (!empty($this -> skinListResult)) {
		 foreach ($this->skinListResult as $key => $value) {
		 $selectedItem = ($value['id'] == $this -> view -> sanitized['skin']['value']) ? 'selected="selected"' : '';
		 $this -> skinList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
		 }
		 }
		 $this -> view -> skinList = $this -> skinList;*/
	}

	public function listAction() {
	}

	public function viewAction() {
		if (isset($_GET['name']) AND !empty($_GET['name'])) {
			$static_name = trim($_GET['name']);
			$static_page = $this -> staticObj -> getStaticByURLAndLocaleId($static_name, $this -> fc -> settings -> locale -> default -> current -> id);
			if ($static_page) {
				if ( !empty($static_page['page_title'])) $this -> view -> pageTitle = $static_page['page_title'];  
				if ( !empty($static_page['meta_key'])) $this -> view -> metaKeywords = $static_page['meta_key'];  
				if ( !empty($static_page['meta_desc'])) $this -> view -> metaDescription = $static_page['meta_desc'];  

				$this -> view -> staticPage = $static_page;
				$this -> view -> render('static.phtml');
				exit;
			}
		}
		header('Location: /');
		exit();
	}

	public function printAction() {
	}

	public function shareAction() {
	}

	public function saveAction() {
	}

	public function sendToFriendAction() {
	}

}
