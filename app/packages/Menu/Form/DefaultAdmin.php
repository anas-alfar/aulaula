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
 * @name Menu_Form_DefaultAdmin
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Menu_Form_DefaultAdmin extends Zend_Dojo_Form
{
	public $view = NULL;
	private $_selectMenuTypeOptions, $_selectMenuOptions = array( );
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getMenuTypeOptions() {
		$menuTypeObj 		= new Menu_Model_Type();
		$this -> _selectMenuTypeOptions = array (0 => $this -> view -> __('Root'));
		$menuTypeObjResult 	= $menuTypeObj -> select() -> query() -> fetchAll();
		if (!empty($menuTypeObjResult)) {
			foreach ($menuTypeObjResult as $key => $value) {
				$this->_selectMenuTypeOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectMenuTypeOptions;
	}

	/*
	private function _getMenuOptions() {
		$menuObj 		= new Menu_Model_Default();
		$this -> _selectMenuOptions = array (0 => $this -> view -> __('Root'));
		$menuObjResult 	= $menuObj -> select() -> query() -> fetchAll();
		if (!empty($menuObjResult)) {
			foreach ($menuObjResult as $key => $value) {
				$this->_selectMenuOptions[$value['id']] = $value['label'];
			}
		}
		return $this->_selectMenuOptions;
	}
	*/
	
    public function init()
    {
		Zend_Dojo::enableForm($this);
		$this->translateValidators = array(
			Zend_Validate_NotEmpty	  ::IS_EMPTY 	=> $this-> view -> __ ( 'Value must be entered'),
            Zend_Validate_Regex		  ::NOT_MATCH 	=> $this-> view -> __ ( 'Invalid value entered'),
            Zend_Validate_StringLength::TOO_SHORT 	=> $this-> view -> __ ( 'Value cannot be less than %min% characters'),
            Zend_Validate_StringLength::TOO_LONG 	=> $this-> view -> __ ( 'Value cannot be longer than %max% characters'),
            Zend_Validate_EmailAddress::INVALID 	=> $this-> view -> __ ( 'Invalid e-mail address'),
			
			);
	    $this->translator = new Zend_Translate('array', $this->translateValidators);
    	Zend_Validate_Abstract::setDefaultTranslator($this->translator);	

        $this->setMethod('post');
		$this->setAction('');
        $this->setAttrib('name'	, 'add-edit');
		$this->setAttrib('id'	, 'add-edit');
		//$this->setAttrib('onSubmit', 'alert("hhhhh")');
		//$this->setAttrib('dojoType', "dijit.form.Form DijitForm");

		$this->setDecorators(array(
		'FormElements',
		array('TabContainer', array(
				'id' 			=> 'tabContainer',
				'style' 		=> 'width:500px;height:500px;',
				'dijitParams' 	=> array('tabPosition' => 'right')
				)),
			'DijitForm'
		));
		
        $mandatoryForm= new Zend_Dojo_Form_SubForm();
        $mandatoryForm->setAttribs(array(
                'name'			=> 'mandatory',
                'legend' 		=> 'mandatory',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Menu_Information' ),
                )
        ));
        $mandatoryForm->addElement(
                'TextBox',
                'label',
                array(
                    'label' 	=> $this-> view -> __ ( 'Menu_Label' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    /*'validators'    => array(
                		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true, 'options' => array('messages' => array(
                    		'isEmpty' => 'Custom: No Value Entered'
                    	))),
                		array('validator' => 'StringLength', 'options' => array(6, 8, 'messages' => array(
                    		'stringLengthTooShort'  => 'Custom: Too Short - Must contain at least %min% characters',
                    		'stringLengthTooLong'   => 'Custom: Too Long - Must not contain more than %max% characters'
                    	))),
                    	array('validator' => 'EmailAddress')
                	)*/
                )
            );
       $mandatoryForm->addElement(
                'ValidationTextBox',
                'link',
                array(
                    'label' 	=> $this-> view -> __ ( 'Menu_Link' ),
                    'trim'		=> true,
                    'required' 	=> true,
                    //'regExp' 	=> "(https?|ftp)://[A-Za-z0-9-_]+\.[A-Za-z0-9-_%&\?\/\.=]+",
                    'class' 	=> 'lablvalue jstalgntop',
                    //'invalidMessage' => 'Invalid Email Address.',
                    //'promptMessage'  => 'Enter '. $this-> view -> __ ( 'Menu_Link' ),
                    /*'validators'     => array(
                    	array('validator' => 'EmailAddress')
                    )*/
                )
            );
        $mandatoryForm->addElement(
            'FilteringSelect',
            'menu_type_id',
            array(
                'label' => $this-> view -> __ ( 'Menu_Type' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                'multiOptions' => $this->_getMenuTypeOptions(),
                'id' => 'menu_type_id',
				'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('menu_type_id').getValue();return true",
            )
        );
        $mandatoryForm->addElement(
            'FilteringSelect',
            'parent_id',
            array(
                'label' => $this-> view -> __ ( 'Menu_Parent' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                //'multiOptions' => $this->_getMenuOptions(),
                'id' => 'parent_id',
				'storeId' => 'myData',
				'storeType'=> 'dojo.data.ItemFileReadStore',
             	'storeParams' => array( 'url' => '/admin/handle/pkg/menu/action/records/',),
             	'dijitParams' => array( 'searchAttr' => '0' ),
                //'readOnly' => true,
            )
        );
        $mandatoryForm->addElement(
                'NumberTextBox',
                'order',
                array(
                    'label' 	=> $this-> view -> __('Menu_Order'),
                    'required' 	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 1000,
                        'places'=> 0,
                    )
                )
            );
		$mandatoryForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __('Menu_Published'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __('Menu_Approved'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
        $mandatoryForm->addElement(
                'hidden',
                'id'
		);
        $mandatoryForm->addElement(
				'SubmitButton',
				'submit',
				array(
					'value'		=> 'submit',
					'label' 	=> $this-> view -> __ ( 'Menu_Save' ),
					'type'	 	=> 'Submit',
					'ignore'	=> true,
					'onclick' 	=> 'dijit.byId("add-edit").submit()',
				)
		);
		$mandatoryForm->addElement(
				'reset', 
				'reset',
				array(
					'label' => 'Reset',
					'id'	=> 'reset',
					'ignore'=> true,
				)
		);

        $optionalForm = new Zend_Dojo_Form_SubForm();
        $optionalForm->setAttribs(array(
                    'name' 	 => 'optional',
                    'legend' => $this-> view -> __ ( 'Menu_Advanced Settings' ),
                ));
        $optionalForm->addElement(
                'DateTextBox',
                'publish_from',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __('Menu_Publish From'),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
            );
        $optionalForm->addElement(
                'DateTextBox',
                'publish_to',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __('Menu_Publish To'),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
            );
        $optionalForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Menu_Comments' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
            );
        $optionalForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Menu_Options' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
            );


		$mandatoryForm  ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$optionalForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

        $mandatoryForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$optionalForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));

        $this->addSubForm($mandatoryForm, 'mandatory')
             ->addSubForm($optionalForm , 'optional');
				
    }
}