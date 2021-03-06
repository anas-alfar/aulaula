<?php

class Tag_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $tagObj = NULL;

	protected function _init() {
		echo __LINE__;
		die;
		$this -> tagObj = new Tag_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'tagId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'locale' => array('numericUnsigned', 0), 'titleTag' => array('text', 1), 'published' => array('text', 0, $this -> tagObj -> published), 'approved' => array('text', 0, $this -> tagObj -> approved), 'comment' => array('text', 0, $this -> tagObj -> comments), 'order' => array('numericUnsigned', 0, $this -> tagObj -> order), 'afterId' => array('numeric', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');

		//Fill in types list drop down menu
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> tagObj -> getAllTagOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;

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
			$tagListResult = new Zend_Config_Xml($this -> fc -> settings -> directories -> cache . 'BlackListTags.xml', NULL, TRUE);
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
				$tagDelete = $this -> tagObj -> deleteFromTagById($id);
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
				$tagPublish = $this -> tagObj -> updateTagPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
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
				$tagAprrove = $this -> tagObj -> updateTagApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
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
		}

		//sorting
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$tagListResult = $this -> tagObj -> getAllTagOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$tagListResult = $this -> tagObj -> getAllTagOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$tagListResult = $this -> tagObj -> getAllTagOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$tagListResult = $this -> tagObj -> getAllTagOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$tagListResult = $this -> tagObj -> GetAllTagOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$tagListResult = $this -> tagObj -> GetAllTagOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$tagListResult = $this -> tagObj -> getAllTagOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$tagListResult = $this -> tagObj -> getAllTagOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$tagListResult = $this -> tagObj -> getAllTagOrderByIdWithLimit($this -> start, $this -> limit);
		}

		//listing
		$tagList = '';
		$tagIfnoList = '';
		if (!empty($tagListResult) and false != $tagListResult) {
			foreach ($tagListResult as $key => $value) {
				$tagList .= '<tr>';
				$tagList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="tagId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$tagList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$tagList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$tagList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$tagList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$tagList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/tag/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$tagList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> tagList = $tagList;

		$this -> view -> render('tag/listTag.phtml');
		exit();
	}

}
