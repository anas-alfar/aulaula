<?php

class User_Controller_LevelAdmin extends Aula_Controller_Action {

	private $userObj = NULL;
	private $userInfoObj = NULL;
	private $userLevelObj = NULL;
	private $userLevelPermissionObj = NULL;

	protected function _init() {
		$this -> userLevelObj = new User_Model_Level();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userLevelId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'description' => array('text', 0), 'comment' => array('text', 0), 'option' => array('text', 0), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> userLevelObj -> insertIntoUser_level(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> description -> value, $this -> view -> sanitized -> lockedBy -> value, $this -> view -> sanitized -> lockedTime -> value, $this -> view -> sanitized -> modifiedBy -> value, $this -> view -> sanitized -> modifiedTime -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/user-level/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/user-level/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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
		$this -> view -> render('user/addUserLevel.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			if (empty($this -> errorMessage)) {
				$result = $this -> userLevelObj -> updateUser_levelById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> description -> value, $this -> view -> sanitized -> lockedBy -> value, $this -> view -> sanitized -> lockedTime -> value, $this -> view -> sanitized -> modifiedBy -> value, $this -> view -> sanitized -> modifiedTime -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value);
				if ($result !== false) {
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/user-level/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/user-level/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> userLevelObj -> getUser_levelDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'userLevelId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'description' => array('text', 0, $result['description']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		$this -> view -> render('user/addUserLevel.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> userLevelId -> value)) {
			foreach ($this->view->sanitized->userLevelId->value as $id => $value) {
				$userLevelDelete = $this -> userLevelObj -> deleteFromUser_levelById($id);
			}
			if (!empty($userLevelDelete)) {
				header('Location: /admin/handle/pkg/user-level/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/user-level/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/user-level/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sortin
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> label -> cssClass = 'sort-title';
		$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
		$this -> view -> sort -> description -> cssClass = 'sort-title';
		$this -> view -> sort -> description -> href = $this -> view -> sanitized -> actionURI -> value . 'list/description/asc';
		$this -> view -> sort -> blocked -> cssClass = 'sort-title';
		$this -> view -> sort -> blocked -> href = $this -> view -> sanitized -> actionURI -> value . 'list/blocked/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> confirmed -> cssClass = 'sort-title';
		$this -> view -> sort -> confirmed -> href = $this -> view -> sanitized -> actionURI -> value . 'list/confirmed/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'asc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/desc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByLabelWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['label']) && $_GET['label'] == 'desc') {
			$this -> view -> sort -> label -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> label -> href = $this -> view -> sanitized -> actionURI -> value . 'list/label/asc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByLabelWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['description']) && $_GET['description'] == 'asc') {
			$this -> view -> sort -> description -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> description -> href = $this -> view -> sanitized -> actionURI -> value . 'list/description/desc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByDescriptionWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['description']) && $_GET['description'] == 'desc') {
			$this -> view -> sort -> description -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> description -> href = $this -> view -> sanitized -> actionURI -> value . 'list/description/asc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByDescriptionWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$userLevelListResult = $this -> userLevelObj -> GetAllUser_levelOrderByIdWithLimit($this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> userLevelObj -> _totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$userLevelList = '';
		if (!empty($userLevelListResult) and false != $userLevelListResult) {
			foreach ($userLevelListResult as $key => $value) {
				$userLevelList .= '<tr>';
				$userLevelList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="userLevelId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$userLevelList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$userLevelList .= '<td class="jstalgntop">' . $value['label'] . '</td>';
				$userLevelList .= '<td class="jstalgntop">' . $value['description'] . '</td>';
				$userLevelList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$userLevelList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/user-level/action/edit/s/1/id/' . $value['id'] . '"
			class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$userLevelList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> userLevelList = $userLevelList;

		$this -> view -> render('user/listUserLevel.phtml');
		exit();
	}

}
