<?php
class Aula_Model_Exception extends Exception {
        
        static public $_errorsList = array ();
        
        static public function aulaErrorsHandler ($errno, $errstr, $errfile, $errline) {
                $errorMsg = '';
                $errorHash = sha1($errstr);
                
                if (array_key_exists($errorHash, self::$_errorsList)) {
                        return;
                }
                switch ($errno) {
                        case E_NOTICE:
                        case E_USER_NOTICE:
                                $errorMsg .= "<span style='color:purple;font-weight:bold;'>NOTICE [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
                                break;
                        case E_WARNING:
                        case E_CORE_WARNING:
                        case E_USER_WARNING:
                                $errorMsg .= "<span style='color:orange;font-weight:bold;'>WARNING [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
                                break;
                        case E_ALL:
                        case E_ERROR:
                        case E_PARSE:
                        case E_CORE_ERROR:
                        case E_USER_ERROR:
                        case E_USER_ERROR:
                                $errorMsg .= "<span style='color:red;font-weight:bold;'>FATAL ERROR [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
                                break;
                        case E_STRICT:
                                $errorMsg .= "<span style='color:red;font-weight:bold;'>E_STRICT [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
                                break;
                        default:
                                $errorMsg .= "<span style='color:red;font-weight:bold;'>UNKNOWN ERROR [$errno]:</span>" . PHP_EOL . "Line <span style='color:blue; text-decoration: underline;'>$errline</span> in file <span style='color:green; text-decoration: underline;'>$errfile</span>" . PHP_EOL;
                                break;
                }
                
                $errorMsg = '<div style="padding: 5px;margin: 5px;border: 2px dashed brown; background-color: LightGoldenRodYellow; clear: both; font-face: Tahoma;font-size: 12px;">'.$errorMsg;
                $errorMsg .= $errstr;
                $errorMsg .= '</div>';
                
                echo nl2br($errorMsg); 
                
                self::$_errorsList [$errorHash] = $errorMsg;
                
                unset ($errorHash);
                unset ($errorMsg);
        }
}