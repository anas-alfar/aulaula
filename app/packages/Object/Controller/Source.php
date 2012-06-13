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
 * @subpackage Controller
 * @name Object_Controller_Source
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Controller_Source extends Aula_Controller_Action {

	private $objectObj = NULL;
	private $objectInfoObj = NULL;
	private $abuseObj = NULL;
	private $abuseTypeObj = NULL;
	private $articleObj = NULL;
	private $commentObj = NULL;
	private $directoryObj = NULL;
	private $fileObj = NULL;
	private $photoObj = NULL;
	private $ratingObj = NULL;
	private $sourceInfoObj = NULL;
	private $sourceObj = NULL;
	private $staticObj = NULL;
	private $tagObj = NULL;
	private $typeObj = NULL;
	private $typeIfnoObj = NULL;
	private $urlObj = NULL;
	private $userFavouriteObj = NULL;
	private $videoObj = NULL;

	//theme objects
	private $themeObj = NULL;
	private $layoutObj = NULL;
	private $skinObj = NULL;
	private $templateObj = NULL;

	//locale object
	private $lcoaleObj = NULL;

	//category object
	private $categoryObj = NULL;

	protected function _init() {
		//default objects
		$this -> objectObj = new Object_Model_Default();
		$this -> objectInfoObj = new Object_Model_Info();

		//objects
		$this -> sourceObj = new Object_Model_Source();
		$this -> sourceInfoObj = new Object_Model_SourceInfo();

		//country object
		$this -> countryObj = new Aula_Model_CountriesList();

		//category object
		$this -> categoryObj = new Category_Model_Default();

		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'sourceId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'author' => array('numericUnsigned', 0, $this -> userId), 'nameSource' => array('text', 1), 'descriptionSource' => array('text', 0), 'sourceType' => array('numericUnsigned', 1), 'countrySource' => array('numericUnsigned', 1), 'urlSource' => array('url', 1), 'timeDelay' => array('numericUnsigned', 0, $this -> sourceObj -> timeDelay), 'package' => array('numericUnsigned', 0, $this -> sourceObj -> packageId), 'published' => array('text', 0, $this -> sourceObj -> published), 'approved' => array('text', 0, $this -> sourceObj -> approved), 'order' => array('numeric', 0, $this -> sourceObj -> order), 'afterId' => array('numeric', 0), 'publishFrom' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> sourceInfoObj -> publishTo), 'comment' => array('text', 0, $this -> sourceInfoObj -> comments), 'option' => array('text', 0, $this -> sourceInfoObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		//countrySource list
		$this -> countryList = '';
		$this -> countryListResult = $this -> countryObj -> enCountriesList();
		if (!empty($this -> countryListResult)) {
			foreach ($this->countryListResult as $key => $value) {
				$selectedItem = ($key == $this -> view -> sanitized['countrySource']['value']) ? 'selected="selected"' : '';
				$this -> countryList .= '<option value="' . $key . '"' . $selectedItem . '>' . $value . '</option>';
			}
		}
		$this -> view -> countryList = $this -> countryList;

		//Source Type List
		$this -> sourceTypeList = '';
		$this -> sourceTypeResult = array('rss' => 'rss', 'atom' => 'atom', 'csv' => 'csv', 'webservice' => 'webservice', 'twitt' => 'twitt', 'youtube' => 'youtube', 'flicker' => 'flicker');
		if (!empty($this -> sourceTypeResult)) {
			foreach ($this->sourceTypeResult as $key => $value) {
				$selectedItem = ($key == $this -> view -> sanitized['sourceType']['value']) ? 'selected="selected"' : '';
				$this -> countryList .= '<option value="' . $key . '"' . $selectedItem . '>' . $value . '</option>';
			}
		}
		$this -> view -> sourceTypeList = $this -> sourceTypeList;
	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

}
