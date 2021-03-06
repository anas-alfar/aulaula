<?php

class Object_Controller_DirectoryAdmin extends Aula_Controller_Action {

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

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> directoryObj = new Object_Model_Directory();

		//theme objects
		$this -> templateObj = new Theme_Model_Template();
		$this -> layoutObj = new Theme_Model_Layout();
		$this -> skinObj = new Theme_Model_Skin();

		//locale and category objects
		$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'directoryId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameDirectory' => array('codeConvention', 1), 'labelDirectory' => array('text', 1), 'descriptionDirectory' => array('text', 0), 'parent' => array('numeric', 0), 'category' => array('numeric', 1), 'size' => array('numeric', 0, $this -> directoryObj -> size), 'filesCount' => array('numeric', 0, $this -> directoryObj -> filesCount), 'showInObject' => array('text', 0, $this -> directoryObj -> showInObject), 'fullPath' => array('filePath', 0, $this -> directoryObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $this -> directoryObj -> objectId), 'published' => array('text', 0, $this -> directoryObj -> published), 'approved' => array('text', 0, $this -> directoryObj -> approved), 'comment' => array('text', 0, $this -> directoryObj -> comments), 'option' => array('text', 0, $this -> directoryObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> directoryObj -> getDirectoryById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('object/viewDirectory.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Object_Form_Directory($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$lastInsertId = $this -> objectObj -> insert($objectData);

			if ($lastInsertId !== false) {
				$objecdInfoData = array('object_id' => $lastInsertId, 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
				$lastInsertIdInfo = $this -> objectInfoObj -> insert($objecdInfoData);
				if ($lastInsertIdInfo !== false) {
					$objectDirectoryData = array('name' => $_POST['mandatory']['name'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'parent_id' => $_POST['mandatory']['directory_parent_id'], 'size' => $_POST['mandatory']['size'], 'files_count' => $_POST['mandatory']['files_count'], 'full_path' => $_POST['mandatory']['full_path'], 'author_id' => $this -> userId, 'show_in_object' => $_POST['optional']['show_in_object'], 'object_id' => $lastInsertId, );
					$lastInsertIdDirectory = $this -> directoryObj -> insert($objectDirectoryData);

					header('Location: /admin/handle/pkg/object-directory/action/list/');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/addDirectory.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 if (empty($this -> errorMessage)) {
		 $result = $this -> directoryObj -> insertIntoObject_directory(Null, $this -> view -> sanitized -> nameDirectory -> value, $this -> view -> sanitized -> labelDirectory -> value, $this -> view -> sanitized -> descriptionDirectory -> value, $this -> view -> sanitized -> parent -> value, $this -> userId, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> filesCount -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];

		 if ($result !== false) {
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
		 header('Location: /admin/handle/pkg/object-directory/action/list/s/1');
		 exit();
		 } else {
		 if (isset($_GET['s']) and $_GET['s'] == -1) {
		 header('Location: /admin/handle/pkg/object-directory/action/edit/s/-1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 }
		 header('Location: /admin/handle/pkg/object-directory/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 }
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

		 $this -> view -> render('object/addDirectoryObject.phtml');
		 exit();*/
	}

	public function editAction() {
		$form = new Object_Form_Directory($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$objectDirectoryId = (int)$_POST['mandatory']['id'];
			$directoryObjResult = $this -> directoryObj -> select() -> where('`id` = ?', $objectDirectoryId) -> query() -> fetch();

			$objectData = array('title' => $_POST['mandatory']['title'], 'created_date' => $_POST['optional']['created_date'], 'author_id' => $this -> userId, 'object_source_id' => $_POST['optional']['object_source_id'], 'tags' => $_POST['optional']['tags'], 'page_title' => $_POST['meta']['page_title'], 'meta_title' => $_POST['meta']['meta_title'], 'meta_key' => $_POST['meta']['meta_key'], 'meta_desc' => $_POST['meta']['meta_desc'], 'meta_data' => $_POST['meta']['meta_data'], 'object_type_id' => $_POST['optional']['object_type_id'], 'category_id' => $_POST['optional']['category_id'], 'locale_id' => $this -> fc -> settings -> locale -> available -> lang -> _1 -> default, 'guid_url' => $_POST['optional']['guid_url'], 'original_author' => $_POST['optional']['original_author'], 'parent_id' => $_POST['optional']['parent_id'], 'show_in_list' => $_POST['optional']['show_in_list'], 'published' => $_POST['mandatory']['published'], 'approved' => $_POST['mandatory']['approved']);
			$this -> objectObj -> update($objectData, '`id` = ' . $directoryObjResult['object_id']);

			$objecdInfoData = array('object_id' => $directoryObjResult['object_id'], 'options' => json_encode($_POST['optional']['options']), 'comments' => $_POST['optional']['comments'], );
			$this -> objectInfoObj -> update($objecdInfoData, '`object_id` = ' . $directoryObjResult['object_id']);

			$objectDirectoryData = array('modified_by' => $this -> userId, 'modified_time' => new Zend_db_Expr("Now()"), 'name' => $_POST['mandatory']['name'], 'label' => $_POST['mandatory']['label'], 'description' => $_POST['mandatory']['description'], 'parent_id' => $_POST['mandatory']['directory_parent_id'], 'author_id' => $this -> userId, 'object_id' => $directoryObjResult['object_id'], 'size' => $_POST['mandatory']['size'], 'files_count' => $_POST['mandatory']['files_count'], 'show_in_object' => $_POST['optional']['show_in_object'], 'full_path' => $_POST['mandatory']['full_path'], );
			$this -> directoryObj -> update($objectDirectoryData, '`id` = ' . $objectDirectoryId);

			header('Location: /admin/handle/pkg/object-directory/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$directoryObjResult = $this -> directoryObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$objResult = $this -> objectObj -> select() -> where('`id` = ?', $directoryObjResult['object_id']) -> query() -> fetch();
				$objInfoObjResult = $this -> objectInfoObj -> select() -> where('`object_id` = ?', $directoryObjResult['object_id']) -> query() -> fetch();

				if ($directoryObjResult !== false And $objResult !== false And $objInfoObjResult !== false) {
					$directoryObjResult['directory_parent_id'] = $directoryObjResult['parent_id'];
					unset($objResult['id']);
					unset($directoryObjResult['published']);
					unset($directoryObjResult['approved']);
					unset($directoryObjResult['comments']);
					unset($directoryObjResult['options']);
					unset($directoryObjResult['category_id']);
					unset($directoryObjResult['created_date']);
					unset($directoryObjResult['parent_id']);
					unset($objInfoObjResult['id']);

					$created_date = explode(' ', $objResult['created_date']);
					$objResult['created_date'] = $created_date[0];
					$objInfoObjResult['options'] = json_decode($objInfoObjResult['options']);

					$form -> populate($objResult);
					$form -> populate($directoryObjResult);
					$form -> populate($objInfoObjResult);
				} else {
					header('Location: /admin/handle/pkg/object-directory/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('object/updateDirectory.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 if (empty($this -> errorMessage)) {
		 $result = $this -> directoryObj -> updateObject_directoryById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> nameDirectory -> value, $this -> view -> sanitized -> labelDirectory -> value, $this -> view -> sanitized -> descriptionDirectory -> value, $this -> view -> sanitized -> parent -> value, $this -> userId, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> filesCount -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> objectId -> value, $this -> view -> sanitized -> category -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> showInObject -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value);
		 if ($result !== false) {
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
		 header('Location: /admin/handle/pkg/object-directory/action/list/s/1');
		 exit();
		 }
		 header('Location: /admin/handle/pkg/object-directory/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 } else {
		 $this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
		 }
		 }
		 } elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
		 $result = $this -> directoryObj -> getObject_directoryDetailsById(( int )$_GET['id']);
		 $result = $result[0];
		 $this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'directoryId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'author' => array('numericUnsigned', $result['author_id']), 'nameDirectory' => array('codeConvention', 1, $result['name']), 'labelDirectory' => array('text', 1, $result['label']), 'descriptionDirectory' => array('text', 0, $result['description']), 'parent' => array('numeric', 1, $result['parent_id']), 'category' => array('numeric', 1, $result['category_id']), 'size' => array('numeric', 0, $this -> directoryObj -> size), 'filesCount' => array('numeric', 0, $this -> directoryObj -> filesCount), 'showInObject' => array('text', 0, $result['show_in_object']), 'fullPath' => array('filePath', 0, $this -> directoryObj -> fullPath), 'objectId' => array('numericUnsigned', 0, $result['object_id']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
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

		 $this -> view -> render('object/addDirectoryObject.phtml');
		 exit();*/
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$where = $this -> directoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$directoryDelete = $this -> directoryObj -> delete($where);
			}
			if (!empty($directoryDelete)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/delete');
				if (!empty($this -> view -> sanitized -> redirectURI -> value)) {
					header('Location: ' . $this -> view -> sanitized -> redirectURI -> value);
				}
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function showInObjectAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$data = array('show_in_object' => $this -> view -> sanitized -> status -> value);
				$where = $this -> directoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$directoryShowInObject = $this -> directoryObj -> update($data, $where);
			}
			if (!empty($directoryShowInObject)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/showInObject');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> directoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$directoryPublish = $this -> directoryObj -> update($data, $where);
			}
			if (!empty($directoryPublish)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> directoryId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->directoryId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> directoryObj -> getAdapter() -> quoteInto('id = ?', $id);
				$directoryAprrove = $this -> directoryObj -> update($data, $where);
			}
			if (!empty($directoryAprrove)) {
				header('Location: /admin/handle/pkg/object-directory/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/object-directory/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/object-directory/action/';

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
		$this -> view -> sort = (object)NULL;

		foreach ($this -> directoryObj -> cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> directoryObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}

			$this -> directoryObj -> _orderBy = "$column $sort";
			$this -> directoryObj -> _limit = "{$this -> start}, {$this -> limit}";
			$directoryListResult = $this -> directoryObj -> read();
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$this -> directoryObj -> _orderBy = "id DESC";
			$this -> directoryObj -> _limit = "{$this -> start}, {$this -> limit}";
			$directoryListResult = $this -> directoryObj -> read();
		}

		$this -> pagingObj -> _init($this -> directoryObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);
		//listing
		$categoryListResult = $this -> categoryObj -> read();
		$countOfOCategoryListResult = count($categoryListResult);
		$category = '';
		for ($i = 0; $i < $countOfOCategoryListResult; $i++) {
			$category[$categoryListResult[$i]['id']] = $categoryListResult[$i]['label'];
		}

		if (empty($directoryListResult) and false == $directoryListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> category = $category;
		$this -> view -> objectList = $directoryListResult;
		$this -> view -> render('object/listDirectoryObject.phtml');
		exit();
	}

}
