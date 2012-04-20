<?php

class Home_Controller_Default extends Aula_Controller_Action {
	
	private $bannerObj = '';
	private $bannerAreaObj = '';
	private $featureList = '';
	private $articleObj = '';
	private $photoObj = '';
	private $usersObj = '';
	private $menuObj = '';
	private $featureArticles = '';
	
	private $newsInternationalList = NULL;
	private $newsEntertainmentList = NULL;
	
	protected function _init() {
		$this->articleObj = new Object_Model_Article ();
		$this->photoObj = new Object_Model_Photo ();
		$this->bannerObj = new Banner_Model_Default ();
		$this->bannerAreaObj = new Banner_Model_Area ();
		
		//category objects
		$this->categoryObj = new Category_Model_Default ();
		$this->usersObj = new User_Model_Default ();
		
		//meun object
		$this->menuObj = new Menu_Model_Default ();
		
		/**
		 * @todo should be remvoed
		 *
		 $authorsListResult = $this->usersObj->GetAllUserByUser_level_idOrderById ( 3 );
		 if (! empty ( $authorsListResult )) {
		 foreach ( $authorsListResult as $key => $value ) {
		 $authorsList [$value ['fullname']] = $value ['id'];
		 }
		 $this->view->authorsListWriters = $authorsList;
		 }
		 * */
		
		//category list
		$this->view->categoryList = '';
		$this->view->categoryTopMenuList = '';
		$this->view->categoryDropDownList = '';
		
		$this->categoryListResult = $this->categoryObj->GetAllCleanCategoryByParent_idOrderByColumn ( 'id', 0 );
		
		if (! empty ( $this->categoryListResult )) {
			foreach ( $this->categoryListResult as $key => $category ) {
				$this->view->categoryList [$category ['id']] = $category ['title'];
				$this->view->categoryTopMenuList .= '<li><a href="/object-photo/list/cat/' . $category ['id'] . '">' . $this->view->__ ( $category ['label'] ) . '</a></li>' . PHP_EOL;
				$this->view->categoryDropDownList .= '<option value="' . $category ['id'] . '">' . $this->view->__ ( $category ['label'] ) . '</option>' . PHP_EOL;
			}
		}
		
		$bannersListResult = $this->bannerObj->GetCleanDistinctBannerAndAreaOrderByColumn ();
		$this->view->bannersList = '';
		if (! empty ( $bannersListResult ) and false != $bannersListResult) {
			$this->bannersList = $bannersListResult;
			$this->buildBanners ();
			$this->view->bannersList = $this->bannersList;
		}
	}
	
	public function landingAction() {
		$this->view->render ( '../../landing_page/template/landing.phtml' );
		exit ();
	}
	
	public function defaultAction() {
		/*if (false === strpos( $_SERVER['HTTP_REFERER'], $this->fc->settings->domain)
		 AND (0 !== strpos($_SERVER['REQUEST_URI'], '/default'))) {
		 $this->landingAction();
		 }*/
		$this->view->render ( 'index.phtml' );
	}
	
	public function pageAction() {
		if (! isset ( $this->view->msgNotificaiton ) or empty ( $this->view->msgNotificaiton )) {
			$this->view->msgNotificaiton = '';
		}
		if (! isset ( $this->view->articleTrailer ) or empty ( $this->view->articleTrailer )) {
			$this->view->articleTrailer = '';
		}
		
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$pageId = ( int ) $_GET ['id'];
		} else {
			header ( 'Location: /' );
			exit ();
		}
		
