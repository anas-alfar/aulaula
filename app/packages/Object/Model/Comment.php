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
 * @name Object_Model_Comment
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 
class Object_Model_Comment extends Aula_Model_DbTable {

	protected $_name = 'object_comment';
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
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	private $_2weeksEarlier = '';
	private $_4weeksEarlier = '';

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'object_id', 'user_id', 'title', 'content', 'email', 'webpage', 'locale_id', 'country_id', 'published', 'approved', 'comments', 'options' , 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `object_id`, `user_id`, `title`, `content`, `email`, `webpage`, `locale_id`, `country_id`, `published`, `approved`, `comments`, `options`,`date_added` ';
		parent::__construct();
		$this -> _2weeksEarlier = date('Y-m-d', (time() - 1209600));
		$this -> _4weeksEarlier = date('Y-m-d', (time() - 2419200));
	}

	public function GetAllObject_commentOrderByColumnWithLimit($column = 'date_added', $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$categoryId = (int)($categoryId);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);
		if (in_array($column, $this -> _cols)) {
			$column = 'oc.' . $column;
		} else {
			$column = 'o.' . $column;
		}

		$this -> _selectQuery = 'SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id` 
FROM `object_comment` AS oc 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oc.`date_added` > ?', array('2010-07-15'));
		return $result;
	}//End Function GetAllObject_commentOrderByColumnWithLimit

	/**
	 * This Method is Script Generated
	 * GetAllObject_commentByCategoryListOrderByColumnWithLimit
	 * Generated Date: 2010-04-26 02:08:47
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article($categoryId, $special_article = false, $column = 'date_added', $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$categoryId = (int)($categoryId);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);
		$special_article = ( bool )($special_article);

		$sorting = mysql_escape_string($sorting);
		/*if ($special_article === True) {
			$special_article_condition = 'IN';
		} else {
			$special_article_condition = 'NOT IN';
		}*/

		if (in_array($column, $this -> _cols)) {
			$column = 'oc.' . $column;
		} else {
			$column = 'o.' . $column;
		}

		$this -> _selectQuery = 'SELECT straight_join SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id` 
