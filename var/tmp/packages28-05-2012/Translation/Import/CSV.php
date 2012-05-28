<?php
class Translation_Import_CSV extends Zend_Dojo_Form
{
	public $view = NULL;
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
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
                    'title' 	=> $this-> view -> __ ( 'Upload_Information' ),
                )
        ));
		$mandatoryForm->addElement(
				'file', 
				'file', 
				array(
					'required'	=> true,
			    	'label'         => $this -> view -> __ ( 'Upload' ),
			    	'validators'    => array(
			    		array('ExcludeExtension', false, array('php', 'exe', 'case' => true)),
			        	array('Size', false, 209715200),
			        	array('Extension', false, 'xls,csv,xlsx')
			    	),
				)
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


		$mandatoryForm  ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

        $mandatoryForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$mandatoryForm->getElement('file')-> setDecorators(
	    array(
	        'File',
	        'Errors',
	        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
	        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
	    	)
		);

        $this->addSubForm($mandatoryForm, 'mandatory');
				
    }
}