<?php

class Object_Controller_Photo extends Aula_Controller_Action {
	
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
		$this->objectObj = new Object_Model_Default ();
		$this->objectInfoObj = new Object_Model_Info ();
		
		//objects
		$this->photoObj = new Object_Model_Photo ();
		$this->sourceObj = new Object_Model_Source ();
		
		//theme objects
		$this->templateObj = new Theme_Model_Template ();
		$this->layoutObj = new Theme_Model_Layout ();
		$this->skinObj = new Theme_Model_Skin ();
		
		//category objects
		$this->categoryObj = new Category_Model_Default ();
		
		//Upload Object
		$this->uploadObj = new Aula_Model_Upload_Photo ( 'filePhoto' );
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'photoId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'titlePhoto' => array ('text', 1 ), 'aliasPhoto' => array ('text', 1 ), 'introTextPhoto' => array ('text', 0 ), 'sourcePhoto' => array ('numeric', 1 ), 'takenDatePhoto' => array ('shortDateTime', 0 ), 'takenLocationPhoto' => array ('text', 0 ), 'filePhoto' => array ('fileUploaded', 1, (! empty ( $_FILES ['filePhoto'] ['name'] ) ? $_FILES ['filePhoto'] ['name'] : '') ), 'category' => array ('numericUnsigned', 1 ), 'subCategoryId' => array ('numericUnsigned', 0, 0 ), 'photoEssays' => array ('numericUnsigned', 0, 0 ), 'tag' => array ('text', 0 ), 'showInObject' => array ('text', 0, $this->photoObj->showInObject ), 'originalAuthor' => array ('text', 0 ), 'createdDate' => array ('shortDateTime', 0, $this->objectObj->createdDate ), 'themePublishFrom' => array ('shortDateTime', 0 ), 'themePublishTo' => array ('shortDateTime', 0 ), 'publishFrom' => array ('shortDateTime', 0 ), 'publishTo' => array ('shortDateTime', 0 ), 'parent' => array ('numericUnsigned', 0, $this->objectObj->parentId ), 'objectType' => array ('numericUnsigned', 0, $this->photoObj->objectType ), 'showInList' => array ('text', 0, $this->objectObj->showInList ), 'published' => array ('text', 0, $this->photoObj->published ), 'approved' => array ('text', 0, $this->photoObj->approved ), 'comment' => array ('text', 0, $this->photoObj->comments ), 'option' => array ('text', 0, $this->photoObj->options ), 'pageTitle' => array ('text', 0 ), 'metaTitle' => array ('text', 0 ), 'metaKey' => array ('text', 0 ), 'metaDesc' => array ('text', 0 ), 'metaData' => array ('text', 0 ), 'layout' => array ('numericUnsigned', 0, $this->objectInfoObj->layoutId ), 'template' => array ('numericUnsigned', 0, $this->objectInfoObj->templateId ), 'skin' => array ('numericUnsigned', 0, $this->objectInfoObj->skinId ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'order' => array ('numericUnsigned', 0, $this->photoObj->order ), 'afterId' => array ('numeric', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//source list
		$this->sourcePhotoList = '';
		$this->sourcePhotoListResult = $this->sourceObj->getAllObject_sourceOrderById ();
		if (! empty ( $this->sourcePhotoListResult )) {
			foreach ( $this->sourcePhotoListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['sourcePhoto'] ['value']) ? 'selected="selected"' : '';
				$this->sourcePhotoList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['name'] . '</option>';
			}
		}
		$this->view->sourcePhotoList = $this->sourcePhotoList;
		
		//category list
		$this->view->categoryList = '';
		$this->view->categoryTopMenuList = '';
		$this->view->categoryDropDownList = '';
		$this->categoryListResult = $this->categoryObj->GetAllCleanCategoryByParent_idOrderByColumn ( 'id', 0 );
		if (! empty ( $this->categoryListResult )) {
			foreach ( $this->categoryListResult as $key => $category ) {
				$this->categoryList [$category ['id']] = $this->view->__ ( $category ['label'] );
				$this->view->categoryTopMenuList .= '<li><a href="/object-photo/list/cat/' . $category ['id'] . '">' . $this->view->__ ( $category ['label'] ) . '</a></li>' . PHP_EOL;
				$this->view->categoryDropDownList .= '<option value="' . $category ['id'] . '">' . $this->view->__ ( $category ['label'] ) . '</option>' . PHP_EOL;
			}
		}
		$this->view->categoryList = $this->view->categoryDropDownList;
		
		$this->photoEssaysList = '';
		$this->photoEssaysListResult = $this->categoryObj->GetAllCategoryByParent_idOrderById ( self::ESSAYS_CATEGORY_ID );
		if (! empty ( $this->photoEssaysListResult )) {
			foreach ( $this->photoEssaysListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['photoEssays'] ['value']) ? 'selected="selected"' : '';
				$this->photoEssaysList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->photoEssaysList = $this->photoEssaysList;
		
		//template list
		$this->templateList = '';
		$this->templateListResult = $this->templateObj->getAllTheme_templateOrderById ();
		if (! empty ( $this->templateListResult )) {
			foreach ( $this->templateListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['template'] ['value']) ? 'selected="selected"' : '';
				$this->templateList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->templateList = $this->templateList;
		
		//layout list
		$this->layoutList = '';
		$this->layoutListResult = $this->layoutObj->getAllTheme_layoutOrderById ();
		if (! empty ( $this->layoutListResult )) {
			foreach ( $this->layoutListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['layout'] ['value']) ? 'selected="selected"' : '';
				$this->layoutList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->layoutList = $this->layoutList;
		
		//skin list
		$this->skinList = '';
		$this->skinListResult = $this->skinObj->getAllTheme_skinOrderById ();
		if (! empty ( $this->skinListResult )) {
			foreach ( $this->skinListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['skin'] ['value']) ? 'selected="selected"' : '';
				$this->skinList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->skinList = $this->skinList;
	}
	
	public function addAction() {
		$this->view->sanitized = $_POST;
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'filePhoto_1' => array ('fileUploaded', 1, (! empty ( $_FILES ['filePhoto_1'] ['name'] ) ? $_FILES ['filePhoto_1'] ['name'] : '') ), 'title_1' => array ('text', 1 ), 'category_1' => array ('numeric', 0 ), 'subCategoryId_1' => array ('numeric', 0 ), 'filePhoto_2' => array ('fileUploaded', 0, (! empty ( $_FILES ['filePhoto_2'] ['name'] ) ? $_FILES ['filePhoto_2'] ['name'] : '') ), 'title_2' => array ('text', 0 ), 'category_2' => array ('numeric', 0 ), 'subCategoryId_2' => array ('numeric', 0 ), 'filePhoto_3' => array ('fileUploaded', 0, (! empty ( $_FILES ['filePhoto_3'] ['name'] ) ? $_FILES ['filePhoto_3'] ['name'] : '') ), 'title_3' => array ('text', 0 ), 'category_3' => array ('numeric', 0 ), 'subCategoryId_3' => array ('numeric', 0 ), 'filePhoto_4' => array ('fileUploaded', 0, (! empty ( $_FILES ['filePhoto_4'] ['name'] ) ? $_FILES ['filePhoto_4'] ['name'] : '') ), 'title_4' => array ('text', 0 ), 'category_4' => array ('numeric', 0 ), 'subCategoryId_4' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$photoEssays = 0;
				for($i = 0; $i < sizeof ( $_FILES ); $i ++) {
					$j = $i + 1;
					unset ( $this->uploadObj );
					
					$this->uploadObj = new Aula_Model_Upload_Photo ( "filePhoto_{$j}" );
					
					if (empty ( $_FILES ["filePhoto_{$j}"] ['name'] ) and $_FILES ["filePhoto_{$j}"] ['error'] == 4) {
						break;
					}
					
					$result = $this->objectObj->insertIntoObject ( NULL, $this->view->sanitized->{"title_$j"}->value, NULL, $this->userId, $photoEssays, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $this->view->sanitized->{"subCategoryId_$j"}->value, 1, 'GUID' );
					$this->view->sanitized->Id->value = $result [0];
					$result = $this->objectInfoObj->insertIntoObject_info ( NULL, $this->view->sanitized->Id->value, $this->photoObj->comments, $this->photoObj->options, NULL, NULL, NULL, NULL, NULL );
					if ($this->uploadObj->validatedMime ()) {
						if ($this->uploadObj->validatedSize ()) {
							
							$this->view->sanitized->filePhoto_ {$j}->size = $this->uploadObj->size;
							$this->view->sanitized->filePhoto_ {$j}->height = $this->uploadObj->height;
							$this->view->sanitized->filePhoto_ {$j}->width = $this->uploadObj->width;
							$this->view->sanitized->filePhoto_ {$j}->extension = $this->uploadObj->mime;
							$this->view->sanitized->filePhoto_ {$j}->takenTime = $this->uploadObj->takenTime;
							$this->view->sanitized->filePhoto_ {$j}->comments = $this->uploadObj->comments;
							$this->view->sanitized->filePhoto_ {$j}->isColor = $this->uploadObj->isColor;
							
							$result = $this->photoObj->insertIntoObject_photo ( Null, $this->view->sanitized->{"title_$j"}->value, NULL, $this->userId, $photoEssays, $this->view->sanitized->Id->value, $this->view->sanitized->{"category_$j"}->value, $this->view->sanitized->filePhoto_ {$j}->size, $this->view->sanitized->filePhoto_ {$j}->height, $this->view->sanitized->filePhoto_ {$j}->width, $this->view->sanitized->filePhoto_ {$j}->extension, $this->uploadObj->takenTime, NULL, NULL, $this->uploadObj->comments, $this->photoObj->options );
							$this->view->sanitized->Id->value = $result [0];
							
							if (is_numeric ( $this->view->sanitized->Id->value )) {
								
								$this->uploadObj->newFileName = parent::$encryptedDisk ['photo'] ['original'] [$this->fc->_dateTodayVeryShortDate] . md5 ( $this->fc->settings->encryption->hash . $this->view->sanitized->Id->value ) . '.jpg';
								$fileUploaded = $this->uploadObj->uploadFile ( $this->uploadObj->newFileName );
								
								$thumbUploaded = $this->uploadObj->resizeUploadImage ( 76, 52, parent::$encryptedDisk ['photo'] ['thumb'] [$this->fc->_dateTodayVeryShortDate] );
								$thumbLargeUploaded = $this->uploadObj->resizeUploadImage ( 184, 125, parent::$encryptedDisk ['photo'] ['thumb-large'] [$this->fc->_dateTodayVeryShortDate] );
								$mediumUploaded = $this->uploadObj->resizeUploadImage ( 470, 320, parent::$encryptedDisk ['photo'] ['medium'] [$this->fc->_dateTodayVeryShortDate], $this->fc->settings->directories->cache . 'watermark.png' );
								$largeMiniUploaded = $this->uploadObj->resizeUploadImage ( 600, 408, parent::$encryptedDisk ['photo'] ['large-mini'] [$this->fc->_dateTodayVeryShortDate], $this->fc->settings->directories->cache . 'watermark.png' );
								$largeUploaded = $this->uploadObj->resizeUploadImage ( 800, 545, parent::$encryptedDisk ['photo'] ['large'] [$this->fc->_dateTodayVeryShortDate], $this->fc->settings->directories->cache . 'watermark.png' );
								
								$mail = mail ( $this->fc->settings->email->webamster, $this->view->__ ( 'New Photo Added on Qumra' ), $this->view->__ ( 'Username:' ) . $this->userName . '<br />' . $this->view->__ ( 'Full Name:' ) . $this->userFullName . '<br />' . $this->view->__ ( 'Email:' ) . $this->userEmail . '<br />' . $this->view->__ ( 'Photo Title:' ) . $this->view->sanitized->{"title_$j"}->value . '<br />' );
							}
						} else {
							$this->errorMessage ['filePhoto'] = $this->view->__ ( 'Invalid File Size' );
						}
					} else {
						$this->errorMessage ['filePhoto'] = $this->view->__ ( 'Invalid File Type' );
					}
				}
				header ( 'Location: /object-photo/thanks' );
				exit ();
			}
		} else {
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		
		if (! empty ( $this->errorMessage )) {
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		
		$this->view->render ( 'addPhotos.phtml' );
		exit ();
	}
	
	public function thanksAction() {
		$this->view->render ( 'add-photo-thanks.phtml' );
		exit ();
	}
	
	public function listSubCatAjaxAction() {
		$subCategoryList = '<input class="inptflx" type="text" value="0" name="subCategoryId_1" readonly="readonly" />';
		if (! isset ( $_POST ['index'] ) or empty ( $_POST ['index'] )) {
			echo $subCategoryList;
			exit ();
		}
		
		if (! isset ( $_POST ['category'] ) or empty ( $_POST ['category'] )) {
			echo $subCategoryList;
			exit ();
		}
		
		$categoryId = ( int ) $_POST ['category'];
		$indexId = ( int ) $_POST ['index'];
		
		$subCategoryList = '<input class="inptflx" type="text" value="0" id="subCategoryId_' . $indexId . '" name="subCategoryId_' . $indexId . '" readonly="readonly" />';
		
		$subCategoryListResult = $this->categoryObj->GetAllCategoryByParent_idOrderById ( $categoryId );
		if (! empty ( $subCategoryListResult )) {
			$subCategoryList = '<select class="inptslct" id="subCategoryId_' . $indexId . '" name="subCategoryId_' . $indexId . '">';
			foreach ( $subCategoryListResult as $key => $value ) {
				$subCategoryList .= '<option value="' . $value ['id'] . '">' . $value ['title'] . '</option>';
			}
			$subCategoryList .= '</select>';
		}
		
		echo $subCategoryList;
		exit ();
	}
	
	public function listAction() {
		$categoryId = NULL;
		$subCategoryId = NULL;
		$authorId = NULL;
		$searchText = NULL;
		
		if (isset ( $_GET ['cat'] ) and is_numeric ( $_GET ['cat'] )) {
			$categoryId = ( int ) $_GET ['cat'];
		}
		if (isset ( $_GET ['sub-cat'] ) and is_numeric ( $_GET ['sub-cat'] )) {
			$subCategoryId = ( int ) $_GET ['sub-cat'];
		}
		if (isset ( $_GET ['author'] ) and is_numeric ( $_GET ['author'] )) {
			$authorId = ( int ) $_GET ['author'];
			if ($authorId == - 1) {
				$authorId = NULL;
			}
		}
		if (isset ( $_GET ['search'] )) {
			$searchText = $_GET ['search'];
		}
		
		$userList = '';
		$this->userObj = new User_Model_Default ();
		$userListResult = $this->userObj->GetCleanUserAndUserInfoOrderByColumn ( 'u.id', 'DESC', 0, 99999 );
		if (! empty ( $userListResult )) {
			foreach ( $userListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $authorId) ? 'selected="selected"' : '';
				$userList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['fullname'] . '</option>';
			}
		}
		
		$this->view->userList = $userList;
		
		if (! is_null ( $authorId )) {
			if (! is_null ( $subCategoryId )) {
				$photoListResult = $this->photoObj->GetAllCleanPhotoAndCategoryAndUserByAuthorAndSubCategoryOrderByColWithLimit ( 'op.id', $subCategoryId, $authorId, $this->start, $this->limit, 'DESC' );
			} elseif (! is_null ( $categoryId )) {
				$photoListResult = $this->photoObj->GetAllObject_photoAndCategoryAndUserByCategory_idAndAuthor_idOrderByIdWithLimit ( $categoryId, $authorId, $this->start, $this->limit, 'DESC' );
			} else {
				$photoListResult = $this->photoObj->GetAllPhotoCleanByUserOrderByColumnWithLimit ( $authorId, 'op.id', $this->start, $this->limit, 'DESC' );
			}
		} else if (! is_null ( $searchText )) {
			if ($categoryId == - 1) {
				$categoryId = 'op.category_id';
			}
			$photoListResult = $this->photoObj->GetAllObject_photoAndCategoryAndUserByCategory_idAndTitleOrderByColumnWithLimit ( 'op.id', $searchText, $categoryId, $this->start, $this->limit, 'DESC' );
		} else if (! is_null ( $subCategoryId )) {
			$photoListResult = $this->photoObj->GetAllCleanPhotoAndCategoryAndUserBySubCatOrderByColWithLimit ( 'op.id', $subCategoryId, $this->start, $this->limit, 'DESC' );
		} else if (! is_null ( $categoryId )) {
			//category list
			$this->view->categoryId = $categoryId;
			$this->view->category = $this->categoryList [$categoryId];
			$this->view->subCategoryList = '';
			$this->subCategoryListResult = $this->categoryObj->GetCleanCatAndCatInfoByParentIdOrderByColumnWithLimit ( 'c.title', $categoryId, 'ASC', 0, 9999 );
			if (! empty ( $this->subCategoryListResult )) {
				$this->view->subCategoryList = $this->subCategoryListResult;
				$this->view->render ( 'categories.phtml' );
				exit ();
			}
			$photoListResult = $this->photoObj->GetAllObject_photoAndCategoryAndUserByCategory_idOrderByIdWithLimit ( $categoryId, $this->start, $this->limit, 'DESC' );
		} else {
			$photoListResult = $this->photoObj->GetAllPhotoAndCategoryAndUserOrderByColumnWithLimit ( 'op.date_added', $this->start, $this->limit, 'DESC' );
		}
		
		if (! empty ( $photoListResult ) and $photoListResult !== false) {
			foreach ( $photoListResult as $k => $image ) {
				$photoListResult [$k] ['url'] = parent::$encryptedUrl ['photo'] ['thumb-large'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['mediumUrl'] = parent::$encryptedUrl ['photo'] ['medium'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['largeUrl'] = parent::$encryptedUrl ['photo'] ['large-mini'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
			}
			$this->pagingObj->_init ( $this->photoObj->totalRecordsFound );
			$this->view->paging = $this->pagingObj->paging;
			$this->view->arrayToObject ( $this->view->paging );
			$this->view->photoListResult = $photoListResult;
			$this->view->arrayToObject ( $this->view->photoListResult );
		} else {
			$photoListResult = NULL;
		}
		
		$this->view->render ( 'photos.phtml' );
		exit ();
	}
	
	public function detailsAction() {
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$photoId = ( int ) $_GET ['id'];
		} else {
			header ( 'Location: /' );
			exit ();
		}
		
		$photoListResult = $this->photoObj->GetPhotoDetailsCleanByPhotoId ( $photoId );
		
		if (! empty ( $photoListResult )) {
			
			foreach ( $this->categoryListResult as $key => $category ) {
				$categoryList [$category ['id']] = $category ['title'];
			}
			
			foreach ( $photoListResult as $k => $image ) {
				$photoListResult [$k] ['url'] = parent::$encryptedUrl ['photo'] ['thumb-large'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['mediumUrl'] = parent::$encryptedUrl ['photo'] ['large-mini'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['largeUrl'] = parent::$encryptedUrl ['photo'] ['large'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['category'] = $categoryList [$image ['category_id']];
			}
			$photo = $photoListResult [0];
			$this->pagingObj->totalRecordsPerPage = 4;
			$this->pagingObj->_init ( $this->photoObj->totalRecordsFound );
			$this->view->paging = $this->pagingObj->paging;
			$this->view->arrayToObject ( $this->view->paging );
		} else {
			$photoListResult = NULL;
		}
		
		$this->limit = 4;
		$this->essayImages = $this->photoObj->GetAllCleanPhotoEssaysOrderByColWithLimit ( 'op.id', $this->start, $this->limit, 'DESC' );
		
		foreach ( $this->essayImages as $k => $image ) {
			$this->essayImages [$k] ['url'] = parent::$encryptedUrl ['photo'] ['thumb-large'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
		}
		
		$this->view->essayImages = $this->essayImages;
		$this->view->arrayToObject ( $this->view->essayImages );
		
		$this->pagingObj->totalRecordsPerPage = 4;
		$this->pagingObj->_init ( $this->photoObj->totalRecordsFound );
		$this->view->paging = $this->pagingObj->paging;
		$this->view->arrayToObject ( $this->view->paging );
		
		$this->view->photo = $photo;
		$this->view->arrayToObject ( $this->view->photo );
		$this->view->render ( 'photoDetails.phtml' );
		exit ();
	}
	
	public function assignmentsAction() {
		
		$photoListResult = $this->photoObj->GetAllObject_photoAndCategoryAndUserByCategory_idOrderByIdWithLimit ( self::ASSIGMENTS_CATEGORY_ID, 0, 5, 'DESC' );
		if (! empty ( $photoListResult )) {
			
			foreach ( $photoListResult as $k => $image ) {
				$photoListResult [$k] ['url'] = parent::$encryptedUrl ['photo'] ['thumb'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['mediumUrl'] = parent::$encryptedUrl ['photo'] ['medium'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
				$photoListResult [$k] ['largeUrl'] = parent::$encryptedUrl ['photo'] ['large-mini'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
			}
		} else {
			$photoListResult = NULL;
		}
		
		$staticObj = new Object_Model_Static ();
		$result = $staticObj->getObject_staticDetailsById ( 4 );
		$this->view->body = $this->filterObj->unSanitizeData ( $result [0] ['full_text'] );
		$this->view->photoList = $photoListResult;
		$this->view->arrayToObject ( $this->view->photoList );
		$this->view->render ( 'assignments.phtml' );
		exit ();
	}
	
	public function essaysAction() {
		foreach ( $this->categoryListResult as $key => $category ) {
			$categoryList [$category ['id']] = $this->view->__ ( $category ['title'] );
		}
		
		$photoId = NULL;
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$photoId = ( int ) $_GET ['id'];
			$photoListResult = $this->photoObj->GetPhotoDetailsCleanByPhotoId ( $photoId );
			if (! empty ( $photoListResult [0] )) {
				$photo = $photoListResult [0];
				$photo ['url'] = parent::$encryptedUrl ['photo'] ['thumb-large'] [substr ( $photo ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $photo ['id'] ) . '.jpg';
				$photo ['mediumUrl'] = parent::$encryptedUrl ['photo'] ['large-mini'] [substr ( $photo ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $photo ['id'] ) . '.jpg';
				$photo ['largeUrl'] = parent::$encryptedUrl ['photo'] ['large'] [substr ( $photo ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $photo ['id'] ) . '.jpg';
				$photo ['category'] = $categoryList [$photo ['category_id']];
			} else {
				$photoListResult = NULL;
			}
		}
		
		if (isset ( $_GET ['sub-cat'] ) and is_numeric ( $_GET ['sub-cat'] )) {
			$subcategory_id = ( int ) $_GET ['sub-cat'];
		} else if (! empty ( $photoListResult ) and is_numeric ( $photo ['sub_category'] ) and $photo ['sub_category'] > 0) {
			$subcategory_id = ( int ) $photo ['sub_category'];
		} else {
			header ( 'Location: /' );
			exit ();
		}
		
		$this->essayImages = $this->photoObj->GetAllCleanPhotoAndCategoryAndUserBySubCatOrderByColWithLimit ( 'op.id', $subcategory_id, $this->start, 4 );
		
		foreach ( $this->essayImages as $k => $image ) {
			$this->essayImages [$k] ['url'] = parent::$encryptedUrl ['photo'] ['thumb-large'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
			$this->essayImages [$k] ['mediumUrl'] = parent::$encryptedUrl ['photo'] ['large-mini'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
			$this->essayImages [$k] ['largeUrl'] = parent::$encryptedUrl ['photo'] ['large'] [substr ( $image ['date_added'], 0, 7 )] . md5 ( $this->fc->settings->encryption->hash . $image ['id'] ) . '.jpg';
			$this->essayImages [$k] ['category'] = $categoryList [$image ['category_id']];
		}
		
		if (is_null ( $photoId )) {
			$photo = $this->essayImages [0];
		}
		
		$this->view->essayImages = $this->essayImages;
		$this->view->arrayToObject ( $this->view->essayImages );
		
		$this->pagingObj->totalRecordsPerPage = 4;
		$this->pagingObj->_init ( $this->photoObj->totalRecordsFound );
		$this->view->paging = $this->pagingObj->paging;
		$this->view->arrayToObject ( $this->view->paging );
		
		$this->view->photo = $photo;
		$this->view->arrayToObject ( $this->view->photo );
		$this->view->render ( 'photoDetails.phtml' );
		exit ();
	}
	
	public function viewAction() {
	}
	
	public function printAction() {
	}
	
	public function shareAction() {
	}
	
	public function saveAction() {
	}
	
	public function sendToFriendAction() {
	}

}
