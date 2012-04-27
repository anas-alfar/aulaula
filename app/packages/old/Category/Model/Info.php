<?php

class Category_Model_Info extends Aula_Model_DbTable {
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $subcatCount = 0;
	public $directObjectCount = 0;
	public $indirectObjectCount = 0;
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $pageTitle = '';
	public $metaTitle = '';
	public $metaKey = '';
	public $metaDesc = '';
	public $metaData = '';
	
	public function __construct() {
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `category_id`, `subcat_count`, `direct_object_count`, `indirect_object_count`, `page_title`, `meta_title`, `meta_key`, `meta_desc`, `meta_data`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		$this -> _name = 'category_info';
		parent::__construct();
	}

	/**
	 * This Method is Script Generated
	 * insertIntoCategory_info
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function insertIntoCategory_info($Id, $Category_id, $Subcat_count = '0', $Direct_object_count = '0', $Indirect_object_count = '0', $Page_title, $Meta_title, $Meta_key, $Meta_desc, $Meta_data, $Comments, $Options, $Publish_from = '0000-00-00 00:00:00', $Publish_to = '0000-00-00 00:00:00', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {

		$data = array('id' => NULL, 'category_id' => $Category_id, 'subcat_count' => $Subcat_count, 'direct_object_count' => $Direct_object_count, 'indirect_object_count' => $Indirect_object_count, 'page_title' => $Page_title, 'meta_title' => $Meta_title, 'meta_key' => $Meta_key, 'meta_desc' => $Meta_desc, 'meta_data' => $Meta_data, 'locked_by' => $Locked_by, 'locked_time' => $Locked_time, 'modified_by' => $Modified_by, 'modified_time' => $Modified_time, 'publish_from' => $Publish_from, 'publish_to' => $Publish_to, 'comments' => $Comments, 'options' => $Options);
		$lastID = $affectedRows = 0;
		$result = $this -> dbLink -> insert($this -> tableName, $data);
		$lastID = $this -> dbLink -> lastInsertId();

		if (is_int($lastID)) {
			return false;
		}

		return $lastID;
	}//End Function insertIntoCategory_info

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoById($Id) {

		$Id = (int)$Id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoById

	/**
	 * This Method is Script Generated
	 * updateCategory_infoById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoById($Id, $Category_id, $Subcat_count = '0', $Direct_object_count = '0', $Indirect_object_count = '0', $Page_title, $Meta_title, $Meta_key, $Meta_desc, $Meta_data, $Comments, $Options, $Publish_from = '0000-00-00 00:00:00', $Publish_to = '0000-00-00 00:00:00', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Category_id = (int)$Category_id;
		$Subcat_count = (int)$Subcat_count;
		$Direct_object_count = (int)$Direct_object_count;
		$Indirect_object_count = (int)$Indirect_object_count;
		$Page_title = mysql_escape_string($Page_title);
		$Meta_title = mysql_escape_string($Meta_title);
		$Meta_key = mysql_escape_string($Meta_key);
		$Meta_desc = mysql_escape_string($Meta_desc);
		$Meta_data = mysql_escape_string($Meta_data);
		$Locked_by = (int)$Locked_by;
		$Locked_time = mysql_escape_string($Locked_time);
		$Modified_by = (int)$Modified_by;
		$Modified_time = mysql_escape_string($Modified_time);
		$Publish_from = mysql_escape_string($Publish_from);
		$Publish_to = mysql_escape_string($Publish_to);
		$Comments = mysql_escape_string($Comments);
		$Options = mysql_escape_string($Options);

		$query = "UPDATE `{$this->tableName}` SET  `category_id` = '$Category_id', `subcat_count` = '$Subcat_count', `direct_object_count` = '$Direct_object_count', `indirect_object_count` = '$Indirect_object_count', `page_title` = '$Page_title', `meta_title` = '$Meta_title', `meta_key` = '$Meta_key', `meta_desc` = '$Meta_desc', `meta_data` = '$Meta_data', `locked_by` = '$Locked_by', `locked_time` = '$Locked_time', `modified_by` = '$Modified_by', `modified_time` = '$Modified_time', `publish_from` = '$Publish_from', `publish_to` = '$Publish_to', `comments` = '$Comments', `options` = '$Options' WHERE `id` = '$Id'";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderById($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategory_infoDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategory_infoDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {

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
	}//End Function getCategory_infoDetailsByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategory_infoDetailsById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategory_infoDetailsById($Id) {

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
	}//End Function getCategory_infoDetailsById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderById($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByCategory_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByCategory_id($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Category_id` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByCategory_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByCategory_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByCategory_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Category_id` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByCategory_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByCategory_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByCategory_id($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `category_id` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByCategory_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByCategory_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByCategory_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `category_id` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByCategory_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByCategory_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByCategory_idOrderById($Category_id, $sorting = 'DESC') {

		$Category_id = (int)$Category_id;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `category_id` = '$Category_id' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByCategory_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByCategory_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByCategory_idOrderByIdWithLimit($Category_id, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Category_id = (int)$Category_id;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `category_id` = '$Category_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByCategory_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByCategory_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByCategory_id($Category_id) {

		$Category_id = (int)$Category_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `category_id` = '$Category_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByCategory_id

	/**
	 * This Method is Script Generated
	 * updateCategory_infoCategory_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoCategory_idColumnById($Id, $Category_id) {

		$Id = (int)$Id;
		$Category_id = (int)$Category_id;

		$query = "UPDATE `category_info` SET `category_id` = '$Category_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoCategory_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderBySubcat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderBySubcat_count($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Subcat_count` $sorting ";

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
	}//End Function GetAllCategory_infoOrderBySubcat_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderBySubcat_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderBySubcat_countWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Subcat_count` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderBySubcat_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderBySubcat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderBySubcat_count($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `subcat_count` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderBySubcat_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderBySubcat_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderBySubcat_countWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `subcat_count` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderBySubcat_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoBySubcat_countOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoBySubcat_countOrderById($Subcat_count = '0', $sorting = 'DESC') {

		$Subcat_count = (int)$Subcat_count;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `subcat_count` = '$Subcat_count' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoBySubcat_countOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoBySubcat_countOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoBySubcat_countOrderByIdWithLimit($Subcat_count = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Subcat_count = (int)$Subcat_count;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `subcat_count` = '$Subcat_count' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoBySubcat_countOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoBySubcat_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoBySubcat_count($Subcat_count = '0') {

		$Subcat_count = (int)$Subcat_count;

		$query = "DELETE FROM `{$this->tableName}` WHERE `subcat_count` = '$Subcat_count' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoBySubcat_count

	/**
	 * This Method is Script Generated
	 * updateCategory_infoSubcat_countColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoSubcat_countColumnById($Id, $Subcat_count = '0') {

		$Id = (int)$Id;
		$Subcat_count = (int)$Subcat_count;

		$query = "UPDATE `category_info` SET `subcat_count` = '$Subcat_count' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoSubcat_countColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByDirect_object_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByDirect_object_count($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Direct_object_count` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByDirect_object_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByDirect_object_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByDirect_object_countWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Direct_object_count` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByDirect_object_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByDirect_object_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByDirect_object_count($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `direct_object_count` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByDirect_object_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByDirect_object_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByDirect_object_countWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `direct_object_count` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByDirect_object_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByDirect_object_countOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByDirect_object_countOrderById($Direct_object_count = '0', $sorting = 'DESC') {

		$Direct_object_count = (int)$Direct_object_count;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `direct_object_count` = '$Direct_object_count' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByDirect_object_countOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByDirect_object_countOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByDirect_object_countOrderByIdWithLimit($Direct_object_count = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Direct_object_count = (int)$Direct_object_count;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `direct_object_count` = '$Direct_object_count' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByDirect_object_countOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByDirect_object_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByDirect_object_count($Direct_object_count = '0') {

		$Direct_object_count = (int)$Direct_object_count;

		$query = "DELETE FROM `{$this->tableName}` WHERE `direct_object_count` = '$Direct_object_count' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByDirect_object_count

	/**
	 * This Method is Script Generated
	 * updateCategory_infoDirect_object_countColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoDirect_object_countColumnById($Id, $Direct_object_count = '0') {

		$Id = (int)$Id;
		$Direct_object_count = (int)$Direct_object_count;

		$query = "UPDATE `category_info` SET `direct_object_count` = '$Direct_object_count' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoDirect_object_countColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByIndirect_object_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByIndirect_object_count($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Indirect_object_count` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByIndirect_object_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByIndirect_object_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByIndirect_object_countWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Indirect_object_count` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByIndirect_object_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByIndirect_object_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByIndirect_object_count($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `indirect_object_count` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByIndirect_object_count

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByIndirect_object_countWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByIndirect_object_countWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `indirect_object_count` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByIndirect_object_countWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIndirect_object_countOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIndirect_object_countOrderById($Indirect_object_count = '0', $sorting = 'DESC') {

		$Indirect_object_count = (int)$Indirect_object_count;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `indirect_object_count` = '$Indirect_object_count' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByIndirect_object_countOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIndirect_object_countOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIndirect_object_countOrderByIdWithLimit($Indirect_object_count = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Indirect_object_count = (int)$Indirect_object_count;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `indirect_object_count` = '$Indirect_object_count' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIndirect_object_countOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByIndirect_object_count
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByIndirect_object_count($Indirect_object_count = '0') {

		$Indirect_object_count = (int)$Indirect_object_count;

		$query = "DELETE FROM `{$this->tableName}` WHERE `indirect_object_count` = '$Indirect_object_count' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByIndirect_object_count

	/**
	 * This Method is Script Generated
	 * updateCategory_infoIndirect_object_countColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoIndirect_object_countColumnById($Id, $Indirect_object_count = '0') {

		$Id = (int)$Id;
		$Indirect_object_count = (int)$Indirect_object_count;

		$query = "UPDATE `category_info` SET `indirect_object_count` = '$Indirect_object_count' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoIndirect_object_countColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByPage_title
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByPage_title($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Page_title` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByPage_title

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByPage_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByPage_titleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Page_title` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByPage_titleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByPage_title
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByPage_title($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `page_title` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByPage_title

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByPage_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByPage_titleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `page_title` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByPage_titleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByPage_titleOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByPage_titleOrderById($Page_title, $sorting = 'DESC') {

		$Page_title = mysql_escape_string($Page_title);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `page_title` = '$Page_title' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByPage_titleOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByPage_titleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByPage_titleOrderByIdWithLimit($Page_title, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Page_title = mysql_escape_string($Page_title);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `page_title` = '$Page_title' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByPage_titleOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByPage_title
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByPage_title($Page_title) {

		$Page_title = mysql_escape_string($Page_title);

		$query = "DELETE FROM `{$this->tableName}` WHERE `page_title` = '$Page_title' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByPage_title

	/**
	 * This Method is Script Generated
	 * updateCategory_infoPage_titleColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoPage_titleColumnById($Id, $Page_title) {

		$Id = (int)$Id;
		$Page_title = mysql_escape_string($Page_title);

		$query = "UPDATE `category_info` SET `page_title` = '$Page_title' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoPage_titleColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_title
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_title($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_title` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByMeta_title

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_titleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_title` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByMeta_titleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_title
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_title($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `meta_title` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_title

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_titleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_titleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `meta_title` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_titleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_titleOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_titleOrderById($Meta_title, $sorting = 'DESC') {

		$Meta_title = mysql_escape_string($Meta_title);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_title` = '$Meta_title' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByMeta_titleOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_titleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_titleOrderByIdWithLimit($Meta_title, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Meta_title = mysql_escape_string($Meta_title);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_title` = '$Meta_title' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByMeta_titleOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByMeta_title
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByMeta_title($Meta_title) {

		$Meta_title = mysql_escape_string($Meta_title);

		$query = "DELETE FROM `{$this->tableName}` WHERE `meta_title` = '$Meta_title' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByMeta_title

	/**
	 * This Method is Script Generated
	 * updateCategory_infoMeta_titleColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoMeta_titleColumnById($Id, $Meta_title) {

		$Id = (int)$Id;
		$Meta_title = mysql_escape_string($Meta_title);

		$query = "UPDATE `category_info` SET `meta_title` = '$Meta_title' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoMeta_titleColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_key
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_key($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_key` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByMeta_key

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_keyWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_keyWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_key` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByMeta_keyWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_key
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_key($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `meta_key` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_key

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_keyWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_keyWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `meta_key` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_keyWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_keyOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_keyOrderById($Meta_key, $sorting = 'DESC') {

		$Meta_key = mysql_escape_string($Meta_key);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_key` = '$Meta_key' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByMeta_keyOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_keyOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_keyOrderByIdWithLimit($Meta_key, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Meta_key = mysql_escape_string($Meta_key);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_key` = '$Meta_key' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByMeta_keyOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByMeta_key
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByMeta_key($Meta_key) {

		$Meta_key = mysql_escape_string($Meta_key);

		$query = "DELETE FROM `{$this->tableName}` WHERE `meta_key` = '$Meta_key' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByMeta_key

	/**
	 * This Method is Script Generated
	 * updateCategory_infoMeta_keyColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoMeta_keyColumnById($Id, $Meta_key) {

		$Id = (int)$Id;
		$Meta_key = mysql_escape_string($Meta_key);

		$query = "UPDATE `category_info` SET `meta_key` = '$Meta_key' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoMeta_keyColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_desc
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_desc($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_desc` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByMeta_desc

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_descWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_descWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_desc` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByMeta_descWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_desc
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_desc($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `meta_desc` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_desc

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_descWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_descWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `meta_desc` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_descWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_descOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_descOrderById($Meta_desc, $sorting = 'DESC') {

		$Meta_desc = mysql_escape_string($Meta_desc);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_desc` = '$Meta_desc' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByMeta_descOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_descOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_descOrderByIdWithLimit($Meta_desc, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Meta_desc = mysql_escape_string($Meta_desc);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_desc` = '$Meta_desc' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByMeta_descOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByMeta_desc
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByMeta_desc($Meta_desc) {

		$Meta_desc = mysql_escape_string($Meta_desc);

		$query = "DELETE FROM `{$this->tableName}` WHERE `meta_desc` = '$Meta_desc' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByMeta_desc

	/**
	 * This Method is Script Generated
	 * updateCategory_infoMeta_descColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoMeta_descColumnById($Id, $Meta_desc) {

		$Id = (int)$Id;
		$Meta_desc = mysql_escape_string($Meta_desc);

		$query = "UPDATE `category_info` SET `meta_desc` = '$Meta_desc' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoMeta_descColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_data
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_data($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_data` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByMeta_data

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByMeta_dataWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByMeta_dataWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Meta_data` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByMeta_dataWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_data
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_data($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `meta_data` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_data

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByMeta_dataWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByMeta_dataWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `meta_data` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByMeta_dataWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_dataOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_dataOrderById($Meta_data, $sorting = 'DESC') {

		$Meta_data = mysql_escape_string($Meta_data);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_data` = '$Meta_data' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByMeta_dataOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByMeta_dataOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByMeta_dataOrderByIdWithLimit($Meta_data, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Meta_data = mysql_escape_string($Meta_data);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `meta_data` = '$Meta_data' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByMeta_dataOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByMeta_data
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByMeta_data($Meta_data) {

		$Meta_data = mysql_escape_string($Meta_data);

		$query = "DELETE FROM `{$this->tableName}` WHERE `meta_data` = '$Meta_data' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByMeta_data

	/**
	 * This Method is Script Generated
	 * updateCategory_infoMeta_dataColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoMeta_dataColumnById($Id, $Meta_data) {

		$Id = (int)$Id;
		$Meta_data = mysql_escape_string($Meta_data);

		$query = "UPDATE `category_info` SET `meta_data` = '$Meta_data' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoMeta_dataColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByLocked_by($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByLocked_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByLocked_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByLocked_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByLocked_by($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByLocked_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByLocked_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByLocked_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByLocked_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByLocked_byOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByLocked_byOrderById($Locked_by = '0', $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByLocked_byOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByLocked_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByLocked_byOrderByIdWithLimit($Locked_by = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByLocked_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByLocked_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByLocked_by($Locked_by = '0') {

		$Locked_by = (int)$Locked_by;

		$query = "DELETE FROM `{$this->tableName}` WHERE `locked_by` = '$Locked_by' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByLocked_by

	/**
	 * This Method is Script Generated
	 * updateCategory_infoLocked_byColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoLocked_byColumnById($Id, $Locked_by = '0') {

		$Id = (int)$Id;
		$Locked_by = (int)$Locked_by;

		$query = "UPDATE `category_info` SET `locked_by` = '$Locked_by' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoLocked_byColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByLocked_time($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByLocked_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByLocked_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByLocked_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByLocked_time($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByLocked_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByLocked_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByLocked_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByLocked_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByLocked_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByLocked_timeOrderById($Locked_time = '0000-00-00 00:00:00', $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByLocked_timeOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByLocked_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByLocked_timeOrderByIdWithLimit($Locked_time = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByLocked_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByLocked_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByLocked_time($Locked_time = '0000-00-00 00:00:00') {

		$Locked_time = mysql_escape_string($Locked_time);

		$query = "DELETE FROM `{$this->tableName}` WHERE `locked_time` = '$Locked_time' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByLocked_time

	/**
	 * This Method is Script Generated
	 * updateCategory_infoLocked_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoLocked_timeColumnById($Id, $Locked_time = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Locked_time = mysql_escape_string($Locked_time);

		$query = "UPDATE `category_info` SET `locked_time` = '$Locked_time' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoLocked_timeColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByModified_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByModified_by($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByModified_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByModified_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByModified_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByModified_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByModified_by($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByModified_by

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByModified_byWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByModified_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByModified_byWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByModified_byOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByModified_byOrderById($Modified_by = '0', $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByModified_byOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByModified_byOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByModified_byOrderByIdWithLimit($Modified_by = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByModified_byOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByModified_by
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByModified_by($Modified_by = '0') {

		$Modified_by = (int)$Modified_by;

		$query = "DELETE FROM `{$this->tableName}` WHERE `modified_by` = '$Modified_by' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByModified_by

	/**
	 * This Method is Script Generated
	 * updateCategory_infoModified_byColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoModified_byColumnById($Id, $Modified_by = '0') {

		$Id = (int)$Id;
		$Modified_by = (int)$Modified_by;

		$query = "UPDATE `category_info` SET `modified_by` = '$Modified_by' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoModified_byColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByModified_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByModified_time($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByModified_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByModified_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByModified_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByModified_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByModified_time($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByModified_time

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByModified_timeWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByModified_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByModified_timeWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByModified_timeOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByModified_timeOrderById($Modified_time = '0000-00-00 00:00:00', $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByModified_timeOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByModified_timeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByModified_timeOrderByIdWithLimit($Modified_time = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByModified_timeOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByModified_time
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByModified_time($Modified_time = '0000-00-00 00:00:00') {

		$Modified_time = mysql_escape_string($Modified_time);

		$query = "DELETE FROM `{$this->tableName}` WHERE `modified_time` = '$Modified_time' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByModified_time

	/**
	 * This Method is Script Generated
	 * updateCategory_infoModified_timeColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoModified_timeColumnById($Id, $Modified_time = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Modified_time = mysql_escape_string($Modified_time);

		$query = "UPDATE `category_info` SET `modified_time` = '$Modified_time' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoModified_timeColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByPublish_from
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByPublish_from($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_from` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByPublish_from

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByPublish_fromWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByPublish_fromWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_from` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByPublish_fromWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByPublish_from
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByPublish_from($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `publish_from` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByPublish_from

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByPublish_fromWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByPublish_fromWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `publish_from` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByPublish_fromWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByPublish_fromOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByPublish_fromOrderById($Publish_from = '0000-00-00 00:00:00', $sorting = 'DESC') {

		$Publish_from = mysql_escape_string($Publish_from);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_from` = '$Publish_from' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByPublish_fromOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByPublish_fromOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByPublish_fromOrderByIdWithLimit($Publish_from = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Publish_from = mysql_escape_string($Publish_from);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_from` = '$Publish_from' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByPublish_fromOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByPublish_from
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByPublish_from($Publish_from = '0000-00-00 00:00:00') {

		$Publish_from = mysql_escape_string($Publish_from);

		$query = "DELETE FROM `{$this->tableName}` WHERE `publish_from` = '$Publish_from' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByPublish_from

	/**
	 * This Method is Script Generated
	 * updateCategory_infoPublish_fromColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoPublish_fromColumnById($Id, $Publish_from = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Publish_from = mysql_escape_string($Publish_from);

		$query = "UPDATE `category_info` SET `publish_from` = '$Publish_from' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoPublish_fromColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByPublish_to
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByPublish_to($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_to` $sorting ";

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
	}//End Function GetAllCategory_infoOrderByPublish_to

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByPublish_toWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByPublish_toWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Publish_to` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_infoOrderByPublish_toWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByPublish_to
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByPublish_to($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `publish_to` $sorting  ";

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
	}//End Function GetAllCategory_infoByIdOrderByPublish_to

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByPublish_toWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByPublish_toWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `publish_to` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByIdOrderByPublish_toWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByPublish_toOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByPublish_toOrderById($Publish_to = '0000-00-00 00:00:00', $sorting = 'DESC') {

		$Publish_to = mysql_escape_string($Publish_to);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_to` = '$Publish_to' ORDER BY `id` ";

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
	}//End Function GetAllCategory_infoByPublish_toOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByPublish_toOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByPublish_toOrderByIdWithLimit($Publish_to = '0000-00-00 00:00:00', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Publish_to = mysql_escape_string($Publish_to);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `publish_to` = '$Publish_to' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_infoByPublish_toOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByPublish_to
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByPublish_to($Publish_to = '0000-00-00 00:00:00') {

		$Publish_to = mysql_escape_string($Publish_to);

		$query = "DELETE FROM `{$this->tableName}` WHERE `publish_to` = '$Publish_to' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByPublish_to

	/**
	 * This Method is Script Generated
	 * updateCategory_infoPublish_toColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoPublish_toColumnById($Id, $Publish_to = '0000-00-00 00:00:00') {

		$Id = (int)$Id;
		$Publish_to = mysql_escape_string($Publish_to);

		$query = "UPDATE `category_info` SET `publish_to` = '$Publish_to' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoPublish_toColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByDate_added($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByDate_addedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByDate_added($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByDate_addedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByDate_addedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByDate_added($Date_added = 'CURRENT_TIMESTAMP') {

		$Date_added = mysql_escape_string($Date_added);

		$query = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByDate_added

	/**
	 * This Method is Script Generated
	 * updateCategory_infoDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {

		$Id = (int)$Id;
		$Date_added = mysql_escape_string($Date_added);

		$query = "UPDATE `category_info` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoDate_addedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByComments
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByComments($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByComments

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByCommentsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByComments
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByComments($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByComments

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByCommentsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByCommentsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByCommentsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByCommentsOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByCommentsOrderById($Comments, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByCommentsOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByCommentsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByCommentsOrderByIdWithLimit($Comments, $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByCommentsOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByComments
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByComments($Comments) {

		$Comments = mysql_escape_string($Comments);

		$query = "DELETE FROM `{$this->tableName}` WHERE `comments` = '$Comments' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByComments

	/**
	 * This Method is Script Generated
	 * updateCategory_infoCommentsColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoCommentsColumnById($Id, $Comments) {

		$Id = (int)$Id;
		$Comments = mysql_escape_string($Comments);

		$query = "UPDATE `category_info` SET `comments` = '$Comments' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoCommentsColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByOptions($sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoOrderByOptions

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoOrderByOptionsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByOptions
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByOptions($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByIdOrderByOptions

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByIdOrderByOptionsWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByIdOrderByOptionsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_infoByIdOrderByOptionsWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByOptionsOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByOptionsOrderById($Options, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByOptionsOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_infoByOptionsOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_infoByOptionsOrderByIdWithLimit($Options, $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_infoByOptionsOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_infoByOptions
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_infoByOptions($Options) {

		$Options = mysql_escape_string($Options);

		$query = "DELETE FROM `{$this->tableName}` WHERE `options` = '$Options' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_infoByOptions

	/**
	 * This Method is Script Generated
	 * updateCategory_infoOptionsColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_infoOptionsColumnById($Id, $Options) {

		$Id = (int)$Id;
		$Options = mysql_escape_string($Options);

		$query = "UPDATE `category_info` SET `options` = '$Options' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_infoOptionsColumnById

}
