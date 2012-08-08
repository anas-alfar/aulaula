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
 * @name Object_Controller_StaticAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_StaticAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $staticObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();
		$this -> staticObj = new Object_Model_Static();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'staticId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleStatic' => array('text', 1), 'aliasStatic' => array('text', 1), 'introTextStatic' => array('', 0), 'fullTextStatic' => array('', 1), 'urlStatic' => array('url', 1, $this -> staticObj -> url), 'sourceStatic' => array('numericUnsigned', 0, $this -> objectObj -> source), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> staticObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> staticObj -> published), 'approved' => array('text', 0, $this -> staticObj -> approved), 'comment' => array('text', 0, $this -> staticObj -> comments), 'option' => array('text', 0, $this -> staticObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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
			$result = $this -> staticObj -> select() -> where('`id` = ?', (int)$_GET['id']) -> query() -> fetch();
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
		}
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> staticObj -> getStaticById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewStatic.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Object_Form_AddStatic($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
				
			$objectInfoData = array();
			$flag = true;
			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {
					$objectData = array('title' => $_POST[$language_id]['title'], 'author_id' => $this -> userId, 'published' => $_POST[$language_id]['published'], 'approved' => $_POST[$language_id]['approved'], 'locale_id' => $language_id, );

					$objectStaticData = array(
					'alias' => $_POST[$language_id]['alias'], 
					'url' => $_POST[$language_id]['url'], 
					'intro_text' => $_POST[$language_id]['intro_text'], 
					'full_text' => $_POST[$language_id]['full_text'], 
					'author_id' => $this -> userId, 
					);
					$locale_id = $language_id;

					continue;

				} else if ($language_id == 'optional_' . $locale_id) {
					$objectData['guid_url'] = $_POST['optional_' . $locale_id]['guid_url'];
					$objectData['original_author'] = $_POST['optional_' . $locale_id]['original_author'];
					$objectData['parent_id'] = $_POST['optional_' . $locale_id]['parent_id'];
					$objectData['show_in_list'] = $_POST['optional_' . $locale_id]['show_in_list'];
					$objectData['created_date'] = $_POST['optional_' . $locale_id]['created_date'];
					$objectData['object_source_id'] = $_POST['optional_' . $locale_id]['object_source_id'];
					$objectData['object_type_id'] = $_POST['optional_' . $locale_id]['object_type_id'];
					$objectData['category_id'] = $_POST['optional_' . $locale_id]['category_id'];
					$objectData['tags'] = $_POST['optional_' . $locale_id]['tags'];

					$objectInfoData['options'] = json_encode($_POST['optional_' . $locale_id]['options']);
					$objectInfoData['comments'] = $_POST['optional_' . $locale_id]['comments'];

					$objectStaticData['publish_from'] = $_POST['optional_' . $locale_id]['publish_from'];
					$objectStaticData['publish_to'] = $_POST['optional_' . $locale_id]['publish_to'];

					continue;

				} else if ($language_id == 'meta_' . $locale_id) {
					$objectData['page_title'] = $_POST['meta_' . $locale_id]['page_title'];
					$objectData['meta_title'] = $_POST['meta_' . $locale_id]['meta_title'];
					$objectData['meta_key'] = $_POST['meta_' . $locale_id]['meta_key'];
					$objectData['meta_desc'] = $_POST['meta_' . $locale_id]['meta_desc'];
					$objectData['meta_data'] = $_POST['meta_' . $locale_id]['meta_data'];
				}
				
				if ($flag === true) {

					$lastInsertObjectId = $this -> objectObj -> insert($objectData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $lastInsertObjectId);
					$this -> objectObj -> update(array('hash_key' => $hash_key), '`id` = ' . $lastInsertObjectId);
					
					$objectInfoData['object_id'] = $lastInsertObjectId;
					$this -> objectInfoObj -> insert($objectInfoData);

					$objectStaticData['object_id'] = $lastInsertObjectId;
					$lastInsertIdStatic = $this -> staticObj -> insert($objectStaticData);
					$flag = false;
				
				} else {

					$objectData['hash_key'] = $hash_key;
					$lastInsertObjectId = $this -> objectObj -> insert($objectData);

					$objectInfoData['object_id'] = $lastInsertObjectId;
					$this -> objectInfoObj -> insert($objectInfoData);

					$objectStaticData['object_id'] = $lastInsertObjectId;
					$lastInsertIdStatic = $this -> staticObj -> insert($objectStaticData);
				}
				
			}
			header('Location: /admin/handle/pkg/object-static/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addStatic.phtml');
		exit();
	}

	public function editAction() {
		$form = new Object_Form_Static($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectStaticId = (int)$_POST['mandatory']['id'];
			$staticObjResult = $this -> staticObj -> select() -> where('`id` = ?', $objectStaticId) -> query() -> fetch();

			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this->fc->settings->locale->default->current->id, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$this -> objectObj -> update($objectData, '`id` = ' . $staticObjResult['object_id']);

			$objecdInfoData = array('object_id' => $staticObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $staticObjResult['object_id']);

			$objectStaticData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'alias' => $_POST['mandatory']['alias'], 'url' => $_POST['mandatory']['url'], 'intro_text' => $_POST['mandatory']['intro_text'], 'full_text' => $_POST['mandatory']['full_text'], 'author_id' => $this -> userId, 'object_id' => $staticObjResult['object_id'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
			$this -> staticObj -> update($objectStaticData, '`id` = ' . $objectStaticId);

			header('Location: /admin/handle/pkg/object-static/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$staticObjResult = $this -> staticObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $staticObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $staticObjResult['object_id']) -> query() -> fetch();

				if ($staticObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					unset($objResult['id']);
					unset($staticObjResult['published']);
					unset($staticObjResult['approved']);
					unset($staticObjResult['comments']);
					unset($staticObjResult['options']);
					unset($staticObjResult['category_id']);
					unset($staticObjResult['created_date']);
					unset($objInfoObjResult['id']);

					$publish_from = explode(' ', $staticObjResult['publish_from']);
					$publish_to = explode(' ', $staticObjResult['publish_to']);
					$created_date = explode(' ', $objResult['created_date']);
					$staticObjResult['publish_from'] = $publish_from[0];
					$staticObjResult['publish_to'] = $publish_to[0];
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($staticObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-static/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/updateStatic.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> staticId -> value)) {
			foreach ($this->view->sanitized->staticId->value as $id => $value) {
				$where = $this -> staticObj -> getAdapter() -> quoteInto('id = ?', $id);
				$staticDelete = $this -> staticObj -> delete($where);
			}
			if (!empty($staticDelete)) {
				header('Location: /admin/handle/pkg/object-static/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-static/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> staticId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->staticId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> staticObj -> getAdapter() -> quoteInto('id = ?', $id);
				$staticPublish = $this -> staticObj -> update($data, $where);
			}
			if (!empty($staticPublish)) {
				header('Location: /admin/handle/pkg/object-static/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-static/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> staticId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->staticId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> staticObj -> getAdapter() -> quoteInto('id = ?', $id);
				$staticAprrove = $this -> staticObj -> update($data, $where);
			}
			if (!empty($staticAprrove)) {
				header('Location: /admin/handle/pkg/object-static/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-static/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-static/action/';

		if (!empty($_GET['success'])) {
			$this -> view -> successMessageStyle = 'display: block;';
			switch ($_GET['success']) {
				case 'approve' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
					break;
				case 'publish' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
					break;
				case 'delete' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
					break;
			}
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this->staticObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> staticObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$staticListResult = $this -> staticObj -> getAllStatic_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$staticListResult = $this -> staticObj -> getAllStatic_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> staticObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($staticListResult) and false == $staticListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $staticListResult;
		$this -> view -> render('object/listStaticObject.phtml');
		exit();
	}

}
