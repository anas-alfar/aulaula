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
 * @name Search_Model_Log
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Search_Model_Log extends Aula_Model_DbTable {

	protected $_name = 'search_log';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $columns = null;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $Search_term = '';
	public $Hits = '0';

	public function __construct() {
		$this -> cols = $this -> _cols = $this -> columns = array('search_term', 'hits');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `search_term`, `hits` ';
		parent::__construct();
	}

}
