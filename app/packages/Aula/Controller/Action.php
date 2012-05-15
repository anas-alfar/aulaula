<?php

class Aula_Controller_Action {

	private $menuObj = '';

	private $today = '';
	private $arabicDays = array('الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت');
	private $arabicMonths = array(1 => 'يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر');

	protected $fc = NULL;
	protected $defualtAction = NULL;
	protected $defualtAdminAction = NULL;
	protected $isPagePostBack = false;
	protected $fields = array();
	protected $errorMessage = Array();

	protected $view = NULL;
	protected $authObj = NULL;
	protected $filterObj = NULL;
	protected $validationObj = NULL;
	protected $pagingObj = NULL;

	protected $userId = NULL;
	protected $userLevel = NULL;
	protected $userEmail = NULL;
	protected $isLoggedIn = false;
	protected $userName = NULL;
	protected $userFullName = NULL;
	protected $isAdminLoggedIn = false;

	protected $start = 0;
	protected $limit = 50;
	protected $page = 1;

	protected $bannersList = array();

	protected static $encryptedDisk = NULL;
	protected static $encryptedUrl = NULL;

	public function __destruct() {
		//@todo
	}

	public function __construct(Aula_Controller_Default $fc) {
		$this -> fc = $fc;

		$this -> view = new Aula_Model_View();
		$this -> filterObj = new Aula_Model_Filter();
		$this -> validationObj = new Aula_Model_Validation();
		$this -> pagingObj = new Aula_Model_Paging();

		$this -> view -> _init();
		$this -> buildEncryptedDiskMap();

		$this -> view -> photo_list = $this -> fc -> settings -> cache -> photo_list -> url;
		$this -> view -> media_list = $this -> fc -> settings -> cache -> media_list -> url;
		$this -> view -> video_list = $this -> fc -> settings -> cache -> video_list -> url;

		$this -> isPagePostBack();
		$this -> isXcrfAttack();
		$this -> isControlPanel();
		$this -> isLoggedIn();
		$this -> buildPaging();
		$this -> setDate();
		$this -> initSEO();
		//$this -> buildMenu();

		$this -> _init();

		return $this;
	}

	private function isXcrfAttack() {
		return true;
	}

	private function isLoggedIn() {
		$this -> authObj = new Aula_Model_Auth($this -> fc -> settings -> basic -> default_storage);
		$c = $this -> authObj -> getStorage() -> read('c');
		$s = $this -> authObj -> getStorage() -> read('s');
		$s2 = md5($this -> fc -> settings -> encryption -> hash . $c);
		if (0 === strcmp($s, $s2)) {
			$data = explode('||||', $c);
			$this -> view -> isLoggedIn = $this -> isLoggedIn = true;
			$this -> view -> userName = $this -> userName = $data[0];
			$this -> view -> userId = $this -> userId = $data[1];
			$this -> view -> userLevel = $this -> userLevel = $data[2];
			$this -> view -> userEmail = $this -> userEmail = $data[3];
			$this -> view -> userFullName = $this -> userFullName = $data[4];

			if ($this -> userLevel == 1 or $this -> userLevel == 2) {
				$this -> view -> isAdminLoggedIn = $this -> isAdminLoggedIn = true;
			}

			return true;
		}

		$this -> view -> isLoggedIn = $this -> isLoggedIn;
		$this -> view -> userName = $this -> userName;
		$this -> view -> userId = $this -> userId;
		$this -> view -> userLevel = $this -> userLevel;
		$this -> view -> userEmail = $this -> userEmail;
		$this -> view -> userFullName = $this -> userFullName;

		return false;
	}

	private function isPagePostBack() {
		if ((isset($_POST['btn_submit']) and !empty($_POST['btn_submit'])) or (isset($this -> view -> sanitized) and is_object($this -> view -> sanitized) and isset($this -> view -> sanitized -> btn_submit) and !empty($this -> view -> sanitized -> btn_submit -> value))) {
			$this -> isPagePostBack = true;
		}
	}

