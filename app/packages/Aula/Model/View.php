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
 * @name Aula_Model_View
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Aula_Model_View extends Zend_View {
	//define controller/action to load default view
	public $templateAction = NULL;
	public $templateController = NULL;
	
	//Frontend Theme Paths
	public $isBackendTheme = false;
	public $frontendTheme = NULL;
	public $frontendDefaultTheme = NULL;
	public $frontendDefaultThemeTemplate = NULL;
	public $frontendDefaultThemeLayout = NULL;
	public $frontendDefaultThemeSkin = NULL;
	public $frontendDefaultSkin = NULL;
	public $frontendDefaultSkinCss = NULL;
	public $frontendDefaultSkinJs = NULL;
	public $frontendDefaultSkinImages = NULL;
	//Frontend Theme URLs
	public $frontendDefaultSkinUrl = NULL;
	public $frontendDefaultThemeSkinUrl = NULL;
	public $frontendDefaultSkinCssUrl = NULL;
	public $frontendDefaultSkinJsUrl = NULL;
	public $frontendDefaultSkinImagesUrl = NULL;
	public $frontendDefaultThemeUrl = NULL;
	
	//Backend Theme Paths
	public $backendTheme = NULL;
	public $backendDefaultTheme = NULL;
	public $backendDefaultThemeTemplate = NULL;
	public $backendDefaultThemeLayout = NULL;
	public $backendDefaultThemeSkin = NULL;
	public $backendDefaultSkin = NULL;
	public $backendDefaultSkinCss = NULL;
	public $backendDefaultSkinJs = NULL;
	public $backendDefaultSkinImages = NULL;
	//Backend Theme URLs
	public $backendDefaultSkinUrl = NULL;
	public $backendDefaultThemeSkinUrl = NULL;
	public $backendDefaultSkinCssUrl = NULL;
	public $backendDefaultSkinJsUrl = NULL;
	public $backendDefaultSkinImagesUrl = NULL;
	public $backendDefaultThemeUrl = NULL;
	
	//Current Theme Paths
	public $defaultTheme = NULL;
	public $defaultThemeTemplate = NULL;
	public $defaultThemeLayout = NULL;
	public $defaultThemeSkin = NULL;
	public $defaultSkin = NULL;
	public $defaultSkinCss = NULL;
	public $defaultSkinJs = NULL;
	public $defaultSkinImages = NULL;
	//Current Theme URLs
	public $defaultSkinUrl = NULL;
	public $defaultThemeSkinUrl = NULL;
	public $defaultSkinCssUrl = NULL;
	public $defaultSkinJsUrl = NULL;
	public $defaultSkinImagesUrl = NULL;
	public $defaultThemeUrl = NULL;
	
	public $errorMessage = '';
	public $successMessage = '';
	public $notificationMessage = '';
	public $errorMessageStyle = 'display: none;';
	public $successMessageStyle = 'display: none;';
	public $notificationMessageStyle = 'display: none;';
	
	public $sanitized = NULL;
	
	private $translation = NULL;
	
	//subString limitiation
	public $start = 0;
	public $length = 200;
	
	public function _init() {
		$settingsDirectories = Zend_Registry::get ( 'settings-directories' );
		$settingsURLs = Zend_Registry::get ( 'settings-urls' );
		$this->translation = Zend_Registry::get ( 'translation' );
		
		$this->frontendTheme = $this->frontendTheme = $settingsDirectories->frontend_theme;
		$this->defaultTheme = $this->frontendDefaultTheme = $settingsDirectories->frontend_default_theme;
		$this->defaultThemeTemplate = $this->frontendDefaultThemeTemplate = $settingsDirectories->frontend_default_theme_template;
		$this->defaultThemeLayout = $this->frontendDefaultThemeLayout = $settingsDirectories->frontend_default_theme_layout;
		$this->defaultThemeSkin = $this->frontendDefaultThemeSkin = $settingsDirectories->frontend_default_theme_skin;
		$this->defaultSkin = $this->frontendDefaultSkin = $settingsDirectories->frontend_default_skin;
		$this->defaultSkinCss = $this->frontendDefaultSkinCss = $settingsDirectories->frontend_default_skin_css;
		$this->defaultSkinJs = $this->frontendDefaultSkinJs = $settingsDirectories->frontend_default_skin_js;
		$this->defaultSkinImages = $this->frontendDefaultSkinImages = $settingsDirectories->frontend_default_skin_images;
		
		$this->rootUrl = $settingsURLs->root;
		$this->defaultSkinUrl = $this->frontendDefaultSkinUrl = $settingsURLs->frontend_default_skin;
		$this->defaultThemeSkinUrl = $this->frontendDefaultThemeSkinUrl = $settingsURLs->frontend_default_theme_skin;
		$this->defaultSkinCssUrl = $this->frontendDefaultSkinCssUrl = $settingsURLs->frontend_default_skin_css;
		$this->defaultSkinJsUrl = $this->frontendDefaultSkinJsUrl = $settingsURLs->frontend_default_skin_js;
		$this->defaultSkinImagesUrl = $this->frontendDefaultSkinImagesUrl = $settingsURLs->frontend_default_skin_images;
		$this->defaultThemeUrl = $this->frontendDefaultThemeUrl = $settingsURLs->frontend_default_theme;
		
		if ((true === $this->isBackendTheme) or (true === ( bool ) Zend_Registry::get ( 'settings-isBackendTheme' ))) {
			$this->backendTheme = $settingsDirectories->backend_theme;
			$this->defaultTheme = $this->backendDefaultTheme = $settingsDirectories->backend_default_theme;
			$this->defaultThemeTemplate = $this->backendDefaultThemeTemplate = $settingsDirectories->backend_default_theme_template;
			$this->defaultThemeLayout = $this->backendDefaultThemeLayout = $settingsDirectories->backend_default_theme_layout;
			$this->defaultThemeSkin = $this->backendDefaultThemeSkin = $settingsDirectories->backend_default_theme_skin;
			$this->defaultSkin = $this->backendDefaultSkin = $settingsDirectories->backend_default_skin;
			$this->defaultSkinCss = $this->backendDefaultSkinCss = $settingsDirectories->backend_default_skin_css;
			$this->defaultSkinJs = $this->backendDefaultSkinJs = $settingsDirectories->backend_default_skin_js;
			$this->defaultSkinImages = $this->backendDefaultSkinImages = $settingsDirectories->backend_default_skin_images;
			
			$this->defaultSkinUrl = $this->backendDefaultSkinUrl = $settingsURLs->backend_default_skin;
			$this->defaultThemeSkinUrl = $this->backendDefaultThemeSkinUrl = $settingsURLs->backend_default_theme_skin;
			$this->defaultSkinCssUrl = $this->backendDefaultSkinCssUrl = $settingsURLs->backend_default_skin_css;
			$this->defaultSkinJsUrl = $this->backendDefaultSkinJsUrl = $settingsURLs->backend_default_skin_js;
			$this->defaultSkinImagesUrl = $this->backendDefaultSkinImagesUrl = $settingsURLs->backend_default_skin_images;
			$this->defaultThemeUrl = $this->backendDefaultThemeUrl = $settingsURLs->backend_default_theme;
		}
		
		return $this;
	}
	
	public function __($text) {
		return $this->translation->_ ( $text );
	}
	
	public function &arrayToObject(&$array) {
		foreach ( $array as $key => $value ) {
			if (is_array ( $value )) {
				$array [$key] = $this->arrayToObject ( $value );
			}
		}
		$array = ( object ) $array;
		return $array;
	}
	
	public function render($template = NULL) {
		if (is_null ( $template )) {
			echo '<br />' . $this->templateController . '/' . $this->templateAction;
			exit ();
		
		//@TODO
		}
		chdir ( $this->defaultThemeTemplate );
		
		//echo $this->fc->request->package . DIRECTORY_SEPARATOR . $this->fc->request->controller . DIRECTORY_SEPARATOR . substr($this->fc->request->action, 0, -6);
		//include $this->fc->request->package . DIRECTORY_SEPARATOR . $this->fc->request->controller . DIRECTORY_SEPARATOR . substr($this->fc->request->action, 0, -6);
		include ($this->defaultThemeTemplate . $template);
		
		return $this;
	}
	
	public function load($template = NULL) {
		if (is_null ( $template )) {
			echo '<br />' . $this->templateController . '/' . $this->templateAction;
			exit ();
		
		//@TODO
		}
		return file_get_contents ( $this->defaultThemeTemplate . $template );
	}
	
	public function subString($message, $start, $length, $unicode = 'UTF-8') {
		return mb_substr ( $message, $start, $length, $unicode );
	}
	
	public function cleanHtml($message) {
		return stripslashes ( html_entity_decode ( stripcslashes ( $message ), ENT_NOQUOTES, 'UTF-8' ) );
	}
	
	public function renderMenu($menuTree) {
		static $padding = 20;
		foreach ( $menuTree as $key => &$value ) {
			if (! array_key_exists ( 'tree', $value )) {
				$noUnderLine = NULL;
				if ($value ['parent_id'] != 0) {
					$noUnderLine = 'style="background:none;"';
				}
				$target = ($value ['label'] == 'استعرض الكتاب') ? 'target ="_blank"' : '';
				echo '<li ' . $noUnderLine . '><span class="circlbg"><a ' . $target . ' href="' . $value ['link'] . '">' . $value ['label'] . '</a></span></li>';
			} else {
				echo '<li><span class="circlbg"><a href="javascript:void(0);">' . $value ['label'] . '</a></span><div class="lst"><ul  style="margin-right: 20px;" class="lst">';
				$this->drawMenu ( $value ['tree'] );
				echo '</ul></div></li>';
			}
		}
		$padding += 20;
	}
}






