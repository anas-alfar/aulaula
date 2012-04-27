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
 * @name Object_Model_Info
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Info extends Aula_Model_DbTable {

	protected $_name = 'object_info';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = ''; 
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $totalViews = 0;
	public $totalComments = 0;
	public $totalRating = 0;
	public $layoutId = 1;
	public $templateId = 1;
	public $skinId = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $themePublishFrom = '0000-00-00';
	public $themePublishTo = '0000-00-00';
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'object_id', 'total_views', 'total_comments', 'total_rating', 'layout_id', 'template_id', 'skin_id', 'theme_publish_from', 'theme_publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `object_id`, `total_views`, `total_comments`, `total_rating`, `layout_id`, `template_id`, `skin_id`, `theme_publish_from`, `theme_publish_to`, `comments`, `options` ';
		parent::__construct();
	}
	
}