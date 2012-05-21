<?php
class Vehicle_Form_BodyColor extends Zend_Dojo_Form
{
	public $view = NULL;
	private $translator, $translateValidators;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}
	
	private function _getLocaleAvailabe() {
		/*$vehicleTypeObj = new Vehicle_Model_Type();
		$this -> _selectVehicleTypeOptions = array (0 => $this -> view -> __('Root'));
		$vehicleTypeObjResult 	= $vehicleTypeObj -> select() -> query() -> fetchAll();
		if (!empty($vehicleTypeObjResult)) {
			foreach ($vehicleTypeObjResult as $key => $value) {
				$this->_selectVehicleTypeOptions[$value['id']] = $value['title'];
			}
		}*/
		$x = 1;
		if ($x=1) {
			return array(1 => 'English', 2 => 'Arabic');
		} else {
			return false;
		}
		//return $this->_selectVehicleTypeOptions;
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
                'name'			=>  $id,
                //'legend' 		=>  $id,
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( $value . ' Vehicle_Information' ),
                )
        ));
        $mandatoryForm->addElement(
                'ValidationTextBox',
                'title',
                array(
                    'label' 	=> $this-> view -> __ ( 'Vehicle_Title' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $mandatoryForm->addElement(
                'ValidationTextBox',
                'description',
                array(
                    'label' 	=> $this-> view -> __ ( 'Vehicle_Description' ),
                    'trim' 		=> true,
                    'required'	=> true,
                    'class' 	=> 'lablvalue jstalgntop',
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
					'label' 	=> $this-> view -> __ ( 'Vehicle_Save' ),
					'type'	 	=> 'Submit',
					'ignore'	=> true,
					'onclick' 	=> 'dijit.byId("add-edit").submit()',
					)
			);
		$flag = false;
		}

        $optionalForm = new Zend_Dojo_Form_SubForm();
        $optionalForm->setAttribs(array(
                    'name' 	 =>  'optional_' . $id,
                    'legend' => $this-> view -> __ ( $value . ' Vehicle_Advanced Settings' ),
        ));
		
		$optionalForm->addElement(
			'TextBox',
            'comments',
            array(
				'label' 	=> $this-> view -> __ ( 'Vehicle_Comments' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $optionalForm->addElement(
                'TextBox',
                'options',
                array(
                    'label' 	=> $this-> view -> __ ( 'Vehicle_Options' ),
                    'trim' 		=> true,
                    'required'	=> false,
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

		//$mandatoryForm->comments->setDijitParam('required', false);
		//$mandatoryForm->comments->setAttrib('required', false);
		//$mandatoryForm->comments->setAttrib('dijitParams', array('required' => false));

		
		//$mandatoryForm->comments->removeDecorator ('HtmlTag');
      	//$mandatoryForm->comments->removeDecorator ('Label');
        
        $this->addSubForm($mandatoryForm, $id)
             ->addSubForm($optionalForm , 'optional_' . $id);
		}
    }
}