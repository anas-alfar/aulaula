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
 * @name Object_Controller_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $articleObj = NULL;
	private $fileObj = NULL;
	private $videoObj = NULL;
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
		$form = new Object_Form_AddDefault($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {

			$this -> articleObj = new Object_Model_Article();
			$this -> fileObj = new Object_Model_File();
			$this -> videoObj = new Object_Model_Video();

			if (array_key_exists('MAX_FILE_SIZE', $_POST)) {
				unset($_POST['MAX_FILE_SIZE']);
			}

			$flag = true;
			$objectData = array();
			$objectInfoData = array();

			foreach ($_POST as $language_id => $value) {
				if (is_numeric($language_id)) {// article

					$objectArticleData['alias'] = $_POST[$language_id]['alias'];
					$objectArticleData['intro_text'] = $_POST[$language_id]['intro_text'];
					$objectArticleData['full_text'] = $_POST[$language_id]['full_text'];
					$objectArticleData['author_id'] = $this -> userId;

					$locale_id = $language_id;

					// Begin Check Video Upload
					$uploadPhotoObj = new Aula_Model_Upload_Photo('videoThumb_' . $language_id);
					$uploadVideoObj = new Aula_Model_Upload_Video('video_' . $language_id);
					if ($uploadVideoObj -> CheckIfThereIsFile() === FALSE && $uploadPhotoObj -> CheckIfThereIsFile() === FALSE) {
						$this -> errorMessage['videoThumb_' . $language_id] = $this -> view -> __('No File Uploaded');
						$this -> errorMessage['video_' . $language_id] = $this -> view -> __('No File Uploaded');
						exit ;
					}
					if (!$uploadVideoObj -> validatedMime() OR !$uploadPhotoObj -> validatedMime()) {
						$this -> errorMessage['video_' . $language_id] = $this -> view -> __('Invalid File Type');
						exit ;
					}
					if (!$uploadVideoObj -> validatedSize() OR !$uploadPhotoObj -> validatedSize()) {
						$this -> errorMessage['video_' . $language_id] = $this -> view -> __('Invalid File Size');
						exit ;
					}
					// End Check Video Upload

					// Begin Check File Upload
					$uploadFileObj = new Aula_Model_Upload('file_' . $language_id);
					if (!$uploadFileObj -> validatedMime()) {
						$this -> errorMessage['file_' . $language_id] = $this -> view -> __('Invalid File Type');
						exit ;
					}
					if (!$uploadFileObj -> validatedSize()) {
						$this -> errorMessage['file_' . $language_id] = $this -> view -> __('Invalid File Size');
						exit ;
					}
					// End Check File Upload

					// Begin Check photos Upload
					foreach ($this->mediaCount as $count) {
						$uploadObj = new Aula_Model_Upload_Photo('photo_' . $language_id . '_' . $count);
						if (!$uploadObj -> validatedMime()) {
							$this -> errorMessage['photo_' . $language_id . '_' . $count] = $this -> view -> __('Invalid File Type');
							exit ;
						}
						if (!$uploadObj -> validatedSize()) {
							$this -> errorMessage['photo_' . $language_id . '_' . $count] = $this -> view -> __('Invalid File Size');
							exit ;
						}
					}
					// End Check photos Upload
					continue;

				} else if ($language_id == 'video_' . $locale_id) {

					$objectVideoData['alias'] = $_POST['video_' . $locale_id]['alias'];
					$objectVideoData['intro_text'] = $_POST['video_' . $locale_id]['intro_text'];
					$objectVideoData['author_id'] = $this -> userId;
					$objectVideoData['taken_date'] = $_POST['video_' . $locale_id]['taken_date'];
					$objectVideoData['taken_location'] = $_POST['video_' . $locale_id]['taken_location'];

					continue;

				} else if ($language_id == 'file_' . $locale_id) {

					$objectFileData['name'] = $_POST['file_' . $locale_id]['name'];
					$objectFileData['label'] = $_POST['file_' . $locale_id]['label'];
					$objectFileData['description'] = $_POST['file_' . $locale_id]['description'];
					$objectFileData['object_directory_id'] = $_POST['file_' . $locale_id]['object_directory_id'];
					$objectFileData['full_path'] = $_POST['file_' . $locale_id]['full_path'];
					$objectFileData['author_id'] = $_POST['file_' . $locale_id]['author_id'];

					continue;

				} else if ($language_id == 'optional_' . $locale_id) {
					$objectData['title'] = $_POST['optional_' . $locale_id]['title'];
					$objectData['author_id'] = $this -> userId;
					$objectData['published'] = $_POST['optional_' . $locale_id]['published'];
					$objectData['approved'] = $_POST['optional_' . $locale_id]['approved'];
					//$objectData['order'] = $_POST['optional_' . $locale_id]['order'];
					$objectData['locale_id'] = $locale_id;

					$objectData['guid_url'] = $_POST['optional_' . $locale_id]['guid_url'];
					$objectData['original_author'] = $_POST['optional_' . $locale_id]['original_author'];
					$objectData['parent_id'] = $_POST['optional_' . $locale_id]['parent_id'];
					$objectData['show_in_list'] = $_POST['optional_' . $locale_id]['show_in_list'];
					$objectData['created_date'] = $_POST['optional_' . $locale_id]['created_date'];
					$objectData['object_source_id'] = $_POST['optional_' . $locale_id]['object_source_id'];
					$objectData['object_type_id'] = $_POST['optional_' . $locale_id]['object_type_id'];
					$objectData['category_id'] = $_POST['optional_' . $locale_id]['category_id'];
					$objectData['tags'] = $_POST['optional_' . $locale_id]['tags'];

					//$objectData['show_in_object'] = $_POST['optional_' . $locale_id]['show_in_object'];
					//$objectData['publish_from'] = $_POST['optional_' . $locale_id]['publish_from'];
					//$objectData['publish_to'] = $_POST['optional_' . $locale_id]['publish_to'];

					$objectInfoData['options'] = json_encode($_POST['optional_' . $locale_id]['options']);
					$objectInfoData['comments'] = $_POST['optional_' . $locale_id]['comments'];

					continue;

				} else if ($language_id == 'meta_' . $locale_id) {
					$objectData['page_title'] = $_POST['meta_' . $locale_id]['page_title'];
					$objectData['meta_title'] = $_POST['meta_' . $locale_id]['meta_title'];
					$objectData['meta_key'] = $_POST['meta_' . $locale_id]['meta_key'];
					$objectData['meta_desc'] = $_POST['meta_' . $locale_id]['meta_desc'];
					$objectData['meta_data'] = $_POST['meta_' . $locale_id]['meta_data'];
				} else {
					continue;
				}

				//$stmt = $this -> objectObj -> getAdapter() -> prepare('UPDATE object SET `order`=`order`+1 WHERE `order` >= ?');
				//$stmt -> execute(array($objectData['order']));

				if ($flag === true) {
					$lastInsertObjectId = $this -> objectObj -> insert($objectData);
					$hash_key = md5($this -> fc -> settings -> encryption -> hash . $lastInsertObjectId);
					$this -> objectObj -> update(array('hash_key' => $hash_key), '`id` = ' . $lastInsertObjectId);
					$flag = false;
				} else {
					$objectData['hash_key'] = $hash_key;
					$lastInsertObjectId = $this -> objectObj -> insert($objectData);
				}

				// Begin Insert Object Info
				$objectInfoData['object_id'] = $lastInsertObjectId;
				$this -> objectInfoObj -> insert($objectInfoData);
				// End Insert Object Info

				// Begin Insert Article
				$objectArticleData['object_id'] = $lastInsertObjectId;
				$this -> articleObj -> insert($objectArticleData);
				// End Insert Article

				// Begin Insert and Upload File
				$objectFileData['object_id'] = $lastInsertObjectId;
				$lastInsertIdFile = $this -> fileObj -> insert($objectFileData);
				if ($lastInsertIdFile !== false) {
					$uploadFileObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdFile) . $uploadFileObj -> extension;
					$fileUploaded = $uploadFileObj -> uploadFile($uploadFileObj -> newFileName);

					if (true === $fileUploaded) {
						$relativePath = explode('data' . DIRECTORY_SEPARATOR, $uploadFileObj -> newFileName);
						$objecdInfoData = array('mime_type' => $uploadFileObj -> mime, 'size' => $uploadFileObj -> size, 'extension' => $uploadFileObj -> extension, 'full_path' => $relativePath[1], );
						$this -> fileObj -> update($objecdInfoData, '`id` = ' . $lastInsertIdFile);
					}

				}
				// End Insert and Upload File

				// Begin Insert and Upload Video And Thumb
				$objectVideoData['object_id'] = $lastInsertObjectId;
				$lastInsertIdVideo = $this -> videoObj -> insert($objectVideoData);
				if (is_numeric($lastInsertIdVideo)) {
					$videoData = array('size' => $uploadVideoObj -> size, 'width' => $uploadVideoObj -> width, 'height' => $uploadVideoObj -> height, 'extension' => $uploadVideoObj -> extension, );
					$this -> videoObj -> update($videoData, '`id` = ' . $lastInsertIdVideo);

					$uploadVideoObj -> newFileName = parent::$encryptedDisk['video']['flv'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdVideo) . '.flv';
					$uploadVideoObj -> uploadFile($uploadVideoObj -> newFileName);

					$uploadPhotoObj -> newFileName = parent::$encryptedDisk['video']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdVideo) . '.jpg';
					$uploadPhotoObj -> uploadFile($uploadPhotoObj -> newFileName);

					$thumbUploaded = $uploadPhotoObj -> resizeUploadImage($uploadVideoObj -> width, $uploadVideoObj -> height, parent::$encryptedDisk['video']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
				}
				// End Insert and Upload Video And Thumb

				// Begin Insert and Upload Photos
				foreach ($this->mediaCount as $count) {
					$_POST['photo_' . $locale_id . '_' . $count]['object_id'] = $lastInsertObjectId;
					$photoAdmin = new Object_Controller_PhotoAdmin($this -> fc);
					$photoUploadedSuccessfully = $photoAdmin -> import($_POST['photo_' . $locale_id . '_' . $count], 'photo_' . $locale_id . '_' . $count);
				}
				// End Insert and Upload Photos

			}
			header('Location: /admin/handle/pkg/object/action/list/');
			exit();

			/*$objectData = array('title' => $_POST['optional']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> default -> current -> id, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['optional']['published'], 'approved' => $_POST['optional']['approved']);
			 $objectLastInsertId = $this -> objectObj -> insert($objectData);

			 if ($objectLastInsertId !== false) {
			 $objecdInfoData = array('object_id' => $objectLastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			 $objectInfoLastInsertId = $this -> objectInfoObj -> insert($objecdInfoData);

			 if ($objectInfoLastInsertId !== false) {
			 $objectArticleData = array('alias' => $_POST['article']['alias'], 'intro_text' => $_POST['article']['intro_text'], 'full_text' => $_POST['article']['full_text'], 'author_id' => $this -> userId, 'object_id' => $objectLastInsertId, );
			 $objectArticleLastInsertId = $this -> articleObj -> insert($objectArticleData);

			 if ($objectArticleLastInsertId !== false) {

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
			 }*/
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
