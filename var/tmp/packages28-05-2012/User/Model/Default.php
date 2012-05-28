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
 * @name User_Model_Default
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class User_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'user';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $userLevelId = 1;

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'username', 'password', 'fullname', 'email', 'user_level_id', 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `username`, `password`, `fullname`, `email`, `user_level_id`, `date_added` ';
		parent::__construct();
	}
	
	public function getUserAndUser_infoOrderByColumnWithLimit($column = '`id`', $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string ( $sorting );
		$column = mysql_escape_string ( $column );
		if (in_array($column, $this->_cols)) {
			$column = 'u.' . $column;
		} else {
			$column = 'ui.' . $column;
		}
		
		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS  u.`id`,u.`username`, u.`fullname`, u.`email`,u.`user_level_id`, 
							u.`date_added` , ui.`blocked`,ui.`approved`,ui.`confirmed`
							FROM   `'.$this->_name.'` AS u
							INNER JOIN  `'.$this->_name.'_info` AS ui ON ui.`user_id` = u.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read();
		return $result;

	}

}
