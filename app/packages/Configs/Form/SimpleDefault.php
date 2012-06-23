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
 * @package Configs
 * @subpackage Form
 * @name Configs_Form_SimpleDefault
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Configs_Form_SimpleDefault extends Zend_Dojo_Form
{
	public $view = NULL;
	private $translator, $_selectLocaleOptions, $_selectConfigOptions, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getLocaleOptions() {
		$localeObj 	= new Locale_Model_Default();
		$this -> _selectLocaleOptions = array ('' => $this -> view -> __('Root'));
		$localeObjResult 	= $localeObj -> getAllLocale();
		if (!empty($localeObjResult)) {
			foreach ($localeObjResult as $key => $value) {
				$this->_selectLocaleOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectLocaleOptions;
	}
	
	private function _getConfigOptions() {
		$configsObj 	= new Configs_Model_Default();
		$this -> _selectConfigOptions = array ('' => $this -> view -> __('Root'));
		$configsObjResult 	= $configsObj -> getAllConfigs();
		if (!empty($configsObjResult)) {
			foreach ($configsObjResult as $key => $value) {
				$this->_selectConfigOptions[$value['group_id']] = $value['group_key'];
			}
		}
		return $this->_selectConfigOptions;
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
		$this->setAttrib('onSubmit' , 'return this.validate();');

		$this->setDecorators(array(
		'FormElements',
		array('TabContainer', array(
				'id' 			=> 'tabContainer',
				'style' 		=> 'width:500px;height:500px;',
				'dijitParams' 	=> array('tabPosition' => 'right')
				)),
			'DijitForm'
		));
    }

	public function addConfigSubForm($number, $data) {
        $configsForm= new Zend_Dojo_Form_SubForm();
        $configsForm->setAttribs(array(
            'name'			=> 'mandatory',
            'legend' 		=> 'mandatory',
            'dijitParams' 	=> array(
                'title' 	=> $this-> view -> __ ( 'Configs' . '-' . $data['group_key'] . '-' . $data['option_title'] ),
            )
        ));
        $configsForm->addElement(
            'FilteringSelect',
            'group_id',
            array(
                'label' => $this-> view -> __ ( 'Configs_Group Key' ),
                'required'	=> true,
                'value'		=> '',
                'multiOptions' => $this->_getConfigOptions(),
            )
        );
        $configsForm->addElement(
            'ValidationTextBox',
            'option_type',
            array(
                'label' 	=> $this-> view -> __ ( 'Configs_Option Type If Exist' ),
                'trim' 		=> true,
                'required'	=> false,
                'name'		=> 'option_type',
                'class' 	=> 'lablvalue jstalgntop',
            )
        );    
        $configsForm->addElement(
            'ValidationTextBox',
            'option_title',
            array(
                'label' 	=> $this-> view -> __ ( 'Configs_Option Title' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $configsForm->addElement(
            'ValidationTextBox',
            'option_value',
            array(
                'label' 	=> $this-> view -> __ ( 'Configs_Option Value' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
		$configsForm->addElement(
            'select',
            'option_status',
            array(
                'label' 		=> $this-> view -> __('Configs_Option Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => array('' => $this -> view -> __('Root'), 0 => 'Disabel', 1 => 'Enabel'),
            )
        );
        $configsForm->addElement(
            'FilteringSelect',
            'locale_id',
            array(
                'label' => $this-> view -> __ ( 'Configs_Locale' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                'required'	=> true,
                'multiOptions' => $this->_getLocaleOptions(),
            )
        );
        $configsForm->addElement(
            'ValidationTextBox',
            'option_hint',
            array(
                'label' 	=> $this-> view -> __ ( 'Configs_Option Hint' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $configsForm->addElement(
            'ValidationTextBox',
            'option_description',
            array(
                'label' 	=> $this-> view -> __ ( 'Configs_Option Description' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $configsForm->addElement(
            'ValidationTextBox',
            'comments',
            array(
                'label' 	=> $this-> view -> __ ( 'Configs_Option Comments' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
            	)
		);
        $configsForm->addElement(
            'hidden',
            'id'
		);
        $configsForm->addElement(
            'hidden',
            'group_key'
		);
		
		
        $configsForm->addElement(
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
		$configsForm->addElement(
			'reset', 
			'reset',
			array(
				'label' => 'Reset',
				'id'	=> 'reset',
				'ignore'=> true,
			)
		);

		$configsForm ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
        $configsForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));


        $configsForm->populate($data);
        // add it to the form
        $this->addSubForm($configsForm, 'configs' . $number);
    }

}