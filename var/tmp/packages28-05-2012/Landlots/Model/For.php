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
 * @name Landlots_Model_For
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Landlots_Model_For extends Aula_Model_DbTable {

	protected $_name = 'landlots_for';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'title', 'description', 'locale_id', 'hash_key', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `description`, `locale_id`, `hash_key`, `date_added`, `comments`, `options`';
		parent::__construct();
	}
	
	public function getAllFor_OrderByColumnWithLimit( $column, $sorting, $start, $limit ) 
	{
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);
		
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> order("$column $sorting") 
		-> limit("$start, $limit") 
		-> query() 
		-> fetchAll();

		return $result;
	}
	
	public function getAllFor( ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> query() 
		-> fetchAll();

		return $result;
	}
	
	public function getForById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner('locale', $this->_name . '.locale_id=locale.id',array('title as locale_title'))
		-> setIntegrityCheck(false)
		-> where ($this->_name . '.id = ?', $id)
		-> query() 
		-> fetch();

		return $result;
	}

}
