<?php
//set default app path
defined('AULA_APP_PATH') || define('AULA_APP_PATH', (getenv('AULA_APP_PATH') ? getenv('AULA_APP_PATH') : realpath(dirname(__FILE__))));

//set default domain
defined('AULA_APP_DOMAIN') || define('AULA_APP_DOMAIN', (getenv('AULA_APP_DOMAIN') ? getenv('AULA_APP_DOMAIN') : trim($_SERVER['HTTP_HOST'], 'www.')));

//set default app environment [development-testing-staging-production]
defined('AULA_APP_ENV') || define('AULA_APP_ENV', (getenv('AULA_APP_ENV') ? getenv('AULA_APP_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(realpath(AULA_APP_PATH . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR), realpath(AULA_APP_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR), get_include_path(), )));

spl_autoload_register('__aulaLoad');

function __aulaLoad($class) {
	$path = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

	if (file_exists(AULA_APP_PATH . 'app' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . $path) and is_readable(AULA_APP_PATH . 'app' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . $path)) {
		require_once AULA_APP_PATH . 'app' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . $path;
	} else if (file_exists(AULA_APP_PATH . 'app' . DIRECTORY_SEPARATOR . $path) and is_readable(AULA_APP_PATH . 'app' . DIRECTORY_SEPARATOR . $path)) {
		require_once AULA_APP_PATH . 'app' . DIRECTORY_SEPARATOR . $path;
	} else {
		require_once AULA_APP_PATH . 'library' . DIRECTORY_SEPARATOR . $path;
	}
}

//require_once 'Zend/Controller/Front.php';
//require_once 'Zend/Controller/Action.php';
require_once 'Zend/Translate.php';
require_once 'Zend/Translate/Adapter/Array.php';
require_once 'Zend/Config/Exception.php';
require_once 'Zend/Config/Ini.php';
require_once 'Zend/Registry.php';

class BootStrap extends Aula_Controller_Default {

	protected function _init() {

		$this -> settings = new Zend_Config_Ini(AULA_APP_PATH . 'configs' . DIRECTORY_SEPARATOR . 'settings.ini', AULA_APP_ENV, TRUE);

		//Initiate DateTime settings
		date_default_timezone_set($this -> settings -> basic -> time_zone);

		$this -> settings -> date_time = (object)NULL;
		$this -> settings -> date_time -> _dateTodayTimeStamp = time();
		$this -> settings -> date_time -> _dateTodayTime24 = date('H:i:s');
		$this -> settings -> date_time -> _dateTodayShortDate = date('Y-m-d');
		$this -> settings -> date_time -> _dateTodayVeryShortDate = date('Y-m');
		$this -> settings -> date_time -> _dateTodayLongDate = $this -> settings -> date_time -> _dateTodayShortDate . ' ' . $this -> settings -> date_time -> _dateTodayTime24;

		Zend_Registry::set('settings-isBackendTheme', 0);
		Zend_Registry::set('settings-basic', $this -> settings -> basic);
		Zend_Registry::set('settings-directories', $this -> settings -> directories);
		Zend_Registry::set('settings-urls', $this -> settings -> urls);
		Zend_Registry::set('settings-locale', $this -> settings -> locale);
		Zend_Registry::set('settings-page', $this -> settings -> page);
		Zend_Registry::set('settings-cache', $this -> settings -> cache);
		Zend_Registry::set('settings-email', $this -> settings -> email);
		Zend_Registry::set('settings-debug', $this -> settings -> debug);
		Zend_Registry::set('settings-db', $this -> settings -> database);
		Zend_Registry::set('settings-code', $this -> settings -> code);
		Zend_Registry::set('settings-date_time', $this -> settings -> date_time);
		Zend_Registry::set('settings-encryption', $this -> settings -> encryption);
		Zend_Registry::set('settings-seo', $this -> settings -> seo);

		$this -> _resetDebugHandler();
		$this -> _initMemCache($this -> settings -> advanced -> memcache);
		$this -> _initIpTable($this -> settings -> advanced -> iptable);

		$localeObj = new Aula_Model_Locale($this);
		$localeObj -> setLocale();

		$this -> _initSession();
		$this -> _initTranslation();

		//aggregate all super global arrays to sanitize :D
		$OREGINALS = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST, &$_SERVER, &$_SESSION);

		$this -> cleanData($OREGINALS);
		$this -> setDebugMode();
		$this -> dispatcher();

		return 0;
	}

	private function _initIpTable($iptable) {
		//check if iptables enabled
		if (1 === (int)$iptable -> status) {
			//enable the site ONLY to allowed ips, redirect the rest
			$isAllowed = false;
			foreach ($iptable->allow as $value) {
				if (0 === strcasecmp($_SERVER['REMOTE_ADDR'], $value)) {
					$isAllowed = true;
					break;
				}
			}
			if (!$isAllowed) {
				header('Location: /error-500.html');
				exit ;
			}
			unset($isAllowed);
		}
		return;
	}

	private function _initMemCache($memcache) {
		//check if memcache enabled
		if (1 === (int)$memcache -> status) {
			$memcache = new Memcache;
			$memcache -> connect($memcache -> host, $memcache -> port);
			Zend_Registry::set('memcache', $memcache);
		}
		return;
	}

	private function _initSession() {
		if (1 === ( int )$this -> settings -> basic -> autostart_session) {
			session_start();
			session_regenerate_id();
		}
	}

	private function _initTranslation() {
		$translation = new Zend_Translate('Csv', $this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Aula.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Aula.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Category.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Package.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Menu.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Locale.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Object.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Tag.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Theme.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Translation.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'User.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Banner.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Poll.csv', $this -> settings -> locale -> default -> current -> short);
		$translation -> addTranslation($this -> settings -> directories -> locale . $this -> settings -> locale -> default -> current -> short . DIRECTORY_SEPARATOR . 'Feature.csv', $this -> settings -> locale -> default -> current -> short);
		Zend_Registry::set('translation', $translation);
	}

}

$bootObj = new BootStrap();
