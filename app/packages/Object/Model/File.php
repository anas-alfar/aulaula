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
 * @package Object
 * @subpackage Model
 * @name Object_Model_File
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Model_File extends Aula_Model_DbTable {

	protected $_name = 'object_file';
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
	public $order = 1;
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $size = 0;
	public $mime = 'file/unknown';
	public $extension = 'dummy';
	public $fullPath = '/';
	public $objectId = 0;
	public $objectType = 2;
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'name', 'label', 'description', 'object_directory_id', 'author_id', 'mime_type', 'size', 'extension', 'full_path', 'object_id', 'category_id', 'show_in_object', 'published', 'approved', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `name`, `label`, `description`, `object_directory_id`, `author_id`, `mime_type`, `size`, `extension`, `full_path`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options` ';
		parent::__construct(); 
	}

	/**
	 * This Method is Script Generated 
	 * GetAllCleanObjectAndInfoAndFileByCategoryIdsOrderByColumnWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllCleanObjectAndInfoAndFileByCategoryIdsOrderByColumnWithLimit($categoryId, $column, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$categoryId= (int) ( $categoryId );
		$sorting = mysql_escape_string ( $sorting );
		$column = mysql_escape_string ( $column );
		if (in_array($column, $this->_cols)) {
			$column = 'of.' . $column;
		} else {
			$column = 'o.' . $column;
		}
		
		$this -> _selectQuery = 'SELECT 	SQL_CALC_FOUND_ROWS of.`id`, of.`name`, of.`label`, of.`description`, of.`folder_id`, of.`author_id`, of.`mime_type`, of.`size`, of.`extension`, of.`full_path`, of.`object_id`, of.`category_id`, of.`show_in_object`, of.`published`, of.`approved`, of.`locked_by`, of.`locked_time`, of.`modified_by`, of.`modified_time`, of.`date_added`, of.`comments`, of.`options`,
					oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  					oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  					o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  					o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list` 
					FROM 		`object_file` AS of
					INNER JOIN  `object` AS o ON of.`object_id` = o.`id` 
					INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('`of`.`published` = ? AND `of`.`approved` = ? AND of.`category_id` = ?', array('Yes', 'Yes' , $categoryId));
		return $result;
	} //End Function GetAllCleanObjectAndInfoAndFileByCategoryIdsOrderByColumnWithLimit
	
	public function getAllFile_urlOrderByColumnWithLimit  ( $column ,$sorting, $start, $limit ) {
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);

		$result = $this 
		-> select() 
		-> from($this->_name, new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'))
		-> order("$column $sorting") 
		-> limit("$start, $limit") 
		-> query() 
		-> fetchAll();
		
		return $result;
	}
	
	public function getFileById( $id ) 
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