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
 * @package Vehicle
 * @subpackage Form
 * @name Vehicle_Form_ForSaleUpdate
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Vehicle_Form_ForSaleUpdate extends Zend_Dojo_Form
{
	public $view = NULL;
	public $locale_id, $vehicleLookup;
	private $translator, $translateValidators;
	private /*$_selectLocaleOptions,*/ $_selectYearOptions, $_selectBodyColorOptions, $_selectInsideColorOptions;
	private $_selectDragSystemOptions, $_selectInsuranceTypeOptions, $_selectTypeOptions, $_selectContactNIDCROptions, $_numberOfSeats, $_numberOfDoors, $_numberOfCylinders;
	
	public function __construct($view) {
		$this->view = $view;
		
		$this -> _numberOfSeats 	= array('' => $this -> view -> __('Root'), 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 14=>14);
		$this -> _numberOfCylinders = array('' => $this -> view -> __('Root'), 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 8=>8, 10=>10, 12=>12, 16=>16);
		$this -> _numberOfDoors 	= array('' => $this -> view -> __('Root'), 2=>2, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8);
		
		parent::__construct();
	}

	public function setLocale ($fc) {
		 $this -> locale_id =  $fc->locale->default->current->id;
	}
	
	public function setLookup( $lookupObj ) {
		$this -> vehicleLookup = $lookupObj;
	}

	public function getLocale () {
		return $this -> locale_id;
	}
	
	public function getLookup ($comboBox) {
		return $this -> vehicleLookup[$comboBox];
	}


	/*private function _getLocaleAvailabe() {
		$localeObj 	= new Locale_Model_Default();
		$this -> _selectLocaleOptions = array ('' => $this -> view -> __('Root'));
		$localeObjResult 	= $localeObj -> getAllLocale();
		if (!empty($localeObjResult)) {
			foreach ($localeObjResult as $key => $value) {
				$this->_selectLocaleOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectLocaleOptions;
	}*/
	
	private function _getAllYearByLocalId ($locale_id) {
		$yearObj 	= new Vehicle_Model_Year();
		$this -> _selectYearOptions = array ('' => $this -> view -> __('Root'));
		$yearObjResult 	= $yearObj -> getAllYearByLocalId($locale_id);
		if (!empty($yearObjResult)) {
			foreach ($yearObjResult as $key => $value) {
				$this->_selectYearOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectYearOptions;
	}
	
	private function _getAllBodyColorByLocalId ($locale_id) {
		$bodyColorObj 	= new Vehicle_Model_BodyColor();
		$this -> _selectBodyColorOptions = array ('' => $this -> view -> __('Root'));
		$bodyColorObjResult 	= $bodyColorObj -> getAllBodyColorByLocalId($locale_id);
		if (!empty($bodyColorObjResult)) {
			foreach ($bodyColorObjResult as $key => $value) {
				$this->_selectBodyColorOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectBodyColorOptions;
	}
	
	private function _getAllInsideColorByLocalId ($locale_id) {
		$insideColorObj 	= new Vehicle_Model_InsideColor();
		$this -> _selectInsideColorOptions = array ('' => $this -> view -> __('Root'));
		$insideColorObjResult 	= $insideColorObj -> getAllInsideColorByLocalId($locale_id);
		if (!empty($insideColorObjResult)) {
			foreach ($insideColorObjResult as $key => $value) {
				$this->_selectInsideColorOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectInsideColorOptions;
	}
	
	private function _getAllDragSystemByLocalId ($locale_id) {
		$dragSystemObj 	= new Vehicle_Model_DragSystem();
		$this -> _selectDragSystemOptions = array ('' => $this -> view -> __('Root'));
		$dragSystemObjResult 	= $dragSystemObj -> getAllDragSystemByLocalId($locale_id);
		if (!empty($dragSystemObjResult)) {
			foreach ($dragSystemObjResult as $key => $value) {
				$this->_selectDragSystemOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectDragSystemOptions;
	}
	
	private function _getAllInsuranceTypeByLocalId ($locale_id) {
		$insuranceTypeObj 	= new Vehicle_Model_InsuranceType();
		$this -> _selectInsuranceTypeOptions = array ('' => $this -> view -> __('Root'));
		$insuranceTypeObjResult 	= $insuranceTypeObj -> getAllInsuranceTypeByLocalId($locale_id);
		if (!empty($insuranceTypeObjResult)) {
			foreach ($insuranceTypeObjResult as $key => $value) {
				$this->_selectInsuranceTypeOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectInsuranceTypeOptions;
	}
	
	private function _getAllTypeByLocalId ($locale_id) {
		$typeObj 	= new Vehicle_Model_Type();
		$this -> _selectTypeOptions = array ('' => $this -> view -> __('Root'));
		$typeObjResult 	= $typeObj -> getAllTypeByLocalId($locale_id);
		if (!empty($typeObjResult)) {
			foreach ($typeObjResult as $key => $value) {
				$this->_selectTypeOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectTypeOptions;
	}
	
	private function _getAllContactNIDCR () {
		$this->_selectContactNIDCROptions = array ('' => '');
		$this->_selectContactNIDCROptions[111111] = 22222;
		$this->_selectContactNIDCROptions[111222] = 2222211111;
		$this->_selectContactNIDCROptions[111333] = 2222233333;
		$this->_selectContactNIDCROptions[111444] = 2222244444;
		$this->_selectContactNIDCROptions[111555] = 2222255555;
		$this->_selectContactNIDCROptions[111666] = 2222266666;
		$this->_selectContactNIDCROptions[333777] = 3333377777;
		$this->_selectContactNIDCROptions[444777] = 4444477777;
		$this->_selectContactNIDCROptions[555777] = 5555577777;
		return $this->_selectContactNIDCROptions;
	} 

    public function init() {

    }
	
	public function renderForm() {

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
		$this->setAttrib('onSubmit' , 'return this.validate();');

		$this->setDecorators(array(
		'FormElements',
		array('TabContainer', array(
				'id' 			=> 'tabContainer',
				'style' 		=> 'width:500px;height:1000px;',
				'dijitParams' 	=> array('tabPosition' => 'right')
				)),
			'DijitForm'
		));
		
		
		
		
		
        $contactForm = new Zend_Dojo_Form_SubForm();
        $contactForm->setAttribs(array(
                    'name' 	 =>  'contact',
                    'legend' => $this-> view -> __ ( 'Vehicle_For_Sale_Contact_Information' ),
        ));
		
		$contactForm->addElement(					
            'select',
            'contact_type',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Contact_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('contact_type'),
            )
        );

		$contactForm->addElement(
	        'ComboBox',
	        'contact_nid_cr',
	        array(
	            'label'     => $this-> view -> __ ( 'Vehicle_For_Contact_NID_CR' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
                'name'		=> 'contact_nid_cr',
                'id'		=> 'contact_nid_cr',
                'value'		=> '',
	            //'autocomplete' => true,
	            'multiOptions' => $this -> _getAllContactNIDCR(),
	            /*'multiOptions' => array(
	                'red'    => 'Rouge',
	                'blue'   => 'Bleu',
	                'white'  => 'Blanc',
	                'orange' => 'Orange',
	                'black'  => 'Noir',
	                'green'  => 'Vert',
	            ),*/	
	        )
		);
        $contactForm->addElement(
            'ValidationTextBox',
            'contact_bb',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Contact_BB' ),
                'trim' 		=> true,
                'required'	=> true,
                'name'		=> 'contact_bb',
                'id'		=> 'contact_bb',
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $contactForm->addElement(
            'ValidationTextBox',
            'contact_full_name',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Contact_Full_Name' ),
                'trim' 		=> true,
                'required'	=> true,
                'name'		=> 'contact_full_name',
                'id'		=> 'contact_full_name',
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $contactForm->addElement(
            'ValidationTextBox',
            'mobile_1',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Mobile_1' ),
                'trim' 		=> true,
                'required'	=> true,
                'name'		=> 'mobile_1',
                'id'		=> 'mobile_1',
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $contactForm->addElement(
            'ValidationTextBox',
            'mobile_2',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Mobile_2' ),
                'trim' 		=> true,
                'required'	=> true,
                'name'		=> 'mobile_2',
                'id'		=> 'mobile_2',
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        /*$contactForm->addElement(
            'ValidationTextBox',
            'email',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Email' ),
                'trim' 		=> true,
                'required'	=> true,
                'name'		=> 'email',
                'id'		=> 'email',
                'class' 	=> 'lablvalue jstalgntop',
			)
        );*/
		$contactForm->addElement( 
			'validationTextBox', 
			'email', 
			array(
				'required'  => true, 
				'name'		=> 'email',
				'id'		=> 'email',
				'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Email' ),
				'regExp' 	=> '\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b', 
				'invalidMessage' => 'Please provide valid Email address.', 
				'filters' 	=> array (
					'StringTrim', 
					'StringToLower' 
				), 
				'validators'=> array (
					'NotEmpty', 
					array ('StringLength', true, array (6, 50 ) ), 
					array ('Regex', true, array ('/\w+/i' ) ) 
				) 
			) 
		);
		
        $contactForm->addElement(
			'hidden',
            'id'
        );
        $contactForm->addElement(
			'SubmitButton',
			'submit',
			array(
				'value'		=> 'submit',
				'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Save' ),
				'type'	 	=> 'Submit',
				'ignore'	=> true,
				'onclick' 	=> 'dijit.byId("add-edit").submit()',
			)
		);
		
		
		


        $generalForm = new Zend_Dojo_Form_SubForm();
        $generalForm->setAttribs(array(
				'name' 	 =>  'general',
				'legend' => $this-> view -> __ ( 'Vehicle_For_Sale_General_Information' ),
        ));
		

		$generalForm->addElement(					
            'select',
            'status',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Vehicle_Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('vehicle_for_sale_status'),
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'job_car_number',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Job_Card_Number' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $generalForm->addElement(
            'DateTextBox',
            'advertise_date',
            array(
                'datePattern'=> 'dd-MM-yyyy',
                'validators' => array('Date'),
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Advertise_Date' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
        $generalForm->addElement(
            'NumberTextBox',
            'advertise_period',
            array(
                'label' 	=> $this-> view -> __( 'Vehicle_For_Sale_Advertise_Period' ),
                'class' 	=> 'lablvalue jstalgntop',
                'invalidMessage'=>'Invalid elevation.',
                'required'	=> true,
                'constraints' => array(
                    'min' 	=> 0,
                    'max'	=> 1000000,
                    'places'=> 0,
                )
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'plate_number',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Plate_Number' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$generalForm->addElement(					
            'FilteringSelect',
            'type_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Type'),
                'required'		=> true,
                'value'			=> '',
                'id'			=> 'type_id',
	            'multiOptions'  => $this -> _getAllTypeByLocalId($this -> getLocale()),
	            'onchange' 		=> "dijit.byId('make_id').searchAttr = dijit.byId('type_id').getValue();return true", 
			)
        );
		$generalForm->addElement(					
            'FilteringSelect',
            'make_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Make'),
                'required'		=> true,
                'value'			=> '',
                'id'			=> 'make_id',
	            'storeId' 		=> 'myData',
				'storeType'		=> 'dojo.data.ItemFileReadStore',
             	'storeParams' 	=> array( 'url' => '/admin/handle/pkg/vehicle-for-sale/action/getMakeAjax/locale_id/'.$this -> getLocale(),),
             	'dijitParams' 	=> array( 'searchAttr' => '0' ),
             	'onchange' 		=> "dijit.byId('model_id').searchAttr = dijit.byId('make_id').getValue();return true",
            )
        );
		$generalForm->addElement(					
            'FilteringSelect',
            'model_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Model'),
                'required'		=> true,
                'value'			=> '',
                'id'			=> 'model_id',
	            'storeId' 		=> 'myData',
				'storeType'		=> 'dojo.data.ItemFileReadStore',
             	'storeParams' 	=> array( 'url' => '/admin/handle/pkg/vehicle-for-sale/action/getModelAjax/locale_id/'.$this -> getLocale(),),
             	'dijitParams' 	=> array( 'searchAttr' => '0' ),
            )
        );
		$generalForm->addElement(					
            'select',
            'year_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Year'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllYearByLocalId($this -> getLocale()),
            )
        );
        $generalForm->addElement(
            'NumberTextBox',
            'cost',
            array(
                'label' 	=> $this-> view -> __( 'Vehicle_For_Sale_Cost' ),
                'class' 	=> 'lablvalue jstalgntop',
                'invalidMessage'=>'Invalid elevation.',
                'required'	=> true,
                'constraints' => array(
                    'min' 	=> 0,
                    'max'	=> 1000000000,
                    'places'=> 0,
                )
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'swap',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Swap' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$generalForm->addElement(
            'CheckBox',
            'negotiable',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Negotiable' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'mileage',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Mileage' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$generalForm->addElement(					
            'select',
            'body_color_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Body_Color'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllBodyColorByLocalId($this -> getLocale()),
            )
        );
		$generalForm->addElement(					
            'select',
            'inside_color_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Inside_Color'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllInsideColorByLocalId($this -> getLocale()),
            )
        );
		$generalForm->addElement(					
            'select',
            'gear_type_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Gear_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('gear_type'),
            )
        ); 
		$generalForm->addElement(					
            'select',
            'seat_type_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Seat_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('seat_type'),
            )
        ); 
		$generalForm->addElement(					
            'select',
            'number_of_cylinders',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Number_Of_Cylinders'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _numberOfCylinders,
            )
        ); 
		$generalForm->addElement(					
		    'select',
		    'drag_system_id',
		    array(
		        'label' 		=> $this-> view -> __('Vehicle_For_Sale_Drag_System'),
		        'required'		=> true,
		        'value'			=> '',
		            'multiOptions'  => $this -> _getAllDragSystemByLocalId($this -> getLocale()),
		    )
		);
		$generalForm->addElement(					
		    'select',
		    'fuel_type_id',
		    array(
		        'label' 		=> $this-> view -> __('Vehicle_For_Sale_Fuel_Type'),
		        'required'		=> true,
		        'value'			=> '',
		            'multiOptions'  => $this -> getLookup ('fuel_type'),
		    )
		); 
		$generalForm->addElement(
            'CheckBox',
            'cd',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_CD' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'dvd',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_DVD' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'gps',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_GPS' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'sunroof',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Sunroof' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $generalForm->addElement(
            'DateTextBox',
            'vehicle_registration_expiry',
            array(
                'datePattern'=> 'dd-MM-yyyy',
                'validators' => array('Date'),
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Vehicle_Registration_Expiry' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
		$generalForm->addElement(					
            'select',
            'insurance_type_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Insurance_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllInsuranceTypeByLocalId($this -> getLocale()),
            )
        );
        $generalForm->addElement(
            'DateTextBox',
            'Warranty_until',
            array(
                'datePattern'=> 'dd-MM-yyyy',
                'validators' => array('Date'),
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Warranty_Until' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );


		
		

        $specificationForm = new Zend_Dojo_Form_SubForm();
        $specificationForm->setAttribs(array(
                    'name' 	 =>  'specification',
                    'legend' => $this-> view -> __ ( 'Vehicle_For_Sale_Specification' ),
        ));
		
		
		$specificationForm->addElement(
		    'NumberTextBox',
		    'engine_size',
		    array(
		        'label' 	=> $this-> view -> __( 'Vehicle_For_Sale_Engine_Size' ),
		        'class' 	=> 'lablvalue jstalgntop',
		        'invalidMessage'=>'Invalid elevation.',
		        'required'	=> true,
		        'constraints' => array(
		            'min' 	=> 0,
		            'max'	=> 1000000,
		            'places'=> 0,
		        )
		    )
		);
		$specificationForm->addElement(
		    'NumberTextBox',
		    'horse_power',
		    array(
		        'label' 	=> $this-> view -> __( 'Vehicle_For_Sale_Horse_Power' ),
		        'class' 	=> 'lablvalue jstalgntop',
		        'invalidMessage'=>'Invalid elevation.',
		        'required'	=> true,
		        'constraints' => array(
		            'min' 	=> 0,
		            'max'	=> 1000000,
		            'places'=> 0,
		        )
		    )
		);
		$specificationForm->addElement(					
		    'select',
		    'spare_tire_id',
		    array(
		        'label' 		=> $this-> view -> __('Vehicle_For_Sale_Spare_Tire'),
		        'required'		=> true,
		        'value'			=> '',
		            'multiOptions'  => $this -> getLookup ('spare_tire'),
		    )
		);
		$specificationForm->addElement(					
            'select',
            'number_of_seats',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Number_Of_Seats'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _numberOfSeats,
            )
        ); 
		$specificationForm->addElement(					
            'select',
            'number_of_doors',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Number_Of_Doors'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _numberOfDoors,
            )
        ); 
		$specificationForm->addElement(
            'CheckBox',
            'thermal_insulation_film',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Thermal_Insulation_Film' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'body_protective_film',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Body_Protective_Film' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        ); 
        $specificationForm->addElement(
            'NumberTextBox',
            'fuel_tank_size',
            array(
                'label' 	=> $this-> view -> __( 'Vehicle_For_Sale_Fuel_Tank_Size' ),
                'class' 	=> 'lablvalue jstalgntop',
                'invalidMessage'=>'Invalid elevation.',
                'required'	=> true,
                'constraints' => array(
                    'min' 	=> 0,
                    'max'	=> 1000000,
                    'places'=> 0,
                )
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'abs',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_ABS' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'automatic_parking',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Automatic_Parking' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'parking_sensors',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Parking_Sensors' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'rear_camera',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Rear_Camera' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'front_lights',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Front_Lights' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'led_rear_lights',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Led_Rear_Lights' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'sport_exhaust',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Sport_Exhaust' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'alarm_system',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Alarm_System' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'portable_roof',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Portable_Roof' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'airbags',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Airbags' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'driving_control_system',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Driving_Control_System' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'ir_monitor',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_IR_Monitor' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'bluetooth',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Bluetooth' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'ipod_port',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_IPOD_Port' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'usb_port',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_USB_Port' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'external_mirrors_heating',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_External_Mirrors_Heating' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'dimmed_glass',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Dimmed_Glass' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'self_dimming_internal_mirror',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Self_Dimming_Internal_Mirror' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'electrical_seats',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Electrical_Seats' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'heated_seats',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Heated_Seats' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'massage_in_seats',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Massage_In_Seats' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'ventilated_seats',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Ventilated_Seats' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(					
            'select',
            'window_type_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Window_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('window_type'),
            )
        );




        $extraFeatureForm = new Zend_Dojo_Form_SubForm();
        $extraFeatureForm->setAttribs(array(
            'name' 	 =>  'extraFeature',
            'legend' => $this-> view -> __ ( 'Vehicle_For_Sale_Extra_Feature' ),
        ));
		

		$extraFeatureForm->addElement(
            'CheckBox',
            'used_by_lady',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Used_By_Lady' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$extraFeatureForm->addElement(
            'CheckBox',
            'gearbox_changed',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Gearbox_Changed' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$extraFeatureForm->addElement(
            'CheckBox',
            'accident_free',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Accident_Free' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$extraFeatureForm->addElement(
            'CheckBox',
            'original_engine_changed',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Original_Engine_Changed' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		
		
		

        $systemForm= new Zend_Dojo_Form_SubForm();
        $systemForm->setAttribs(array(
            'name'			=> 'system',
            'dijitParams' 	=> array(
                'title' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_System_Information' ),
            )
        ));
		/*$systemForm->addElement(
            'select',
            'locale_id',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Locale'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getLocaleAvailabe(),
            )
        );*/
		$systemForm->addElement(					
            'select',
            'money_status',
            array(
                'label' 		=> $this-> view -> __('Vehicle_For_Sale_Money_Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('money_status'),
            )
        ); 
		$systemForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Approved' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$systemForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __( 'Vehicle_For_Sale_Published' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$systemForm->addElement(
			'TextBox',
            'comments',
            array(
				'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Comments' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $systemForm->addElement(
            'TextBox',
            'options',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Options' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
            	)
        );
        /*$systemForm->addElement(
            'DateTextBox',
            'approved_date',
            array(
                'datePattern'=> 'dd-MM-yyyy',
                'validators' => array('Date'),
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Approved_Date' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
        $systemForm->addElement(
            'DateTextBox',
            'publish_date',
            array(
                'datePattern'=> 'dd-MM-yyyy',
                'validators' => array('Date'),
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Publish_Date' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );*/
		
		


        $this->addSubForm($contactForm , 'contact')
             ->addSubForm($generalForm , 'general')
             ->addSubForm($specificationForm , 'specification')
             ->addSubForm($extraFeatureForm , 'extraFeature')
			 ->addSubForm($systemForm, 'system');

		
		

		$systemForm  ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$contactForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$generalForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$specificationForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$extraFeatureForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

        $systemForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
			array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$contactForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$generalForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$specificationForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$extraFeatureForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
	}


	public function videoForm($data) {
		// Begin Video Form
        $videoForm = new Zend_Dojo_Form_SubForm();
        $videoForm->setAttribs(array(
                'name'			=> 'video',
                'legend' 		=> 'video',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Video' ),
                )
        ));
        $videoForm->addElement(
            'ValidationTextBox',
            'alias',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Alias' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $videoForm->addElement(
            'ValidationTextBox',
            'intro_text',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Intro_Text' ),
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
		    	'label'     => $this -> view -> __ ( 'Vehicle_For_Sale_Photo' ),
		    	'validators'=> array(
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
		    	'label'         => $this -> view -> __ ( 'Vehicle_For_Sale_Upload' ),
		    	'validators'    => array(
		    		array('ExcludeExtension', false, array('php', 'exe', 'case' => true)),
		        	array('Extension', false, 'flv')
		    	),
			)
		);
        $videoForm->addElement(
            'ValidationTextBox',
            'taken_location',
            array(
                'label' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Taken_Location' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $videoForm->addElement(
            'NumberTextBox',
            'order',
            array(
                'label' 	=> $this-> view -> __( 'Vehicle_For_Sale_Order' ),
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
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Taken_Date' ),
                'trim' 		 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
        $videoForm->addElement(
            'DateTextBox',
            'publish_from',
            array(
                'datePattern'=> 'dd-MM-yyyy',
                'validators' => array('Date'),
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Publish_From' ),
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
				'label' 	 => $this -> view -> __( 'Vehicle_For_Sale_Publish_To' ),
                'trim' 		 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
        $videoForm->addElement(
			'hidden',
            'video_id'
        );
		// End Video Form

		$videoForm->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$videoForm->setElementDecorators(array(
		'DijitElement',
		'Errors',
		    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
		    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
		));
		$videoForm->getElement('video')-> setDecorators(array(
        'File',
        'Errors',
        	array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
        	array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
        	array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    	));
		$videoForm->getElement('videoThumb')-> setDecorators(array(
        'File',
        'Errors',
        	array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
        	array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
        	array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    	));

		$videoForm->populate($data);
		$this->addSubForm($videoForm	, 'video');
	}


	public function photoForm($number, $data, $src) {
        $photoForm = new Zend_Dojo_Form_SubForm();
        $photoForm->setAttribs(array(
            'name'			=> 'photo_'  . $number,
            'dijitParams' 	=> array(
                'title' 	=> $this-> view -> __ ( 'Vehicle_For_Sale_Photo' ) . ' ' . $number,
            )
        ));


		$photoForm->addElement(
			'file', 
			'photo_' . $number, 
			array(
				'required'	=> true,
		    	'label'     => $this -> view -> __ ( 'Vehicle_For_Sale_Upload' ),
		    	'id'		=> 'photo_' . $number,
		    	'name'      => 'photo_' . $number,
		    	'validators'    => array(
		        	//array('Count', false, array('min'=>1, 'max'=>3)),
		        	array('Size', false, 209715200),
		        	array('Extension', false, 'jpg,png,gif,jpeg,x-png')
		    	),
			)
		);
        $photoForm->addElement(
			'hidden',
            'photo_id'
        );
		$photoForm->addElement(
			'html', 
			'someid', 
			array(
				'value' => '<img src="'.$src.'" />',
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

		$photoForm->getElement('photo_' . $number)-> setDecorators(
    	array(
        	'File',
	        'Errors',
	        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'lable jstalgntop')),
    	    array('Label', array('tag' => 'td', 'class' => 'lable jstalgntop')),
        	array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    		)
		);

		$photoForm->populate($data);
		$this->addSubForm($photoForm 	, 'photo_' . $number);
	}








}