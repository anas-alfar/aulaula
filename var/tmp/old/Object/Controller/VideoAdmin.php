<?php

class Object_Controller_VideoAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $articleObj = NULL;
	private $commentObj = NULL;
	private $directoryObj = NULL;
	private $fileObj = NULL;
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
		$this -> videoObj = new Object_Model_Video();
		$this -> photoObj = new Object_Model_Photo();
		$this -> sourceObj = new Object_Model_Source();
		$this -> commentObj = new Object_Model_Comment();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();
		$this -> categoryObj = new Category_Model_Default();

		//Upload Object
		$this -> uploadObj = new Aula_Model_Upload_Video('fileVideo');

		//object-photo controller and Object
		$this -> photo = new Object_Controller_Photo($this -> fc);

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'status' => array('text', 0, 'Yes'), 'youTubeVideo' => array('text', 0), 'videoId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleVideo' => array('text', 1), 'aliasVideo' => array('text', 1), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numericUnsigned', 1), 'takenDateVideo' => array('shortDateTime', 0), 'takenLocationVideo' => array('text', 0), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'encoded' => array('text', 0, $this -> videoObj -> encoded), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> videoObj -> showInObject), 'originalAuthor' => array('text', 0), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> videoObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> videoObj -> published), 'approved' => array('text', 0, $this -> videoObj -> approved), 'comment' => array('', 0, $this -> videoObj -> comments), 'option' => array('', 0, $this -> videoObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> videoObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		$this -> view -> sanitized['sourceArticle']['value'] = 1;
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> videoObj -> getObject_videoDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
			if (empty($this -> view -> sanitized['sourceVideo']['value'])) {
				$this -> view -> sanitized['sourceVideo']['value'] = $result['source_id'];
			}
		}
		//source list
		$this -> sourceVideoList = '';
		$this -> sourceVideoListResult = $this -> sourceObj -> getAllObject_sourceOrderById();
		if (!empty($this -> sourceVideoList)) {
			foreach ($this->sourceVideoList as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['sourceVideo']['value']) ? 'selected="selected"' : '';
				$this -> sourceVideoList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['name'] . '</option>';
			}
		}
		$this -> view -> sourceVideoList = $this -> sourceVideoList;

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
				$this -> view -> sanitized -> aliasPhoto -> value = $this -> view -> sanitized -> titleVideo -> value;

				$result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> titleVideo -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceVideo -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$ObjectId = $result[0];
				$this -> photo -> importAction($this -> view -> sanitized, $ObjectId);
				$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $ObjectId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
				if (!empty($this -> view -> sanitized -> youTubeVideo -> value)) {
					$this -> view -> sanitized -> option -> value .= PHP_EOL . 'YouTube=' . $this -> view -> sanitized -> youTubeVideo -> value;
				}
				$this -> view -> sanitized -> fileVideo -> size = NULL;
				$this -> view -> sanitized -> fileVideo -> height = NULL;
				$this -> view -> sanitized -> fileVideo -> width = NULL;
				$this -> view -> sanitized -> fileVideo -> extension = NULL;
				$result = $this -> videoObj -> insertIntoObject_video(Null, $this -> view -> sanitized -> aliasVideo -> value, $this -> view -> sanitized -> introTextVideo -> value, $this -> userId, $this -> view -> sanitized -> sourceVideo -> value, $ObjectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> fileVideo -> size, $this -> view -> sanitized -> fileVideo -> height, $this -> view -> sanitized -> fileVideo -> width, $this -> view -> sanitized -> fileVideo -> extension, $this -> view -> sanitized -> takenDateVideo -> value, $this -> view -> sanitized -> takenLocationVideo -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($this -> uploadObj -> CheckIfThereIsFile() === TRUE) {
					if ($this -> uploadObj -> validatedMime()) {
						if ($this -> uploadObj -> validatedSize()) {
							$this -> view -> sanitized -> fileVideo -> size = $this -> uploadObj -> size;
							$this -> view -> sanitized -> fileVideo -> height = $this -> uploadObj -> height;
							$this -> view -> sanitized -> fileVideo -> width = $this -> uploadObj -> width;
							$this -> view -> sanitized -> fileVideo -> extension = $this -> uploadObj -> mime;
							$result = $this -> videoObj -> updateObject_videoById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> aliasVideo -> value, $this -> view -> sanitized -> introTextVideo -> value, $this -> userId, $this -> view -> sanitized -> sourceVideo -> value, $ObjectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> fileVideo -> size, $this -> view -> sanitized -> fileVideo -> height, $this -> view -> sanitized -> fileVideo -> width, $this -> view -> sanitized -> fileVideo -> extension, $this -> view -> sanitized -> takenDateVideo -> value, $this -> view -> sanitized -> takenLocationVideo -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
							if (is_numeric($this -> view -> sanitized -> Id -> value)) {
								//upload video
								$this -> uploadObj -> newFileName = parent::$encryptedDisk['video']['flv'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . '.flv';
								$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
							}
						}
					}
				}
				if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
					header('Location: /admin/handle/pkg/object-video/action/list/s/1');
					exit();
				} else {
					header('Location: /admin/handle/pkg/object-video/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
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
		$this -> view -> photosList = "";
		$this -> view -> render('object/addVideoObject.phtml');
		exit();
	}

	public function importAction($sanitized, $objectId = 0) {
		if ($this -> uploadObj -> CheckIfThereIsFile() === TRUE) {
			if ($this -> uploadObj -> validatedMime()) {
				if ($this -> uploadObj -> validatedSize()) {
					$sanitized -> fileVideo -> size = $this -> uploadObj -> size;
					$sanitized -> fileVideo -> height = $this -> uploadObj -> height;
					$sanitized -> fileVideo -> width = $this -> uploadObj -> width;
					$sanitized -> fileVideo -> extension = $this -> uploadObj -> mime;
					$sanitized -> fileVideo -> takenTime = $this -> uploadObj -> takenTime;
					$sanitized -> fileVideo -> takenLocation = $this -> uploadObj -> takenLocation;
					$result = $this -> videoObj -> insertIntoObject_video(Null, $sanitized -> aliasVideo -> value, $sanitized -> introTextArticle -> value, $this -> userId, $sanitized -> sourceArticle -> value, $objectId, $sanitized -> category -> value, $sanitized -> fileVideo -> size, $sanitized -> fileVideo -> height, $sanitized -> fileVideo -> width, $sanitized -> fileVideo -> extension, $sanitized -> fileVideo -> takenTime, $sanitized -> fileVideo -> takenLocation, $sanitized -> metaData -> value, $sanitized -> comment -> value, $sanitized -> option -> value, $sanitized -> showInObject -> value, $sanitized -> published -> value, $sanitized -> approved -> value, $sanitized -> order -> value, $sanitized -> publishFrom -> value, $sanitized -> publishTo -> value, 'Yes');
					$sanitized -> Id -> value = $result[0];
					if (is_numeric($sanitized -> Id -> value)) {
						$this -> uploadObj -> newFileName = parent::$encryptedDisk['file'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $sanitized -> Id -> value) . '.flv';
						$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
					}
				} else {
					$this -> errorMessage['fileVideo'] = $this -> view -> __('Invalid File Size');
				}
			} else {
				$this -> errorMessage['fileVideo'] = $this -> view -> __('Invalid File Type');
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
				if (!empty($this -> view -> sanitized -> youTubeVideo -> value)) {
					$this -> view -> sanitized -> option -> value .= PHP_EOL . "YouTube=" . $this -> view -> sanitized -> youTubeVideo -> value;
				}
				$result = $this -> videoObj -> getObject_videoDetailsById(( int )$_GET['id']);
				$result = $result[0];
				$objectDetails = $this -> objectObj -> getObjectDetailsById($result['object_id']);
				$objectId = $objectDetails[0]['id'];
				$objectInfoDetails = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($objectId);
				$objectInfoId = $objectInfoDetails[0]['id'];
				$resultObject = $this -> objectObj -> updateObjectById($objectId, $this -> view -> sanitized -> titleVideo -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceVideo -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$result = $this -> objectInfoObj -> updateObject_infoById($objectInfoId, $objectId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
				$this -> photo -> importAction($this -> view -> sanitized, $objectId);
				$this -> view -> sanitized -> Id -> value = ( int )$_GET['id'];
				$result = $this -> videoObj -> updateObject_videoById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> aliasVideo -> value, $this -> view -> sanitized -> introTextVideo -> value, $this -> userId, $this -> view -> sanitized -> sourceVideo -> value, $objectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> fileVideo -> size, $this -> view -> sanitized -> fileVideo -> height, $this -> view -> sanitized -> fileVideo -> width, $this -> view -> sanitized -> fileVideo -> extension, $this -> view -> sanitized -> takenDateVideo -> value, $this -> view -> sanitized -> takenLocationVideo -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
				if ($this -> uploadObj -> validatedMime() && $this -> uploadObj -> CheckIfThereIsFile()) {
					if ($this -> uploadObj -> validatedSize()) {
						$this -> view -> sanitized -> fileVideo -> size = $this -> uploadObj -> size;
						$this -> view -> sanitized -> fileVideo -> height = $this -> uploadObj -> height;
						$this -> view -> sanitized -> fileVideo -> width = $this -> uploadObj -> width;
						$this -> view -> sanitized -> fileVideo -> extension = $this -> uploadObj -> mime;
						if (is_numeric($this -> view -> sanitized -> Id -> value)) {
							$this -> uploadObj -> newFileName = parent::$encryptedDisk['video']['flv'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . '.flv';
							$fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
						} else {
							$this -> errorMessage['fileVideo'] = $this -> view -> __('Invalid File Size');
						}
					}
				} else {
					$this -> errorMessage['fileVideo'] = $this -> view -> __('Invalid File Type');
				}
				if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
					header('Location: /admin/handle/pkg/object-video/action/list/s/1');
					exit();
				} else {
					header('Location: /admin/handle/pkg/object-video/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> videoObj -> getObject_videoDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$resultObject = $this -> objectObj -> getObjectDetailsById($result['object_id']);
			$resultObject = $resultObject[0];
			$resultObjectInfo = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($resultObject['id']);
			$resultObjectInfo = $resultObjectInfo[0];
			$resultObjectPhoto = $this -> photoObj -> GetAllCleanPhotoByObjectIdOrderByColWithLimit($resultObject['id']);
			$this -> view -> photosList = "";
			if (!empty($resultObjectPhoto)) {
				foreach ($resultObjectPhoto as $key => $value) {
					$this -> view -> photosList .= '<img src="' . parent::$encryptedUrl['photo']['original'][substr($value['date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg' . '" alt="" title="" width="125px" height="100px" />&nbsp;';
				}
			}
			$result['taken_date'] = substr($result['taken_date'], 0, 10);
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$resultObject['created_date'] = substr($resultObject['created_date'], 0, 10);
			$resultObjectInfo['theme_publish_from'] = substr($resultObjectInfo['theme_publish_from'], 0, 10);
			$resultObjectInfo['theme_publish_to'] = substr($resultObjectInfo['theme_publish_to'], 0, 10);
			$_options = explode(PHP_EOL, $result['options']);
			$_youTubeVideo = '';
			$result['options'] = '';
			foreach ($_options as $value) {
				if (false !== strpos($value, 'YouTube')) {
					$_youTubeVideo = substr($value, 8);
					continue;
				}
				$result['options'] .= $value . PHP_EOL;
			}
			$result['options'] = substr($result['options'], 0, -1);
			$this -> fields = array('aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'youTubeVideo' => array('codeConvention', 0, $_youTubeVideo), 'videoId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $resultObject['author_id']), 'titleVideo' => array('text', 1, $resultObject['title']), 'aliasVideo' => array('text', 1, $result['alias']), 'introTextVideo' => array('text', 0, $result['intro_text']), 'sourceVideo' => array('numericUnsigned', 1, $result['source_id']), 'takenDateVideo' => array('shortDateTime', 0, $result['taken_date']), 'takenLocationVideo' => array('text', 0, $result['taken_location']), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'encoded' => array('text', 0, $this -> videoObj -> encoded), 'category' => array('numericUnsigned', 1, $result['category_id']), 'tag' => array('text', 0, $resultObject['tags']), 'showInObject' => array('text', 0, $result['show_in_object']), 'originalAuthor' => array('text', 0, $resultObject['original_author']), 'createdDate' => array('shortDateTime', 0, $resultObject['created_date']), 'themePublishFrom' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_from']), 'themePublishTo' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_to']), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'parent' => array('numericUnsigned', 0, $resultObject['parent_id']), 'objectType' => array('numericUnsigned', 0, $resultObject['type_id']), 'showInList' => array('text', 0, $resultObject['show_in_list']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('', 0, $result['comments']), '' => array('text', 0, $result['options']), 'pageTitle' => array('text', 0, $resultObject['page_title']), 'metaTitle' => array('text', 0, $resultObject['meta_title']), 'metaKey' => array('text', 0, $resultObject['meta_key']), 'metaDesc' => array('text', 0, $resultObject['meta_desc']), 'metaData' => array('text', 0, $resultObject['meta_data']), 'layout' => array('numericUnsigned', 0, $resultObjectInfo['layout_id']), 'template' => array('numericUnsigned', 0, $resultObjectInfo['template_id']), 'skin' => array('numericUnsigned', 0, $resultObjectInfo['skin_id']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('object/addVideoObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> videoId -> value)) {
			foreach ($this->view->sanitized->videoId->value as $id => $value) {
				$videoDelete = $this -> videoObj -> deleteFromObject_videoById($id);
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
				$videoShowInMenu = $this -> videoObj -> updateObject_videoShow_in_objectColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$videoPublish = $this -> videoObj -> updateObject_videoPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$videoAprrove = $this -> videoObj -> updateObject_videoApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderById();
		} elseif (isset($_GET['category']) && $_GET['category'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderById();
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'asc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/desc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByAliasWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'desc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByAliasWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'asc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/desc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByShow_in_ObjectWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'desc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByShow_in_ObjectWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$videoListResult = $this -> videoObj -> getAllObject_videoOrderByIdWithLimit($this -> start, $this -> limit);
		}
		$this -> pagingObj -> _init($this -> videoObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		//		$objectListResult = $this->objectObj->getAllObjectOrderById ();
		//		$countOfObjectListResult = count ( $objectListResult );
		$categoryListResult = $this -> categoryObj -> getAllCategoryOrderById();
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		$objectList = '';
		if (!empty($videoListResult) and false != $videoListResult) {
			foreach ($videoListResult as $key => $value) {
				for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
					if ($categoryListResult[$i]['id'] == $value['category_id']) {
						$category = $categoryListResult[$i]['label'];
						break;
					}
				}
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="videoId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $category . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['alias'] . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_object']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-video/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listVideoObject.phtml');
		exit();
	}

}
