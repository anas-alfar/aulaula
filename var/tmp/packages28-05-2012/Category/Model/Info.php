<?php

class Category_Model_Info extends Aula_Model_DbTable {
	
	protected $_name = 'category_info';
	protected $_primary = 'id';
	
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $subcatCount = 0;
	public $directObjectCount = 0;
	public $indirectObjectCount = 0;
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
	public $pageTitle = '';
	public $metaTitle = '';
	public $metaKey = '';
	public $metaDesc = '';
	public $metaData = '';
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'category_id', 'subcat_count', 'direct_object_count', 'indirect_object_count', 'page_title', 'meta_title', 'meta_key', 'meta_desc', 'meta_data', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `category_id`, `subcat_count`, `direct_object_count`, `indirect_object_count`, `page_title`, `meta_title`, `meta_key`, `meta_desc`, `meta_data`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		$this -> _name = 'category_info';
		parent::__construct();
	}
}
