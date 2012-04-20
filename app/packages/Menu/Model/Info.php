<?php

class Menu_Model_Info extends Aula_Model_DbTable {
	
	protected $_name = 'menu_info';
	protected $_primary = 'id';
	
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
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
		$this->cols = $this->_cols = array ('id', 'menu_id', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'date_added', 'comments', 'options' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `menu_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		parent::__construct ();
	}

}
