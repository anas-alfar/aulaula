<?php

class Category_Model_Type extends Aula_Model_DbTable {
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $packageId = NULL;
	public $showInMenu = 'No';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	
	public function __construct() {
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `author_id`, `package_id`, `show_in_menu`, `published`, `approved`, `order`, `date_added` ';
		$this -> _name = 'category_type';
		parent::__construct();
	}

	/**
	 * This Method is Script Generated
	 * insertIntoCategory_type
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function insertIntoCategory_type($Id, $Title, $Label, $Description, $Author_id, $Package_id = '0', $Show_in_menu = 'No', $Published = 'No', $Approved = 'No', $Order = '0') {

		$Id = (int)$Id;
		$Title = mysql_escape_string($Title);
		$Label = mysql_escape_string($Label);
		$Description = mysql_escape_string($Description);
		$Author_id = (int)$Author_id;
		$Package_id = (int)$Package_id;
		$Show_in_menu = mysql_escape_string($Show_in_menu);
		$Published = mysql_escape_string($Published);
		$Approved = mysql_escape_string($Approved);
		$Order = (int)$Order;

		$query = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Title', '$Label', '$Description', '$Author_id', '$Package_id', '$Show_in_menu', '$Published', '$Approved', '$Order') ";

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
	}//End Function insertIntoCategory_type

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeById($Id) {

		$Id = (int)$Id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeById

	/**
	 * This Method is Script Generated
	 * updateCategory_typeById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeById($Id, $Title, $Label, $Description, $Author_id, $Package_id = '0', $Show_in_menu = 'No', $Published = 'No', $Approved = 'No', $Order = '0') {

		$Id = (int)$Id;
		$Title = mysql_escape_string($Title);
		$Label = mysql_escape_string($Label);
		$Description = mysql_escape_string($Description);
		$Author_id = (int)$Author_id;
		$Package_id = (int)$Package_id;
		$Show_in_menu = mysql_escape_string($Show_in_menu);
		$Published = mysql_escape_string($Published);
		$Approved = mysql_escape_string($Approved);
		$Order = (int)$Order;

		$query = "UPDATE `{$this->tableName}` SET  `title` = '$Title', `label` = '$Label', `description` = '$Description', `author_id` = '$Author_id', `package_id` = '$Package_id', `show_in_menu` = '$Show_in_menu', `published` = '$Published', `approved` = '$Approved', `order` = '$Order' WHERE `id` = '$Id'";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderById($sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategory_typeDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategory_typeDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {

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
	}//End Function getCategory_typeDetailsByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategory_typeDetailsById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategory_typeDetailsById($Id) {

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
	}//End Function getCategory_typeDetailsById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderById($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeByIdOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_typeByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByTitle($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Title` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByTitle

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByTitleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Title` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByTitleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByTitle($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `title` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByTitle

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByTitleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `title` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByTitleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByTitleOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByTitleOrderById($Title, $sorting = 'DESC') {

		$Title = mysql_escape_string($Title);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `title` = '$Title' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByTitleOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByTitleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByTitleOrderByIdWithLimit($Title, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Title = mysql_escape_string($Title);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `title` = '$Title' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByTitleOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByTitle
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByTitle($Title) {

		$Title = mysql_escape_string($Title);

		$query = "DELETE FROM `{$this->tableName}` WHERE `title` = '$Title' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByTitle

	/**
	 * This Method is Script Generated
	 * updateCategory_typeTitleColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeTitleColumnById($Id, $Title) {

		$Id = (int)$Id;
		$Title = mysql_escape_string($Title);

		$query = "UPDATE `category_type` SET `title` = '$Title' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeTitleColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByLabel
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByLabel($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Label` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByLabel

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByLabelWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByLabelWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Label` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByLabelWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByLabel
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByLabel($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `label` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByLabel

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByLabelWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByLabelWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `label` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByLabelWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByLabelOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByLabelOrderById($Label, $sorting = 'DESC') {

		$Label = mysql_escape_string($Label);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `label` = '$Label' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByLabelOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByLabelOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByLabelOrderByIdWithLimit($Label, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Label = mysql_escape_string($Label);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `label` = '$Label' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByLabelOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByLabel
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByLabel($Label) {

		$Label = mysql_escape_string($Label);

		$query = "DELETE FROM `{$this->tableName}` WHERE `label` = '$Label' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByLabel

	/**
	 * This Method is Script Generated
	 * updateCategory_typeLabelColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeLabelColumnById($Id, $Label) {

		$Id = (int)$Id;
		$Label = mysql_escape_string($Label);

		$query = "UPDATE `category_type` SET `label` = '$Label' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeLabelColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByDescription
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByDescription($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Description` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByDescription

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByDescriptionWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByDescriptionWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Description` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByDescriptionWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByDescription
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByDescription($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `description` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByDescription

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByDescriptionWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByDescriptionWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `description` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByDescriptionWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByDescriptionOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByDescriptionOrderById($Description, $sorting = 'DESC') {

		$Description = mysql_escape_string($Description);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `description` = '$Description' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByDescriptionOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByDescriptionOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByDescriptionOrderByIdWithLimit($Description, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Description = mysql_escape_string($Description);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `description` = '$Description' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByDescriptionOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByDescription
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByDescription($Description) {

		$Description = mysql_escape_string($Description);

		$query = "DELETE FROM `{$this->tableName}` WHERE `description` = '$Description' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByDescription

	/**
	 * This Method is Script Generated
	 * updateCategory_typeDescriptionColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeDescriptionColumnById($Id, $Description) {

		$Id = (int)$Id;
		$Description = mysql_escape_string($Description);

		$query = "UPDATE `category_type` SET `description` = '$Description' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeDescriptionColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByAuthor_id($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Author_id` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByAuthor_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByAuthor_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Author_id` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByAuthor_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByAuthor_id($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `author_id` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByAuthor_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByAuthor_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `author_id` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByAuthor_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByAuthor_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByAuthor_idOrderById($Author_id, $sorting = 'DESC') {

		$Author_id = (int)$Author_id;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByAuthor_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByAuthor_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByAuthor_idOrderByIdWithLimit($Author_id, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Author_id = (int)$Author_id;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByAuthor_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByAuthor_id($Author_id) {

		$Author_id = (int)$Author_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByAuthor_id

	/**
	 * This Method is Script Generated
	 * updateCategory_typeAuthor_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeAuthor_idColumnById($Id, $Author_id) {

		$Id = (int)$Id;
		$Author_id = (int)$Author_id;

		$query = "UPDATE `category_type` SET `author_id` = '$Author_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeAuthor_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByPackage_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByPackage_id($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Package_id` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByPackage_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByPackage_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Package_id` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByPackage_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByPackage_id($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `package_id` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByPackage_id

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByPackage_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `package_id` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByPackage_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByPackage_idOrderById($Package_id = '0', $sorting = 'DESC') {

		$Package_id = (int)$Package_id;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByPackage_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByPackage_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByPackage_idOrderByIdWithLimit($Package_id = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Package_id = (int)$Package_id;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByPackage_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByPackage_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByPackage_id($Package_id = '0') {

		$Package_id = (int)$Package_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByPackage_id

	/**
	 * This Method is Script Generated
	 * updateCategory_typePackage_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typePackage_idColumnById($Id, $Package_id = '0') {

		$Id = (int)$Id;
		$Package_id = (int)$Package_id;

		$query = "UPDATE `category_type` SET `package_id` = '$Package_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typePackage_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByShow_in_menu
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByShow_in_menu($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Show_in_menu` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByShow_in_menu

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByShow_in_menuWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByShow_in_menuWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Show_in_menu` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByShow_in_menuWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByShow_in_menu
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByShow_in_menu($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `show_in_menu` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByShow_in_menu

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByShow_in_menuWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByShow_in_menuWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `show_in_menu` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByShow_in_menuWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByShow_in_menuOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByShow_in_menuOrderById($Show_in_menu = 'No', $sorting = 'DESC') {

		$Show_in_menu = mysql_escape_string($Show_in_menu);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `show_in_menu` = '$Show_in_menu' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByShow_in_menuOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByShow_in_menuOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByShow_in_menuOrderByIdWithLimit($Show_in_menu = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Show_in_menu = mysql_escape_string($Show_in_menu);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `show_in_menu` = '$Show_in_menu' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByShow_in_menuOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByShow_in_menu
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByShow_in_menu($Show_in_menu = 'No') {

		$Show_in_menu = mysql_escape_string($Show_in_menu);

		$query = "DELETE FROM `{$this->tableName}` WHERE `show_in_menu` = '$Show_in_menu' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByShow_in_menu

	/**
	 * This Method is Script Generated
	 * updateCategory_typeShow_in_menuColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeShow_in_menuColumnById($Id, $Show_in_menu = 'No') {

		$Id = (int)$Id;
		$Show_in_menu = mysql_escape_string($Show_in_menu);

		$query = "UPDATE `category_type` SET `show_in_menu` = '$Show_in_menu' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeShow_in_menuColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByPublished($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Published` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByPublished

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByPublishedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Published` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByPublished($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `published` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByPublished

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByPublishedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `published` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByPublishedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByPublishedOrderById($Published = 'No', $sorting = 'DESC') {

		$Published = mysql_escape_string($Published);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `published` = '$Published' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByPublishedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByPublishedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByPublishedOrderByIdWithLimit($Published = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Published = mysql_escape_string($Published);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `published` = '$Published' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByPublishedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByPublished
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByPublished($Published = 'No') {

		$Published = mysql_escape_string($Published);

		$query = "DELETE FROM `{$this->tableName}` WHERE `published` = '$Published' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByPublished

	/**
	 * This Method is Script Generated
	 * updateCategory_typePublishedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typePublishedColumnById($Id, $Published = 'No') {

		$Id = (int)$Id;
		$Published = mysql_escape_string($Published);

		$query = "UPDATE `category_type` SET `published` = '$Published' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typePublishedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByApproved($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Approved` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByApproved

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByApprovedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Approved` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByApproved($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `approved` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByApproved

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByApprovedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `approved` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByApprovedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByApprovedOrderById($Approved = 'No', $sorting = 'DESC') {

		$Approved = mysql_escape_string($Approved);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `approved` = '$Approved' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByApprovedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByApprovedOrderByIdWithLimit($Approved = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Approved = mysql_escape_string($Approved);
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `approved` = '$Approved' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByApprovedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByApproved
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByApproved($Approved = 'No') {

		$Approved = mysql_escape_string($Approved);

		$query = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByApproved

	/**
	 * This Method is Script Generated
	 * updateCategory_typeApprovedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeApprovedColumnById($Id, $Approved = 'No') {

		$Id = (int)$Id;
		$Approved = mysql_escape_string($Approved);

		$query = "UPDATE `category_type` SET `approved` = '$Approved' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeApprovedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByOrder($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Order` $sorting ";

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
	}//End Function GetAllCategory_typeOrderByOrder

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByOrderWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Order` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategory_typeOrderByOrderWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByOrder($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `order` $sorting  ";

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
	}//End Function GetAllCategory_typeByIdOrderByOrder

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByOrderWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `order` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByIdOrderByOrderWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByOrderOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByOrderOrderById($Order = '0', $sorting = 'DESC') {

		$Order = (int)$Order;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `order` = '$Order' ORDER BY `id` ";

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
	}//End Function GetAllCategory_typeByOrderOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByOrderOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByOrderOrderByIdWithLimit($Order = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Order = (int)$Order;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `order` = '$Order' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategory_typeByOrderOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByOrder
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByOrder($Order = '0') {

		$Order = (int)$Order;

		$query = "DELETE FROM `{$this->tableName}` WHERE `order` = '$Order' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByOrder

	/**
	 * This Method is Script Generated
	 * updateCategory_typeOrderColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeOrderColumnById($Id, $Order = '0') {

		$Id = (int)$Id;
		$Order = (int)$Order;

		$query = "UPDATE `category_type` SET `order` = '$Order' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeOrderColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByDate_added($sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeOrderByDate_addedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_typeOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByDate_added($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeByIdOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByIdOrderByDate_addedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategory_typeByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeByDate_addedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategory_typeByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategory_typeByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategory_typeByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategory_typeByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategory_typeByDate_added($Date_added = 'CURRENT_TIMESTAMP') {

		$Date_added = mysql_escape_string($Date_added);

		$query = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategory_typeByDate_added

	/**
	 * This Method is Script Generated
	 * updateCategory_typeDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategory_typeDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {

		$Id = (int)$Id;
		$Date_added = mysql_escape_string($Date_added);

		$query = "UPDATE `category_type` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategory_typeDate_addedColumnById

}
