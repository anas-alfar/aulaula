<?php

/**
 * 
 * Aulaula
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the file LICENSE.txt. It is also available through
 * the world-wide-web at this URL: http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@aulaula.com
 * so we can send you a copy immediately.
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Aulaula to newer versions
 * in the future. If you wish to customize Aulaula for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Configs
 * @subpackage Model
 * @name Configs_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 
class Configs_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'configs';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'group_id', 'group_key', 'option_title', 'option_hint', 'option_description', 'option_value', 'locale_id', 'permission_level_id', 'option_status', 'date_added', 'comments');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `group_id`, `group_key`, `option_title`, `option_hint`, `option_description`, `option_value`, `locale_id`, `permission_level_id`, `option_status`, `date_added`, `comments`';
		parent::__construct();
	}
	
	public function getAllConfigs_OrderByColumnWithLimit( $column, $sorting, $start, $limit ) 
	{
		$start  = $this -> getAdapter() -> quote($start, 'INTEGER');
		$limit  = $this -> getAdapter() -> quote($limit, 'INTEGER');

		//$column = $this -> getAdapter() -> quote($column);
		//$sorting= $this -> getAdapter() -> quote($sorting);
		//echo $orderBy = $this -> getAdapter() -> quote($column . ' ' . $sorting);

		//$sql = 'SELECT * FROM '. $this->_name .' WHERE intColumn = '
     	//. $db->quote($value, 'INTEGER');
		
		$this -> _orderBy = $column . ' ' . $sorting;
		$this -> _limit = "$start, $limit";
		$result = $this -> read();
		return $result;
		
		/*$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *')) 
		-> order($orderBy) 
		-> limit($start, $limit) 
		-> query() 
		-> fetchAll();*/

		return $result;
	}
	
	public function getAllConfigs( ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))
		-> group('group_key') 
		-> query() 
		-> fetchAll();

		return $result;
	}
	
	public function getMaxGroupId() {
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('max(group_id) as group_id'))
		-> query() 
		-> fetch();

		return $result;
	}
	
	public function getConfigById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner('locale', $this->_name . '.locale_id=locale.id',array('title as locale_title'))
		-> where ($this->_name . '.id = ?', $id)
		-> setIntegrityCheck(false)
		-> query() 
		-> fetch();

		return $result;
	}

}
