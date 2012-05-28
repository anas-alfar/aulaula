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
 * @name Object_Model_Article
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Article extends Aula_Controller_Action {
	
	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'object_article';
	public $insertColumnsList = '';
	public $updateColumnsParamsListWithoutPrimaryKey = '';
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $showInObject = 'Yes';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = "allowComments=1\r\nspecialArticle=0";
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 1;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 1;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $objectType = 1;
	
	private $_2weeksEarlier = '';
	private $_4weeksEarlier = '';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `alias`, `intro_text`, `full_text`, `created_date`, `author_id`, `source_id`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `comments`, `options`";
		$this -> _selectColumnsList = '`id`, `alias`, `intro_text`, `full_text`, `created_date`, `author_id`, `source_id`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options`';
		$this->_2weeksEarlier = date ('Y-m-d', (time()-1209600));
		$this->_4weeksEarlier = date ('Y-m-d', (time()-2419200));
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoObject_article
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoObject_article($Id, $Alias, $Intro_text, $Full_text, $Created_date, $Author_id, $Source_id, $Object_id, $Category_id, $Comments, $Options, $Publish_from = '0000-00-00 00:00:00', $Publish_to = '0000-00-00 00:00:00', $Show_in_object = 'Yes', $Published = 'No', $Approved = 'No', $Order = '0', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {
			
		$Id = ( int ) $Id;
		$Alias = mysql_escape_string ( $Alias );
		$Intro_text = mysql_escape_string ( $Intro_text );
		$Full_text = mysql_escape_string ( $Full_text );
		$Created_date = mysql_escape_string ( $Created_date );
		$Author_id = ( int ) $Author_id;
		$Source_id = ( int ) $Source_id;
		$Object_id = ( int ) $Object_id;
		$Category_id = ( int ) $Category_id;
		$Show_in_object = mysql_escape_string ( $Show_in_object );
		$Published = mysql_escape_string ( $Published );
		$Approved = mysql_escape_string ( $Approved );
		$Order = ( int ) $Order;
		$Locked_by = ( int ) $Locked_by;
		$Locked_time = mysql_escape_string ( $Locked_time );
		$Modified_by = ( int ) $Modified_by;
		$Modified_time = mysql_escape_string ( $Modified_time );
		$Publish_from = mysql_escape_string ( $Publish_from );
		$Publish_to = mysql_escape_string ( $Publish_to );
		$Comments = mysql_escape_string ( $Comments );
		$Options = mysql_escape_string ( $Options );
		
		$query = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Alias', '$Intro_text', '$Full_text', '$Created_date', '$Author_id', '$Source_id', '$Object_id', '$Category_id', '$Show_in_object', '$Published', '$Approved', '$Order', '$Locked_by', '$Locked_time', '$Modified_by', '$Modified_time', '$Publish_from', '$Publish_to', '$Comments', '$Options') ";
		
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
	} //End Function insertIntoObject_article
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleById($Id) {
		
		$Id = ( int ) $Id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleById
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleById($Id, $Alias, $Intro_text, $Full_text, $Created_date, $Author_id, $Source_id, $Object_id, $Category_id, $Comments, $Options, $Publish_from = '0000-00-00 00:00:00', $Publish_to = '0000-00-00 00:00:00', $Show_in_object = 'Yes', $Published = 'No', $Approved = 'No', $Order = '0', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {
			
		$Id = ( int ) $Id;
		$Alias = mysql_escape_string ( $Alias );
		$Intro_text = mysql_escape_string ( $Intro_text );
		$Full_text = mysql_escape_string ( $Full_text );
		$Created_date = mysql_escape_string ( $Created_date );
		$Author_id = ( int ) $Author_id;
		$Source_id = ( int ) $Source_id;
		$Object_id = ( int ) $Object_id;
		$Category_id = ( int ) $Category_id;
		$Show_in_object = mysql_escape_string ( $Show_in_object );
		$Published = mysql_escape_string ( $Published );
		$Approved = mysql_escape_string ( $Approved );
		$Order = ( int ) $Order;
		$Locked_by = ( int ) $Locked_by;
		$Locked_time = mysql_escape_string ( $Locked_time );
		$Modified_by = ( int ) $Modified_by;
		$Modified_time = mysql_escape_string ( $Modified_time );
		$Publish_from = mysql_escape_string ( $Publish_from );
		$Publish_to = mysql_escape_string ( $Publish_to );
		$Comments = mysql_escape_string ( $Comments );
		$Options = mysql_escape_string ( $Options );
		
		$query = "UPDATE `{$this->tableName}` SET  `alias` = '$Alias', `intro_text` = '$Intro_text', `full_text` = '$Full_text', `created_date` = '$Created_date', `author_id` = '$Author_id', `source_id` = '$Source_id', `object_id` = '$Object_id', `category_id` = '$Category_id', `show_in_object` = '$Show_in_object', `published` = '$Published', `approved` = '$Approved', `order` = '$Order', `locked_by` = '$Locked_by', `locked_time` = '$Locked_time', `modified_by` = '$Modified_by', `modified_time` = '$Modified_time', `publish_from` = '$Publish_from', `publish_to` = '$Publish_to', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderById($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getObject_articleDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getObject_articleDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {
		
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
	} //End Function getObject_articleDetailsByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getObject_articleDetailsById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getObject_articleDetailsById($Id) {
		
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
	} //End Function getObject_articleDetailsById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderById($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByAlias
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByAlias($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Alias` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByAlias
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByAliasWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByAliasWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Alias` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByAliasWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByAlias
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByAlias($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `alias` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByAlias
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByAliasWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByAliasWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `alias` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByAliasWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByAliasOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByAliasOrderById($Alias, $sorting = 'DESC') {
		
		$Alias = mysql_escape_string ( $Alias );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `alias` = '$Alias' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByAliasOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByAliasOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByAliasOrderByIdWithLimit($Alias, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Alias = mysql_escape_string ( $Alias );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `alias` = '$Alias' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByAliasOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByAlias
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByAlias($Alias) {
		
		$Alias = mysql_escape_string ( $Alias );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `alias` = '$Alias' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByAlias
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleAliasColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleAliasColumnById($Id, $Alias) {
		
		$Id = ( int ) $Id;
		$Alias = mysql_escape_string ( $Alias );
		
		$query = "UPDATE `object_article` SET `alias` = '$Alias' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleAliasColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByIntro_text
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByIntro_text($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Intro_text` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByIntro_text
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByIntro_textWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByIntro_textWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Intro_text` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByIntro_textWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByIntro_text
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByIntro_text($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `intro_text` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByIntro_text
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByIntro_textWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByIntro_textWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `intro_text` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByIntro_textWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIntro_textOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIntro_textOrderById($Intro_text, $sorting = 'DESC') {
		
		$Intro_text = mysql_escape_string ( $Intro_text );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `intro_text` = '$Intro_text' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByIntro_textOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIntro_textOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIntro_textOrderByIdWithLimit($Intro_text, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Intro_text = mysql_escape_string ( $Intro_text );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `intro_text` = '$Intro_text' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIntro_textOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByIntro_text
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByIntro_text($Intro_text) {
		
		$Intro_text = mysql_escape_string ( $Intro_text );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `intro_text` = '$Intro_text' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByIntro_text
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleIntro_textColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleIntro_textColumnById($Id, $Intro_text) {
		
		$Id = ( int ) $Id;
		$Intro_text = mysql_escape_string ( $Intro_text );
		
		$query = "UPDATE `object_article` SET `intro_text` = '$Intro_text' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleIntro_textColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByFull_text
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByFull_text($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Full_text` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByFull_text
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByFull_textWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByFull_textWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Full_text` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByFull_textWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByFull_text
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByFull_text($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `full_text` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByFull_text
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByFull_textWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByFull_textWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `full_text` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByFull_textWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByFull_textOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByFull_textOrderById($Full_text, $sorting = 'DESC') {
		
		$Full_text = mysql_escape_string ( $Full_text );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `full_text` = '$Full_text' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByFull_textOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByFull_textOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByFull_textOrderByIdWithLimit($Full_text, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Full_text = mysql_escape_string ( $Full_text );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `full_text` = '$Full_text' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByFull_textOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByFull_text
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByFull_text($Full_text) {
		
		$Full_text = mysql_escape_string ( $Full_text );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `full_text` = '$Full_text' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByFull_text
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleFull_textColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleFull_textColumnById($Id, $Full_text) {
		
		$Id = ( int ) $Id;
		$Full_text = mysql_escape_string ( $Full_text );
		
		$query = "UPDATE `object_article` SET `full_text` = '$Full_text' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleFull_textColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByCreated_date
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByCreated_date($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Created_date` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByCreated_date
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByCreated_dateWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByCreated_dateWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Created_date` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByCreated_dateWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByCreated_date
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByCreated_date($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `created_date` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByCreated_date
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByCreated_dateWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByCreated_dateWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `created_date` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByCreated_dateWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByCreated_dateOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByCreated_dateOrderById($Created_date, $sorting = 'DESC') {
		
		$Created_date = mysql_escape_string ( $Created_date );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `created_date` = '$Created_date' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByCreated_dateOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByCreated_dateOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByCreated_dateOrderByIdWithLimit($Created_date, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Created_date = mysql_escape_string ( $Created_date );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `created_date` = '$Created_date' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByCreated_dateOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByCreated_date
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByCreated_date($Created_date) {
		
		$Created_date = mysql_escape_string ( $Created_date );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `created_date` = '$Created_date' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByCreated_date
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleCreated_dateColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleCreated_dateColumnById($Id, $Created_date) {
		
		$Id = ( int ) $Id;
		$Created_date = mysql_escape_string ( $Created_date );
		
		$query = "UPDATE `object_article` SET `created_date` = '$Created_date' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleCreated_dateColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByAuthor_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Author_id` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByAuthor_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByAuthor_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Author_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByAuthor_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByAuthor_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `author_id` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByAuthor_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByAuthor_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `author_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByAuthor_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByAuthor_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByAuthor_idOrderById($Author_id, $sorting = 'DESC') {
		
		$Author_id = ( int ) $Author_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByAuthor_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByAuthor_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByAuthor_idOrderByIdWithLimit($Author_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Author_id = ( int ) $Author_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByAuthor_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByAuthor_id($Author_id) {
		
		$Author_id = ( int ) $Author_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByAuthor_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleAuthor_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleAuthor_idColumnById($Id, $Author_id) {
		
		$Id = ( int ) $Id;
		$Author_id = ( int ) $Author_id;
		
		$query = "UPDATE `object_article` SET `author_id` = '$Author_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleAuthor_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderBySource_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderBySource_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Source_id` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderBySource_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderBySource_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderBySource_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Source_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderBySource_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderBySource_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderBySource_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `source_id` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderBySource_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderBySource_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderBySource_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `source_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderBySource_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleBySource_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleBySource_idOrderById($Source_id, $sorting = 'DESC') {
		
		$Source_id = ( int ) $Source_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `source_id` = '$Source_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleBySource_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleBySource_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleBySource_idOrderByIdWithLimit($Source_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Source_id = ( int ) $Source_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `source_id` = '$Source_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleBySource_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleBySource_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleBySource_id($Source_id) {
		
		$Source_id = ( int ) $Source_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `source_id` = '$Source_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleBySource_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleSource_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleSource_idColumnById($Id, $Source_id) {
		
		$Id = ( int ) $Id;
		$Source_id = ( int ) $Source_id;
		
		$query = "UPDATE `object_article` SET `source_id` = '$Source_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleSource_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByObject_id($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByObject_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByObject_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByObject_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleOrderByObject_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByObject_id($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderByObject_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByObject_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByObject_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByObject_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByObject_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByObject_idOrderById($Object_id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByObject_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByObject_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByObject_idOrderByIdWithLimit($Object_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByObject_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByObject_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByObject_id($Object_id) {
		
		$Object_id = ( int ) $Object_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `object_id` = '$Object_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByObject_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleObject_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleObject_idColumnById($Id, $Object_id) {
		
		$Id = ( int ) $Id;
		$Object_id = ( int ) $Object_id;
		
		$query = "UPDATE `object_article` SET `object_id` = '$Object_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleObject_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByCategory_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByCategory_id($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Category_id` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByCategory_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByCategory_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByCategory_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Category_id` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByCategory_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByCategory_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByCategory_id($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `category_id` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByCategory_id
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByCategory_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByCategory_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `category_id` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByCategory_idWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByCategory_idOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByCategory_idOrderById($Category_id, $sorting = 'DESC') {
		
		$Category_id = ( int ) $Category_id;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `category_id` = '$Category_id' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByCategory_idOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByCategory_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByCategory_idOrderByIdWithLimit($Category_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Category_id = ( int ) $Category_id;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `category_id` = '$Category_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByCategory_idOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByCategory_id
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByCategory_id($Category_id) {
		
		$Category_id = ( int ) $Category_id;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `category_id` = '$Category_id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByCategory_id
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleCategory_idColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleCategory_idColumnById($Id, $Category_id) {
		
		$Id = ( int ) $Id;
		$Category_id = ( int ) $Category_id;
		
		$query = "UPDATE `object_article` SET `category_id` = '$Category_id' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleCategory_idColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByShow_in_object
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByShow_in_object($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Show_in_object` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByShow_in_object
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByShow_in_objectWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByShow_in_objectWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Show_in_object` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByShow_in_objectWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByShow_in_object
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByShow_in_object($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `show_in_object` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByShow_in_object
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByShow_in_objectWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByShow_in_objectWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `show_in_object` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByShow_in_objectWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByShow_in_objectOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByShow_in_objectOrderById($Show_in_object = 'Yes', $sorting = 'DESC') {
		
		$Show_in_object = mysql_escape_string ( $Show_in_object );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `show_in_object` = '$Show_in_object' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByShow_in_objectOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByShow_in_objectOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByShow_in_objectOrderByIdWithLimit($Show_in_object = 'Yes', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Show_in_object = mysql_escape_string ( $Show_in_object );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `show_in_object` = '$Show_in_object' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByShow_in_objectOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByShow_in_object
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByShow_in_object($Show_in_object = 'Yes') {
		
		$Show_in_object = mysql_escape_string ( $Show_in_object );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `show_in_object` = '$Show_in_object' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByShow_in_object
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleShow_in_objectColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleShow_in_objectColumnById($Id, $Show_in_object = 'Yes') {
		
		$Id = ( int ) $Id;
		$Show_in_object = mysql_escape_string ( $Show_in_object );
		
		$query = "UPDATE `object_article` SET `show_in_object` = '$Show_in_object' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleShow_in_objectColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByPublished($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByPublished
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByPublishedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleOrderByPublishedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByPublished($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderByPublished
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByPublishedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByPublishedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByPublishedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByPublishedOrderById($Published = 'No', $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByPublishedOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByPublishedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByPublishedOrderByIdWithLimit($Published = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByPublishedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByPublished
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByPublished($Published = 'No') {
		
		$Published = mysql_escape_string ( $Published );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `published` = '$Published' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByPublished
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articlePublishedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articlePublishedColumnById($Id, $Published = 'No') {
		
		$Id = ( int ) $Id;
		$Published = mysql_escape_string ( $Published );
		
		$query = "UPDATE `object_article` SET `published` = '$Published' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articlePublishedColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByApproved($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByApproved
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByApprovedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleOrderByApprovedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByApproved($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderByApproved
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByApprovedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByApprovedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByApprovedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByApprovedOrderById($Approved = 'No', $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByApprovedOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByApprovedOrderByIdWithLimit($Approved = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByApprovedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByApproved
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByApproved($Approved = 'No') {
		
		$Approved = mysql_escape_string ( $Approved );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByApproved
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleApprovedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleApprovedColumnById($Id, $Approved = 'No') {
		
		$Id = ( int ) $Id;
		$Approved = mysql_escape_string ( $Approved );
		
		$query = "UPDATE `object_article` SET `approved` = '$Approved' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleApprovedColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByOrder($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Order` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByOrder
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByOrderWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Order` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByOrderWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByOrder($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `order` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByOrder
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByOrderWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `order` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByOrderWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByOrderOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByOrderOrderById($Order = '0', $sorting = 'DESC') {
		
		$Order = ( int ) $Order;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `order` = '$Order' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByOrderOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByOrderOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByOrderOrderByIdWithLimit($Order = '0', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Order = ( int ) $Order;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `order` = '$Order' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByOrderOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByOrder
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByOrder($Order = '0') {
		
		$Order = ( int ) $Order;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `order` = '$Order' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByOrder
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleOrderColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleOrderColumnById($Id, $Order = '0') {
		
		$Id = ( int ) $Id;
		$Order = ( int ) $Order;
		
		$query = "UPDATE `object_article` SET `order` = '$Order' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleOrderColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByLocked_by($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_by` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByLocked_by
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByLocked_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_by` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByLocked_byWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByLocked_by($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locked_by` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByLocked_by
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByLocked_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locked_by` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByLocked_byWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByLocked_byOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByLocked_byOrderById($Locked_by = '0', $sorting = 'DESC') {
		
		$Locked_by = ( int ) $Locked_by;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByLocked_byOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByLocked_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByLocked_byOrderByIdWithLimit($Locked_by = '0', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Locked_by = ( int ) $Locked_by;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByLocked_byOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByLocked_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByLocked_by($Locked_by = '0') {
		
		$Locked_by = ( int ) $Locked_by;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByLocked_by
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleLocked_byColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleLocked_byColumnById($Id, $Locked_by = '0') {
		
		$Id = ( int ) $Id;
		$Locked_by = ( int ) $Locked_by;
		
		$query = "UPDATE `object_article` SET `locked_by` = '$Locked_by' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleLocked_byColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByLocked_time($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_time` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByLocked_time
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByLocked_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_time` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByLocked_timeWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByLocked_time($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locked_time` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByLocked_time
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByLocked_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locked_time` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByLocked_timeWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByLocked_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByLocked_timeOrderById($Locked_time = '0000-00-00 00:00:00', $sorting = 'DESC') {
		
		$Locked_time = mysql_escape_string ( $Locked_time );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByLocked_timeOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByLocked_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByLocked_timeOrderByIdWithLimit($Locked_time = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Locked_time = mysql_escape_string ( $Locked_time );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByLocked_timeOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByLocked_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByLocked_time($Locked_time = '0000-00-00 00:00:00') {
		
		$Locked_time = mysql_escape_string ( $Locked_time );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByLocked_time
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleLocked_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleLocked_timeColumnById($Id, $Locked_time = '0000-00-00 00:00:00') {
		
		$Id = ( int ) $Id;
		$Locked_time = mysql_escape_string ( $Locked_time );
		
		$query = "UPDATE `object_article` SET `locked_time` = '$Locked_time' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleLocked_timeColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByModified_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByModified_by($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_by` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByModified_by
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByModified_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_by` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByModified_byWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByModified_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByModified_by($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `modified_by` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByModified_by
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByModified_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `modified_by` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByModified_byWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByModified_byOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByModified_byOrderById($Modified_by = '0', $sorting = 'DESC') {
		
		$Modified_by = ( int ) $Modified_by;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByModified_byOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByModified_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByModified_byOrderByIdWithLimit($Modified_by = '0', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Modified_by = ( int ) $Modified_by;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByModified_byOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByModified_by
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByModified_by($Modified_by = '0') {
		
		$Modified_by = ( int ) $Modified_by;
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByModified_by
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleModified_byColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleModified_byColumnById($Id, $Modified_by = '0') {
		
		$Id = ( int ) $Id;
		$Modified_by = ( int ) $Modified_by;
		
		$query = "UPDATE `object_article` SET `modified_by` = '$Modified_by' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleModified_byColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByModified_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByModified_time($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_time` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByModified_time
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByModified_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_time` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByModified_timeWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByModified_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByModified_time($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `modified_time` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByModified_time
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByModified_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `modified_time` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByModified_timeWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByModified_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByModified_timeOrderById($Modified_time = '0000-00-00 00:00:00', $sorting = 'DESC') {
		
		$Modified_time = mysql_escape_string ( $Modified_time );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByModified_timeOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByModified_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByModified_timeOrderByIdWithLimit($Modified_time = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Modified_time = mysql_escape_string ( $Modified_time );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByModified_timeOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByModified_time
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByModified_time($Modified_time = '0000-00-00 00:00:00') {
		
		$Modified_time = mysql_escape_string ( $Modified_time );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByModified_time
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleModified_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleModified_timeColumnById($Id, $Modified_time = '0000-00-00 00:00:00') {
		
		$Id = ( int ) $Id;
		$Modified_time = mysql_escape_string ( $Modified_time );
		
		$query = "UPDATE `object_article` SET `modified_time` = '$Modified_time' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleModified_timeColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByPublish_from
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByPublish_from($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_from` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByPublish_from
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByPublish_fromWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByPublish_fromWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_from` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByPublish_fromWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByPublish_from
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByPublish_from($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `publish_from` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByPublish_from
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByPublish_fromWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByPublish_fromWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `publish_from` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByPublish_fromWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByPublish_fromOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByPublish_fromOrderById($Publish_from = '0000-00-00 00:00:00', $sorting = 'DESC') {
		
		$Publish_from = mysql_escape_string ( $Publish_from );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_from` = '$Publish_from' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByPublish_fromOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByPublish_fromOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByPublish_fromOrderByIdWithLimit($Publish_from = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Publish_from = mysql_escape_string ( $Publish_from );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_from` = '$Publish_from' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByPublish_fromOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByPublish_from
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByPublish_from($Publish_from = '0000-00-00 00:00:00') {
		
		$Publish_from = mysql_escape_string ( $Publish_from );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `publish_from` = '$Publish_from' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByPublish_from
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articlePublish_fromColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articlePublish_fromColumnById($Id, $Publish_from = '0000-00-00 00:00:00') {
		
		$Id = ( int ) $Id;
		$Publish_from = mysql_escape_string ( $Publish_from );
		
		$query = "UPDATE `object_article` SET `publish_from` = '$Publish_from' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articlePublish_fromColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByPublish_to
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByPublish_to($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_to` $sorting ";
		
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
	} //End Function GetAllObject_articleOrderByPublish_to
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByPublish_toWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByPublish_toWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_to` $sorting LIMIT $start,$limit ";
		
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
	} //End Function GetAllObject_articleOrderByPublish_toWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByPublish_to
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByPublish_to($Id, $sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `publish_to` $sorting  ";
		
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
	} //End Function GetAllObject_articleByIdOrderByPublish_to
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByPublish_toWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByPublish_toWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$Id = ( int ) $Id;
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `publish_to` $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByIdOrderByPublish_toWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByPublish_toOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByPublish_toOrderById($Publish_to = '0000-00-00 00:00:00', $sorting = 'DESC') {
		
		$Publish_to = mysql_escape_string ( $Publish_to );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_to` = '$Publish_to' ORDER BY `id` ";
		
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
	} //End Function GetAllObject_articleByPublish_toOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByPublish_toOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByPublish_toOrderByIdWithLimit($Publish_to = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Publish_to = mysql_escape_string ( $Publish_to );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_to` = '$Publish_to' ORDER BY `id`  $sorting LIMIT $start , $limit ";
		
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
	} //End Function GetAllObject_articleByPublish_toOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByPublish_to
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByPublish_to($Publish_to = '0000-00-00 00:00:00') {
		
		$Publish_to = mysql_escape_string ( $Publish_to );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `publish_to` = '$Publish_to' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByPublish_to
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articlePublish_toColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articlePublish_toColumnById($Id, $Publish_to = '0000-00-00 00:00:00') {
		
		$Id = ( int ) $Id;
		$Publish_to = mysql_escape_string ( $Publish_to );
		
		$query = "UPDATE `object_article` SET `publish_to` = '$Publish_to' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articlePublish_toColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByDate_added($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByDate_added
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByDate_addedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleOrderByDate_addedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByDate_added($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderByDate_added
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByDate_addedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByDate_addedWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByDate_addedOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByDate_addedOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByDate_added
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByDate_added($Date_added = 'CURRENT_TIMESTAMP') {
		
		$Date_added = mysql_escape_string ( $Date_added );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByDate_added
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {
		
		$Id = ( int ) $Id;
		$Date_added = mysql_escape_string ( $Date_added );
		
		$query = "UPDATE `object_article` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleDate_addedColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByComments($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByComments
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByCommentsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleOrderByCommentsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByComments($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderByComments
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByCommentsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByCommentsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByCommentsOrderById($Comments, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByCommentsOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByCommentsOrderByIdWithLimit($Comments, $start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByCommentsOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByComments
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByComments($Comments) {
		
		$Comments = mysql_escape_string ( $Comments );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByComments
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleCommentsColumnById($Id, $Comments) {
		
		$Id = ( int ) $Id;
		$Comments = mysql_escape_string ( $Comments );
		
		$query = "UPDATE `object_article` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleCommentsColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByOptions($sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleOrderByOptions
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleOrderByOptionsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleOrderByOptionsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByOptions($Id, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByIdOrderByOptions
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByIdOrderByOptionsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		
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
	} //End Function GetAllObject_articleByIdOrderByOptionsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByOptionsOrderById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByOptionsOrderById($Options, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByOptionsOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllObject_articleByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllObject_articleByOptionsOrderByIdWithLimit($Options, $start = 0, $limit = 10, $sorting = 'DESC') {
		
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
	} //End Function GetAllObject_articleByOptionsOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleByOptions
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_articleByOptions($Options) {
		
		$Options = mysql_escape_string ( $Options );
		
		$query = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_articleByOptions
	

	/**
	 * This Method is Script Generated 
	 * updateObject_articleOptionsColumnById
	 * Generated Date: 2011-05-13 14:54:41 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateObject_articleOptionsColumnById($Id, $Options) {
		
		$Id = ( int ) $Id;
		$Options = mysql_escape_string ( $Options );
		
		$query = "UPDATE `{$this->tableName}` SET `options` = '$Options' WHERE `id` = '$Id' ";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateObject_articleOptionsColumnById
	
	public function getAllObject_articleWoSomeCategoriesOrderByColumnWithLimit($CategoryIds, $Column = 'id', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		$Column = mysql_escape_string ( $Column );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		if (empty($CategoryIds)) {
			$CategoryCondition = '';
		} else {
			$CategoryIds = str_replace(',', ' AND `category_id` != ', $CategoryIds);
			$CategoryCondition = 'WHERE `category_id` != ' . $CategoryIds;
		}
		
		$query = "SELECT SQL_CALC_FOUND_ROWS `id`, `alias`, `intro_text`, `full_text`, `created_date`, `author_id`, `source_id`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` 
FROM `object_article` 
$CategoryCondition 
ORDER BY 	$Column $sorting  
LIMIT 		$start, $limit";
		
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
	} //End Function getAllObject_articleWoSomeCategoriesOrderByColumnWithLimit
	
	public function GetCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  op.`id` AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   oa.`category_id` IN ($CategoryIds) 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
ORDER BY  $Column $sorting 
LIMIT   $start, $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit
	
	
	public function GetListingCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
	    $query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list` 
FROM   `object_article` AS oa  
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
WHERE   oa.`category_id` IN ($CategoryIds) 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
GROUP BY oa.`id` 
ORDER BY  $Column $sorting 
LIMIT   $start, $limit ";
		
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
	} //GetListingCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit
	
	public function GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   oa.`category_id` IN ($CategoryIds) 
AND oa.`date_added` > '{$this->_2weeksEarlier}' 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
GROUP BY oa.`id` 
ORDER BY  $Column $sorting 
LIMIT   $start, $limit ";
		
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
	} //End Function GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit
	
	public function GetCleanObjectAndInfoAndArticleByKeywordOrderByColumnWithLimit($Keyword, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$Keyword = mysql_escape_string ( $Keyword );
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  op.`id` AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   (o.`title` LIKE '%$Keyword%' OR oa.`alias` LIKE '%$Keyword%' ) 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
ORDER BY  $Column $sorting 
LIMIT   $start, $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleByKeywordOrderByColumnWithLimit
	

	public function GetCleanObjectAndInfoAndArticleBySubCategoryIdsOrderByColumnWithLimit($SubCategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$SubCategoryIds = mysql_escape_string ( $SubCategoryIds );
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   o.`category_id` IN ($SubCategoryIds) 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleBySubCategoryIdsOrderByColumnWithLimit
	

	public function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$featureList = mysql_escape_string ( $featureList );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   oa.`category_id` IN ($CategoryIds) 
$featureCondition
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
GROUP BY oa.`id` 
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit
	
	public function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$featureList = mysql_escape_string ( $featureList );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa $forceIndex
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
Left JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   oa.`category_id` IN ($CategoryIds) 
$featureCondition 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes'
GROUP BY oa.`id`
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleBySubCategoryIdsAndNotFeatureOrderByColumnWithLimit($featureList, $SubCategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$featureList = mysql_escape_string ( $featureList );
		$SubCategoryIds = mysql_escape_string ( $SubCategoryIds );
		
		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE   o.`category_id` IN ($SubCategoryIds) 
$featureCondition 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes'  
ORDER BY  $Column $sorting 
LIMIT   $start,$limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleBySubCategoryIdsAndNotFeatureOrderByColumnWithLimit
	

	public function GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit($IdsList, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$IdsList = mysql_escape_string ( $IdsList );
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		if ($limit == 1) {
			$forceIndex = '';
		}
		
		 $query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`id` AS `object_info_id`, oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE  oa.`id` IN ($IdsList)
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes'  
GROUP BY oa.`id` 
ORDER BY  $Column $sorting
LIMIT   $start , $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit
	
	
	public function GetHPCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit($IdsList, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$IdsList = mysql_escape_string ( $IdsList );
		
		 $query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE oa.`id` IN ($IdsList) AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
AND oa.`date_added` > '{$this->_2weeksEarlier}' 
GROUP BY oa.`id` 
ORDER BY  $Column $sorting
LIMIT   $start , $limit ";
		
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
	} //End Function GetHPCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit
	
	
	public function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$featureList = mysql_escape_string ( $featureList );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
Left JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE oa.`category_id` IN ($CategoryIds) 
$featureCondition 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
AND oa.`date_added` > '{$this->_2weeksEarlier}' 
GROUP BY oa.`id`
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit
	
	
	public function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$featureList = mysql_escape_string ( $featureList );
		$CategoryIds = mysql_escape_string ( $CategoryIds );
		
		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` 
WHERE oa.`category_id` IN ($CategoryIds) 
$featureCondition 
AND oa.`date_added` > '{$this->_2weeksEarlier}' 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
GROUP BY oa.`id` 
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleByIdsListWoPhotoOrderByColumnWithLimit($IdsList, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$IdsList = mysql_escape_string ( $IdsList );
		
		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}
		
		if ($limit == 1) {
			$forceIndex = '';
		}
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`id` AS `object_info_id`, oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
WHERE  oa.`id` IN ($IdsList)
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes'  
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetCleanObjectAndInfoAndArticleByIdsListWoPhotoOrderByColumnWithLimit
	
	public function GetLatestCleanObjectAndInfoAndArticleWoPhotoOrderByColumnWithLimit($start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx)
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
WHERE  oa.`date_added` > '{$this->_2weeksEarlier}' 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes'  
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetLatestCleanObjectAndInfoAndArticleWoPhotoOrderByColumnWithLimit
	
	public function GetLatestObjectAndrticleAndInfoByAuthor_idOrderByColumnWithLimit ($Author_id, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Author_id = ( int ) ( $Author_id );
		$sorting = mysql_escape_string ( $sorting );
		$Column = mysql_escape_string ( $Column );
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
WHERE  oa.`date_added` > '{$this->_4weeksEarlier}' 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
AND oa.`author_id` = $Author_id 
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetLatestObjectAndrticleAndInfoByAuthor_idOrderByColumnWithLimit
	
	public function GetLatestObjectAndrticleAndInfoOrderByColumnWithLimit ($start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Author_id = ( int ) ( $Author_id );
		$sorting = mysql_escape_string ( $sorting );
		$Column = mysql_escape_string ( $Column );
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
WHERE  oa.`date_added` > '{$this->_4weeksEarlier}' 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
AND oa.`author_id` = $Author_id 
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //End Function GetLatestObjectAndrticleAndInfoOrderByColumnWithLimit

	public function GetListingCleanObjectAndInfoAndArticleByUserIdsOrderByColumnWithLimit($UserIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$Column = mysql_escape_string ( $Column );
		$sorting = mysql_escape_string ( $sorting );
		$UserIds = mysql_escape_string ( $UserIds );
		
		$query = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
WHERE  o.`original_author` = '$UserIds' 
AND oa.`published` = 'Yes' 
AND oa.`approved` = 'Yes' 
ORDER BY  $Column $sorting 
LIMIT   $start , $limit ";
		
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
	} //GetListingCleanObjectAndInfoAndArticleByUserIdsOrderByColumnWithLimit
	
		
	/**
	 * This Method is Script Generated 
	 * insertIntoObject_article
	 * Generated Date: 2010-04-13 20:25:55 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoObject_article_special($Id, $Object_id, $Object_article_id) {
		
		$Id = ( int ) $Id;
		$Object_id = ( int ) $Object_id;
		$Object_article_id = ( int ) $Object_article_id;
		
		$query = "INSERT INTO `object_article_special` (`id` ,`object_id` ,`object_article_id`) VALUES (NULL, '$Object_id', '$Object_article_id') ON DUPLICATE KEY UPDATE `object_id`='$Object_id' ";

		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return $result;
	} //End Function insertIntoObject_article_special
	

	/**
	 * This Method is Script Generated 
	 * deleteFromObject_articleById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromObject_article_specialByObject_id($Object_id) {
		
		$Object_id = ( int ) $Object_id;
				
		$query = "DELETE FROM object_article_special WHERE object_id = '$Object_id'";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromObject_article_specialById
	
	 public function GetAllCleanObject_articleIdAndAliasAndDate_addedOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
    
    $start = ( int ) ($start);
    $limit = ( int ) ($limit);
    $sorting = mysql_escape_string ( $sorting );
    
    $query = "SELECT   SQL_CALC_FOUND_ROWS `id`, `alias`, `date_added` 
              FROM `object_article` WHERE `published` = 'Yes' AND `approved` = 'Yes'  
              ORDER BY `id` LIMIT $start , $limit ";
    
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
  } //End Function GetAllCleanObject_articleIdAndAliasAndDate_addedOrderByIdWithLimit
	
}