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
 * @package Aula_Menu
 * @subpackage Model
 * @name Menu_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Menu_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'menu';
	protected $_primary = 'id';
	
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $parentId = 0;
	public $packageId = 1;
	public $subLevel = 0;
	public $published = 'No';
	public $approved = 'No';
	public $order = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';

	public function __construct() {
		$this -> cols = $this -> _cols = array ('id', 'label', 'link', 'type_id', 'parent_id', 'package_id', 'sublevel', 'published', 'approved', 'order', 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `label`, `link`, `type_id`, `parent_id`, `package_id`, `sublevel`, `published`, `approved`, `order`, `date_added` ';
		parent::__construct();
	}
	
	public function getCleanMenuAndMenu_infoAndMenu_typeOrderByColumn($column = '`id`', $sorting = 'DESC') {
		$column = '`m`.' . $column;
		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS  m.`id`,  m.`label`, m.`link`, m.`menu_type_id` AS `type_id`, m.`parent_id`, 
							m.`package_id`,	m.`sublevel`,m.`published`,m.`approved`,m.`order`,m.`date_added`,
							mi.`menu_id`, mi.`locked_by`, mi.`locked_by`,mi.`locked_time`, mi.`modified_by`,mi.`modified_time`,
							mi.`publish_from`, mi.`publish_to`, mi.`date_added`, mi.`comments`, mi.`options`,
							mt.`title` AS `type_title`, mt.`label` AS `type_label`, mt.`description`, mt.`author_id`, mt.`published`,mt.`approved`
							FROM  `menu` AS `m`
							INNER JOIN  `menu_info` AS mi ON mi.`menu_id` = m.`id`
							INNER JOIN  `menu_type` AS mt ON m.`menu_type_id` = mt.`id`';
		
		$this -> _orderBy = "$column $sorting";
		$result = $this -> read('`m`.`published` = ? AND `m`.`approved` = ?', array('Yes', 'Yes'));
		return $result;
	}
	
	public function getAllMenuAndMenu_infoAndMenu_typeOrderByColumn($column = '`id`', $sorting = 'DESC', $start = 0, $limit = 10) {
		if ($column == 'type_id') {
			$column = '`m`.menu_type_id';
		} else {
			$column = '`m`.' . $column;	
		}

		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS  m.`id`,  m.`label`, m.`link`, m.`menu_type_id` AS `type_id`, m.`parent_id`, 
							m.`package_id`,	m.`sublevel`,m.`published`,m.`approved`,m.`order`,m.`date_added`, m.`published`,m.`approved`,
							mi.`menu_id`, mi.`locked_by`, mi.`locked_by`,mi.`locked_time`, mi.`modified_by`,mi.`modified_time`,
							mi.`publish_from`, mi.`publish_to`, mi.`date_added`, mi.`comments`, mi.`options`,
							mt.`title` AS `type_title`, mt.`label` AS `type_label`, mt.`description`, mt.`author_id`
							FROM  `menu` AS `m`
							INNER JOIN  `menu_info` AS mi ON mi.`menu_id` = m.`id`
							INNER JOIN  `menu_type` AS mt ON m.`menu_type_id` = mt.`id`';
		$this -> _orderBy = "$column $sorting";
		$result = $this -> read();
		return $result;
	}
	
	public function getMenuAndMenu_infoOrderByColumnWithLimit($column = '`id`', $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$column = '`m`.' . $column;
		$this -> _selectQuery = 'SELECT   SQL_CALC_FOUND_ROWS  m.`id`,  m.`label`, m.`link`, m.`menu_type_id` AS `type_id`, m.`parent_id`, 
							m.`package_id`,	m.`sublevel`,m.`published`,m.`approved`,m.`order`,m.`date_added`,
							mi.`menu_id`, mi.`locked_by`, mi.`locked_by`,mi.`locked_time`, mi.`modified_by`,mi.`modified_time`,
							mi.`publish_from`, mi.`publish_to`, mi.`date_added`, mi.`comments`, mi.`options`
							FROM   `menu` AS m
							INNER JOIN  `menu_info` AS mi ON mi.`menu_id` = m.`id`';

		$this -> _orderBy = "$column $sorting";
		$this -> _limit = "$start, $limit";
		$result = $this -> read('`m`.`published` = ? AND `m`.`approved` = ?', array('Yes', 'Yes'));
		return $result;
	}
	
	public function getmenuById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> joinInner('menu_info', $this->_name . '.id=menu_info.menu_id',array('menu_info.*'))
		-> joinInner('menu_type', $this->_name . '.menu_type_id=menu_type.id',array('menu_type.title as menu_type_title', 'menu_type.label as menu_type_label', 'menu_type.description as menu_type_description'))
		-> setIntegrityCheck(false)
		-> where ($this->_name . '.id = ?', $id)
		-> query() 
		-> fetch();

		return $result;
	}


}