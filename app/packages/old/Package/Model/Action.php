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
 * @name Package_Model_Action
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Package_Model_Action extends Aula_Controller_Action {

	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'package_action';
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
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `action_title`, `action_name`, `action_description`, `file_name`, `package_id`, `class_id`, `comments`, `options`"; 
		$this -> _selectColumnsList = '`id`, `action_title`, `action_name`, `action_description`, `file_name`, `package_id`, `class_id`, `date_added`, `comments`, `options`'; 
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoPackage_action
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoPackage_action($Id, $Action_title, $Action_name, $Action_description, $File_name, $Package_id, $Class_id, $Comments, $Options) {
		
		$Id = (int) $Id;
		$Action_title =  mysql_escape_string($Action_title);
		$Action_name =  mysql_escape_string($Action_name);
		$Action_description =  mysql_escape_string($Action_description);
		$File_name =  mysql_escape_string($File_name);
		$Package_id = (int) $Package_id;
		$Class_id = (int) $Class_id;
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);

		$query  = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Action_title', '$Action_name', '$Action_description', '$File_name', '$Package_id', '$Class_id', '$Comments', '$Options') ";
		
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
	}//End Function insertIntoPackage_action

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionById ($Id){
	
		$Id = (int) $Id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionById

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionById($Id, $Action_title, $Action_name, $Action_description, $File_name, $Package_id, $Class_id, $Comments, $Options) {
		
		$Id = (int) $Id;
		$Action_title =  mysql_escape_string($Action_title);
		$Action_name =  mysql_escape_string($Action_name);
		$Action_description =  mysql_escape_string($Action_description);
		$File_name =  mysql_escape_string($File_name);
		$Package_id = (int) $Package_id;
		$Class_id = (int) $Class_id;
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET  `action_title` = '$Action_title', `action_name` = '$Action_name', `action_description` = '$Action_description', `file_name` = '$File_name', `package_id` = '$Package_id', `class_id` = '$Class_id', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderById ($sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByIdWithLimit ($start = 0, $limit = 10, $sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getPackage_actionDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPackage_actionDetailsByIdWithLimit ($Id, $start = 0, $limit = 10){		
		
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
	}//End Function getPackage_actionDetailsByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getPackage_actionDetailsById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPackage_actionDetailsById ($Id){		
		
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
	}//End Function getPackage_actionDetailsById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderById ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionByIdOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByIdWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByAction_title
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByAction_title ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Action_title` $sorting ";
	
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
	}//End Function GetAllPackage_actionOrderByAction_title

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByAction_titleWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByAction_titleWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Action_title` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPackage_actionOrderByAction_titleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByAction_title
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByAction_title ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `action_title` $sorting  ";
	
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
	}//End Function GetAllPackage_actionByIdOrderByAction_title

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByAction_titleWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByAction_titleWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `action_title` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPackage_actionByIdOrderByAction_titleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByAction_titleOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByAction_titleOrderById ($Action_title , $sorting = 'DESC'){		
		
		$Action_title =  mysql_escape_string($Action_title);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `action_title` = '$Action_title' ORDER BY `id` ";
	
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
	}//End Function GetAllPackage_actionByAction_titleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByAction_titleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByAction_titleOrderByIdWithLimit ($Action_title , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Action_title =  mysql_escape_string($Action_title);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `action_title` = '$Action_title' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPackage_actionByAction_titleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByAction_title
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByAction_title ($Action_title ){
	
		$Action_title =  mysql_escape_string($Action_title);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `action_title` = '$Action_title' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByAction_title

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionAction_titleColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionAction_titleColumnById ($Id, $Action_title ){
	
		$Id = (int) $Id;
		$Action_title =  mysql_escape_string($Action_title);
	
		$query  = "UPDATE `{$this->tableName}` SET `action_title` = '$Action_title' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionAction_titleColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByAction_name
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByAction_name ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Action_name` $sorting ";
	
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
	}//End Function GetAllPackage_actionOrderByAction_name

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByAction_nameWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByAction_nameWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Action_name` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPackage_actionOrderByAction_nameWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByAction_name
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByAction_name ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `action_name` $sorting  ";
	
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
	}//End Function GetAllPackage_actionByIdOrderByAction_name

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByAction_nameWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByAction_nameWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `action_name` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPackage_actionByIdOrderByAction_nameWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByAction_nameOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByAction_nameOrderById ($Action_name , $sorting = 'DESC'){		
		
		$Action_name =  mysql_escape_string($Action_name);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `action_name` = '$Action_name' ORDER BY `id` ";
	
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
	}//End Function GetAllPackage_actionByAction_nameOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByAction_nameOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByAction_nameOrderByIdWithLimit ($Action_name , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Action_name =  mysql_escape_string($Action_name);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `action_name` = '$Action_name' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPackage_actionByAction_nameOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByAction_name
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByAction_name ($Action_name ){
	
		$Action_name =  mysql_escape_string($Action_name);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `action_name` = '$Action_name' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByAction_name

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionAction_nameColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionAction_nameColumnById ($Id, $Action_name ){
	
		$Id = (int) $Id;
		$Action_name =  mysql_escape_string($Action_name);
	
		$query  = "UPDATE `{$this->tableName}` SET `action_name` = '$Action_name' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionAction_nameColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByAction_description
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByAction_description ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Action_description` $sorting ";
	
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
	}//End Function GetAllPackage_actionOrderByAction_description

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByAction_descriptionWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByAction_descriptionWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Action_description` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPackage_actionOrderByAction_descriptionWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByAction_description
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByAction_description ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `action_description` $sorting  ";
	
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
	}//End Function GetAllPackage_actionByIdOrderByAction_description

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByAction_descriptionWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByAction_descriptionWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `action_description` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPackage_actionByIdOrderByAction_descriptionWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByAction_descriptionOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByAction_descriptionOrderById ($Action_description , $sorting = 'DESC'){		
		
		$Action_description =  mysql_escape_string($Action_description);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `action_description` = '$Action_description' ORDER BY `id` ";
	
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
	}//End Function GetAllPackage_actionByAction_descriptionOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByAction_descriptionOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByAction_descriptionOrderByIdWithLimit ($Action_description , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Action_description =  mysql_escape_string($Action_description);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `action_description` = '$Action_description' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPackage_actionByAction_descriptionOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByAction_description
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByAction_description ($Action_description ){
	
		$Action_description =  mysql_escape_string($Action_description);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `action_description` = '$Action_description' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByAction_description

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionAction_descriptionColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionAction_descriptionColumnById ($Id, $Action_description ){
	
		$Id = (int) $Id;
		$Action_description =  mysql_escape_string($Action_description);
	
		$query  = "UPDATE `{$this->tableName}` SET `action_description` = '$Action_description' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionAction_descriptionColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByFile_name
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByFile_name ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `File_name` $sorting ";
	
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
	}//End Function GetAllPackage_actionOrderByFile_name

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByFile_nameWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByFile_nameWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `File_name` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPackage_actionOrderByFile_nameWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByFile_name
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByFile_name ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `file_name` $sorting  ";
	
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
	}//End Function GetAllPackage_actionByIdOrderByFile_name

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByFile_nameWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByFile_nameWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `file_name` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPackage_actionByIdOrderByFile_nameWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByFile_nameOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByFile_nameOrderById ($File_name , $sorting = 'DESC'){		
		
		$File_name =  mysql_escape_string($File_name);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `file_name` = '$File_name' ORDER BY `id` ";
	
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
	}//End Function GetAllPackage_actionByFile_nameOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByFile_nameOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByFile_nameOrderByIdWithLimit ($File_name , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$File_name =  mysql_escape_string($File_name);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `file_name` = '$File_name' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPackage_actionByFile_nameOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByFile_name
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByFile_name ($File_name ){
	
		$File_name =  mysql_escape_string($File_name);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `file_name` = '$File_name' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByFile_name

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionFile_nameColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionFile_nameColumnById ($Id, $File_name ){
	
		$Id = (int) $Id;
		$File_name =  mysql_escape_string($File_name);
	
		$query  = "UPDATE `{$this->tableName}` SET `file_name` = '$File_name' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionFile_nameColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByPackage_id
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByPackage_id ($sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionOrderByPackage_id

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByPackage_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByPackage_id
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByPackage_id ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionByIdOrderByPackage_id

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByPackage_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionByIdOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByPackage_idOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByPackage_idOrderById ($Package_id , $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByPackage_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByPackage_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByPackage_idOrderByIdWithLimit ($Package_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByPackage_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByPackage_id
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByPackage_id ($Package_id ){
	
		$Package_id = (int) $Package_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByPackage_id

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionPackage_idColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionPackage_idColumnById ($Id, $Package_id ){
	
		$Id = (int) $Id;
		$Package_id = (int) $Package_id;
	
		$query  = "UPDATE `{$this->tableName}` SET `package_id` = '$Package_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionPackage_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByClass_id
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByClass_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Class_id` $sorting ";
	
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
	}//End Function GetAllPackage_actionOrderByClass_id

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByClass_idWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByClass_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Class_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPackage_actionOrderByClass_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByClass_id
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByClass_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `class_id` $sorting  ";
	
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
	}//End Function GetAllPackage_actionByIdOrderByClass_id

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByClass_idWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByClass_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `class_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPackage_actionByIdOrderByClass_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByClass_idOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByClass_idOrderById ($Class_id , $sorting = 'DESC'){		
		
		$Class_id = (int) $Class_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `class_id` = '$Class_id' ORDER BY `id` ";
	
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
	}//End Function GetAllPackage_actionByClass_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByClass_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByClass_idOrderByIdWithLimit ($Class_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Class_id = (int) $Class_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `class_id` = '$Class_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPackage_actionByClass_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByClass_id
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByClass_id ($Class_id ){
	
		$Class_id = (int) $Class_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `class_id` = '$Class_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByClass_id

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionClass_idColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionClass_idColumnById ($Id, $Class_id ){
	
		$Id = (int) $Id;
		$Class_id = (int) $Class_id;
	
		$query  = "UPDATE `{$this->tableName}` SET `class_id` = '$Class_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionClass_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByDate_added
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByDate_added ($sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByDate_addedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByDate_added
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByDate_added ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionByIdOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByDate_addedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByDate_addedOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByDate_addedOrderById ($Date_added  = 'CURRENT_TIMESTAMP', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByDate_addedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByDate_addedOrderByIdWithLimit ($Date_added  = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByDate_added
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByDate_added ($Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByDate_added

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionDate_addedColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionDate_addedColumnById ($Id, $Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Id = (int) $Id;
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "UPDATE `{$this->tableName}` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionDate_addedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByComments
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByComments ($sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByCommentsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByComments
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByComments ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionByIdOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByCommentsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByCommentsOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByCommentsOrderById ($Comments , $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByCommentsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByCommentsOrderByIdWithLimit ($Comments , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByComments
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByComments ($Comments ){
	
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByComments

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionCommentsColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionCommentsColumnById ($Id, $Comments ){
	
		$Id = (int) $Id;
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "UPDATE `{$this->tableName}` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionCommentsColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByOptions
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByOptions ($sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionOrderByOptionsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByOptions
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByOptions ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPackage_actionByIdOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByIdOrderByOptionsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPackage_actionByIdOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByOptionsOrderById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByOptionsOrderById ($Options , $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByOptionsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPackage_actionByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPackage_actionByOptionsOrderByIdWithLimit ($Options , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPackage_actionByOptionsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPackage_actionByOptions
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPackage_actionByOptions ($Options ){
	
		$Options =  mysql_escape_string($Options);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPackage_actionByOptions

	/**
	 * This Method is Script Generated 
	 * updatePackage_actionOptionsColumnById
	 * Generated Date: 2011-05-13 17:20:46 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePackage_actionOptionsColumnById ($Id, $Options ){
	
		$Id = (int) $Id;
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET `options` = '$Options' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePackage_actionOptionsColumnById
}