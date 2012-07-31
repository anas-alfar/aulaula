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
 * @package Estate
 * @subpackage Form
 * @name Estate_Form_DefaultUpdate
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Estate_Form_DefaultUpdate extends Zend_Dojo_Form
{
	public $view = NULL;
	public $locale_id, $estateLookup;
	private $translator, $translateValidators;
	private $_selectAirConditionOptions, $_selectAreaLocationOptions, $_selectProvenceOptions, $_selectOutdoorAmenitiesOptions, $_selectContactNIDCROptions;
	private $_selectLivenear1Options, $_selectLivenear2Options, $_selectLivenear3Options, $_selectLivenear4Options, $_selectTypeOptions;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}

	public function setLocale ($fc) {
		 $this -> locale_id =  $fc->locale->default->current->id;
	}
	
	public function setLookup( $lookupObj ) {
		$this -> estateLookup = $lookupObj;
	}

	public function getLocale () {
		return $this -> locale_id;
	}
	
	public function getLookup ($comboBox) {
		return $this -> estateLookup[$comboBox];
	}
	
	private function _getAllAirConditionByLocaleId ($locale_id) {
		$airConditionObj 	= new Estate_Model_AirCondition();
		$this -> _selectAirConditionOptions = array ('' => $this -> view -> __('Root'));
		$airConditionObjResult 	= $airConditionObj -> getAllAirConditionByLocaleId($locale_id);
		if (!empty($airConditionObjResult)) {
			foreach ($airConditionObjResult as $key => $value) {
				$this->_selectAirConditionOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectAirConditionOptions;
	}

	private function _getAllOutdoorAmenitiesByLocaleId ($locale_id) {
		$outdoorAmenitiesObj 	= new Estate_Model_OutdoorAmenities();
		$this -> _selectOutdoorAmenitiesOptions = array ('' => $this -> view -> __('Root'));
		$outdoorAmenitiesObjResult 	= $outdoorAmenitiesObj -> getAllOutdoorAmenitiesByLocaleId($locale_id);
		if (!empty($outdoorAmenitiesObjResult)) {
			foreach ($outdoorAmenitiesObjResult as $key => $value) {
				$this-> _selectOutdoorAmenitiesOptions[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectOutdoorAmenitiesOptions;
	}
	

	private function _getAllTypeByLocaleId ($locale_id) {
		$typeObj 	= new Estate_Model_Type();
		$this -> _selectTypeOptions = array ('' => $this -> view -> __('Root'));
		$typeObjResult 	= $typeObj -> getAllTypeByLocaleId($locale_id);
		if (!empty($typeObjResult)) {
			foreach ($typeObjResult as $key => $value) {
				$this->_selectTypeOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectTypeOptions;
	}

	private function _getAllAreaLocationByLocaleId ($locale_id) {
		$locationObj 	= new Estate_Model_Location();
		$this -> _selectAreaLocationOptions = array ('' => $this -> view -> __('Root'));
		$locationObjResult 	= $locationObj -> getAllLocationByLocaleId($locale_id);
		if (!empty($locationObjResult)) {
			foreach ($locationObjResult as $key => $value) {
				$this->_selectAreaLocationOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectAreaLocationOptions;
	}

	private function _getAllProvenceByLocaleId ($locale_id) {
		$provenceObj 	= new Estate_Model_Provence();
		$this -> _selectProvenceOptions = array ('' => $this -> view -> __('Root'));
		$provenceObjResult 	= $provenceObj -> getAllProvenceByLocaleId($locale_id);
		if (!empty($provenceObjResult)) {
			foreach ($provenceObjResult as $key => $value) {
				$this->_selectProvenceOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectProvenceOptions;
	}

	private function _getAllLivenear1ByLocaleId ($locale_id) {
		$livenear1Obj 	= new Estate_Model_Livenear1();
		$this -> _selectLivenear1Options = array ('' => $this -> view -> __('Root'));
		$livenear1ObjResult 	= $livenear1Obj -> getAllLivenear1ByLocaleId($locale_id);
		if (!empty($livenear1ObjResult)) {
			foreach ($livenear1ObjResult as $key => $value) {
				$this-> _selectLivenear1Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear1Options;
	}

	private function _getAllLivenear2ByLocaleId ($locale_id) {
		$livenear2Obj 	= new Estate_Model_Livenear2();
		$this -> _selectLivenear2Options = array ('' => $this -> view -> __('Root'));
		$livenear2ObjResult 	= $livenear2Obj -> getAllLivenear2ByLocaleId($locale_id);
		if (!empty($livenear2ObjResult)) {
			foreach ($livenear2ObjResult as $key => $value) {
				$this-> _selectLivenear2Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear2Options;
	}

	private function _getAllLivenear3ByLocaleId ($locale_id) {
		$livenear3Obj 	= new Estate_Model_Livenear3();
		$this -> _selectLivenear3Options = array ('' => $this -> view -> __('Root'));
		$livenear3ObjResult 	= $livenear3Obj -> getAllLivenear3ByLocaleId($locale_id);
		if (!empty($livenear3ObjResult)) {
			foreach ($livenear3ObjResult as $key => $value) {
				$this-> _selectLivenear3Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear3Options;
	}

	private function _getAllLivenear4ByLocaleId ($locale_id) {
		$livenear4Obj 	= new Estate_Model_Livenear4();
		$this -> _selectLivenear4Options = array ('' => $this -> view -> __('Root'));
		$livenear4ObjResult 	= $livenear4Obj -> getAllLivenear4ByLocaleId($locale_id);
		if (!empty($livenear4ObjResult)) {
			foreach ($livenear4ObjResult as $key => $value) {
				$this-> _selectLivenear4Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear4Options;
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
				'style' 		=> 'width:500px;height:900px;',
				'dijitParams' 	=> array('tabPosition' => 'right')
				)),
			'DijitForm'
		));
		
        $contactForm = new Zend_Dojo_Form_SubForm();
        $contactForm->setAttribs(array(
                    'name' 	 =>  'contact',
                    'legend' => $this-> view -> __ ( 'Real_Estate_Contact_Information' ),
        ));


		$contactForm->addElement(					
            'select',
            'contact_type',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Contact_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('contact_type'),
            )
        );
		$contactForm->addElement(
	        'ComboBox',
	        'contact_nid_cr',
	        array(
	            'label'     => $this-> view -> __ ( 'Real_Estate_Contact_NID_CR' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
                'name'		=> 'contact_nid_cr',
                'id'		=> 'contact_nid_cr',
                'value'		=> '',
	            'multiOptions' => $this -> _getAllContactNIDCR(),
	        )
		);
        $contactForm->addElement(
            'ValidationTextBox',
            'contact_bb',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Contact_BB' ),
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
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Contact_Full_Name' ),
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
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Mobile_1' ),
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
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Mobile_2' ),
                'trim' 		=> true,
                'required'	=> true,
                'name'		=> 'mobile_2',
                'id'		=> 'mobile_2',
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$contactForm->addElement( 
			'validationTextBox', 
			'email', 
			array(
				'required'  => true, 
				'name'		=> 'email',
				'id'		=> 'email',
				'label' 	=> $this-> view -> __ ( 'Real_Estate_Email' ),
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
				'label' 	=> $this-> view -> __ ( 'Real_Estate_Save' ),
				'type'	 	=> 'Submit',
				'ignore'	=> true,
				'onclick' 	=> 'dijit.byId("add-edit").submit()',
			)
		);
		
		
		


        $generalForm = new Zend_Dojo_Form_SubForm();
        $generalForm->setAttribs(array(
				'name' 	 =>  'general',
				'legend' => $this-> view -> __ ( 'Real_Estate_General_Information' ),
        ));
		

		$generalForm->addElement(					
            'select',
            'status',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('estate_status'),
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'job_card_number',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Job_Card_Number' ),
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
				'label' 	 => $this -> view -> __( 'Real_Estate_Advertise_Date' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
        $generalForm->addElement(
            'NumberTextBox',
            'advertise_period',
            array(
                'label' 	=> $this-> view -> __( 'Real_Estate_Advertise_Period' ),
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
            'NumberTextBox',
            'cost',
            array(
                'label' 	=> $this-> view -> __( 'Real_Estate_Cost' ),
                'class' 	=> 'lablvalue jstalgntop',
                'invalidMessage'=>'Invalid elevation.',
                'required'	=> true,
                'constraints' => array(
                    'min' 	=> 0,
                    'max'	=> 100000000000,
                    'places'=> 0,
                )
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'negotiable',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Negotiable' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'swap',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Swap' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$generalForm->addElement(					
            'select',
            'real_estate_for',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_For'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('real_estate_for'),
            )
        );
		$generalForm->addElement(					
            'select',
            'real_estate_type_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('real_estate_type'),
            )
        ); 
		$generalForm->addElement(					
            'select',
            'location_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Area_Location'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllAreaLocationByLocaleId($this -> getLocale()),
            )
        );
		$generalForm->addElement(					
            'select',
            'provence_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Provence'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllProvenceByLocaleId($this -> getLocale()),
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'estimated_area',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Estimated_Area' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'age',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Age' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'total_bed_rooms',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Total_Bed_Rooms' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'total_bath_rooms	',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Total_Bath_Rooms' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'stories',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Stories' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$generalForm->addElement(
            'CheckBox',
            'furniture',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Furniture' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(					
            'select',
            'air_condition_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Air_condition'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllAirConditionByLocaleId($this -> getLocale()),
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'first_owner',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_First_Owner' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );


		
		
		
        $mapForm = new Zend_Dojo_Form_SubForm();
        $mapForm->setAttribs(array(
                    'name' 	 =>  'map',
                    'legend' => $this-> view -> __ ( 'Real_Estate_Map' ),
        ));


        $mapForm->addElement(
            'ValidationTextBox',
            'longitude',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Longitude' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Latitude' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_1_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Live_Near_1'),
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear1ByLocaleId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_1',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Longitude_1' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_1',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Latitude_1' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_2_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Live_Near_2'),
                //'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear2ByLocaleId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_2',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Longitude_2' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_2',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Latitude_2' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_3_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Live_Near_3'),
                //'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear3ByLocaleId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_3',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Longitude_3' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_3',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Latitude_3' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_4_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Live_Near_4'),
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear4ByLocaleId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_4',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Longitude_4' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_4',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Latitude_4' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );





        $specificationForm = new Zend_Dojo_Form_SubForm();
        $specificationForm->setAttribs(array(
                    'name' 	 =>  'specification',
                    'legend' => $this-> view -> __ ( 'Real_Estate_Specification' ),
        ));


        $specificationForm->addElement(
            'ValidationTextBox',
            'master_bed_rooms',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Master_Bed_Rooms' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $specificationForm->addElement(
            'ValidationTextBox',
            'parking_garage',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Parking_Garage' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$specificationForm->addElement(					
            'select',
            'outdoor_amenities_id',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Outdoor_Amenities'),
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllOutdoorAmenitiesByLocaleId($this -> getLocale()),
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'club_house_gym',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Club_House_Gym' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(					
            'select',
            'kitchen',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Kitchen'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('Kitchen'),
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'pantries',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Pantries' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'powder_room',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Powder_Room' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'electricity',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Electricity' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'stone_cladding',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Stone_Cladding' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'wood_cladding',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Wood_Cladding' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'telephone_service',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Telephone_Service' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'security',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Security' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $specificationForm->addElement(
            'ValidationTextBox',
            'floor',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Floor' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$specificationForm->addElement(
            'CheckBox',
            'front_yard',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Front_Yard' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'back_yard',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Back_Yard' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'swimming_pool',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Swimming_Pool' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'intercom',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Swimming_Intercom' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'fire_alarm',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Fire_Alarm' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'fire_fighting',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Fire_Fighting' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'internet',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Internet' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'flooring_type',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Flooring_Type' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'built_in_clothes',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Built_In_Clothes' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'fiber_optic',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Fiber_Optic' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'reflected_glass',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Reflected_Glass' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'maintenance',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Maintenance' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'sub_rental',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Sub_Rental' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'expatriate_owner_ship',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Expatriate_Owner_Ship' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(					
            'select',
            'majlas',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Majlas'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('majlas'),
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'car_shed',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Car_Shed' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'water_supply',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Water_Supply' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(					
            'select',
            'drainage_type',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Drainage_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('drainage_type'),
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'fire_place',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Fire_Place' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'special_decoration',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Special_Decoration' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'ceiling_type',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Ceiling_Type' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'dining_room',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Dining_Room' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'elevators',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Elevators' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $specificationForm->addElement(
            'ValidationTextBox',
            'special_equipment',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Special_Equipment' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$specificationForm->addElement(
            'CheckBox',
            'basement',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Basement' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(					
            'select',
            'roof_type',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Roof_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('roof_type'),
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'stores',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Stores' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'housekeeping',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Housekeeping' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'garden',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Garden' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(					
            'select',
            'paved_road',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Paved_Road'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('paved_road'),
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'electrical_garage_door',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Electrical_Garage_Door' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'eco_green_building',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Eco_Green_Building' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$specificationForm->addElement(
            'CheckBox',
            'cctv',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_CCTV' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $specificationForm->addElement(
            'ValidationTextBox',
            'details',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Details' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );




        
        $systemForm= new Zend_Dojo_Form_SubForm();
        $systemForm->setAttribs(array(
            'name'			=> 'system',
            'dijitParams' 	=> array(
                'title' 	=> $this-> view -> __ ( 'Real_Estate_System_Information' ),
            )
        ));
		$systemForm->addElement(					
            'select',
            'money_status',
            array(
                'label' 		=> $this-> view -> __('Real_Estate_Money_Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('money_status'),
            )
        ); 

		$systemForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Approved' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$systemForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __( 'Real_Estate_Published' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$systemForm->addElement(
			'TextBox',
            'comments',
            array(
				'label' 	=> $this-> view -> __ ( 'Real_Estate_Comments' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $systemForm->addElement(
            'TextBox',
            'options',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Options' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
            	)
        );
		
		


        $this->addSubForm($contactForm 		, 'contact')
             ->addSubForm($generalForm 		, 'general')
             ->addSubForm($mapForm 			, 'map')
             ->addSubForm($specificationForm, 'specification')
			 ->addSubForm($systemForm		, 'system');

		
		

		$systemForm  ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$contactForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$generalForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$mapForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$specificationForm->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

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
		$mapForm->setElementDecorators(array(
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
	}


	public function videoForm($data) {
		// Begin Video Form
        $videoForm = new Zend_Dojo_Form_SubForm();
        $videoForm->setAttribs(array(
                'name'			=> 'video',
                'legend' 		=> 'video',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Real_Estate_Video' ),
                )
        ));
        $videoForm->addElement(
            'ValidationTextBox',
            'alias',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Alias' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $videoForm->addElement(
            'ValidationTextBox',
            'intro_text',
            array(
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Intro_Text' ),
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
		    	'label'     => $this -> view -> __ ( 'Real_Estate_Photo' ),
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
		    	'label'         => $this -> view -> __ ( 'Real_Estate_Upload' ),
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
                'label' 	=> $this-> view -> __ ( 'Real_Estate_Taken_Location' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $videoForm->addElement(
            'NumberTextBox',
            'order',
            array(
                'label' 	=> $this-> view -> __( 'Real_Estate_Order' ),
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
				'label' 	 => $this -> view -> __( 'Real_Estate_Taken_Date' ),
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
				'label' 	 => $this -> view -> __( 'Real_Estate_Publish_From' ),
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
				'label' 	 => $this -> view -> __( 'Real_Estate_Publish_To' ),
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
                'title' 	=> $this-> view -> __ ( 'Real_Estate_Photo' ) . ' ' . $number,
            )
        ));


		$photoForm->addElement(
			'file', 
			'photo_' . $number, 
			array(
				'required'	=> true,
		    	'label'     => $this -> view -> __ ( 'Real_Estate_Upload' ),
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