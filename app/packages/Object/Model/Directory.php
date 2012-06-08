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
 * @package Aula_Object
 * @subpackage Model
 * @name Object_Model_Directory
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Model_Directory extends Aula_Model_DbTable {

	protected $_name = 'object_directory';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $showInObject = 'Yes';
	public $published = 'No';
	public $approved = 'No';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $size = 0;
	public $filesCount = 0;
	public $fullPath = '/';
	public $parentId = 0;
	public $objectId = 0;

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'name', 'label', 'description', 'parent_id', 'author_id', 'size', 'files_count', 'full_path', 'object_id', 'category_id', 'show_in_object', 'published', 'approved', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'comments', 'options' , 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `name`, `label`, `description`, `parent_id`, `author_id`, `size`, `files_count`, `full_path`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `comments`, `options` ,`date_added` ';
		parent::__construct();
	}
	
	public function getDirectoryById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner('object', $this->_name . '.object_id=object.id',array('*'))
		-> joinInner('object_info', 'object_info.object_id=object.id',array('*'))
		-> where ($this->_name . '.id = ?', $id)
		-> setIntegrityCheck(false)
		-> query() 
		-> fetch();

		return $result;
	}

}