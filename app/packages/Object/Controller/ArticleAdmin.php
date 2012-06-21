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
 * @name Object_Controller_ArticleAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_ArticleAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $articleObj = NULL;

	protected function _init() {

		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		$this -> articleObj = new Object_Model_Article();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'redirectURI' => array('uri', 0, ''), 'updateDate' => array('text', 0), 'youTubeVideo' => array('text', 0), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'fileAuthor' => array('fileUploaded', 0, (!empty($_FILES['fileAuthor']['name']) ? $_FILES['fileAuthor']['name'] : '')), 'aliasVideo' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'status' => array('text', 0, 'Yes'), 'articleId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'author_id' => array('numericUnsigned', 0), 'titleArticle' => array('text', 1), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('', 0), 'fullTextArticle' => array('', 1), 'sourceArticle' => array('numeric', 1), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> articleObj -> showInObject), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> articleObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> articleObj -> published), 'approved' => array('text', 0, $this -> articleObj -> approved), 'featured' => array('text', 0, 'No'), 'comment' => array('', 0, $this -> articleObj -> comments), 'option' => array('', 0, $this -> articleObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> articleObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> articleObj -> getArticleById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewArticle.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Object_Form_Article($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$stmt = $this -> articleObj -> getAdapter() -> prepare('UPDATE object_article SET `order`=`order`+1 WHERE `order` >= ?');
			$stmt -> execute(array($_POST['optional']['order']));

			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this->fc->settings->locale->default->current->id, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$lastInsertId = $this -> objectObj -> insert($objectData);

			if ($lastInsertId !== false) {
				$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
				$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);
				if ($lastInsertIdInfo !== false) {
					$objectArticleData = array('alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'full_text' => $_POST['mandatory']['full_text'], 'author_id' => $this -> userId, 'object_id' => $lastInsertId, 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
					$lastInsertIdPhoto = $this -> articleObj -> insert($objectArticleData);

					header('Location: /admin/handle/pkg/object-article/action/list/');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addArticle.phtml');
		exit();
	}

	public function editAction() {

		$form = new Object_Form_Article($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectArticleId = (int)$_POST['mandatory']['id'];
			$articleObjResult = $this -> articleObj -> select() -> where('`id` = ?', $objectArticleId) -> query() -> fetch();
			if ($articleObjResult['order'] != $_POST['optional']['order']) {
				$stmt = $this -> articleObj -> getAdapter() -> prepare('UPDATE object_article SET `order`=`order`+1 WHERE `order` >= ?');
				$stmt -> execute(array($_POST['optional']['order']));
			}
			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this->fc->settings->locale->default->current->id, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$this -> objectObj -> update($objectData, '`id` = ' . $articleObjResult['object_id']);

			$objecdInfoData = array('object_id' => $articleObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $articleObjResult['object_id']);

			$objectArticleData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'full_text' => $_POST['mandatory']['full_text'], 'author_id' => $this -> userId, 'object_id' => $articleObjResult['object_id'], 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
			$this -> articleObj -> update($objectArticleData, '`id` = ' . $objectArticleId);

			header('Location: /admin/handle/pkg/object-article/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$articleObjResult = $this -> articleObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $articleObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $articleObjResult['object_id']) -> query() -> fetch();

				if ($articleObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					unset($objResult['id']);
					unset($articleObjResult['published']);
					unset($articleObjResult['approved']);
					unset($articleObjResult['comments']);
					unset($articleObjResult['options']);
					unset($articleObjResult['meta_data']);
					unset($articleObjResult['category_id']);
					unset($articleObjResult['object_source_id']);
					unset($articleObjResult['created_date']);
					unset($objInfoObjResult['id']);

					$publish_from = explode(' ', $articleObjResult['publish_from']);
					$publish_to = explode(' ', $articleObjResult['publish_to']);
					$created_date = explode(' ', $objResult['created_date']);
					$articleObjResult['publish_from'] = $publish_from[0];
					$articleObjResult['publish_to'] = $publish_to[0];
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($articleObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-article/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/updateArticle.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articleDelete = $this -> articleObj -> delete($where);
			}
			if (!empty($articleDelete)) {
				header('Location: /admin/handle/pkg/object-article/action/list/success/delete');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$data = array('show_in_object' => $this -> view -> sanitized -> status -> value);
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articleShowInMenu = $this -> articleObj -> update($data, $where);
			}
			if (!empty($articleShowInMenu)) {
				header('Location: /admin/handle/pkg/object-article/action/list/success/showInObject');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articlePublish = $this -> articleObj -> update($data, $where);
			}
			if (!empty($articlePublish)) {
				header('Location: /admin/handle/pkg/object-article/action/list/success/publish');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articleAprrove = $this -> articleObj -> update($data, $where);
			}
			if (!empty($articleAprrove)) {
				header('Location: /admin/handle/pkg/object-article/action/list/success/approve');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-article/action/';
		
		if ($_GET['success'] == 'approve') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'publish') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'showInObject') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> articleObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> articleObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$articleListResult = $this -> articleObj -> getAllArticle_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$articleListResult = $this -> articleObj -> getAllArticle_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> articleObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($articleListResult) and false == $articleListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}
		$this -> view -> objectList = $articleListResult;
		$this -> view -> render('object/listArticleObject.phtml');
		exit();
	}

}
