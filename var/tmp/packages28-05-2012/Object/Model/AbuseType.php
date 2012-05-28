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
 * @name Object_Model_AbuseType
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_AbuseType extends Aula_Model_DbTable {

	protected $_name = 'object_abuse_type';
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
	public $packageId = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'title', 'label', 'description', 'author_id', 'published', 'approved', 'order', 'package_id', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `author_id`, `published`, `approved`, `order`, `package_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time` ';
		parent::__construct();  
	}
	
}