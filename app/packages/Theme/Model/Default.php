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
 * @name Theme_Model_Default
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Theme_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'theme';
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
	public $layoutId = 1;
	public $templateId = 1;
	public $skinId = 1;
	public $packageId = 1;
	public $classId = 1;
	public $actionId = 1;
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'layout_id', 'template_id', 'skin_id', 'package_id', 'class_id', 'action_id', 'publish_from', 'publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `layout_id`, `template_id`, `skin_id`, `package_id`, `class_id`, `action_id`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		parent::__construct();
	}

}