	private function isControlPanel() {
		if (false !== stripos($this -> fc -> request -> package, $this -> fc -> settings -> code -> admin_package) and (1 === (int)$this -> fc -> settings -> advanced -> admin_apache_auth -> status)) {
			//Check for Apache Auth if the function being called is an admin function
			if (!isset($_SERVER['PHP_AUTH_USER']) or (0 !== strcmp($_SERVER['PHP_AUTH_USER'], $this -> fc -> settings -> advanced -> admin_apache_auth -> username)) or (0 !== strcmp($_SERVER['PHP_AUTH_PW'], $this -> fc -> settings -> advanced -> admin_apache_auth -> password))) {
				header('WWW-Authenticate: Basic realm="This is a restricted area"');
				header('HTTP/1.0 401 Unauthorized');
				echo $this -> fc -> settings -> advanced -> admin_apache_auth -> message;
				exit();
			}
		}

	}

	private function initSEO() {
		$this -> view -> metaData = '';
		$this -> view -> pageTitle = $this -> fc -> settings -> seo -> pageTitle;
		$this -> view -> metaKeywords = $this -> fc -> settings -> seo -> metaKeywords;
		$this -> view -> metaDescription = $this -> fc -> settings -> seo -> metaDescription;
	}

	protected function setDate() {
		$todayArray = explode('-', date('w-d-n-Y'));
		$this -> today = $this -> arabicDays[$todayArray[0]] . ', ' . $todayArray[1] . ' ' . $this -> arabicMonths[$todayArray[2]] . ', ' . $todayArray[3];
		$this -> view -> today = $this -> today;
	}

	protected function buildPaging() {
		if (isset($_GET['page'])) {
			$this -> pagingObj -> page = $this -> page = ( int )$_GET['page'];
			$this -> start = ($this -> pagingObj -> page - 1) * $this -> pagingObj -> totalRecordsPerPage;
			$this -> limit = $this -> pagingObj -> totalRecordsPerPage;
		}
	}

	protected function buildBanners() {
		if (!empty($this -> bannersList)) {
			foreach ($this->bannersList as $key => $banner) {
				switch ($banner ['type']) {
					case 'image url' :
						$this -> bannersList[$key]['content'] = '<img height="#YYY#" width="#XXX#" src="' . $banner['link'] . '" alt="' . $banner['title'] . '" title="' . $banner['title'] . '" />';
						break;
					case 'image file' :
						$this -> bannersList[$key]['content'] = '<img height="#YYY#" width="#XXX#" src="' . $banner['full_path'] . '" alt="' . $banner['title'] . '" title="' . $banner['title'] . '" />';
						break;
					case 'swf file' :
						$this -> bannersList[$key]['content'] = '<object height="#YYY#" width="#XXX#" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" odebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0"><param NAME="movie" VALUE="' . $banner['full_path'] . '"><param NAME="quality" VALUE="high"><embed src="' . $banner['full_path'] . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="#XXX#" height="#YYY#"></embed></object>';
						break;
					case 'swf object' :
						$this -> bannersList[$key]['content'] = $banner['object'];
						break;
					case 'javascript code' :
						$this -> bannersList[$key]['content'] = '<script type="text/javascript">' . $banner['object'] . '</script>';
						break;
				}
				$this -> bannersList[$banner['area_label']] = $this -> bannersList[$key];
				unset($this -> bannersList[$key]);
			}
		}
	}

	protected function buildMenu() {
		$this -> view -> menuList = '';
		$this -> menuObj = new Menu_Model_Default();
		$menuListResult = $this -> menuObj -> GetCleanMenuAndMenu_infoAndMenu_typeOrderByColumn('`id`', 'DESC');
		if (!empty($menuListResult) and false != $menuListResult) {
			$this -> menuList = $menuListResult;
			if (!empty($this -> menuList)) {
				$this -> menuList = $this -> buildMenuTree($this -> menuList);
				$this -> view -> menuList = $this -> menuList;
			}
		}
	}

