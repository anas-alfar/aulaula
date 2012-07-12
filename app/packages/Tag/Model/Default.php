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
 * @package Tag
 * @subpackage Model
 * @name Tag_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Tag_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'tag';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	
	public function __construct() {
		$this->cols = $this->_cols = $this->columns = array ('id', 'title', 'locale_id', 'published', 'approved', 'order', 'date_added', 'comments', 'date_added' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `locale_id`, `published`, `approved`, `order`, `date_added`, `comments`,`date_added` ';
		parent::__construct ();
	}
	
	public function getAllTagsOrderByColumnWithLimit($column, $sorting, $start, $limit) {
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$column = mysql_escape_string ( $column );
		$sorting = mysql_escape_string ( $sorting );
		
		$this->_orderBy = "$column $sorting";
		$this->_limit = "$start, $limit";
		$result = $this->read ();
		return $result;
	}
}