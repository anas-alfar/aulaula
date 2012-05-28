<?php
class Category_Form_DefaultAdmin extends Zend_Dojo_Form
{
	public $view = NULL;
	private $_selectCategoryTypeOptions = array();
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getCategoryTypeOptions() {
		$categoryTypeObj 	= new Category_Model_Type();
		$this -> _selectCategoryTypeOptions = array (0 => $this -> view -> __('Root'));
		$categoryTypeObjResult 	= $categoryTypeObj -> select() -> query() -> fetchAll();
		if (!empty($categoryTypeObjResult)) {
			foreach ($categoryTypeObjResult as $key => $value) {
				$this->_selectCategoryTypeOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectCategoryTypeOptions;
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
		
        $mandatoryForm= new Zend_Dojo_Form_SubForm();
        $mandatoryForm->setAttribs(array(
                'name'			=> 'mandatory',
                'legend' 		=> 'mandatory',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Category_Information' ),
                )
        ));
        $mandatoryForm->addElement(
                'TextBox',
                'title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Title' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
            );
        $mandatoryForm->addElement(
                'TextBox',
                'label',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Label' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
            );
        $mandatoryForm->addElement(
                'TextBox',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Description' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
            );
        $mandatoryForm->addElement(
            'FilteringSelect',
            'category_type_id',
            array(
                'label' => $this-> view -> __ ( 'Category_Type' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                'multiOptions' => $this->_getCategoryTypeOptions(),
                'id' => 'category_type_id',
				'onchange' => "dijit.byId('parent_id').searchAttr = dijit.byId('category_type_id').getValue();return true",
            )
        );
        $mandatoryForm->addElement(
            'FilteringSelect',
            'parent_id',
            array(
                'label' => $this-> view -> __ ( 'Category_Parent' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                'id' => 'parent_id',
				'storeId' => 'myData',
				'storeType'=> 'dojo.data.ItemFileReadStore',
             	'storeParams' => array( 'url' => '/admin/handle/pkg/category/action/records/',),
             	'dijitParams' => array( 'searchAttr' => '0' ),
            )
        );
        $mandatoryForm->addElement(
                'NumberTextBox',
                'order',
                array(
                    'label' 	=> $this-> view -> __('Category_Order'),
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
            'show_in_menu',
            array(
                'label' 		=> $this-> view -> __('Category_Show in Menu'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __('Category_Published'),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$mandatoryForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __('Category_Approved'),
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
					//'required' 	=> true,
					'value'		=> 'submit',
					'label' 	=> $this-> view -> __ ( 'Category_Save' ),
					'type'	 	=> 'Submit',
					'ignore'	=> true,
					'onclick' 	=> 'dijit.byId("add-edit").submit()',
				)
		);
		/*
		$mandatoryForm->addElement(
						'reset', 
						'reset',
						array(
							'label' => 'Reset',
							'id'	=> 'reset',
							'ignore'=> true,
						)
				);*/
		

        $optionalForm = new Zend_Dojo_Form_SubForm();
        $optionalForm->setAttribs(array(
                    'name' 	 => 'optional',
                    'legend' => $this-> view -> __ ( 'Category_Advanced Settings' ),
        ));
        $optionalForm->addElement(
                'DateTextBox',
                'publish_from',
                array(
                    'datePattern'=> 'dd-MM-yyyy',
                    'validators' => array('Date'),
					'label' 	 => $this -> view -> __('Category_Publish From'),
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
					'label' 	 => $this -> view -> __('Category_Publish To'),
                    'trim' 		 => true,
                    'class' 	 => 'lablvalue jstalgntop'
                )
        );
        $optionalForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Comments' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $optionalForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Options' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
		);
		
        $metaForm = new Zend_Dojo_Form_SubForm();
        $metaForm->setAttribs(array(
                    'name' 	 => 'optional',
                    'legend' => $this-> view -> __ ( 'Category_Meta Data' ),
        ));
        $metaForm->addElement(
                'TextBox',
                'page_title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Page Title' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Meta Title' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_key',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Meta Keywords' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_desc',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Meta Description' ),
                    'trim' 		=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                	)
        );
        $metaForm->addElement(
                'TextBox',
                'meta_data',
                array(
                    'label' 	=> $this-> view -> __ ( 'Category_Meta Data' ),
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