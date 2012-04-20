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
 * @name Object_Model_Default
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'object';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $parentId = 0;
	public $source = 0;
	public $OriginalAuthor = '';
	public $showInList = 'Yes';
	public $published = 'No';
	public $approved = 'No';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $createdDate = '0000-00-00';
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'title', 'created_date', 'author_id', 'source_id', 'tags', 'page_title', 'meta_title', 'meta_key', 'meta_desc', 'meta_data', 'type_id', 'category_id', 'locale_id', 'guid_url', 'original_author', 'parent_id', 'show_in_list', 'published', 'approved' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `created_date`, `author_id`, `source_id`, `tags`, `page_title`, `meta_title`, `meta_key`, `meta_desc`, `meta_data`, `type_id`, `category_id`, `locale_id`, `guid_url`, `original_author`, `parent_id`, `show_in_list`, `published`, `approved` ';
		parent::__construct ();
	}

}
