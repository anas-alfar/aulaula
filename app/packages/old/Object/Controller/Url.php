<?php

class Object_Controller_Url extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $urlObj = NULL;
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
	private $articleObj = NULL;
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
		$this -> urlObj = new Object_Model_Url();
		$this -> sourceObj = new Object_Model_Source();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//locale and category objects
		$this -> localeObj = new Locale_Model_Default();
		$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'urlId' => array('numeric', 0), 'category' => array('numericUnsigned', 1), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 0), 'published' => array('text', 0, $this -> urlObj -> published), 'approved' => array('text', 0, $this -> urlObj -> approved), 'showInObject' => array('text', 0, $this -> urlObj -> showInObject), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'title' => array('text', 0), 'label' => array('text', 0), 'titleArticle' => array('text', 0), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('text', 0), 'fullTextArticle' => array('text', 0), 'sourceArticle' => array('numeric', 0), 'createdDateArticle' => array('shortDateTime', 0), 'publishFromArticle' => array('shortDateTime', 0), 'publishToArticle' => array('shortDateTime', 0), 'titlePhoto' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'sourcePhoto' => array('numeric', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('text', 0), 'publishFromPhoto' => array('shortDateTime', 0), 'publishToPhoto' => array('shortDateTime', 0), 'titleVideo' => array('text', 0), 'aliasVideo' => array('text', 0), 'introTextVideo' => array('text', 0), 'sourceVideo' => array('numeric', 0), 'takenDateVideo' => array('shortDateTime', 0), 'takenLocationVideo' => array('text', 0), 'encodedVideo' => array('text', 0), 'fileVideo' => array('text', 0), 'publishFromVideo' => array('shortDateTime', 0), 'publishToVideo' => array('shortDateTime', 0), 'titleSource' => array('numeric', 0), 'descriptionSource' => array('numeric', 0), 'typeSource' => array('numeric', 0), 'urlSource' => array('numeric', 0), 'localeSource' => array('numeric', 0), 'timeDelaySource' => array('numeric', 0), 'countrySource' => array('numeric', 0), 'titleUrl' => array('text', 0), 'aliasUrl' => array('text', 0), 'introTextUrl' => array('text', 0), 'sourceUrl' => array('numeric', 0), 'urlUrl' => array('url', 0), 'styleUrl' => array('text', 0), 'urlTypeUrl' => array('text', 0), 'titleStatic' => array('text', 0), 'aliasStatic' => array('text', 0), 'introTextStatic' => array('text', 0), 'fullTextStatic' => array('text', 0), 'UrlStatic' => array('text', 0), 'createdDateStatic' => array('shortDateTime', 0), 'publishFromStatic' => array('shortDateTime', 0), 'publishToStatic' => array('shortDateTime', 0), 'titleTag' => array('text', 0), 'titleAbuse' => array('text', 0), 'labelAbuse' => array('text', 0), 'descriptionAbuse' => array('text', 0), 'titleDirectory' => array('text', 0), 'labelDirectory' => array('text', 0), 'descriptionDirectory' => array('text', 0), 'parent' => array('numeric', 0), 'titleFile' => array('text', 0), 'nameFile' => array('text', 0), 'descriptionFile' => array('text', 0), 'directoryFile' => array('text', 0), 'object' => array('numeric', 0), 'locale' => array('numeric', 0), 'tag' => array('text', 0), 'pageTitle' => array('text', 0), 'originalAuthor' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'createdDate' => array('shortDateTime', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numeric', 0), 'template' => array('numeric', 0), 'skin' => array('numeric', 0), 'createdDate' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> urlObj -> getObject_urlDetailsById(( int )$_GET['id']);
			$result = $result[0];
			if (empty($this -> view -> sanitized['category']['value'])) {
				$this -> view -> sanitized['category']['value'] = $result['category_id'];
			}
			if (empty($this -> view -> sanitized['source']['value'])) {
				$this -> view -> sanitized['source']['value'] = $result['source_id'];
			}
			if (empty($this -> view -> sanitized['urlTypeUrl']['value'])) {
				$this -> view -> sanitized['urlTypeUrl']['value'] = $result['url_type'];
			}

			//locale list
			$this -> localeList = '';
			$this -> localeListResult = $this -> localeObj -> getAllLocaleOrderById();
			if (!empty($this -> localeListResult)) {
				foreach ($this->localeListResult as $key => $value) {
					$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
					$this -> localeList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
				}
			}
			$this -> view -> localeList = $this -> localeList;

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
		//source list
		$this -> view -> sanitized['source']['value'] = isset($this -> view -> sanitized['source']['value']) ? $this -> view -> sanitized['source']['value'] : '';
		$this -> sourceUrlList = '';
		$this -> sourceUrlListResult = $this -> sourceObj -> getAllObject_sourceOrderById();
		if (!empty($this -> sourceUrlListResult)) {
			foreach ($this->sourceUrlListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['source']['value']) ? 'selected="selected"' : '';
				$this -> sourceUrlList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['name'] . '</option>';
			}
		}
		$this -> view -> sourceUrlList = $this -> sourceUrlList;

		//url type list
		$this -> view -> sanitized['url_type']['value'] = isset($this -> view -> sanitized['url_type']['value']) ? $this -> view -> sanitized['url_type']['value'] : '';
		$this -> urlTypeUrlList = '';
		$this -> urlTypeUrlList .= '<option value="Link"' . ('Link' == $this -> view -> sanitized['url_type']['value'] ? 'selected="selected"' : '') . '>Link</option>';
		$this -> urlTypeUrlList .= '<option value="Iframe"' . ('Iframe' == $this -> view -> sanitized['url_type']['value'] ? 'selected="selected"' : '') . '>Iframe</option>';
		$this -> urlTypeUrlList .= '<option value="YouTube"' . ('YouTube' == $this -> view -> sanitized['url_type']['value'] ? 'selected="selected"' : '') . '>YouTube</option>';
		$this -> view -> urlTypeUrlList = $this -> urlTypeUrlList;

		//category list
		$this -> view -> sanitized['category']['value'] = isset($this -> view -> sanitized['category']['value']) ? $this -> view -> sanitized['category']['value'] : '';
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
		$this -> pagingObj -> totalRecordsPerPage = $this -> limit = 20;
		$this -> buildPaging();
		$renderFile = 'object/url/list.phtml';

		if (isset($_GET['category']) and !empty($_GET['category'])) {
			$categoryResult = $this -> categoryObj -> getCategoryDetailsById(( int )$_GET['category']);
			if ($categoryResult != FALSE) {
				$urlList = $this -> urlObj -> GetListingCleanObjectAndInfoAndUrlByCategoryIdsOrderByColumnWithLimit(( int )$_GET['category'], $this -> start, $this -> limit);
				$this -> view -> urlList = $urlList;
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

	public function hrefAction() {
		if (isset($_GET['id']) and !empty($_GET['id'])) {
			$urlDetails = $this -> urlObj -> GetAllCleanObject_urlByIdOrderById(( int )$_GET['id']);
			if ($urlDetails !== FALSE) {
				//Set total views (downloaded) count
				$objectInfoResult = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($urlDetails[0]['object_id']);
				$objectInfoResult[0]['total_views']++;
				$objectTotalViews = $this -> objectInfoObj -> updateObject_infoTotal_viewsColumnById($objectInfoResult[0]['id'], $objectInfoResult[0]['total_views']);
				header('Location: ' . $urlDetails[0]['url']);
			} else {
				header('Location: /');
				exit();
			}
		}
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

}