	protected function buildMenuTree($menuList) {
		if (!empty($menuList)) {
			$menuTree = $parentIds = array();
			foreach ($menuList as $key => $item) {
				$menuTree[$item['id']] = $menuList[$key];
			}
			foreach ($menuTree as $key => $menu) {
				if ($menu['parent_id'] != 0) {
					$parentIds[$menu['id']] = $menu['parent_id'];
				}
			}
			foreach ($parentIds as $subMenuId => $parentId) {
				$menuTree[$parentId]['options'] .= $subMenuId . ',';
			}
			foreach ($menuTree as $key => &$item) {
				if (!empty($item['options'])) {
					$item['options'] = substr($item['options'], 0, -1);
					$subMenu = explode(',', $item['options']);
					$subMenuCount = count($subMenu);
					for ($i = 0; $i < $subMenuCount; $i++) {
						$item['tree'][$subMenu[$i]] = $menuTree[$subMenu[$i]];
						unset($menuTree[$subMenu[$i]]);
					}
				}
			}
			$menuTree = array_reverse($menuTree, true);
			foreach ($menuTree as $index => $value) {
				$menuTree[$value['type_label']][$index] = $value;
				unset($menuTree[$index]);
			}
			return $menuTree;
		}
		return false;
	}

	protected function calcElapsedTime($time1, $time2) {
		// calculate elapsed time (in seconds!)
		$diff = $time1 - $time2;
		$daysDiff = floor($diff / 60 / 60 / 24);
		$diff -= $daysDiff * 60 * 60 * 24;
		$hrsDiff = floor($diff / 60 / 60);
		$diff -= $hrsDiff * 60 * 60;
		$minsDiff = floor($diff / 60);
		$diff -= $minsDiff * 60;
		$secsDiff = $diff;
		return ($daysDiff . 'يوم و' . $hrsDiff . ' ساعه و ' . $minsDiff . ' دقيقه و ' . $secsDiff . ' ثانية ');
	}

