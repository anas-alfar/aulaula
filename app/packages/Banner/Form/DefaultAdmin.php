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
* @package Aula_Banner_Form_Default
* @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
* @author Anas K. Al-Far <anas@al-far.com>
*
*/

class Banner_Form_DefaultAdmin extends Zend_Dojo_Form
{
	public $view = NULL;
	private $_selectBannerAreaOptions = array( );
	private $_bannerTypeOptions = array( 'image url'=>'image url','image file'=>'image file','swf file'=>'swf file','swf object'=>'swf object','javascript code'=>'javascript code' );
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getBannerAreaOptions() {
		$bannerAreaObj 		= new Banner_Model_Area();
		$this -> _selectBannerAreaOptions = array (0 => $this -> view -> __('Root'));
		$bannerAreaObjResult 	= $bannerAreaObj -> select() -> query() -> fetchAll();
		if (!empty($bannerAreaObjResult)) {
			foreach ($bannerAreaObjResult as $key => $value) {
				$this->_selectBannerAreaOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectBannerAreaOptions;
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
		$this->setAttrib('enctype', 'multipart/form-data');

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
                    'title' 	=> $this-> view -> __ ( 'Banner_Information' ),
                )
        ));
        $mandatoryForm->addElement(
                'TextBox',
                'title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Banner_Title' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
		);
        $mandatoryForm->addElement(
                'TextBox',
                'label',
                array(
                    'label' 	=> $this-> view -> __ ( 'Banner_Label' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
		);
        $mandatoryForm->addElement(
	            'FilteringSelect',
	            'banner_area_id',
	            array(
	                'label' => $this-> view -> __ ( 'Banner_Area' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this-> _getBannerAreaOptions(),
	                'id' => 'banner_area_id',
					//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
	            )
        );
        $mandatoryForm->addElement(
	            'FilteringSelect',
	            'type',
	            array(
	                'label' => $this-> view -> __ ( 'Banner_Type' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this-> _bannerTypeOptions,
	                'id' => 'type',
					//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
					'onchange' => 'field(this.value)',
	            )
        );
        $mandatoryForm->addElement(
                'Textarea',
                'context',
                array(
                    'label' 	=> $this-> view -> __ ( 'image url' ),
                    'trim' 		=> true,
                    //'required'	=> true,
                    'id'		=> 'context',
                    'class' 	=> 'lablvalue jstalgntop',
                )
		);
		$mandatoryForm->addElement(
				'file', 
				'uploadFile', 
				array(
					//'required'	=> true,
					'id'		=> 'uploadFile',
			    	'label'     => $this -> view -> __ ( 'Object_Photo' ),
			    	'validators'=> array(
			    		array('ExcludeExtension', false, array('php', 'exe', 'case' => true)),
			        	//array('Count', false, array('min'=>1, 'max'=>3)),
			        	//array('Size', false, 209715200),
			        	//array('Extension', false, 'jpg,png,gif,jpeg,x-png')
			    	),
			    //'multiFile'=>3,
			    //'maxFileSize' => 2048,
			    //'destination'=>APPLICATION_PATH . '/tmp'
				)
		);	
		
		$mandatoryForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __('Banner_Published'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __('Banner_Approved'),
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
					'label' 	=> $this-> view -> __ ( 'Banner_Save' ),
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
                    'legend' => $this-> view -> __ ( 'Banner_Advanced' ),
                ));
        $optionalForm->addElement(
                'DateTextBox',
                'publish_from',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __('Banner_Publish From'),
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
					'label' 	 => $this -> view -> __('Banner_Publish To'),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
            );
        $optionalForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Banner_Comments' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
            );
        $optionalForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Banner_Options' ),
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
		$mandatoryForm->getElement('uploadFile')-> setDecorators(
	    array(
	        'File',
	        'Errors',
	        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
	    	)
		);

        $this->addSubForm($mandatoryForm, 'mandatory')
             ->addSubForm($optionalForm , 'optional');
				
    }
}