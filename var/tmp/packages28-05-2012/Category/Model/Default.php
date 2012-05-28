<?php

class Category_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'category';
	protected $_primary = 'id';

	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $parentId = 0;
	public $packageId = 1;
	public $showInMenu = 'No';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'title', 'label', 'description', 'category_type_id', 'author_id', 'parent_id',
		 'package_id', 'show_in_menu', 'published', 'approved', 'order', 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `category_type_id`, `author_id`, `parent_id`, `package_id`, `show_in_menu`, `published`, `approved`, `order`, `date_added` ';
		parent::__construct();
	}

	public function getCategoryAndCategory_infoOrderByColumnWithLimit($column = '`id`', $sorting = 'DESC', $start = 0, $limit = 10) {

		$start = (int)($start);
		$limit = (int)($limit);
		$sorting = mysql_escape_string ( $sorting );
		$column = mysql_escape_string ( $column );
		if (in_array($column, $this->_cols)) {
			$column = 'c.' . $column;
		} else {
			$column = 'ci.' . $column;
		}
		
		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS  c.`id`,c.`title`, c.`label`, c.`category_type_id`,c.`parent_id`, 
							c.`package_id`,c.`published`,c.`approved`,c.`order`,c.`date_added`,c.`description`,c.`author_id` , c.`show_in_menu`,
							ci.`subcat_count`,ci.`direct_object_count`,ci.`indirect_object_count`,ci.`page_title`,ci.`meta_title`,ci.`meta_key`,
							ci.`meta_desc`,ci.`meta_data`,ci.`locked_by`,ci.`locked_time`,ci.`modified_by`,ci.`modified_time`,ci.`publish_from`,
							ci.`publish_to`,ci.`date_added`,ci.`comments`,ci.`options`
							FROM   `'.$this->_name.'` AS c
							INNER JOIN  `'.$this->_name.'_info` AS ci ON ci.`category_id` = c.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read();
		return $result;
	}

	public function getCategoryAndCategory_infoById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner($this->_name.'_info', $this->_name . '.id='.$this->_name.'_info.category_id',array($this->_name.'_info.*'))
		-> joinInner('category_type', $this->_name . '.category_type_id=category_type.id',array('category_type.title as category_type_title','category_type.label as category_type_label','category_type.description as category_type_description'))
		-> setIntegrityCheck(false)
		-> where ($this->_name . '.id = ?', $id)
		-> query() 
		-> fetch();

		return $result;
	}

}
