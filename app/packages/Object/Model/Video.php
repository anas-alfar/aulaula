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
 * @name Object_Model_Video
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Model_Video extends Aula_Model_DbTable {

	protected $_name = 'object_video';
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
	public $encoded = 'No';
	public $order = 1;
	public $comments = '';
	public $options = 'allowComments=1';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $objectType = 3;
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'alias', 'intro_text', 'author_id', 'object_source_id', 'object_id', 'category_id', 'size', 'height', 'width', 'extension', 'taken_date', 'taken_location', 'meta_data', 'show_in_object', 'published', 'approved', 'encoded', 'order', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `alias`, `intro_text`, `author_id`, `object_source_id`, `object_id`, `category_id`, `size`, `height`, `width`, `extension`, `taken_date`, `taken_location`, `meta_data`, `show_in_object`, `published`, `approved`, `encoded`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		parent::__construct();
	}
		
	public function GetListingCleanObjectAndInfoAndVideoByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'ov.`date_added`', $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$column = mysql_real_escape_string ( $Column );
		$sorting = mysql_real_escape_string ( $sorting );
		$CategoryIds = mysql_real_escape_string ( $CategoryIds );
		
		
		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS ov.`id`, ov.`alias`, ov.`intro_text`, ov.`author_id`, ov.`source_id`, 
  ov.`object_id`, ov.`category_id`, ov.`size`, ov.`height`, ov.`width`, ov.`extension`, ov.`taken_date`, ov.`taken_location`, ov.`meta_data`,
  ov.`show_in_object`, ov.`published`, ov.`approved`, ov.`encoded`, ov.`order`, ov.`locked_by`, ov.`locked_time`, 
  ov.`modified_by`, ov.`modified_time`, ov.`publish_from`, ov.`publish_to`, ov.`date_added`, ov.`comments`, ov.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list` 
FROM   `object_video` AS ov  
INNER JOIN  `object` AS o ON ov.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _groupBy = "ov.`id`";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('ov.`category_id` IN (?) AND ov.`published` = ? AND ov.`approved` = ? ', array($CategoryIds, 'Yes', 'Yes'));
		return $result;
	} //GetListingCleanObjectAndInfoAndVideoByCategoryIdsOrderByColumnWithLimit
	
	public function GetListingCleanObjectAndInfoAndVideoById ($Id) {
		
		$Id = mysql_real_escape_string ( $Id );
		
		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS ov.`id`, ov.`alias`, ov.`intro_text`, ov.`author_id`, ov.`source_id`, 
  ov.`object_id`, ov.`category_id`, ov.`size`, ov.`height`, ov.`width`, ov.`extension`, ov.`taken_date`, ov.`taken_location`, ov.`meta_data`,
  ov.`show_in_object`, ov.`published`, ov.`approved`, ov.`encoded`, ov.`order`, ov.`locked_by`, ov.`locked_time`, 
  ov.`modified_by`, ov.`modified_time`, ov.`publish_from`, ov.`publish_to`, ov.`date_added`, ov.`comments`, ov.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list` 
FROM   `object_video` AS ov  
INNER JOIN  `object` AS o ON ov.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` ';

		$result = $this -> read('ov.`id` = ? AND ov.`published` = ? AND ov.`approved` = ? ', array($Id, 'Yes', 'Yes'));
		return $result;
	} //GetListingCleanObjectAndInfoAndVideoById
	
	public function getAllObject_VideoOrderByColumnWithLimit  ( $column ,$sorting, $start, $limit ) {
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_real_escape_string($column);
		$sorting = mysql_real_escape_string($sorting);

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read();
		return $result;
	}
	
		public function getVideoById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner('object', $this->_name . '.object_id=object.id',array('*'))
		//-> joinInner('object_photo', 'object_photo.object_id=object.id',array('*'))
		-> joinInner('object_info', 'object_info.object_id=object.id',array('*'))
		-> where ($this->_name . '.id = ?', $id)
		-> setIntegrityCheck(false)
		-> query() 
		-> fetch();

		return $result;
	}
}