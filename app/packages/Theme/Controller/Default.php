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
 * @package Theme
 * @subpackage Controller
 * @name Theme_Controller_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Theme_Controller_Default extends Aula_Controller_Action {
	
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $layoutInfoObj = NULL;
	private $skinObj = NULL;
	private $skinInfoObj = NULL;
	private $templateObj = NULL;
	private $templateInfoObj = NULL;
	
	protected function _init() {
		$this->themeObj = new Theme_Model_Default ();
		$this->templateObj = new Theme_Model_Template ();
		$this->layoutObj = new Theme_Model_Layout ();
		$this->skinObj = new Theme_Model_Skin ();
		
		$this->defualtAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'themeId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'template' => array ('numeric', 1 ), 'layout' => array ('numeric', 1 ), 'skin' => array ('numeric', 1 ), 'publishFrom' => array ('shortDateTime', 0 ), 'publishTo' => array ('shortDateTime', 0 ), 'comment' => array ('text', 0, $this->themeObj->comments ), 'option' => array ('text', 0, $this->themeObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//template list
		$this->templateList = '';
		$this->templateListResult = $this->templateObj->getAllTheme_templateOrderById ();
		if (! empty ( $this->templateListResult )) {
			foreach ( $this->templateListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['template'] ['value']) ? 'selected="selected"' : '';
				$this->templateList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->templateList = $this->templateList;
		
		//layout list
		$this->layoutList = '';
		$this->layoutListResult = $this->layoutObj->getAllTheme_layoutOrderById ();
		if (! empty ( $this->layoutListResult )) {
			foreach ( $this->layoutListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['layout'] ['value']) ? 'selected="selected"' : '';
				$this->layoutList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->layoutList = $this->layoutList;
		
		//skin list
		$this->skinList = '';
		$this->skinListResult = $this->skinObj->getAllTheme_skinOrderById ();
		if (! empty ( $this->skinListResult )) {
			foreach ( $this->skinListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['skin'] ['value']) ? 'selected="selected"' : '';
				$this->skinList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->skinList = $this->skinList;
	}
	
	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}
	
	public function previewAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}
	
	public function saveAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit ();
	}

}
