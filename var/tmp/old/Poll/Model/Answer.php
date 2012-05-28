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
 * @name Poll_Model_Answer
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Poll_Model_Answer extends Aula_Controller_Action {

	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tableName = 'poll_answer';
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
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->insertColumnsList = "`id`, `poll_id`, `title`, `label`, `votes_count`, `published`, `approved`, `order`, `author_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `comments`, `options`"; 
		$this -> _selectColumnsList = '`id`, `poll_id`, `title`, `label`, `votes_count`, `published`, `approved`, `order`, `author_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options`'; 
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoPoll_answer
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoPoll_answer($Id, $Poll_id = '0', $Title = '', $Label = '', $Votes_count = '0', $Published = 'No', $Approved = 'No', $Order = '0', $Author_id = '0', $Comments = '', $Options = '', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {
		
		$Id = (int) $Id;
		$Poll_id = (int) $Poll_id;
		$Title =  mysql_escape_string($Title);
		$Label =  mysql_escape_string($Label);
		$Votes_count = (int) $Votes_count;
		$Published =  mysql_escape_string($Published);
		$Approved =  mysql_escape_string($Approved);
		$Order = (int) $Order;
		$Author_id = (int) $Author_id;
		$Locked_by = (int) $Locked_by;
		$Locked_time =  mysql_escape_string($Locked_time);
		$Modified_by = (int) $Modified_by;
		$Modified_time =  mysql_escape_string($Modified_time);
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);

		$query  = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Poll_id', '$Title', '$Label', '$Votes_count', '$Published', '$Approved', '$Order', '$Author_id', '$Locked_by', '$Locked_time', '$Modified_by', '$Modified_time', '$Comments', '$Options') ";
		
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
	}//End Function insertIntoPoll_answer

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerById ($Id){
	
		$Id = (int) $Id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerById

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerById($Id, $Poll_id = '0', $Title = '', $Label = '', $Votes_count = '0', $Published = 'No', $Approved = 'No', $Order = '0', $Author_id = '0', $Comments = '', $Options = '', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {
		
		$Id = (int) $Id;
		$Poll_id = (int) $Poll_id;
		$Title =  mysql_escape_string($Title);
		$Label =  mysql_escape_string($Label);
		$Votes_count = (int) $Votes_count;
		$Published =  mysql_escape_string($Published);
		$Approved =  mysql_escape_string($Approved);
		$Order = (int) $Order;
		$Author_id = (int) $Author_id;
		$Locked_by = (int) $Locked_by;
		$Locked_time =  mysql_escape_string($Locked_time);
		$Modified_by = (int) $Modified_by;
		$Modified_time =  mysql_escape_string($Modified_time);
		$Comments =  mysql_escape_string($Comments);
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET  `poll_id` = '$Poll_id', `title` = '$Title', `label` = '$Label', `votes_count` = '$Votes_count', `published` = '$Published', `approved` = '$Approved', `order` = '$Order', `author_id` = '$Author_id', `locked_by` = '$Locked_by', `locked_time` = '$Locked_time', `modified_by` = '$Modified_by', `modified_time` = '$Modified_time', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderById ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByIdWithLimit ($start = 0, $limit = 10, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getPoll_answerDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPoll_answerDetailsByIdWithLimit ($Id, $start = 0, $limit = 10){		
		
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
	}//End Function getPoll_answerDetailsByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * getPoll_answerDetailsById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getPoll_answerDetailsById ($Id){		
		
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
	}//End Function getPoll_answerDetailsById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderById ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByIdWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByPoll_id
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByPoll_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Poll_id` $sorting ";
	
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
	}//End Function GetAllPoll_answerOrderByPoll_id

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByPoll_idWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByPoll_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Poll_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPoll_answerOrderByPoll_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByPoll_id
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByPoll_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `poll_id` $sorting  ";
	
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
	}//End Function GetAllPoll_answerByIdOrderByPoll_id

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByPoll_idWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByPoll_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `poll_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPoll_answerByIdOrderByPoll_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByPoll_idOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByPoll_idOrderById ($Poll_id  = '0', $sorting = 'DESC'){		
		
		$Poll_id = (int) $Poll_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `poll_id` = '$Poll_id' ORDER BY `id` ";
	
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
	}//End Function GetAllPoll_answerByPoll_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByPoll_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByPoll_idOrderByIdWithLimit ($Poll_id  = '0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Poll_id = (int) $Poll_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `poll_id` = '$Poll_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPoll_answerByPoll_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByPoll_id
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByPoll_id ($Poll_id  = '0'){
	
		$Poll_id = (int) $Poll_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `poll_id` = '$Poll_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByPoll_id

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerPoll_idColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerPoll_idColumnById ($Id, $Poll_id  = '0'){
	
		$Id = (int) $Id;
		$Poll_id = (int) $Poll_id;
	
		$query  = "UPDATE `poll_answer` SET `poll_id` = '$Poll_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerPoll_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByTitle
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByTitle ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByTitle

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByTitleWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByTitleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByTitle
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByTitle ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByTitle

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByTitleWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByTitleWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByTitleOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByTitleOrderById ($Title  = '', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByTitleOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByTitleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByTitleOrderByIdWithLimit ($Title  = '', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByTitleOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByTitle
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByTitle ($Title  = ''){
	
		$Title =  mysql_escape_string($Title);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `title` = '$Title' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByTitle

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerTitleColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerTitleColumnById ($Id, $Title  = ''){
	
		$Id = (int) $Id;
		$Title =  mysql_escape_string($Title);
	
		$query  = "UPDATE `poll_answer` SET `title` = '$Title' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerTitleColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByLabel
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByLabel ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Label` $sorting ";
	
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
	}//End Function GetAllPoll_answerOrderByLabel

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByLabelWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByLabelWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Label` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPoll_answerOrderByLabelWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByLabel
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByLabel ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `label` $sorting  ";
	
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
	}//End Function GetAllPoll_answerByIdOrderByLabel

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByLabelWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByLabelWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `label` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPoll_answerByIdOrderByLabelWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByLabelOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByLabelOrderById ($Label , $sorting = 'DESC'){		
		
		$Label =  mysql_escape_string($Label);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `label` = '$Label' ORDER BY `id` ";
	
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
	}//End Function GetAllPoll_answerByLabelOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByLabelOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByLabelOrderByIdWithLimit ($Label , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Label =  mysql_escape_string($Label);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `label` = '$Label' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPoll_answerByLabelOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByLabel
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByLabel ($Label ){
	
		$Label =  mysql_escape_string($Label);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `label` = '$Label' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByLabel

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerLabelColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerLabelColumnById ($Id, $Label ){
	
		$Id = (int) $Id;
		$Label =  mysql_escape_string($Label);
	
		$query  = "UPDATE `poll_answer` SET `label` = '$Label' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerLabelColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByVotes_count
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByVotes_count ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Votes_count` $sorting ";
	
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
	}//End Function GetAllPoll_answerOrderByVotes_count

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByVotes_countWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByVotes_countWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Votes_count` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPoll_answerOrderByVotes_countWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByVotes_count
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByVotes_count ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `votes_count` $sorting  ";
	
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
	}//End Function GetAllPoll_answerByIdOrderByVotes_count

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByVotes_countWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByVotes_countWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `votes_count` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPoll_answerByIdOrderByVotes_countWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByVotes_countOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByVotes_countOrderById ($Votes_count  = '0', $sorting = 'DESC'){		
		
		$Votes_count = (int) $Votes_count;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `votes_count` = '$Votes_count' ORDER BY `id` ";
	
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
	}//End Function GetAllPoll_answerByVotes_countOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByVotes_countOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByVotes_countOrderByIdWithLimit ($Votes_count  = '0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Votes_count = (int) $Votes_count;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `votes_count` = '$Votes_count' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPoll_answerByVotes_countOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByVotes_count
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByVotes_count ($Votes_count  = '0'){
	
		$Votes_count = (int) $Votes_count;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `votes_count` = '$Votes_count' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByVotes_count

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerVotes_countColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerVotes_countColumnById ($Id, $Votes_count  = '0'){
	
		$Id = (int) $Id;
		$Votes_count = (int) $Votes_count;
	
		$query  = "UPDATE `poll_answer` SET `votes_count` = '$Votes_count' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerVotes_countColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByPublished
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByPublished ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByPublished

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByPublishedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByPublished
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByPublished ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByPublished

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByPublishedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByPublishedOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByPublishedOrderById ($Published  = 'No', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByPublishedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByPublishedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByPublishedOrderByIdWithLimit ($Published  = 'No', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByPublishedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByPublished
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByPublished ($Published  = 'No'){
	
		$Published =  mysql_escape_string($Published);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `published` = '$Published' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByPublished

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerPublishedColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerPublishedColumnById ($Id, $Published  = 'No'){
	
		$Id = (int) $Id;
		$Published =  mysql_escape_string($Published);
	
		$query  = "UPDATE `poll_answer` SET `published` = '$Published' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerPublishedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByApproved
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByApproved ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByApproved

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByApprovedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByApproved
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByApproved ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByApproved

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByApprovedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByApprovedOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByApprovedOrderById ($Approved  = 'No', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByApprovedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByApprovedOrderByIdWithLimit ($Approved  = 'No', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByApprovedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByApproved
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByApproved ($Approved  = 'No'){
	
		$Approved =  mysql_escape_string($Approved);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByApproved

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerApprovedColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerApprovedColumnById ($Id, $Approved  = 'No'){
	
		$Id = (int) $Id;
		$Approved =  mysql_escape_string($Approved);
	
		$query  = "UPDATE `poll_answer` SET `approved` = '$Approved' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerApprovedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByOrder
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByOrder ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByOrder

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByOrderWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByOrderWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByOrder
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByOrder ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByOrder

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByOrderWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByOrderWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByOrderOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByOrderOrderById ($Order  = '0', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByOrderOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByOrderOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByOrderOrderByIdWithLimit ($Order  = '0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByOrderOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByOrder
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByOrder ($Order  = '0'){
	
		$Order = (int) $Order;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `order` = '$Order' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByOrder

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerOrderColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerOrderColumnById ($Id, $Order  = '0'){
	
		$Id = (int) $Id;
		$Order = (int) $Order;
	
		$query  = "UPDATE `poll_answer` SET `order` = '$Order' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerOrderColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByAuthor_id
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByAuthor_id ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Author_id` $sorting ";
	
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
	}//End Function GetAllPoll_answerOrderByAuthor_id

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByAuthor_idWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Author_id` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPoll_answerOrderByAuthor_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByAuthor_id
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByAuthor_id ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `author_id` $sorting  ";
	
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
	}//End Function GetAllPoll_answerByIdOrderByAuthor_id

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByAuthor_idWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `author_id` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPoll_answerByIdOrderByAuthor_idWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByAuthor_idOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByAuthor_idOrderById ($Author_id , $sorting = 'DESC'){		
		
		$Author_id = (int) $Author_id;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ORDER BY `id` ";
	
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
	}//End Function GetAllPoll_answerByAuthor_idOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByAuthor_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByAuthor_idOrderByIdWithLimit ($Author_id , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Author_id = (int) $Author_id;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPoll_answerByAuthor_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByAuthor_id
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByAuthor_id ($Author_id ){
	
		$Author_id = (int) $Author_id;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByAuthor_id

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerAuthor_idColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerAuthor_idColumnById ($Id, $Author_id ){
	
		$Id = (int) $Id;
		$Author_id = (int) $Author_id;
	
		$query  = "UPDATE `poll_answer` SET `author_id` = '$Author_id' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerAuthor_idColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByLocked_by
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByLocked_by ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByLocked_by

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByLocked_byWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByLocked_by
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByLocked_by ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByLocked_by

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByLocked_byWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByLocked_byOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByLocked_byOrderById ($Locked_by  = '0', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByLocked_byOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByLocked_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByLocked_byOrderByIdWithLimit ($Locked_by  = '0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByLocked_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByLocked_by
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByLocked_by ($Locked_by  = '0'){
	
		$Locked_by = (int) $Locked_by;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByLocked_by

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerLocked_byColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerLocked_byColumnById ($Id, $Locked_by  = '0'){
	
		$Id = (int) $Id;
		$Locked_by = (int) $Locked_by;
	
		$query  = "UPDATE `poll_answer` SET `locked_by` = '$Locked_by' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerLocked_byColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByLocked_time
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByLocked_time ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByLocked_time

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByLocked_timeWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByLocked_time
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByLocked_time ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByLocked_time

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByLocked_timeWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByLocked_timeOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByLocked_timeOrderById ($Locked_time  = '0000-00-00 00:00:00', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByLocked_timeOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByLocked_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByLocked_timeOrderByIdWithLimit ($Locked_time  = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByLocked_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByLocked_time
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByLocked_time ($Locked_time  = '0000-00-00 00:00:00'){
	
		$Locked_time =  mysql_escape_string($Locked_time);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByLocked_time

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerLocked_timeColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerLocked_timeColumnById ($Id, $Locked_time  = '0000-00-00 00:00:00'){
	
		$Id = (int) $Id;
		$Locked_time =  mysql_escape_string($Locked_time);
	
		$query  = "UPDATE `poll_answer` SET `locked_time` = '$Locked_time' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerLocked_timeColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByModified_by
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByModified_by ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_by` $sorting ";
	
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
	}//End Function GetAllPoll_answerOrderByModified_by

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByModified_byWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_by` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPoll_answerOrderByModified_byWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByModified_by
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByModified_by ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `modified_by` $sorting  ";
	
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
	}//End Function GetAllPoll_answerByIdOrderByModified_by

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByModified_byWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `modified_by` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPoll_answerByIdOrderByModified_byWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByModified_byOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByModified_byOrderById ($Modified_by  = '0', $sorting = 'DESC'){		
		
		$Modified_by = (int) $Modified_by;
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ORDER BY `id` ";
	
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
	}//End Function GetAllPoll_answerByModified_byOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByModified_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByModified_byOrderByIdWithLimit ($Modified_by  = '0', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Modified_by = (int) $Modified_by;
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPoll_answerByModified_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByModified_by
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByModified_by ($Modified_by  = '0'){
	
		$Modified_by = (int) $Modified_by;
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByModified_by

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerModified_byColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerModified_byColumnById ($Id, $Modified_by  = '0'){
	
		$Id = (int) $Id;
		$Modified_by = (int) $Modified_by;
	
		$query  = "UPDATE `poll_answer` SET `modified_by` = '$Modified_by' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerModified_byColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByModified_time
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByModified_time ($sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_time` $sorting ";
	
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
	}//End Function GetAllPoll_answerOrderByModified_time

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByModified_timeWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_time` $sorting LIMIT $start,$limit ";
	
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
	}//End Function GetAllPoll_answerOrderByModified_timeWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByModified_time
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByModified_time ($Id, $sorting = 'DESC'){
		
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `modified_time` $sorting  ";
	
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
	}//End Function GetAllPoll_answerByIdOrderByModified_time

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByModified_timeWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$Id = (int) $Id;
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `modified_time` $sorting LIMIT $start , $limit ";
			
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
	}//End Function GetAllPoll_answerByIdOrderByModified_timeWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByModified_timeOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByModified_timeOrderById ($Modified_time  = '0000-00-00 00:00:00', $sorting = 'DESC'){		
		
		$Modified_time =  mysql_escape_string($Modified_time);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ORDER BY `id` ";
	
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
	}//End Function GetAllPoll_answerByModified_timeOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByModified_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByModified_timeOrderByIdWithLimit ($Modified_time  = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
		$Modified_time =  mysql_escape_string($Modified_time);
		$start = (int) ($start);
		$limit = (int) ($limit);
		$sorting = mysql_escape_string($sorting);
		
		$query  = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ORDER BY `id`  $sorting LIMIT $start , $limit "; 
	
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
	}//End Function GetAllPoll_answerByModified_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByModified_time
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByModified_time ($Modified_time  = '0000-00-00 00:00:00'){
	
		$Modified_time =  mysql_escape_string($Modified_time);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByModified_time

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerModified_timeColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerModified_timeColumnById ($Id, $Modified_time  = '0000-00-00 00:00:00'){
	
		$Id = (int) $Id;
		$Modified_time =  mysql_escape_string($Modified_time);
	
		$query  = "UPDATE `poll_answer` SET `modified_time` = '$Modified_time' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerModified_timeColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByDate_added
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByDate_added ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByDate_addedWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByDate_added
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByDate_added ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByDate_added

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByDate_addedWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByDate_addedOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByDate_addedOrderById ($Date_added  = 'CURRENT_TIMESTAMP', $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByDate_addedOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByDate_addedOrderByIdWithLimit ($Date_added  = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByDate_added
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByDate_added ($Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByDate_added

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerDate_addedColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerDate_addedColumnById ($Id, $Date_added  = 'CURRENT_TIMESTAMP'){
	
		$Id = (int) $Id;
		$Date_added =  mysql_escape_string($Date_added);
	
		$query  = "UPDATE `poll_answer` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerDate_addedColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByComments
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByComments ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByCommentsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByComments
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByComments ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByComments

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByCommentsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByCommentsOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByCommentsOrderById ($Comments , $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByCommentsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByCommentsOrderByIdWithLimit ($Comments , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByComments
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByComments ($Comments ){
	
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByComments

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerCommentsColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerCommentsColumnById ($Id, $Comments ){
	
		$Id = (int) $Id;
		$Comments =  mysql_escape_string($Comments);
	
		$query  = "UPDATE `poll_answer` SET `comments` = '$Comments' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerCommentsColumnById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByOptions
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByOptions ($sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerOrderByOptionsWithLimit ($sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByOptions
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByOptions ($Id, $sorting = 'DESC'){
		
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
	}//End Function GetAllPoll_answerByIdOrderByOptions

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByIdOrderByOptionsWithLimit ($Id, $sorting = 'DESC', $start = 0, $limit = 10){
		
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
	}//End Function GetAllPoll_answerByIdOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByOptionsOrderById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByOptionsOrderById ($Options , $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByOptionsOrderById

	/**
	 * This Method is Script Generated 
	 * GetAllPoll_answerByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllPoll_answerByOptionsOrderByIdWithLimit ($Options , $start = 0, $limit = 10, $sorting = 'DESC'){		
		
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
	}//End Function GetAllPoll_answerByOptionsOrderByIdWithLimit

	/**
	 * This Method is Script Generated 
	 * deleteFromPoll_answerByOptions
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromPoll_answerByOptions ($Options ){
	
		$Options =  mysql_escape_string($Options);
	
		$query  = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function deleteFromPoll_answerByOptions

	/**
	 * This Method is Script Generated 
	 * updatePoll_answerOptionsColumnById
	 * Generated Date: 2011-05-13 16:53:09 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updatePoll_answerOptionsColumnById ($Id, $Options ){
	
		$Id = (int) $Id;
		$Options =  mysql_escape_string($Options);
	
		$query  = "UPDATE `{$this->tableName}` SET `options` = '$Options' WHERE `id` = '$Id' ";
	
		$result = $this->dbLink->query($query);
	
		if(!$result){
			return false;
		}
	
		return true;
	}//End Function updatePoll_answerOptionsColumnById
}