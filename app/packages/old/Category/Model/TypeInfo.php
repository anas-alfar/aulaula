<?php

class Category_Model_TypeInfo extends Aula_Model_DbTable {
	public $Id = NULL;
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $directCatCount = 0;
	public $indirectCatCount = 0;
	public $comments = '';
	public $options = '';
	
	public function __construct() {
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `category_type_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `direct_cat_count`, `indirect_cat_count`, `date_added`, `comments`, `options` ';
		$this -> _name = 'category_type_info';
		parent::__construct();
	}

	/**
	 * This Method is Script Generated
	 * insertIntoCategory_type_info
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function insertIntoCategory_type_info($Id, $Category_type_id, $Comments = '', $Options = '', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00', $Direct_cat_count = '0', $Indirect_cat_count = '0') {

		$Id = (int)$Id;
		$Category_type_id = (int)$Category_type_id;
		$Locked_by = (int)$Locked_by;
		$Locked_time = mysql_escape_string($Locked_time);
		$Modified_by = (int)$Modified_by;
		$Modified_time = mysql_escape_string($Modified_time);
		$Direct_cat_count = (int)$Direct_cat_count;
		$Indirect_cat_count = (int)$Indirect_cat_count;
		$Comments = mysql_escape_string($Comments);
		$Options = mysql_escape_string($Options);

		$query = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Category_type_id', '$Locked_by', '$Locked_time', '$Modified_by', '$Modified_time', '$Direct_cat_count', '$Indirect_cat_count', '$Comments', '$Options') ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		$query = 'SELECT last_insert_id()';

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return $result;
	}//End Function insertIntoCategory_type_info

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoById($Id) {

		$Id = (int)$Id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoById

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoById($Id, $Category_type_id, $Comments = '', $Options = '', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00', $Direct_cat_count = '0', $Indirect_cat_count = '0') {

		$Id = (int)$Id;
		$Category_type_id = (int)$Category_type_id;
		$Locked_by = (int)$Locked_by;
		$Locked_time = mysql_escape_string($Locked_time);
		$Modified_by = (int)$Modified_by;
		$Modified_time = mysql_escape_string($Modified_time);
		$Direct_cat_count = (int)$Direct_cat_count;
		$Indirect_cat_count = (int)$Indirect_cat_count;
		$Comments = mysql_escape_string($Comments);
		$Options = mysql_escape_string($Options);

		$query = "UPDATE `{$this->tableName}` SET  `category_type_id` = '$Category_type_id', `locked_by` = '$Locked_by', `locked_time` = '$Locked_time', `modified_by` = '$Modified_by', `modified_time` = '$Modified_time', `direct_cat_count` = '$Direct_cat_count', `indirect_cat_count` = '$Indirect_cat_count', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderById($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY id $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY id $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategory_type_infoDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategory_type_infoDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {

		$Id = (int)$Id;
		$start = (int)($start);
		$limit = (int)($limit);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE id = '$Id' LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function getCategory_type_infoDetailsByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategory_type_infoDetailsById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategory_type_infoDetailsById($Id) {

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function getCategory_type_infoDetailsById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderById($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `id` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `id` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByCategory_type_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByCategory_type_id($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Category_type_id` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByCategory_type_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByCategory_type_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByCategory_type_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Category_type_id` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByCategory_type_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByCategory_type_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByCategory_type_id($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `category_type_id` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByCategory_type_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByCategory_type_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByCategory_type_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `category_type_id` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByCategory_type_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByCategory_type_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByCategory_type_idOrderById($Category_type_id, $sorting = 'DESC') {

		$Category_type_id = (int)$Category_type_id;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `category_type_id` = '$Category_type_id' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByCategory_type_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByCategory_type_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByCategory_type_idOrderByIdWithLimit($Category_type_id, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Category_type_id = (int)$Category_type_id;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `category_type_id` = '$Category_type_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByCategory_type_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByCategory_type_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByCategory_type_id($Category_type_id) {

		$Category_type_id = (int)$Category_type_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `category_type_id` = '$Category_type_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByCategory_type_id

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoCategory_type_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoCategory_type_idColumnById($Id, $Category_type_id) {

		$Id = (int)$Id;
		$Category_type_id = (int)$Category_type_id;

		$query = "UPDATE `category_type_info` SET `category_type_id` = '$Category_type_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoCategory_type_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByLocked_by($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_by` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByLocked_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByLocked_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_by` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByLocked_by($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locked_by` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByLocked_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByLocked_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locked_by` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByLocked_byOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByLocked_byOrderById($Locked_by = '0', $sorting = 'DESC') {

		$Locked_by = (int)$Locked_by;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByLocked_byOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByLocked_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByLocked_byOrderByIdWithLimit($Locked_by = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Locked_by = (int)$Locked_by;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByLocked_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByLocked_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByLocked_by($Locked_by = '0') {

		$Locked_by = (int)$Locked_by;

		$query = "DELETE FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByLocked_by

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoLocked_byColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoLocked_byColumnById($Id, $Locked_by = '0') {

		$Id = (int)$Id;
		$Locked_by = (int)$Locked_by;

		$query = "UPDATE `category_type_info` SET `locked_by` = '$Locked_by' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoLocked_byColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByLocked_time($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_time` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByLocked_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByLocked_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Locked_time` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByLocked_time($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `locked_time` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByLocked_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByLocked_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `locked_time` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByLocked_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByLocked_timeOrderById($Locked_time = '0000-00-00 00:00:00', $sorting = 'DESC') {

		$Locked_time = mysql_escape_string($Locked_time);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByLocked_timeOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByLocked_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByLocked_timeOrderByIdWithLimit($Locked_time = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Locked_time = mysql_escape_string($Locked_time);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByLocked_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByLocked_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByLocked_time($Locked_time = '0000-00-00 00:00:00') {

		$Locked_time = mysql_escape_string($Locked_time);

		$query = "DELETE FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByLocked_time

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoLocked_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoLocked_timeColumnById($Id, $Locked_time = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Locked_time = mysql_escape_string($Locked_time);

		$query = "UPDATE `category_type_info` SET `locked_time` = '$Locked_time' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoLocked_timeColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByModified_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByModified_by($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_by` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByModified_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByModified_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_by` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByModified_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByModified_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByModified_by($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `modified_by` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByModified_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByModified_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `modified_by` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByModified_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByModified_byOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByModified_byOrderById($Modified_by = '0', $sorting = 'DESC') {

		$Modified_by = (int)$Modified_by;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByModified_byOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByModified_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByModified_byOrderByIdWithLimit($Modified_by = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Modified_by = (int)$Modified_by;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByModified_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByModified_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByModified_by($Modified_by = '0') {

		$Modified_by = (int)$Modified_by;

		$query = "DELETE FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByModified_by

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoModified_byColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoModified_byColumnById($Id, $Modified_by = '0') {

		$Id = (int)$Id;
		$Modified_by = (int)$Modified_by;

		$query = "UPDATE `category_type_info` SET `modified_by` = '$Modified_by' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoModified_byColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByModified_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByModified_time($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_time` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByModified_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByModified_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Modified_time` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByModified_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByModified_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByModified_time($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `modified_time` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByModified_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByModified_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `modified_time` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByModified_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByModified_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByModified_timeOrderById($Modified_time = '0000-00-00 00:00:00', $sorting = 'DESC') {

		$Modified_time = mysql_escape_string($Modified_time);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByModified_timeOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByModified_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByModified_timeOrderByIdWithLimit($Modified_time = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Modified_time = mysql_escape_string($Modified_time);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByModified_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByModified_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByModified_time($Modified_time = '0000-00-00 00:00:00') {

		$Modified_time = mysql_escape_string($Modified_time);

		$query = "DELETE FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByModified_time

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoModified_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoModified_timeColumnById($Id, $Modified_time = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Modified_time = mysql_escape_string($Modified_time);

		$query = "UPDATE `category_type_info` SET `modified_time` = '$Modified_time' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoModified_timeColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByDirect_cat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByDirect_cat_count($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Direct_cat_count` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByDirect_cat_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByDirect_cat_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByDirect_cat_countWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Direct_cat_count` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByDirect_cat_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByDirect_cat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByDirect_cat_count($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `direct_cat_count` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByDirect_cat_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByDirect_cat_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByDirect_cat_countWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `direct_cat_count` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByDirect_cat_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByDirect_cat_countOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByDirect_cat_countOrderById($Direct_cat_count = '0', $sorting = 'DESC') {

		$Direct_cat_count = (int)$Direct_cat_count;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `direct_cat_count` = '$Direct_cat_count' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByDirect_cat_countOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByDirect_cat_countOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByDirect_cat_countOrderByIdWithLimit($Direct_cat_count = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Direct_cat_count = (int)$Direct_cat_count;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `direct_cat_count` = '$Direct_cat_count' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByDirect_cat_countOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByDirect_cat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByDirect_cat_count($Direct_cat_count = '0') {

		$Direct_cat_count = (int)$Direct_cat_count;

		$query = "DELETE FROM `{$this->tableName}` WHERE `direct_cat_count` = '$Direct_cat_count' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByDirect_cat_count

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoDirect_cat_countColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoDirect_cat_countColumnById($Id, $Direct_cat_count = '0') {

		$Id = (int)$Id;
		$Direct_cat_count = (int)$Direct_cat_count;

		$query = "UPDATE `category_type_info` SET `direct_cat_count` = '$Direct_cat_count' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoDirect_cat_countColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByIndirect_cat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByIndirect_cat_count($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Indirect_cat_count` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByIndirect_cat_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByIndirect_cat_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByIndirect_cat_countWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Indirect_cat_count` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByIndirect_cat_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByIndirect_cat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByIndirect_cat_count($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `indirect_cat_count` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByIndirect_cat_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByIndirect_cat_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByIndirect_cat_countWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `indirect_cat_count` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByIndirect_cat_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIndirect_cat_countOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIndirect_cat_countOrderById($Indirect_cat_count = '0', $sorting = 'DESC') {

		$Indirect_cat_count = (int)$Indirect_cat_count;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `indirect_cat_count` = '$Indirect_cat_count' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIndirect_cat_countOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIndirect_cat_countOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIndirect_cat_countOrderByIdWithLimit($Indirect_cat_count = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Indirect_cat_count = (int)$Indirect_cat_count;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `indirect_cat_count` = '$Indirect_cat_count' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIndirect_cat_countOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByIndirect_cat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByIndirect_cat_count($Indirect_cat_count = '0') {

		$Indirect_cat_count = (int)$Indirect_cat_count;

		$query = "DELETE FROM `{$this->tableName}` WHERE `indirect_cat_count` = '$Indirect_cat_count' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByIndirect_cat_count

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoIndirect_cat_countColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoIndirect_cat_countColumnById($Id, $Indirect_cat_count = '0') {

		$Id = (int)$Id;
		$Indirect_cat_count = (int)$Indirect_cat_count;

		$query = "UPDATE `category_type_info` SET `indirect_cat_count` = '$Indirect_cat_count' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoIndirect_cat_countColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByDate_added($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Date_added` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByDate_addedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Date_added` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByDate_added($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `date_added` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByDate_addedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `date_added` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {

		$Date_added = mysql_escape_string($Date_added);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByDate_addedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Date_added = mysql_escape_string($Date_added);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByDate_added($Date_added = 'CURRENT_TIMESTAMP') {

		$Date_added = mysql_escape_string($Date_added);

		$query = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByDate_added

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {

		$Id = (int)$Id;
		$Date_added = mysql_escape_string($Date_added);

		$query = "UPDATE `category_type_info` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoDate_addedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByComments
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByComments($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Comments` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByComments

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByCommentsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Comments` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByComments($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `comments` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByComments

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByCommentsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `comments` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByCommentsOrderById($Comments, $sorting = 'DESC') {

		$Comments = mysql_escape_string($Comments);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `comments` = '$Comments' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByCommentsOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByCommentsOrderByIdWithLimit($Comments, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Comments = mysql_escape_string($Comments);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `comments` = '$Comments' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByComments
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByComments($Comments) {

		$Comments = mysql_escape_string($Comments);

		$query = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByComments

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoCommentsColumnById($Id, $Comments) {

		$Id = (int)$Id;
		$Comments = mysql_escape_string($Comments);

		$query = "UPDATE `category_type_info` SET `comments` = '$Comments' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoCommentsColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByOptions($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Options` $sorting ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByOptions

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoOrderByOptionsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Options` $sorting LIMIT $start,$limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByOptions($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `options` $sorting  ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByOptions

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByIdOrderByOptionsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `options` $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByIdOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByOptionsOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByOptionsOrderById($Options, $sorting = 'DESC') {

		$Options = mysql_escape_string($Options);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `options` = '$Options' ORDER BY `id` ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByOptionsOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_type_infoByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_type_infoByOptionsOrderByIdWithLimit($Options, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Options = mysql_escape_string($Options);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `options` = '$Options' ORDER BY `id`  $sorting LIMIT $start , $limit ";

		$result = $this -> dbLink -> fetch($query);

		if (!$result) {
			return false;
		}

		$query = "SELECT FOUND_ROWS()";
		$this -> _totalRecordsFound = $this -> dbLink -> fetch($query);

		if (is_null($this -> _totalRecordsFound) || !is_array($this -> _totalRecordsFound) || !isset($this -> _totalRecordsFound[0][0])) {
			$this -> _totalRecordsFound = 0;
		} else {
			$this -> _totalRecordsFound = $this -> _totalRecordsFound[0][0];
		}

		return $result;
	}//End Function GetAllCategory_type_infoByOptionsOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_type_infoByOptions
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_type_infoByOptions($Options) {

		$Options = mysql_escape_string($Options);

		$query = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_type_infoByOptions

	/**
	 * This Method is Script Generated
	 * updateCategory_type_infoOptionsColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_type_infoOptionsColumnById($Id, $Options) {

		$Id = (int)$Id;
		$Options = mysql_escape_string($Options);

		$query = "UPDATE `category_type_info` SET `options` = '$Options' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_type_infoOptionsColumnById

}
