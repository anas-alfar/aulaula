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
 * in the future. If you wish to customize Magento for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Aula_Estate
 * @subpackage Model
 * @name Estate_Model_OutdoorAmenities
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 
class Estate_Model_OutdoorAmenities extends Aula_Model_DbTable {

	protected $_name = 'estate_outdoor_amenities';
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
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'title', 'description', 'locale_id', 'hash_key', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `description`, `locale_id`, `hash_key`, `date_added`, `comments`, `options`';
		parent::__construct();
	}
	
	public function getAllOutdoorAmenities_OrderByColumnWithLimit( $column, $sorting, $start, $limit ) 
	{
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);
		
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> order("$column $sorting") 
		-> limit("$start, $limit") 
		-> query() 
		-> fetchAll();

		return $result;
	}
	
	public function getAllOutdoorAmenities( ) 
	{
		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))/* ->    where ('id > ?', 1)*/ 
		-> query() 
		-> fetchAll();

		return $result;
	}
	
	public function getOutdoorAmenitiesById( $id ) 
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
