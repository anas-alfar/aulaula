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
 * @name Tag_Model_Default
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Tag_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'tag';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this->cols = $this->_cols = $this->columns = array ('id', 'title', 'locale_id', 'published', 'approved', 'order', 'date_added', 'comments', 'date_added' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `locale_id`, `published`, `approved`, `order`, `date_added`, `comments`,`date_added` ';
		parent::__construct ();
	}
	
	public function getAllTagsOrderByColumnWithLimit($column, $sorting, $start, $limit) {
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$column = mysql_escape_string ( $column );
		$sorting = mysql_escape_string ( $sorting );
		
		$this->_orderBy = "$column $sorting";
		$this->_limit = "$start, $limit";
		$result = $this->read ();
		return $result;
	}
}