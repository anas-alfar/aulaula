<?php

class Menu_Model_Type extends Aula_Model_DbTable {
	
	protected $_name = 'menu_type';
	protected $_primary = 'id';
	
	public $id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $packageId = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'title', 'label', 'description', 'author_id', 'published', 'approved', 'order', 'package_id', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `author_id`, `published`, `approved`, `order`, `package_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options` ';
		parent::__construct();
	}
	
	public function insertInto($label, $link, $type_id, $parent_id = '0', $package_id = '0', $sublevel = '0', $published = 'No', $approved = 'No', $order = '0') {
		$data = array('id' => NULL, 'label' => $label, 'link' => $link, 'type_id' => $type_id, 'parent_id' => $parent_id, 'package_id' => $package_id, 'sublevel' => $sublevel, 'published' => $published, 'approved' => $approved, 'order' => $order);
		return $this -> insert($data);
	}
	
	public function getAllOrderByColumnWithLimit($column = 'id', $start = 0, $limit = 10, $sorting = 'DESC') {
		if (!in_array($column, $this -> _cols)) {
			return false;
		}
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> select();
		return $result;
	}
	
	public function updateColumnById($id, $column, $data) {
		$data = array('approved' => $Approved);
		$where = array('`id` = ?' => $Id);
		return $this -> update($data, $where);
	}

	public function getAllOrderByColumn($sorting = 'DESC') {
		$this -> _orderBy = "`date_added` $sorting";
		$result = $this -> select();
		return $result;
	}
}