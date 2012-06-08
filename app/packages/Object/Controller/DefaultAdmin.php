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
 * @name Object_Controller_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $mediaCount = array(1, 2, 3);

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'objectId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'titleArticle' => array('text', 0), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('text', 0), 'fullTextArticle' => array('text', 0), 'sourceArticle' => array('numeric', 0), 'createdDateArticle' => array('longDateTime', 0), 'publishFromArticle' => array('longDateTime', 0), 'publishToArticle' => array('longDateTime', 0), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('longDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('longDateTime', 0), 'publishToPhoto' => array('longDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('longDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('longDateTime', 0), 'publishToVideo' => array('longDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('numeric', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('longDateTime', 0), 'publishFromStatic' => array('longDateTime', 0), 'publishToStatic' => array('longDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parentDirectory' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'category' => array('numeric', 1), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'showInList' => array('text', 0), 'published' => array('text', 0), 'approved' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('longDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('longDateTime', 0), 'publishFrom' => array('longDateTime', 0), 'publishTo' => array('longDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function addAction() {
		$form = new Object_Form_Default($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectData = array('title' => $_POST['optional']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['optional']['published'], 'approved' => $_POST['optional']['approved']);
			$objectLastInsertId = $this -> objectObj -> insert($objectData);

			if ($objectLastInsertId !== false) {
				$objecdInfoData = array('object_id' => $objectLastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
				$objectInfoLastInsertId = $this -> objectInfoObj -> insert($objecdInfoData);

				if ($objectInfoLastInsertId !== false) {
					$objectArticleData = array('alias' => $_POST['article']['alias'], 'intro_text' => $_POST['article']['intro_text'], 'full_text' => $_POST['article']['full_text'], 'author_id' => $this -> userId, 'object_id' => $objectLastInsertId, );
					$objectArticleLastInsertId = $this -> articleObj -> insert($objectArticleData);

					if ($objectArticleLastInsertId !== false) {
						/*$stmt = $this -> sourceObj -> getAdapter() -> prepare('UPDATE object_source SET `order`=`order`+1 WHERE `order` >= ?');
						 $stmt -> execute(array($_POST['source']['order']));

						 $objectSourceData = array('name' => $_POST['source']['name'], 'description' => $_POST['source']['description'], 'source_type' => $_POST['source']['source_type'], 'url' => $_POST['source']['url'], 'order' => $_POST['source']['order'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'author_id' => $_POST['source']['author_id'] = $this -> userId, 'time_delay' => $_POST['source']['time_delay'], 'published' => $_POST['source']['published'], 'approved' => $_POST['source']['approved'], );
						 $objectSourceLastInsertId = $this -> sourceObj -> insert($objectSourceData);
						 $objectSourceInfoData = array('object_source_id' => $objectSourceLastInsertId, 'publish_from' => $_POST['source']['publish_from'], 'publish_to' => $_POST['source']['publish_to'], 'comments' => $_POST['source']['comments'], 'options' => json_encode($_POST['source']['options']), );
						 $this -> sourceInfoObj -> insert($objectSourceInfoData);*/

						$_POST['file']['object_id'] = $objectLastInsertId;
						$fileAdmin = new Object_Controller_FileAdmin($this -> fc);
						$fileUploadedSuccessfully = $fileAdmin -> import($_POST['file']);

						if ($fileUploadedSuccessfully === true) {

							$_POST['video']['object_id'] = $objectLastInsertId;
							$videoAdmin = new Object_Controller_VideoAdmin($this -> fc);
							$videoUploadedSuccessfully = $videoAdmin -> import($_POST['video']);

							if ($videoUploadedSuccessfully === true) {

								foreach ($this->mediaCount as $value) {
									$_POST['photo_' . $value]['object_id'] = $objectLastInsertId;
									$photoAdmin = new Object_Controller_PhotoAdmin($this -> fc);
									$photoUploadedSuccessfully = $photoAdmin -> import($_POST['photo_' . $value], 'photo_' . $value);
								}

								header('Location: /admin/handle/pkg/object/action/list/');
								exit();
							}
						}
					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/add.phtml');
		exit();

	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> objectId -> value)) {
			foreach ($this->view->sanitized->objectId->value as $id => $value) {
				$objectDelete = $this -> objectObj -> deleteObjectById($id);
			}
			if (!empty($objectDelete)) {
				header('Location: /admin/handle/pkg/object/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object/action/list/');
		exit();
	}

	public function showInListAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> objectId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->objectId->value as $id => $value) {
				$data = array('show_in_list' => $this -> view -> sanitized -> status -> value);
				$where = $this -> objectObj -> getAdapter() -> quoteInto('id = ?', $id);
				$objectShowInList = $this -> objectObj -> update($data, $where);
			}
			if (!empty($objectShowInList)) {
				header('Location: /admin/handle/pkg/object/action/list/success/show_in_list');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> objectId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->objectId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> objectObj -> getAdapter() -> quoteInto('id = ?', $id);
				$objectPublish = $this -> objectObj -> update($data, $where);
			}
			if (!empty($objectPublish)) {
				header('Location: /admin/handle/pkg/object/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> objectId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->objectId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> objectObj -> getAdapter() -> quoteInto('id = ?', $id);
				$objectApproved = $this -> objectObj -> update($data, $where);
			}
			if (!empty($objectApproved)) {
				header('Location: /admin/handle/pkg/object/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object/action/';

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
				case 'show_in_list' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
					break;
			}
		}

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this->objectObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> objectObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$objectListResult = $this -> objectObj -> getAllObject_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$objectListResult = $this -> objectObj -> getAllObject_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> objectObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($objectListResult) and false == $objectListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		} else {
			foreach ($objectListResult as $key => $value) {
				if (!empty($value['object_photo_id'])) {
					$photoDate = explode('-', $value['object_photo_date_added'], 3);
					$photoSRC = parent::$encryptedUrl['photo']['thumb'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['object_photo_id']) . '.jpg?x=' . rand(0, 1000);
					$largePhotoSRC = parent::$encryptedUrl['photo']['large'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['object_photo_id']) . '.jpg?x=' . rand(0, 1000);
					$objectListResult[$key]['photoSRC'] = $photoSRC;
					$objectListResult[$key]['largePhotoSRC'] = $largePhotoSRC;
				}
				if (!empty($value['object_video_id'])) {
					$fileDate = explode('-', $value['object_video_date_added'], 3);
					$thumbURL = parent::$encryptedUrl['video']['thumb'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['object_video_id']) . '.jpg?r=' . rand(0, 1000) . '<br /><br />';
					$flvURL = parent::$encryptedUrl['video']['flv'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['object_video_id']) . $value['object_video_extension'];
					$objectListResult[$key]['thumbURL'] = $thumbURL;
					$objectListResult[$key]['flvURL'] = $flvURL;
				}
				if (!empty($value['object_file_id'])) {
					$fileDate = explode('-', $value['object_file_date_added'], 3);
					$fileURL = parent::$encryptedUrl['file'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['object_file_id']) . $value['object_file_extension'];
					$objectListResult[$key]['fileURL'] = $fileURL;
				}
			}
		}
		$this -> view -> objectList = $objectListResult;

		$this -> view -> render('object/listObject.phtml');
		exit();
	}

}
