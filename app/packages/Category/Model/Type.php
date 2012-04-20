<?php

class Category_Model_Type extends Aula_Model_DbTable {
	
	protected $_name = 'category_type';
	protected $_primary = 'id';
	
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $packageId = NULL;
	public $showInMenu = 'No';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'title', 'label', 'description', 'author_id', 'package_id', 'show_in_menu', 'published', 'approved', 'order', 'date_added' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `author_id`, `package_id`, `show_in_menu`, `published`, `approved`, `order`, `date_added` ';
		parent::__construct ();
	}

}