FROM `object_comment` AS oc INNER JOIN `object` AS o ON o.`id` = oc.`object_id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('oc.`date_added` > ? AND o.`category_id` IN (?) AND oc.`date_added` > ?', array('2010-07-15', $categoryId, $this -> _4weeksEarlier));
		return $result;
	}//End Function GetAllObject_commentByCategoryListOrderByColumnWithLimitAndSpecial_article

	public function GetAllObject_commentOrderByColumnWithLimitAndSpecial_article($column = 'date_added', $special_article = false, $start = 0, $limit = 10, $sorting = 'DESC') {

		$start = (int)($start);
		$limit = (int)($limit);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);
		$special_article = ( bool )($special_article);

		$sorting = mysql_escape_string($sorting);
		if ($special_article === True) {
			$this -> _selectQuery = 'SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
INNER JOIN `object_article_special` oas on (oas.object_id = oc.`object_id`)';

			if (in_array($column, $this -> _cols)) {
				$column = 'oc.' . $column;
			} else {
				$column = 'o.' . $column;
			}
			$this -> _orderBy = "$column $sorting";
			$this -> _limit = "$start, $limit";
			$result = $this -> read('oc.`date_added` > ? ', array($this -> _4weeksEarlier));
			return $result;
		} else {
			$this -> _selectQuery = 'SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc FORCE INDEX(date_id_idx) 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
left join `object_article_special` oas on oas.object_id = oc.`object_id`';

			if (in_array($column, $this -> _cols)) {
				$column = 'oc.' . $column;
			} else {
				$column = 'o.' . $column;
			}
			$this -> _orderBy = "$column $sorting";
			$this -> _limit = "$start, $limit";
			$result = $this -> read('oc.`date_added` > ? AND oas.object_id is null', array($this -> _4weeksEarlier));
			return $result;
		}
	}//End Function GetAllObject_commentOrderByColumnWithLimitAndSpecial_article

	/**
	 * This Method is Script Generated
	 * GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article
	 * Generated Date: 2010-04-26 02:08:47
	 * Author: Anas K. Al-Far
	 * Copyright: anas@alfar.com
	 * Copyright: http://anas.al-far.com/
	 */
	public function GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article($Column = 'oc.date_added', $Special_article = false, $start = 0, $limit = 10, $sorting = 'DESC', $webpage = NULL, $email = NULL, $articleTitle = NULL, $userId = NULL, $content = NULL, $published = NULL, $approved = NULL, $dateAddedFrom = NULL, $dateAddedTo = NULL, $categoryList = NULL) {
		$searchCondition = '';
		if ($webpage !== NULL) {
			$webpage = mysql_escape_string($webpage);
			$searchCondition .= 'oc.`webpage` LIKE "%' . $webpage . '%" AND ';
		}
		if ($email !== NULL) {
			$email = mysql_escape_string($email);
			$and = ' AND ';
			$searchCondition .= ' oc.`email` LIKE "%' . $email . '%" AND ';
		}
		if ($articleTitle !== NULL) {
			$articleTitle = mysql_escape_string($articleTitle);
			$searchCondition .= ' o.`title` LIKE "%' . $articleTitle . '%" AND ';
		}
		if ($userId !== NULL) {
			$userId = mysql_escape_string($userId);
			$searchCondition .= ' oc.`user_id` LIKE "%' . $userId . '%" AND ';
		}
		if ($content !== NULL) {
			$content = mysql_escape_string($content);
			$searchCondition .= ' oc.`content` LIKE "%' . $content . '%" AND ';
		}
		if ($published !== NULL) {
			$published = mysql_escape_string($published);
			$searchCondition .= ' oc.`published`="' . $published . '" AND ';
		}
		if ($categoryList !== NULL) {
			$searchCondition .= ' o.`category_id` IN (' . $categoryList . ') AND ';
		}
		if ($dateAddedFrom !== NULL && $dateAddedTo !== NULL) {
			$dateAddedFrom = mysql_escape_string($dateAddedFrom);
			$dateAddedTo = mysql_escape_string($dateAddedTo);
			$searchCondition .= ' oc.`date_added`> "' . $dateAddedFrom . '" AND  oc.`date_added`< "' . $dateAddedTo . '" AND ';
		}/*else {
		 $_last10DaysTime = time () - (60 * 60 * 24 * 10);
		 $_last10DaysDate = date ( 'Y-m-d', $_last10DaysTime );
		 $searchCondition .= ' oc.`date_added` > "' . $_last10DaysDate . '" AND ';
		 } */

		$searchCondition = substr($searchCondition, 0, -4);
		$Column = mysql_escape_string($Column);
		$start = ( int )($start);
		$limit = ( int )($limit);
		$sorting = mysql_escape_string($sorting);
		$Special_article = ( bool )($Special_article);
		if ($Special_article === True) {
			$this -> _selectQuery = 'SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
INNER JOIN `object_article_special` oas on (oas.object_id = oc.`object_id`)';

			$this -> _orderBy = "$Column $sorting";
			$this -> _limit = "$start, $limit";
			$result = $this -> read(" $searchCondition ");
			return $result;
		} else {
			$this -> _selectQuery = 'SELECT SQL_CALC_FOUND_ROWS oc.`id`, oc.`object_id`, oc.`user_id`, oc.`title`, oc.`content`, oc.`email`, oc.`webpage`, oc.`locale_id`, oc.`country_id`, oc.`published`, oc.`approved`, oc.`date_added`, oc.`comments`, oc.`options`, o.`title` AS `article_title`, o.`author_id`
FROM `object_comment` AS oc FORCE INDEX(date_id_idx) 
INNER JOIN `object` AS o ON o.`id` = oc.`object_id`
left join `object_article_special` oas on oas.object_id = oc.`object_id`';

			$this -> _orderBy = "$Column $sorting";
			$this -> _limit = "$start, $limit";
			$result = $this -> read(" $searchCondition AND oas.object_id is null");
			return $result;
		}
	} //End Function GetAllObject_commentBySearchOrderByColumnWithLimitAndSpecial_article

}
