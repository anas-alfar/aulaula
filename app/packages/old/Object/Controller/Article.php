<?php

class Object_Controller_Article extends Aula_Controller_Action {

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

		//object-photo controller and Object
		$this -> photo = new Object_Controller_Photo($this -> fc);

		//objects
		$this -> articleObj = new Object_Model_Article();
		$this -> commentObj = new Object_Model_Comment();
		$this -> videoObj = new Object_Model_Video();
		$this -> photoObj = new Object_Model_Photo();

		//category objects
		$this -> categoryObj = new Category_Model_Default();

		//user object
		$this -> usersObj = new User_Model_Default();

		$this -> authorsListResult = $this -> usersObj -> GetAllUserByUser_level_idOrderById(3);

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'youTubeVideo' => array('text', 0), 'fileVideo' => array('fileUploaded', 0, (!empty($_FILES['fileVideo']['name']) ? $_FILES['fileVideo']['name'] : '')), 'fileAuthor' => array('fileUploaded', 0, (!empty($_FILES['fileAuthor']['name']) ? $_FILES['fileAuthor']['name'] : '')), 'aliasVideo' => array('text', 0), 'aliasPhoto' => array('text', 0), 'introTextPhoto' => array('text', 0), 'takenDatePhoto' => array('shortDateTime', 0), 'takenLocationPhoto' => array('text', 0), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'status' => array('text', 0, 'Yes'), 'articleId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'author_id' => array('numericUnsigned', 0), 'titleArticle' => array('text', 1), 'aliasArticle' => array('text', 0), 'introTextArticle' => array('', 0), 'fullTextArticle' => array('', 1), 'sourceArticle' => array('numeric', 1), 'category' => array('numericUnsigned', 1), 'tag' => array('text', 0), 'showInObject' => array('text', 0, $this -> articleObj -> showInObject), 'originalAuthor' => array('text', 0, -1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'themePublishFrom' => array('shortDateTime', 0), 'themePublishTo' => array('shortDateTime', 0), 'publishFrom' => array('shortDateTime', 0), 'publishTo' => array('shortDateTime', 0), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> articleObj -> objectType), 'showInList' => array('text', 0, $this -> objectObj -> showInList), 'published' => array('text', 0, $this -> articleObj -> published), 'approved' => array('text', 0, $this -> articleObj -> approved), 'featured' => array('text', 0, 'No'), 'comment' => array('', 0, $this -> articleObj -> comments), 'option' => array('', 0, $this -> articleObj -> options), 'pageTitle' => array('text', 0), 'metaTitle' => array('text', 0), 'metaKey' => array('text', 0), 'metaDesc' => array('text', 0), 'metaData' => array('text', 0), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'order' => array('numericUnsigned', 0, $this -> articleObj -> order), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		/*if (isset ($_GET['id']) and is_numeric($_GET['id'])) {
		 $result = $this->articleObj->getObject_articleDetailsById(( int ) $_GET['id']);
		 $result = $result[0];
		 if (empty ($this->view->sanitized['sourceArticle']['value'])) {
		 $this->view->sanitized['sourceArticle']['value'] = $sourceId = $result['source_id'];
		 }
		 if (empty ($this->view->sanitized['category']['value'])) {
		 $this->view->sanitized['category']['value'] = $result['category_id'];
		 }
		 }*/
		$this -> view -> sanitized['sourceArticle']['value'] = 1;
		$this -> view -> sanitized['category']['value'] = 0;

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

		$this -> view -> lastArticleList = $this -> lastArticleList = $this -> articleObj -> GetLatestCleanObjectAndInfoAndArticleWoPhotoOrderByColumnWithLimit(0, 8);
		$countLastArticleList = count($this -> view -> lastArticleList);
		for ($k = 0; $k < $countLastArticleList; $k++) {
			//$objectDetails = $this->objectObj->getObjectDetailsById($this->view->lastArticleList[$k]['object_id']);
			//$this->view->lastArticleList[$k]['title'] = $objectDetails[0]['title'];
			$this -> view -> lastArticleList[$k]['title'] = $this -> view -> lastArticleList[$k]['alias'];
		}
		$this -> view -> newsEntertainmentList = $this -> newsEntertainmentList = $this -> articleObj -> GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit(NEWS_ENTERTAINMENT, 0, 4);
		foreach ($this->view->newsEntertainmentList as $k => $news) {
			$this -> view -> newsEntertainmentList[$k]['imageUrl'] = parent::$encryptedUrl['photo']['thumb-large'][substr($news['photo_date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $news['photo_id']) . '.jpg';
			$this -> view -> newsEntertainmentList[$k]['intro_text'] = $this -> view -> subString($this -> view -> newsEntertainmentList[$k]['intro_text'], $this -> view -> start, $this -> view -> length) . '.....';
		}

		$this -> view -> newsSportsList = $this -> newsSportsList = $this -> articleObj -> GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit(NEWS_SPORTS, 0, 4);

		foreach ($this->view->newsSportsList as $k => $news) {
			$this -> view -> newsSportsList[$k]['imageUrl'] = parent::$encryptedUrl['photo']['thumb-large'][substr($news['photo_date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $news['photo_id']) . '.jpg';
			$this -> view -> newsSportsList[$k]['intro_text'] = $this -> view -> subString($this -> view -> newsSportsList[$k]['intro_text'], $this -> view -> start, $this -> view -> length) . '.....';
		}

		$this -> view -> newsWorldMiscList = $this -> newsWorldMiscList = $this -> articleObj -> GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit(NEWS_WORLD_MISC, 0, 10);
		foreach ($this->view->newsWorldMiscList as $k => $news) {
			$this -> view -> newsWorldMiscList[$k]['imageUrl'] = parent::$encryptedUrl['photo']['thumb-large'][substr($news['photo_date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $news['photo_id']) . '.jpg';
			$this -> view -> newsWorldMiscList[$k]['intro_text'] = $this -> view -> subString($this -> view -> newsWorldMiscList[$k]['intro_text'], $this -> view -> start, $this -> view -> length) . '.....';
		}
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> pagingObj -> totalRecordsPerPage = $this -> limit = 20;
		$this -> buildPaging();
		$renderFile = 'object/article/list.phtml';

		if (isset($_GET['category']) and !empty($_GET['category'])) {
			$categoryResult = $this -> categoryObj -> getCategoryDetailsById(( int )$_GET['category']);
			if ($categoryResult != FALSE) {
				$articleList = $this -> articleObj -> GetListingCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit(( int )$_GET['category'], $this -> start, $this -> limit);
				$objectIds = '';
				foreach ($articleList as $k => $article) {
					$objectIds .= $articleList[$k]['object_id'] . ',';
				}
				$objectIds = substr($objectIds, 0, strlen($objectIds) - 1);
				$photoList = $this -> photoObj -> GetAllCleanPhotoByObjectIdsOrderByColWithLimit($objectIds, 'op.id', 'ASC');
				foreach ($photoList as $key => $value) {
					$arrr[$value['object_id']] = $value;
				}
				foreach ($articleList as $k => $article) {
					if (isset($arrr[$article['object_id']])) {
						$articleList[$k]['imageUrl'] = parent::$encryptedUrl['photo']['medium'][substr($arrr[$article['object_id']]['date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $arrr[$article['object_id']]['id']) . '.jpg';
					}

				}
				$this -> view -> articleList = $articleList;
				$this -> view -> categoryDetails = $categoryResult[0];
			} else {
				header('Location: /');
				exit();
			}
		} elseif (isset($_GET['keyword']) and !empty($_GET['keyword'])) {
			$articleList = $this -> articleObj -> GetCleanObjectAndInfoAndArticleByKeywordOrderByColumnWithLimit($_GET['keyword'], $this -> start, $this -> limit);
			foreach ($articleList as $k => $article) {
				$articleList[$k]['imageUrl'] = parent::$encryptedUrl['photo']['medium'][substr($article['photo_date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $article['photo_id']) . '.jpg';

				//$articleList [$k] ['intro_text'] = $this->view->subString ( $articleList [$k] ['intro_text'], $this->view->start, $this->view->length ) . '.....';
			}
			$this -> view -> articleList = $articleList;
			$this -> view -> categoryDetails = array('title' => $_GET['keyword']);
		} elseif (isset($_GET['writer']) and !empty($_GET['writer'])) {
			$userResult = $this -> usersObj -> getUserDetailsById(( int )$_GET['writer']);
			if ($userResult != FALSE) {
				$articleList = $this -> articleObj -> GetListingCleanObjectAndInfoAndArticleByUserIdsOrderByColumnWithLimit($userResult[0]['fullname'], $this -> start, $this -> limit);
				$this -> view -> articleList = $articleList;
				$this -> view -> userDetails = $userResult[0];
				$renderFile = 'object/article/writer_articles.phtml';
			} else {
				header('Location: /');
				exit();
			}
		} elseif (isset($_GET['writers']) and !empty($_GET['writers'])) {
			if ($this -> authorsListResult != FALSE) {
				foreach ($this->authorsListResult as $k => $news) {
					if (file_exists(parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $authorsList[$news['original_author']]) . '-thumb.jpg')) {
						$this -> authorsListResult[$k]['image_url'] = parent::$encryptedUrl['users'] . md5($this -> fc -> settings -> encryption -> hash . $authorsList[$news['original_author']]) . '-thumb.jpg';
					} else {
						$this -> authorsListResult[$k]['image_url'] = $this -> view -> defaultSkinImagesUrl . 'writer_default.gif';
					}
				}
				$this -> view -> userList = $this -> authorsListResult;
				$renderFile = 'object/article/writers.phtml';
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
		$this -> icon = array(':sigh:' => '<a class="sigh"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":roll:" width="18" height="18" /></a>', ':roll:' => '<a class="sigh1"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":roll:" width="18" height="18" /></a>', ':P' => '<a class="sigh2"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":P" width="18" height="18" /></a>', ':zzz' => '<a class="sigh3"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":zzz" width="18" height="25" /></a>', ':eek:' => '<a class="sigh4"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":eek:" width="18" height="18" /></a>', ':-x' => '<a class="sigh5"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":-x" width="18" height="18" /></a>', ':-?' => '<a class="sigh6"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":-?" width="18" height="18" /></a>', ':o' => '<a class="sigh7"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":o" width="18" height="18" /></a>', ':cry:' => '<a class="sigh8"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":cry:" width="18" height="18" /></a>', ':sad:' => '<a class="sigh9"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"   alt=":sad:" width="18" height="18" /></a>', ':oops:' => '<a class="sigh10"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":oops:" width="18" height="18" /></a>', ':-*' => '<a class="sigh11"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":-*" width="18" height="19" /></a>', ':-|' => '<a class="sigh12"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":-|" width="18" height="18" /></a>', '8)' => '<a class="sigh13"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt="8)" width="18" height="18" /></a>', ';-)' => '<a class="sigh14"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=";-)" width="18" height="18" /></a>', ':-)' => '<a class="sigh15"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":-)" width="18" height="18" /></a>', ':lol:' => '<a class="sigh16"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif"  alt=":lol:" width="18" height="18" /></a>', ':D' => '<a class="sigh17"><img src="' . $this -> view -> defaultSkinImagesUrl . 'spacer.gif" alt=":D" width="18" height="18" /></a>');

		if (isset($_GET['id']) and !empty($_GET['id'])) {
			$noPhoto = false;

			$articleDetails = $this -> articleObj -> GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit(( int )$_GET['id'], 0, 1);

			if ($articleDetails === FALSE) {
				$noPhoto = true;
				$articleDetails = $this -> articleObj -> GetCleanObjectAndInfoAndArticleByIdsListWoPhotoOrderByColumnWithLimit(( int )$_GET['id'], 0, 1);
			}

			if ($articleDetails !== FALSE) {
				//$categoryDetails = $this->categoryObj->getCategoryDetailsById($articleDetails[0]['category_id']);
				if (false === $noPhoto) {
					foreach ($articleDetails as $k => $article) {
						$articleDetails[$k]['imageUrl'] = parent::$encryptedUrl['photo']['large-mini'][substr($article['photo_date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $article['photo_id']) . '.jpg';
					}
				}

				//check if there is video embded or not
				$videoResult = $this -> videoObj -> GetAllObject_videoByObject_idOrderById($articleDetails[0]['object_id']);
				if ($videoResult !== FALSE) {
					$videoResult = $videoResult[0];
					$articleDetails[0]['videoUrl'] = parent::$encryptedUrl['file'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $videoResult['id']) . '.flv';
				}

				$this -> view -> youtube = '';
				$this -> view -> allowComments = 0;
				$this -> view -> specialArticle = 0;
				$_options = explode(PHP_EOL, $articleDetails[0]['options']);
				foreach ($_options as $value) {
					if (false !== strpos($value, 'YouTube')) {
						$this -> view -> youtube = substr($value, 8);
					} else if (false !== strpos($value, 'allowComments')) {
						$this -> view -> allowComments = substr($value, 14);
					} else if (false !== strpos($value, 'specialArticle')) {
						$this -> view -> specialArticle = substr($value, 15);
					}
				}

				switch ($articleDetails [0] ['category_id']) {
					case 7 :
					case 28 :
						$this -> pagingObj -> totalRecordsPerPage = $this -> limit = 100;
						$this -> view -> commentList = $this -> commentObj -> GetCleanObject_commentByObject_idOrderByIdWithLimit($articleDetails[0]['object_id'], $this -> start, $this -> limit, 'DESC');
						$this -> buildPaging();
						$this -> pagingObj -> _init($this -> commentObj -> _totalRecordsFound);
						$this -> view -> paging = $this -> pagingObj -> paging;
						$this -> view -> arrayToObject($this -> view -> paging);

						break;
					default :
					//chechk if allowed comments to sorted in the view page or not
						if ($this -> view -> allowComments == 1) {
							$this -> view -> commentList = $this -> commentObj -> GetCleanObject_commentByObject_idOrderByIdWithoutLimit($articleDetails[0]['object_id'], 'ASC');
							if ($this -> view -> commentList !== FALSE) {
								$countCommentObj = count($this -> view -> commentList);
								for ($j = 0; $j < $countCommentObj; $j++) {
									foreach ($this->icon as $symbol => $icon) {
										$this -> view -> commentList[$j]['content'] = str_replace($symbol, $icon, $this -> view -> commentList[$j]['content']);

									}
								}
							}
						}
						break;
				}

				//increase  numbers of viewers
				/*if (isset ( $_COOKIE ['articleList'] )) {
				 $objectInfoResult = $this->objectInfoObj->GetAllObject_infoByObject_idOrderById ( $articleDetails [0] ['object_id'] );
				 $articleInList = false;
				 $articleList = explode ( ',', $_COOKIE ['articleList'] );
				 $newArticleList = '';
				 foreach ( $articleList as $__key => $__article ) {
				 if ($__article == $articleDetails [0] ['id']) {
				 $articleInList = true;
				 break;
				 }
				 }
				 if (! $articleInList) {
				 $articleList [] = $articleDetails [0] ['id'];
				 if (count ( $articleList ) > 10) {
				 array_shift ( $articleList );
				 }
				 $articleList = implode ( ',', $articleList );
				 setcookie ( 'articleList', $articleList );
				 $total_v = $objectInfoResult [0] ['total_views'];
				 $articleDetails [0] ['total_views'] = $total_v = $total_v + 1;
				 $objectTotalViews = $this->objectInfoObj->updateObject_infoTotal_viewsColumnById ( $objectInfoResult [0] ['id'], $total_v );
				 }
				 } else {
				 setcookie ( 'articleList', $articleDetails [0] ['id'] );
				 $objectInfoResult = $this->objectInfoObj->GetAllObject_infoByObject_idOrderById ( $articleDetails [0] ['object_id'] );
				 $total_v = $objectInfoResult [0] ['total_views'];
				 $articleDetails [0] ['total_views'] = $total_v = $total_v + 1;
				 $objectTotalViews = $this->objectInfoObj->updateObject_infoTotal_viewsColumnById ( $objectInfoResult [0] ['id'], $total_v );
				 }*/

				//Set total views count
				$articleDetails[0]['total_views']++;
				//$objectInfoResult = $this->objectInfoObj->GetAllObject_infoByObject_idOrderById($articleDetails[0]['object_id']);
				$objectTotalViews = $this -> objectInfoObj -> updateObject_infoTotal_viewsColumnById($articleDetails[0]['object_info_id'], $articleDetails[0]['total_views']);

				$this -> view -> metaData = $articleDetails[0]['meta_data'];
				$this -> view -> pageTitle = $articleDetails[0]['page_title'];
				$this -> view -> metaTitle = $articleDetails[0]['meta_title'];
				$this -> view -> metaKeywords = $articleDetails[0]['meta_key'];
				$this -> view -> metaDescription = $articleDetails[0]['meta_desc'];

				foreach ($this->categoryListResult as $cat) {
					if ($cat['id'] == $articleDetails[0]['category_id']) {
						$this -> view -> categoryDetails = $cat;
						break;
					}
				}

				/*
				 //view the last five article by the same author of the current article
				 $authorLastArticleResult = $this->articleObj->GetLatestObjectAndrticleAndInfoByAuthor_idOrderByColumnWithLimit($articleDetails[0]['author_id'], 0, 5);
				 $countAuthorLastArticleResult = count($authorLastArticleResult);
				 $authorLastArticleIds = '';
				 for ($k = 0; $k < $countAuthorLastArticleResult; $k++) {
				 if ($authorLastArticleResult[$k]['author_id'] == $articleDetails[0]['author_id']) {
				 continue;
				 }
				 $authorLastArticleIds .= $authorLastArticleResult[$k]['author_id'] . ',';
				 }

				 $authorLastArticleIds = substr($authorLastArticleIds, 0, -1);
				 $authorLastArticle = $this->articleObj->GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit($authorLastArticleIds, 0, 1);

				 if ($authorLastArticle !== FALSE) {
				 $this->view->authorLastArticle = $authorLastArticle;
				 } else {
				 $this->view->authorLastArticle = array ();
				 }
				 */

				$this -> view -> authorLastArticle = array();

				if (isset($_GET['comment']) && $_GET['comment'] == 'error') {
					$this -> view -> commentErrorMessage = $this -> view -> __('please check that your are entered correct data');
					$this -> view -> commentErrorMessageStyle = 'display:block';
				} else {
					$this -> view -> commentErrorMessage = '';
					$this -> view -> commentErrorMessageStyle = 'display:none';
				}

				if (!empty($this -> authorsListResult)) {
					foreach ($this->authorsListResult as $key => $value) {
						$authorsList[$value['fullname']] = $value['id'];
					}
					if (!is_numeric($articleDetails[0]['original_author']) and array_key_exists($articleDetails[0]['original_author'], $authorsList)) {
						if (file_exists(parent::$encryptedDisk['users'] . md5($this -> fc -> settings -> encryption -> hash . $authorsList[$articleDetails[0]['original_author']]) . '-thumb.jpg')) {
							$articleDetails[0]['authorPhoto'] = parent::$encryptedUrl['users'] . md5($this -> fc -> settings -> encryption -> hash . $authorsList[$articleDetails[0]['original_author']]) . '-thumb.jpg';
						}
					}
				}
			} else {
				header('Location: /');
				exit();
			}
		}

		$this -> view -> articleDetails = $articleDetails[0];
		$this -> view -> render('object/article/view.phtml');
		exit();
	}

	public function addArticleAction() {
		$this -> view -> addArticleTitle = 'أرسل مقالاً';
		$this -> view -> addArticleTitleLabel = 'عنوان المقال';
		$this -> view -> addArticleTitleBody = 'نص المقال';
		$this -> view -> addArticleClass = 'addartcltitle';

		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'token' => array('text', 1, 'rcvagjknml43567890uoklmfg'), 'userId' => array('text', 1), 'title' => array('text', 1), 'contentComment' => array('', 1), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> articleObj -> objectType), 'featured' => array('text', 0, 'No'), 'comment' => array('', 0, $this -> articleObj -> comments), 'option' => array('', 0, $this -> articleObj -> options), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'order' => array('numericUnsigned', 0, $this -> articleObj -> order));

		$this -> view -> sanitized = array();
		$this -> view -> sanitized = $_POST;
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> filterObj -> trimData($this -> view -> sanitized);
		$this -> filterObj -> sanitizeData($this -> view -> sanitized);

		if ($this -> isPagePostBack) {
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$this -> view -> sanitized -> order -> value = 1;
				$this -> view -> sanitized -> aliasVideo -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> aliasPhoto -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> pageTitle -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaTitle -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaKey -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaDesc -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaData -> value = '';
				$this -> view -> sanitized -> introTextArticle -> value = $this -> view -> subString($this -> view -> sanitized -> contentComment -> value, 0, 200) . '...';
				$this -> view -> sanitized -> contentComment -> value = $this -> view -> sanitized -> userId -> value . PHP_EOL . PHP_EOL . $this -> view -> sanitized -> contentComment -> value;

				$this -> view -> sanitized -> showInList -> value = $this -> view -> sanitized -> published -> value = $this -> view -> sanitized -> approved -> value = $this -> view -> sanitized -> showInObject -> value = 'No';

				$object_result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, 3, '', $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, SEND_ARTICLE, 1, 'GUID', '', $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> photo -> importAction($this -> view -> sanitized, $object_result[0]);
				$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $object_result[0], $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value);
				$result = $this -> articleObj -> insertIntoObject_article(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> introTextArticle -> value, $this -> view -> sanitized -> contentComment -> value, $this -> view -> sanitized -> createdDate -> value, '1', 3, $object_result[0], SEND_ARTICLE, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, '', '', $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);

				if ($result !== false) {
					header('Location: /object-article/thanks');
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

		$this -> view -> render('object/article/add.phtml');
		exit();
	}

	public function addNewsAction() {

		$this -> view -> addArticleTitle = 'أرسل خبراً';
		$this -> view -> addArticleTitleLabel = 'عنوان الخبر';
		$this -> view -> addArticleTitleBody = 'نص الخبر';
		$this -> view -> addArticleClass = 'addposttitle';

		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'filePhoto' => array('fileUploaded', 0, (!empty($_FILES['filePhoto']['name']) ? $_FILES['filePhoto']['name'] : '')), 'token' => array('text', 1, 'rcvagjknml43567890uoklmfg'), 'userId' => array('text', 1), 'title' => array('text', 1), 'contentComment' => array('', 1), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 1), 'createdDate' => array('shortDateTime', 0, $this -> objectObj -> createdDate), 'parent' => array('numericUnsigned', 0, $this -> objectObj -> parentId), 'objectType' => array('numericUnsigned', 0, $this -> articleObj -> objectType), 'featured' => array('text', 0, 'No'), 'comment' => array('', 0, $this -> articleObj -> comments), 'option' => array('', 0, $this -> articleObj -> options), 'layout' => array('numericUnsigned', 0, $this -> objectInfoObj -> layoutId), 'template' => array('numericUnsigned', 0, $this -> objectInfoObj -> templateId), 'skin' => array('numericUnsigned', 0, $this -> objectInfoObj -> skinId), 'order' => array('numericUnsigned', 0, $this -> articleObj -> order));

		$this -> view -> sanitized = array();
		$this -> view -> sanitized = $_POST;
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> filterObj -> trimData($this -> view -> sanitized);
		$this -> filterObj -> sanitizeData($this -> view -> sanitized);

		if ($this -> isPagePostBack) {
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$this -> view -> sanitized -> order -> value = 1;
				$this -> view -> sanitized -> aliasVideo -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> aliasPhoto -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> pageTitle -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaTitle -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaKey -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaDesc -> value = $this -> view -> sanitized -> title -> value;
				$this -> view -> sanitized -> metaData -> value = '';
				$this -> view -> sanitized -> introTextArticle -> value = $this -> view -> subString($this -> view -> sanitized -> contentComment -> value, 0, 200) . '...';
				$this -> view -> sanitized -> contentComment -> value = $this -> view -> sanitized -> userId -> value . PHP_EOL . PHP_EOL . $this -> view -> sanitized -> contentComment -> value;

				$this -> view -> sanitized -> showInList -> value = $this -> view -> sanitized -> published -> value = $this -> view -> sanitized -> approved -> value = $this -> view -> sanitized -> showInObject -> value = 'No';

				$object_result = $this -> objectObj -> insertIntoObject(NULL, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> createdDate -> value, $this -> userId, 3, '', $this -> view -> sanitized -> pageTitle -> value, $this -> view -> sanitized -> metaTitle -> value, $this -> view -> sanitized -> metaKey -> value, $this -> view -> sanitized -> metaDesc -> value, $this -> view -> sanitized -> metaData -> value, $this -> view -> sanitized -> objectType -> value, SEND_NEWS, 1, 'GUID', '', $this -> view -> sanitized -> parent -> value, $this -> view -> sanitized -> showInList -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> photo -> importAction($this -> view -> sanitized, $object_result[0]);
				$result = $this -> objectInfoObj -> insertIntoObject_info(NULL, $object_result[0], $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> layout -> value, $this -> view -> sanitized -> template -> value, $this -> view -> sanitized -> skin -> value);
				$result = $this -> articleObj -> insertIntoObject_article(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> introTextArticle -> value, $this -> view -> sanitized -> contentComment -> value, $this -> view -> sanitized -> createdDate -> value, '1', 3, $object_result[0], SEND_NEWS, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, '', '', $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value);

				if ($result !== false) {
					header('Location: /object-article/thanks');
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

		$this -> view -> render('object/article/add.phtml');
		exit();
	}

	public function commentsThanksAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$this -> view -> articleUrl = '/object-article/view/id/' . ( int )$_GET['id'];
			$this -> view -> render('object/comment/thanks.phtml');
			exit();
		}
		header('Location: /');
		exit();
	}

	public function thanksAction() {
		$this -> view -> render('object/article/thanks.phtml');
		exit();
	}

	public function printAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (isset($_GET['id']) and !empty($_GET['id'])) {
			$articleDetails = $this -> articleObj -> GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit(( int )$_GET['id'], 0, 1);
			if ($articleDetails !== FALSE) {
				foreach ($articleDetails as $k => $article) {
					$articleDetails[$k]['imageUrl'] = parent::$encryptedUrl['photo']['large-mini'][substr($article['photo_date_added'], 0, 7)] . md5($this -> fc -> settings -> encryption -> hash . $article['photo_id']) . '.jpg';
				}
				$this -> view -> articleDetails = $articleDetails[0];
			} else {
				header('Location: /');
			}
		}
		$this -> view -> render('object/article/print.phtml');
		exit();
	}

	public function shareAction() {
	}

	public function saveAction() {
	}

	public function sendToFriendAction() {
	}

	private function featuresBox() {
		$featureArticles = '';
		if (file_exists($this -> fc -> settings -> directories -> cache . 'Feature.xml')) {
			$featureListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'Feature.xml', NULL);
			if (!empty($featureListResult)) {
				foreach ($featureListResult as $key => $value) {
					$value = explode('||', $value);
					$featureArticles .= $value[0] . ',';
				}

				$featureArticles = $this -> view -> subString($featureArticles, 0, -1);
				$featureListResult = $this -> articleObj -> GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit($featureArticles);

				return $featureArticles;
			}
		}
	}

}
