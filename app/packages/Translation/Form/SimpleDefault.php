<?php
class Translation_Form_SimpleDefault extends Zend_Dojo_Form
{
	public $view = NULL;
	private $_selectAllTranslation, $_selectAllTranslationOption = array();
	private $translator, $translateValidators;
	public $hash_key = NULL;
	
	public function __construct($view) {
		$this->view = $view;
	}
	
	public function createForm() {
		parent::__construct();
	}

	private function _getAllTranslationByHashkey($hash_key) {
		$translationObj = new Translation_Model_Default();
		$this -> _selectAllTranslation = $translationObj -> getAllTranslationByHashkey($hash_key);
		foreach ($this -> _selectAllTranslation as $value) {
			$this -> _selectAllTranslationOption[$value['id']] = $value['label'];
		}
		return $this -> _selectAllTranslationOption;
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
                    'title' 	=> $this-> view -> __ ( 'Translation_Information' ),
                )
        ));
        $mandatoryForm->addElement(
                'ValidationTextBox',
                'label',
                array(
                    'label' 	=> $this-> view -> __ ( 'Translation_Label' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'readOnly'  => true,
                    'invalidMessage' => 'Invalid english characters',
                    'promptMessage'  => $this-> view -> __ ( 'Translation_Label' ) . ' accept only english characters',
                    'class' 	=> 'lablvalue jstalgntop',
                )
            );
        $mandatoryForm->addElement(
                'ValidationTextBox',
                'translation',
                array(
                    'label' 	=> $this-> view -> __ ( 'Translation_Translation' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
            );
        $mandatoryForm->addElement(
                'hidden',
                'id'
            );
        $mandatoryForm->addElement(
                'hidden',
                'locale_id'
        );
        $mandatoryForm->addElement(
				'SubmitButton',
				'submit',
				array(
					//'required' 	=> true,
					'value'		=> 'submit',
					'label' 	=> $this-> view -> __ ( 'Translation_Save' ),
					'type'	 	=> 'Submit',
					'ignore'	=> true,
					'onclick' 	=> 'dijit.byId("add-edit").submit()',
				)
		);
		
        $mandatoryForm->addElement(
            'FilteringSelect',
            'translate_id',
            array(
                'label' => $this-> view -> __ ( 'Choose other to modify' ),
                'class' => 'lablvalue jstalgntop',
                'autocomplete'=>false,
                'required'	=> true,
                'selected' => '',
                'multiOptions' => $this->_getAllTranslationByHashkey($this->hash_key),
                'id' => 'translate_id',
				'onchange' => "window.location = '/admin/handle/pkg/translation/action/edit/id/'+dijit.byId('translate_id').getValue();",
            )
        );

        $optionalForm = new Zend_Dojo_Form_SubForm();
        $optionalForm->setAttribs(array(
                    'name' 	 => 'optional',
                    'legend' => $this-> view -> __ ( 'Translation_Advanced Settings' ),
                ));
        $optionalForm->addElement(
                'TextBox',
                'comments',
                array(
                    'label' 	=> $this-> view -> __ ( 'Translation_Comments' ),
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