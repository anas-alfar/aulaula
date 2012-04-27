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
 * @name Object_Model_Comment
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Comment extends Aula_Controller_Action {
	
	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'object_comment';
	public $insertColumnsList = '';
	public $updateColumnsParamsListWithoutPrimaryKey = '';
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	private $_2weeksEarlier = '';
	private $_4weeksEarlier = '';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `object_id`, `user_id`, `title`, `content`, `email`, `webpage`, `locale_id`, `country_id`, `published`, `approved`, `comments`, `options`";
		$this -> _selectColumnsList = '`id`, `object_id`, `user_id`, `title`, `content`, `email`, `webpage`, `locale_id`, `country_id`, `published`, `approved`, `date_added`, `comments`, `options`';
		$this->_2weeksEarlier = date ( 'Y-m-d', (time () - 1209600) );
		$this->_4weeksEarlier = date ( 'Y-m-d', (time () - 2419200) );
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoObject_comment
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoObject_comment($Id, $Object_id, $User_id, $Title, $Content, $Email, $Webpage, $Locale_id, $Comments, $Options, $Published = 'No', $Approved = 'No', $Country_id = '1') {
			
		$Id = ( int ) $Id;
		$Object_id = ( int ) $Object_id;
		$User_id = mysql_escape_string ( $User_id );
		$Title = mysql_escape_string ( $Title );
		$Content = mysql_escape_string ( $Content );
		$Email = mysql_escape_string ( $Email );
		$Webpage = mysql_escape_string ( $Webpage );
		$Locale_id = ( int ) $Locale_id;
		$Country_id = ( int ) $Country_id;
		$Published = mysql_escape_string ( $Published );
		$Approved = mysql_escape_string ( $Approved );
		$Comments = mysql_escape_string ( $Comments );
		$Options = mysql_escape_string ( $Options );
		
		$query = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Object_id', '$User_id', '$Title', '$Content', '$Email', '$Webpage', '$Locale_id', '$Country_id', '$Published', '$Approved', '$Comments', '$Options') ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = 'SELECT last_insert_id()';
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return $result;
	} //End Function insertIntoObject_comment
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentById($Id) {
		
		$Id = ( int ) $Id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentById
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentById($Id, $Object_id, $User_id, $Title, $Content, $Email, $Webpage, $Locale_id, $Comments, $Options, $Published = 'No', $Approved = 'No', $Country_id = '1') {
			
		$Id = ( int ) $Id;
		$Object_id = ( int ) $Object_id;
		$User_id = mysql_escape_string ( $User_id );
		$Title = mysql_escape_string ( $Title );
		$Content = mysql_escape_string ( $Content );
		$Email = mysql_escape_string ( $Email );
		$Webpage = mysql_escape_string ( $Webpage );
		$Locale_id = ( int ) $Locale_id;
		$Country_id = ( int ) $Country_id;
		$Published = mysql_escape_string ( $Published );
		$Approved = mysql_escape_string ( $Approved );
		$Comments = mysql_escape_string ( $Comments );
		$Options = mysql_escape_string ( $Options );
		
		$query = "UPDATE `{$this->tableName}` SET  `object_id` = '$Object_id', `user_id` = '$User_id', `title` = '$Title', `content` = '$Content', `email` = '$Email', `webpage` = '$Webpage', `locale_id` = '$Locale_id', `country_id` = '$Country_id', `published` = '$Published', `approved` = '$Approved', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderById($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY id $sorting ";
		
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
	} //End Function GetAllObject_commentOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY id $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getObject_commentDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getObject_commentDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {
		
		$Id = ( int ) $Id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE id = '$Id' LIMIT $start , $limit ";
		
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
	} //End Function getObject_commentDetailsByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getObject_commentDetailsById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getObject_commentDetailsById($Id) {
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ";
		
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
	} //End Function getObject_commentDetailsById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderById($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `id` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByObject_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Object_id` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByObject_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByObject_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByObject_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Object_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByObject_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByObject_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `object_id` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByObject_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByObject_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByObject_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `object_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByObject_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByObject_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByObject_idOrderById($Object_id, $sorting = 'DESC') {
		
		$Object_id = ( int ) $Object_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByObject_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByObject_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByObject_idOrderByIdWithLimit($Object_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Object_id = ( int ) $Object_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByObject_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByObject_id($Object_id) {
		
		$Object_id = ( int ) $Object_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByObject_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentObject_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentObject_idColumnById($Id, $Object_id) {
		
		$Id = ( int ) $Id;
		$Object_id = ( int ) $Object_id;
		
		$query = "UPDATE `object_comment` SET `object_id` = '$Object_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentObject_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByUser_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByUser_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `User_id` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByUser_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByUser_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByUser_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `User_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByUser_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByUser_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByUser_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `user_id` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByUser_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByUser_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByUser_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `user_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByUser_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByUser_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByUser_idOrderById($User_id, $sorting = 'DESC') {
		
		$User_id = mysql_escape_string ( $User_id );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `user_id` = '$User_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByUser_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByUser_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByUser_idOrderByIdWithLimit($User_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$User_id = mysql_escape_string ( $User_id );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `user_id` = '$User_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByUser_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByUser_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByUser_id($User_id) {
		
		$User_id = mysql_escape_string ( $User_id );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `user_id` = '$User_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByUser_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentUser_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentUser_idColumnById($Id, $User_id) {
		
		$Id = ( int ) $Id;
		$User_id = mysql_escape_string ( $User_id );
		
		$query = "UPDATE `object_comment` SET `user_id` = '$User_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentUser_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByTitle($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Title` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByTitle
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByTitleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Title` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByTitleWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByTitle($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `title` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByTitle
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByTitleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `title` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByTitleWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByTitleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByTitleOrderById($Title, $sorting = 'DESC') {
		
		$Title = mysql_escape_string ( $Title );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `title` = '$Title' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByTitleOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByTitleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByTitleOrderByIdWithLimit($Title, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Title = mysql_escape_string ( $Title );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `title` = '$Title' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByTitleOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByTitle
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByTitle($Title) {
		
		$Title = mysql_escape_string ( $Title );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `title` = '$Title' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByTitle
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentTitleColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentTitleColumnById($Id, $Title) {
		
		$Id = ( int ) $Id;
		$Title = mysql_escape_string ( $Title );
		
		$query = "UPDATE `object_comment` SET `title` = '$Title' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentTitleColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByContent
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByContent($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Content` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByContent
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByContentWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByContentWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Content` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByContentWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByContent
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByContent($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `content` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByContent
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByContentWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByContentWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `content` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByContentWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByContentOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByContentOrderById($Content, $sorting = 'DESC') {
		
		$Content = mysql_escape_string ( $Content );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `content` = '$Content' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByContentOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByContentOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByContentOrderByIdWithLimit($Content, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Content = mysql_escape_string ( $Content );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `content` = '$Content' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByContentOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByContent
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByContent($Content) {
		
		$Content = mysql_escape_string ( $Content );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `content` = '$Content' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByContent
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentContentColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentContentColumnById($Id, $Content) {
		
		$Id = ( int ) $Id;
		$Content = mysql_escape_string ( $Content );
		
		$query = "UPDATE `object_comment` SET `content` = '$Content' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentContentColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByEmail
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByEmail($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Email` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByEmail
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByEmailWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByEmailWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Email` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByEmailWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByEmail
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByEmail($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `email` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByEmail
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByEmailWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByEmailWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `email` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByEmailWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByEmailOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByEmailOrderById($Email, $sorting = 'DESC') {
		
		$Email = mysql_escape_string ( $Email );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `email` = '$Email' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByEmailOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByEmailOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByEmailOrderByIdWithLimit($Email, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Email = mysql_escape_string ( $Email );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `email` = '$Email' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByEmailOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByEmail
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByEmail($Email) {
		
		$Email = mysql_escape_string ( $Email );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `email` = '$Email' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByEmail
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentEmailColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentEmailColumnById($Id, $Email) {
		
		$Id = ( int ) $Id;
		$Email = mysql_escape_string ( $Email );
		
		$query = "UPDATE `object_comment` SET `email` = '$Email' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentEmailColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByWebpage
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByWebpage($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Webpage` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByWebpage
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByWebpageWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByWebpageWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Webpage` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByWebpageWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByWebpage
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByWebpage($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `webpage` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByWebpage
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByWebpageWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByWebpageWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `webpage` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByWebpageWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByWebpageOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByWebpageOrderById($Webpage, $sorting = 'DESC') {
		
		$Webpage = mysql_escape_string ( $Webpage );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `webpage` = '$Webpage' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByWebpageOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByWebpageOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByWebpageOrderByIdWithLimit($Webpage, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Webpage = mysql_escape_string ( $Webpage );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `webpage` = '$Webpage' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByWebpageOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByWebpage
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByWebpage($Webpage) {
		
		$Webpage = mysql_escape_string ( $Webpage );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `webpage` = '$Webpage' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByWebpage
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentWebpageColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentWebpageColumnById($Id, $Webpage) {
		
		$Id = ( int ) $Id;
		$Webpage = mysql_escape_string ( $Webpage );
		
		$query = "UPDATE `object_comment` SET `webpage` = '$Webpage' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentWebpageColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByLocale_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByLocale_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale_id` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByLocale_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByLocale_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByLocale_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locale_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByLocale_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByLocale_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByLocale_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locale_id` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByLocale_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByLocale_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByLocale_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locale_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByLocale_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByLocale_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByLocale_idOrderById($Locale_id, $sorting = 'DESC') {
		
		$Locale_id = ( int ) $Locale_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale_id` = '$Locale_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByLocale_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByLocale_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByLocale_idOrderByIdWithLimit($Locale_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Locale_id = ( int ) $Locale_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locale_id` = '$Locale_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByLocale_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByLocale_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByLocale_id($Locale_id) {
		
		$Locale_id = ( int ) $Locale_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `locale_id` = '$Locale_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByLocale_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentLocale_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentLocale_idColumnById($Id, $Locale_id) {
		
		$Id = ( int ) $Id;
		$Locale_id = ( int ) $Locale_id;
		
		$query = "UPDATE `object_comment` SET `locale_id` = '$Locale_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentLocale_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByCountry_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByCountry_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Country_id` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByCountry_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByCountry_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByCountry_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Country_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByCountry_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByCountry_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByCountry_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `country_id` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByCountry_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByCountry_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByCountry_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `country_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByCountry_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByCountry_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByCountry_idOrderById($Country_id, $sorting = 'DESC') {
		
		$Country_id = ( int ) $Country_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `country_id` = '$Country_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByCountry_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByCountry_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByCountry_idOrderByIdWithLimit($Country_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Country_id = ( int ) $Country_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `country_id` = '$Country_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByCountry_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByCountry_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByCountry_id($Country_id) {
		
		$Country_id = ( int ) $Country_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `country_id` = '$Country_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByCountry_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentCountry_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentCountry_idColumnById($Id, $Country_id) {
		
		$Id = ( int ) $Id;
		$Country_id = ( int ) $Country_id;
		
		$query = "UPDATE `object_comment` SET `country_id` = '$Country_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentCountry_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByPublished($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Published` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByPublished
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByPublishedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Published` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByPublishedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByPublished($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `published` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByPublished
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByPublishedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `published` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByPublishedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByPublishedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByPublishedOrderById($Published = 'No', $sorting = 'DESC') {
		
		$Published = mysql_escape_string ( $Published );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `published` = '$Published' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByPublishedOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByPublishedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByPublishedOrderByIdWithLimit($Published = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Published = mysql_escape_string ( $Published );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `published` = '$Published' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByPublishedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByPublished($Published = 'No') {
		
		$Published = mysql_escape_string ( $Published );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `published` = '$Published' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByPublished
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentPublishedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentPublishedColumnById($Id, $Published = 'No') {
		
		$Id = ( int ) $Id;
		$Published = mysql_escape_string ( $Published );
		
		$query = "UPDATE `object_comment` SET `published` = '$Published' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentPublishedColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByApproved($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Approved` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByApproved
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByApprovedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Approved` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByApprovedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByApproved($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `approved` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByApproved
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByApprovedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `approved` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByApprovedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByApprovedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByApprovedOrderById($Approved = 'No', $sorting = 'DESC') {
		
		$Approved = mysql_escape_string ( $Approved );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `approved` = '$Approved' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByApprovedOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByApprovedOrderByIdWithLimit($Approved = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Approved = mysql_escape_string ( $Approved );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `approved` = '$Approved' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByApprovedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByApproved($Approved = 'No') {
		
		$Approved = mysql_escape_string ( $Approved );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByApproved
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentApprovedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentApprovedColumnById($Id, $Approved = 'No') {
		
		$Id = ( int ) $Id;
		$Approved = mysql_escape_string ( $Approved );
		
		$query = "UPDATE `object_comment` SET `approved` = '$Approved' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentApprovedColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByDate_added($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Date_added` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByDate_added
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByDate_addedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Date_added` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByDate_addedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByDate_added($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `date_added` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByDate_added
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByDate_addedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `date_added` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByDate_addedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByDate_addedOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByDate_addedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByDate_added($Date_added = 'CURRENT_TIMESTAMP') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByDate_added
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {
		
		$Id = ( int ) $Id;
		$Date_added = mysql_escape_string ( $Date_added );
		
		$query = "UPDATE `object_comment` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentDate_addedColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByComments($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Comments` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByComments
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByCommentsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Comments` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByCommentsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByComments($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `comments` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByComments
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByCommentsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `comments` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByCommentsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByCommentsOrderById($Comments, $sorting = 'DESC') {
		
		$Comments = mysql_escape_string ( $Comments );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `comments` = '$Comments' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByCommentsOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByCommentsOrderByIdWithLimit($Comments, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Comments = mysql_escape_string ( $Comments );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `comments` = '$Comments' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByCommentsOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByComments($Comments) {
		
		$Comments = mysql_escape_string ( $Comments );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByComments
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentCommentsColumnById($Id, $Comments) {
		
		$Id = ( int ) $Id;
		$Comments = mysql_escape_string ( $Comments );
		
		$query = "UPDATE `object_comment` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentCommentsColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByOptions($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Options` $sorting ";
		
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
	} //End Function GetAllObject_commentOrderByOptions
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentOrderByOptionsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Options` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_commentOrderByOptionsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByOptions($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `options` $sorting  ";
		
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
	} //End Function GetAllObject_commentByIdOrderByOptions
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByIdOrderByOptionsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `options` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByIdOrderByOptionsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByOptionsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByOptionsOrderById($Options, $sorting = 'DESC') {
		
		$Options = mysql_escape_string ( $Options );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `options` = '$Options' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_commentByOptionsOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByOptionsOrderByIdWithLimit($Options, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Options = mysql_escape_string ( $Options );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `options` = '$Options' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_commentByOptionsOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_commentByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_commentByOptions($Options) {
		
		$Options = mysql_escape_string ( $Options );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_commentByOptions
	

	/**
	 * This Method is Script Generated 
	 * updateObject_commentOptionsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_commentOptionsColumnById($Id, $Options) {
		
		$Id = ( int ) $Id;
		$Options = mysql_escape_string ( $Options );
		
		$query = "UPDATE `{$this->tableName}` SET `options` = '$Options' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_commentOptionsColumnById
	
	public function GetAllObject_commentOrderByColumnWithLimit($Column = 'oc.date_added', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Column = mysql_escape_string ( $Column );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id` 
FROM `object_comment` AS oc 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id` 
WHERE oc.`date_added` > '2010-07-15' 
ORDER BY $Column $sorting
LIMIT $start, $limit";
		
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
	} //End Function GetAllObject_commentOrderByColumnWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentBySearchOrderByColumnWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentBySearchOrderByColumnWithLimit($Column = 'oc.date_added', $start = 0, $limit = 10, $sorting = 'DESC', $webpage = NULL, $email = NULL, $articleTitle = NULL, $userId = NULL, $content = NULL, $published = NULL, $approved = NULL, $dateAddedFrom = NULL, $dateAddedTo = NULL, $categoryList = NULL) {
		$searchCondition = '';
		if ($webpage !== NULL) {
			$webpage = mysql_escape_string ( $webpage );
			$searchCondition .= 'oc.`webpage`="' . $webpage . '" AND ';
		}
		if ($email !== NULL) {
			$email = mysql_escape_string ( $email );
			$and = ' AND ';
			$searchCondition .= ' oc.`email` LIKE "%' . $email . '%" AND ';
		}
		if ($articleTitle !== NULL) {
			$articleTitle = mysql_escape_string ( $articleTitle );
			$searchCondition .= ' o.`title` LIKE "%' . $articleTitle . '%" AND ';
		}
		if ($userId !== NULL) {
			$userId = mysql_escape_string ( $userId );
			$searchCondition .= ' oc.`user_id` LIKE "%' . $userId . '%" AND ';
		}
		if ($content !== NULL) {
			$content = mysql_escape_string ( $content );
			$searchCondition .= ' oc.`content` LIKE "%' . $content . '%" AND ';
		}
		if ($published !== NULL) {
			$published = mysql_escape_string ( $published );
			$searchCondition .= ' oc.`published`="' . $published . '" AND ';
		}
		if ($categoryList !== NULL) {
			$searchCondition .= ' o.`category_id` IN ("' . $categoryList . '") AND ';
		}
		if ($dateAddedFrom !== NULL && $dateAddedTo !== NULL) {
			$dateAddedFrom = mysql_escape_string ( $dateAddedFrom );
			$dateAddedTo = mysql_escape_string ( $dateAddedTo );
			$searchCondition .= ' oc.`date_added`> "' . $dateAddedFrom . '" AND  oc.`date_added`< "' . $dateAddedTo . '" AND ';
		} /*else {
			$_last10DaysTime = time () - (60 * 60 * 24 * 10);
			$_last10DaysDate = date ( 'Y-m-d', $_last10DaysTime );
			$searchCondition .= ' oc.`date_added` > "' . $_last10DaysDate . '" AND ';
		}*/
		
		$searchCondition = substr ( $searchCondition, 0, - 4 );
		$Column = mysql_escape_string ( $Column );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllObject_commentBySearchOrderByColumnWithLimit('$searchCondition', '$Column','$start', '$limit', '$sorting')";
		
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
	} //End Function GetAllObject_commentBySearchOrderByColumnWithLimit
	

	public function GetCleanObject_commentByObject_idOrderByIdWithLimit($Object_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Object_id = ( int ) $Object_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS `id`, `object_id`, `user_id`, `title`, `content`, `email`, `webpage`, `locale_id`, `country_id`, `published`, `approved`, `date_added`, `comments`, `options` 
FROM `object_comment` WHERE `object_id` = '$Object_id' AND `published` = 'Yes' AND `approved` = 'Yes' ORDER BY `id` $sorting LIMIT $start, $limit ";
		
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
	} //End Function GetCleanObject_commentByObject_idOrderByIdWithLimit
	

	public function GetCleanObject_commentByObject_idOrderByIdWithoutLimit($Object_id, $sorting = 'DESC') {
		
		$Object_id = ( int ) $Object_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT 		SQL_CALC_FOUND_ROWS `id`, `object_id`, `user_id`, `title`, `content`, `email`, `webpage`, `locale_id`, `country_id`, `published`, `approved`, `date_added`, `comments`, `options` 
FROM `object_comment` WHERE `object_id` = '$Object_id' AND `published` = 'Yes' AND `approved` = 'Yes' ORDER BY `id` $sorting ";
		
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
	} //End Function GetCleanObject_commentByObject_idOrderByIdWithoutLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentByCategoryListOrderByColumnWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($Category_id, $Special_article = false, $Column = 'oc.date_added', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Column = mysql_escape_string ( $Column );
		$Special_article = ( bool ) ($Special_article);
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		if ($Special_article === True) {
			$Special_article_condition = 'IN';
		} else {
			$Special_article_condition = 'NOT IN';
		}
		
		 $query = "SELECT straight_join SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id` 
FROM `object_comment` AS oc 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id` 
WHERE o.`category_id` IN ($Category_id)
AND oc.`object_id` $Special_article_condition (SELECT `object_id` FROM `object_article_special`) 
AND oc.`date_added` > '{$this->_4weeksEarlier}' 
ORDER BY $Column $sorting
LIMIT $start, $limit";

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
	} //End Function GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article


  public function GetAllObject_commentOrderByColumnWithLimitAndSpecial_article($Column = 'oc.date_added', $Special_article = false, $start = 0, $limit = 10, $sorting = 'DESC') {
    
    $Column = mysql_escape_string ( $Column );
    $start = ( int ) ($start);
    $limit = ( int ) ($limit);
    $sorting = mysql_escape_string ( $sorting );
    $Special_article = ( bool ) ($Special_article);
    if ($Special_article === True) {
      $query = "SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
INNER JOIN `object_article_special` oas on (oas.object_id = oc.`object_id`)
WHERE oc.`date_added` > '{$this->_4weeksEarlier}' 
ORDER BY $Column $sorting
LIMIT $start, $limit";
    } else {
     $query = "SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc FORCE INDEX(date_id_idx) 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
left join `object_article_special` oas on oas.object_id = oc.`object_id`
WHERE oc.`date_added` > '{$this->_4weeksEarlier}' 
AND oas.object_id is null
ORDER BY $Column $sorting
LIMIT $start, $limit";
  }
    
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
  } //End Function GetAllObject_commentOrderByColumnWithLimitAndSpecial_article
  
	/**
	 * This Method is Script Generated 
	 * GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article($Column = 'oc.date_added', $Special_article = false,$start = 0, $limit = 10, $sorting = 'DESC', $webpage = NULL, $email = NULL, $articleTitle = NULL, $userId = NULL, $content = NULL, $published = NULL, $approved = NULL, $dateAddedFrom = NULL, $dateAddedTo = NULL, $categoryList = NULL) {
		$searchCondition = '';
		if ($webpage !== NULL) {
			$webpage = mysql_escape_string ( $webpage );
			$searchCondition .= 'oc.`webpage` LIKE "%' . $webpage . '%" AND ';
		}
		if ($email !== NULL) {
			$email = mysql_escape_string ( $email );
			$and = ' AND ';
			$searchCondition .= ' oc.`email` LIKE "%' . $email . '%" AND ';
		}
		if ($articleTitle !== NULL) {
			$articleTitle = mysql_escape_string ( $articleTitle );
			$searchCondition .= ' o.`title` LIKE "%' . $articleTitle . '%" AND ';
		}
		if ($userId !== NULL) {
			$userId = mysql_escape_string ( $userId );
			$searchCondition .= ' oc.`user_id` LIKE "%' . $userId . '%" AND ';
		}
		if ($content !== NULL) {
			$content = mysql_escape_string ( $content );
			$searchCondition .= ' oc.`content` LIKE "%' . $content . '%" AND ';
		}
		if ($published !== NULL) {
			$published = mysql_escape_string ( $published );
			$searchCondition .= ' oc.`published`="' . $published . '" AND ';
		}
		if ($categoryList !== NULL) {
			$searchCondition .= ' o.`category_id` IN (' . $categoryList . ') AND ';
		}
		if ($dateAddedFrom !== NULL && $dateAddedTo !== NULL) {
			$dateAddedFrom = mysql_escape_string ( $dateAddedFrom );
			$dateAddedTo = mysql_escape_string ( $dateAddedTo );
			$searchCondition .= ' oc.`date_added`> "' . $dateAddedFrom . '" AND  oc.`date_added`< "' . $dateAddedTo . '" AND ';
		} /*else {
			$_last10DaysTime = time () - (60 * 60 * 24 * 10);
			$_last10DaysDate = date ( 'Y-m-d', $_last10DaysTime );
			$searchCondition .= ' oc.`date_added` > "' . $_last10DaysDate . '" AND ';
		} */
		
		$searchCondition = substr ( $searchCondition, 0, - 4 );
		$Column = mysql_escape_string ( $Column );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		$Special_article = ( bool ) ($Special_article);
		if ($Special_article === True) {
			$query = "SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
INNER JOIN `object_article_special` oas on (oas.object_id = oc.`object_id`)
WHERE $searchCondition 
ORDER BY $Column $sorting
LIMIT $start, $limit";
		} else {
			$query = "SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc FORCE INDEX(date_id_idx) 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
left join `object_article_special` oas on oas.object_id = oc.`object_id`
WHERE $searchCondition 
AND oas.object_id is null
ORDER BY $Column $sorting
LIMIT $start, $limit";
		}
		
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
	} //End Function GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article
}