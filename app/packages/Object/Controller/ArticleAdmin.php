<?php

class Object_Controller_ArticleAdmin extends Aula_Controller_Action {

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
	private $usersObj = NULL;
	private $usersInfoObj = NULL;
	private $userFavouriteObj = NULL;

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//category object
	private $categoryObj = NULL;

	//photo controller
	private $photo = NULL;

	//photo model object
	private $photoObj = NULL;

	//video controller
	private $video = NULL;

	//left column in the frontend template
	private $newsEntertainmentList = NULL;
	private $newsSportsList = NULL;
	private $newsWorldMiscList = NULL;

	protected function _init() {

		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> articleObj = new Object_Model_Article();
		$this -> commentObj = new Object_Model_Comment();
		$this -> sourceObj = new Object_Model_Source();
		$this -> videoObj = new Object_Model_Video();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//category objects
		$this -> categoryObj = new Category_Model_Default();

		//users objects
		$this -> usersObj = new User_Model_Default();
		$this -> usersInfoObj = new User_Model_Info();

		//object-photo controller and Object
		$this -> photo = new Object_Controller_PhotoAdmin($this -> fc);

		$this -> photoObj = new Object_Model_Photo();

		//object-video controller and Object
		$this -> video = new Object_Controller_VideoAdmin($this -> fc);

		//Featured controller and Object
		$this -> featureObj = new Feature_Controller_DefaultAdmin($this -> fc);

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'redirectURI' => array('uri', 0, ''), 'updateDate' => array('text', 0), 'youTubeVideo' => array('text', 0), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'fileAuthor' => array('fileUploaded', 0, (!empty($_FILES['fileAuthor']['name']) ? $_FILES['fileAuthor']['name'] : '')), 'aliasVideo' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'status' => array('text', 0, 'Yes'), 'articleId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'author_id' => array('numericUnsigned', 0), 'titleArticle' => array('text', 1), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('', 0), 'fullTextArticle' => array('', 1), 'sourceArticle' => array('numeric', 1), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> articleObj -> showInObject), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> articleObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> articleObj -> published), 'approved' => array('text', 0, $this -> articleObj -> approved), 'featured' => array('text', 0, 'No'), 'comment' => array('', 0, $this -> articleObj -> comments), 'option' => array('', 0, $this -> articleObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> articleObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

	}

