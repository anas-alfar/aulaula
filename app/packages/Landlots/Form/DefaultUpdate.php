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
 * @package Landlots
 * @subpackage Form
 * @name Landlots_Form_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Landlots_Form_DefaultUpdate extends Zend_Dojo_Form
{
	public $view = NULL;
	public $locale_id, $landlotsLookup;
	private $translator, $translateValidators;
	private $_selectForOptions, $_selectAreaLocationOptions, $_selectProvenceOptions, $_selectAncillaryBuildingOptions, $_selectContactNIDCROptions;
	private $_selectLivenear1Options, $_selectLivenear2Options, $_selectLivenear3Options, $_selectLivenear4Options;
	
	public function __construct($view) {
		$this->view = $view;
		parent::__construct();
	}

	public function setLocale ($fc) {
		 $this -> locale_id =  $fc->locale->default->current->id;
	}
	
	public function setLookup( $lookupObj ) {
		$this -> landlotsLookup = $lookupObj;
	}

	public function getLocale () {
		return $this -> locale_id;
	}
	
	public function getLookup ($comboBox) {
		return $this -> landlotsLookup[$comboBox];
	}
	
	private function _getAllLandlotsForByLocalId ($locale_id) {
		$forObj 	= new Landlots_Model_For();
		$this -> _selectForOptions = array ('' => $this -> view -> __('Root'));
		$forObjResult 	= $forObj -> getAllForByLocalId($locale_id);
		if (!empty($forObjResult)) {
			foreach ($forObjResult as $key => $value) {
				$this->_selectForOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectForOptions;
	}
	
	private function _getAllAreaLocationByLocalId ($locale_id) {
		$locationObj 	= new Landlots_Model_Location();
		$this -> _selectAreaLocationOptions = array ('' => $this -> view -> __('Root'));
		$locationObjResult 	= $locationObj -> getAllLocationByLocalId($locale_id);
		if (!empty($locationObjResult)) {
			foreach ($locationObjResult as $key => $value) {
				$this->_selectAreaLocationOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectAreaLocationOptions;
	}
	
	private function _getAllProvenceByLocalId ($locale_id) {
		$provenceObj 	= new Landlots_Model_Provence();
		$this -> _selectProvenceOptions = array ('' => $this -> view -> __('Root'));
		$provenceObjResult 	= $provenceObj -> getAllProvenceByLocalId($locale_id);
		if (!empty($provenceObjResult)) {
			foreach ($provenceObjResult as $key => $value) {
				$this->_selectProvenceOptions[$value['id']] = $value['title'];
			}
		}
		return $this->_selectProvenceOptions;
	}

	private function _getAllAncillaryBuildingByLocalId ($locale_id) {
		$ancillaryBuildingObj 	= new Landlots_Model_AncillaryBuildings();
		$this -> _selectAncillaryBuildingOptions = array ('' => $this -> view -> __('Root'));
		$ancillaryBuildingObjResult 	= $ancillaryBuildingObj -> getAllAncillaryBuildingByLocalId($locale_id);
		if (!empty($ancillaryBuildingObjResult)) {
			foreach ($ancillaryBuildingObjResult as $key => $value) {
				$this-> _selectAncillaryBuildingOptions[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectAncillaryBuildingOptions;
	}
	
	private function _getAllLivenear1ByLocalId ($locale_id) {
		$livenear1Obj 	= new Landlots_Model_Livenear1();
		$this -> _selectLivenear1Options = array ('' => $this -> view -> __('Root'));
		$livenear1ObjResult 	= $livenear1Obj -> getAllLivenear1ByLocalId($locale_id);
		if (!empty($livenear1ObjResult)) {
			foreach ($livenear1ObjResult as $key => $value) {
				$this-> _selectLivenear1Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear1Options;
	}
	
	private function _getAllLivenear2ByLocalId ($locale_id) {
		$livenear2Obj 	= new Landlots_Model_Livenear2();
		$this -> _selectLivenear2Options = array ('' => $this -> view -> __('Root'));
		$livenear2ObjResult 	= $livenear2Obj -> getAllLivenear2ByLocalId($locale_id);
		if (!empty($livenear2ObjResult)) {
			foreach ($livenear2ObjResult as $key => $value) {
				$this-> _selectLivenear2Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear2Options;
	}
	
	private function _getAllLivenear3ByLocalId ($locale_id) {
		$livenear3Obj 	= new Landlots_Model_Livenear3();
		$this -> _selectLivenear3Options = array ('' => $this -> view -> __('Root'));
		$livenear3ObjResult 	= $livenear3Obj -> getAllLivenear3ByLocalId($locale_id);
		if (!empty($livenear3ObjResult)) {
			foreach ($livenear3ObjResult as $key => $value) {
				$this-> _selectLivenear3Options[$value['id']] = $value['title'];
			}
		}
		return $this-> _selectLivenear3Options;
	}
	
	private function _getAllLivenear4ByLocalId ($locale_id) {
		$livenear4Obj 	= new Landlots_Model_Livenear4();
		$this -> _selectLivenear4Options = array ('' => $this -> view -> __('Root'));
		$livenear4ObjResult 	= $livenear4Obj -> getAllLivenear4ByLocalId($locale_id);
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
                    'legend' => $this-> view -> __ ( 'Landlots_Contact_Information' ),
        ));


		$contactForm->addElement(					
            'select',
            'contact_type',
            array(
                'label' 		=> $this-> view -> __('Landlots_Contact_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('contact_type'),
            )
        );
		$contactForm->addElement(
	        'ComboBox',
	        'contact_nid_cr',
	        array(
	            'label'     => $this-> view -> __ ( 'Landlots_Contact_NID_CR' ),
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
                'label' 	=> $this-> view -> __ ( 'Landlots_Contact_BB' ),
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
                'label' 	=> $this-> view -> __ ( 'Landlots_Contact_Full_Name' ),
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
                'label' 	=> $this-> view -> __ ( 'Landlots_Mobile_1' ),
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
                'label' 	=> $this-> view -> __ ( 'Landlots_Mobile_2' ),
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
				'label' 	=> $this-> view -> __ ( 'Landlots_Email' ),
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
				'label' 	=> $this-> view -> __ ( 'Landlots_Save' ),
				'type'	 	=> 'Submit',
				'ignore'	=> true,
				'onclick' 	=> 'dijit.byId("add-edit").submit()',
			)
		);
		
		
		



        $generalForm = new Zend_Dojo_Form_SubForm();
        $generalForm->setAttribs(array(
				'name' 	 =>  'general',
				'legend' => $this-> view -> __ ( 'Landlots_General_Information' ),
        ));
		

		$generalForm->addElement(					
            'select',
            'status',
            array(
                'label' 		=> $this-> view -> __('Landlots_Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('landlots_status'),
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'job_card_number',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Job_Card_Number' ),
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
				'label' 	 => $this -> view -> __( 'Landlots_Advertise_Date' ),
                'trim' 		 => true,
                'required'	 => true,
                'class' 	 => 'lablvalue jstalgntop'
            )
        );
        $generalForm->addElement(
            'NumberTextBox',
            'advertise_period',
            array(
                'label' 	=> $this-> view -> __( 'Landlots_Advertise_Period' ),
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
                'label' 	=> $this-> view -> __( 'Landlots_Cost' ),
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
                'label' 		=> $this-> view -> __( 'Landlots_Negotiable' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'swap',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Swap' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$generalForm->addElement(					
            'select',
            'landlots_for_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_For'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLandlotsForByLocalId($this -> getLocale()),
            )
        );
		$generalForm->addElement(					
            'select',
            'building_permit_type_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Building_Permit_Type'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('building_permit_type'),
            )
        ); 
		$generalForm->addElement(					
            'select',
            'location_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Area_Location'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllAreaLocationByLocalId($this -> getLocale()),
            )
        );
		$generalForm->addElement(					
            'select',
            'provence_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Provence'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllProvenceByLocalId($this -> getLocale()),
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'electricity',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Electricity' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'water_supply',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Water_Supply' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'drainage',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Drainage' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(					
            'select',
            'boundary',
            array(
                'label' 		=> $this-> view -> __('Landlots_Boundary'),
                //'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('boundary'),
            )
        ); 
		$generalForm->addElement(
            'CheckBox',
            'plants',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Plants' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'water_well',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Water_Well' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(					
            'select',
            'ancillary_buildings_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Ancillary_Buildings'),
                //'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllAncillaryBuildingByLocalId($this -> getLocale()),
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'farmed',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Farmed' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
		$generalForm->addElement(
            'CheckBox',
            'expatriate_ownership',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Expatriate_Ownership' ),
                'checkedValue' 	=> '1',
                'uncheckedValue'=> '0',
            )
        );
        $generalForm->addElement(
            'ValidationTextBox',
            'details',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Details' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );


		
		
        $mapForm = new Zend_Dojo_Form_SubForm();
        $mapForm->setAttribs(array(
                    'name' 	 =>  'map',
                    'legend' => $this-> view -> __ ( 'Landlots_Map' ),
        ));
		
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Longitude' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Latitude' ),
                'trim' 		=> true,
                //'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_1_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Live_Near_1'),
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear1ByLocalId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_1',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Longitude_1' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_1',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Latitude_1' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_2_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Live_Near_2'),
                //'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear2ByLocalId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_2',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Longitude_2' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_2',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Latitude_2' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_3_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Live_Near_3'),
                //'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear3ByLocalId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_3',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Longitude_3' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_3',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Latitude_3' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
		$mapForm->addElement(					
            'select',
            'livenear_4_id',
            array(
                'label' 		=> $this-> view -> __('Landlots_Live_Near_4'),
                'value'			=> '',
	            'multiOptions'  => $this -> _getAllLivenear4ByLocalId($this -> getLocale()),
            )
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'longitude_4',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Longitude_4' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );
        $mapForm->addElement(
            'ValidationTextBox',
            'latitude_4',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Latitude_4' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
			)
        );



        
        $systemForm= new Zend_Dojo_Form_SubForm();
        $systemForm->setAttribs(array(
            'name'			=> 'system',
            'dijitParams' 	=> array(
                'title' 	=> $this-> view -> __ ( 'Landlots_System_Information' ),
            )
        ));
		$systemForm->addElement(					
            'select',
            'money_status',
            array(
                'label' 		=> $this-> view -> __('Landlots_Money_Status'),
                'required'		=> true,
                'value'			=> '',
	            'multiOptions'  => $this -> getLookup ('money_status'),
            )
        ); 

		$systemForm->addElement(
            'CheckBox',
            'approved',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Approved' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$systemForm->addElement(
            'CheckBox',
            'published',
            array(
                'label' 		=> $this-> view -> __( 'Landlots_Published' ),
                'checkedValue' 	=> 'Yes',
                'uncheckedValue'=> 'No',
            )
        );
		$systemForm->addElement(
			'TextBox',
            'comments',
            array(
				'label' 	=> $this-> view -> __ ( 'Landlots_Comments' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
                )
        );
        $systemForm->addElement(
            'TextBox',
            'options',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Options' ),
                'trim' 		=> true,
                'required'	=> false,
                'class' 	=> 'lablvalue jstalgntop',
            	)
        );
		
		


        $this->addSubForm($contactForm , 'contact')
             ->addSubForm($generalForm , 'general')
             ->addSubForm($mapForm , 'map')
			 ->addSubForm($systemForm, 'system');

		
		

		$systemForm  ->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$contactForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$generalForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );
		$mapForm	->setDecorators ( array ('FormElements', array ('HtmlTag', array ('tag' => 'table', 'class'=>'formlist' ) ), 'ContentPane' ) );

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
	}


	public function videoForm($data) {
		// Begin Video Form
        $videoForm = new Zend_Dojo_Form_SubForm();
        $videoForm->setAttribs(array(
                'name'			=> 'video',
                'legend' 		=> 'video',
                'dijitParams' 	=> array(
                    'title' 	=> $this-> view -> __ ( 'Landlots_Video' ),
                )
        ));
        $videoForm->addElement(
            'ValidationTextBox',
            'alias',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Alias' ),
                'trim' 		=> true,
                'required'	=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $videoForm->addElement(
            'ValidationTextBox',
            'intro_text',
            array(
                'label' 	=> $this-> view -> __ ( 'Landlots_Intro_Text' ),
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
		    	'label'     => $this -> view -> __ ( 'Landlots_Photo' ),
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
		    	'label'         => $this -> view -> __ ( 'Landlots_Upload' ),
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
                'label' 	=> $this-> view -> __ ( 'Landlots_Taken_Location' ),
                'trim' 		=> true,
                'class' 	=> 'lablvalue jstalgntop',
            )
        );
        $videoForm->addElement(
            'NumberTextBox',
            'order',
            array(
                'label' 	=> $this-> view -> __( 'Landlots_Order' ),
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
				'label' 	 => $this -> view -> __( 'Landlots_Taken_Date' ),
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
				'label' 	 => $this -> view -> __( 'Landlots_Publish_From' ),
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
				'label' 	 => $this -> view -> __( 'Landlots_Publish_To' ),
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
                'title' 	=> $this-> view -> __ ( 'Landlots_Photo' ) . ' ' . $number,
            )
        ));


		$photoForm->addElement(
			'file', 
			'photo_' . $number, 
			array(
				'required'	=> true,
		    	'label'     => $this -> view -> __ ( 'Landlots_Upload' ),
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