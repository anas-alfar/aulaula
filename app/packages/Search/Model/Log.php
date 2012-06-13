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
 * @package Search
 * @subpackage Model
 * @name Search_Model_Log
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Search_Model_Log extends Aula_Model_DbTable {
	
	protected $_name = 'search_log';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $columns = null;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $Search_term = '';
	public $Hits = '0';
	
	public function __construct() {
		$this->cols = $this->_cols = $this->columns = array ('search_term', 'hits' );
		$this->_selectColumnsList = ' SQL_CALC_FOUND_ROWS `search_term`, `hits` ';
		parent::__construct ();
	}

}
