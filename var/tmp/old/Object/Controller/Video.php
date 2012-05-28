<?php

class Object_Controller_Video extends Aula_Controller_Action {

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

		$this -> defualtAction = 'list';
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

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> pagingObj -> totalRecordsPerPage = $this -> limit = 20;
		$this -> buildPaging();
		$renderFile = 'object/video/list.phtml';

		if (isset($_GET['category']) and !empty($_GET['category'])) {
			$categoryResult = $this -> categoryObj -> getCategoryDetailsById(( int )$_GET['category']);
			if ($categoryResult != FALSE) {
				$videoList = $this -> videoObj -> GetListingCleanObjectAndInfoAndVideoByCategoryIdsOrderByColumnWithLimit(( int )$_GET['category'], $this -> start, $this -> limit);
				$objectIds = '';
				foreach ($videoList as $k => $video) {
					$objectIds .= $videoList[$k]['object_id'] . ',';
				}
				$objectIds = substr($objectIds, 0, strlen($objectIds) - 1);
				$photoList = $this -> photoObj -> GetAllCleanPhotoByObjectIdsOrderByColWithLimit($objectIds, 'op.id', 'ASC');
				foreach ($photoList as $key => $value) {
					$arrr[$value['object_id']] = $value;
				}
				foreach ($videoList as $k => $video) {
					if (isset($arrr[$video['object_id']])) {
						$videoList[$k]['imageUrl'] = parent::$encryptedUrl['photo']['medium'][substr($arrr[$video['object_id']]['date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $arrr[$video['object_id']]['id']) . '.jpg';
					}
				}
				$this -> view -> videoList = $videoList;
				$this -> view -> categoryDetails = $categoryResult[0];
			} else {
				header('Location: /');
				exit();
			}
		}

		$this -> buildPaging();
		$this -> pagingObj -> _init($this -> articleObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		$this -> view -> render($renderFile);
		exit();
	}

	public function viewAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> commentList = array();
		if (isset($_GET['id']) and !empty($_GET['id'])) {
			$videoDetails = $this -> videoObj -> GetListingCleanObjectAndInfoAndVideoById(( int )$_GET['id'], 0, 1);
			if ($videoDetails !== FALSE) {
				$videoDetails[0]['videoUrl'] = parent::$encryptedUrl['video']['flv'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $videoDetails[0]['id']) . '.flv';
			}
			//check if the file exsits or not
			if (!@fopen($videoDetails[0]['videoUrl'], 'r')) {
				$videoDetails[0]['videoUrl'] = null;
			}

			$this -> view -> youtube = '';
			$this -> view -> allowComments = 0;
			$_options = explode(PHP_EOL, $videoDetails[0]['options']);
			foreach ($_options as $value) {
				if (false !== strpos($value, 'YouTube')) {
					$this -> view -> youtube = substr($value, 8);
				} else if (false !== strpos($value, 'allowComments')) {
					$this -> view -> allowComments = substr($value, 14);
				}
			}
			$this -> pagingObj -> totalRecordsPerPage = $this -> limit = 100;
			$this -> view -> commentList = $this -> commentObj -> GetCleanObject_commentByObject_idOrderByIdWithLimit($videoDetails[0]['object_id'], $this -> start, $this -> limit, 'DESC');
			$this -> buildPaging();
			$this -> pagingObj -> _init($this -> commentObj -> _totalRecordsFound);
			$this -> view -> paging = $this -> pagingObj -> paging;
			$this -> view -> arrayToObject($this -> view -> paging);

			//chechk if allowed comments to sorted in the view page or not
			if ($this -> view -> allowComments == 1) {
				$this -> view -> commentList = $this -> commentObj -> GetCleanObject_commentByObject_idOrderByIdWithoutLimit($videoDetails[0]['object_id'], 'ASC');
			}

			//Set total views count
			$videoDetails[0]['total_views']++;
			//$objectInfoResult = $this->objectInfoObj->GetAllObject_infoByObject_idOrderById($videoDetails[0]['object_id']);
			$objectTotalViews = $this -> objectInfoObj -> updateObject_infoTotal_viewsColumnById($videoDetails[0]['object_info_id'], $videoDetails[0]['total_views']);

			$this -> view -> metaData = $videoDetails[0]['meta_data'];
			$this -> view -> pageTitle = $videoDetails[0]['page_title'];
			$this -> view -> metaTitle = $videoDetails[0]['meta_title'];
			$this -> view -> metaKeywords = $videoDetails[0]['meta_key'];
			$this -> view -> metaDescription = $videoDetails[0]['meta_desc'];
			foreach ($this->categoryListResult as $cat) {
				if ($cat['id'] == $videoDetails[0]['category_id']) {
					$this -> view -> categoryDetails = $cat;
					break;
				}
			}

			if (isset($_GET['comment']) && $_GET['comment'] == 'error') {
				$this -> view -> commentErrorMessage = $this -> view -> __('please check that your are entered correct data');
				$this -> view -> commentErrorMessageStyle = 'display:block';
			} else {
				$this -> view -> commentErrorMessage = '';
				$this -> view -> commentErrorMessageStyle = 'display:none';
			}
		} else {
			header('Location: /');
			exit();
		}

		$this -> view -> videoDetails = $videoDetails[0];
		$this -> view -> render('object/video/view.phtml');
		exit();
	}

	public function shareAction() {
	}

	public function sendToFriendAction() {
	}

}