	public function addAction() {
		$form = new Object_Form_Article($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$query = $this -> articleObj -> getAdapter() -> query('UPDATE object_article SET `order`=`order`+1', array());
			$query -> execute();

			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$lastInsertId = $this -> objectObj -> insert($objectData);

			if ($lastInsertId !== false) {
				$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
				$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);
				if ($lastInsertIdInfo !== false) {
					$objectArticleData = array('alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'full_text' => $_POST['mandatory']['full_text'], 'author_id' => $this -> userId, 'object_id' => $lastInsertId, 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
					$lastInsertIdPhoto = $this -> articleObj -> insert($objectArticleData);

					header('Location: /admin/handle/pkg/object-article/action/list/');
					exit();
				}

			}

		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addArticle.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);

		 if (empty($this -> errorMessage)) {
		 if ($this -> view -> sanitized -> order -> value == -1) {
		 $this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
		 }
		 if (empty($this -> view -> sanitized -> aliasVideo -> value)) {
		 $this -> view -> sanitized -> aliasVideo -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> aliasPhoto -> value)) {
		 $this -> view -> sanitized -> aliasPhoto -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> pageTitle -> value)) {
		 $this -> view -> sanitized -> pageTitle -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> metaTitle -> value)) {
		 $this -> view -> sanitized -> metaTitle -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> metaKey -> value)) {
		 $this -> view -> sanitized -> metaKey -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> metaDesc -> value)) {
		 $this -> view -> sanitized -> metaDesc -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> aliasArticle -> value)) {
		 $this -> view -> sanitized -> aliasArticle -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> introTextArticle -> value)) {
		 $this -> view -> sanitized -> introTextArticle -> value = $this -> view -> subString($this -> view -> sanitized -> fullTextArticle -> value, 0, 200) . '...';
		 }
		 if (isset($GLOBALS['AULA_BLACKLIST']['fullTextArticle'])) {
		 $this -> view -> sanitized -> fullTextArticle -> value = $GLOBALS['AULA_BLACKLIST']['fullTextArticle'];
		 }

		 if (0 == $this -> view -> sanitized -> author_id -> value) {
		 $result = $this -> usersObj -> insertIntoUser(Null, $this -> view -> sanitized -> originalAuthor -> value, md5(md5(rand(9, 999999))), $this -> view -> sanitized -> originalAuthor -> value, "", "3");
		 $resultInfo = $this -> usersInfoObj -> insertIntoUser_info(NULL, $result[0], NULL, date('Y-m-d H:i:s'), NULL, NULL, NULL, NULL, NULL, NULL, NULL, "", "Yes", "No", "No", NULL, NULL, NULL, NULL, "", "");
		 //Upload Object
		 $authorUploadObj = new Aula_Model_Upload_Photo('fileAuthor');
		 if ($authorUploadObj -> CheckIfThereIsFile() === TRUE) {
		 if ($authorUploadObj -> validatedMime()) {
		 if ($authorUploadObj -> validatedSize()) {
		 if (is_numeric($result[0])) {
		 $thumbName = parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $result[0]) . '-thumb.jpg';
		 $mediumName = parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $result[0]) . '-medium.jpg';
		 $authorUploadObj -> newFileName = parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $result[0]) . '.jpg';
		 $fileUploaded = $authorUploadObj -> uploadFile($authorUploadObj -> newFileName);

		 copy($authorUploadObj -> newFileName, $thumbName);
		 $authorUploadObj -> newFileName = $thumbName;
		 $authorUploadObj -> resizeUploadImage(55, 40, parent::$encryptedDisk['users']);
		 copy($authorUploadObj -> newFileName, $mediumName);
		 $authorUploadObj -> newFileName = $mediumName;
		 $authorUploadObj -> resizeUploadImage(120, 90, parent::$encryptedDisk['users']);
		 }
		 } else {
		 $this -> errorMessage['fileAuthor'] = $this -> view -> __('Invalid File Size');
		 }
		 } else {
		 $this -> errorMessage['fileAuthor'] = $this -> view -> __('Invalid File Type');
		 }
		 }
		 }
		 $this -> view -> sanitized -> showInList -> value = $this -> view -> sanitized -> published -> value = $this -> view -> sanitized -> approved -> value = $this -> view -> sanitized -> showInObject -> value = 'Yes';

		 $objectId = $result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> titleArticle -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceArticle -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];
		 $this -> photo -> importAction($this -> view -> sanitized, $this -> view -> sanitized -> Id -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];
		 $this -> video -> importAction($this -> view -> sanitized, $this -> view -> sanitized -> Id -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];

		 if (!empty($this -> view -> sanitized -> youTubeVideo -> value)) {
		 $this -> view -> sanitized -> option -> value .= PHP_EOL . 'YouTube=' . $this -> view -> sanitized -> youTubeVideo -> value;
		 }

		 $result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value, $this -> view -> sanitized -> themePublishFrom -> value, $this -> view -> sanitized -> themePublishTo -> value);
		 $result = $this -> articleObj -> insertIntoObject_article(Null, $this -> view -> sanitized -> aliasArticle -> value, $this -> view -> sanitized -> introTextArticle -> value, $this -> view -> sanitized -> fullTextArticle -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceArticle -> value, $this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
		 $this -> view -> sanitized -> Id -> value = $objectArticleId = $result[0];
		 $_options = explode(PHP_EOL, $this -> view -> sanitized -> option -> value);
		 foreach ($_options as $value) {
		 if (FALSE !== strpos($value, 'specialArticle')) {
		 $this -> view -> specialArticle = substr($value, 15);
		 if ($this -> view -> specialArticle == 1) {
		 $updateSpecialArticle = $this -> articleObj -> insertIntoObject_article_special(NULL, $objectId, $objectArticleId);
		 } else {
		 $updateSpecialArticle = $this -> articleObj -> deleteFromObject_article_specialByObject_id($objectArticleId);
		 }
		 }
		 }

		 if (0 === strcmp('Yes', $this -> view -> sanitized -> featured -> value)) {
		 $this -> featureObj -> importAction($this -> view -> sanitized -> Id -> value);
		 }
		 $this -> view -> sanitized -> Id -> value = $objectArticleId;
		 if ($result !== false) {
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and ((1 == $this -> view -> sanitized -> btn_submit -> value) or (0 == strcmp($this -> view -> sanitized -> btn_submit -> value, $this -> view -> __('Object_Save'))))) {
		 header('Location: /admin/handle/pkg/object-article/action/list/s/1');
		 exit();
		 }
		 header('Location: /admin/handle/pkg/object-article/action/edit/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 } else {
		 $this -> errorMessage['general'] = $this -> view -> __('Error on add record');
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

		 $this -> view -> render('object/addArticleObject.phtml');
		 exit();*/
	}

	public function editAction() {

		$form = new Object_Form_Article($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectArticleId = (int)$_POST['mandatory']['id'];
			$articleObjResult = $this -> articleObj -> select() -> where('`id` = ?', $objectArticleId) -> query() -> fetch();
			if ($articleObjResult['order'] != $_POST['optional']['order']) {
				$query = $this -> articleObj -> getAdapter() -> query('UPDATE object_article SET `order`=`order`+1', array());
				$query -> execute();
			}
			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$this -> objectObj -> update($objectData, '`id` = ' . $articleObjResult['object_id']);

			$objecdInfoData = array('object_id' => $articleObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $articleObjResult['object_id']);

			$objectArticleData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'alias' => $_POST['mandatory']['alias'], 'intro_text' => $_POST['mandatory']['intro_text'], 'full_text' => $_POST['mandatory']['full_text'], 'author_id' => $this -> userId, 'object_id' => $articleObjResult['object_id'], 'show_in_object' => $_POST['optional']['show_in_object'], 'order' => $_POST['optional']['order'], 'publish_from' => $_POST['optional']['publish_from'], 'publish_to' => $_POST['optional']['publish_to'], );
			$this -> articleObj -> update($objectArticleData, '`id` = ' . $objectArticleId);

			header('Location: /admin/handle/pkg/object-article/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$articleObjResult = $this -> articleObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $articleObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $articleObjResult['object_id']) -> query() -> fetch();

				if ($articleObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					unset($objResult['id']);
					unset($articleObjResult['published']);
					unset($articleObjResult['approved']);
					unset($articleObjResult['comments']);
					unset($articleObjResult['options']);
					unset($articleObjResult['meta_data']);
					unset($articleObjResult['category_id']);
					unset($articleObjResult['object_source_id']);
					unset($articleObjResult['created_date']);
					unset($objInfoObjResult['id']);

					$publish_from = explode(' ', $articleObjResult['publish_from']);
					$publish_to = explode(' ', $articleObjResult['publish_to']);
					$created_date = explode(' ', $objResult['created_date']);
					$articleObjResult['publish_from'] = $publish_from[0];
					$articleObjResult['publish_to'] = $publish_to[0];
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($articleObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-article/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/updateArticle.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);

		 if (empty($this -> errorMessage)) {
		 if ($this -> view -> sanitized -> order -> value == -1) {
		 $this -> view -> sanitized -> order -> value = $this -> view -> sanitized -> afterId -> value;
		 }
		 if (empty($this -> view -> sanitized -> pageTitle -> value)) {
		 $this -> view -> sanitized -> pageTitle -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> metaTitle -> value)) {
		 $this -> view -> sanitized -> metaTitle -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> metaKey -> value)) {
		 $this -> view -> sanitized -> metaKey -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (empty($this -> view -> sanitized -> metaDesc -> value)) {
		 $this -> view -> sanitized -> metaDesc -> value = $this -> view -> sanitized -> titleArticle -> value;
		 }
		 if (0 == $this -> view -> sanitized -> author_id -> value or empty($this -> view -> sanitized -> author_id -> value)) {
		 $result = $this -> usersObj -> insertIntoUser(Null, $this -> view -> sanitized -> originalAuthor -> value, md5(md5(rand(9, 999999))), $this -> view -> sanitized -> originalAuthor -> value, "", "3");
		 $resultInfo = $this -> usersInfoObj -> insertIntoUser_info(NULL, $result[0], NULL, date('Y-m-d H:i:s'), NULL, NULL, NULL, NULL, NULL, NULL, NULL, "", "Yes", "No", "No", NULL, NULL, NULL, NULL, "", "");
		 //Upload Object
		 $authorUploadObj = new Aula_Model_Upload_Photo('fileAuthor');
		 if ($authorUploadObj -> CheckIfThereIsFile() === TRUE) {
		 if ($authorUploadObj -> validatedMime()) {
		 if ($authorUploadObj -> validatedSize()) {
		 if (is_numeric($result[0])) {
		 $thumbName = parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $result[0]) . '-thumb.jpg';
		 $mediumName = parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $result[0]) . '-medium.jpg';
		 $authorUploadObj -> newFileName = parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $result[0]) . '.jpg';
		 $fileUploaded = $authorUploadObj -> uploadFile($authorUploadObj -> newFileName);
		 copy($authorUploadObj -> newFileName, $thumbName);
		 $authorUploadObj -> newFileName = $thumbName;
		 $authorUploadObj -> resizeUploadImage(55, 40, parent::$encryptedDisk['users']);
		 copy($authorUploadObj -> newFileName, $mediumName);
		 $authorUploadObj -> newFileName = $mediumName;
		 $authorUploadObj -> resizeUploadImage(120, 90, parent::$encryptedDisk['users']);
		 }
		 } else {
		 $this -> errorMessage['fileAuthor'] = $this -> view -> __('Invalid File Size');
		 }
		 } else {
		 $this -> errorMessage['fileAuthor'] = $this -> view -> __('Invalid File Type');
		 }
		 }
		 }
		 $objectArticleId = ( int )$_GET['id'];
		 $result = $this -> articleObj -> getObject_articleDetailsById($objectArticleId);
		 $objectId = $result[0]['object_id'];
		 $objectInfoDetails = $this -> objectInfoObj -> GetAllObject_infoByObject_idOrderById($objectId);
		 $objectInfoId = $objectInfoDetails[0]['id'];

		 $resultObject = $this -> objectObj -> updateObjectById($objectId, $this -> view -> sanitized -> titleArticle -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceArticle -> value, $this -> view -> sanitized -> tag -> value, $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, $this -> view -> sanitized -> category -> value, 1, 'GUID', $this -> view -> sanitized -> originalAuthor -> value, $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);

		 if (!empty($this -> view -> sanitized -> youTubeVideo -> value)) {
		 $this -> view -> sanitized -> option -> value .= PHP_EOL . "YouTube=" . $this -> view -> sanitized -> youTubeVideo -> value;
		 }
		 if (isset($GLOBALS['AULA_BLACKLIST']['fullTextArticle'])) {
		 $this -> view -> sanitized -> fullTextArticle -> value = $GLOBALS['AULA_BLACKLIST']['fullTextArticle'];
		 }

		 $_options = explode(PHP_EOL, $this -> view -> sanitized -> option -> value);
		 foreach ($_options as $value) {
		 if (FALSE !== strpos($value, 'specialArticle')) {
		 $this -> view -> specialArticle = substr($value, 15);
		 if ($this -> view -> specialArticle == 1) {
		 $updateSpecialArticle = $this -> articleObj -> insertIntoObject_article_special(NULL, $objectId, $objectArticleId);
		 } else {
		 $updateSpecialArticle = $this -> articleObj -> deleteFromObject_article_specialByObject_id($objectId);
		 }
		 }
		 }

		 $this -> view -> sanitized -> aliasArticle -> value = $this -> view -> sanitized -> titleArticle -> value;

		 $result = $this -> objectInfoObj -> updateObject_infoCommentsColumnById($objectInfoId, $this -> view -> sanitized -> comment -> value);
		 $result = $this -> objectInfoObj -> updateObject_infoOptionsColumnById($objectInfoId, $this -> view -> sanitized -> option -> value);
		 //$result = $this->objectInfoObj->updateObject_infoById($objectInfoId, $objectId, $this->view->sanitized->comment->value, $this->view->sanitized->option->value, $this->view->sanitized->layout->value, $this->view->sanitized->template->value, $this->view->sanitized->skin->value, $this->view->sanitized->themePublishFrom->value, $this->view->sanitized->themePublishTo->value);
		 $result = $this -> articleObj -> updateObject_articleById($objectArticleId, $this -> view -> sanitized -> aliasArticle -> value, $this -> view -> sanitized -> introTextArticle -> value, $this -> view -> sanitized -> fullTextArticle -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, $this -> view -> sanitized -> sourceArticle -> value, $objectId, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);
		 $this -> photo -> importAction($this -> view -> sanitized, $objectId);
		 $this -> view -> sanitized -> Id -> value = $objectId;
		 $this -> video -> importAction($this -> view -> sanitized, $this -> view -> sanitized -> Id -> value);
		 $this -> view -> sanitized -> Id -> value = $objectArticleId;
		 if ($this -> view -> sanitized -> updateDate -> value == 'Yes') {
		 $this -> objectObj -> updateObjectDate_addedColumnById($objectId);
		 $this -> objectInfoObj -> updateObject_infoDate_addedColumnById($objectInfoId);
		 $this -> articleObj -> updateObject_articleDate_addedColumnById($objectArticleId);
		 }

		 if ($result !== false) {
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
		 header('Location: /admin/handle/pkg/object-article/action/list/s/1');
		 exit();
		 } else {
		 if (isset($_GET['s']) and $_GET['s'] == -1) {
		 header('Location: /admin/handle/pkg/object-article/action/edit/s/-1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 }
		 header('Location: /admin/handle/pkg/object-article/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 }
		 } else {
		 $this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
		 }
		 }
		 } elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
		 $result = $this -> articleObj -> getObject_articleDetailsById(( int )$_GET['id']);

		 $result = $result[0];
		 $objectID = $result['object_id'];

		 $resultObject = $this -> objectObj -> getObjectDetailsById($objectID);
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

		 $result['publish_from'] = substr($result['publish_from'], 0, 10);
		 $result['publish_to'] = substr($result['publish_to'], 0, 10);
		 $result['created_date'] = substr($result['created_date'], 0, 10);
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

		 //Fill in writers list drop down menu
		 $selectedItem = '';
		 $this -> authorsList = '';
		 $this -> view -> authorsList = '';
		 $this -> view -> authorPhoto = '';

		 if (!empty($this -> authorsListResult)) {
		 foreach ($this->authorsListResult as $key => $value) {
		 if ($value['fullname'] == $resultObject['original_author']) {
		 $selectedItem = 'selected="selected"';
		 $this -> view -> authorPhoto = '<img title="" alt="" src="' . parent::$encryptedUrl['users'] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '-thumb.jpg' . '" />';
		 }
		 $this -> authorsList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['fullname'] . '</option>';
		 $selectedItem = '';
		 }
		 $this -> view -> authorsList = $this -> authorsList;
		 }
		 $featureList = $this -> featureObj -> getAllAction();

		 $this -> fields = array('redirectURI' => array('uri', 0, ''), 'youTubeVideo' => array('codeConvention', 0, $_youTubeVideo), 'featured' => array('text', 0, array_key_exists($result['id'], $featureList) ? "Yes" : "No"), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'fileAuthor' => array('fileUploaded', 0, (!empty($_FILES['fileAuthor']['name']) ? $_FILES['fileAuthor']['name'] : '')), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'status' => array('text', 0), 'articleId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author_id' => array('numericUnsigned', 0, $resultObject['author_id']), 'author' => array('numericUnsigned', 0, $resultObject['author_id']), 'titleArticle' => array('text', 1, $resultObject['title']), 'aliasArticle' => array('text', 0, $result['alias']), 'introTextArticle' => array('text', 0, $result['intro_text']), 'fullTextArticle' => array('text', 1, $result['full_text']), 'sourceArticle' => array('numeric', 1, $result['source_id']), 'category' => array('numericUnsigned', 1, $result['category_id']), 'tag' => array('text', 0, $resultObject['tags']), 'showInObject' => array('text', 0, $result['show_in_object']), 'originalAuthor' => array('text', 0, $resultObject['original_author']), 'createdDate' => array('shortDateTime', 0, $result['created_date']), 'themePublishFrom' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_from']), 'themePublishTo' => array('shortDateTime', 0, $resultObjectInfo['theme_publish_to']), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'parent' => array('numericUnsigned', 0, $resultObject['parent_id']), 'objectType' => array('numericUnsigned', 0, $resultObject['type_id']), 'showInList' => array('text', 0, 'Yes'/*$resultObject['show_in_list']
		 ), 'published' => array('text', 0, 'Yes'
		 ), 'approved' => array('text', 0, 'Yes'
		 ), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'pageTitle' => array('text', 0, $resultObject['page_title']), 'metaTitle' => array('text', 0, $resultObject['meta_title']), 'metaKey' => array('text', 0, $resultObject['meta_key']), 'metaDesc' => array('text', 0, $resultObject['meta_desc']), 'metaData' => array('text', 0, $resultObject['meta_data']), 'layout' => array('numericUnsigned', 0, $resultObjectInfo['layout_id']), 'template' => array('numericUnsigned', 0, $resultObjectInfo['template_id']), 'skin' => array('numericUnsigned', 0, $resultObjectInfo['skin_id']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

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
		 $this -> view -> render('object/addArticleObject.phtml');
		 exit();*/
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articleDelete = $this -> articleObj -> delete($where);
			}
			if (!empty($articleDelete)) {
				header('Location: /admin/handle/pkg/object-article/action/list/success/delete');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$data = array('show_in_object' => $this -> view -> sanitized -> status -> value);
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articleShowInMenu = $this -> articleObj -> update($data, $where);
			}
			if (!empty($articleShowInMenu)) {
				$this -> generateCacheAction();
				header('Location: /admin/handle/pkg/object-article/action/list/success/showInObject');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articlePublish = $this -> articleObj -> update($data, $where);
			}
			if (!empty($articlePublish)) {
				$this -> generateCacheAction();
				header('Location: /admin/handle/pkg/object-article/action/list/success/publish');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> articleId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->articleId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> articleObj -> getAdapter() -> quoteInto('id = ?', $id);
				$articleAprrove = $this -> articleObj -> update($data, $where);
			}
			if (!empty($articleAprrove)) {
				$this -> generateCacheAction();
				header('Location: /admin/handle/pkg/object-article/action/list/success/approve');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-article/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-article/action/';
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

		$isCategorySelected = false;
		if (isset($_GET['category']) and is_numeric($_GET['category'])) {
			$isCategorySelected = true;
			$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'oa.date_added', $this -> start, $this -> limit, 'DESC');
		}

		//sorting
		$this -> view -> sort -> alias -> cssClass = 'sort-title';
		$this -> view -> sort -> showInObject -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';

		if ($isCategorySelected) {
			$this -> view -> sort -> category -> href = 'javascript:viod(0);';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc/category/' . ( int )$_GET['category'];
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc/category/' . ( int )$_GET['category'];
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc/category/' . ( int )$_GET['category'];
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc/category/' . ( int )$_GET['category'];
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc/category/' . ( int )$_GET['category'];

		} else {
			$this -> view -> sort -> category -> cssClass = 'sort-title';
			$this -> view -> sort -> category -> href = $this -> view -> sanitized -> actionURI -> value . 'list/category/asc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		}

		if (isset($_GET['keyword'])) {
			$articleListResult = $this -> articleObj -> GetCleanObjectAndInfoAndArticleByKeywordOrderByColumnWithLimit($_GET['keyword'], $this -> start, $this -> limit);
		} else if (isset($_GET['alias']) && $_GET['alias'] == 'asc') {
			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/desc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByAliasWithLimit('ASC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> alias -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'alias', $this -> start, $this -> limit, 'ASC');

			}
		} elseif (isset($_GET['alias']) && $_GET['alias'] == 'desc') {

			$this -> view -> sort -> alias -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> alias -> href = $this -> view -> sanitized -> actionURI -> value . 'list/alias/asc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByAliasWithLimit('DESC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> alias -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'alias', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'asc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/desc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByShow_in_objectWithLimit('ASC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> showInObject -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'show_in_object', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['showInObject']) && $_GET['showInObject'] == 'desc') {
			$this -> view -> sort -> showInObject -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInObject -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInObject/asc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByShow_in_objectWithLimit('DESC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> showInObject -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'show_in_object', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> published -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'published', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> published -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'published', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> approved -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'approved', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> approved -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'approved', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> dateAdded -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'date_added', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
			if ($isCategorySelected) {
				$this -> view -> sort -> dateAdded -> href .= '/category/' . ( int )$_GET['category'];
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'date_added', $this -> start, $this -> limit, 'DESC');
			}
		} else {
			$articleListResult = $this -> articleObj -> getAllObject_articleOrderByIdWithLimit($this -> start, $this -> limit);
			if ($isCategorySelected) {
				$articleListResult = $this -> articleObj -> GetAllObject_articleByCategory_idOrderByColumnWithLimit(( int )$_GET['category'], 'date_added', $this -> start, $this -> limit, 'DESC');
			} else {
				$articleListResult = $this -> articleObj -> getAllObject_articleWoSomeCategoriesOrderByColumnWithLimit('25, 26', 'date_added', $this -> start, $this -> limit);
			}
		}

		$this -> pagingObj -> _init($this -> articleObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		$categoryListResult = $this -> categoryListResult;
		//$objectListResult = $this->objectObj->getAllObjectOrderById ();

		//listing
		//$countOfObjectListResult = count ( $objectListResult );
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		$objectList = '';
		if (!empty($articleListResult) and false != $articleListResult) {
			foreach ($articleListResult as $key => $value) {
				for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
					if ($categoryListResult[$i]['id'] == $value['category_id']) {
						$category = $categoryListResult[$i]['label'];
						break;
					}
				}
				//for($i = 0; $i < $countOfObjectListResult; $i ++) {
				//if ($objectListResult [$i] ['id'] == $value ['object_id']) {
				//$objectTitle = $objectListResult [$i] ['title'];
				//break;
				//}
				//}
				$objectList .= '<tr>';
				$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="articleId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> cleanHtml($category) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> cleanHtml($value['alias']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['show_in_object']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$objectList .= '<td class="jstalgntop last">
																<a href="/admin/handle/pkg/object-article/action/edit/id/' . $value['id'] . '" class="modify fl" title="Edit" target="_blank"></a>
																<a href="/admin/handle/pkg/feature/action/add/id/' . $value['id'] . '" class="feature fl" title="Add to Feature"></a>
																<!-- <a href="javascript:void(0);" class="preview fl" title="Preview"></a> -->
																</td>';
				$objectList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listArticleObject.phtml');
		exit();
	}

}
