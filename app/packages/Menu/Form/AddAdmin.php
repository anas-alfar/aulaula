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
 * @package Menu
 * @subpackage Form
 * @name Menu_Form_AddAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Menu_Form_AddAdmin extends Zend_Dojo_Form {
	public $view = NULL;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct ();
	}
	
	public function init() {
		$this->setAction ( '' );
		$this->setMethod ( 'post' );
		$this->setAttrib ( 'id', 'registration' );
		
		$this->setDecorators ( array ('FormElements', array ('TabContainer', array ('id' => 'tabContainer', 'style' => 'width:100%;height:400px;', 'dijitParams' => array ('tabPosition' => 'right' ) ) ), 'DijitForm' ) );
		
		$subForm0 = new Zend_Dojo_Form_SubForm ();
		
		$subForm0->setLegend ( $this->view->__ ( 'Menu_Information' ) );
		$subForm0->setAttrib ( 'dijitParams', array ('class' => 'tab active' ) );
		
		$registerName = new Zend_Dojo_Form_Element_TextBox ( 'name' );
		
		$registerName->setValidators ( array (array ('alpha', false, false ), array ('StringLength', false, array (3, 20 ) ) ) )->setOrder ( 1 )->setLabel ( $this->view->__ ( 'Menu_Label' ) )->setRequired ( true );
		
		$subForm0->addElement ( $registerName );
		
		$email = new Zend_Dojo_Form_Element_TextBox ( 'email' );
		$email->setRequired ( true )->addValidator ( 'EmailAddress', false, false /*array(
		          'messages' => array('emailAddressLengthExceeded' => 
		                                  'length is too long!', 
		                              'emailAddressDotAtom' => 
		                              'dot problem!'))*/)->setOrder ( 2 )->setLabel ( $this->view->__ ( 'Menu_Link' ) );
		
		$subForm0->addElement ( $email );
		
		$mobile = new Zend_Dojo_Form_Element_TextBox ( 'mobile' );
		$mobile->setRequired ( true )->setValidators ( array (array ('Alnum', false, false ), array ('StringLength', false, array (10, 20 ) ) ) )->setOrder ( 3 )->setLabel ( $this->view->__ ( 'Menu_Parent' ) );
		
		$subForm0->addElement ( $mobile );
		
		$subForm1 = new Zend_Dojo_Form_SubForm ();
		$subForm1->setLegend ( 'Personal Information' );
		$subForm1->setAttrib ( 'dijitParams', array ('tapPosition' => 'top' ) );
		
		$selectGender = new Zend_Dojo_Form_Element_ComboBox ( 'gender' );
		$selectGender->addMultiOption ( 'm', 'Male' )->addMultiOption ( 'f', 'Female' )->setRequired ( true )->setLabel ( $this->view->__ ( 'Menu_Type' ) );
		
		$subForm1->addElement ( $selectGender );
		
		$subForm2 = new Zend_Dojo_Form_SubForm ();
		$subForm2->setLegend ( 'Interests' );
		$subForm2->setAttrib ( 'dijitParams', array ('tapPosition' => 'top' ) );
		
		$industry = $this->createElement ( 'select', 'industry' );
		$industry->addMultiOption ( 'it', 'Information Technology' )->addMultiOption ( 'eng', 'Engineering' )->addMultiOption ( 'edu', 'Education' )->setRequired ( true )->setLabel ( 'Industry' );
		
		$favoriteSite = new Zend_Form_Element_MultiCheckbox ( 'favoriteSite' );
		
		$favoriteSite->addMultiOption ( 'fb', 'Facebook' )->addMultiOption ( 'tw', 'Twitter' )->addMultiOption ( 'goo', 'Google' )->addMultiOption ( 'ya', 'Yahoo!' )->setRequired ( true )->setLabel ( 'Favorite Site' );
		
		$iHaveFbAccount = new Zend_Form_Element_Radio ( 'iHaveFbAccount' );
		$iHaveFbAccount->addMultiOption ( 'yes', 'Yes' )->addMultiOption ( 'no', 'No' )->setRequired ( true )->setLabel ( 'I\'ve Facebook account?' );
		
		$subForm2->addElement ( $industry );
		$subForm2->addElement ( $favoriteSite );
		$subForm2->addElement ( $iHaveFbAccount );
		
		$subForm3 = new Zend_Dojo_Form_SubForm ();
		$subForm3->setLegend ( 'Account Setting' );
		$subForm3->setAttrib ( 'dijitParams', array ('Text Elements3' ) );
		
		$password = new Zend_Dojo_Form_Element_PasswordTextBox ( 'password' );
		$password->setLabel ( 'Password' )->setRequired ( true )->setValidators ( array (array ('StringLength', 6, 16 ) ) );
		$subForm3->addElement ( $password );
		
		$userName = new Zend_Dojo_Form_Element_TextBox ( 'username' );
		$userName->setLabel ( 'Username' )->setRequired ( true )->setValidators ( array (array ('alnum', true, true ), array ('StringLength', 3, 20 ) ) )->setOrder ( 1 );
		;
		
		$subForm3->addElement ( $userName );
		
		$submit = new Zend_Dojo_Form_Element_SubmitButton ( 'registerSubmit' );
		$submit->setLabel ( 'Register' )->setRequired ( true )->setOrder ( 4 );
		
		$this->addSubForm ( $subForm0, 'sub0' );
		$this->addSubForm ( $subForm1, 'sub1' );
		$this->addSubForm ( $subForm2, 'sub2' );
		$this->addSubForm ( $subForm3, 'sub3' );
		$this->addElement ( $submit );
	
	}
}
