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
 * @package Aula - Core
 * @subpackage Model
 * @name Aula_Model_DbTable
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Aula_Model_DbTable extends Zend_Db_Table_Abstract {
	
	protected $_name = '';
	protected $_cols = array ();
	
	public $_selectQuery = '';
	public $_selectColumnsList = '';
	public $_whereCondition = '';
	public $_whereValue = array ();
	public $_orderBy = array ();
	public $_groupBy = array ();
	public $_having = array ();
	public $_limit = array ();
	public $_extra = '';
	
	public $dbLink = NULL;
	public $cols = array ();
	public $totalRecordsFound = 0;
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
		$this->_selectQuery = 'SELECT ' . $this->_selectColumnsList . ' FROM `' . $this->_name . '` ';
		parent::__construct ();
	}
	
	public function read($whereCondition = '', $whereValue = array ()) {
		$query = $this->_selectQuery;
		$query .= empty ( $whereCondition ) ? '' : ' WHERE ' . $whereCondition;
		$query .= empty ( $this->_extra ) ? '' : ' ' . $this->_extra;
		$query .= empty ( $this->_groupBy ) ? '' : ' GROUP BY ' . $this->_groupBy;
		$query .= empty ( $this->_having ) ? '' : ' HAVING ' . $this->_having;
		$query .= empty ( $this->_orderBy ) ? '' : ' ORDER BY ' . $this->_orderBy;
		$query .= empty ( $this->_limit ) ? '' : ' LIMIT ' . $this->_limit;
		
		$result = $this->dbLink->prepare ( $query, $whereValue );
		if (! $result) {
			return false;
		}
		$this->totalRecordsFound = $this->dbLink->totalRecordsFound ();
		return $result;
	}
	
	public function add($data) {
		$result = $this->dbLink->insert ( $this->_name, $data );
		$lastInertId = $this->dbLink->lastInsertId ();
		if (false == $lastInertId) {
			return false;
		}
		return $lastInertId;
	}
	
	public function edit($data = array(), $where = array()) {
		//$apptId=(int)$apptId;
		//$consent=(bool)$consent;
		//$where=$this->getAdapter()->quoteInto("AppointmentId=?",$apptId);
		//return $this->update(array("ConsentSigned"=>$consent),$where);
		

		$result = $this->dbLink->update ( $this->_name, $data, $where );
		if (! $result) {
			return false;
		}
		return $result;
	}
	
	public function drop($where = array()) {
		$result = $this->dbLink->delete ( $this->_name, $where );
		if (! $result) {
			return false;
		}
		return $result;
	}
	
	public function getAllOrderByColumnWithLimit($column = 'id', $start = 0, $limit = 10, $sorting = 'DESC') {
		if (! in_array ( $column, $this->_cols )) {
			return false;
		}
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$this->_orderBy = "$column $sorting";
		$this->_limit = "$start, $limit";
		$result = $this->read ();
		return $result;
	}
	
	public function getDetailsById($Id) {
		$result = $this->select ( '`id` = ?', array ($Id ) );
		//$result = $this -> find($Id);
		print_r ( $result );
		return $result;
	}

}
