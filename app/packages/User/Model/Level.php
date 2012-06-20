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
 * @name User_Model_Level
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class User_Model_Level extends Aula_Model_DbTable {
	
	protected $_name = 'user_level';
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
	
	public function __construct() {
		$this->cols = $this->_cols = array ('id', 'title', 'label', 'description', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments', 'options' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `description`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options` ';
		parent::__construct ();
	}
	
	public function getAllUser_levelOrderByColumnWithLimit($column, $sorting, $start, $limit) {
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$column = mysql_real_escape_string ( $column );
		$sorting = mysql_real_escape_string ( $sorting );
		
		$this->_orderBy = "$column $sorting";
		$this->_limit = "$start, $limit";
		$result = $this->read ();
		return $result;
	}

}
