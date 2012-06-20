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
 * @package Translation
 * @subpackage Model
 * @name Translation_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 
class Translation_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'translation';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $comments = '';
	public $options = '';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'label', 'translation', 'locale_id', 'hash_key', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `label`, `translation`, `locale_id`, `hash_key`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments` ';
		parent::__construct();
	}
	
	public function getAllTranslation_OrderByColumnWithLimit( $column, $sorting, $start, $limit ) 
	{
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_real_escape_string($column);
		$sorting = mysql_real_escape_string($sorting);
		
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> order("$column $sorting") 
		-> limit("$start, $limit") 
		-> query() 
		-> fetchAll();

		return $result;
	}

	public function getAllTranslationByHashkey( $hash_key ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))
		-> where ('hash_key = ?', $hash_key )
		-> query()
		-> fetchAll();

		return $result;
	}

	
	public function getAllTranslation( ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> query() 
		-> fetchAll();

		return $result;
	}
	
	public function getTranslationById( $id ) 
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
