<?php

class Crud_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'menu';
	protected $_primary = 'id';
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'label', 'link', 'type_id', 'parent_id', 'package_id', 'sublevel', 'published', 'approved', 'order', 'date_added' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `label`, `link`, `type_id`, `parent_id`, `package_id`, `sublevel`, `published`, `approved`, `order`, `date_added` ';
		parent::__construct ();
	}
}