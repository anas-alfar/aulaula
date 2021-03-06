<?php

/**
 *
 * Aulaula
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the file LICENSE.txt. It is also available through
 * the world-wide-web at this URL: http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@aulaula.com
 * so we can send you a copy immediately.
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Aulaula to newer versions
 * in the future. If you wish to customize Aulaula for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Banner
 * @subpackage Controller
 * @name Banner_Controller_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Banner_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $bannerObj = Null;
	private $areaObj = Null;
	private $uploadObj = Null;

	protected function _init() {
		$this -> bannerObj = new Banner_Model_Default();
		$this -> areaObj = new Banner_Model_Area();

		//Upload Object
		$this -> uploadObj = new Aula_Model_Upload('uploadFile');

		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'uploadFile' => array('fileUploaded', 0, (!empty($_FILES['uploadFile']['name']) ? $_FILES['uploadFile']['name'] : '')), 'link' => array('url', 0), 'status' => array('text', 0), 'bannerId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'area' => array('numeric', 1), 'object' => array('text', 0), 'published' => array('text', 0, $this -> bannerObj -> published), 'approved' => array('text', 0, $this -> bannerObj -> approved), 'comment' => array('text', 0, $this -> bannerObj -> comments), 'option' => array('text', 0, $this -> bannerObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $this -> bannerObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> bannerObj -> publishTo), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function viewAction() {
		if (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> bannerObj -> getBannerById($_GET['id']);
			$this -> view -> result = $result;
			$this -> view -> render('banner/viewBanner.phtml');
			exit();
		}
	}

	public function addAction() {
		$form = new Banner_Form_DefaultAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$_POST['optional']['options'] = json_encode($_POST['optional']['options']);
			$_POST['mandatory']['author_id'] = $this -> userId;

			$this -> bannerObj -> insert(array_merge($_POST['mandatory'], $_POST['optional']));
			/**
			 * TODO
			 * Upload here
			 */

			header('Location: /admin/handle/pkg/banner/action/list');
		}
		$this -> view -> form = $form;
		$this -> view -> render('banner/addBanner.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 if (empty($this -> errorMessage)) {
		 if ($this -> uploadObj -> CheckIfThereIsFile() === TRUE) {
		 if ($this -> uploadObj -> validatedSize()) {
		 $this -> view -> sanitized -> size -> value = $this -> uploadObj -> size;
		 $this -> view -> sanitized -> extension -> value = $this -> uploadObj -> extension;
		 $this -> view -> sanitized -> mime -> value = $this -> uploadObj -> mime;
		 $result = $this -> bannerObj -> insertIntoBanner(Null, $this -> view -> sanitized -> area -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> type -> value, $this -> view -> sanitized -> mime -> value, $this -> view -> sanitized -> size -> value, $this -> view -> sanitized -> extension -> value, $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> link -> value, $GLOBALS['AULA_BLACKLIST']['object'], $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];
		 switch ($this->view->sanitized->mime->value) {
		 case 'image/gif' :
		 case 'image/jpg' :
		 case 'image/jpeg' :
		 case 'swf/jpeg' :
		 case 'application/x-shockwave-flash' :
		 $this -> uploadObj -> newFileName . PHP_EOL . $this -> uploadObj -> newFileName = parent::$encryptedDisk['banner'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
		 $newFileUrl = parent::$encryptedUrl['banner'][$this -> fc -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $this -> view -> sanitized -> Id -> value) . $this -> uploadObj -> extension;
		 $fileUploaded = $this -> uploadObj -> uploadFile($this -> uploadObj -> newFileName);
		 if (true === $fileUploaded) {
		 $this -> bannerObj -> updateBannerSizeColumnById($this -> view -> sanitized -> Id -> value, $this -> uploadObj -> size);
		 $this -> bannerObj -> updateBannerFull_pathColumnById($this -> view -> sanitized -> Id -> value, $newFileUrl);
		 }
		 break;
		 default :
		 break;
		 }
		 }
		 } else {
		 $result = $this -> bannerObj -> insertIntoBanner(Null, $this -> view -> sanitized -> area -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> type -> value, '', '', '', $this -> view -> sanitized -> fullPath -> value, $this -> view -> sanitized -> link -> value, $this -> view -> sanitized -> object -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
		 $this -> view -> sanitized -> Id -> value = $result[0];
		 }

		 if ($result !== false) {
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
		 header('Location: /admin/handle/pkg/banner/action/list/s/1');
		 exit();
		 }
		 header('Location: /admin/handle/pkg/banner/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
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

		 $this -> view -> render('banner/addBanner.phtml');
		 exit();*/
	}

	public function editAction() {
		$form = new Banner_Form_DefaultAdmin($this -> view);
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST) and is_numeric($_POST['mandatory']['id'])) {

			$dataBanner = array_merge($_POST['mandatory'], $_POST['optional']);

			$dataBanner['options'] = json_encode($dataBanner['options']);
			$dataBanner['modified_by'] = $this -> userId;
			$dataBanner['modified_time'] = new Zend_db_Expr("Now()");

			$this -> bannerObj -> update($dataBanner, '`id` = ' . $dataBanner['id']);

			/**
			 * TODO
			 * Upload here
			 */

			header('Location: /admin/handle/pkg/banner/action/list');
			exit();

		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {

				$bannerObjResult = $this -> bannerObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				if ($bannerObjResult !== false) {

					$publish_from = explode(' ', $bannerObjResult['publish_from']);
					$publish_to = explode(' ', $bannerObjResult['publish_to']);
					$bannerObjResult['publish_from'] = $publish_from[0];
					$bannerObjResult['publish_to'] = $publish_to[0];
					$bannerObjResult['options'] = json_decode($bannerObjResult['options']);

					$form -> populate($bannerObjResult);
				} else {
					header('Location: /admin/handle/pkg/banner/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('banner/updateBanner.phtml');
		exit();

		/*if ($this -> isPagePostBack) {
		 $this -> filterObj -> trimData($this -> view -> sanitized);
		 $this -> filterObj -> sanitizeData($this -> view -> sanitized);
		 $this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 if (empty($this -> errorMessage)) {
		 $result = $this -> bannerObj -> updateBannerById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> area -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> type -> value, $this -> view -> sanitized -> link -> value, $this -> view -> sanitized -> object -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> userId, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
		 if ($result !== false) {
		 $this -> view -> sanitized -> general -> successMessage = $this -> view -> __('Record successfully added');
		 $this -> view -> sanitized -> general -> successMessageStyle = 'display: block;';
		 if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
		 header('Location: /admin/handle/pkg/banner/action/list/s/1');
		 exit();
		 }
		 header('Location: /admin/handle/pkg/banner/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
		 exit();
		 } else {
		 $this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
		 }
		 }
		 } elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
		 $result = $this -> bannerObj -> getBannerDetailsById(( int )$_GET['id']);
		 $result = $result[0];
		 $result['publish_from'] = substr($result['publish_from'], 0, 10);
		 $result['publish_to'] = substr($result['publish_to'], 0, 10);
		 $this -> fields = array('redirectURI' => array('uri', 0, ''), 'link' => array('url', 0, $result['link']), 'status' => array('text', 0), 'bannerId' => array('numeric', 0), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'area' => array('numeric', 1, $result['area_id']), 'type' => array('text', 1, $result['type']), 'object' => array('text', 1, $result['object']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'btn_submit' => array('', 0, 2));
		 $this -> view -> sanitized = array();
		 $this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
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

		 $this -> view -> render('banner/addBanner.phtml');
		 exit();
		 }

		 public function deleteAction() {
		 $this -> view -> arrayToObject($this -> view -> sanitized);
		 if (!empty($this -> view -> sanitized -> bannerId -> value)) {
		 foreach ($this->view->sanitized->bannerId->value as $id => $value) {
		 $where = $this -> bannerObj -> getAdapter() -> quoteInto('id = ?', $id);
		 $bannerDelete = $this -> bannerObj -> delete($where);
		 }
		 if (!empty($bannerDelete)) {
		 header('Location: /admin/handle/pkg/banner/action/list/success/delete');
		 exit();
		 }
		 }

		 header('Location: /admin/handle/pkg/banner/action/list/');
		 exit();*/
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> bannerObj -> getAdapter() -> quoteInto('id = ?', $id);
				$bannerAprrove = $this -> bannerObj -> update($data, $where);
			}
			if (!empty($bannerAprrove)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> bannerId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->bannerId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> bannerObj -> getAdapter() -> quoteInto('id = ?', $id);
				$bannerPublish = $this -> bannerObj -> update($data, $where);
			}
			if (!empty($bannerPublish)) {
				header('Location: /admin/handle/pkg/banner/action/list/success/publish');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/banner/action/list/');
		exit();
	}

	public function orderAction() {
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/banner/action/';

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

		//generate default sorting links
		$this -> view -> sort = (object)NULL;
		$cols = $this -> bannerObj -> cols;

		foreach ($cols as $col) {
			/**
			 * adding the following two lines to prvent E_STRICT error
			 */
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$bannerListResult = $this -> bannerObj -> select() -> from ('banner',new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->  where ('id > ?', 1)*/ -> order("$column $sort") -> limit("$this->start, $this->limit") -> query() -> fetchAll();
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$bannerListResult = $this -> bannerObj -> select() -> from ('banner',new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->  where ('id > ?', 1)*/ -> order("id DESC") -> limit("$this->start, $this->limit") -> query() -> fetchAll();
		}

		$this -> pagingObj -> _init($this -> bannerObj -> getAdapter()-> fetchOne('SELECT FOUND_ROWS()'));
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($bannerListResult) and false != $bannerListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}
		$this -> view -> bannerList = $bannerListResult;
		$this -> view -> render('banner/listBanner.phtml');
		exit();
	}

}
