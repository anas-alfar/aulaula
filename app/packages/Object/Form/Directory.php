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
 * @package Aula_Object
 * @subpackage Form
 * @name Object_Form_Directory
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Form_Directory extends Zend_Dojo_Form
{
	public $view = NULL;
	private $_selectCategoryOptions, $_selectSourceOptions, $_selectTypeOptions, $_selectObjectOptions, $_selectDirectoryOptions = array();
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getCategoryOptions() {
		$categoryObj 	= new Category_Model_Default();
		$this -> _selectCategoryOptions = array (0 => $this -> view -> __('Root'));
		$categoryObjResult 	= $categoryObj -> select() -> query() -> fetchAll();
		if (!empty($categoryObjResult)) {
			foreach ($categoryObjResult as $key => $value) {
				$this->_selectCategoryOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectCategoryOptions;
	}
	
	private function _getSourceOptions() {
		$sourceObj 	= new Object_Model_Source();
		$this -> _selectSourceOptions = array (0 => $this -> view -> __('Root'));
		$sourceObjResult 	= $sourceObj -> select() -> query() -> fetchAll();
		if (!empty($sourceObjResult)) {
			foreach ($sourceObjResult as $key => $value) {
				$this->_selectSourceOptions[$value['id']] = $value['name'];
			}
		}
		return $this->_selectSourceOptions;
	}

	private function _getTypeOptions() {
		$typeObj 	= new Object_Model_Type();
		$this -> _selectTypeOptions = array (0 => $this -> view -> __('Root'));
		$typeObjResult 	= $typeObj -> select() -> query() -> fetchAll();
		if (!empty($typeObjResult)) {
			foreach ($typeObjResult as $key => $value) {
				$this->_selectTypeOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectTypeOptions;
	}

	private function _getObjectOptions() {
		$defaultObj 	= new Object_Model_Default();
		$this -> _selectObjectOptions = array (0 => $this -> view -> __('Root'));
		$objObjResult 	= $defaultObj -> select() -> where('`parent_id` = 0') -> query() -> fetchAll();
		if (!empty($objObjResult)) {
			foreach ($objObjResult as $key => $value) {
				$this->_selectObjectOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectObjectOptions;
	}
	
	private function _getDirectoryOptions() {
		$directoryObj = new Object_Model_Directory();
		$this -> _selectDirectoryOptions = array(0 => $this -> view -> __('Root'));
		$sdirectoryObjResult = $directoryObj -> select() -> query() -> fetchAll();
		if (!empty($sdirectoryObjResult)) {
			foreach ($sdirectoryObjResult as $key => $value) {
				$this -> _selectDirectoryOptions[$value['id']] = $value['name'];
			}
		}
		return $this -> _selectDirectoryOptions;
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
                    'title' 	=> $this-> view -> __ ( 'Object_Folders' ),
                )
        ));
        $mandatoryForm->addElement(
                'TextBox',
                'title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Title' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
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
                'label',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Label' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $mandatoryForm->addElement(
                'Textarea',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Description' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'style'		=> 'height:40px'
                )
        );
        $mandatoryForm->addElement(
	            'FilteringSelect',
	            'directory_parent_id',
	            array(
	                'label' => $this-> view -> __ ( 'Object_Parent' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getDirectoryOptions(),
	                'id' => 'directory_parent_id',
	            )
        );
        $mandatoryForm->addElement(
                'TextBox',
                'full_path',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Full Path' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $mandatoryForm->addElement(
                'NumberTextBox',
                'size',
                array(
                    'label' 	=> $this-> view -> __( 'Object_Size' ),
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 1000000,
                        'places'=> 0,
                    )
                )
        );
        $mandatoryForm->addElement(
                'NumberTextBox',
                'files_count',
                array(
                    'label' 	=> $this-> view -> __( 'Object_Files Count' ),
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 1000000,
                        'places'=> 0,
                    )
                )
        );        
		
		$mandatoryForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __( 'Object_Published' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __( 'Object_Approved' ),
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
					'label' 	=> $this-> view -> __ ( 'Object_Save' ),
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
                    'legend' => $this-> view -> __ ( 'Object_Advanced' ),
        ));
        $optionalForm->addElement(
	            'FilteringSelect',
	            'category_id',
	            array(
	                'label' => $this-> view -> __ ( 'Object_Category' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getCategoryOptions(),
	                'id' => 'category_id',
					//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
	            )
        );
        $optionalForm->addElement(
	            'FilteringSelect',
	            'object_source_id',
	            array(
	                'label' => $this-> view -> __ ( 'Object_Source' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getSourceOptions(),
	                'id' => 'object_source_id',
					//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
	            )
        );
        $optionalForm->addElement(
	            'FilteringSelect',
	            'object_type_id',
	            array(
	                'label' => $this-> view -> __ ( 'Object_Type' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getTypeOptions(),
	                'id' => 'object_type_id',
					//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
	            )
        );
        $optionalForm->addElement(
	            'FilteringSelect',
	            'parent_id',
	            array(
	                'label' => $this-> view -> __ ( 'Parent' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getObjectOptions(),
	                'id' => 'object_id',
					//'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
	            )
        );
        $optionalForm->addElement(
                'TextBox',
                'guid_url',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_GUID URL' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
		);
        $optionalForm->addElement(
                'TextBox',
                'original_author',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Original Author' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
		);
        $optionalForm->addElement(
                'DateTextBox',
                'created_date',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __( 'Object_Created Date' ),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
        );
        $optionalForm->addElement(
                'TextBox',
                'tags',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Tags' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
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
		$optionalForm->addElement(
            'CheckBox',
            'show_in_object',
            array(
                'label' 		=> $this-> view -> __( 'Show_In_Object' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$optionalForm->addElement(
            'CheckBox',
            'show_in_list',
            array(
                'label' 		=> $this-> view -> __( 'Show_In_List' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );


		$metaForm = new Zend_Dojo_Form_SubForm();
        $metaForm->setAttribs(array(
                    'name' 	 => 'optional',
                    'legend' => $this-> view -> __ ( 'Object_Meta Data' ),
        ));
        $metaForm->addElement(
                'TextBox',
                'page_title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Page Title' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Meta Title' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_key',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Meta Keywords' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_desc',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Meta Description' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_data',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Meta Data' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );


		$mandatoryForm  ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$optionalForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$metaForm		->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

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
		$metaForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		

        $this->addSubForm($mandatoryForm, 'mandatory')
             ->addSubForm($optionalForm , 'optional')
			 ->addSubForm($metaForm 	, 'meta');
				
    }
}