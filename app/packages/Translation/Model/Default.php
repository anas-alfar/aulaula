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
 * @name Translation_Model_Default
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Translation_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'translation';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $options = '';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'label', 'translation', 'locale_id', 'hash_key', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `label`, `translation`, `locale_id`, `hash_key`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments` ';
		parent::__construct();
	}
	
	public function getAllTranslation_OrderByColumnWithLimit( $column, $sorting, $start, $limit ) 
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

	public function getAllTranslationByHashkey( $hash_key ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))
		-> where ('hash_key = ?', $hash_key )
		-> query()
		-> fetchAll();

		return $result;
	}

	
	public function getAllTranslation( ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> query() 
		-> fetchAll();

		return $result;
	}

}
