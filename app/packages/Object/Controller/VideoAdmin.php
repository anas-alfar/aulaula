<?php

class Object_Controller_VideoAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $videoObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();
		$this -> videoObj = new Object_Model_Video();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'status' => array('text', 0, 'Yes'), 'youTubeVideo' => array('text', 0), 'videoId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleVideo' => array('text', 1), 'aliasVideo' => array('text', 1), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numericUnsigned', 1), 'takenDateVideo' => array('shortDateTime', 0), 'takenLocationVideo' => array('text', 0), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'encoded' => array('text', 0, $this -> videoObj -> encoded), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> videoObj -> showInObject), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> videoObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> videoObj -> published), 'approved' => array('text', 0, $this -> videoObj -> approved), 'comment' => array('', 0, $this -> videoObj -> comments), 'option' => array('', 0, $this -> videoObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> videoObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		$this -> view -> sanitized['sourceArticle']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> videoObj -> getVideoById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewVideo.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Object_Form_Video($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadPhotoObj = new Aula_Model_Upload_Photo('filePhoto');
			$uploadVideoObj = new Aula_Model_Upload_Video('fileVideo');

			if ($uploadVideoObj -> CheckIfThereIsFile() === TRUE && $uploadPhotoObj -> CheckIfThereIsFile() === TRUE) {
				if ($uploadVideoObj -> validatedMime() && $uploadPhotoObj -> validatedMime()) {
					if ($uploadVideoObj -> validatedSize() && $uploadPhotoObj -> validatedSize()) {

						$stmt = $this -> videoObj -> getAdapter() -> prepare('UPDATE object_video SET `order`=`order`+1 WHERE `order` >= ?');
						$stmt -> execute(array($_POST['optional']['order']));

						$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
						$lastInsertId = $this -> objectObj -> insert($objectData);

						$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
						$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);

						$objectVideoData = array('alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'author_id' => $this -> userId, 'object_id' => $lastInsertId, 'size' => 'NULL', 'width' => 'NULL', 'height' => 'NULL', 'extension' => 'NULL', 'taken_date' => $_POST['mandatory']['taken_date'], 'taken_location' => $_POST['mandatory']['taken_location'], 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
						$lastInsertIdVideo = $this -> videoObj -> insert($objectVideoData);

						if (is_numeric($lastInsertIdVideo)) {
							$videoData = array('size' => $uploadVideoObj -> size, 'width' => $uploadVideoObj -> width, 'height' => $uploadVideoObj -> height, 'extension' => $uploadVideoObj -> extension, );
							$this -> videoObj -> update($videoData, '`id` = ' . $lastInsertIdVideo);

							$uploadVideoObj -> newFileName = parent::$encryptedDisk['video']['flv'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdVideo) . '.flv';
							$uploadVideoObj -> uploadFile($uploadVideoObj -> newFileName);

							$uploadPhotoObj -> newFileName = parent::$encryptedDisk['video']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdVideo) . '.jpg';
							$uploadPhotoObj -> uploadFile($uploadPhotoObj -> newFileName);

							$thumbUploaded = $uploadPhotoObj -> resizeUploadImage($uploadVideoObj -> width, $uploadVideoObj -> height, parent::$encryptedDisk['video']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);

						} else {
							$this -> errorMessage['save'] = $this -> view -> __('Error happens try again later');
						}
					} else {
						$this -> errorMessage['file'] = $this -> view -> __('Invalid File Size');
					}
				} else {
					$this -> errorMessage['file'] = $this -> view -> __('Invalid File Type');
				}
			} else {
				$this -> errorMessage['file'] = $this -> view -> __('No File Uploaded');
			}

			header('Location: /admin/handle/pkg/object-video/action/list/');
			exit();
		}

		$this -> view -> form = $form;
		$this -> view -> render('object/addVideo.phtml');
		exit();
	}

	public function editAction() {
		$form = new Object_Form_Video($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {

			$objectVideoId = (int)$_POST['mandatory']['id'];
			$videoObjResult = $this -> videoObj -> select() -> where('`id` = ?', $objectVideoId) -> query() -> fetch();
			if ($videoObjResult['order'] != $_POST['optional']['order']) {
				$stmt = $this -> videoObj -> getAdapter() -> prepare('UPDATE object_video SET `order`=`order`+1 WHERE `order` >= ?');
				$stmt -> execute(array($_POST['optional']['order']));
			}

			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$this -> objectObj -> update($objectData, '`id` = ' . $videoObjResult['object_id']);

			$objecdInfoData = array('object_id' => $videoObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $videoObjResult['object_id']);

			$objectVideoData = array('alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'author_id' => $this -> userId, 'object_id' => $videoObjResult['object_id'], 'taken_date' => $_POST['mandatory']['taken_date'], 'taken_location' => $_POST['mandatory']['taken_location'], 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], 'modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"));
			$this -> videoObj -> update($objectVideoData, '`id` = ' . $objectVideoId);

			header('Location: /admin/handle/pkg/object-video/action/list/');
			exit();

		} else {

			if (isset($_GET['id']) and is_numeric($_GET['id'])) {

				$videoObjResult = $this -> videoObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $videoObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $videoObjResult['object_id']) -> query() -> fetch();

				if ($videoObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					unset($objResult['id']);
					unset($videoObjResult['published']);
					unset($videoObjResult['approved']);
					unset($videoObjResult['comments']);
					unset($videoObjResult['options']);
					unset($videoObjResult['meta_data']);
					unset($videoObjResult['category_id']);
					unset($videoObjResult['object_source_id']);
					unset($videoObjResult['created_date']);
					unset($objInfoObjResult['id']);

					$publish_from = explode(' ', $videoObjResult['publish_from']);
					$taken_date = explode(' ', $videoObjResult['taken_date']);
					$publish_to = explode(' ', $videoObjResult['publish_to']);
					$created_date = explode(' ', $objResult['created_date']);
					$videoObjResult['taken_date'] = $taken_date[0];
					$videoObjResult['publish_from'] = $publish_from[0];
					$videoObjResult['publish_to'] = $publish_to[0];
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($videoObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-video/action/list');
					exit();
				}
			}
		}

		$this -> view -> form = $form;
		$this -> view -> render('object/updateVideo.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> videoId -> value)) {
			foreach ($this->view->sanitized->videoId->value as $id => $value) {
				$where = $this -> videoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$videoDelete = $this -> videoObj -> delete($where);
			}
			if (!empty($videoDelete)) {
				header('Location: /admin/handle/pkg/object-video/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-video/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> videoId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->videoId->value as $id => $value) {
				$data = array('show_in_object' => $this -> view -> sanitized -> status -> value);
				$where = $this -> videoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$videoShowInMenu = $this -> videoObj -> update($data, $where);
			}
			if (!empty($videoShowInMenu)) {
				header('Location: /admin/handle/pkg/object-video/action/list/success/showInObject');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-video/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> videoId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->videoId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> videoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$videoPublish = $this -> videoObj -> update($data, $where);
			}
			if (!empty($videoPublish)) {
				header('Location: /admin/handle/pkg/object-video/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-video/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> videoId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->videoId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> videoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$videoAprrove = $this -> videoObj -> update($data, $where);
			}
			if (!empty($videoAprrove)) {
				header('Location: /admin/handle/pkg/object-video/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-video/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-video/action/';

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
		foreach ($this->videoObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> videoObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$videoListResult = $this -> videoObj -> getAllObject_VideoOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$videoListResult = $this -> videoObj -> getAllObject_VideoOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> videoObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($videoListResult) and false == $videoListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		} else {
			foreach ($videoListResult as $key => $value) {
				$fileDate = explode('-', $value['date_added'], 3);
				//$photoSRC = parent::$encryptedUrl['video']['thumb'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg?r=' . rand(0, 1000) . '<br /><br />';
				$fileURL = parent::$encryptedUrl['video']['flv'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . $value['extension'];
				$videoListResult[$key]['fileURL'] = $fileURL;
			}
		}

		$this -> view -> objectList = $videoListResult;
		$this -> view -> render('object/listVideoObject.phtml');
		exit();
	}

}
