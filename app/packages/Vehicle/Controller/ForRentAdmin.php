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
 * @package Vehicle
 * @subpackage Controller
 * @name Vehicle_Controller_ForRentAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Controller_ForRentAdmin extends Aula_Controller_Action {

	private $forRentObj = NULL;
	private $typeObj = NULL;
	private $yearObj = NULL;
	private $makeObj = NULL;
	private $modelObj = NULL;
	private $vehicleLookupObj = NULL;
	private $vehiclePhotoObj = NULL;
	private $vehicleVideoObj = NULL;
	CONST NUMBER_OF_PHOTOS = 10;

	protected function _init() {
		$this -> vehicleLookupObj = new Lookup_Vehicle($this -> view);

		//default objects
		$this -> forRentObj = new Vehicle_Model_ForRent();
		$this -> typeObj = new Vehicle_Model_Type();
		$this -> yearObj = new Vehicle_Model_Year();
		$this -> modelObj = new Vehicle_Model_Model();
		$this -> makeObj = new Vehicle_Model_Make();
		$this -> vehiclePhotoObj = new Vehicle_Model_Photo();
		$this -> vehicleVideoObj = new Vehicle_Model_Video();

		$this -> defualtAdminAction = 'list';

		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'forRentId' => array('numeric', 0), 'id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'description' => array('text', 1), 'comment' => array('text', 0, $this -> forRentObj -> comments), 'option' => array('text', 0, $this -> forRentObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		if (isset($GLOBALS['AULA_BLACKLIST']['introTextStatic'])) {
			$this -> view -> sanitized['introTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['introTextStatic'];
		}
		if (isset($GLOBALS['AULA_BLACKLIST']['fullTextStatic'])) {
			$this -> view -> sanitized['fullTextStatic']['value'] = $GLOBALS['AULA_BLACKLIST']['fullTextStatic'];
		}
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> view -> importExcelLink = '/admin/handle/pkg/vehicle-type/action/importcsv/';
		$this -> view -> exportExcelLink = '/admin/handle/pkg/vehicle-type/action/exportcsv/';
	}

	public function addAction() {
		$form = new Vehicle_Form_ForRent($this -> view);
		$form -> setLocale($this -> fc -> settings);
		$form -> setLookup($this -> vehicleLookupObj -> vehicleComboBox);
		$form -> renderForm();
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$vehiclForRentData = array_merge($_POST['system'], $_POST['contact'], $_POST['general'], $_POST['specification']);
			$vehiclForRentData['created_by'] = $this -> userId;
			$vehiclForRentData['locale_id'] = $this -> fc -> settings -> locale -> default -> current -> id;
			$vehiclForRentData['options'] = json_encode($vehiclForRentData['options']);
			$forRentObjLastInsertId = $this -> forRentObj -> insert($vehiclForRentData);

			if ($forRentObjLastInsertId !== false) {

				$_POST['video']['vehicle_id'] = $forRentObjLastInsertId;
				$videoUploadedSuccessfully = $this -> importVideo($_POST['video'], true);

				if ($videoUploadedSuccessfully === true) {

					for ($value = 1; $value <= self::NUMBER_OF_PHOTOS; ++$value) {
						$_POST['photo_' . $value]['vehicle_id'] = $forRentObjLastInsertId;
						$_POST['photo_' . $value]['type'] = 'Rent';
						$photoUploadedSuccessfully = $this -> importPhoto($_POST['photo_' . $value], 'photo_' . $value, true);
					}
				}
			}

			/* TODO
			 * check contact information from contact DB if new insert else update
			 */

			header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/');
			exit();
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/addForRent.phtml');
		exit();
	}

	public function importPhoto($objectPhotoData, $photoName, $insertPhoto) {
		$uploadPhotoObj = new Aula_Model_Upload_Photo($photoName);

		if ($insertPhoto === false) {
			$photoId = (int) $objectPhotoData['photo_id'];
			//$vehiclePhotoObjResult = $this -> vehiclePhotoObj -> select() -> where('`id` = ?', $photoId) -> query() -> fetch();
			//if ($vehiclePhotoObjResult['order'] != $objectPhotoData['order']) {
			//	$stmt = $this -> vehiclePhotoObj -> getAdapter() -> prepare('UPDATE vehicle_photo SET `order`=`order`+1 WHERE `order` >= ?');
			//	$stmt -> execute(array($objectPhotoData['order']));
			//}
			unset($objectPhotoData['photo_id']);
			$objectPhotoData['modified_by'] = $this -> userId;
			$objectPhotoData['modified_time'] = new Zend_db_Expr("Now()");
			$this -> vehiclePhotoObj -> update($objectPhotoData, '`id` = ' . $photoId);
			$lastInsertIdPhoto = $photoId;
		}

		if ($uploadPhotoObj -> CheckIfThereIsFile() === TRUE) {
			if ($uploadPhotoObj -> validatedMime()) {
				if ($uploadPhotoObj -> validatedSize()) {
					if ($insertPhoto === true) {
						//$stmt = $this -> vehiclePhotoObj -> getAdapter() -> prepare('UPDATE vehicle_photo SET `order`=`order`+1 WHERE `order` >= ?');
						//$stmt -> execute(array($objectPhotoData['order']));

						if (empty($objectPhotoData['taken_date'])) {
							$objectPhotoData['taken_date'] = $uploadPhotoObj -> takenTime;
						}
						$objectPhotoData['author_id'] = $this -> userId;
						$objectPhotoData['size'] = $uploadPhotoObj -> size;
						$objectPhotoData['width'] = $uploadPhotoObj -> width;
						$objectPhotoData['height'] = $uploadPhotoObj -> height;
						$objectPhotoData['extension'] = $uploadPhotoObj -> extension;

						$lastInsertIdPhoto = $this -> vehiclePhotoObj -> insert($objectPhotoData);
					}

					if ($lastInsertIdPhoto !== false) {

						$uploadPhotoObj -> newFileName = parent::$encryptedDisk['photo']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdPhoto) . '.jpg';
						$fileUploaded = $uploadPhotoObj -> uploadFile($uploadPhotoObj -> newFileName);

						$thumbUploaded = $uploadPhotoObj -> resizeUploadImage(76, 52, parent::$encryptedDisk['photo']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
						$thumbLargeUploaded = $uploadPhotoObj -> resizeUploadImage(184, 125, parent::$encryptedDisk['photo']['thumb-large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
						$mediumUploaded = $uploadPhotoObj -> resizeUploadImage(470, 320, parent::$encryptedDisk['photo']['medium'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
						$largeMiniUploaded = $uploadPhotoObj -> resizeUploadImage(600, 408, parent::$encryptedDisk['photo']['large-mini'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');
						$largeUploaded = $uploadPhotoObj -> resizeUploadImage(800, 545, parent::$encryptedDisk['photo']['large'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate], $this -> fc -> settings -> directories -> cache . 'watermark.png');

						return true;
					}
				}
			}
		}
	}

	public function importVideo($objectVideoData, $insertVideo) {
		$uploadPhotoObj = new Aula_Model_Upload_Photo('videoThumb');
		$uploadVideoObj = new Aula_Model_Upload_Video('video');

		if ($insertVideo === false) {
			$videoId = (int)$objectVideoData['video_id'];
			$vehicleVideoObjResult = $this -> vehicleVideoObj -> select() -> where('`id` = ?', $videoId) -> query() -> fetch();
			if ($vehicleVideoObjResult['order'] != $objectVideoData['order']) {
				$stmt = $this -> vehicleVideoObj -> getAdapter() -> prepare('UPDATE vehicle_video SET `order`=`order`+1 WHERE `order` >= ?');
				$stmt -> execute(array($objectVideoData['order']));
			}
			unset($objectVideoData['video_id']);
			$objectVideoData['modified_by'] = $this -> userId;
			$objectVideoData['modified_time'] = new Zend_db_Expr("Now()");
			$this -> vehicleVideoObj -> update($objectVideoData, '`id` = ' . $videoId);
			$lastInsertIdVideo = $videoId;
		}

		if ($uploadVideoObj -> CheckIfThereIsFile() === TRUE && $uploadPhotoObj -> CheckIfThereIsFile() === TRUE) {
			if ($uploadVideoObj -> validatedMime() && $uploadPhotoObj -> validatedMime()) {
				if ($uploadVideoObj -> validatedSize() && $uploadPhotoObj -> validatedSize()) {
					if ($insertVideo === true) {
						$stmt = $this -> vehicleVideoObj -> getAdapter() -> prepare('UPDATE vehicle_video SET `order`=`order`+1 WHERE `order` >= ?');
						$stmt -> execute(array($objectVideoData['order']));

						$objectVideoData['author_id'] = $this -> userId;
						$objectVideoData['size'] = 'NULL';
						$objectVideoData['width'] = 'NULL';
						$objectVideoData['height'] = 'NULL';
						$lastInsertIdVideo = $this -> vehicleVideoObj -> insert($objectVideoData);
					}

					if (is_numeric($lastInsertIdVideo)) {
						$videoData = array('size' => $uploadVideoObj -> size, 'width' => $uploadVideoObj -> width, 'height' => $uploadVideoObj -> height, 'extension' => $uploadVideoObj -> extension, );
						$this -> vehicleVideoObj -> update($videoData, '`id` = ' . $lastInsertIdVideo);

						$uploadVideoObj -> newFileName = parent::$encryptedDisk['video']['flv'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdVideo) . '.flv';
						$uploadVideoObj -> uploadFile($uploadVideoObj -> newFileName);

						$uploadPhotoObj -> newFileName = parent::$encryptedDisk['video']['original'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate] . md5($this -> fc -> settings -> encryption -> hash . $lastInsertIdVideo) . '.jpg';
						$uploadPhotoObj -> uploadFile($uploadPhotoObj -> newFileName);

						$thumbUploaded = $uploadPhotoObj -> resizeUploadImage($uploadVideoObj -> width, $uploadVideoObj -> height, parent::$encryptedDisk['video']['thumb'][$this -> fc -> settings -> date_time -> _dateTodayVeryShortDate]);
						return true;
					}
				}
			}
		}
	}

	public function editAction() {
		$form = new Vehicle_Form_ForRentUpdate($this -> view);
		$form -> setLocale($this -> fc -> settings);
		$form -> setLookup($this -> vehicleLookupObj -> vehicleComboBox);
		$form -> renderForm();
		$form -> setView($this -> view);

		if (!empty($_POST) and $form -> isValid($_POST)) {
			$vehiclForRentData = array_merge($_POST['system'], $_POST['contact'], $_POST['general'], $_POST['specification']);
			$vehiclForRentData['modified_by'] = $this -> userId;
			$vehiclForRentData['modified_date'] = new Zend_db_Expr("Now()");
			$vehiclForRentData['options'] = json_encode($vehiclForRentData['options']);

			$this -> forRentObj -> update($vehiclForRentData, '`id` = ' . (int)$vehiclForRentData['id']);

			$_POST['video']['vehicle_id'] = $vehiclForRentData['id'];
			$videoUploadedSuccessfully = $this -> importVideo($_POST['video'], false);

			for ($value = 1; $value <= self::NUMBER_OF_PHOTOS; ++$value) {
				$_POST['photo_' . $value]['vehicle_id'] = $vehiclForRentData['id'];
				if ( empty($_POST['photo_' . $value]['photo_id']) ) continue;
				$photoUploadedSuccessfully = $this -> importPhoto($_POST['photo_' . $value], 'photo_' . $value, false);
			}

			header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/');
			exit();
		} else {
			if (isset($_GET['id']) and is_numeric($_GET['id'])) {
				$forRentObjResult = $this -> forRentObj -> select() -> where('`id` = ?', $_GET['id']) -> query() -> fetch();
				$photoForRentObjResult = $this -> vehiclePhotoObj -> select() -> where('`vehicle_id` = ?', $_GET['id']) -> where('`type` = ?', 'Rent') -> query() -> fetchAll();
				$videoForRentObjResult = $this -> vehicleVideoObj -> select() -> where('`vehicle_id` = ?', $_GET['id']) -> query() -> fetch();

				if ($forRentObjResult !== false) {
					// Begin Vehicle For Rent Info
					$advertise_date = explode(' ', $forRentObjResult['advertise_date']);
					$forRentObjResult['advertise_date'] = $advertise_date[0];
					$forRentObjResult['options'] = json_decode($forRentObjResult['options']);
					/*
					 * TODO
					 * pass the value for contact_nid_cr from db to comboBox not the result for it from vehicle_for_rent table
					 */
					$forRentObjResult['contact_nid_cr'] = 111555;
					// End Vehicle For Rent Info

					// Begin Vehicle Video Info
					$approved_date = explode(' ', $videoForRentObjResult['taken_date']);
					$publish_date = explode(' ', $videoForRentObjResult['publish_from']);
					$advertise_date = explode(' ', $videoForRentObjResult['publish_to']);
					$videoForRentObjResult['taken_date'] = $approved_date[0];
					$videoForRentObjResult['publish_from'] = $publish_date[0];
					$videoForRentObjResult['publish_to'] = $advertise_date[0];
					$videoForRentObjResult['video_id'] = $videoForRentObjResult['id'];
					unset($videoForRentObjResult['id']);
					$form -> videoForm($videoForRentObjResult);
					// End Vehicle Video Info

					// Begin Vehicle Photo Info
					foreach ($photoForRentObjResult as $key => $config) {
						$index = $key;
						++$index;
						$config['photo_id'] = $config['id'];

			 			$photoDate 	   = explode('-', $config['date_added'], 3);
			 			$largePhotoSRC = parent::$encryptedUrl['photo']['large'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $config['id']) . '.jpg?x=' . rand(0, 1000);
						$form -> photoForm($index, $config, $largePhotoSRC);
					}
					// End Vehicle Photo Info

					$form -> populate($forRentObjResult);
				} else {
					header('Location: /admin/handle/pkg/vehicle-for-rent/action/list');
					exit();
				}
			}
		}
		$this -> view -> form = $form;
		$this -> view -> render('vehicle/updateForRent.phtml');
		exit();
	}

	public function getContactAjaxAction() {
		//print_r($_POST['contactNIDCR']);
		//echo "MOUSA";

		/*
		 * TODO
		 * fetch this array index value from contact table where contactNIDCR = $_POST['contactNIDCR']
		 * if its new record please pass '' to the array
		 */

		$arr = array('contact_bb' => 3231213, 'contact_full_name' => 'Mohammad R. Mousa', 'mobile_1' => 078837191, 'mobile_2' => 00962788837191, 'email' => 'mohammad.riad@gmail.com', );
		echo json_encode($arr);
		exit ;
	}

	public function getMakeAjaxAction() {
		$locale_id = (int)$_GET['locale_id'];

		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');

		$typeObj = new Vehicle_Model_Type();
		$makeObj = new Vehicle_Model_Make();

		$vehicleTypeObjResult = $typeObj -> select() -> from(array('vehicle_type'), array('id')) -> query() -> fetchAll();
		foreach ($vehicleTypeObjResult as $key => $id) {
			$vehicleMakeObjResult = $makeObj -> select() -> from(array('vehicle_make'), array('id', 'title', 'vehicle_type_id')) -> where('`vehicle_type_id` = ?', $id) -> where('`locale_id` = ?', $locale_id) -> query() -> fetchAll();
			foreach ($vehicleMakeObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['vehicle_type_id'] => $value['title']));
			}
		}
		echo $data;
	}

	public function getModelAjaxAction() {
		$locale_id = (int)$_GET['locale_id'];

		$data = new Zend_Dojo_Data();
		$data -> setIdentifier('name');

		$makeObj = new Vehicle_Model_Make();
		$modelObj = new Vehicle_Model_Model();

		$vehicleMakeObjResult = $makeObj -> select() -> from(array('vehicle_make'), array('id')) -> query() -> fetchAll();
		foreach ($vehicleMakeObjResult as $key => $id) {
			$vehicleModelObjResult = $modelObj -> select() -> from(array('vehicle_model'), array('id', 'title', 'vehicle_make_id')) -> where('`vehicle_make_id` = ?', $id) -> where('`locale_id` = ?', $locale_id) -> query() -> fetchAll();
			foreach ($vehicleModelObjResult as $key2 => $value) {
				$data -> addItem(array('name' => $value['id'], $value['vehicle_make_id'] => $value['title']));
			}
		}
		echo $data;
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> forRentId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->forRentId->value as $id => $value) {
				$data = array('published' => $this -> view -> sanitized -> status -> value);
				$where = $this -> forRentObj -> getAdapter() -> quoteInto('id = ?', $id);
				$forRentPublish = $this -> forRentObj -> update($data, $where);
			}
			if (!empty($forRentPublish)) {
				header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> forRentId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->forRentId->value as $id => $value) {
				$data = array('approved' => $this -> view -> sanitized -> status -> value);
				$where = $this -> forRentObj -> getAdapter() -> quoteInto('id = ?', $id);
				$forRentAprrove = $this -> forRentObj -> update($data, $where);
			}
			if (!empty($forRentAprrove)) {
				header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> forRentId -> value)) {
			foreach ($this -> view -> sanitized -> forRentId -> value as $id => $value) {
				$where = $this -> forRentObj -> getAdapter() -> quoteInto('id = ?', $id);
				$stmt = $this -> forRentObj -> delete($where);
			}
			if (!empty($stmt)) {
				header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/success/delete');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/vehicle-for-rent/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/vehicle-for-rent/action/';

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

		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		$this -> view -> sort = (object)NULL;
		foreach ($this-> forRentObj -> cols as $col) {
			$this -> view -> sort -> {$col} = (object)NULL;
			$this -> view -> sort -> {$col} -> cssClass = 'sort-title-desc';
			$this -> view -> sort -> {$col} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $col . '/sort/desc';
		}

		if (isset($_GET['col']) and (in_array($_GET['col'], $this -> forRentObj -> cols))) {
			$sort = 'ASC';
			$sortInvert = 'desc';
			$column = $_GET['col'];
			if (isset($_GET['sort']) and (0 === strcasecmp($_GET['sort'], 'DESC'))) {
				$sort = 'DESC';
				$sortInvert = 'asc';
			}
			$forRentListResult = $this -> forRentObj -> getAllForRent_OrderByColumnWithLimit($column, $sort, $this -> start, $this -> limit);
			$sort = strtolower($sort);
			$column = strtolower($column);
			$this -> view -> sort -> {$column} -> cssClass = 'sort-arrow-' . $sort;
			$this -> view -> sort -> {$column} -> href = $this -> view -> sanitized -> actionURI -> value . 'list/col/' . $column . '/sort/' . ($sortInvert);
		} else {
			$forRentListResult = $this -> forRentObj -> getAllForRent_OrderByColumnWithLimit('id', 'ASC', $this -> start, $this -> limit);
		}

		$this -> pagingObj -> _init($this -> forRentObj -> getAdapter() -> fetchOne('SELECT FOUND_ROWS()'));
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		if (empty($forRentListResult) and false == $forRentListResult) {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		} else {

			foreach ($forRentListResult as $key => $value) {
				$forRentListResult[$key]['vehicle_type_title'] = $this -> typeObj -> getTypeTitleById($value['type_id']);
				$forRentListResult[$key]['vehicle_year_title'] = $this -> yearObj -> getYearTitleById($value['year_id']);
				$forRentListResult[$key]['vehicle_make_title'] = $this -> makeObj -> getMakeTitleById($value['make_id']);
				$forRentListResult[$key]['vehicle_model_title'] = $this -> modelObj -> getModelTitleById($value['model_id']);
				$forRentListResult[$key]['contact_type_title'] = $this -> vehicleLookupObj -> vehicleComboBox['contact_type'][(int)$value['contact_type']];
			}

			/*$photoListResult = $this -> vehiclePhotoObj -> select() -> from(array('vehicle_photo'), array('id','date_added')) -> query() -> fetchAll();
			 foreach ($photoListResult as $key => $value) {
			 $photoDate = explode('-', $value['date_added'], 3);
			 $photoSRC = parent::$encryptedUrl['photo']['thumb'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg?x=' . rand(0, 1000);
			 $largePhotoSRC = parent::$encryptedUrl['photo']['large'][$photoDate[0] . '-' . $photoDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg?x=' . rand(0, 1000);
			 echo '<br />' . $photoListResult[$key]['photoSRC'] = $photoSRC;
			 echo '<br />' . $photoListResult[$key]['largePhotoSRC'] = $largePhotoSRC;
			 }*/

			/*$videoListResult = $this -> vehicleVideoObj -> select() -> from(array('vehicle_video'), array('id','date_added', 'extension')) -> query() -> fetchAll();
			 foreach ($videoListResult as $key => $value) {
			 $fileDate = explode('-', $value['date_added'], 3);
			 $thumbURL = parent::$encryptedUrl['video']['thumb'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . '.jpg?r=' . rand(0, 1000) . '<br /><br />';
			 $flvURL = parent::$encryptedUrl['video']['flv'][$fileDate[0] . '-' . $fileDate[1]] . md5($this -> fc -> settings -> encryption -> hash . $value['id']) . $value['extension'];
			 echo '<br />' . $videoListResult[$key]['thumbURL'] = $thumbURL;
			 echo '<br />' . $videoListResult[$key]['fileURL'] = $flvURL;
			 }*/
		}

		$this -> view -> forRentList = $forRentListResult;
		$this -> view -> render('vehicle/listForRent.phtml');
		exit();
	}

}
