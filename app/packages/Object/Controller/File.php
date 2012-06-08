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
 * @name Object_Controller_File
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_File extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $articleObj = NULL;
	private $commentObj = NULL;
	private $directoryObj = NULL;
	private $fileObj = NULL;
	private $photoObj = NULL;
	private $ratingObj = NULL;
	private $sourceInfoObj = NULL;
	private $sourceObj = NULL;
	private $staticObj = NULL;
	private $tagObj = NULL;
	private $typeObj = NULL;
	private $typeIfnoObj = NULL;
	private $urlObj = NULL;
	private $userFavouriteObj = NULL;
	private $videoObj = NULL;

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> directoryObj = new Object_Model_Directory();
		$this -> fileObj = new Object_Model_File();

		//locale and category objects
		$this -> categoryObj = new Category_Model_Default();

		//Upload Object
		$this -> uploadObj = new Aula_Model_Upload('uploadFile');

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'fileId' => array('numeric', 0), 'objectType' => array('numericUnsigned', 0, $this -> fileObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameFile' => array('text', 1), 'labelFile' => array('text', 1), 'descriptionFile' => array('text', 0), 'uploadFile' => array('fileUploaded', 1, (!empty($_FILES['uploadFile']['name']) ? $_FILES['uploadFile']['name'] : '')), 'directoryId' => array('numericUnsigned', 1), 'category' => array('numericUnsigned', 1), 'mime' => array('regualText', 1, $this -> fileObj -> mime), 'extension' => array('text', 1, $this -> fileObj -> extension), 'showInObject' => array('text', 0, $this -> fileObj -> showInObject), 'fullPath' => array('filePath', 0, $this -> fileObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $this -> fileObj -> objectId), 'published' => array('text', 0, $this -> fileObj -> published), 'approved' => array('text', 0, $this -> fileObj -> approved), 'comment' => array('text', 0, $this -> fileObj -> comments), 'option' => array('text', 0, $this -> fileObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2), 'source' => array('numeric', 0), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> fileObj -> order), 'afterId' => array('numeric', 0));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> fileObj -> getObject_fileDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
			if (empty($this -> view -> sanitized['directoryId']['value'])) {
				$this -> view -> sanitized['directoryId']['value'] = $result['directory_id'];
			}
		}
		//directory list
		$this -> directoryList = '';
		$this -> directoryListResult = $this -> directoryObj -> getAllObject_directoryOrderById();
		if (!empty($this -> directoryListResult)) {
			foreach ($this->directoryListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['directoryId']['value']) ? 'selected="selected"' : '';
				$this -> directoryList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['name'] . '</option>';
			}
		}
		$this -> view -> directoryList = $this -> directoryList;

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
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> pagingObj -> totalRecordsPerPage = $this -> limit;
		$this -> buildPaging();
		if (isset($_GET['category']) and !empty($_GET['category'])) {
			$categoryResult = $this -> categoryObj -> getCategoryDetailsById($_GET['category']);
			if ($categoryResult != FALSE) {
				$fileObjResult = $this -> fileObj -> GetAllCleanObjectAndInfoAndFileByCategoryIdsOrderByColumnWithLimit($_GET['category'], 'id', 'DESC', $this -> start, $this -> limit);
				$settings = Zend_Registry::get('settings-directories');
				if (!empty($fileObjResult)) {
					foreach ($fileObjResult as $k => $file) {
						$fileObjResult[$k]['url'] = str_replace($settings -> root, '/', $fileObjResult[$k]['full_path']);
					}
				}
			} else {
				header('Location: /');
				exit();
			}
		}
		$this -> view -> fileList = $fileObjResult;
		$this -> view -> categoryDetails = $categoryResult[0];
		//$this->view->arrayToObject ( $this->view->fileList );
		//		$this->view->render ( 'tools-list.phtml' );
		$this -> buildPaging();
		$this -> pagingObj -> _init($this -> fileObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		$this -> view -> render('object/file/list.phtml');
		exit();
	}

	public function viewAction() {
		if (isset($_GET['id']) and !empty($_GET['id'])) {
			$fileDetails = $this -> fileObj -> GetAllCleanObject_fileByIdOrderById(( int )$_GET['id']);
			$settings = Zend_Registry::get('settings-directories');
			if ($fileDetails !== FALSE) {
				$fileDetails[0]['url'] = str_replace($settings -> root, '/', $fileDetails[0]['full_path']);
			} else {
				header('Location: /');
				exit();
			}
		}
		//Set total views (downloaded) count
		$objectInfoResult = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($fileDetails[0]['object_id']);
		$objectInfoResult[0]['total_views']++;
		$objectTotalViews = $this -> objectInfoObj -> updateObject_infoTotal_viewsColumnById($objectInfoResult[0]['id'], $objectInfoResult[0]['total_views']);
		header('Content-type: ' . $fileDetails[0]['mime_type']);
		header('Content-Disposition: attachement; filename: ' . $fileDetails[0]['name']);
		header('Content-Description: Download');
		readfile($fileDetails[0]['full_path']);
		exit();
	}

	public function saveAction() {
		if (isset($_GET['id']) and !empty($_GET['id'])) {
			$fileDetails = $this -> fileObj -> GetAllCleanObject_fileByIdOrderById(( int )$_GET['id']);
			$settings = Zend_Registry::get('settings-directories');
			if ($fileDetails !== FALSE) {
				$fileDetails[0]['url'] = str_replace($settings -> disk, '/', $fileDetails[0]['full_path']);
			} else {
				header('Location: /');
				exit();
			}
		}
		//Set total views (downloaded) count
		$objectInfoResult = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($fileDetails[0]['object_id']);
		$objectInfoResult[0]['total_views']++;
		$objectTotalViews = $this -> objectInfoObj -> updateObject_infoTotal_viewsColumnById($objectInfoResult[0]['id'], $objectInfoResult[0]['total_views']);
		if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
			header('Content-Type: "application/octet-stream"');
			header('Content-Disposition: attachment; filename="' . $fileDetails[0]['name'] . $fileDetails[0]['extension'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Content-Transfer-Encoding: binary');
			header('Pragma: public');
			header('Content-Length: ' . filesize($settings -> disk . $fileDetails[0]['full_path']));
		} else {
			header('Content-Type: "application/octet-stream"');
			header('Content-Disposition: attachment; filename="' . $fileDetails[0]['name'] . $fileDetails[0]['extension'] . '"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Pragma: no-cache');
			header('Content-Length: ' . filesize($settings -> disk . $fileDetails[0]['full_path']));
		}

		@set_time_limit(0);
		@readfile($settings -> disk . $fileDetails[0]['full_path']);
		exit();
	}

	public function shareAction() {
	}

	public function sendToFriendAction() {
	}

}
