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
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'object' => array('numericUnsigned', 0), 'dateAddedFromSearch' => array('text', 0), 'dateAddedToSearch' => array('text', 0), 'publishedSearch' => array('text', 0), 'approvedSearch' => array('text', 0), 'articleTitleSearch' => array('text', 0), 'userIdSearch' => array('text', 0), 'contentSearch' => array('text', 0), 'btn_search' => array('text', 0), 'webpage' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'emailSearch' => array('text', 0), 'status' => array('text', 0), 'title' => array('text', 0), 'content' => array('text', 0), 'commentId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'userId' => array('text', 0), 'author' => array('numericUnsigned', 0, $this -> userId), 'titleComment' => array('text', 0), 'emailComment' => array('email', 0), 'email' => array('email', 0), 'webpageComment' => array('ipAddress', 0, $_SERVER['REMOTE_ADDR']), 'contentComment' => array('', 1), 'approved' => array('text', 0, $this -> commentObj -> approved), 'published' => array('text', 0, $this -> commentObj -> approved), 'comment' => array('text', 0, $this -> commentObj -> comments), 'option' => array('text', 0, $this -> commentObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'afterId' => array('numeric', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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
				$commentResult = $this -> commentObj -> read ('id = ? ' , array($id));
				$commentResult = $commentResult[0];
				if (0 === strcmp('Yes', $commentResult['approved'])) {
					$data = array('total_comments' => -1);
					$where = $this -> objectInfoObj -> getAdapter() -> quoteInto('object_id = ?', $id);
					$commentCounter = $this -> objectInfoObj -> update($data, $where);
				}

				$where = $this -> commentObj -> getAdapter() -> quoteInto('id = ?', $id);
				$commentDelete = $this -> commentObj -> delete($where);
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
				$commentResult = $this -> commentObj -> read ('id = ? ' , array($id));
				$commentResult = $commentResult[0];
				$publishedDate = sscanf($commentResult['options'], "LastPublished=%d");

				if (is_null($publishedDate)) {
					$commentResult['options'] .= "LastPublished=" . time() . PHP_EOL;
				} else {
					$commentResult['options'] = str_replace($publishedDate[0], time(), $commentResult['options']);
				}
				$data = array('published' => $this -> view -> sanitized -> status -> value , 'user_id' => $this -> view -> sanitized -> userId -> value[$id],'content' => $this -> view -> sanitized -> content -> value[$id] , 'options' => $commentResult['options']);
				$where = $this -> commentObj -> getAdapter() -> quoteInto('id = ?', $id);
				$commentPublish = $this -> commentObj -> update($data, $where);
				
				if (0 !== strcmp($this -> view -> sanitized -> status -> value, $commentResult['approved'])) {
					$count = $this -> view -> sanitized -> status -> value == 'Yes' ? 1 : -1;
					$data = array('total_comments' => $count);
					$where = $this -> objectInfoObj -> getAdapter() -> quoteInto('object_id = ?', $id);
					$commentCounter = $this -> objectInfoObj -> update($data, $where);
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
				$data = array('approved' => $this -> view -> sanitized -> status -> value , 'user_id' => $this -> view -> sanitized -> userId -> value[$id],'content' => $this -> view -> sanitized -> content -> value[$id] , 'options' => $commentResult['options']);
				$where = $this -> commentObj -> getAdapter() -> quoteInto('id = ?', $id);
				$commentPublish = $this -> commentObj -> update($data, $where);
				if (0 !== strcmp($this -> view -> sanitized -> status -> value, $commentResult['approved'])) {
					$count = $this -> view -> sanitized -> status -> value == 'Yes' ? 1 : -1;
					$count = $this -> view -> sanitized -> status -> value == 'Yes' ? 1 : -1;
					$data = array('total_comments' => $count);
					$where = $this -> objectInfoObj -> getAdapter() -> quoteInto('object_id = ?', $id);
					$commentCounter = $this -> objectInfoObj -> update($data, $where);
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

		if (!empty($_GET['success'])) {
			$this -> view -> successMessageStyle = 'display: block;';
			switch ($_GET['success']) {
				case 'approve' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
					break;
				case 'publish' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
					break;
				case 'delete' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
					break;
			}
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
		$webpageSearch = '';
		if (isset($_GET['filter']) && $_GET['filter'] == 1) {
			$filterURI = '';
			if (!isset($_GET['webpageSearch']) || empty($_GET['webpageSearch'])) {
				$_GET['webpageSearch'] = NULL;
			} else {
				$isFilter = true;
				$filterURI .= 'webpageSearch/' . $_GET['webpageSearch'] . '/';
				$webpageSearch = $_GET['webpageSearch'];
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

		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		foreach ($this->commentObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> commentObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article($column, $isSpecialArticleSelected, $this -> start, $this -> limit, 'ASC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, $column, $this -> start, $this -> limit, 'ASC');
			} else {

				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article('NULL) or (1=1', $isSpecialArticleSelected, $column, $this -> start, $this -> limit, 'ASC');
			}
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			if ($isFilter) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article('date_added', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC', $_GET['webpageSearch'], $_GET['emailSearch'], $_GET['articleTitleSearch'], $_GET['userIdSearch'], $_GET['contentSearch'], $_GET['publishedSearch'], $_GET['approvedSearch'], $_GET['dateAddedFromSearch'], $_GET['dateAddedToSearch'], $categoryList);
			} else if ($isCategorySelected) {
				$commentListResult = $this -> commentObj -> GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryList, $isSpecialArticleSelected, 'oc.date_added', $this -> start, $this -> limit, 'DESC');
			} else {
				$commentListResult = $this -> commentObj -> GetAllObject_commentOrderByColumnWithLimitAndSpecial_article('date_added', $isSpecialArticleSelected, $this -> start, $this -> limit, 'DESC');
			}
		}
		$this -> pagingObj -> _init($this -> commentObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$category = '';
		$objectList = '';
		$coloredContent = '';
		$diffTime = NULL;
		$publishedDate = NULL;
		//$tagListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', NULL);
		if (!empty($commentListResult) and false != $commentListResult) {
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

				// foreach ($tagListResult as $key => $blackTag) {
				// $coloredContent = str_ireplace($blackTag, '<span style="color:red;">' . $blackTag . '</span>', $coloredContent);
				// }

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
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> webpageSearch = $webpageSearch;
		$this -> view -> objectList = $objectList;
		$this -> view -> render('object/listCommentObject.phtml');
		exit();
	}

}
