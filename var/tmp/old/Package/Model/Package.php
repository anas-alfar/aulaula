<?php
/**
 * 
 * This class generates standard stored methods for every table in your database
 * This means that at the end of execution you'll have 5 stored methods for each table 
 * Those stored methods are:
 * 
 * - Get All Fields and Records From Table
 * - Get All Fields From Table By Primary Key
 * - Get All Fields From Table By Each Column
 * - Insert Into Table
 * - Update Statement By Primary Key
 * - Update Statement By Each Column
 * - Update Statement for Each Column By Primary Key
 * - Delete from Table By Primary Key
 * - Delete from Table By Each Column
 * 
 * 
 * @name Package_Model_Package
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Package_Model_Default {
	
	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'package';
	public $columns = array ('id', 'title', 'label', 'show_in_menu', 'published', 'approved', 'type', 'prerequisite_id');
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $showInMenu = 'No';
	public $approved = 'No';
	public $type = 'Module';
	public $prerequisiteId = 1;
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoPackage
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoPackage($Id, $Title = '', $Label = '', $Show_in_menu = 'No', $Published = 'No', $Approved = 'No', $Type = 'Module', $Prerequisite_id = '0') {
		
		$Id = ( int ) $Id;
		$Title = mysql_escape_string ( $Title );
		$Label = mysql_escape_string ( $Label );
		$Show_in_menu = mysql_escape_string ( $Show_in_menu );
		$Published = mysql_escape_string ( $Published );
		$Approved = mysql_escape_string ( $Approved );
		$Type = mysql_escape_string ( $Type );
		$Prerequisite_id = ( int ) $Prerequisite_id;
		
		$query = "CALL SP_insertIntoPackage (NULL, '$Title', '$Label', '$Show_in_menu', '$Published', '$Approved', '$Type', '$Prerequisite_id')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return $result;
	} //End Function insertIntoPackage
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageById($Id) {
		
		$Id = ( int ) $Id;
		
		$query = "CALL SP_deleteFromPackageById ('$Id')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageById
	

	/**
	 * This Method is Script Generated 
	 * updatePackageById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageById($Id, $Title = '', $Label = '', $Show_in_menu = 'No', $Published = 'No', $Approved = 'No', $Type = 'Module', $Prerequisite_id = '0') {
		
		$Id = ( int ) $Id;
		$Title = mysql_escape_string ( $Title );
		$Label = mysql_escape_string ( $Label );
		$Show_in_menu = mysql_escape_string ( $Show_in_menu );
		$Published = mysql_escape_string ( $Published );
		$Approved = mysql_escape_string ( $Approved );
		$Type = mysql_escape_string ( $Type );
		$Prerequisite_id = ( int ) $Prerequisite_id;
		
		$query = "CALL SP_updatePackageById ('$Id', '$Title', '$Label', '$Show_in_menu', '$Published', '$Approved', '$Type', '$Prerequisite_id')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesOrderById($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesOrderById ('$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesOrderByIdWithLimit ('$start' , '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getPackageDetailsByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPackageDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {
		
		$Id = ( int ) $Id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		
		$query = "CALL SP_getPackageDetailsByIdWithLimit ('$Id', '$start' , '$limit')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getPackageDetailsByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getPackageDetailsById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPackageDetailsById($Id) {
		
		$Id = ( int ) $Id;
		
		$query = "CALL SP_getPackageDetailsById ('$Id')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getPackageDetailsById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByIdOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByIdOrderById($Id, $sorting = 'DESC') {
		
		$Id = ( int ) $Id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByIdOrderById ('$Id', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByIdOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByIdOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByIdOrderByIdWithLimit($Id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Id = ( int ) $Id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByIdOrderByIdWithLimit ('$Id', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByIdOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * updatePackageIdColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageIdColumnById($Id, $Id) {
		
		$Id = ( int ) $Id;
		$Id = ( int ) $Id;
		
		$query = "CALL SP_updatePackageIdColumnById ('$Id', '$Id')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageIdColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByTitleOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByTitleOrderById($Title = '', $sorting = 'DESC') {
		
		$Title = mysql_escape_string ( $Title );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByTitleOrderById ('$Title', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByTitleOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByTitleOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByTitleOrderByIdWithLimit($Title = '', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Title = mysql_escape_string ( $Title );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByTitleOrderByIdWithLimit ('$Title', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByTitleOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByTitle
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByTitle($Title = '') {
		
		$Title = mysql_escape_string ( $Title );
		
		$query = "CALL SP_deleteFromPackageByTitle ('$Title')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByTitle
	

	/**
	 * This Method is Script Generated 
	 * updatePackageTitleColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageTitleColumnById($Id, $Title = '') {
		
		$Id = ( int ) $Id;
		$Title = mysql_escape_string ( $Title );
		
		$query = "CALL SP_updatePackageTitleColumnById ('$Id', '$Title')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageTitleColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByLabelOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByLabelOrderById($Label = '', $sorting = 'DESC') {
		
		$Label = mysql_escape_string ( $Label );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByLabelOrderById ('$Label', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByLabelOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByLabelOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByLabelOrderByIdWithLimit($Label = '', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Label = mysql_escape_string ( $Label );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByLabelOrderByIdWithLimit ('$Label', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByLabelOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByLabel
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByLabel($Label = '') {
		
		$Label = mysql_escape_string ( $Label );
		
		$query = "CALL SP_deleteFromPackageByLabel ('$Label')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByLabel
	

	/**
	 * This Method is Script Generated 
	 * updatePackageLabelColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageLabelColumnById($Id, $Label = '') {
		
		$Id = ( int ) $Id;
		$Label = mysql_escape_string ( $Label );
		
		$query = "CALL SP_updatePackageLabelColumnById ('$Id', '$Label')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageLabelColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByShow_in_menuOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByShow_in_menuOrderById($Show_in_menu = 'No', $sorting = 'DESC') {
		
		$Show_in_menu = mysql_escape_string ( $Show_in_menu );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByShow_in_menuOrderById ('$Show_in_menu', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByShow_in_menuOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByShow_in_menuOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByShow_in_menuOrderByIdWithLimit($Show_in_menu = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Show_in_menu = mysql_escape_string ( $Show_in_menu );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByShow_in_menuOrderByIdWithLimit ('$Show_in_menu', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByShow_in_menuOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByShow_in_menu
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByShow_in_menu($Show_in_menu = 'No') {
		
		$Show_in_menu = mysql_escape_string ( $Show_in_menu );
		
		$query = "CALL SP_deleteFromPackageByShow_in_menu ('$Show_in_menu')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByShow_in_menu
	

	/**
	 * This Method is Script Generated 
	 * updatePackageShow_in_menuColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageShow_in_menuColumnById($Id, $Show_in_menu = 'No') {
		
		$Id = ( int ) $Id;
		$Show_in_menu = mysql_escape_string ( $Show_in_menu );
		
		$query = "CALL SP_updatePackageShow_in_menuColumnById ('$Id', '$Show_in_menu')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageShow_in_menuColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByPublishedOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByPublishedOrderById($Published = 'No', $sorting = 'DESC') {
		
		$Published = mysql_escape_string ( $Published );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByPublishedOrderById ('$Published', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByPublishedOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByPublishedOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByPublishedOrderByIdWithLimit($Published = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Published = mysql_escape_string ( $Published );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByPublishedOrderByIdWithLimit ('$Published', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByPublishedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByPublished
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByPublished($Published = 'No') {
		
		$Published = mysql_escape_string ( $Published );
		
		$query = "CALL SP_deleteFromPackageByPublished ('$Published')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByPublished
	

	/**
	 * This Method is Script Generated 
	 * updatePackagePublishedColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackagePublishedColumnById($Id, $Published = 'No') {
		
		$Id = ( int ) $Id;
		$Published = mysql_escape_string ( $Published );
		
		$query = "CALL SP_updatePackagePublishedColumnById ('$Id', '$Published')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackagePublishedColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByApprovedOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByApprovedOrderById($Approved = 'No', $sorting = 'DESC') {
		
		$Approved = mysql_escape_string ( $Approved );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByApprovedOrderById ('$Approved', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByApprovedOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByApprovedOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByApprovedOrderByIdWithLimit($Approved = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Approved = mysql_escape_string ( $Approved );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByApprovedOrderByIdWithLimit ('$Approved', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByApprovedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByApproved
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByApproved($Approved = 'No') {
		
		$Approved = mysql_escape_string ( $Approved );
		
		$query = "CALL SP_deleteFromPackageByApproved ('$Approved')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByApproved
	

	/**
	 * This Method is Script Generated 
	 * updatePackageApprovedColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageApprovedColumnById($Id, $Approved = 'No') {
		
		$Id = ( int ) $Id;
		$Approved = mysql_escape_string ( $Approved );
		
		$query = "CALL SP_updatePackageApprovedColumnById ('$Id', '$Approved')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageApprovedColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByTypeOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByTypeOrderById($Type = 'Module', $sorting = 'DESC') {
		
		$Type = mysql_escape_string ( $Type );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByTypeOrderById ('$Type', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByTypeOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByTypeOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByTypeOrderByIdWithLimit($Type = 'Module', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Type = mysql_escape_string ( $Type );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByTypeOrderByIdWithLimit ('$Type', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByTypeOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByType
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByType($Type = 'Module') {
		
		$Type = mysql_escape_string ( $Type );
		
		$query = "CALL SP_deleteFromPackageByType ('$Type')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByType
	

	/**
	 * This Method is Script Generated 
	 * updatePackageTypeColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageTypeColumnById($Id, $Type = 'Module') {
		
		$Id = ( int ) $Id;
		$Type = mysql_escape_string ( $Type );
		
		$query = "CALL SP_updatePackageTypeColumnById ('$Id', '$Type')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageTypeColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByPrerequisite_idOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByPrerequisite_idOrderById($Prerequisite_id = '0', $sorting = 'DESC') {
		
		$Prerequisite_id = ( int ) $Prerequisite_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByPrerequisite_idOrderById ('$Prerequisite_id', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByPrerequisite_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByPrerequisite_idOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByPrerequisite_idOrderByIdWithLimit($Prerequisite_id = '0', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Prerequisite_id = ( int ) $Prerequisite_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByPrerequisite_idOrderByIdWithLimit ('$Prerequisite_id', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByPrerequisite_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByPrerequisite_id
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByPrerequisite_id($Prerequisite_id = '0') {
		
		$Prerequisite_id = ( int ) $Prerequisite_id;
		
		$query = "CALL SP_deleteFromPackageByPrerequisite_id ('$Prerequisite_id')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByPrerequisite_id
	

	/**
	 * This Method is Script Generated 
	 * updatePackagePrerequisite_idColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackagePrerequisite_idColumnById($Id, $Prerequisite_id = '0') {
		
		$Id = ( int ) $Id;
		$Prerequisite_id = ( int ) $Prerequisite_id;
		
		$query = "CALL SP_updatePackagePrerequisite_idColumnById ('$Id', '$Prerequisite_id')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackagePrerequisite_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByDate_addedOrderById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByDate_addedOrderById ('$Date_added', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByDate_addedOrderById
	

	/**
	 * This Method is Script Generated 
	 * getAllPackagesByDate_addedOrderByIdWithLimit
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getAllPackagesByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_getAllPackagesByDate_addedOrderByIdWithLimit ('$Date_added', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getAllPackagesByDate_addedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromPackageByDate_added
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackageByDate_added($Date_added = 'CURRENT_TIMESTAMP') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		
		$query = "CALL SP_deleteFromPackageByDate_added ('$Date_added')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromPackageByDate_added
	

	/**
	 * This Method is Script Generated 
	 * updatePackageDate_addedColumnById
	 * Generated Date: 2010-04-11 17:10:11 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackageDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {
		
		$Id = ( int ) $Id;
		$Date_added = mysql_escape_string ( $Date_added );
		
		$query = "CALL SP_updatePackageDate_addedColumnById ('$Id', '$Date_added')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updatePackageDate_addedColumnById
}