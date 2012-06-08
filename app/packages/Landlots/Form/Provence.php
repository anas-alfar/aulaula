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
 * in the future. If you wish to customize Magento for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Aula_Landlots
 * @subpackage Form
 * @name Landlots_Form_Provence
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Landlots_Form_Provence extends Zend_Dojo_Form
{
	public $view = NULL;
	private $_selectLandlotsLocationOptions = array();
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
	
	private function _getLandlotsLocationOptionsByLocaleId($locale_id) {
		$landlotsLocationObj = new Landlots_Model_Location();
		$this -> _selectLandlotsLocationOptions = array ('' => $this -> view -> __('Root'));
		$landlotsLocationObjResult 	= $landlotsLocationObj -> select() -> where('locale_id=?',$locale_id) -> query() -> fetchAll();
		if (!empty($landlotsLocationObjResult)) {
			foreach ($landlotsLocationObjResult as $key => $value) {
				$this->_selectLandlotsLocationOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectLandlotsLocationOptions;
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
                'name'			=>  $value['id'],
                //'legend' 		=>  $id,
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( $value['title'] . ' Landlots_Information' ),
                )
        ));
        $mandatoryForm->addElement(
                'ValidationTextBox',
                'title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Landlots_Title' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    //'promptMessage'  => 'Enter '. $this-> view -> __ ( 'Menu_Link' ),
                )
		);
        $mandatoryForm->addElement(
                'ValidationTextBox',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Landlots_Description' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $mandatoryForm->addElement(
            'FilteringSelect',
            'landlots_location_id_'.$value['id'],
            array(
                'label' => $this-> view -> __ ( 'Landlots_Location' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                'required'	=> true,
                //'validator' => array('NotEmpty', true),
                'multiOptions' => $this->_getLandlotsLocationOptionsByLocaleId($value['id']),
                'id' => 'landlots_location_id_'.$value['id'],
				//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
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
					'label' 	=> $this-> view -> __ ( 'Landlots_Save' ),
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
                    'legend' => $this-> view -> __ ( $value['title'] . ' Landlots_Advanced Settings' ),
                ));
        $optionalForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Landlots_Comments' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
            );
        $optionalForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Landlots_Options' ),
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