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
 * @name Object_Model_Article
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 
class Object_Model_Article extends Aula_Model_DbTable {

	protected $_name = 'object_article';
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
	public $order = 1;
	public $comments = '';
	public $options = "allowComments=1\r\nspecialArticle=0";
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $lockedBy = 1;
	public $lockedTime = '0000-00-00';
	public $modifiedBy = 1;
	public $modifiedTime = '0000-00-00';
	public $publishFrom = '0000-00-00';
	public $publishTo = '0000-00-00';
	public $objectType = 1;

	private $_2weeksEarlier = '';
	private $_4weeksEarlier = '';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'alias', 'intro_text', 'full_text', 'created_date', 'author_id', 'source_id', 'object_id', 'category_id', 'show_in_object', 'published', 'approved', 'order', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'publish_from', 'publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `alias`, `intro_text`, `full_text`, `created_date`, `author_id`, `source_id`, `object_id`, `category_id`, `show_in_object`, `published`, `approved`, `order`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `publish_from`, `publish_to`, `date_added`, `comments`, `options` ';
		parent::__construct();
		$this -> _2weeksEarlier = date('Y-m-d', (time() - 1209600));
		$this -> _4weeksEarlier = date('Y-m-d', (time() - 2419200));
	}

	public function GetCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$CategoryIds = mysql_escape_string($CategoryIds);

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  op.`id` AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id` ";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oa.`category_id` IN (?) AND oa.`published` = ? AND oa.`approved` = ? ', array($CategoryIds, 'Yes', 'Yes'));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit

	public function GetListingCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$CategoryIds = mysql_escape_string($CategoryIds);

		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list` 
