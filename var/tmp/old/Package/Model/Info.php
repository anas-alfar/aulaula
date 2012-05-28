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
 * @name Package_Model_Info
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Package_Model_Info extends Aula_Controller_Action {

	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'package_info';
	public $insertColumnsList = ''; 
	public $updateColumnsParamsListWithoutPrimaryKey = ''; 
	public $_selectColumnsList = ''; 
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $defaultActionTitle = '';
	public $defaultActionName = '';
	public $version = '1.0';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `package_id`, `default_action_title`, `default_action_name`, `version`, `locked_by`, `locked_time`, `comments`, `options`"; 
		$this -> _selectColumnsList = '`id`, `package_id`, `default_action_title`, `default_action_name`, `version`, `locked_by`, `locked_time`, `date_added`, `comments`, `options`'; 
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoPackage_info
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoPackage_info($Id, $Package_id, $Comments, $Options,$Default_action_title = '', $Default_action_name = '', $Version = '1.0', $Locked_by, $Locked_time = '0000-00-00 00:00:00') {
		
		$Id = (int) $Id;
		$Package_id = (int) $Package_id;
		$Default_action_title =  mysql_escape_string($Default_action_title);
		$Default_action_name =  mysql_escape_string($Default_action_name);
		$Version =  mysql_escape_string($Version);
		$Locked_by = (int) $Locked_by;
		$Locked_time =  mysql_escape_string($Locked_time);
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);

		$query  = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Package_id', '$Default_action_title', '$Default_action_name', '$Version', '$Locked_by', '$Locked_time', '$Comments', '$Options') ";
		
		$result = $this->dbLink->query($query);
		
		if (! $result) {
			return false;
		}

		$query = 'SELECT last_insert_id()';

		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return $result;
	}//End Function insertIntoPackage_info

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoById ($Id){
	
		$Id = (int) $Id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoById

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoById($Id, $Package_id, $Comments, $Options,$Default_action_title = '', $Default_action_name = '', $Version = '1.0', $Locked_by, $Locked_time = '0000-00-00 00:00:00') {
		
		$Id = (int) $Id;
		$Package_id = (int) $Package_id;
		$Default_action_title =  mysql_escape_string($Default_action_title);
		$Default_action_name =  mysql_escape_string($Default_action_name);
		$Version =  mysql_escape_string($Version);
		$Locked_by = (int) $Locked_by;
		$Locked_time =  mysql_escape_string($Locked_time);
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET  `package_id` = '$Package_id', `default_action_title` = '$Default_action_title', `default_action_name` = '$Default_action_name', `version` = '$Version', `locked_by` = '$Locked_by', `locked_time` = '$Locked_time', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderById ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY id $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByIdWithLimit ($start = 0, $limit = 10, $sorting = 'DESC'){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY id $sorting LIMIT $start , $limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getPackage_infoDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPackage_infoDetailsByIdWithLimit ($Id, $start = 0, $limit = 10){		
		
		$Id = (int) $Id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE id = '$Id' LIMIT $start , $limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function getPackage_infoDetailsByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getPackage_infoDetailsById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPackage_infoDetailsById ($Id){		
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function getPackage_infoDetailsById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderById ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `id` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByIdWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `id` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByPackage_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByPackage_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Package_id` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByPackage_id

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByPackage_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Package_id` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByPackage_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByPackage_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `package_id` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByPackage_id

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByPackage_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `package_id` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByPackage_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByPackage_idOrderById ($Package_id , $sorting = 'DESC'){		
		
		$Package_id = (int) $Package_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByPackage_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByPackage_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByPackage_idOrderByIdWithLimit ($Package_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Package_id = (int) $Package_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByPackage_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByPackage_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByPackage_id ($Package_id ){
	
		$Package_id = (int) $Package_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByPackage_id

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoPackage_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoPackage_idColumnById ($Id, $Package_id ){
	
		$Id = (int) $Id;
		$Package_id = (int) $Package_id;
	
		$query  = "UPDATE `package_info` SET `package_id` = '$Package_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoPackage_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByDefault_action_title
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByDefault_action_title ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Default_action_title` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByDefault_action_title

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByDefault_action_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByDefault_action_titleWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Default_action_title` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByDefault_action_titleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByDefault_action_title
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByDefault_action_title ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `default_action_title` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByDefault_action_title

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByDefault_action_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByDefault_action_titleWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `default_action_title` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByDefault_action_titleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByDefault_action_titleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByDefault_action_titleOrderById ($Default_action_title  = '', $sorting = 'DESC'){		
		
		$Default_action_title =  mysql_escape_string($Default_action_title);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `default_action_title` = '$Default_action_title' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByDefault_action_titleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByDefault_action_titleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByDefault_action_titleOrderByIdWithLimit ($Default_action_title  = '', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Default_action_title =  mysql_escape_string($Default_action_title);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `default_action_title` = '$Default_action_title' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByDefault_action_titleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByDefault_action_title
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByDefault_action_title ($Default_action_title  = ''){
	
		$Default_action_title =  mysql_escape_string($Default_action_title);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `default_action_title` = '$Default_action_title' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByDefault_action_title

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoDefault_action_titleColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoDefault_action_titleColumnById ($Id, $Default_action_title  = ''){
	
		$Id = (int) $Id;
		$Default_action_title =  mysql_escape_string($Default_action_title);
	
		$query  = "UPDATE `package_info` SET `default_action_title` = '$Default_action_title' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoDefault_action_titleColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByDefault_action_name
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByDefault_action_name ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Default_action_name` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByDefault_action_name

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByDefault_action_nameWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByDefault_action_nameWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Default_action_name` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByDefault_action_nameWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByDefault_action_name
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByDefault_action_name ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `default_action_name` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByDefault_action_name

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByDefault_action_nameWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByDefault_action_nameWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `default_action_name` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByDefault_action_nameWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByDefault_action_nameOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByDefault_action_nameOrderById ($Default_action_name  = '', $sorting = 'DESC'){		
		
		$Default_action_name =  mysql_escape_string($Default_action_name);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `default_action_name` = '$Default_action_name' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByDefault_action_nameOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByDefault_action_nameOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByDefault_action_nameOrderByIdWithLimit ($Default_action_name  = '', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Default_action_name =  mysql_escape_string($Default_action_name);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `default_action_name` = '$Default_action_name' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByDefault_action_nameOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByDefault_action_name
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByDefault_action_name ($Default_action_name  = ''){
	
		$Default_action_name =  mysql_escape_string($Default_action_name);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `default_action_name` = '$Default_action_name' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByDefault_action_name

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoDefault_action_nameColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoDefault_action_nameColumnById ($Id, $Default_action_name  = ''){
	
		$Id = (int) $Id;
		$Default_action_name =  mysql_escape_string($Default_action_name);
	
		$query  = "UPDATE `package_info` SET `default_action_name` = '$Default_action_name' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoDefault_action_nameColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByVersion
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByVersion ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Version` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByVersion

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByVersionWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByVersionWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Version` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByVersionWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByVersion
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByVersion ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `version` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByVersion

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByVersionWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByVersionWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `version` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByVersionWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByVersionOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByVersionOrderById ($Version  = '1.0', $sorting = 'DESC'){		
		
		$Version =  mysql_escape_string($Version);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `version` = '$Version' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByVersionOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByVersionOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByVersionOrderByIdWithLimit ($Version  = '1.0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Version =  mysql_escape_string($Version);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `version` = '$Version' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByVersionOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByVersion
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByVersion ($Version  = '1.0'){
	
		$Version =  mysql_escape_string($Version);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `version` = '$Version' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByVersion

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoVersionColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoVersionColumnById ($Id, $Version  = '1.0'){
	
		$Id = (int) $Id;
		$Version =  mysql_escape_string($Version);
	
		$query  = "UPDATE `package_info` SET `version` = '$Version' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoVersionColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByLocked_by ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_by` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByLocked_by

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByLocked_byWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_by` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByLocked_by ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locked_by` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByLocked_by

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByLocked_byWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locked_by` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByLocked_byOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByLocked_byOrderById ($Locked_by , $sorting = 'DESC'){		
		
		$Locked_by = (int) $Locked_by;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByLocked_byOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByLocked_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByLocked_byOrderByIdWithLimit ($Locked_by , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Locked_by = (int) $Locked_by;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByLocked_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByLocked_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByLocked_by ($Locked_by ){
	
		$Locked_by = (int) $Locked_by;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByLocked_by

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoLocked_byColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoLocked_byColumnById ($Id, $Locked_by ){
	
		$Id = (int) $Id;
		$Locked_by = (int) $Locked_by;
	
		$query  = "UPDATE `package_info` SET `locked_by` = '$Locked_by' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoLocked_byColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByLocked_time ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_time` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByLocked_time

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByLocked_timeWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_time` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByLocked_time ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locked_time` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByLocked_time

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByLocked_timeWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locked_time` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByLocked_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByLocked_timeOrderById ($Locked_time  = '0000-00-00 00:00:00', $sorting = 'DESC'){		
		
		$Locked_time =  mysql_escape_string($Locked_time);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByLocked_timeOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByLocked_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByLocked_timeOrderByIdWithLimit ($Locked_time  = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Locked_time =  mysql_escape_string($Locked_time);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByLocked_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByLocked_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByLocked_time ($Locked_time  = '0000-00-00 00:00:00'){
	
		$Locked_time =  mysql_escape_string($Locked_time);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByLocked_time

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoLocked_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoLocked_timeColumnById ($Id, $Locked_time  = '0000-00-00 00:00:00'){
	
		$Id = (int) $Id;
		$Locked_time =  mysql_escape_string($Locked_time);
	
		$query  = "UPDATE `package_info` SET `locked_time` = '$Locked_time' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoLocked_timeColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByDate_added ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Date_added` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByDate_addedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Date_added` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByDate_added ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `date_added` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByDate_addedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `date_added` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByDate_addedOrderById ($Date_added  = 'CURRENT_TIMESTAMP', $sorting = 'DESC'){		
		
		$Date_added =  mysql_escape_string($Date_added);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByDate_addedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByDate_addedOrderByIdWithLimit ($Date_added  = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Date_added =  mysql_escape_string($Date_added);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByDate_added ($Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByDate_added

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoDate_addedColumnById ($Id, $Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Id = (int) $Id;
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "UPDATE `package_info` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoDate_addedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByComments ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Comments` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByCommentsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Comments` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByComments ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `comments` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByCommentsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `comments` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByCommentsOrderById ($Comments , $sorting = 'DESC'){		
		
		$Comments =  mysql_escape_string($Comments);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `comments` = '$Comments' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByCommentsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByCommentsOrderByIdWithLimit ($Comments , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Comments =  mysql_escape_string($Comments);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `comments` = '$Comments' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByComments ($Comments ){
	
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByComments

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoCommentsColumnById ($Id, $Comments ){
	
		$Id = (int) $Id;
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "UPDATE `package_info` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoCommentsColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByOptions ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Options` $sorting ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoOrderByOptionsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Options` $sorting LIMIT $start,$limit ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByOptions ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `options` $sorting  ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByIdOrderByOptionsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `options` $sorting LIMIT $start , $limit ";
			
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByIdOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByOptionsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByOptionsOrderById ($Options , $sorting = 'DESC'){		
		
		$Options =  mysql_escape_string($Options);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `options` = '$Options' ORDER BY `id` ";
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByOptionsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_infoByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_infoByOptionsOrderByIdWithLimit ($Options , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Options =  mysql_escape_string($Options);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `options` = '$Options' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
		$result = $this->dbLink->fetch($query);
	
		if(!$result){
			return false;
		}
	
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch($query);
		
		if (is_null($this->_totalRecordsFound) || !is_array($this->_totalRecordsFound) || !isset($this->_totalRecordsFound[0][0])) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound[0][0];
		}
		
		return $result;
	}//End Function GetAllPackage_infoByOptionsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_infoByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_infoByOptions ($Options ){
	
		$Options =  mysql_escape_string($Options);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_infoByOptions

	/**
	 * This Method is Script Generated 
	 * updatePackage_infoOptionsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_infoOptionsColumnById ($Id, $Options ){
	
		$Id = (int) $Id;
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET `options` = '$Options' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_infoOptionsColumnById
}