		$staticObj = new Object_Model_Static ();
		$result = $staticObj->getObject_staticDetailsById ( $pageId );
		if (empty ( $result ) or false == $result) {
			header ( 'Location: /' );
			exit ();
		}
		$this->view->articleTitle = $result [0] ['alias'];
		$this->view->articleHeader = $result [0] ['alias'];
		$this->view->articleBody = $this->filterObj->unSanitizeData ( $result [0] ['full_text'] );
		$this->view->render ( 'article.phtml' );
	}
	
	public function cartAction() {
		$this->view->msgNotificaiton = '';
		if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$_GET ['id'] = 3;
			$cartId = ( int ) $_GET ['id'];
			mail ( $this->fc->settings->email->webamster, $this->view->__ ( 'New Cart Request from Qumra' ), $this->view->userName . ' want to order ' . '<a href="/object-photo/details/id/' . $cartId . '">this photo</a><br />' . 'User Nick Name: ' . $this->view->userName . 'User Full Name: ' . $this->view->userFullName . 'User Email: ' . $this->view->userEmail );
			$this->view->msgNotificaiton = $this->view->__ ( 'Your order has been sent.' );
			$this->pageAction ();
		}
		header ( 'Location: /' );
		exit ();
	}
	
	public function contactUsAction() {
		$this->view->render ( 'contact.phtml' );
		exit ();
	}
	
	public function tellFriendAction() {
		$this->view->msgNotificaiton = $this->view->__ ( '' );
		if ($this->isPagePostBack) {
			if (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
				$photoId = ( int ) $_GET ['id'];
			} else {
				header ( 'Location: /' );
				exit ();
			}
			$this->view->sanitized = $_POST;
			$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'userName' => array ('text', 1 ), 'userEmail' => array ('email', 1 ), 'friendName-1' => array ('text', 1 ), 'friendEmail-1' => array ('email', 1 ), 'friendName-2' => array ('text', 0 ), 'friendEmail-2' => array ('email', 0 ), 'friendName-3' => array ('text', 0 ), 'friendEmail-3' => array ('email', 0 ), 'friendName-4' => array ('text', 0 ), 'friendEmail-4' => array ('email', 0 ), 'friendName-5' => array ('text', 0 ), 'friendEmail-5' => array ('email', 0 ), 'btn_submit' => array ('', 0, 2 ) );
			$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			
			if (! empty ( $this->view->sanitized ['friendName-1'] ['value'] ) and ! empty ( $this->view->sanitized ['friendEmail-1'] ['value'] )) {
				mail ( $this->view->sanitized ['friendEmail-1'] ['value'], $this->view->__ ( 'Your friend want to share with you this photo' ), $this->view->sanitized ['userName'] ['value'] . ' with email ' . $this->view->sanitized ['userEmail'] ['value'] . ' wants to share with you ' . '<a href="/object-photo/details/id/' . $photoId . '">this photo</a><br />' );
			}
			if (! empty ( $this->view->sanitized ['friendName-2'] ['value'] ) and ! empty ( $this->view->sanitized ['friendEmail-2'] ['value'] )) {
				mail ( $this->view->sanitized ['friendEmail-2'] ['value'], $this->view->__ ( 'Your friend want to share with you this photo' ), $this->view->sanitized ['userName'] ['value'] . ' with email ' . $this->view->sanitized ['userEmail'] ['value'] . ' wants to share with you ' . '<a href="/object-photo/details/id/' . $photoId . '">this photo</a><br />' );
			}
			if (! empty ( $this->view->sanitized ['friendName-3'] ['value'] ) and ! empty ( $this->view->sanitized ['friendEmail-3'] ['value'] )) {
				mail ( $this->view->sanitized ['friendEmail-3'] ['value'], $this->view->__ ( 'Your friend want to share with you this photo' ), $this->view->sanitized ['userName'] ['value'] . ' with email ' . $this->view->sanitized ['userEmail'] ['value'] . ' wants to share with you ' . '<a href="/object-photo/details/id/' . $photoId . '">this photo</a><br />' );
			}
			if (! empty ( $this->view->sanitized ['friendName-4'] ['value'] ) and ! empty ( $this->view->sanitized ['friendEmail-4'] ['value'] )) {
				mail ( $this->view->sanitized ['friendEmail-4'] ['value'], $this->view->__ ( 'Your friend want to share with you this photo' ), $this->view->sanitized ['userName'] ['value'] . ' with email ' . $this->view->sanitized ['userEmail'] ['value'] . ' wants to share with you ' . '<a href="/object-photo/details/id/' . $photoId . '">this photo</a><br />' );
			}
			$this->view->msgNotificaiton = $this->view->__ ( 'Emails has been sent successfully.' );
		}
		
		$this->view->render ( 'tell-friend.phtml' );
	}

}