FROM   `object_article` AS oa  
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`category_id` IN (?) AND oa.`published` = ? AND oa.`approved` = ? ', array($CategoryIds, 'Yes', 'Yes'));
		return $result;
	}//GetListingCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit

	public function GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit($CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$CategoryIds = mysql_escape_string($CategoryIds);

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`category_id` IN (?) AND oa.`published` = ? AND oa.`approved` = ? AND oa.`date_added` > ? ', array($CategoryIds, 'Yes', 'Yes', $this -> _2weeksEarlier));
		return $result;
	}//End Function GetHPCleanObjectAndInfoAndArticleByCategoryIdsOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleByKeywordOrderByColumnWithLimit($Keyword, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$Keyword = mysql_escape_string($Keyword);

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  op.`id` AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('(o.`title` LIKE "%?%" OR oa.`alias` LIKE "%?%" ) AND oa.`published` = ? AND oa.`approved` = ?', array($Keyword, $Keyword, 'Yes', 'Yes'));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleByKeywordOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleBySubCategoryIdsOrderByColumnWithLimit($SubCategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$SubCategoryIds = mysql_escape_string($SubCategoryIds);

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('o.`category_id` IN (?) AND oa.`published` = ? AND oa.`approved` = ?', array($SubCategoryIds, 'Yes', 'Yes' ));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleBySubCategoryIdsOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$featureList = mysql_escape_string($featureList);
		$CategoryIds = mysql_escape_string($CategoryIds);

		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`category_id` IN (?) ? AND oa.`published` = ? AND oa.`approved` = ?', array($CategoryIds , $featureCondition, 'Yes', 'Yes' ));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$featureList = mysql_escape_string($featureList);
		$CategoryIds = mysql_escape_string($CategoryIds);

		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa $forceIndex
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
Left JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`category_id` IN (?) ? AND oa.`published` = ? AND oa.`approved` = ?', array($CategoryIds , $featureCondition, 'Yes', 'Yes' ));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleBySubCategoryIdsAndNotFeatureOrderByColumnWithLimit($featureList, $SubCategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$Column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$featureList = mysql_escape_string($featureList);
		$SubCategoryIds = mysql_escape_string($SubCategoryIds);

		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}

		$forceIndex = '';
		if ($Column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('o.`category_id` IN (?) ? AND oa.`published` = ? AND oa.`approved` = ?', array($SubCategoryIds , $featureCondition, 'Yes', 'Yes' ));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleBySubCategoryIdsAndNotFeatureOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit($IdsList, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$IdsList = mysql_escape_string($IdsList);

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		if ($limit == 1) {
			$forceIndex = '';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`id` AS `object_info_id`, oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`id` IN (?)  AND oa.`published` = ? AND oa.`approved` = ?', array($IdsList , 'Yes', 'Yes' ));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit

	public function GetHPCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit($IdsList, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$IdsList = mysql_escape_string($IdsList);

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc` 
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
INNER JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`id` IN (?)  AND oa.`published` = ? AND oa.`approved` = ? AND oa.`date_added` > ? ', array($IdsList , 'Yes', 'Yes' , $this->_2weeksEarlier));
		return $result;
	}//End Function GetHPCleanObjectAndInfoAndArticleByIdsListOrderByColumnWithLimit

	public function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$featureList = mysql_escape_string($featureList);
		$CategoryIds = mysql_escape_string($CategoryIds);

		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
Left JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`category_id` IN (?) ?  AND oa.`published` = ? AND oa.`approved` = ? AND oa.`date_added` > ? ', array($CategoryIds  , $featureCondition , 'Yes', 'Yes' , $this->_2weeksEarlier));
		return $result;
	}//End Function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderWoPhotoByColumnWithLimit

	public function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit($featureList, $CategoryIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$featureList = mysql_escape_string($featureList);
		$CategoryIds = mysql_escape_string($CategoryIds);

		if (empty($featureList)) {
			$featureCondition = '';
		} else {
			$featureList = str_replace(',', ' AND oa.`id` != ', $featureList);
			$featureCondition = 'AND (oa.`id` != ' . $featureList . ') ';
		}

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`, 
  MAX(op.`id`) AS `photo_id`, op.`alias` AS `photo_alias`, op.`date_added` AS `photo_date_added`, op.`intro_text` AS `photo_desc`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id` 
Left JOIN  `object_photo` AS op ON op.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$this -> _groupBy = "oa.`id`";
		$result = $this -> read('oa.`category_id` IN (?) ?  AND oa.`published` = ? AND oa.`approved` = ? AND oa.`date_added` > ? ', array($CategoryIds  , $featureCondition , 'Yes', 'Yes' , $this->_2weeksEarlier));
		return $result;
	}//End Function GetHPCleanObjectAndInfoAndArticleByCategoryIdsAndNotFeatureOrderByColumnWithLimit

	public function GetCleanObjectAndInfoAndArticleByIdsListWoPhotoOrderByColumnWithLimit($IdsList, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$IdsList = mysql_escape_string($IdsList);

		$forceIndex = '';
		if ($column == 'oa.`date_added`') {
			$forceIndex = ' FORCE INDEX (date_id_idx) ';
		}

		if ($limit == 1) {
			$forceIndex = '';
		}

			$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`id` AS `object_info_id`, oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa $forceIndex 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oa.`id` IN (?)  AND oa.`published` = ? AND oa.`approved` = ? ', array($CategoryIds , 'Yes', 'Yes'));
		return $result;
	}//End Function GetCleanObjectAndInfoAndArticleByIdsListWoPhotoOrderByColumnWithLimit

	public function GetLatestCleanObjectAndInfoAndArticleWoPhotoOrderByColumnWithLimit($start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx)
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oa.`date_added` > ?  AND oa.`published` = ? AND oa.`approved` = ? ', array($this->_2weeksEarlier , 'Yes', 'Yes'));
		return $result;
	}//End Function GetLatestCleanObjectAndInfoAndArticleWoPhotoOrderByColumnWithLimit

	public function GetLatestObjectAndrticleAndInfoByAuthor_idOrderByColumnWithLimit($Author_id, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$Author_id = ( int )($Author_id);
		$sorting = mysql_escape_string($sorting);
		$column = mysql_escape_string($Column);

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oa.`date_added` > ?  AND oa.`published` = ? AND oa.`approved` = ? AND oa.`author_id` = ? ', array($this->_2weeksEarlier , 'Yes', 'Yes' , $Author_id));
		return $result;
	}//End Function GetLatestObjectAndrticleAndInfoByAuthor_idOrderByColumnWithLimit

	public function GetLatestObjectAndrticleAndInfoOrderByColumnWithLimit($start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$Author_id = ( int )($Author_id);
		$sorting = mysql_escape_string($sorting);
		$column = mysql_escape_string($Column);

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`intro_text`, oa.`full_text`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oa.`date_added` > ?  AND oa.`published` = ? AND oa.`approved` = ? AND oa.`author_id` = ? ', array($this->_2weeksEarlier , 'Yes', 'Yes' , $Author_id));
		return $result;
	}//End Function GetLatestObjectAndrticleAndInfoOrderByColumnWithLimit

	public function GetListingCleanObjectAndInfoAndArticleByUserIdsOrderByColumnWithLimit($UserIds, $start = 0, $limit = 10, $Column = 'oa.`date_added`', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$UserIds = mysql_escape_string($UserIds);

		$this -> _selectQuery = "SELECT   SQL_CALC_FOUND_ROWS oa.`id`, oa.`alias`, oa.`created_date`, oa.`author_id`, oa.`source_id`, 
  oa.`object_id`, oa.`category_id`, oa.`show_in_object`, oa.`published`, oa.`approved`, oa.`order`, oa.`locked_by`, oa.`locked_time`, 
  oa.`modified_by`, oa.`modified_time`, oa.`publish_from`, oa.`publish_to`, oa.`date_added`, oa.`comments`, oa.`options`, 
  oi.`total_views`, oi.`total_comments`, oi.`total_rating`, oi.`layout_id`, oi.`template_id`, oi.`skin_id`, oi.`theme_publish_from`, 
  oi.`theme_publish_to`, o.`title`, o.`created_date`, o.`author_id`, o.`source_id`,  o.`tags`, o.`page_title`, 
  o.`meta_title`, o.`meta_key`, o.`meta_desc`, o.`meta_data`, o.`type_id`, o.`category_id` AS `sub_category`, 
  o.`locale_id`, o.`guid_url`, o.`original_author`, o.`parent_id`, o.`show_in_list`  
FROM   `object_article` AS oa FORCE INDEX (date_id_idx) 
INNER JOIN  `object` AS o ON oa.`object_id` = o.`id` 
INNER JOIN  `object_info` AS oi ON oi.`object_id` = o.`id`";

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('o.`original_author` = ?  AND oa.`published` = ? AND oa.`approved` = ? ',
		 array($UserIds , 'Yes', 'Yes' ));
		return $result;
	}//GetListingCleanObjectAndInfoAndArticleByUserIdsOrderByColumnWithLimit
	
	public function getArticleById( $id ) 
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
	
	public function getAllArticle_OrderByColumnWithLimit ( $column ,$sorting, $start, $limit ) {
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

}
