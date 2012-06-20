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
 * @name Object_Model_Url
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Model_Url extends  Aula_Model_DbTable {

	protected $_name = 'object_url';
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
	public $urlType = 'Link';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 0;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 0;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'alias', 'intro_text', 'url', 'style', 'author_id', 'object_source_id', 'object_id', 'category_id', 'show_in_object', 'published', 'approved', 'url_type', 'order', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `alias`, `intro_text`, `url`, `style`, `author_id`, `object_source_id`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `url_type`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		parent::__construct();
	}

	public function GetListingCleanObjectAndInfoAndUrlByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'ou.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_real_escape_string($Column);
		$sorting = mysql_real_escape_string($sorting);
		$CategoryIds = mysql_real_escape_string($CategoryIds);

		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS ou.`id`, ou.`alias`, ou.`intro_text`, ou.`url`, ou.`style`, 
  ou.`author_id`, ou.`source_id`, ou.`object_id`, ou.`category_id`, ou.`show_in_object`, ou.`published`, ou.`approved`, ou.`url_type`,
  ou.`order`, ou.`locked_by`, ou.`locked_time`, ou.`modified_by`, ou.`modified_time`, ou.`publish_from`, ou.`publish_to`, 
  ou.`date_added`, ou.`comments`, ou.`options`, ou.`publish_to`,
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list` 
FROM   `object_url` AS ou  
INNER JOIN  `object` AS o ON ou.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _groupBy = "ou.`id`";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('ou.`category_id` IN (?) AND ou.`published` = ? AND ou.`approved` = ? ', array($CategoryIds, 'Yes', 'Yes'));
		return $result;

	} //GetListingCleanObjectAndInfoAndVideoByCategoryIdsOrderByColumnWithLimit
	
	public function getAllObject_urlOrderByColumnWithLimit  ( $column ,$sorting, $start, $limit ) {
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_real_escape_string($column);
		$sorting = mysql_real_escape_string($sorting);

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read();
		return $result;
	}
	
	public function getURLById( $id ) 
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