	protected function buildEncryptedDiskMap() {
		if (is_null(self::$encryptedDisk) and is_null(self::$encryptedUrl)) {
			self::$encryptedDisk['cache'] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> upload -> cache . DIRECTORY_SEPARATOR;
			self::$encryptedUrl['cache'] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> upload -> cache . '/';
			for ($i = 2008; $i < 2022; $i++) {
				for ($j = 1; $j < 13; $j++) {
					$_j = sprintf('%02d', $j);
					self::$encryptedDisk['photo']['thumb'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> photo . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> thumb . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['photo']['thumb-large'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> photo . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> thumbLarge . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['photo']['medium'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> photo . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> medium . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['photo']['large-mini'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> photo . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> largeMini . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['photo']['large'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> photo . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> large . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['photo']['original'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> photo . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> original . DIRECTORY_SEPARATOR;
					self::$encryptedUrl['photo']['thumb'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> photo . '/' . $this -> fc -> settings -> encryption -> upload -> thumb . '/';
					self::$encryptedUrl['photo']['thumb-large'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> photo . '/' . $this -> fc -> settings -> encryption -> upload -> thumbLarge . '/';
					self::$encryptedUrl['photo']['medium'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> photo . '/' . $this -> fc -> settings -> encryption -> upload -> medium . '/';
					self::$encryptedUrl['photo']['large-mini'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> photo . '/' . $this -> fc -> settings -> encryption -> upload -> largeMini . '/';
					self::$encryptedUrl['photo']['large'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> photo . '/' . $this -> fc -> settings -> encryption -> upload -> large . '/';
					self::$encryptedUrl['photo']['original'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> photo . '/' . $this -> fc -> settings -> encryption -> upload -> original . '/';

					self::$encryptedDisk['video']['thumb'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> video . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> thumb . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['video']['large'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> video . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> large . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['video']['flv'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> video . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> flv . DIRECTORY_SEPARATOR;
					self::$encryptedDisk['video']['original'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> video . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> original . DIRECTORY_SEPARATOR;
					self::$encryptedUrl['video']['thumb'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> video . '/' . $this -> fc -> settings -> encryption -> upload -> thumb . '/';
					self::$encryptedUrl['video']['large'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> video . '/' . $this -> fc -> settings -> encryption -> upload -> large . '/';
					self::$encryptedUrl['video']['flv'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> video . '/' . $this -> fc -> settings -> encryption -> upload -> flv . '/';
					self::$encryptedUrl['video']['original'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> video . '/' . $this -> fc -> settings -> encryption -> upload -> original . '/';

					self::$encryptedDisk['file'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> file . DIRECTORY_SEPARATOR;
					self::$encryptedUrl['file'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> file . '/';

					self::$encryptedDisk['banner'][$i . '-' . $_j] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . DIRECTORY_SEPARATOR . $this -> fc -> settings -> encryption -> upload -> banner . DIRECTORY_SEPARATOR;
					self::$encryptedUrl['banner'][$i . '-' . $_j] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> date -> years -> {"_" . $i } . '/' . $this -> fc -> settings -> encryption -> date -> {"_" . $i } -> {"_" . $_j } . '/' . $this -> fc -> settings -> encryption -> upload -> banner . '/';

					self::$encryptedDisk['users'] = $this -> fc -> settings -> directories -> disk . $this -> fc -> settings -> encryption -> upload -> users . DIRECTORY_SEPARATOR;
					self::$encryptedUrl['users'] = $this -> fc -> settings -> urls -> disk . $this -> fc -> settings -> encryption -> upload -> users . '/';
				}
			}
		}
	}

	protected function exportSQL2CSV($data, $header, $fileName = 'mutashabeh_data') {
		$flag = false;
		$fileName = $fileName . '_' . date('Ymd') . ".xls";

		foreach ($data as $row) {
			foreach ($row as $k1 => $v1) {
				if (!in_array($k1, $header)) {
					unset($row[$k1]);
				}
			}
			if (!$flag) {
				echo implode("\t", array_keys($row)) . "\r\n";
				$flag = true;
			}
			array_walk($row, 'self::cleanDataCSV');
			echo implode("\t", array_values($row)) . "\r\n";
		}
		header("Content-Disposition: attachment; filename=\"$fileName\"");
		header("Content-Type: application/vnd.ms-excel");
		exit ;
	}

	protected function cleanDataCSV(&$str) {
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		//if (strstr($str, '"'))
		//$str = '"' . str_replace('"', '""', $str) . '"';
	}

	protected function importCSV2SQL($file, $objModelDB, $options = true) {
		$flag = false;
		$header = array();
		$proheptedKey = false;

		if ($handle = fopen($file, "r")) {

			while (!feof($handle)) {
				$line = fgets($handle);
				if (!empty($line)) {

					$line = explode("\t", $line);

					array_walk($line, create_function('&$val', '$val = trim($val);'));

					if ($flag == false) {
						array_walk($line, create_function('&$val', '$val = strtolower($val);'));
						$header = $line;
						$checkHeader = array_diff($header, $objModelDB -> cols);
						if (is_array($checkHeader) and sizeof($checkHeader) > 0) {
							$this -> view -> notificationMessage = $this -> view -> __('Oops, you provided wrong data');
							$this -> view -> notificationMessageStyle = 'display: block;';
							return false;
							exit ;
						}
						$flag = true;
						continue;
					}
					/*$checkProheptedKeyid = array_keys($header, 'id');
					 if (sizeof($checkProheptedKeyid) == 1) {
					 $idIndex = $checkProheptedKeyid[0];
					 }*/
					$str = '';
					for ($i = 0; $i < sizeof($header); $i++) {
						$str .= "arr[$header[$i]]=$line[$i]&";
					}
					parse_str($str, $result);
					if ($options == true) {
						$result['arr']['options'] = json_encode($result['arr']['options']);
					}
					if (array_key_exists('id', $result['arr'])) {
						$id = $result['arr']['id'];
						unset($result['arr']['id']);
						$objModelDB -> update($result['arr'], '`id` = ' . (int)$id);
					} else {
						$objModelDB -> insert($result['arr']);
					}
				}
			}
			fclose($handle);
			return true;
		}

	}

}
