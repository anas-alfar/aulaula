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
 * @package Object
 * @subpackage Form
 * @name Object_Form_AddSource
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Form_AddSource extends Zend_Dojo_Form
{
	public $view = NULL;
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getLocaleAvailabe() {
		$localeObj = new Locale_Model_Default();
		$localeObjResult 	= $localeObj -> getAllApprovedLocale();
		return $localeObjResult;
	}
	
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

		$this->setDecorators(array(
		'FormElements',
		array('TabContainer', array(
				'id' 			=> 'tabContainer',
				'style' 		=> 'width:500px;height:500px;',
				'dijitParams' 	=> array('tabPosition' => 'right')
				)),
			'DijitForm'
		));
		
		
		$flag = true;
		foreach ($this->_getLocaleAvailabe() as $id => $value) {
		
        $mandatoryForm= new Zend_Dojo_Form_SubForm();
        $mandatoryForm->setAttribs(array(
                'name'			=> $value['id'],  //'mandatory',
                'legend' 		=> 'mandatory',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( $value['title'] . ' ' . 'Object_Source' ),
                )
        ));
        $mandatoryForm->addElement(
                'TextBox',
                'name',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Name' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );        
        $mandatoryForm->addElement(
                'TextBox',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Description' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $mandatoryForm->addElement(
                'TextBox',
                'source_type',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Source Type' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
       $mandatoryForm->addElement(
                'ValidationTextBox',
                'url',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_URL' ),
                    'trim'		=> true,
                    'required' 	=> true,
                    'regExp' 	=> "(https?|ftp)://[A-Za-z0-9-_]+\.[A-Za-z0-9-_%&\?\/\.=]+",
                    'class' 	=> 'lablvalue jstalgntop',
                    //'invalidMessage' => 'Invalid Email Address.',
                    'promptMessage'  => 'Enter '. $this-> view -> __ ( 'Object_URL' ),
                    /*'validators'     => array(
                    	array('validator' => 'EmailAddress')
                    )*/
                )
        );
        $mandatoryForm->addElement(
                'NumberTextBox',
                'order',
                array(
                    'label' 	=> $this-> view -> __('Object_Order'),
                    'required' 	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 10000,
                        'places'=> 0,
                    )
                )
        );
        $mandatoryForm->addElement(
                'NumberTextBox',
                'time_delay',
                array(
                    'label' 	=> $this-> view -> __('Object_Time Delay'),
                    'required' 	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 10000,
                        'places'=> 0,
                    )
                )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __('Object_Published'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __('Object_Approved'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		
		if ($flag === true) {
	        $mandatoryForm->addElement(
	                'hidden',
	                'id'
			);
	        $mandatoryForm->addElement(
					'SubmitButton',
					'submit',
					array(
						'value'		=> 'submit',
						'label' 	=> $this-> view -> __ ( 'Object_Save' ),
						'type'	 	=> 'Submit',
						'ignore'	=> true,
						'onclick' 	=> 'dijit.byId("add-edit").submit()',
					)
			);
			$flag = false;
		}


        $optionalForm = new Zend_Dojo_Form_SubForm();
        $optionalForm->setAttribs(array(
                    'name' 	 => 'optional_' . $value['id'],
                    'legend' => $this-> view -> __ ( $value['title'] . ' ' . 'Object_Advanced' ),
        ));
        $optionalForm->addElement(
                'DateTextBox',
                'publish_from',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __('Object_Publish From'),
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
					'label' 	 => $this -> view -> __('Object_Publish To'),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
        );
        $optionalForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Comments' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
		);
        $optionalForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Options' ),
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


        $this->addSubForm($mandatoryForm, $value['id'])
             ->addSubForm($optionalForm , 'optional_' . $value['id']);
		}
    }
}