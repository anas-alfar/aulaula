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
 * @package Aula - Core
 * @subpackage Model
 * @name Aula_Model_Locale
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Aula_Model_Locale extends Aula_Model_Default {
	
	public function setLocale() {
		//User agent language signatures
		$browser_signatures = array ('en_us' => 'en([-_][[:alpha:]]{2})?|english' );
		
		//get default locale settings
		$settings = ( object ) NULL;
		$settings->locale = Zend_Registry::get ( 'settings-locale' );
		
		//detect requested language
		if (! empty ( $_GET ['lang'] )) {
			//set cookie and session
			$requested_lang = $_GET ['lang'];
			$is_set_cookie_session = true;
		} else if (! empty ( $_POST ['lang'] )) {
			//set cookie and session
			$requested_lang = $_POST ['lang'];
			$is_set_cookie_session = true;
		} else if (! empty ( $_REQUEST ['lang'] )) {
			//set cookie and session
			$requested_lang = $_REQUEST ['lang'];
			$is_set_cookie_session = true;
		} else if (! empty ( $_COOKIE ['lang'] )) {
			$requested_lang = $_COOKIE ['lang'];
		} else {
			//initialize to the system default language
			$requested_lang = $settings->locale->default->lang;
		
		#require_once 'Zend/Locale.php';
		#$requested_lang = new Zend_Locale ( Zend_Locale::BROWSER );
		#$requested_lang = strtolower ( $requested_lang );
		}
		
		//set the current short lang identifier to $requested_lang based on the previous logic
		$settings->locale->default->current->short = $requested_lang;
		
		//read available langs in default configurations to get the lang title
		$settings->locale->default->current->title = "";
		foreach ( $settings->locale->available->lang->toArray () as $value ) {
			if (0 === strcasecmp ( $value ['short'], $settings->locale->default->current->short )) {
				$settings->locale->default->current->title = $value ['title'];
			}
		}
		
		if (empty ( $settings->locale->default->current->title )) {
			$settings->locale->default->current->short = $settings->locale->default->lang;
			$settings->locale->default->current->title = $settings->locale->default->title;
		}
		
		Zend_Registry::set ( 'settings-locale', $settings->locale );
		
		setcookie ( 'lang', $requested_lang, time () + 4320000, '/' ); //expire in 50 days (50x24x60x60)
		

		unset ( $settings );
		unset ( $requested_lang );
	}
}