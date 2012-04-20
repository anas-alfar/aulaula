<?php
/**
 * 
 * @name Object_Model_Abuse
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @access public
 *
 */
class Object_Model_Abuse extends Aula_Model_DbTable {
	
	protected $_name = 'object_abuse';
	protected $_primary = 'id';
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $isAbuse = 'No';
	public $approved = 'No';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'object_id', 'user_id', 'alias', 'email', 'description', 'type_id', 'locale_id', 'is_abuse', 'approved', 'date_added', 'comments', 'options' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `object_id`, `user_id`, `alias`, `email`, `description`, `type_id`, `locale_id`, `is_abuse`, `approved`, `comments`, `options` ';
		parent::__construct ();
	}
}