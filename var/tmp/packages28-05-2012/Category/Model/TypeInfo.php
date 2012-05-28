<?php

class Category_Model_TypeInfo extends Aula_Model_DbTable {
	
	protected $_name = 'category_type_info';
	protected $_primary = 'id';
	
	public $Id = NULL;
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $directCatCount = 0;
	public $indirectCatCount = 0;
	public $comments = '';
	public $options = '';
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'category_type_id', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'direct_cat_count', 'indirect_cat_count', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `category_type_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `direct_cat_count`, `indirect_cat_count`, `date_added`, `comments`, `options` ';
		$this -> _name = 'category_type_info';
		parent::__construct();
	}
}
