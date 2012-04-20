<?php
/**
 * Handle most of data type validation
 * Validate Email addresses, Nicknames, Passwords, Alphabatec strings, Regular Strings, Numeric Values, Short DateTime and Long DateTime strings.
 * 
 * @name data_validation
 * @access public
 * @author Anas K. Al-Far <anas@hazeemsoft.com>
 * @copyright HazeemSoft.com
 * @version 1.0.0
 *
 */
class Aula_Model_Validation extends Aula_Model_Default {
	private $_text = array ();
	public function __construct() {
		$translation = Zend_Registry::get ( 'translation' );
		$this->_text = array ('requiredField' => $translation->_ ( 'requiredField' ), 'invalidField' => $translation->_ ( 'invalidField' ) );
	}
	/**
	 * Validate email address formula
	 * @example $Email = 'e@adsd.er';
	 * @param string $Email
	 * @return bool
	 */
	private function validateEmail($Email) {
		if (! preg_match ( "#^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$#", $Email )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate Physical File Path formula
	 * @example $FilePath = '/usr/local/apache/htdocs/index.php';
	 * @param string $FilePath
	 * @return bool
	 */
	private function validateFilePath($FilePath) {
		if (! preg_match ( "#^/{0,1}([_a-zA-Z0-9-/.]+)$#", $FilePath )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate IP Address formula
	 * @example $ip = 123.123.123.123:9999;
	 * @param string $ip
	 * @return bool
	 */
	private function validateIpAddress($FilePath) {
		if (! preg_match ( "#^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}(\:[0-9]{1,4})?$#", $FilePath )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate URL address formula
	 * @example $URL = 'https://hazeemsoft.com';
	 * @param string $URL
	 * @return bool
	 */
	private function validateURL($URL) {
		if (! preg_match ( "#^http[s]{0,1}://(www.)?([_a-zA-Z0-9-]+).([_a-zA-Z0-9-]+)[/]?#", $URL )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate URI query string formula
	 * @example $URI = '/page/action/param/sub/level.php?id=2334';
	 * @param string $URI
	 * @return bool
	 */
	private function validateURI($URL) {
		if (! preg_match ( "#^/([_a-zA-Z0-9-\/\.\?]+)$#", $URL )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate URI query string formula
	 * @example $_FILES [$fileUploaded]
	 * @param mixed $fileUploaded
	 * @return bool
	 */
	private function validateFileUploaded($fileUploaded) {
		if (isset ( $_FILES [$fileUploaded] )) {
			if (! empty ( $_FILES [$fileUploaded] ['name'] ) and ! empty ( $_FILES [$fileUploaded] ['tmp_name'] ) and 0 == $_FILES [$fileUploaded] ['error'] and 0 < $_FILES [$fileUploaded] ['size']) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Validate Regular text (First name, Last name..etc) validation Accepts Only: (Alpha, Numeric, Underscore(_), Score(-), Dot(.), Space( ))
	 * @example $str = 'user. n_a-me'
	 * @param string $str
	 * @return bool
	 */
	private function validateRegualText($str) {
		if (! preg_match ( "#^[\?\;\\\/\ \.\,\!\@\#\$\%\^\&\*\'\"\:\[\]\{\}\؛\,\؟\¦\|\`\~_a-zA-Z0-9-\p{Arabic}\َ\ً\ُ\ٌ\`\<\>\\(\)\/\،\ـ\÷\×\؛]+$#u", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate Nickname Accepts Only: (Alpha, Numeric, Underscore(_), Score(-), Dot(.))
	 * @example $str = 'user.n_a-me';
	 * @param string $str
	 * @return boolexpression
	 */
	private function validateNickname($str) {
		if (! preg_match ( "#^[\._a-zA-Z0-9-]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate Password Accepts Only: (Alpha, Numeric, Underscore(_), At(@))
	 * @example $str = 'P@ss0_rd';
	 * @param string $str
	 * @return bool
	 */
	private function validatePassword($str) {
		if (! preg_match ( "#^[@_a-zA-Z0-9]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate Password Accepts Only: (Alpha, Numeric)
	 * @example $str = 'Pass03rd';
	 * @param string $str
	 * @return bool
	 */
	private function validateAlphabaticNumeric($str) {
		if (! preg_match ( "#^[a-zA-Z0-9]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate Password Accepts Only: (Alpha, Numeric, Underscore and Must start with Alph or Underscore)
	 * @example $str = 'Pass03rd';
	 * @param string $str
	 * @return bool
	 */
	private function validateCodeConvention($str) {
		if (! preg_match ( "#^[a-zA-Z_][a-zA-Z_0-9]*$#", $str )) {
			return false;
		}
		return true;
	}
	/**
	 * Validate Password Accepts Only: (Alpha, Numeric)
	 * @example $str = 'Pass03rd';
	 * @param string $str
	 * @return bool
	 */
	private function validateAlphabaticNumericEnglishArabic($str) {
		if (! preg_match ( "#^[a-zA-Z0-9\p{Arabic}]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate Alphabatic Accepts Only English Charecters Only
	 * @example $str = 'AbcDeF'
	 * @param string $str
	 * @return bool
	 */
	private function validateAlphabatic($str) {
		if (! preg_match ( "#^[a-zA-Z]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Numeric Accepts Numeric Only
	 * @example $str = '7678534908';
	 * @param string $str
	 * @return bool
	 */
	private function validateNumeric($str) {
		if (! preg_match ( "#^[0-9]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Numeric Accepts Numeric Only
	 * @example $str = '7678534908';
	 * @param string $str
	 * @return bool
	 */
	private function validateNumericUnsigned($str) {
		if (! preg_match ( "#^[-+]?[0-9]+$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate MySql DateTime Accepts DateTime (Short Formula) Only
	 * @example $str = '2007-05-23'
	 * @param string $str
	 * @return bool
	 */
	private function validateShortDateTime($str) {
		if (! preg_match ( "#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $str )) {
			return false;
		}
		return true;
	}
	
	/**
	 * Validate MySql DateTime Accepts DateTime (Long Formula) Only
	 * @example $str = '2007-05-23 08:33:58'
	 * @param string $str
	 * @return bool
	 */
	private function validateLongDateTime($str) {
		if (! preg_match ( "#^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$#", $str )) {
			return false;
		}
		return true;
	}
	
	public function validator($fields, $array, &$errorArray = null) {
		$errorMsg = array ();
		$requiredFields = array ();
		
		if (empty ( $_POST ) or empty ( $fields )) {
			return false;
		}
		
		if (empty ( $errorArray )) {
			foreach ( $fields as $filed => $value ) {
				if ((1 == $value [1]) or (! empty ( $array [$filed] ['value'] ))) {
					$requiredFields [$filed] = $value;
					$errorArray [$filed . 'ValidateErrorMSG'] = $this->_text ['invalidField'];
					$errorArray [$filed . 'PresenceErrorMSG'] = $this->_text ['requiredField'];
				}
			}
		}
		
		foreach ( $requiredFields as $filed => $value ) {
			if (! isset ( $array [$filed] ['value'] ) || (empty ( $array [$filed] ['value'] ) && $array [$filed] ['value'] != 0)) {
				$errorMsg [$filed] = $errorArray [$filed . 'PresenceErrorMSG'];
			} else {
				if (is_array ( $array [$filed] )) {
					$array [$filed] = $array [$filed] ['value'];
				}
				
				switch ($value [0]) {
					case 'text' :
						if (! $this->validateRegualText ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'nickName' :
						if (! $this->validateNickname ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'email' :
						if (! $this->validateEmail ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'shortDateTime' :
						if (! $this->validateShortDateTime ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'longDateTime' :
						if (! $this->validateLongDateTime ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'regualText' :
						if (! $this->validateRegualText ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'password' :
						if (! $this->validatePassword ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'alphabaticNumeric' :
						if (! $this->validateAlphabaticNumeric ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'codeConvention' :
						if (! $this->validateCodeConvention ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'alphabaticNumericEnglishArabic' :
						if (! $this->validateAlphabaticNumericEnglishArabic ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'alphabatic' :
						if (! $this->validateAlphabatic ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'numeric' :
						if (! $this->validateNumeric ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'numericUnsigned' :
						if (! $this->validateNumericUnsigned ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'filePath' :
						if (! $this->validateFilePath ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'url' :
						if (! $this->validateURL ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'uri' :
						if (! $this->validateURI ( $array [$filed] ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					case 'fileUploaded' :
						if (! $this->validateFileUploaded ( $filed ))
							$errorMsg [$filed] = $errorArray [$filed . 'ValidateErrorMSG'];
						break;
					default :
						break;
				}
			}
		}
		return $errorMsg;
	}

}
