<?php

class Object_Controller_PhotoAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $fileObj = NULL;
	private $photoObj = NULL;
	private $uploadObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();
		$this -> photoObj = new Object_Model_Photo();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'photoId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'titlePhoto' => array('text', 1), 'aliasPhoto' => array('text', 1), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 1), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('fileUploaded', 1, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'category' => array('numericUnsigned', 1), 'subCategoryId' => array('numericUnsigned', 0, 0), 'photoEssays' => array('numericUnsigned', 0, 0), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> photoObj -> showInObject), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> photoObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> photoObj -> published), 'approved' => array('text', 0, $this -> photoObj -> approved), 'comment' => array('text', 0, $this -> photoObj -> comments), 'option' => array('text', 0, $this -> photoObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> photoObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> photoObj -> getPhotoById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewPhoto.phtml');
			exit();
		}
	}

	public function import($objectPhotoData, $photoName) {
		$uploadPhotoObj = new Aula_Model_Upload_Photo($photoName);

		if ($uploadPhotoObj -> CheckIfThereIsFile() === TRUE) {
			if ($uploadPhotoObj -> validatedMime()) {
				if ($uploadPhotoObj -> validatedSize()) {

					$stmt = $this -> photoObj -> getAdapter() -> prepare('UPDATE object_photo SET `order`=`order`+1 WHERE `order` >= ?');
					$stmt -> execute(array($objectPhotoData['order']));

					if (empty($objectPhotoData['taken_date'])) {
						$objectPhotoData['taken_date'] = $uploadPhotoObj -> takenTime;
					}
					$objectPhotoData['author_id'] = $this -> userId;
					$objectPhotoData['size'] = $uploadPhotoObj -> size;
					$objectPhotoData['width'] = $uploadPhotoObj -> width;
					$objectPhotoData['height'] = $uploadPhotoObj -> height;
					$objectPhotoData['extension'] = $uploadPhotoObj -> extension;

					$lastInsertIdPhoto = $this -> photoObj -> insert($objectPhotoData);
					if ($lastInsertIdPhoto !== false) {

						$uploadPhotoObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdPhoto) . '.jpg';
						$fileUploaded = $uploadPhotoObj -> uploadFile($uploadPhotoObj -> newFileName);

						$thumbUploaded = $uploadPhotoObj -> resizeUploadImage(76, 52, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
						$thumbLargeUploaded = $uploadPhotoObj -> resizeUploadImage(184, 125, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
						$mediumUploaded = $uploadPhotoObj -> resizeUploadImage(470, 320, parent::$encryptedDisk['photo']['medium'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
						$largeMiniUploaded = $uploadPhotoObj -> resizeUploadImage(600, 408, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
						$largeUploaded = $uploadPhotoObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');

						return true;
					}
				}
			}
		}
	}

	public function addAction() {
		$form = new Object_Form_Photo($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {

			$uploadObj = new Aula_Model_Upload_Photo('photo');

			if ($uploadObj -> validatedMime()) {
				if ($uploadObj -> validatedSize()) {
					if (empty($_POST['mandatory']['taken_date'])) {
						$_POST['mandatory']['taken_date'] = $uploadObj -> takenTime;
					}
					$stmt = $this -> photoObj -> getAdapter() -> prepare('UPDATE object_photo SET `order`=`order`+1 WHERE `order` >= ?');
					$stmt -> execute(array($_POST['optional']['order']));

					$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
					$lastInsertId = $this -> objectObj -> insert($objectData);

					if ($lastInsertId !== false) {
						$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
						$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);

						if ($lastInsertIdInfo !== false) {

							$objectPhotoData = array('alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'author_id' => $this -> userId, 'object_id' => $lastInsertId, 'size' => $uploadObj -> size, 'width' => $uploadObj -> width, 'height' => $uploadObj -> height, 'extension' => $uploadObj -> extension, 'taken_date' => $_POST['mandatory']['taken_date'], 'taken_location' => $_POST['mandatory']['taken_location'], 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
							$lastInsertIdPhoto = $this -> photoObj -> insert($objectPhotoData);

							if ($lastInsertIdPhoto !== false) {

								$uploadObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdPhoto) . '.jpg';
								$fileUploaded = $uploadObj -> uploadFile($uploadObj -> newFileName);

								$thumbUploaded = $uploadObj -> resizeUploadImage(76, 52, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
								$thumbLargeUploaded = $uploadObj -> resizeUploadImage(184, 125, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
								$mediumUploaded = $uploadObj -> resizeUploadImage(470, 320, parent::$encryptedDisk['photo']['medium'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
								$largeMiniUploaded = $uploadObj -> resizeUploadImage(600, 408, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
								$largeUploaded = $uploadObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');

								header('Location: /admin/handle/pkg/object-photo/action/list/');
								exit();
							}
						}
					}
				} else {
					$this -> errorMessage['photo'] = $this -> view -> __('Invalid File Size');
				}
			} else {
				$this -> errorMessage['photo'] = $this -> view -> __('Invalid File Type');
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addPhoto.phtml');
		exit();
	}

	public function editAction() {
		$form = new Object_Form_Photo($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$uploadObj = new Aula_Model_Upload_Photo('photo');
			if ($uploadObj -> validatedMime()) {
				if ($uploadObj -> validatedSize()) {
					if (empty($_POST['mandatory']['taken_date'])) {
						$_POST['mandatory']['taken_date'] = $uploadObj -> takenTime;
					}
					$objectPhotoId = (int)$_POST['mandatory']['id'];
					$photoObjResult = $this -> photoObj -> select() -> where('`id` = ?', $objectPhotoId) -> query() -> fetch();
					if ($photoObjResult['order'] != $_POST['optional']['order']) {
						$stmt = $this -> photoObj -> getAdapter() -> prepare('UPDATE object_photo SET `order`=`order`+1 WHERE `order` >= ?');
						$stmt -> execute(array($_POST['optional']['order']));
					}

					$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
					$lastInsertId = $this -> objectObj -> update($objectData, '`id` = ' . $photoObjResult['object_id']);

					$objecdInfoData = array('object_id' => $photoObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
					$lastInsertIdInfo = $this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $photoObjResult['object_id']);

					$objectPhotoData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'author_id' => $this -> userId, 'object_id' => $photoObjResult['object_id'], 'size' => $uploadObj -> size, 'width' => $uploadObj -> width, 'height' => $uploadObj -> height, 'extension' => $uploadObj -> extension, 'taken_date' => $_POST['mandatory']['taken_date'], 'taken_location' => $_POST['mandatory']['taken_location'], 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
					$lastInsertIdPhoto = $this -> photoObj -> update($objectPhotoData, '`id` = ' . $objectPhotoId);

					$uploadObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $objectPhotoId) . '.jpg';
					$fileUploaded = $uploadObj -> uploadFile($uploadObj -> newFileName);

					$thumbUploaded = $uploadObj -> resizeUploadImage(76, 52, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
					$thumbLargeUploaded = $uploadObj -> resizeUploadImage(184, 125, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
					$mediumUploaded = $uploadObj -> resizeUploadImage(470, 320, parent::$encryptedDisk['photo']['medium'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
					$largeMiniUploaded = $uploadObj -> resizeUploadImage(600, 408, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
					$largeUploaded = $uploadObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');

					header('Location: /admin/handle/pkg/object-photo/action/list/');
					exit();
				} else {
					$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Size');
				}
			} else {
				$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Type');
			}
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$photObjResult = $this -> photoObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $photObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $photObjResult['object_id']) -> query() -> fetch();

				if ($photObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					unset($objResult['id']);
					unset($photObjResult['published']);
					unset($photObjResult['approved']);
					unset($photObjResult['comments']);
					unset($photObjResult['options']);
					unset($photObjResult['meta_data']);
					unset($photObjResult['category_id']);
					unset($photObjResult['object_source_id']);
					unset($photObjResult['created_date']);
					unset($objInfoObjResult['id']);

					$publish_from = explode(' ', $photObjResult['publish_from']);
					$taken_date = explode(' ', $photObjResult['taken_date']);
					$publish_to = explode(' ', $photObjResult['publish_to']);
					$created_date = explode(' ', $objResult['created_date']);
					$photObjResult['taken_date'] = $taken_date[0];
					$photObjResult['publish_from'] = $publish_from[0];
					$photObjResult['publish_to'] = $publish_to[0];
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($photObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-photo/action/list');
					exit();
				}

			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/updatePhoto.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> photoId -> value)) {
			foreach ($this->view->sanitized->photoId->value as $id => $value) {
				$where = $this -> photoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$photoDelete = $this -> photoObj -> delete($where);
			}
			if (!empty($photoDelete)) {
				header('Location: /admin/handle/pkg/object-photo/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-photo/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> photoId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->photoId->value as $id => $value) {
				$data = array('show_in_object' => $this -> view -> sanitized -> status -> value);
				$where = $this -> photoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$photoShowInObject = $this -> photoObj -> update($data, $where);
			}
			if (!empty($photoShowInObject)) {
				header('Location: /admin/handle/pkg/object-photo/action/list/success/showInObject');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-photo/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> photoId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->photoId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> photoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$photoPublish = $this -> photoObj -> update($data, $where);
			}
			if (!empty($photoPublish)) {
				header('Location: /admin/handle/pkg/object-photo/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-photo/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> photoId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->photoId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> photoObj -> getAdapter() -> quoteInto('id = ?', $id);
				$photoAprrove = $this -> photoObj -> update($data, $where);
			}
			if (!empty($photoAprrove)) {
				header('Location: /admin/handle/pkg/object-photo/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-photo/action/list/');
		exit();
	}

	public function listAction() {

		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-photo/action/';

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
		foreach ($this->photoObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> photoObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$photoListResult = $this -> photoObj -> getAllObject_PhotoOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$photoListResult = $this -> photoObj -> getAllObject_PhotoOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> photoObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($photoListResult) and false == $photoListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		} else {
			foreach ($photoListResult as $key => $value) {
				$photoDate = explode('-', $value['date_added'], 3);
				$photoSRC = parent::$encryptedUrl['photo']['thumb'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg?x=' . rand(0, 1000);
				$largePhotoSRC = parent::$encryptedUrl['photo']['large'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg?x=' . rand(0, 1000);
				$photoListResult[$key]['photoSRC'] = $photoSRC;
				$photoListResult[$key]['largePhotoSRC'] = $largePhotoSRC;
			}
		}
		$this -> view -> objectList = $photoListResult;
		$this -> view -> render('object/listPhotoObject.phtml');
		exit();
	}

}
