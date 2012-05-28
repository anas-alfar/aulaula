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

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);

			if (empty($this -> errorMessage)) {
				/**
				 * @todo: full path is static like /home/saed/,,,, and this is wrong
				 */

				/*if ($this->uploadObj->validatedMime ()) {*/
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
				/*} else {
				 $this->errorMessage ['uploadFile'] = $this->view->__ ( 'Invalid File Type' );
				 }*/
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
		exit();
	}

	public function editAction() {
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
				$fileDelete = $this -> fileObj -> deleteFromObject_fileById($id);
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
				$fileShowInMenu = $this -> fileObj -> updateObject_fileShow_in_objectColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$filePublish = $this -> fileObj -> updateObject_filePublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$fileApprove = $this -> fileObj -> updateObject_fileApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

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

		//sorting
		$this -> view -> sort -> category -> cssClass = 'sort-title';
		$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
		$this -> view -> sort -> name -> cssClass = 'sort-title';
		$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/asc';
		$this -> view -> sort -> showInObject -> cssClass = 'sort-title';
		$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['category']) && $_GET['category'] == 'asc') {
			$this -> view -> sort -> category -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/desc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByCategory_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['category']) && $_GET['category'] == 'desc') {
			$this -> view -> sort -> category -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByCategory_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['name']) && $_GET['name'] == 'asc') {
			$this -> view -> sort -> name -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/desc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByNameWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['name']) && $_GET['name'] == 'desc') {
			$this -> view -> sort -> name -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> name -> href = $this -> view -> sanitized -> actionURI -> value . 'list/name/asc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByNameWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'asc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/desc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByShow_in_objectWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'desc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByShow_in_objectWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$fileListResult = $this -> fileObj -> getAllObject_fileOrderByIdWithLimit($this -> start, $this -> limit);

		}

		//listing
		$categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		$objectList = '';
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}

		if (!empty($fileListResult) and false != $fileListResult) {
			foreach ($fileListResult as $key => $value) {
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="fileId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $category[$value['category_id']] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['name'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_object']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-file/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listFileObject.phtml');
		exit();
	}

}
