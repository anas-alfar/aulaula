<?php

class Tag_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $tagObj = NULL;

	protected function _init() {
		$this -> tagObj = new Tag_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0) , 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'tagId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'locale' => array('numericUnsigned', 0), 'titleTag' => array('text', 1), 'published' => array('text', 0, $this -> tagObj -> published), 'approved' => array('text', 0, $this -> tagObj -> approved), 'comment' => array('text', 0, $this -> tagObj -> comments), 'order' => array('numericUnsigned', 0, $this -> tagObj -> order), 'afterId' => array('numeric', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');

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
				$result = $this -> tagObj -> insertIntoTag(Null, $this -> view -> sanitized -> titleTag -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> comment -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/tag/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/tag/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		$this -> view -> render('tag/addTag.phtml');
		exit();

	}

	public function addBlackTagAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$tagListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', NULL, TRUE);
				$tagListResult = $tagListResult->toArray();
				$tagList = '<?xml version="1.0"?>' . PHP_EOL . "\t<tags>";
				foreach ($tagListResult as $key => $value) {
					$tagList .= '<' . $key . '>' . $value . '</' . $key . '>';
				}
				$key = explode('-', $key);
				$key = 'title-' . ++$key[1];
				$tagList .= '<' . $key . '>' . $this -> view -> sanitized -> titleTag -> value . '</' . $key . '>';
				$tagList .= PHP_EOL . "\t</tags>";
				$result = file_put_contents($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', $tagList);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/tag/action/blackList/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/tag/action/addBlack/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
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
		$this -> view -> render('tag/addBlackListTag.phtml');
		exit();
	}

	public function deleteBlackAction() {
		
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$tagDelete = array();
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$tagDelete[$id] = $id;
			}
			$tagListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', NULL , TRUE);
			$tagListResult = $tagListResult->toArray();
			$tagList = '<?xml version="1.0"?>' . PHP_EOL . "\t<tags>";
			foreach ($tagListResult as $key => $value) {
				if (in_array($key, $tagDelete)) {
					continue;
				}
				$tagList .= '<' . $key . '>' . $value . '</' . $key . '>';
			}

			$tagList .= PHP_EOL . "\t</tags>";

			$result = file_put_contents($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', $tagList);
			if ($result !== false) {
				header('Location: /admin/handle/pkg/tag/action/blackList/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/tag/action/blackList/');
		exit();
	}

	public function blackListAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/tag/action/';
		if ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		$tagListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', NULL);
		$tagListResult = $tagListResult->toArray();

		//listing
		$tagList = '';
		foreach ($tagListResult as $key => $value) {
			$tagList .= '<tr>';
			$tagList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="tagId[' . $key . ']" id="check" value="Yes" /></td>';
			$tagList .= '<td class="jstalgntop">' . $value . '</td>';
			$tagList .= '</tr>';
		}
		$this -> view -> tagList = $tagList;
		$this -> view -> render('tag/listBlackListTag.phtml');
		exit();
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
				$result = $this -> tagObj -> updateTagById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> titleTag -> value, $this -> view -> sanitized -> locale -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> sanitized -> order -> value, $this -> view -> sanitized -> comment -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/tag/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/tag/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Invalid Login Credential');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> tagObj -> getTagDetailsById(( int )$_GET['id']);
			$result = $result[0];
			echo $result['locale'];

			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'tagId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $result['author_id']), 'locale' => array('numericUnsigned', 0, $result['locale']), 'titleTag' => array('text', 1, $result['title']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'order' => array('numericUnsigned', 0, $result['order']), 'afterId' => array('numeric', 0, $result['order']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('tag/addTag.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$where = $this -> tagObj -> getAdapter() -> quoteInto('id = ?', $id);
				$tagDelete = $this -> tagObj -> delete($where);
			}
			if (!empty($tagDelete)) {
				header('Location: /admin/handle/pkg/tag/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/tag/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> tagObj -> getAdapter() -> quoteInto('id = ?', $id);
				$tagPublish = $this -> tagObj -> update($data, $where);
			}
			if (!empty($tagPublish)) {
				header('Location: /admin/handle/pkg/tag/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/tag/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> tagId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->tagId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> tagObj -> getAdapter() -> quoteInto('id = ?', $id);
				$tagAprrove = $this -> tagObj -> update($data, $where);
			}
			if (!empty($tagAprrove)) {
				header('Location: /admin/handle/pkg/tag/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/tag/action/list/');
		exit();
	}

	public function listAction() {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/tag/action/';

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
				case 'showInObject' :
					$this -> view -> successMessage = $this -> view -> __('Records successfully Updated');
					break;
			}
		}
		
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}
		
		$this -> view -> sort = (object)NULL;
		foreach ($this->tagObj->cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> tagObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$tagListResult = $this -> tagObj -> getAllTagsOrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$tagListResult = $this -> tagObj -> getAllTagsOrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}
		
		//listing
		if (empty($tagListResult) and false == $tagListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> tagList = $tagListResult;

		$this -> view -> render('tag/listTag.phtml');
		exit();
	}

}
