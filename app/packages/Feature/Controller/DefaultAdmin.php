<?php
/**
 * 
 * This is the default controller for the Tag package
 * 
 * @name Feature_Controller_Defualt
 * @author Saad Jamous
 * @copyright Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @license Open Software License (OSL 3.0)
 * @package Tag
 * @subpackage none
 * @version 0.1
 *
 */

class Feature_Controller_DefaultAdmin extends Aula_Controller_Action {
	private $articleObj = NULL;
	
	/**
	 * 
	 * This id the default action for the controller
	 * 
	 * @name addAdminAction
	 * @author Saad Jamous
	 * @access Admin Area
	 * @version 0.1
	 * @copyright 2010
	 * @todo  
	 * @param 
	 * @return  
	 * 
	 */
	public function _init() {
		$this->articleObj = new Object_Model_Article ();
		
		$this->defualtAction = 'list';
		$this->defualtAdminAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('actionURI' => array ('uri', 0 ), 'redirectURI' => array ('uri', 0, '' ), 'featureId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'id' => array ('text', 0 ), 'title' => array ('text', 0 ), 'locale' => array ('numericUnsigned', 0 ), 'order' => array ('numericUnsigned', 0 ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
	}
	
	/**
	 * 
	 * This function will handle the insert action into Tag table
	 * 
	 * @name addAdminAction
	 * @author Saad Jamous
	 * @access Admin Area
	 * @version 0.1
	 * @copyright 2010
	 * @todo  
	 * @param 
	 * @return  
	 * 
	 */
	
	public function addAction() {
		$featureListResult = array ();
		$articleResult = $this->articleObj->getObject_articleDetailsById ( ( int ) $_GET ['id'] );
		$articleResult = $articleResult [0];
		if (file_exists ( $this->fc->settings->directories->cache . 'Feature.xml' )) {
			$featureListResult = new Zend_Config_Xml ( $this->fc->settings->directories->cache . 'Feature.xml', NULL, TRUE );
		}
		$featureList = '<?xml version="1.0"?>' . PHP_EOL . "\t<features>";
		if (isset ( $featureListResult ) and ! empty ( $featureListResult )) {
			foreach ( $featureListResult as $key => $value ) {
				$featureList .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
			}
		}
		if (is_array ( $articleResult )) {
			if (! isset ( $key )) {
				$key = 'article-0';
			}
			$key = explode ( '-', $key );
			$key = 'article-' . ++ $key [1];
			$featureList .= '<' . $key . '><![CDATA[' . $articleResult ['id'] . '||' . $articleResult ['alias'] . ']]></' . $key . '>';
			$featureList .= PHP_EOL . "\t</features>";
			$result = file_put_contents ( $this->fc->settings->directories->cache . 'Feature.xml', $featureList );
		}
		
		header ( 'Location: /admin/handle/pkg/feature/action/list/s/1' );
		exit ();
	}
	
	public function importAction($id = NULL) {
		if (is_null ( $id )) {
			return false;
		}
		
		$featureListResult = array ();
		$articleResult = $this->articleObj->getObject_articleDetailsById ( ( int ) $id );
		$articleResult = $articleResult [0];
		if (file_exists ( $this->fc->settings->directories->cache . 'Feature.xml' )) {
			$featureListResult = new Zend_Config_Xml ( $this->fc->settings->directories->cache . 'Feature.xml', NULL, TRUE );
		}
		$featureList = '<?xml version="1.0"?>' . PHP_EOL . "\t<features>";
		if (isset ( $featureListResult ) and ! empty ( $featureListResult )) {
			foreach ( $featureListResult as $key => $value ) {
				$featureList .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
			}
		}
		if (is_array ( $articleResult )) {
			if (! isset ( $key )) {
				$key = 'article-0';
			}
			$key = explode ( '-', $key );
			$key = 'article-' . ++ $key [1];
			$featureList .= '<' . $key . '><![CDATA[' . $articleResult ['id'] . '||' . $articleResult ['alias'] . ']]></' . $key . '>';
			$featureList .= PHP_EOL . "\t</features>";
			$result = file_put_contents ( $this->fc->settings->directories->cache . 'Feature.xml', $featureList );
			
			return true;
		}
		
		return false;
	}
	
	public function deleteAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$featureDelete = array ();
		if (! empty ( $this->view->sanitized->featureId->value )) {
			foreach ( $this->view->sanitized->featureId->value as $id => $value ) {
				$featureDelete [$id] = $id;
			}
			$featureListResult = new Zend_Config_Xml ( $this->fc->settings->directories->cache . 'Feature.xml', NULL, TRUE );
			$featureListResult = $featureListResult->toArray ();
			$featureList = '<?xml version="1.0"?>' . PHP_EOL . "\t<features>";
			foreach ( $featureListResult as $key => $value ) {
				if (in_array ( $key, $featureDelete )) {
					continue;
				}
				$featureList .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
			}
			
			$featureList .= PHP_EOL . "\t</features>";
			$result = file_put_contents ( $this->fc->settings->directories->cache . 'Feature.xml', $featureList );
			if ($result !== false) {
				header ( 'Location: /admin/handle/pkg/feature/action/list/success/delete' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/feature/action/list/' );
		exit ();
	}
	
	public function listAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$this->view->sanitized->actionURI->value = '/admin/handle/pkg/feature/action/';
		
		if (! empty ( $_GET ['success'] )) {
			$this->view->successMessageStyle = 'display: block;';
			switch ($_GET ['success']) {
				case 'delete' :
					$this->view->successMessage = $this->view->__ ( 'Records successfully Deleted' );
					break;
			}
		}
		
		if (isset ( $_SERVER ['REQUEST_URI'] ) and ! empty ( $_SERVER ['REQUEST_URI'] )) {
			$this->view->sanitized->redirectURI->value = $_SERVER ['REQUEST_URI'];
		}
		
		if (file_exists ( $this->fc->settings->directories->cache . 'Feature.xml' )) {
			$featureListResult = new Zend_Config_Xml ( $this->fc->settings->directories->cache . 'Feature.xml', NULL );
		}
		//listing
		if (empty ( $featureListResult ) and false == $featureListResult) {
			$this->view->notificationMessage = $this->view->__ ( 'Sorry, no records found' );
			$this->view->notificationMessageStyle = 'display: block;';
		}
		
		$this->view->featureList = $featureListResult;
		$this->view->render ( 'feature/listFeature.phtml' );
		exit ();
	}
	
	public function getAllAction() {
		$featureListResult = array ();
		if (file_exists ( $this->fc->settings->directories->cache . 'Feature.xml' )) {
			$featureListResult = new Zend_Config_Xml ( $this->fc->settings->directories->cache . 'Feature.xml', NULL );
			$featureListResult = $featureListResult->toArray ();
		}
		//listing
		$featureList = '';
		if (! empty ( $featureListResult ) and false != $featureListResult) {
			foreach ( $featureListResult as $key => $value ) {
				$value = explode ( '||', $value );
				$featureList [$value [0]] = $value [1];
			}
		}
		return $featureList;
	}
	
	/**
	 * 
	 * This function will handle the edit action for a record in the Tag table
	 * 
	 * @name orderAdminAction
	 * @author Saad Jamous
	 * @access Admin Area
	 * @version 0.1
	 * @copyright 2010
	 * @todo  have do this function
	 * @param 
	 * @return  
	 * 
	 */
	public function orderAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$featureDelete = array ();
		
		if (! empty ( $this->view->sanitized->featureId->value )) {
			foreach ( $this->view->sanitized->featureId->value as $id => $value ) {
				$feature [$id] = $id;
			}
			foreach ( $this->view->sanitized->id->value as $id => $value ) {
				$ID [$id] = $value;
			}
			foreach ( $this->view->sanitized->title->value as $id => $value ) {
				$title [$id] = $value;
			}
			
			foreach ( $this->view->sanitized->order->value as $id => $value ) {
				$order [$id] = $value;
			}
			$featureListResult = new Zend_Config_Xml ( $this->fc->settings->directories->cache . 'Feature.xml', NULL, TRUE );
			$featureListResult = $featureListResult->toArray ();
			$featureList = '<?xml version="1.0"?>' . PHP_EOL . "\t<features>";
			asort ( $order );
			
			foreach ( $order as $key => $value ) {
				$featureList .= '<article-' . $value . '><![CDATA[' . $ID [$key] . '||' . $title [$key] . ']]></article-' . $value . '>';
			}
			$featureList .= PHP_EOL . "\t</features>";
			$result = file_put_contents ( $this->fc->settings->directories->cache . 'Feature.xml', $featureList );
			if ($result !== false) {
				header ( 'Location: /admin/handle/pkg/feature/action/list/success/delete' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/feature/action/list/' );
		exit ();
	}

}