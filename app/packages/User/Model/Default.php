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
 * @package User
 * @subpackage Model
 * @name User_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class User_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'user';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $userLevelId = 1;
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'username', 'password', 'fullname', 'email', 'user_level_id', 'date_added' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `username`, `password`, `fullname`, `email`, `user_level_id`, `date_added` ';
		parent::__construct ();
	}
	
	public function getUserAndUser_infoOrderByColumnWithLimit($column = '`id`', $sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		$column = mysql_escape_string ( $column );
		if (in_array ( $column, $this->_cols )) {
			$column = 'u.' . $column;
		} else {
			$column = 'ui.' . $column;
		}
		
		$this->_selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS  u.`id`,u.`username`, u.`fullname`, u.`email`,u.`user_level_id`, 
							u.`date_added` , ui.`blocked`,ui.`approved`,ui.`confirmed`
							FROM   `' . $this->_name . '` AS u
							INNER JOIN  `' . $this->_name . '_info` AS ui ON ui.`user_id` = u.`id`';
		
		$this->_orderBy = "$column $sorting";
		$this->_limit = "$start, $limit";
		$result = $this->read ();
		return $result;
	
	}

}
