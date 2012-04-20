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
 * @name User_Model_Info
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class User_Model_Info extends Aula_Model_DbTable {
	
	protected $_name = 'user_info';
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
	public $blocked = 'No';
	public $confirmed = 'No';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $comments = '';
	public $options = '';
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'user_id', 'date_of_birth', 'registration_date', 'last_login_date', 'company', 'department', 'position', 'home_phone', 'work_phone', 'work_fax', 'mobile', 'blocked', 'approved', 'confirmed', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments', 'options' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `user_id`, `date_of_birth`, `registration_date`, `last_login_date`, `company`, `department`, `position`, `home_phone`, `work_phone`, `work_fax`, `mobile`, `blocked`, `approved`, `confirmed`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options` ';
		parent::__construct ();
	}

}
