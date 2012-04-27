<?php

class Object_Controller_CommentAdmin extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $commentObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();
		//objects
		$this -> commentObj = new Object_Model_Comment();
		$this -> articleObj = new Object_Model_Article();
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();

		/* @var $fields Object_Controller_Comment */
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'object' => array('numericUnsigned', 0), 'dateAddedFromSearch' => array('text', 0), 'dateAddedToSearch' => array('text', 0), 'publishedSearch' => array('text', 0), 'approvedSearch' => array('text', 0), 'articleTitleSearch' => array('text', 0), 'userIdSearch' => array('text', 0), 'contentSearch' => array('text', 0), 'btn_search' => array('text', 0), 'webpage' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'emailSearch' => array('text', 0), 'status' => array('text', 0), 'title' => array('text', 0), 'content' => array('text', 0), 'commentId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'userId' => array('text', 0), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleComment' => array('text', 0), 'emailComment' => array('email', 0), 'email' => array('email', 0), 'webpageComment' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'contentComment' => array('', 1), 'approved' => array('text', 0, $this -> commentObj -> approved), 'published' => array('text', 0, $this -> commentObj -> approved), 'comment' => array('text', 0, $this -> commentObj -> comments), 'option' => array('text', 0, $this -> commentObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['author']['value'] = 1;
		$this -> view -> sanitized['locale']['value'] = 1;

		//objects list
		$this -> objectList = '';
		/*$this->objectListResult = $this->objectObj->getAllObjectOrderById ();
		 if (! empty ( $this->objectListResult )) {
		 foreach ( $this->objectListResult as $key => $value ) {
		 $selectedItem = ($value ['id'] == $this->view->sanitized ['object'] ['value']) ? 'selected="selected"' : '';
		 $this->objectList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
		 }
		 }*/
		$this -> view -> objectList = $this -> objectList = array();
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> commentObj -> insertIntoObject_comment(Null, $this -> view -> sanitized -> object -> value, $this -> userId, $this -> view -> sanitized -> titleComment -> value, $this -> view -> sanitized -> contentComment -> value, $this -> view -> userFullName, $this -> view -> sanitized -> webpageComment -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-comment/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-comment/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('object/addCommentObject.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> commentObj -> updateObject_commentById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> object -> value, $this -> view -> sanitized -> author -> value, $this -> view -> sanitized -> titleComment -> value, $this -> view -> sanitized -> contentComment -> value, $this -> view -> sanitized -> emailComment -> value, $this -> view -> sanitized -> webpage -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/object-comment/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/object-comment/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> commentObj -> getObject_commentDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'webpage' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'status' => array('text', 0), 'title' => array('text', 0), 'content' => array('text', 0, $result['content']), 'commentId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $result['author_id']), 'titleComment' => array('text', 1, $result['title']), 'emailComment' => array('email', 0, $result['email']), 'email' => array('email', 0, $result['email']), 'webpageComment' => array('ipAddress', 0, $result['webpage']), 'contentComment' => array('', 1, $result['content']), 'object' => array('numericUnsigned', 1, $result['object_id']), 'approved' => array('text', 0, $result['approved']), 'published' => array('text', 0, $result['published']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));

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

		$this -> view -> render('object/addCommentObject.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> commentId -> value = ( array )$this -> view -> sanitized -> commentId -> value;

		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> commentId -> value)) {
			foreach ($this->view->sanitized->commentId->value as $id => $value) {
				$commentResult = $this -> commentObj -> getObject_commentDetailsById($id);
				$commentResult = $commentResult[0];
				if (0 === strcmp('Yes', $commentResult['approved'])) {
					$commentCounter = $this -> objectInfoObj -> updateObject_infoIncreaseTotal_commentsColumnByObjectId($commentResult['object_id'], -1);
				}

				$commentDelete = $this -> commentObj -> deleteFromObject_commentById($id);
			}
			if (!empty($commentDelete)) {
				header('Location: /admin/handle/pkg/object-comment/action/list/success/delete');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-comment/action/list/');
		if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
			header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
		}
		exit();
	}

	public function contentAction() {
	}

	public function publishAction() {
		/**
		 * @todo check error messages if as an example the admin  replace the email by wrong incorrect email
		 */

		$this -> view -> arrayToObject($this -> view -> sanitized);

		$this -> view -> sanitized -> userId -> value = ( array )$this -> view -> sanitized -> userId -> value;
		$this -> view -> sanitized -> content -> value = ( array )$this -> view -> sanitized -> content -> value;
		$this -> view -> sanitized -> commentId -> value = ( array )$this -> view -> sanitized -> commentId -> value;

		if (!empty($this -> view -> sanitized -> commentId -> value)) {
			foreach ($this->view->sanitized->commentId->value as $id => $value) {
				$value = $this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
				$commentResult = $this -> commentObj -> getObject_commentDetailsById($id);
				$commentResult = $commentResult[0];
				$publishedDate = sscanf($commentResult['options'], "LastPublished=%d");

				if (is_null($publishedDate)) {
					$commentResult['options'] .= "LastPublished=" . time() . PHP_EOL;
				} else {
					$commentResult['options'] = str_replace($publishedDate[0], time(), $commentResult['options']);
				}

				$commentPublish = $this -> commentObj -> updateObject_commentById($id, $commentResult['object_id'], $this -> view -> sanitized -> userId -> value[$id], $commentResult['title'], $this -> view -> sanitized -> content -> value[$id], $this -> view -> userFullName, $commentResult['webpage'], $commentResult['locale_id'], $commentResult['comments'], $commentResult['options'], $value, $value, $commentResult['country_id']);

				if (0 !== strcmp($this -> view -> sanitized -> status -> value, $commentResult['approved'])) {
					$count = $this -> view -> sanitized -> status -> value == 'Yes' ? 1 : -1;
					$commentCounter = $this -> objectInfoObj -> updateObject_infoIncreaseTotal_commentsColumnByObjectId($commentResult['object_id'], $count);
				}
			}
			if (!empty($commentPublish)) {
				header('Location: /admin/handle/pkg/object-comment/action/list/success/publish');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-comment/action/list/');
		if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
			header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
		}
		exit();
	}

	public function approveAction() {
		/**
		 * @todo check error messages if as an example the admin  replace the email by wrong incorrect email
		 */
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> userId -> value = ( array )$this -> view -> sanitized -> userId -> value;
		$this -> view -> sanitized -> content -> value = ( array )$this -> view -> sanitized -> content -> value;
		$this -> view -> sanitized -> commentId -> value = ( array )$this -> view -> sanitized -> commentId -> value;

		if (!empty($this -> view -> sanitized -> commentId -> value)) {
			foreach ($this->view->sanitized->commentId->value as $id => $value) {
				$value = $this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
				$commentResult = $this -> commentObj -> getObject_commentDetailsById($id);
				$commentResult = $commentResult[0];
				$commentPublish = $this -> commentObj -> updateObject_commentById($id, $commentResult['object_id'], $this -> view -> sanitized -> userId -> value[$id], $commentResult['title'], $this -> view -> sanitized -> content -> value[$id], $this -> view -> userFullName, $commentResult['webpage'], $commentResult['locale_id'], $commentResult['comments'], $commentResult['options'], $commentResult['published'], $value, $commentResult['country_id']);

				if (0 !== strcmp($this -> view -> sanitized -> status -> value, $commentResult['approved'])) {
					$count = $this -> view -> sanitized -> status -> value == 'Yes' ? 1 : -1;
					$commentCounter = $this -> objectInfoObj -> updateObject_infoIncreaseTotal_commentsColumnByObjectId($commentResult['object_id'], $count);
				}
			}
			if (!empty($commentPublish)) {
				header('Location: /admin/handle/pkg/object-comment/action/list/success/publish');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-comment/action/list/');
		if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
			header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
		}
		exit();
	}

	public function listAction() {
		$iconsMixed = array(':sigh:' => '<span class="smilyes"><a class="sigh"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":roll:" width="18" height="18" /></a></span>', ':roll:' => '<span class="smilyes"><a class="sigh1"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":roll:" width="18" height="18" /></a></span>', ':P' => '<span class="smilyes"><a class="sigh2"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":P" width="18" height="18" /></a></span>', ':zzz' => '<span class="smilyes"><a class="sigh3"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":zzz" width="18" height="25" /></a></span>', ':eek:' => '<span class="smilyes"><a class="sigh4"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":eek:" width="18" height="18" /></a></span>', ':-x' => '<span class="smilyes"><a class="sigh5"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":-x" width="18" height="18" /></a></span>', ':-?' => '<span class="smilyes"><a class="sigh6"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":-?" width="18" height="18" /></a></span>', ':o' => '<span class="smilyes"><a class="sigh7"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":o" width="18" height="18" /></a></span>', ':cry:' => '<span class="smilyes"><a class="sigh8"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":cry:" width="18" height="18" /></a></span>', ':sad:' => '<span class="smilyes"><a class="sigh9"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"   alt=":sad:" width="18" height="18" /></a></span>', ':oops:' => '<span class="smilyes"><a class="sigh10"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":oops:" width="18" height="18" /></a></span>', ':-*' => '<span class="smilyes"><a class="sigh11"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":-*" width="18" height="19" /></a></span>', ':-|' => '<span class="smilyes"><a class="sigh12"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":-|" width="18" height="18" /></a></span>', '8)' => '<span class="smilyes"><a class="sigh13"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt="8)" width="18" height="18" /></a></span>', ';-)' => '<span class="smilyes"><a class="sigh14"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=";-)" width="18" height="18" /></a></span>', ':-)' => '<span class="smilyes"><a class="sigh15"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":-)" width="18" height="18" /></a></span>', ':lol:' => '<span class="smilyes"><a class="sigh16"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif"  alt=":lol:" width="18" height="18" /></a></span>', ':D' => '<span class="smilyes"><a class="sigh17"><img src="/theme/frontend/default/skin/ar_jo/images/spacer.gif" alt=":D" width="18" height="18" /></a></span>');

		$categoryList = NULL;

		$filterURI = '';
		$categoriesURI = '';
		$specialArticleURI = '';

		$isFilter = false;
		$isCategorySelected = false;
		$isSpecialArticleSelected = false;
		if (isset($_GET['special-article'])) {
			$isSpecialArticleSelected = true;
			$specialArticleURI = 'special-article/view/';
		}

		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-comment/action/';

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'approve') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
			$this -> view -> successMessageStyle = 'display: block;';
		} else if ($_GET['success'] == 'published') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		if (isset($_GET['category'])) {
			$isCategorySelected = true;
			$categoryList = $_GET['category'];
			if (!is_numeric($_GET['category'])) {
				$categoryList = '';
				$categoryId = explode(',', $_GET['category']);
				foreach ($categoryId as $value) {
					$categoryList .= ( int )$value . ',';

				}
				$categoryList = substr($categoryList, 0, -1);
			}
			$categoriesURI = 'category/' . $categoryList . '/';

			//$commentListResult = $this->commentObj->GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article ( $categoryList, $isSpecialArticleSelected, 'oc.id', $this->start, $this->limit, 'DESC' );
		}

		if (empty($categoryList)) {
			$categoryList = NULL;
		}

		if (isset($_GET['filter']) && $_GET['filter'] == 1) {
			$filterURI = '';
			if (!isset($_GET['webpageSearch']) || empty($_GET['webpageSearch'])) {
				$_GET['webpageSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'webpageSearch/' . $_GET['webpageSearch'] . '/';
			}
			if (!isset($_GET['emailSearch']) || empty($_GET['emailSearch'])) {
				$_GET['emailSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'emailSearch/' . $_GET['emailSearch'] . '/';
			}
			if (!isset($_GET['articleTitleSearch']) || empty($_GET['articleTitleSearch'])) {
				$_GET['articleTitleSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'articleTitleSearch/' . $_GET['articleTitleSearch'] . '/';
			}
			if (!isset($_GET['userIdSearch']) || empty($_GET['userIdSearch'])) {
				$_GET['userIdSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'userIdSearch/' . $_GET['userIdSearch'] . '/';
			}
			if (!isset($_GET['contentSearch']) || empty($_GET['contentSearch'])) {
				$_GET['contentSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'contentSearch/' . $_GET['contentSearch'] . '/';
			}
			if (!isset($_GET['publishedSearch']) || empty($_GET['publishedSearch'])) {
				$_GET['publishedSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'publishedSearch/' . $_GET['publishedSearch'] . '/';
			}
			if (!isset($_GET['approvedSearch']) || empty($_GET['approvedSearch'])) {
				$_GET['approvedSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'approvedSearch/' . $_GET['approvedSearch'] . '/';
			}
			if (!isset($_GET['dateAddedFromSearch']) || empty($_GET['dateAddedFromSearch'])) {
				$_GET['dateAddedFromSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'dateAddedFromSearch/' . $_GET['dateAddedFromSearch'] . '/';
			}
			if (!isset($_GET['dateAddedToSearch']) || empty($_GET['dateAddedToSearch'])) {
				$_GET['dateAddedToSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'dateAddedToSearch/' . $_GET['dateAddedToSearch'] . '/';
			}
		}

		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-comment/' . $categoriesURI . $specialArticleURI . 'action/';

		//set default sorting css class (no sorting)
		$this -> view -> sort -> webpage -> cssClass = 'sort-title';
		$this -> view -> sort -> userId -> cssClass = 'sort-title';
		$this -> view -> sort -> content -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> email -> cssClass = 'sort-title';

		//set default sorting values
		$this -> view -> sort -> webpage -> href = $this -> view -> sanitized -> actionURI -> value . 'list/webpage/asc/';
		$this -> view -> sort -> authorName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/authorName/asc/';
		$this -> view -> sort -> articleTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/articleTitle/asc/';
		$this -> view -> sort -> userId -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userId/asc/';
		$this -> view -> sort -> content -> href = $this -> view -> sanitized -> actionURI -> value . 'list/content/asc/';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc/';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc/';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc/';
		$this -> view -> sort -> email -> href = $this -> view -> sanitized -> actionURI -> value . 'list/email/asc/';

		if (isset($_GET['webpage']) && $_GET['webpage'] == 'asc') {
			$this -> view -> sort -> webpage -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> webpage -> href = $this -> view -> sanitized -> actionURI -> value . 'list/webpage/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('webpage', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'webpage', $this -> start, $this -> limit, 'ASC');
			} else {

				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'webpage', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['webpage']) && $_GET['webpage'] == 'desc') {
			$this -> view -> sort -> webpage -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('webpage', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'webpage', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'webpage', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['authorName']) && $_GET['authorName'] == 'asc') {
			$this -> view -> sort -> authorName -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> authorName -> href = $this -> view -> sanitized -> actionURI -> value . 'list/authorName/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('fullname', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'fullname', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'fullname', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['authorName']) && $_GET['authorName'] == 'desc') {
			$this -> view -> sort -> authorName -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('fullname', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'fullname', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'fullname', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['articleTitle']) && $_GET['articleTitle'] == 'asc') {
			$this -> view -> sort -> articleTitle -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> articleTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/articleTitle/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('o.`title`', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'o.`title`', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'o.`title`', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['articleTitle']) && $_GET['articleTitle'] == 'desc') {
			$this -> view -> sort -> articleTitle -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('o.`title`', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'o.`title`', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'o.`title`', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['userId']) && $_GET['userId'] == 'asc') {
			$this -> view -> sort -> userId -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> userId -> href = $this -> view -> sanitized -> actionURI -> value . 'list/userId/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.user_id', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.user_id', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.user_id', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['userId']) && $_GET['userId'] == 'desc') {
			$this -> view -> sort -> userId -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.user_id', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.user_id', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.user_id', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['content']) && $_GET['content'] == 'asc') {
			$this -> view -> sort -> content -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> content -> href = $this -> view -> sanitized -> actionURI -> value . 'list/content/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('content', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'content', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'content', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['content']) && $_GET['content'] == 'desc') {
			$this -> view -> sort -> content -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('content', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'content', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'content', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.date_added', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.date_added', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.date_added', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.date_added', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.date_added', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.date_added', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.published', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.published', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.published', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.published', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.published', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.published', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.approved', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.approved', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.approved', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.approved', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.approved', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.approved', $this -> start, $this -> limit, 'DESC');
			}
		} elseif (isset($_GET['email']) && $_GET['email'] == 'asc') {
			$this -> view -> sort -> email -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> email -> href = $this -> view -> sanitized -> actionURI -> value . 'list/email/desc/';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.email', $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.email', $this -> start, $this -> limit, 'ASC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.email', $this -> start, $this -> limit, 'ASC');
			}
		} elseif (isset($_GET['email']) && $_GET['email'] == 'desc') {
			$this -> view -> sort -> email -> cssClass = 'sort-arrow-desc';
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.email', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.email', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, 'oc.email', $this -> start, $this -> limit, 'DESC');
			}
		} else {
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('oc.date_added', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.date_added', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentOrderByColumnWithLimitAndSpecial_article('oc.date_added', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC');
			}
		}

		$this -> pagingObj -> _init($this -> commentObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$category = '';
		$objectList = '';
		$coloredContent = '';
		$tagListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', NULL);
		foreach ($commentListResult as $key => $value) {
			$publishedTime = sscanf($value['options'], "LastPublished=%d");
			if (!is_null($publishedTime)) {
				$publishedTime = $publishedTime[0];
				$publishedDate = date("Y-m-d H:i:s", $publishedTime);
				$diffTime = $this -> calcElapsedTime($publishedTime, strtotime($value['date_added']));
			}
			$objectList .= '<tr>';
			$objectList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="commentId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
			$objectList .= '<td class="jstalgntop">' . $value['webpage'] . '</td>';
			$objectList .= '<td class="jstalgntop">' . (empty($value['email']) ? '---' : $value['email']) . '</td>';
			$objectList .= '<td class="jstalgntop">' . $value['article_title'] . '</td>';

			//$objectList .= '<td class="jstalgntop"><input type="text" class="inptflxFilterShort" name="userId[' . $value ['id'] . ']" id="userId[' . $value ['id'] . ']" value="' . $value ['user_id'] . '" /></td>';

			$objectList .= '<td class="jstalgntop"><textarea id="userId[' . $value['id'] . ']" name="userId[' . $value['id'] . ']" wrap="soft" class="txtareaFilter" width="100px" rows="7">' . $value['user_id'] . ' </textarea></td>';

			$coloredContent = $value['content'];

			foreach ($tagListResult as $key => $blackTag) {
				$coloredContent = str_ireplace($blackTag, '<span style="color:red;">' . $blackTag . '</span>', $coloredContent);
			}

			foreach ($iconsMixed as $symbol => $icon) {
				$coloredContent = str_replace($symbol, $icon, $coloredContent);
			}

			$objectList .= '<td class="jstalgntop"><textarea class="txtareaFilter tinymce" style="width: 100%;" wrap="soft" name="content[' . $value['id'] . ']" id="content[' . $value['id'] . ']">' . $this -> view -> cleanHtml($coloredContent) . '</textarea></td>';
			//$objectList .= '<td class="jstalgntop">' . $coloredContent . '</td>';
			//$objectList .= '<td class="jstalgntop">' . $this->view->__ ( $value ['approved'] ) . '</td>';
			$objectList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
			$objectList .= '<td class="jstalgntop">' . $value['date_added'] . '<br />' . '<b><font color="red">' . $publishedDate . '</font><br /><font color="blue">' . $diffTime . '</font></b>' . '</td>';
			//$objectList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/object-commnet/action/edit/s/1/id/' . $value ['id'] . '" class="modify fl" title="Edit"></a> <a href="javascript:void(0);" class="preview fl" title="Preview"></a></td>';
			$objectList .= '</tr>';
			$publishedTime = $publishedDate = $diffTime = null;
		}

		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listCommentObject.phtml');
		exit();
	}

}
