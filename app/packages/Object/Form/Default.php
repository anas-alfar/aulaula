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
 * @name Object_Form_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Form_Default extends Zend_Dojo_Form
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
				'style' 		=> 'width:500px;height:600px;',
				'dijitParams' 	=> array('tabPosition' => 'right')
				)),
			'DijitForm'
		));

		// Begin Article Form
        $articleForm = new Zend_Dojo_Form_SubForm();
        $articleForm->setAttribs(array(
                'name'			=> 'article',
                'legend' 		=> 'article',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Object_Article' ),
                )
        ));
        $articleForm->addElement(
                'ValidationTextBox',
                'alias',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Alias' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $articleForm->addElement(
                'ValidationTextBox',
                'intro_text',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Intro Text' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'style'		=> 'height:40px'
                )
        );
        $articleForm->addElement(
                'Textarea',
                'full_text',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Full Text' ),
                    'trim' 		=> true,
                    'cols'		=> 100,
                    'required'	=> true,
                    'rows'		=> 400,
                    'class' 	=> 'lablvalue jstalgntop tinymce',
                    'style'		=> 'height:200px'
                )
        );
        $articleForm->addElement(
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
		$this->addSubForm($articleForm	, 'article');
		// End Article Form


		// Begin Photo Form 1, 2 and 3
		foreach (array(1,2,3) as $value) {
	        $photoForm = new Zend_Dojo_Form_SubForm();
	        $photoForm->setAttribs(array(
	                'name'			=> 'photo_'  . $value,
	                'dijitParams' 	=> array(
	                    'title' 	=> $this-> view -> __ ( 'Object_Photo' ) . ' ' . $value,
	                )
	        ));
	        $photoForm->addElement(
	                'TextBox',
	                'alias',
	                array(
	                    'label' 	=> $this-> view -> __ ( 'Object_Alias' ),
	                    'trim' 		=> true,
	                    'required'	=> true,
	                    'class' 	=> 'lablvalue jstalgntop',
	                )
	        );
	        $photoForm->addElement(
	                'Textarea',
	                'intro_text',
	                array(
	                    'label' 	=> $this-> view -> __ ( 'Object_Intro Text' ),
	                    'trim' 		=> true,
	                    'class' 	=> 'lablvalue jstalgntop',
	                    'style'		=> 'height:40px'
	                )
	        );
	
			$photoForm->addElement(
					'file', 
					'photo_' . $value, 
					array(
						'required'	=> true,
				    	'label'         => $this -> view -> __ ( 'Object_Upload' ),
				    	'id'		=> 'photo_' . $value,
				    	'name'      => 'photo_' . $value,
				    	'validators'    => array(
				        	//array('Count', false, array('min'=>1, 'max'=>3)),
				        	array('Size', false, 209715200),
				        	array('Extension', false, 'jpg,png,gif,jpeg,x-png')
				    	),
				    //'multiFile'=>3,
				    //'maxFileSize' => 2048,
				    //'destination'=>APPLICATION_PATH . '/tmp'
					)
			);
	        $photoForm->addElement(
	                'NumberTextBox',
	                'order',
	                array(
	                    'label' 	=> $this-> view -> __( 'Object_Order' ),
	                    'class' 	=> 'lablvalue jstalgntop',
	                    'invalidMessage'=>'Invalid elevation.',
	                    'constraints' => array(
	                        'min' 	=> 0,
	                        'max'	=> 1000000,
	                        'places'=> 0,
	                    )
	                )
	        );
	        $photoForm->addElement(
	                'TextBox',
	                'taken_location',
	                array(
	                    'label' 	=> $this-> view -> __ ( 'Taken_Location' ),
	                    'trim' 		=> true,
	                    'class' 	=> 'lablvalue jstalgntop',
	                )
	        );
	        $photoForm->addElement(
	                'DateTextBox',
	                'taken_date',
	                array(
	                    'datePattern'=> 'dd-MM-yyyy',
	                    'validators' => array('Date'),
						'label' 	 => $this -> view -> __( 'Object_Taken Date' ),
	                    'trim' 		 => true,
	                    'class' 	 => 'lablvalue jstalgntop'
	                )
	        );
			$photoForm->addElement(
	            'CheckBox',
	            'show_in_object',
	            array(
	                'label' 		=> $this-> view -> __( 'Show_In_Object' ),
	                'checkedValue' 	=> 'Yes',
	                'uncheckedValue'=> 'No',
	            )
	        );
	        $photoForm->addElement(
	                'DateTextBox',
	                'publish_from',
	                array(
	                    'datePattern'=> 'dd-MM-yyyy',
	                    'validators' => array('Date'),
						'label' 	 => $this -> view -> __( 'Object_Publish From' ),
	                    'trim' 		 => true,
	                    'class' 	 => 'lablvalue jstalgntop'
	                )
	        );
	        $photoForm->addElement(
	                'DateTextBox',
	                'publish_to',
	                array(
	                    'datePattern'=> 'dd-MM-yyyy',
	                    'validators' => array('Date'),
						'label' 	 => $this -> view -> __( 'Object_Publish To' ),
	                    'trim' 		 => true,
	                    'class' 	 => 'lablvalue jstalgntop'
	                )
	        );

			$photoForm -> setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
			$photoForm->setElementDecorators(array(
			'DijitElement',
			'Errors',
				array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    	array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
			    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
			));

			$photoForm->getElement('photo_' . $value)-> setDecorators(
	    	array(
	        	'File',
		        'Errors',
		        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
	    	    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        	array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
	    		)
			);

			$this->addSubForm($photoForm 	, 'photo_' . $value);
        }
		// End Photo Form 1, 2 and 3
		
		
		// Begin Video Form
        $videoForm = new Zend_Dojo_Form_SubForm();
        $videoForm->setAttribs(array(
                'name'			=> 'video',
                'legend' 		=> 'video',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Object_Video' ),
                )
        ));
        $videoForm->addElement(
                'TextBox',
                'alias',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Alias' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $videoForm->addElement(
                'Textarea',
                'intro_text',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Intro Text' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'style'		=> 'height:40px'
                )
        );
		$videoForm->addElement(
				'file', 
				'videoThumb', 
				array(
					'required'	=> true,
			    	'label'         => $this -> view -> __ ( 'Object_Photo' ),
			    	'validators'    => array(
			    		array('ExcludeExtension', false, array('php', 'exe', 'case' => true)),
			        	array('Count', false, array('min'=>1, 'max'=>3)),
			        	array('Size', false, 209715200),
			        	array('Extension', false, 'jpg,png,gif,jpeg,x-png')
			    	),
				)
		);
		$videoForm->addElement(
				'file', 
				'video', 
				array(
					'required'	=> true,
			    	'label'         => $this -> view -> __ ( 'Object_Upload' ),
			    	'validators'    => array(
			    		array('ExcludeExtension', false, array('php', 'exe', 'case' => true)),
			        	array('Extension', false, 'flv')
			    	),
				)
		);
        $videoForm->addElement(
                'TextBox',
                'taken_location',
                array(
                    'label' 	=> $this-> view -> __ ( 'Taken_Location' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $videoForm->addElement(
                'NumberTextBox',
                'order',
                array(
                    'label' 	=> $this-> view -> __( 'Object_Order' ),
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 1000000,
                        'places'=> 0,
                    )
                )
        );
        $videoForm->addElement(
                'DateTextBox',
                'taken_date',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __( 'Object_Taken Date' ),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
        );
		$videoForm->addElement(
            'CheckBox',
            'show_in_object',
            array(
                'label' 		=> $this-> view -> __( 'Show_In_Object' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
        $videoForm->addElement(
                'DateTextBox',
                'publish_from',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __( 'Object_Publish From' ),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
        );
        $videoForm->addElement(
                'DateTextBox',
                'publish_to',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __( 'Object_Publish To' ),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
        );
		// End Video Form


		// Begin Source Form
        /*$sourceForm = new Zend_Dojo_Form_SubForm();
        $sourceForm->setAttribs(array(
                'name'			=> 'source',
                'legend' 		=> 'source',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Object_Source' ),
                )
        ));
        $sourceForm->addElement(
                'TextBox',
                'name',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Name' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );        
        $sourceForm->addElement(
                'TextBox',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Description' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $sourceForm->addElement(
                'TextBox',
                'source_type',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Source Type' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
       $sourceForm->addElement(
                'ValidationTextBox',
                'url',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_URL' ),
                    'trim'		=> true,
                    'required' 	=> true,
                    'regExp' 	=> "(https?|ftp)://[A-Za-z0-9-_]+\.[A-Za-z0-9-_%&\?\/\.=]+",
                    'class' 	=> 'lablvalue jstalgntop',
                    'promptMessage'  => 'Enter '. $this-> view -> __ ( 'Object_URL' ),
                )
        );
        $sourceForm->addElement(
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
        $sourceForm->addElement(
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
		$sourceForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __('Object_Published'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$sourceForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __('Object_Approved'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
        $sourceForm->addElement(
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
        $sourceForm->addElement(
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
        $sourceForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Comments' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
		);
        $sourceForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Options' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
		);*/
		// End Source Form


		// Begin File Form
        $fileForm = new Zend_Dojo_Form_SubForm();
        $fileForm->setAttribs(array(
                'name'			=> 'file',
                'legend' 		=> 'file',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Object_Files' ),
                )
        ));
        $fileForm->addElement(
                'TextBox',
                'name',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Name' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $fileForm->addElement(
                'TextBox',
                'label',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Label' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $fileForm->addElement(
                'Textarea',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Description' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                    'style'		=> 'height:40px'
                )
        );
        $fileForm->addElement(
	            'FilteringSelect',
	            'object_directory_id',
	            array(
	                'label' => $this-> view -> __ ( 'Object_Parent' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getDirectoryOptions(),
	                'id' => 'object_directory_id',
	            )
        );
        $fileForm->addElement(
                'TextBox',
                'full_path',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Full Path' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
		$fileForm->addElement(
				'file', 
				'file', 
				array(
					'required'	=> true,
			    	'label'         => $this -> view -> __ ( 'Object_Upload' ),
			    	'validators'    => array(
			    		array('ExcludeExtension', false, array('php', 'exe', 'case' => true)),
			        	array('Size', false, 209715200),
			    	),
				)
		);
        $fileForm->addElement(
                'TextBox',
                'author_id',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Author Id' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
		// End File Form

		
		// Begin Object and Object_info Form
        $optionalForm = new Zend_Dojo_Form_SubForm();
        $optionalForm->setAttribs(array(
                    'name' 	 => 'optional',
                    'legend' => $this-> view -> __ ( 'Object_Advanced' ),
        ));
        $optionalForm->addElement(
                'ValidationTextBox',
                'title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Object_Title' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $optionalForm->addElement(
	            'FilteringSelect',
	            'category_id',
	            array(
	                'label' => $this-> view -> __ ( 'Object_Category' ),
	                'class' => 'lablvalue jstalgntop',
	                'autocomplete'=>false,
	                'multiOptions' => $this->_getCategoryOptions(),
	                'id' => 'category_id',
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
	            )
        );
        $optionalForm->addElement(
                'NumberTextBox',
                'order',
                array(
                    'label' 	=> $this-> view -> __( 'Object_Order' ),
                    'class' 	=> 'lablvalue jstalgntop',
                    'invalidMessage'=>'Invalid elevation.',
                    'constraints' => array(
                        'min' 	=> 0,
                        'max'	=> 1000000,
                        'places'=> 0,
                    )
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
                'DateTextBox',
                'publish_from',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __( 'Object_Publish From' ),
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
					'label' 	 => $this -> view -> __( 'Object_Publish To' ),
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
            'published',
            array(
                'label' 		=> $this-> view -> __( 'Object_Published' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$optionalForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __( 'Object_Approved' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
        $optionalForm->addElement(
                'hidden',
                'id'
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
		// End Object and Object_info Form


		$articleForm  	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$videoForm  	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		//$sourceForm  	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$fileForm  		->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$optionalForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$metaForm		->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

		$articleForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$videoForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		/*$sourceForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));*/
		$fileForm->setElementDecorators(array(
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
		$optionalForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));

		$videoForm->getElement('video')-> setDecorators(
	    array(
	        'File',
	        'Errors',
	        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
	    	)
		);
		$videoForm->getElement('videoThumb')-> setDecorators(
	    array(
	        'File',
	        'Errors',
	        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
	    	)
		);

		$fileForm->getElement('file')-> setDecorators(
	    array(
	        'File',
	        'Errors',
	        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
	    	)
		);
		

        $this->addSubForm($videoForm	, 'video')
             //->addSubForm($sourceForm	, 'source')
             ->addSubForm($fileForm		, 'file')
             ->addSubForm($optionalForm , 'optional')
			 ->addSubForm($metaForm 	, 'meta');
				
    }
}