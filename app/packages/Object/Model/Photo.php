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
 * @name Object_Model_Photo
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Object_Model_Photo extends Aula_Model_DbTable {
	
	protected $_name = 'object_photo';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $showInObject = 'Yes';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $objectType = 2;
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'alias', 'intro_text', 'author_id', 'source_id', 'object_id', 'category_id', 'size', 'height', 'width', 'extension', 'taken_date', 'taken_location', 'meta_data', 'show_in_object', 'published', 'approved', 'order', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'comments', 'options', 'date_added' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `alias`, `intro_text`, `author_id`, `source_id`, `object_id`, `category_id`, `size`, `height`, `width`, `extension`, `taken_date`, `taken_location`, `meta_data`, `show_in_object`, `published`, `approved`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `comments`, `options`,`date_added` ';
		parent::__construct ();
	}
	
	public function GetAllCleanPhotoEssaysOrderByColWithLimit($subCategoriesList, $column = 'o.id', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		$column = mysql_escape_string ( $column );
		$subCategoriesList = mysql_escape_string ( $subCategoriesList );
		
		$this->_selectQuery = 'SELECT SQL_CALC_FOUND_ROWS u.*, ui.*, op.`id`, op.`alias`, op.`intro_text`, op.`author_id`, op.`source_id`, op.`object_id`, op.`category_id`, op.`size`, op.`height`, op.`width`, op.`extension`, op.`taken_date`, op.`taken_location`, op.`meta_data`, op.`show_in_object`, op.`published`, op.`approved`, op.`order`, op.`locked_by`, op.`locked_time`, op.`modified_by`, op.`modified_time`, op.`publish_from`, op.`publish_to`, op.`date_added`, op.`comments`, op.`options`, o.`category_id` AS `sub_category` 
		FROM `object_photo` AS op  
		INNER JOIN `object` AS o ON op.`object_id` = o.`id`  
		INNER JOIN `user` AS u ON op.`author_id` = u.`id` 
		INNER JOIN `user_info` AS ui ON u.`id` = ui.`user_id`';
		
		$this->_orderBy = "$column $sorting";
		$this->_limit = "$start, $limit";
		$result = $this->read ( 'o.`category_id` IN (?) > AND op.`published` = ? AND op.`approved`= ? ', array ($subCategoriesList, 'Yes', 'Yes' ) );
		return $result;
	} //End Function GetAllCleanPhotoEssaysOrderByColWithLimit
	

	public function getAllObject_PhotoOrderByColumnWithLimit($column, $sorting, $start, $limit) {
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