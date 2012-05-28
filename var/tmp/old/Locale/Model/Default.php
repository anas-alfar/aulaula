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
 * @name Locale_Model_Default
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Locale_Model_Default extends Aula_Controller_Action {

	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'locale';
	public $insertColumnsList = ''; 
	public $updateColumnsParamsListWithoutPrimaryKey = ''; 
	public $_selectColumnsList = ''; 
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `locale`, `title`, `locale_title`, `published`, `approved`, `order`, `comments`"; 
		$this -> _selectColumnsList = '`id`, `locale`, `title`, `locale_title`, `published`, `approved`, `order`, `date_added`, `comments`'; 
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoLocale
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoLocale($Id, $Locale, $Title, $Comments, $Locale_title, $Published = 'No', $Approved = 'No', $Order = '0') {
		
		$Id = (int) $Id;
		$Locale =  mysql_escape_string($Locale);
		$Title =  mysql_escape_string($Title);
		$Locale_title =  mysql_escape_string($Locale_title);
		$Published =  mysql_escape_string($Published);
		$Approved =  mysql_escape_string($Approved);
		$Order = (int) $Order;
		$Comments =  mysql_escape_string($Comments);

		$query  = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Locale', '$Title', '$Locale_title', '$Published', '$Approved', '$Order', '$Comments') ";
		
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
	}//End Function insertIntoLocale

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleById ($Id){
	
		$Id = (int) $Id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleById

	/**
	 * This Method is Script Generated 
	 * updateLocaleById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleById($Id, $Locale, $Title, $Comments, $Locale_title, $Published = 'No', $Approved = 'No', $Order = '0') {
		
		$Id = (int) $Id;
		$Locale =  mysql_escape_string($Locale);
		$Title =  mysql_escape_string($Title);
		$Locale_title =  mysql_escape_string($Locale_title);
		$Published =  mysql_escape_string($Published);
		$Approved =  mysql_escape_string($Approved);
		$Order = (int) $Order;
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "UPDATE `{$this->tableName}` SET  `locale` = '$Locale', `title` = '$Title', `locale_title` = '$Locale_title', `published` = '$Published', `approved` = '$Approved', `order` = '$Order', `comments` = '$Comments' WHERE `id` = '$Id'";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderById ($sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByIdWithLimit ($start = 0, $limit = 10, $sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getLocaleDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getLocaleDetailsByIdWithLimit ($Id, $start = 0, $limit = 10){		
		
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
	}//End Function getLocaleDetailsByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getLocaleDetailsById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getLocaleDetailsById ($Id){		
		
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
	}//End Function getLocaleDetailsById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderById ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleByIdOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByIdWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByLocale
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByLocale ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale` $sorting ";
	
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
	}//End Function GetAllLocaleOrderByLocale

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByLocaleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByLocaleWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllLocaleOrderByLocaleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByLocale
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByLocale ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locale` $sorting  ";
	
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
	}//End Function GetAllLocaleByIdOrderByLocale

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByLocaleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByLocaleWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locale` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllLocaleByIdOrderByLocaleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByLocaleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByLocaleOrderById ($Locale , $sorting = 'DESC'){		
		
		$Locale =  mysql_escape_string($Locale);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale` = '$Locale' ORDER BY `id` ";
	
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
	}//End Function GetAllLocaleByLocaleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByLocaleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByLocaleOrderByIdWithLimit ($Locale , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Locale =  mysql_escape_string($Locale);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale` = '$Locale' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllLocaleByLocaleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByLocale
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByLocale ($Locale ){
	
		$Locale =  mysql_escape_string($Locale);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locale` = '$Locale' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByLocale

	/**
	 * This Method is Script Generated 
	 * updateLocaleLocaleColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleLocaleColumnById ($Id, $Locale ){
	
		$Id = (int) $Id;
		$Locale =  mysql_escape_string($Locale);
	
		$query  = "UPDATE `locale` SET `locale` = '$Locale' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleLocaleColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByTitle ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Title` $sorting ";
	
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
	}//End Function GetAllLocaleOrderByTitle

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByTitleWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Title` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllLocaleOrderByTitleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByTitle ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `title` $sorting  ";
	
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
	}//End Function GetAllLocaleByIdOrderByTitle

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByTitleWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `title` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllLocaleByIdOrderByTitleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByTitleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByTitleOrderById ($Title , $sorting = 'DESC'){		
		
		$Title =  mysql_escape_string($Title);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `title` = '$Title' ORDER BY `id` ";
	
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
	}//End Function GetAllLocaleByTitleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByTitleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByTitleOrderByIdWithLimit ($Title , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Title =  mysql_escape_string($Title);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `title` = '$Title' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllLocaleByTitleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByTitle
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByTitle ($Title ){
	
		$Title =  mysql_escape_string($Title);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `title` = '$Title' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByTitle

	/**
	 * This Method is Script Generated 
	 * updateLocaleTitleColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleTitleColumnById ($Id, $Title ){
	
		$Id = (int) $Id;
		$Title =  mysql_escape_string($Title);
	
		$query  = "UPDATE `locale` SET `title` = '$Title' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleTitleColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByLocale_title
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByLocale_title ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale_title` $sorting ";
	
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
	}//End Function GetAllLocaleOrderByLocale_title

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByLocale_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByLocale_titleWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale_title` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllLocaleOrderByLocale_titleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByLocale_title
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByLocale_title ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locale_title` $sorting  ";
	
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
	}//End Function GetAllLocaleByIdOrderByLocale_title

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByLocale_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByLocale_titleWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locale_title` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllLocaleByIdOrderByLocale_titleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByLocale_titleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByLocale_titleOrderById ($Locale_title , $sorting = 'DESC'){		
		
		$Locale_title =  mysql_escape_string($Locale_title);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale_title` = '$Locale_title' ORDER BY `id` ";
	
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
	}//End Function GetAllLocaleByLocale_titleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByLocale_titleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByLocale_titleOrderByIdWithLimit ($Locale_title , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Locale_title =  mysql_escape_string($Locale_title);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale_title` = '$Locale_title' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllLocaleByLocale_titleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByLocale_title
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByLocale_title ($Locale_title ){
	
		$Locale_title =  mysql_escape_string($Locale_title);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locale_title` = '$Locale_title' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByLocale_title

	/**
	 * This Method is Script Generated 
	 * updateLocaleLocale_titleColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleLocale_titleColumnById ($Id, $Locale_title ){
	
		$Id = (int) $Id;
		$Locale_title =  mysql_escape_string($Locale_title);
	
		$query  = "UPDATE `locale` SET `locale_title` = '$Locale_title' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleLocale_titleColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByPublished ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Published` $sorting ";
	
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
	}//End Function GetAllLocaleOrderByPublished

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByPublishedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Published` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllLocaleOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByPublished ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `published` $sorting  ";
	
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
	}//End Function GetAllLocaleByIdOrderByPublished

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByPublishedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `published` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllLocaleByIdOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByPublishedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByPublishedOrderById ($Published  = 'No', $sorting = 'DESC'){		
		
		$Published =  mysql_escape_string($Published);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `published` = '$Published' ORDER BY `id` ";
	
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
	}//End Function GetAllLocaleByPublishedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByPublishedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByPublishedOrderByIdWithLimit ($Published  = 'No', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Published =  mysql_escape_string($Published);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `published` = '$Published' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllLocaleByPublishedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByPublished ($Published  = 'No'){
	
		$Published =  mysql_escape_string($Published);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `published` = '$Published' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByPublished

	/**
	 * This Method is Script Generated 
	 * updateLocalePublishedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocalePublishedColumnById ($Id, $Published  = 'No'){
	
		$Id = (int) $Id;
		$Published =  mysql_escape_string($Published);
	
		$query  = "UPDATE `locale` SET `published` = '$Published' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocalePublishedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByApproved ($sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleOrderByApproved

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByApprovedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByApproved ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleByIdOrderByApproved

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByApprovedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleByIdOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByApprovedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByApprovedOrderById ($Approved  = 'No', $sorting = 'DESC'){		
		
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
	}//End Function GetAllLocaleByApprovedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByApprovedOrderByIdWithLimit ($Approved  = 'No', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllLocaleByApprovedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByApproved ($Approved  = 'No'){
	
		$Approved =  mysql_escape_string($Approved);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByApproved

	/**
	 * This Method is Script Generated 
	 * updateLocaleApprovedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleApprovedColumnById ($Id, $Approved  = 'No'){
	
		$Id = (int) $Id;
		$Approved =  mysql_escape_string($Approved);
	
		$query  = "UPDATE `locale` SET `approved` = '$Approved' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleApprovedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByOrder ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Order` $sorting ";
	
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
	}//End Function GetAllLocaleOrderByOrder

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByOrderWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Order` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllLocaleOrderByOrderWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByOrder ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `order` $sorting  ";
	
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
	}//End Function GetAllLocaleByIdOrderByOrder

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByOrderWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `order` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllLocaleByIdOrderByOrderWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByOrderOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByOrderOrderById ($Order  = '0', $sorting = 'DESC'){		
		
		$Order = (int) $Order;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `order` = '$Order' ORDER BY `id` ";
	
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
	}//End Function GetAllLocaleByOrderOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByOrderOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByOrderOrderByIdWithLimit ($Order  = '0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Order = (int) $Order;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `order` = '$Order' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllLocaleByOrderOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByOrder
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByOrder ($Order  = '0'){
	
		$Order = (int) $Order;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `order` = '$Order' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByOrder

	/**
	 * This Method is Script Generated 
	 * updateLocaleOrderColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleOrderColumnById ($Id, $Order  = '0'){
	
		$Id = (int) $Id;
		$Order = (int) $Order;
	
		$query  = "UPDATE `locale` SET `order` = '$Order' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleOrderColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByDate_added ($sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByDate_addedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByDate_added ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleByIdOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByDate_addedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByDate_addedOrderById ($Date_added  = 'CURRENT_TIMESTAMP', $sorting = 'DESC'){		
		
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
	}//End Function GetAllLocaleByDate_addedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByDate_addedOrderByIdWithLimit ($Date_added  = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllLocaleByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByDate_added ($Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByDate_added

	/**
	 * This Method is Script Generated 
	 * updateLocaleDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleDate_addedColumnById ($Id, $Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Id = (int) $Id;
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "UPDATE `locale` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleDate_addedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByComments ($sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleOrderByCommentsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByComments ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllLocaleByIdOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByIdOrderByCommentsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllLocaleByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByCommentsOrderById ($Comments , $sorting = 'DESC'){		
		
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
	}//End Function GetAllLocaleByCommentsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllLocaleByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllLocaleByCommentsOrderByIdWithLimit ($Comments , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllLocaleByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromLocaleByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromLocaleByComments ($Comments ){
	
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromLocaleByComments

	/**
	 * This Method is Script Generated 
	 * updateLocaleCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateLocaleCommentsColumnById ($Id, $Comments ){
	
		$Id = (int) $Id;
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "UPDATE `{$this->tableName}` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updateLocaleCommentsColumnById
}