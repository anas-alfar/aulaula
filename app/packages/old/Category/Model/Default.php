<?php

class Category_Model_Default extends Aula_Model_DbTable {
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $parentId = 0;
	public $packageId = 1;
	public $showInMenu = 'No';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `type_id`, `author_id`, `parent_id`, `package_id`, `show_in_menu`, `published`, `approved`, `order`, `date_added` ';
		$this -> _name = 'category';
		parent::__construct();
	}

	/**
	 * This Method is Script Generated
	 * insertIntoCategory
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function insertIntoCategory($Id, $Title, $Label, $Description, $Type_id, $Author_id, $Parent_id = '0', $Package_id = '0', $Show_in_menu = 'No', $Published = 'No', $Approved = 'No', $Order = '0') {

		$Id = (int)$Id;
		$Title = mysql_escape_string($Title);
		$Label = mysql_escape_string($Label);
		$Description = mysql_escape_string($Description);
		$Type_id = (int)$Type_id;
		$Author_id = (int)$Author_id;
		$Parent_id = (int)$Parent_id;
		$Package_id = (int)$Package_id;
		$Show_in_menu = mysql_escape_string($Show_in_menu);
		$Published = mysql_escape_string($Published);
		$Approved = mysql_escape_string($Approved);
		$Order = (int)$Order;

		$query = "INSERT INTO `{$this->tableName}` ({$this->insertColumnsList}) VALUES (NULL, '$Title', '$Label', '$Description', '$Type_id', '$Author_id', '$Parent_id', '$Package_id', '$Show_in_menu', '$Published', '$Approved', '$Order') ";

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
	}//End Function insertIntoCategory

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryById($Id) {

		$Id = (int)$Id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryById

	/**
	 * This Method is Script Generated
	 * updateCategoryById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryById($Id, $Title, $Label, $Description, $Type_id, $Author_id, $Parent_id = '0', $Package_id = '0', $Show_in_menu = 'No', $Published = 'No', $Approved = 'No', $Order = '0') {

		$Id = (int)$Id;
		$Title = mysql_escape_string($Title);
		$Label = mysql_escape_string($Label);
		$Description = mysql_escape_string($Description);
		$Type_id = (int)$Type_id;
		$Author_id = (int)$Author_id;
		$Parent_id = (int)$Parent_id;
		$Package_id = (int)$Package_id;
		$Show_in_menu = mysql_escape_string($Show_in_menu);
		$Published = mysql_escape_string($Published);
		$Approved = mysql_escape_string($Approved);
		$Order = (int)$Order;

		$query = "UPDATE `{$this->tableName}` SET  `title` = '$Title', `label` = '$Label', `description` = '$Description', `type_id` = '$Type_id', `author_id` = '$Author_id', `parent_id` = '$Parent_id', `package_id` = '$Package_id', `show_in_menu` = '$Show_in_menu', `published` = '$Published', `approved` = '$Approved', `order` = '$Order' WHERE `id` = '$Id'";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderById($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategoryDetailsByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategoryDetailsByIdWithLimit($Id, $start = 0, $limit = 10) {

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
	}//End Function getCategoryDetailsByIdWithLimit

	/**
	 * This Method is Script Generated
	 * getCategoryDetailsById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategoryDetailsById($Id) {

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
	}//End Function getCategoryDetailsById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderById($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByTitle($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByTitle

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByTitleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByTitleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByTitle
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByTitle($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByTitle

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByTitleWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByTitleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByTitleWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByTitleOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByTitleOrderById($Title, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByTitleOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByTitleOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByTitleOrderByIdWithLimit($Title, $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByTitleOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByTitle
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByTitle($Title) {

		$Title = mysql_escape_string($Title);

		$query = "DELETE FROM `{$this->tableName}` WHERE `title` = '$Title' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByTitle

	/**
	 * This Method is Script Generated
	 * updateCategoryTitleColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryTitleColumnById($Id, $Title) {

		$Id = (int)$Id;
		$Title = mysql_escape_string($Title);

		$query = "UPDATE `category` SET `title` = '$Title' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryTitleColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByLabel
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByLabel($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByLabel

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByLabelWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByLabelWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByLabelWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByLabel
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByLabel($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByLabel

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByLabelWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByLabelWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByLabelWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByLabelOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByLabelOrderById($Label, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByLabelOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByLabelOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByLabelOrderByIdWithLimit($Label, $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByLabelOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByLabel
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByLabel($Label) {

		$Label = mysql_escape_string($Label);

		$query = "DELETE FROM `{$this->tableName}` WHERE `label` = '$Label' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByLabel

	/**
	 * This Method is Script Generated
	 * updateCategoryLabelColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryLabelColumnById($Id, $Label) {

		$Id = (int)$Id;
		$Label = mysql_escape_string($Label);

		$query = "UPDATE `category` SET `label` = '$Label' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryLabelColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByDescription
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByDescription($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByDescription

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByDescriptionWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByDescriptionWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByDescriptionWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByDescription
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByDescription($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByDescription

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByDescriptionWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByDescriptionWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByDescriptionWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByDescriptionOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByDescriptionOrderById($Description, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByDescriptionOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByDescriptionOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByDescriptionOrderByIdWithLimit($Description, $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByDescriptionOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByDescription
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByDescription($Description) {

		$Description = mysql_escape_string($Description);

		$query = "DELETE FROM `{$this->tableName}` WHERE `description` = '$Description' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByDescription

	/**
	 * This Method is Script Generated
	 * updateCategoryDescriptionColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryDescriptionColumnById($Id, $Description) {

		$Id = (int)$Id;
		$Description = mysql_escape_string($Description);

		$query = "UPDATE `category` SET `description` = '$Description' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryDescriptionColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByType_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByType_id($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Type_id` $sorting ";

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
	}//End Function GetAllCategoryOrderByType_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByType_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByType_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Type_id` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategoryOrderByType_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByType_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByType_id($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `type_id` $sorting  ";

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
	}//End Function GetAllCategoryByIdOrderByType_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByType_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByType_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `type_id` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategoryByIdOrderByType_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByType_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByType_idOrderById($Type_id, $sorting = 'DESC') {

		$Type_id = (int)$Type_id;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `type_id` = '$Type_id' ORDER BY `id` ";

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
	}//End Function GetAllCategoryByType_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByType_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByType_idOrderByIdWithLimit($Type_id, $start = 0, $limit = 10, $sorting = 'DESC') {

		$Type_id = (int)$Type_id;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `type_id` = '$Type_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategoryByType_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByType_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByType_id($Type_id) {

		$Type_id = (int)$Type_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `type_id` = '$Type_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByType_id

	/**
	 * This Method is Script Generated
	 * updateCategoryType_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryType_idColumnById($Id, $Type_id) {

		$Id = (int)$Id;
		$Type_id = (int)$Type_id;

		$query = "UPDATE `category` SET `type_id` = '$Type_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryType_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByAuthor_id($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByAuthor_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByAuthor_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByAuthor_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByAuthor_id($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByAuthor_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByAuthor_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByAuthor_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByAuthor_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByAuthor_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByAuthor_idOrderById($Author_id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByAuthor_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByAuthor_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByAuthor_idOrderByIdWithLimit($Author_id, $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByAuthor_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByAuthor_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByAuthor_id($Author_id) {

		$Author_id = (int)$Author_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `author_id` = '$Author_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByAuthor_id

	/**
	 * This Method is Script Generated
	 * updateCategoryAuthor_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryAuthor_idColumnById($Id, $Author_id) {

		$Id = (int)$Id;
		$Author_id = (int)$Author_id;

		$query = "UPDATE `category` SET `author_id` = '$Author_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryAuthor_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByParent_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByParent_id($sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Parent_id` $sorting ";

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
	}//End Function GetAllCategoryOrderByParent_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByParent_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByParent_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `Parent_id` $sorting LIMIT $start,$limit ";

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
	}//End Function GetAllCategoryOrderByParent_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByParent_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByParent_id($Id, $sorting = 'DESC') {

		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `id` = '$Id' ORDER BY `parent_id` $sorting  ";

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
	}//End Function GetAllCategoryByIdOrderByParent_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByParent_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByParent_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$Id = (int)$Id;

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` ORDER BY `parent_id` $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategoryByIdOrderByParent_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByParent_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByParent_idOrderById($Parent_id = '0', $sorting = 'DESC') {

		$Parent_id = (int)$Parent_id;
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `parent_id` = '$Parent_id' ORDER BY `id` ";

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
	}//End Function GetAllCategoryByParent_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByParent_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByParent_idOrderByIdWithLimit($Parent_id = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

		$Parent_id = (int)$Parent_id;
		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT SQL_CALC_FOUND_ROWS {$this -> _selectColumnsList} FROM `{$this->tableName}` WHERE `parent_id` = '$Parent_id' ORDER BY `id`  $sorting LIMIT $start , $limit ";

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
	}//End Function GetAllCategoryByParent_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByParent_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByParent_id($Parent_id = '0') {

		$Parent_id = (int)$Parent_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `parent_id` = '$Parent_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByParent_id

	/**
	 * This Method is Script Generated
	 * updateCategoryParent_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryParent_idColumnById($Id, $Parent_id = '0') {

		$Id = (int)$Id;
		$Parent_id = (int)$Parent_id;

		$query = "UPDATE `category` SET `parent_id` = '$Parent_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryParent_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByPackage_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByPackage_id($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByPackage_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByPackage_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByPackage_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByPackage_id($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByPackage_id

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByPackage_idWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByPackage_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByPackage_idWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByPackage_idOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByPackage_idOrderById($Package_id = '0', $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByPackage_idOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByPackage_idOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByPackage_idOrderByIdWithLimit($Package_id = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByPackage_idOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByPackage_id
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByPackage_id($Package_id = '0') {

		$Package_id = (int)$Package_id;

		$query = "DELETE FROM `{$this->tableName}` WHERE `package_id` = '$Package_id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByPackage_id

	/**
	 * This Method is Script Generated
	 * updateCategoryPackage_idColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryPackage_idColumnById($Id, $Package_id = '0') {

		$Id = (int)$Id;
		$Package_id = (int)$Package_id;

		$query = "UPDATE `category` SET `package_id` = '$Package_id' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryPackage_idColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByShow_in_menu
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByShow_in_menu($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByShow_in_menu

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByShow_in_menuWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByShow_in_menuWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByShow_in_menuWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByShow_in_menu
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByShow_in_menu($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByShow_in_menu

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByShow_in_menuWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByShow_in_menuWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByShow_in_menuWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByShow_in_menuOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByShow_in_menuOrderById($Show_in_menu = 'No', $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByShow_in_menuOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByShow_in_menuOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByShow_in_menuOrderByIdWithLimit($Show_in_menu = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByShow_in_menuOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByShow_in_menu
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByShow_in_menu($Show_in_menu = 'No') {

		$Show_in_menu = mysql_escape_string($Show_in_menu);

		$query = "DELETE FROM `{$this->tableName}` WHERE `show_in_menu` = '$Show_in_menu' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByShow_in_menu

	/**
	 * This Method is Script Generated
	 * updateCategoryShow_in_menuColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryShow_in_menuColumnById($Id, $Show_in_menu = 'No') {

		$Id = (int)$Id;
		$Show_in_menu = mysql_escape_string($Show_in_menu);

		$query = "UPDATE `category` SET `show_in_menu` = '$Show_in_menu' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryShow_in_menuColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByPublished($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByPublished

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByPublishedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByPublished
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByPublished($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByPublished

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByPublishedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByPublishedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByPublishedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByPublishedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByPublishedOrderById($Published = 'No', $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByPublishedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByPublishedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByPublishedOrderByIdWithLimit($Published = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByPublishedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByPublished
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByPublished($Published = 'No') {

		$Published = mysql_escape_string($Published);

		$query = "DELETE FROM `{$this->tableName}` WHERE `published` = '$Published' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByPublished

	/**
	 * This Method is Script Generated
	 * updateCategoryPublishedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryPublishedColumnById($Id, $Published = 'No') {

		$Id = (int)$Id;
		$Published = mysql_escape_string($Published);

		$query = "UPDATE `category` SET `published` = '$Published' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryPublishedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByApproved($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByApproved

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByApprovedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByApproved
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByApproved($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByApproved

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByApprovedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByApprovedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByApprovedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByApprovedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByApprovedOrderById($Approved = 'No', $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByApprovedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByApprovedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByApprovedOrderByIdWithLimit($Approved = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByApprovedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByApproved
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByApproved($Approved = 'No') {

		$Approved = mysql_escape_string($Approved);

		$query = "DELETE FROM `{$this->tableName}` WHERE `approved` = '$Approved' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByApproved

	/**
	 * This Method is Script Generated
	 * updateCategoryApprovedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryApprovedColumnById($Id, $Approved = 'No') {

		$Id = (int)$Id;
		$Approved = mysql_escape_string($Approved);

		$query = "UPDATE `category` SET `approved` = '$Approved' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryApprovedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByOrder($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByOrder

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByOrderWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByOrderWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByOrder
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByOrder($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByOrder

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByOrderWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByOrderWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByOrderWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByOrderOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByOrderOrderById($Order = '0', $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByOrderOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByOrderOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByOrderOrderByIdWithLimit($Order = '0', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByOrderOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByOrder
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByOrder($Order = '0') {

		$Order = (int)$Order;

		$query = "DELETE FROM `{$this->tableName}` WHERE `order` = '$Order' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByOrder

	/**
	 * This Method is Script Generated
	 * updateCategoryOrderColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryOrderColumnById($Id, $Order = '0') {

		$Id = (int)$Id;
		$Order = (int)$Order;

		$query = "UPDATE `category` SET `order` = '$Order' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryOrderColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByDate_added($sorting = 'DESC') {

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
	}//End Function GetAllCategoryOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategoryOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryOrderByDate_addedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByDate_added($Id, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByIdOrderByDate_added

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByIdOrderByDate_addedWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByIdOrderByDate_addedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {

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
	}//End Function GetAllCategoryByIdOrderByDate_addedWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByDate_addedOrderById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByDate_addedOrderById($Date_added = 'CURRENT_TIMESTAMP', $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByDate_addedOrderById

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByDate_addedOrderByIdWithLimit
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCategoryByDate_addedOrderByIdWithLimit($Date_added = 'CURRENT_TIMESTAMP', $start = 0, $limit = 10, $sorting = 'DESC') {

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
	}//End Function GetAllCategoryByDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * deleteFromCategoryByDate_added
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function deleteFromCategoryByDate_added($Date_added = 'CURRENT_TIMESTAMP') {

		$Date_added = mysql_escape_string($Date_added);

		$query = "DELETE FROM `{$this->tableName}` WHERE `date_added` = '$Date_added' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function deleteFromCategoryByDate_added

	/**
	 * This Method is Script Generated
	 * updateCategoryDate_addedColumnById
	 * Generated Date: 2011-05-13 14:54:41
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function updateCategoryDate_addedColumnById($Id, $Date_added = 'CURRENT_TIMESTAMP') {

		$Id = (int)$Id;
		$Date_added = mysql_escape_string($Date_added);

		$query = "UPDATE `category` SET `date_added` = '$Date_added' WHERE `id` = '$Id' ";

		$result = $this -> dbLink -> query($query);

		if (!$result) {
			return false;
		}

		return true;
	}//End Function updateCategoryDate_addedColumnById

	/**
	 * This Method is Script Generated
	 * GetAllCleanCategoryIdAndDate_addedOrderByIdWithLimit
	 * Generated Date: 2010-04-26 02:08:47
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCleanCategoryIdAndDate_addedOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT   SQL_CALC_FOUND_ROWS `id`, `date_added` 
				FROM   `category` WHERE `published` = 'Yes' AND `approved` = 'Yes'  
				ORDER BY  `id` LIMIT   $start , $limit ";

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
	}//End Function GetAllCleanCategoryIdAndDate_addedOrderByIdWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllCategoryByParent_idOrderById
	 * Generated Date: 2010-04-26 02:08:47
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllCleanCategoryByParent_idOrderByColumn($column, $Parent_id = '0', $sorting = 'DESC') {

		$Parent_id = ( int )$Parent_id;
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);

		$query = "SELECT 		SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `type_id`, `author_id`, `parent_id`, `package_id`, `show_in_menu`, `published`, `approved`, `order`, `date_added` 
FROM 		`category` 
WHERE 		`show_in_menu` = 'Yes' 
AND 		`published` = 'Yes' 
AND 		`approved` = 'Yes' 
AND 		`parent_id` = '$Parent_id'
ORDER BY 	$column $sorting 
		";

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
	}//End Function GetAllCategoryByParent_idOrderById

	/**
	 * This Method is Script Generated
	 * getCategoryAndCategory_infoOrderByColumnWithLimit
	 * Generated Date: 2010-05-18 03:27:47
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function getCategoryAndCategory_infoOrderByColumnWithLimit($Column = 'm.id', $sorting = 'DESC', $start = 0, $limit = 10) {

		$Column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$start = ( int )($start);
		$limit = ( int )($limit);

		$query = "CALL SP_GetCategoryAndCategory_infoOrderByColumnWithLimit ('$Column' , '$sorting', '$start', '$limit')";

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
	} //End Function   getCategoryAndCategory_infoOrderByColumnWithLimit

}
