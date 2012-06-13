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
 * @name Object_Controller_FileAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_FileAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $fileObj = NULL;
	private $uploadObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();
		$this -> fileObj = new Object_Model_File();

		$this -> uploadObj = new Aula_Model_Upload('uploadFile');

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'fileId' => array('numeric', 0), 'objectType' => array('numericUnsigned', 0, $this -> fileObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameFile' => array('text', 1), 'labelFile' => array('text', 1), 'descriptionFile' => array('text', 0), 'uploadFile' => array('fileUploaded', 1, (!empty($_FILES['uploadFile']['name']) ? $_FILES['uploadFile']['name'] : '')), 'directoryId' => array('numericUnsigned', 1), 'category' => array('numericUnsigned', 1), 'mime' => array('regualText', 1, $this -> fileObj -> mime), 'extension' => array('text', 1, $this -> fileObj -> extension), 'size' => array('numericUnsigned', 1, $this -> fileObj -> size), 'showInObject' => array('text', 0, $this -> fileObj -> showInObject), 'fullPath' => array('filePath', 0, $this -> fileObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $this -> fileObj -> objectId), 'published' => array('text', 0, $this -> fileObj -> published), 'approved' => array('text', 0, $this -> fileObj -> approved), 'comment' => array('text', 0, $this -> fileObj -> comments), 'option' => array('text', 0, $this -> fileObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2), 'source' => array('numeric', 0), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> fileObj -> order), 'afterId' => array('numeric', 0));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> fileObj -> read('id = ? ', array(( int )$_GET['id']));
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
			if (empty($this -> view -> sanitized['directoryId']['value'])) {
				$this -> view -> sanitized['directoryId']['value'] = $result['object_directory_id'];
			}
		}
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> fileObj -> getFileById($_GET['id']);

			$fileDate = explode('-', $result['date_added'], 3);
			$result['download_link'] = parent::$encryptedUrl['file'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $_GET['id']) . $result['extension'];

			$this -> view -> result = $result;
			$this -> view -> render('object/viewFile.phtml');
			exit();
		}
	}

	public function import($objectFileData) {
		$uploadFileObj = new Aula_Model_Upload('file');

		if ($uploadFileObj -> CheckIfThereIsFile() === TRUE) {
			if ($uploadFileObj -> validatedMime()) {
				if ($uploadFileObj -> validatedSize()) {
					$lastInsertIdFile = $this -> fileObj -> insert($objectFileData);
					if ($lastInsertIdFile !== false) {
						$uploadFileObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdFile) . $uploadFileObj -> extension;
						$fileUploaded = $uploadFileObj -> uploadFile($uploadFileObj -> newFileName);
						if (true === $fileUploaded) {
							$relativePath = explode('data' . DIRECTORY_SEPARATOR, $uploadFileObj -> newFileName);
							$objecdInfoData = array('mime_type' => $uploadFileObj -> mime, 'size' => $uploadFileObj -> size, 'extension' => $uploadFileObj -> extension, 'full_path' => $relativePath[1], );
							$this -> fileObj -> update($objecdInfoData, '`id` = ' . $lastInsertIdFile);
							
							return true;
						}
					}
				}
			}
		}
	}

	public function addAction() {
		$form = new Object_Form_File($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			if ($this -> uploadObj -> validatedMime()) {
				if ($this -> uploadObj -> validatedSize()) {
					$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
					$lastInsertId = $this -> objectObj -> insert($objectData);

					if ($lastInsertId !== false) {
						$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
						$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);

						if ($lastInsertIdInfo !== false) {
							$objectFileData = array('name' => $_POST['mandatory']['name'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'object_directory_id' => $_POST['mandatory']['object_directory_id'], 'full_path' => $_POST['mandatory']['full_path'], 'author_id' => $_POST['mandatory']['author_id'], 'show_in_object' => $_POST['optional']['show_in_object'], 'object_id' => $lastInsertId, );
							$lastInsertIdFile = $this -> fileObj -> insert($objectFileData);

							if ($lastInsertIdFile !== false) {
								$this -> uploadObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdFile) . $this -> uploadObj -> extension;
								$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);

								if (true === $fileUploaded) {
									$relativePath = explode('data' . DIRECTORY_SEPARATOR, $this -> uploadObj -> newFileName);
									$objecdInfoData = array('mime_type' => $this -> uploadObj -> mime, 'size' => $this -> uploadObj -> size, 'extension' => $this -> uploadObj -> extension, 'full_path' => $relativePath[1], );
									$this -> fileObj -> update($objecdInfoData, '`id` = ' . $lastInsertIdFile);
								}
								header('Location: /admin/handle/pkg/object-file/action/list/');
								exit ;
							}
						}
					}
				} else {
					$this -> errorMessage['uploadFile'] = $this -> view -> __('Invalid File Size');
				}
			} else {
				$this -> errorMessage['uploadFile'] = $this -> view -> __('Invalid File Type');
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addFile.phtml');
		exit();
	}

	public function editAction() {
		$form = new Object_Form_File($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectFileId = (int)$_POST['mandatory']['id'];
			$fileObjResult = $this -> fileObj -> select() -> where('`id` = ?', $objectFileId) -> query() -> fetch();

			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$this -> objectObj -> update($objectData, '`id` = ' . $fileObjResult['object_id']);

			$objecdInfoData = array('object_id' => $fileObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $fileObjResult['object_id']);

			$objectFileData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'name' => $_POST['mandatory']['name'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'object_directory_id' => $_POST['mandatory']['object_directory_id'], 'author_id' => $_POST['mandatory']['author_id'], 'object_id' => $fileObjResult['object_id'], 'show_in_object' => $_POST['optional']['show_in_object'], 'full_path' => $_POST['mandatory']['full_path'], );
			$this -> fileObj -> update($objectFileData, '`id` = ' . $objectFileId);

			header('Location: /admin/handle/pkg/object-file/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$fileObjResult = $this -> fileObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $fileObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $fileObjResult['object_id']) -> query() -> fetch();

				if ($fileObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					unset($objResult['id']);
					unset($fileObjResult['published']);
					unset($fileObjResult['approved']);
					unset($fileObjResult['comments']);
					unset($fileObjResult['options']);
					unset($fileObjResult['category_id']);
					unset($fileObjResult['created_date']);
					unset($fileObjResult['parent_id']);
					unset($objInfoObjResult['id']);

					$created_date = explode(' ', $objResult['created_date']);
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($fileObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-file/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/updateFile.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> fileId -> value)) {
			foreach ($this->view->sanitized->fileId->value as $id => $value) {
				$where = $this -> fileObj -> getAdapter() -> quoteInto('id = ?', $id);
				$fileDelete = $this -> fileObj -> delete($where);
			}
			if (!empty($fileDelete)) {
				header('Location: /admin/handle/pkg/object-file/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-file/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> fileId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->fileId->value as $id => $value) {
				$data = array('show_in_object' => $this -> view -> sanitized -> status -> value);
				$where = $this -> fileObj -> getAdapter() -> quoteInto('id = ?', $id);
				$fileShowInMenu = $this -> fileObj -> update($data, $where);
			}
			if (!empty($fileShowInMenu)) {
				header('Location: /admin/handle/pkg/object-file/action/list/success/showInObject');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-file/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> fileId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->fileId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> objectObj -> getAdapter() -> quoteInto('id = ?', $id);
				$filePublish = $this -> fileObj -> update($data, $where);
			}
			if (!empty($filePublish)) {
				header('Location: /admin/handle/pkg/object-file/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-file/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> fileId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->fileId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> objectObj -> getAdapter() -> quoteInto('id = ?', $id);
				$fileApprove = $this -> fileObj -> update($data, $where);
			}
			if (!empty($fileApprove)) {
				header('Location: /admin/handle/pkg/object-file/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-file/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-file/action/';

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

		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		foreach ($this->fileObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> fileObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$fileListResult = $this -> fileObj -> getAllFile_urlOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$fileListResult = $this -> fileObj -> getAllFile_urlOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		if (empty($fileListResult) and false == $fileListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		} else {

			foreach ($fileListResult as $key => $value) {
				$fileDate = explode('-', $value['date_added'], 3);
				$fileURL = parent::$encryptedUrl['file'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . $value['extension'];
				$fileListResult[$key]['fileURL'] = $fileURL;
			}

		}

		$this -> view -> objectList = $fileListResult;
		$this -> view -> render('object/listFileObject.phtml');
		exit();
	}

}
