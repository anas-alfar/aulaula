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
 * @package Aula_Category
 * @subpackage Model
 * @name Category_Model_TypeInfo
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Category_Model_TypeInfo extends Aula_Model_DbTable {
	
	protected $_name = 'category_type_info';
	protected $_primary = 'id';
	
	public $Id = NULL;
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $directCatCount = 0;
	public $indirectCatCount = 0;
	public $comments = '';
	public $options = '';
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'category_type_id', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'direct_cat_count', 'indirect_cat_count', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `category_type_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `direct_cat_count`, `indirect_cat_count`, `date_added`, `comments`, `options` ';
		$this -> _name = 'category_type_info';
		parent::__construct();
	}
}
