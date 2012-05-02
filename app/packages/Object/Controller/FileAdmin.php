<?php

class Object_Controller_FileAdmin extends Aula_Controller_Action {

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

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'fileId' => array('numeric', 0), 'objectType' => array('numericUnsigned', 0, $this -> fileObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameFile' => array('text', 1), 'labelFile' => array('text', 1), 'descriptionFile' => array('text', 0), 'uploadFile' => array('fileUploaded', 1, (!empty($_FILES['uploadFile']['name']) ? $_FILES['uploadFile']['name'] : '')), 'directoryId' => array('numericUnsigned', 1), 'category' => array('numericUnsigned', 1), 'mime' => array('regualText', 1, $this -> fileObj -> mime), 'extension' => array('text', 1, $this -> fileObj -> extension), 'showInObject' => array('text', 0, $this -> fileObj -> showInObject), 'fullPath' => array('filePath', 0, $this -> fileObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $this -> fileObj -> objectId), 'published' => array('text', 0, $this -> fileObj -> published), 'approved' => array('text', 0, $this -> fileObj -> approved), 'comment' => array('text', 0, $this -> fileObj -> comments), 'option' => array('text', 0, $this -> fileObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2), 'source' => array('numeric', 0), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> fileObj -> order), 'afterId' => array('numeric', 0));
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

	public function addAction() {
		$form = new Object_Form_File($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$lastInsertId = $this -> objectObj -> insert($objectData);

			if ($lastInsertId !== false) {
				$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
				$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);
				if ($lastInsertIdInfo !== false) {
					$objectFileData = array('name' => $_POST['mandatory']['name'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'object_directory_id' => $_POST['mandatory']['object_directory_id'], 'full_path' => $_POST['mandatory']['full_path'], 'author_id' => $_POST['mandatory']['author_id'], 'show_in_object' => $_POST['optional']['show_in_object'], 'object_id' => $lastInsertId, );
					$lastInsertIdFile = $this -> fileObj -> insert($objectFileData);
					if ($lastInsertIdFile !== false) {

						/**
						 * Begin Upload Section
						 */
						if ($this -> uploadObj -> validatedSize()) {
							$this -> view -> sanitized -> size -> value = $this -> uploadObj -> size;
							$this -> view -> sanitized -> extension -> value = $this -> uploadObj -> extension;
							$this -> view -> sanitized -> mime -> value = $this -> uploadObj -> mime;

							$result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> source -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
							$this -> view -> sanitized -> Id -> value = $result[0];
							$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
							$result = $this -> fileObj -> insertIntoObject_file(Null, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
							$this -> view -> sanitized -> Id -> value = $result[0];
							if (is_numeric($this -> view -> sanitized -> Id -> value)) {
								$this -> uploadObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
								$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
								if (true === $fileUploaded) {
									$this -> fileObj -> updateObject_fileSizeColumnById($this -> view -> sanitized -> Id -> value, $this -> uploadObj -> size -> value);
									$relativePath = explode('disk' . DIRECTORY_SEPARATOR, $this -> uploadObj -> newFileName);
									$this -> fileObj -> updateObject_fileFull_pathColumnById($this -> view -> sanitized -> Id -> value, $relativePath[1]);
								}
								if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value and (true === $fileUploaded))) {
									header('Location: /admin/handle/pkg/object-file/action/list/s/1');
									exit();
								} else {
									header('Location: /admin/handle/pkg/object-file/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
									exit();
								}
							}
						} else {
							$this -> errorMessage['uploadFile'] = $this -> view -> __('Invalid File Size');
						}
						/**
						 * End Upload Section
						 */

					}
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addFile.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);

		 if (empty($this -> errorMessage)) {
		 if ($this -> uploadObj -> validatedSize()) {
		 $this -> view -> sanitized -> size -> value = $this -> uploadObj -> size;
		 $this -> view -> sanitized -> extension -> value = $this -> uploadObj -> extension;
		 $this -> view -> sanitized -> mime -> value = $this -> uploadObj -> mime;

		 $result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> source -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];
		 $result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
		 $result = $this -> fileObj -> insertIntoObject_file(Null, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];
		 if (is_numeric($this -> view -> sanitized -> Id -> value)) {
		 $this -> uploadObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
		 $fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
		 if (true === $fileUploaded) {
		 $this -> fileObj -> updateObject_fileSizeColumnById($this -> view -> sanitized -> Id -> value, $this -> uploadObj -> size -> value);
		 $relativePath = explode('disk' . DIRECTORY_SEPARATOR, $this -> uploadObj -> newFileName);
		 $this -> fileObj -> updateObject_fileFull_pathColumnById($this -> view -> sanitized -> Id -> value, $relativePath[1]);
		 }
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value and (true === $fileUploaded))) {
		 header('Location: /admin/handle/pkg/object-file/action/list/s/1');
		 exit();
		 } else {
		 header('Location: /admin/handle/pkg/object-file/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 }
		 }
		 } else {
		 $this -> errorMessage['uploadFile'] = $this -> view -> __('Invalid File Size');
		 }
		 }
		 } else {
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 }

		 if (!empty($this -> errorMessage)) {
		 foreach ($this->errorMessage as $key => $msg) {
		 $this -> view -> sanitized -> $key -> errorMessage = $msg;
		 $this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
		 }
		 }

		 $this -> view -> render('object/addFileObject.phtml');
		 exit();*/
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

			/**
			 * Begin Upload Section
			 */
			if ($this -> uploadObj -> CheckIfThereIsFile() and $this -> uploadObj -> CheckIfThereIsNoErrorInUpload()) {
				if ($this -> uploadObj -> validatedSize()) {
					$this -> view -> sanitized -> size -> value = $this -> uploadObj -> size;
					$this -> view -> sanitized -> extension -> value = $this -> uploadObj -> extension;
					$this -> view -> sanitized -> mime -> value = $this -> uploadObj -> mime;
					$result = $this -> fileObj -> updateObject_fileById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
					if (is_numeric($this -> view -> sanitized -> Id -> value)) {
						$this -> uploadObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
						$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
						$result = $this -> fileObj -> updateObject_fileById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
						if (true === $fileUploaded) {
							$this -> fileObj -> updateObject_fileSizeColumnById($this -> view -> sanitized -> Id -> value, $this -> uploadObj -> size -> value);
							$relativePath = explode('disk' . DIRECTORY_SEPARATOR, $this -> uploadObj -> newFileName);
							$this -> fileObj -> updateObject_fileFull_pathColumnById($this -> view -> sanitized -> Id -> value, $relativePath[1]);
						}
						if ((false != $result) and (1 == $this -> view -> sanitized -> btn_submit -> value) and (true === $fileUploaded)) {
							header('Location: /admin/handle/pkg/object-file/action/list/s/1');
							exit();
						} else {
							header('Location: /admin/handle/pkg/object-file/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
							exit();
						}
					}
				}
			}
			/**
			 * End Upload Section
			 */

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

		$this -> fields['uploadFile'] = array('fileUploaded', 0);
		if ($this -> isPagePostBack) {

			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			$fileResult = $this -> fileObj -> getObject_fileDetailsById(( int )$_GET['id']);
			$fileResult = $fileResult[0];
			$this -> view -> sanitized -> Id -> value = $fileResult['id'];
			$this -> view -> sanitized -> objectId -> value = $fileResult['object_id'];
			if (empty($this -> errorMessage)) {
				if ($this -> uploadObj -> CheckIfThereIsFile() and $this -> uploadObj -> CheckIfThereIsNoErrorInUpload()) {
					if ($this -> uploadObj -> validatedSize()) {
						$this -> view -> sanitized -> size -> value = $this -> uploadObj -> size;
						$this -> view -> sanitized -> extension -> value = $this -> uploadObj -> extension;
						$this -> view -> sanitized -> mime -> value = $this -> uploadObj -> mime;
						$result = $this -> fileObj -> updateObject_fileById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
						if (is_numeric($this -> view -> sanitized -> Id -> value)) {
							$this -> uploadObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
							$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
							$result = $this -> fileObj -> updateObject_fileById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
							if (true === $fileUploaded) {
								$this -> fileObj -> updateObject_fileSizeColumnById($this -> view -> sanitized -> Id -> value, $this -> uploadObj -> size -> value);
								$relativePath = explode('disk' . DIRECTORY_SEPARATOR, $this -> uploadObj -> newFileName);
								$this -> fileObj -> updateObject_fileFull_pathColumnById($this -> view -> sanitized -> Id -> value, $relativePath[1]);
							}
							if ((false != $result) and (1 == $this -> view -> sanitized -> btn_submit -> value) and (true === $fileUploaded)) {
								header('Location: /admin/handle/pkg/object-file/action/list/s/1');
								exit();
							} else {
								header('Location: /admin/handle/pkg/object-file/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
								exit();
							}
						}
					}
				} else {
					$result = $this -> fileObj -> updateObject_fileById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameFile -> value, $this -> view -> sanitized -> labelFile -> value, $this -> view -> sanitized -> descriptionFile -> value, $this -> view -> sanitized -> directoryId -> value, $this -> userId, $fileResult['mime_type'], $fileResult['size'], $fileResult['extension'], $fileResult['full_path'], $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
					if ((false != $result) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-file/action/list/s/1');
						exit();
					} else {
						header('Location: /admin/handle/pkg/object-file/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
						exit();
					}
				}

			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> fileObj -> getObject_fileDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'fileId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $result['author_id']), 'nameFile' => array('codeConvention', 1, $result['name']), 'labelFile' => array('text', 1, $result['label']), 'descriptionFile' => array('text', 0, $result['description']), 'uploadFile' => array('fileUploaded', 1), 'directoryId' => array('numericUnsigned', 1, $result['directory_id']), 'category' => array('numericUnsigned', 1, $result['category_id']), 'size' => array('numericUnsigned', 1, $result['size']), 'mime' => array('regualText', 1, $result['mime']), 'extension' => array('text', 1, $result['extension']), 'showInObject' => array('text', 0, $result['show_in_object']), 'fullPath' => array('filePath', 0, $result['full_path']), 'objectId' => array('numericUnsigned', 0, $result['object_id']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2), 'source' => array('numeric', 0), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> fileObj -> order), 'afterId' => array('numeric', 0));
			$this -> view -> sanitized = array();
			$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
			$this -> view -> sanitized['Id']['value'] = ( int )$_GET['id'];
			$this -> view -> arrayToObject($this -> view -> sanitized);
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}

		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
		}

		$this -> view -> render('object/addFileObject.phtml');
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
				$where = $this -> fileObj -> getAdapter() -> quoteInto('id = ?', $id);
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
				$where = $this -> fileObj -> getAdapter() -> quoteInto('id = ?', $id);
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

		//listing
		$categoryListResult = $this -> categoryObj -> read();
		$countOfOCategoryListResult = count($categoryListResult);
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}

		if (empty($fileListResult) and false == $fileListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> category = $category;
		$this -> view -> objectList = $fileListResult;
		$this -> view -> render('object/listFileObject.phtml');
		exit();
	}

}
