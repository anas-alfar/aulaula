<?php

class Aula_Model_Exception extends Exception {
	
	public static $_errorsList = array ();
	
	static public function aulaErrorsHandler($errno, $errstr, $errfile, $errline) {
		$settings = ( object ) NULL;
		$settings->debug = Zend_Registry::get ( 'settings-debug' );
		
		if (! ( int ) $settings->debug->enabled) {
			return;
		}
		
		$errorMsg = '';
		$errorHash = sha1 ( $errstr );
		
		if (array_key_exists ( $errorHash, self::$_errorsList )) {
			return;
		}
		
		switch ($errno) {
			case E_NOTICE :
			case E_USER_NOTICE :
				$errorMsg .= "<span style='color:purple;font-weight:bold;'>NOTICE [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
				break;
			case E_WARNING :
			case E_CORE_WARNING :
			case E_USER_WARNING :
				$errorMsg .= "<span style='color:orange;font-weight:bold;'>WARNING [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
				break;
			case E_ALL :
			case E_ERROR :
			case E_PARSE :
			case E_CORE_ERROR :
			case E_USER_ERROR :
			case E_USER_ERROR :
				$errorMsg .= "<span style='color:red;font-weight:bold;'>FATAL ERROR [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
				break;
			case E_STRICT :
				$errorMsg .= "<span style='color:red;font-weight:bold;'>E_STRICT [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
				break;
			default :
				$errorMsg .= "<span style='color:red;font-weight:bold;'>UNKNOWN ERROR [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
				break;
		}
		
		$errorMsg = '<div style="padding: 5px;margin: 5px;border: 2px dashed brown; background-color: LightGoldenRodYellow; clear: both; font-face: Tahoma;font-size: 12px; overflow: scroll;">' . $errorMsg;
		$errorMsg .= $errstr;
		$errorMsg .= '</div>';
		
		self::$_errorsList [$errorHash] = $errorMsg;
		
		if (1 === ( int ) $settings->debug->show_source) {
			echo nl2br ( $errorMsg );
		}
		
		if (1 === ( int ) $settings->debug->show_source_commented) {
			echo '<!--Error: ' . PHP_EOL . nl2br ( strip_tags ( $errorMsg ) ) . '-->';
		}
		
		if (1 === ( int ) $settings->debug->send_emai) {
		/**
		 * @todo: send email to $settings->debug->email_address
		 */
		}
		
		if (1 === ( int ) $settings->debug->write_log) {
			$errorsSeparator = PHP_EOL . "===========================" . PHP_EOL;
			file_put_contents ( $settings->debug->default_log_file, strip_tags ( $errorMsg . $errorsSeparator ), FILE_APPEND );
		}
		
		unset ( $errorMsg );
		unset ( $errorHash );
		unset ( $errorsSeparator );
	}
}