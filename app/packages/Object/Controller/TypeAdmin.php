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
 * @name Object_Controller_TypeAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_TypeAdmin extends Aula_Controller_Action {

	private $typeObj = NULL;
	private $typeIfnoObj = NULL;

	protected function _init() {
		// type
		$this -> typeObj = new Object_Model_Type();

		// type info
		$this -> typeInfoObj = new Object_Model_TypeInfo();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'typeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'titleArticle' => array('text', 0), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('text', 0), 'fullTextArticle' => array('text', 0), 'sourceArticle' => array('numeric', 0), 'createdDateArticle' => array('longDateTime', 0), 'publishFromArticle' => array('longDateTime', 0), 'publishToArticle' => array('longDateTime', 0), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('longDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('longDateTime', 0), 'publishToPhoto' => array('longDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('longDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('longDateTime', 0), 'publishToVideo' => array('longDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('numeric', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('longDateTime', 0), 'publishFromStatic' => array('longDateTime', 0), 'publishToStatic' => array('longDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parentDirectory' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'showInList' => array('text', 0), 'published' => array('text', 0), 'approved' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('longDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('longDateTime', 0), 'publishFrom' => array('longDateTime', 0), 'publishTo' => array('longDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//locale list
		$this -> afterIdList = '';
		//$this -> afterIdListResult = $this -> typeObj -> getAllObject_typeOrderById();
		$this -> afterIdListResult = $this -> typeObj -> select() -> query() -> fetchAll();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> localeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;

	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> typeObj -> getTypeById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewType.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Object_Form_AddType($this -> view);
		$form -> setView($this -> view);
		if (!empty($_POST) and $form -> isValid($_POST)) {

			$objectTypeInfoData = array();
			$flag = true;
			foreach ($_POST as $language_id => $value) {

				if (is_numeric($language_id)) {

					$objectTypeData = array('title' => $_POST[$language_id]['title'], 'label' => $_POST[$language_id]['label'], 'description' => $_POST[$language_id]['description'], 'published' => $_POST[$language_id]['published'], 'approved' => $_POST[$language_id]['approved'], 'author_id' => $this -> userId, 'locale_id' => $language_id, );
					$locale_id = $language_id;

					continue;

				} else if ($language_id == 'optional_' . $locale_id) {

					$objectTypeInfoData['publish_from'] = $_POST['optional_' . $locale_id]['publish_from'];
					$objectTypeInfoData['publish_to'] = $_POST['optional_' . $locale_id]['publish_to'];
					$objectTypeInfoData['options'] = json_encode($_POST['optional_' . $locale_id]['options']);
					$objectTypeInfoData['comments'] = $_POST['optional_' . $locale_id]['comments'];
				}

				if ($flag === true) {

					$lastInsertIdType = $this -> typeObj -> insert($objectTypeData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdType);
					$this -> typeObj -> update(array('hash_key' => $hash_key), '`id` = ' . $lastInsertIdType);

					$objectTypeInfoData['object_type_id'] = $lastInsertIdType;
					$this -> typeInfoObj -> insert($objectTypeInfoData);

					$flag = false;

				} else {

					$objectTypeData['hash_key'] = $hash_key;
					$lastInsertIdType = $this -> typeObj -> insert($objectTypeData);

					$objectTypeInfoData['object_type_id'] = $lastInsertIdType;
					$this -> typeInfoObj -> insert($objectTypeInfoData);
				}

			}
			header('Location: /admin/handle/pkg/object-type/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addType.phtml');
		exit();
	}

	public function editAction() {
		$form = new Object_Form_Type($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {
			$objectTypeId = (int)$_POST['mandatory']['id'];

			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$dataType = array('title' => $_POST['mandatory']['title'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$dataTypeInfo = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], 'comments' => $_POST['optional']['comments'], 'options' => $_POST['optional']['options']);
			$this -> typeObj -> update($dataType, '`id` = ' . $objectTypeId);
			$this -> typeInfoObj -> update($dataTypeInfo, '`object_type_id` = ' . $objectTypeId);
			header('Location: /admin/handle/pkg/object-type/action/list');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$typeObjResult = $this -> typeObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$typeInfoObjResult = $this -> typeInfoObj -> select() -> where('`object_type_id` = ?', $_GET['id']) -> query() -> fetch();
				if ($typeObjResult !== false And $typeInfoObjResult !== false) {
					unset($typeInfoObjResult['id']);
					$publish_from = explode(' ', $typeInfoObjResult['publish_from']);
					$publish_to = explode(' ', $typeInfoObjResult['publish_to']);
					$typeInfoObjResult['publish_from'] = $publish_from[0];
					$typeInfoObjResult['publish_to'] = $publish_to[0];
					$typeInfoObjResult['options'] = json_decode($typeInfoObjResult['options']);

					$form -> populate($typeObjResult);
					$form -> populate($typeInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-type/action/list');
					exit();
				}
			}
		}

		$this -> view -> form = $form;
		$this -> view -> render('object/updateType.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> typeId -> value)) {
			foreach ($this->view->sanitized->typeId->value as $id => $value) {
				//$typeDelete = $this -> typeObj -> deleteFromObject_typeById($id);
				$where = $this -> typeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$typeDelete = $this -> typeObj -> delete($where);
			}
			if (!empty($typeDelete)) {
				header('Location: /admin/handle/pkg/object-type/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-type/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> typeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->typeId->value as $id => $value) {
				//$typePublish = $this -> typeObj -> updateObject_typePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> typeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$typePublish = $this -> typeObj -> update($data, $where);
			}
			if (!empty($typePublish)) {
				header('Location: /admin/handle/pkg/object-type/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-type/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> typeId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->typeId->value as $id => $value) {
				//$typeAprrove = $this -> typeObj -> updateObject_typeApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> typeObj -> getAdapter() -> quoteInto('id = ?', $id);
				$typeAprrove = $this -> typeObj -> update($data, $where);
			}
			if (!empty($typeAprrove)) {
				header('Location: /admin/handle/pkg/object-type/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-type/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-type/action/';

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
				case 'showInObject' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
					break;
			}
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this->typeObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> typeObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$typeListResult = $this -> typeObj -> getAllObject_TypeOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$typeListResult = $this -> typeObj -> getAllObject_TypeOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> typeObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($typeListResult) and false == $typeListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}
		$this -> view -> objectList = $typeListResult;
		$this -> view -> render('object/listObjectType.phtml');
		exit();

	}

}
