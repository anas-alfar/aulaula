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
 * @name Object_Model_Abuse
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Abuse extends Aula_Controller_Action {

	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'object_abuse';
	public $insertColumnsList = ''; 
	public $updateColumnsParamsListWithoutPrimaryKey = ''; 
	public $_selectColumnsList = ''; 
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $isAbuse = 'No';
	public $approved = 'No';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `object_id`, `user_id`, `alias`, `email`, `description`, `type_id`, `locale_id`, `is_abuse`, `approved`, `comments`, `options`"; 
		$this -> _selectColumnsList = '`id`, `object_id`, `user_id`, `alias`, `email`, `description`, `type_id`, `locale_id`, `is_abuse`, `approved`, `date_added`, `comments`, `options`'; 
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoObject_abuse
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoObject_abuse($Id, $Object_id, $User_id, $Alias, $Email, $Description, $Type_id, $Locale_id, $Comments, $Options, $Is_abuse = 'No', $Approved = 'No') {
		
		$Id = (int) $Id;
		$Object_id = (int) $Object_id;
		$User_id = (int) $User_id;
		$Alias =  mysql_escape_string($Alias);
		$Email =  mysql_escape_string($Email);
		$Description =  mysql_escape_string($Description);
		$Type_id = (int) $Type_id;
		$Locale_id = (int) $Locale_id;
		$Is_abuse =  mysql_escape_string($Is_abuse);
		$Approved =  mysql_escape_string($Approved);
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);

		$query  = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Object_id', '$User_id', '$Alias', '$Email', '$Description', '$Type_id', '$Locale_id', '$Is_abuse', '$Approved', '$Comments', '$Options') ";
		
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
	}//End Function insertIntoObject_abuse

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseById ($Id){
	
		$Id = (int) $Id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseById

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseById($Id, $Object_id, $User_id, $Alias, $Email, $Description, $Type_id, $Locale_id, $Comments, $Options, $Is_abuse = 'No', $Approved = 'No') {
		
		$Id = (int) $Id;
		$Object_id = (int) $Object_id;
		$User_id = (int) $User_id;
		$Alias =  mysql_escape_string($Alias);
		$Email =  mysql_escape_string($Email);
		$Description =  mysql_escape_string($Description);
		$Type_id = (int) $Type_id;
		$Locale_id = (int) $Locale_id;
		$Is_abuse =  mysql_escape_string($Is_abuse);
		$Approved =  mysql_escape_string($Approved);
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET  `object_id` = '$Object_id', `user_id` = '$User_id', `alias` = '$Alias', `email` = '$Email', `description` = '$Description', `type_id` = '$Type_id', `locale_id` = '$Locale_id', `is_abuse` = '$Is_abuse', `approved` = '$Approved', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderById ($sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByIdWithLimit ($start = 0, $limit = 10, $sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getObject_abuseDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getObject_abuseDetailsByIdWithLimit ($Id, $start = 0, $limit = 10){		
		
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
	}//End Function getObject_abuseDetailsByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getObject_abuseDetailsById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getObject_abuseDetailsById ($Id){		
		
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
	}//End Function getObject_abuseDetailsById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderById ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseByIdOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByIdWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByObject_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Object_id` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByObject_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByObject_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByObject_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Object_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByObject_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByObject_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `object_id` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByObject_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByObject_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByObject_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `object_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByObject_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByObject_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByObject_idOrderById ($Object_id , $sorting = 'DESC'){		
		
		$Object_id = (int) $Object_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByObject_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByObject_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByObject_idOrderByIdWithLimit ($Object_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Object_id = (int) $Object_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByObject_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByObject_id ($Object_id ){
	
		$Object_id = (int) $Object_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByObject_id

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseObject_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseObject_idColumnById ($Id, $Object_id ){
	
		$Id = (int) $Id;
		$Object_id = (int) $Object_id;
	
		$query  = "UPDATE `object_abuse` SET `object_id` = '$Object_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseObject_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByUser_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByUser_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `User_id` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByUser_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByUser_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByUser_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `User_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByUser_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByUser_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByUser_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `user_id` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByUser_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByUser_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByUser_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `user_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByUser_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByUser_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByUser_idOrderById ($User_id , $sorting = 'DESC'){		
		
		$User_id = (int) $User_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `user_id` = '$User_id' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByUser_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByUser_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByUser_idOrderByIdWithLimit ($User_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$User_id = (int) $User_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `user_id` = '$User_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByUser_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByUser_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByUser_id ($User_id ){
	
		$User_id = (int) $User_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `user_id` = '$User_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByUser_id

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseUser_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseUser_idColumnById ($Id, $User_id ){
	
		$Id = (int) $Id;
		$User_id = (int) $User_id;
	
		$query  = "UPDATE `object_abuse` SET `user_id` = '$User_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseUser_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByAlias
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByAlias ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Alias` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByAlias

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByAliasWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByAliasWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Alias` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByAliasWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByAlias
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByAlias ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `alias` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByAlias

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByAliasWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByAliasWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `alias` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByAliasWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByAliasOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByAliasOrderById ($Alias , $sorting = 'DESC'){		
		
		$Alias =  mysql_escape_string($Alias);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `alias` = '$Alias' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByAliasOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByAliasOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByAliasOrderByIdWithLimit ($Alias , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Alias =  mysql_escape_string($Alias);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `alias` = '$Alias' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByAliasOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByAlias
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByAlias ($Alias ){
	
		$Alias =  mysql_escape_string($Alias);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `alias` = '$Alias' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByAlias

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseAliasColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseAliasColumnById ($Id, $Alias ){
	
		$Id = (int) $Id;
		$Alias =  mysql_escape_string($Alias);
	
		$query  = "UPDATE `object_abuse` SET `alias` = '$Alias' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseAliasColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByEmail
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByEmail ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Email` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByEmail

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByEmailWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByEmailWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Email` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByEmailWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByEmail
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByEmail ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `email` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByEmail

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByEmailWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByEmailWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `email` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByEmailWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByEmailOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByEmailOrderById ($Email , $sorting = 'DESC'){		
		
		$Email =  mysql_escape_string($Email);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `email` = '$Email' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByEmailOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByEmailOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByEmailOrderByIdWithLimit ($Email , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Email =  mysql_escape_string($Email);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `email` = '$Email' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByEmailOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByEmail
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByEmail ($Email ){
	
		$Email =  mysql_escape_string($Email);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `email` = '$Email' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByEmail

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseEmailColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseEmailColumnById ($Id, $Email ){
	
		$Id = (int) $Id;
		$Email =  mysql_escape_string($Email);
	
		$query  = "UPDATE `object_abuse` SET `email` = '$Email' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseEmailColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByDescription
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByDescription ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Description` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByDescription

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByDescriptionWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByDescriptionWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Description` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByDescriptionWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByDescription
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByDescription ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `description` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByDescription

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByDescriptionWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByDescriptionWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `description` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByDescriptionWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByDescriptionOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByDescriptionOrderById ($Description , $sorting = 'DESC'){		
		
		$Description =  mysql_escape_string($Description);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `description` = '$Description' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByDescriptionOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByDescriptionOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByDescriptionOrderByIdWithLimit ($Description , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Description =  mysql_escape_string($Description);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `description` = '$Description' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByDescriptionOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByDescription
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByDescription ($Description ){
	
		$Description =  mysql_escape_string($Description);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `description` = '$Description' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByDescription

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseDescriptionColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseDescriptionColumnById ($Id, $Description ){
	
		$Id = (int) $Id;
		$Description =  mysql_escape_string($Description);
	
		$query  = "UPDATE `object_abuse` SET `description` = '$Description' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseDescriptionColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByType_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByType_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Type_id` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByType_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByType_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByType_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Type_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByType_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByType_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByType_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `type_id` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByType_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByType_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByType_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `type_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByType_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByType_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByType_idOrderById ($Type_id , $sorting = 'DESC'){		
		
		$Type_id = (int) $Type_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `type_id` = '$Type_id' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByType_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByType_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByType_idOrderByIdWithLimit ($Type_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Type_id = (int) $Type_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `type_id` = '$Type_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByType_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByType_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByType_id ($Type_id ){
	
		$Type_id = (int) $Type_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `type_id` = '$Type_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByType_id

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseType_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseType_idColumnById ($Id, $Type_id ){
	
		$Id = (int) $Id;
		$Type_id = (int) $Type_id;
	
		$query  = "UPDATE `object_abuse` SET `type_id` = '$Type_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseType_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByLocale_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByLocale_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale_id` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByLocale_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByLocale_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByLocale_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByLocale_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByLocale_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByLocale_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locale_id` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByLocale_id

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByLocale_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByLocale_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locale_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByLocale_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByLocale_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByLocale_idOrderById ($Locale_id , $sorting = 'DESC'){		
		
		$Locale_id = (int) $Locale_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale_id` = '$Locale_id' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByLocale_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByLocale_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByLocale_idOrderByIdWithLimit ($Locale_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Locale_id = (int) $Locale_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale_id` = '$Locale_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByLocale_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByLocale_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByLocale_id ($Locale_id ){
	
		$Locale_id = (int) $Locale_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locale_id` = '$Locale_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByLocale_id

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseLocale_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseLocale_idColumnById ($Id, $Locale_id ){
	
		$Id = (int) $Id;
		$Locale_id = (int) $Locale_id;
	
		$query  = "UPDATE `object_abuse` SET `locale_id` = '$Locale_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseLocale_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByIs_abuse
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByIs_abuse ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Is_abuse` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByIs_abuse

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByIs_abuseWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByIs_abuseWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Is_abuse` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByIs_abuseWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByIs_abuse
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByIs_abuse ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `is_abuse` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByIs_abuse

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByIs_abuseWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByIs_abuseWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `is_abuse` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByIs_abuseWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIs_abuseOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIs_abuseOrderById ($Is_abuse  = 'No', $sorting = 'DESC'){		
		
		$Is_abuse =  mysql_escape_string($Is_abuse);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `is_abuse` = '$Is_abuse' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByIs_abuseOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIs_abuseOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIs_abuseOrderByIdWithLimit ($Is_abuse  = 'No', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Is_abuse =  mysql_escape_string($Is_abuse);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `is_abuse` = '$Is_abuse' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByIs_abuseOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByIs_abuse
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByIs_abuse ($Is_abuse  = 'No'){
	
		$Is_abuse =  mysql_escape_string($Is_abuse);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `is_abuse` = '$Is_abuse' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByIs_abuse

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseIs_abuseColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseIs_abuseColumnById ($Id, $Is_abuse  = 'No'){
	
		$Id = (int) $Id;
		$Is_abuse =  mysql_escape_string($Is_abuse);
	
		$query  = "UPDATE `object_abuse` SET `is_abuse` = '$Is_abuse' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseIs_abuseColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByApproved ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Approved` $sorting ";
	
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
	}//End Function GetAllObject_abuseOrderByApproved

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByApprovedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Approved` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllObject_abuseOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByApproved ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `approved` $sorting  ";
	
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
	}//End Function GetAllObject_abuseByIdOrderByApproved

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByApprovedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `approved` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllObject_abuseByIdOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByApprovedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByApprovedOrderById ($Approved  = 'No', $sorting = 'DESC'){		
		
		$Approved =  mysql_escape_string($Approved);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `approved` = '$Approved' ORDER BY `id` ";
	
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
	}//End Function GetAllObject_abuseByApprovedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByApprovedOrderByIdWithLimit ($Approved  = 'No', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Approved =  mysql_escape_string($Approved);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `approved` = '$Approved' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllObject_abuseByApprovedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByApproved ($Approved  = 'No'){
	
		$Approved =  mysql_escape_string($Approved);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByApproved

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseApprovedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseApprovedColumnById ($Id, $Approved  = 'No'){
	
		$Id = (int) $Id;
		$Approved =  mysql_escape_string($Approved);
	
		$query  = "UPDATE `object_abuse` SET `approved` = '$Approved' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseApprovedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByDate_added ($sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByDate_addedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByDate_added ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseByIdOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByDate_addedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByDate_addedOrderById ($Date_added  = 'CURRENT_TIMESTAMP', $sorting = 'DESC'){		
		
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
	}//End Function GetAllObject_abuseByDate_addedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByDate_addedOrderByIdWithLimit ($Date_added  = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllObject_abuseByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByDate_added ($Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByDate_added

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseDate_addedColumnById ($Id, $Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Id = (int) $Id;
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "UPDATE `object_abuse` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseDate_addedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByComments ($sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByCommentsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByComments ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseByIdOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByCommentsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByCommentsOrderById ($Comments , $sorting = 'DESC'){		
		
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
	}//End Function GetAllObject_abuseByCommentsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByCommentsOrderByIdWithLimit ($Comments , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllObject_abuseByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByComments ($Comments ){
	
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByComments

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseCommentsColumnById ($Id, $Comments ){
	
		$Id = (int) $Id;
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "UPDATE `object_abuse` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseCommentsColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByOptions ($sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseOrderByOptionsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByOptions ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllObject_abuseByIdOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByIdOrderByOptionsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllObject_abuseByIdOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByOptionsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByOptionsOrderById ($Options , $sorting = 'DESC'){		
		
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
	}//End Function GetAllObject_abuseByOptionsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllObject_abuseByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_abuseByOptionsOrderByIdWithLimit ($Options , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllObject_abuseByOptionsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_abuseByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_abuseByOptions ($Options ){
	
		$Options =  mysql_escape_string($Options);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromObject_abuseByOptions

	/**
	 * This Method is Script Generated 
	 * updateObject_abuseOptionsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_abuseOptionsColumnById ($Id, $Options ){
	
		$Id = (int) $Id;
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET `options` = '$Options' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateObject_abuseOptionsColumnById
}