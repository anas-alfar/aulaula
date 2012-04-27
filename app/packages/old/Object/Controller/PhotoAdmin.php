<?php

class Object_Controller_PhotoAdmin extends Aula_Controller_Action {

	const ASSIGMENTS_CATEGORY_ID = 10;
	const ESSAYS_CATEGORY_ID = 25;

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
	private $userObj = NULL;

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//category object
	private $categoryObj = NULL;

	//upload object
	private $uploadObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> photoObj = new Object_Model_Photo();
		$this -> sourceObj = new Object_Model_Source();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//category objects
		$this -> categoryObj = new Category_Model_Default();

		//Upload Object
		$this -> uploadObj = new Aula_Model_Upload_Photo('filePhoto');

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'photoId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'titlePhoto' => array('text', 1), 'aliasPhoto' => array('text', 1), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 1), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('fileUploaded', 1, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'category' => array('numericUnsigned', 1), 'subCategoryId' => array('numericUnsigned', 0, 0), 'photoEssays' => array('numericUnsigned', 0, 0), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> photoObj -> showInObject), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> photoObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> photoObj -> published), 'approved' => array('text', 0, $this -> photoObj -> approved), 'comment' => array('text', 0, $this -> photoObj -> comments), 'option' => array('text', 0, $this -> photoObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> photoObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//source list
		$this -> sourcePhotoList = '';
		$this -> sourcePhotoListResult = $this -> sourceObj -> getAllObject_sourceOrderById();
		if (!empty($this -> sourcePhotoListResult)) {
			foreach ($this->sourcePhotoListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['sourcePhoto']['value']) ? 'selected="selected"' : '';
				$this -> sourcePhotoList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['name'] . '</option>';
			}
		}
		$this -> view -> sourcePhotoList = $this -> sourcePhotoList;

		//category list
		$this -> view -> categoryList = '';
		$this -> view -> categoryTopMenuList = '';
		$this -> view -> categoryDropDownList = '';
		$this -> categoryListResult = $this -> categoryObj -> GetAllCleanCategoryByParent_idOrderByColumn('id', 0);
		if (!empty($this -> categoryListResult)) {
			foreach ($this->categoryListResult as $key => $category) {
				$this -> categoryList[$category['id']] = $this -> view -> __($category['label']);
				$this -> view -> categoryTopMenuList .= '<li><a href="/object-photo/list/cat/' . $category['id'] . '">' . $this -> view -> __($category['label']) . '</a></li>' . PHP_EOL;
				$this -> view -> categoryDropDownList .= '<option value="' . $category['id'] . '">' . $this -> view -> __($category['label']) . '</option>' . PHP_EOL;
			}
		}
		$this -> view -> categoryList = $this -> view -> categoryDropDownList;

		$this -> photoEssaysList = '';
		$this -> photoEssaysListResult = $this -> categoryObj -> GetAllCategoryByParent_idOrderById(self::ESSAYS_CATEGORY_ID);
		if (!empty($this -> photoEssaysListResult)) {
			foreach ($this->photoEssaysListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['photoEssays']['value']) ? 'selected="selected"' : '';
				$this -> photoEssaysList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> photoEssaysList = $this -> photoEssaysList;

		//template list
		$this -> templateList = '';
		$this -> templateListResult = $this -> templateObj -> getAllTheme_templateOrderById();
		if (!empty($this -> templateListResult)) {
			foreach ($this->templateListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['template']['value']) ? 'selected="selected"' : '';
				$this -> templateList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> templateList = $this -> templateList;

		//layout list
		$this -> layoutList = '';
		$this -> layoutListResult = $this -> layoutObj -> getAllTheme_layoutOrderById();
		if (!empty($this -> layoutListResult)) {
			foreach ($this->layoutListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['layout']['value']) ? 'selected="selected"' : '';
				$this -> layoutList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> layoutList = $this -> layoutList;

		//skin list
		$this -> skinList = '';
		$this -> skinListResult = $this -> skinObj -> getAllTheme_skinOrderById();
		if (!empty($this -> skinListResult)) {
			foreach ($this->skinListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['skin']['value']) ? 'selected="selected"' : '';
				$this -> skinList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> skinList = $this -> skinList;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$photoEssays = self::ESSAYS_CATEGORY_ID;
				if ($this -> view -> sanitized -> photoEssays -> value === 0) {
					$photoEssays = 0;
				}

				$result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> titlePhoto -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $photoEssays, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> subCategoryId -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);

				if ($this -> uploadObj -> validatedMime()) {
					if ($this -> uploadObj -> validatedSize()) {
						$j = 1;
						$this -> view -> sanitized -> filePhoto -> size = $this -> uploadObj -> size;
						$this -> view -> sanitized -> filePhoto -> height = $this -> uploadObj -> height;
						$this -> view -> sanitized -> filePhoto -> width = $this -> uploadObj -> width;
						$this -> view -> sanitized -> filePhoto -> extension = $this -> uploadObj -> mime;
						$this -> view -> sanitized -> filePhoto_{$j} -> takenTime = $this -> uploadObj -> takenTime;
						$this -> view -> sanitized -> filePhoto_{$j} -> comments = $this -> uploadObj -> comments;
						$this -> view -> sanitized -> filePhoto_{$j} -> isColor = $this -> uploadObj -> isColor;
						if (empty($this -> view -> sanitized -> takenDatePhoto -> value)) {
							$this -> view -> sanitized -> takenDatePhoto -> value = $this -> uploadObj -> takenTime;
						}
						if (empty($this -> view -> sanitized -> comment -> value)) {
							$this -> view -> sanitized -> comment -> value = $this -> uploadObj -> comments;
						}
						$result = $this -> photoObj -> insertIntoObject_photo(Null, $this -> view -> sanitized -> aliasPhoto -> value, $this -> view -> sanitized -> introTextPhoto -> value, $this -> userId, $this -> view -> sanitized -> photoEssays -> value, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> filePhoto -> size, $this -> view -> sanitized -> filePhoto -> height, $this -> view -> sanitized -> filePhoto -> width, $this -> view -> sanitized -> filePhoto -> extension, $this -> view -> sanitized -> takenDatePhoto -> value, $this -> view -> sanitized -> takenLocationPhoto -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
						$this -> view -> sanitized -> Id -> value = $result[0];
						if (is_numeric($this -> view -> sanitized -> Id -> value)) {
							$this -> uploadObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . '.jpg';
							$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);

							$thumbUploaded = $this -> uploadObj -> resizeUploadImage(76, 52, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> _dateTodayVeryShortDate]);
							$thumbLargeUploaded = $this -> uploadObj -> resizeUploadImage(184, 125, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> _dateTodayVeryShortDate]);
							$mediumUploaded = $this -> uploadObj -> resizeUploadImage(470, 320, parent::$encryptedDisk['photo']['medium'][$this -> fc -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
							$largeMiniUploaded = $this -> uploadObj -> resizeUploadImage(600, 408, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
							$largeUploaded = $this -> uploadObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');

							$photoListResult = $this -> photoObj -> GetAllCleanPhotosOrderByColWithLimit(0, 1000);

							$photoListCache = 'var tinyMCEImageList = new Array(';
							foreach ($photoListResult as $key => $value) {
								$photoDate = explode('-', $value['date_added'], 3);
								$photoSRC4 = parent::$encryptedUrl['photo']['large-mini'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg';
								$photoListCache .= PHP_EOL . "\t" . '["' . addslashes($value['alias']) . '-large-mini", "' . $photoSRC4 . '"],';
							}
							$photoListCache = substr($photoListCache, 0, -1);
							$photoListCache .= PHP_EOL . ');';
							$settings = Zend_Registry::get('settings-cache');
							file_put_contents($settings -> photo_list -> disk, $photoListCache);

							if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
								header('Location: /admin/handle/pkg/object-photo/action/list/s/1');
								exit();
							} else {
								header('Location: /admin/handle/pkg/object-photo/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
								exit();
							}
						}
					} else {
						$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Size');
					}
				} else {
					$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Type');
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
		$this -> view -> render('object/addPhotoObject.phtml');
		exit();
	}

	public function importAction($sanitized, $objectId = 0) {
		if ($this -> uploadObj -> CheckIfThereIsFile() === TRUE) {
			if ($this -> uploadObj -> validatedMime()) {
				if ($this -> uploadObj -> validatedSize()) {
					$j = 1;
					$sanitized -> filePhoto -> size = $this -> uploadObj -> size;
					$sanitized -> filePhoto -> height = $this -> uploadObj -> height;
					$sanitized -> filePhoto -> width = $this -> uploadObj -> width;
					$sanitized -> filePhoto -> extension = $this -> uploadObj -> mime;
					$sanitized -> filePhoto_{$j} -> takenTime = $this -> uploadObj -> takenTime;
					$sanitized -> filePhoto_{$j} -> comments = $this -> uploadObj -> comments;
					$sanitized -> filePhoto_{$j} -> isColor = $this -> uploadObj -> isColor;
					if (empty($sanitized -> takenDatePhoto -> value)) {
						$sanitized -> takenDatePhoto -> value = $this -> uploadObj -> takenTime;
					}
					if (empty($sanitized -> comment -> value)) {
						$sanitized -> comment -> value = $this -> uploadObj -> comments;
					}
					$result = $this -> photoObj -> insertIntoObject_photo(Null, $sanitized -> aliasPhoto -> value, $sanitized -> introTextPhoto -> value, $this -> userId, $sanitized -> sourceArticle -> value, $objectId, $sanitized -> category -> value, $sanitized -> filePhoto -> size, $sanitized -> filePhoto -> height, $sanitized -> filePhoto -> width, $sanitized -> filePhoto -> extension, $sanitized -> takenDatePhoto -> value, $sanitized -> takenLocationPhoto -> value, $sanitized -> metaData -> value, $sanitized -> comment -> value, $sanitized -> option -> value, $sanitized -> showInObject -> value, $sanitized -> published -> value, $sanitized -> approved -> value, $sanitized -> order -> value, $sanitized -> publishFrom -> value, $sanitized -> publishTo -> value);
					$sanitized -> Id -> value = $result[0];
					if (is_numeric($sanitized -> Id -> value)) {
						$this -> uploadObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $sanitized -> Id -> value) . '.jpg';
						$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
						$thumbUploaded = $this -> uploadObj -> resizeUploadImage(55, 40, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> _dateTodayVeryShortDate]);
						$thumbLargeUploaded = $this -> uploadObj -> resizeUploadImage(75, 55, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> _dateTodayVeryShortDate]);
						$mediumUploaded = $this -> uploadObj -> resizeUploadImage(120, 90, parent::$encryptedDisk['photo']['medium'][$this -> fc -> _dateTodayVeryShortDate]);
						$largeMiniUploaded = $this -> uploadObj -> resizeUploadImage(372, 282, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> _dateTodayVeryShortDate]);
						$largeUploaded = $this -> uploadObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> _dateTodayVeryShortDate]);

						$photoListResult = $this -> photoObj -> GetAllCleanPhotosOrderByColWithLimit(0, 1000);

						$photoListCache = 'var tinyMCEImageList = new Array(';
						foreach ($photoListResult as $key => $value) {
							$photoDate = explode('-', $value['date_added'], 3);
							$photoSRC4 = parent::$encryptedUrl['photo']['large-mini'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg';
							$photoListCache .= PHP_EOL . "\t" . '["' . addslashes($value['alias']) . '-large-mini", "' . $photoSRC4 . '"],';
						}
						$photoListCache = substr($photoListCache, 0, -1);
						$photoListCache .= PHP_EOL . ');';
						$settings = Zend_Registry::get('settings-cache');
						file_put_contents($settings -> photo_list -> disk, $photoListCache);
					}
				} else {
					$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Size');
				}
			} else {
				$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Type');
			}
		}
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				if ($this -> view -> sanitized -> order -> value == -1) {
					$this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
				}
				$result = $this -> photoObj -> getObject_photoDetailsById(( int )$_GET['id']);
				$result = $result[0];
				$objectDetails = $this -> objectObj -> getObjectDetailsById($result['object_id']);
				$objectId = $objectDetails[0]['id'];
				$objectInfoDetails = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($objectId);
				$objectInfoId = $objectInfoDetails[0]['id'];
				/**
				 *
				 * @todo upload photo field must not be required
				 */
				$photoEssays = self::ESSAYS_CATEGORY_ID;
				if ($this -> view -> sanitized -> photoEssays -> value === 0) {
					$photoEssays = 0;
				}
				$resultObject = $this -> objectObj -> updateObjectById($objectId, $this -> view -> sanitized -> titlePhoto -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $photoEssays, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$result = $this -> objectInfoObj -> updateObject_infoById($objectInfoId, $objectId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);

				if ($this -> uploadObj -> validatedMime()) {
					if ($this -> uploadObj -> validatedSize()) {
						$this -> view -> sanitized -> filePhoto -> size = $this -> uploadObj -> size;
						$this -> view -> sanitized -> filePhoto -> height = $this -> uploadObj -> height;
						$this -> view -> sanitized -> filePhoto -> width = $this -> uploadObj -> width;
						$this -> view -> sanitized -> filePhoto -> extension = $this -> uploadObj -> mime;
						$result = $this -> photoObj -> updateObject_photoById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> aliasPhoto -> value, $this -> view -> sanitized -> introTextPhoto -> value, $this -> userId, $this -> view -> sanitized -> photoEssays -> value, $objectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> filePhoto -> size, $this -> view -> sanitized -> filePhoto -> height, $this -> view -> sanitized -> filePhoto -> width, $this -> view -> sanitized -> filePhoto -> extension, $this -> view -> sanitized -> takenDatePhoto -> value, $this -> view -> sanitized -> takenLocationPhoto -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
						if (is_numeric($this -> view -> sanitized -> Id -> value)) {
							$this -> uploadObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . '.jpg';
							$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);

							$thumbUploaded = $this -> uploadObj -> resizeUploadImage(76, 52, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> _dateTodayVeryShortDate]);
							$thumbLargeUploaded = $this -> uploadObj -> resizeUploadImage(184, 125, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> _dateTodayVeryShortDate]);
							$mediumUploaded = $this -> uploadObj -> resizeUploadImage(470, 320, parent::$encryptedDisk['photo']['medium'][$this -> fc -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
							$largeMiniUploaded = $this -> uploadObj -> resizeUploadImage(600, 408, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
							$largeUploaded = $this -> uploadObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');

							$photoListResult = $this -> photoObj -> GetAllCleanPhotosOrderByColWithLimit(0, 1000);

							$photoListCache = 'var tinyMCEImageList = new Array(';

							foreach ($photoListResult as $key => $value) {
								$photoDate = explode('-', $value['date_added'], 3);

								$photoSRC4 = parent::$encryptedUrl['photo']['large-mini'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg';

								$photoListCache .= PHP_EOL . "\t" . '["' . addslashes($value['alias']) . '-large-mini", "' . $photoSRC4 . '"],';
							}

							$photoListCache = substr($photoListCache, 0, -1);
							$photoListCache .= PHP_EOL . ');';

							$settings = Zend_Registry::get('settings-cache');
							file_put_contents($settings -> photo_list -> disk, $photoListCache);
							if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
								header('Location: /admin/handle/pkg/object-photo/action/list/s/1');
								exit();
							} else {

								header('Location: /admin/handle/pkg/object-photo/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
								exit();
							}
						}
					} else {
						$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Size');
					}
				} else {
					$this -> errorMessage['filePhoto'] = $this -> view -> __('Invalid File Type');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> photoObj -> getObject_photoDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$resultObject = $this -> objectObj -> getObjectDetailsById($result['object_id']);
			$resultObject = $resultObject[0];
			$resultObjectInfo = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($resultObject['id']);
			$resultObjectInfo = $resultObjectInfo[0];

			$result['taken_date'] = substr($result['taken_date'], 0, 10);
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$resultObject['created_date'] = substr($resultObject['created_date'], 0, 10);
			$resultObjectInfo['theme_publish_from'] = substr($resultObjectInfo['theme_publish_from'], 0, 10);
			$resultObjectInfo['theme_publish_to'] = substr($resultObjectInfo['theme_publish_to'], 0, 10);

			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'photoId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'titlePhoto' => array('text', 1, $resultObject['title']), 'aliasPhoto' => array('text', 1, $result['alias']), 'introTextPhoto' => array('text', 0, $result['intro_text']), 'sourcePhoto' => array('numeric', 1, $result['source_id']), 'takenDatePhoto' => array('shortDateTime', 0, $result['taken_date']), 'takenLocationPhoto' => array('text', 0, $result['taken_location']), 'filePhoto' => array('fileUploaded', 1, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'category' => array('numericUnsigned', 1, $result['category_id']), 'subCategoryId' => array('numericUnsigned', 0, 0), 'photoEssays' => array('numericUnsigned', 0, 0), 'tag' => array('text', 0, $resultObject['tags']), 'showInObject' => array('text', 0, $result['show_in_object']), 'originalAuthor' => array('text', 0, $resultObject['original_author']), 'createdDate' => array('shortDateTime', 0, $resultObject['created_date']), 'themePublishFrom' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_from']), 'themePublishTo' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_to']), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'parent' => array('numericUnsigned', 0, $resultObject['parent_id']), 'objectType' => array('numericUnsigned', 0, $resultObject['type_id']), 'showInList' => array('text', 0, $resultObject['show_in_list']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'pageTitle' => array('text', 0, $resultObject['page_title']), 'metaTitle' => array('text', 0, $resultObject['meta_title']), 'metaKey' => array('text', 0, $resultObject['meta_key']), 'metaDesc' => array('text', 0, $resultObject['meta_desc']), 'metaData' => array('text', 0, $resultObject['meta_data']), 'layout' => array('numericUnsigned', 0, $resultObjectInfo['layout_id']), 'template' => array('numericUnsigned', 0, $resultObjectInfo['template_id']), 'skin' => array('numericUnsigned', 0, $resultObjectInfo['skin_id']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
			$this -> view -> sanitized = array();
			$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
			$this -> view -> sanitized['Id']['value'] = ( int )$_GET['id'];
			$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
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

		$this -> view -> render('object/addPhotoObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> photoId -> value)) {
			foreach ($this->view->sanitized->photoId->value as $id => $value) {
				$photoDelete = $this -> photoObj -> deleteFromObject_photoById($id);
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
				$photoShowInObject = $this -> photoObj -> updateObject_photoShow_in_objectColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$photoPublish = $this -> photoObj -> updateObject_photoPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$photoAprrove = $this -> photoObj -> updateObject_photoApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'photoId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'showInObject' => array('text', 0), 'published' => array('text', 0), 'approved' => array('text', 0), 'date_added' => array('shortDateTime', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> showInListList = array('Yes' => $this -> view -> __('Yes'), 'No' => $this -> view -> __('No'));
		$this -> view -> publishedList = array('Yes' => $this -> view -> __('Yes'), 'No' => $this -> view -> __('No'));
		$this -> view -> approvedList = array('Yes' => $this -> view -> __('Yes'), 'No' => $this -> view -> __('No'));

		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-photo/action/';
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
		$this -> view -> sort -> alias -> cssClass = 'sort-title';
		$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
		$this -> view -> sort -> cat -> cssClass = 'sort-title';
		$this -> view -> sort -> cat -> href = $this -> view -> sanitized -> actionURI -> value . 'list/cat/asc';
		$this -> view -> sort -> showInObject -> cssClass = 'sort-title';
		$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['alias']) && $_GET['alias'] == 'asc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/desc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByAliasWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'desc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByAliasWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['cat']) && $_GET['cat'] == 'asc') {
			$this -> view -> sort -> cat -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> cat -> href = $this -> view -> sanitized -> actionURI -> value . 'list/cat/desc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByCategory_idWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['cat']) && $_GET['cat'] == 'desc') {
			$this -> view -> sort -> cat -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> cat -> href = $this -> view -> sanitized -> actionURI -> value . 'list/cat/asc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByCategory_idWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'asc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/desc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByShow_in_objectWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'desc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByShow_in_objectWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$photoListResult = $this -> photoObj -> GetAllObject_photoByCategory_idOrderByIdWithLimit(( int )$_GET['id']);
		} else {
			$photoListResult = $this -> photoObj -> getAllObject_photoOrderByIdWithLimit($this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> photoObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		$category = '';
		$objectList = '';

		$categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		$countOfOCategoryListResult = count($categoryListResult);
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}
		if (!empty($photoListResult) and false != $photoListResult) {
			foreach ($photoListResult as $key => $value) {
				$photoDate = explode('-', $value['date_added'], 3);
				$photoSRC = parent::$encryptedUrl['photo']['thumb'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg';
				$largePhotoSRC = parent::$encryptedUrl['photo']['large'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg';

				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="photoId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop"><a href="' . $largePhotoSRC . '" target="_blank"><img src="' . $photoSRC . '" border="0px" alt="' . $value['alias'] . '" title="' . $value['alias'] . '" /></a></td>';
				$objectList .= '<td class="jstalgntop">' . $value['alias'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_object']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-photo/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listPhotoObject.phtml');
		exit();
	}

	public function listSubCatAjaxAction() {
		$subCategoryList = '<input class="inptflx" type="text" value="0" name="subCategoryId" readonly="readonly" />';
		if (!isset($_POST['category']) or empty($_POST['category'])) {
			echo $subCategoryList;
			exit();
		}
		$categoryId = ( int )$_POST['category'];
		$subCategoryListResult = $this -> categoryObj -> GetAllCategoryByParent_idOrderById($categoryId);
		if (!empty($subCategoryListResult)) {
			$subCategoryList = '<select class="inptslct" id="subCategoryId" name="subCategoryId">';
			foreach ($subCategoryListResult as $key => $value) {
				$subCategoryList .= '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';
			}
			$subCategoryList .= '</select>';
		}

		echo $subCategoryList;
		exit();
	}

}
