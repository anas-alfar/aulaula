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
 * @name Object_Model_Static
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Static extends Aula_Model_DbTable {

	protected $_name = 'object_static';
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
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $objectType = '4';
	public $url = 'http://www.sarayanews.org/';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'alias', 'url', 'intro_text', 'full_text', 'created_date', 'author_id', 'object_id', 'category_id', 'published', 'approved', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'date_added', 'comments', 'options' , 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `alias`, `url`, `intro_text`, `full_text`, `created_date`, `author_id`, `object_id`, `category_id`, `published`, `approved`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `comments`, `options`,`date_added` ';
		parent::__construct();
	}
	
	public function getAllStatic_OrderByColumnWithLimit  ( $column ,$sorting, $start, $limit ) {
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read();
		return $result;
	}
	
	public function getStaticById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner('object', $this->_name . '.object_id=object.id',array('*'))
		-> joinInner('object_info', 'object_info.object_id=object.id',array('*'))
		-> where ($this->_name . '.id = ?', $id)
		-> setIntegrityCheck(false)
		-> query() 
		-> fetch();

		return $result;
	}

}
