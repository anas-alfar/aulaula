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
 * @package Aula_Banner
 * @subpackage Model
 * @name Banner_Model_Area
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Banner_Model_Area extends Aula_Model_DbTable {
	
	protected $_name = 'banner_area';
	protected $_primary = 'id';
	
	public $id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
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
		$this -> cols = $this -> _cols = array('id', 'title', 'label', 'author_id', 'published', 'approved', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `author_id`, `published`, `approved`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options` ';
		parent::__construct();
	}
	
	public function getAreaById( $id ) 
	{
		$id = (int) $id;
		$result = $this 
		-> select() 
		-> from($this->_name)
		-> where ($this->_name . '.id = ?', $id)
		-> query() 
		-> fetch();

		return $result;
	}
	
}

/*class Banner_Model_Area extends Aula_Model_DbTable {
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $published = 'No';
	public $approved = 'No';
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
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `label`, `published`, `approved`, `author_id`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `publish_from`, `publish_to`, `comments`, `options` ';
		$this -> _name = 'banner_area';
		parent::__construct();
	}

	public function insertIntoBanner_area($Id, $Title, $Label, $Published = 'No', $Approved = 'No', $Author_id = 0, $Comments = '', $Options = '', $Publish_from = '0000-00-00 00:00:00', $Publish_to = '0000-00-00 00:00:00', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {
		$data = array('id' => $Id, 'title' => $Title, 'label' => $Label, 'published' => $Published, 'approved' => $Approved, 'author_id' => $Author_id, 'comments' => $Comments, 'options' => $Options, 'publish_from' => $Publish_from, 'publish_to' => $Publish_to, 'locked_by' => $Locked_by, 'locked_time' => $Locked_time, 'modified_by' => $Modified_by, 'modified_time' => $Modified_time);
		return $this -> insert($data);
	}

	public function deleteFromBanner_areaById($Id) {
		$where = array('`id` = ?' => $Id);
		return $this -> delete($where);
	}

	public function updateBanner_areaById($Id, $Title, $Label, $Published = 'No', $Approved = 'No', $Author_id = 0, $Comments = '', $Options = '', $Publish_from = '0000-00-00 00:00:00', $Publish_to = '0000-00-00 00:00:00', $Locked_by = '0', $Locked_time = '0000-00-00 00:00:00', $Modified_by = '0', $Modified_time = '0000-00-00 00:00:00') {
		$where = array('`id` = ?' => $Id);
		$data = array('title' => $Title, 'label' => $Label, 'published' => $Published, 'approved' => $Approved, 'author_id' => $Author_id, 'comments' => $Comments, 'options' => $Options, 'publish_from' => $Publish_from, 'publish_to' => $Publish_to, 'locked_by' => $Locked_by, 'locked_time' => $Locked_time, 'modified_by' => $Modified_by, 'modified_time' => $Modified_time);
		return $this -> update($data, $where);
	}

	public function GetAllBanner_areaOrderById($sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select();
		return $result;
	}

	public function GetAllBanner_areaOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select();
		return $result;
	}

	public function getBanner_areaDetailsById($Id) {
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaByIdOrderById($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaOrderByTitle($sorting = 'DESC') {
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select();
		return $result;
	}

	public function GetAllBanner_areaOrderByTitleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select();
		return $result;
	}

	public function GetAllBanner_areaByIdOrderByTitle($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaByIdOrderByTitleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaByTitleOrderById($Title, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`title` = ?', array($Title));
		return $result;
	}

	public function GetAllBanner_areaByTitleOrderByIdWithLimit($Title, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`title` = ?', array($Title));
		return $result;
	}

	public function deleteFromBanner_areaByTitle($Title) {
		$where = array('`title` = ?' => $Title);
		return $this -> delete($where);
	}

	public function updateBanner_areaTitleColumnById($Id, $Title) {
		$where = array('`id` = ?' => $Id);
		$data = array('title' => $Title);
		return $this -> update($data, $where);
	}

	public function GetAllBanner_areaOrderByLabel($sorting = 'DESC') {
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select();
		return $result;
	}

	public function GetAllBanner_areaOrderByLabelWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select();
		return $result;
	}

	public function GetAllBanner_areaByIdOrderByLabel($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaByIdOrderByLabelWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}

	public function GetAllBanner_areaByLabelOrderById($Label, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`label` = ?', array($Label));
		return $result;
	}
	
	public function GetAllBanner_areaByLabelOrderByIdWithLimit($Label, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`label` = ?', array($Label));
		return $result;
	}

	public function deleteFromBanner_areaByLabel($Label) {
		$where = array('`label` = ?' => $Label);
		return $this -> delete($where);
	}

	public function updateBanner_areaLabelColumnById($Id, $Label) {
		$where = array('`id` = ?' => $Id);
		$data = array('label' => $Label);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByPublished($sorting = 'DESC') {
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByPublishedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByPublished($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByPublishedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByPublishedOrderById($Published = 'No', $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`published` = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByPublishedOrderByIdWithLimit($Published = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`published` = ?', array($Id));
		return $result;
	}

	public function deleteFromBanner_areaByPublished($Published = 'No') {
		$where = array('`published` = ?' => $Published);
		return $this -> delete($where);
	}

	public function updateBanner_areaPublishedColumnById($Id, $Published = 'No') {
		$where = array('`id` = ?' => $Id);
		$data = array('published' => $Published);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByApproved($sorting = 'DESC') {
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByApprovedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByApproved($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByApprovedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByApprovedOrderById($Approved = 'No', $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`approved = ?', array($Approved));
		return $result;
	}
	
	public function GetAllBanner_areaByApprovedOrderByIdWithLimit($Approved = 'No', $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`approved = ?', array($Approved));
		return $result;
	}

	public function deleteFromBanner_areaByApproved($Approved = 'No') {
		$where = array('`approved` = ?' => $Approved);
		return $this -> delete($where);
	}

	public function updateBanner_areaApprovedColumnById($Id, $Approved = 'No') {
		$where = array('`id` = ?' => $Id);
		$data = array('approved' => $Approved);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByAuthor_id($sorting = 'DESC') {
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByAuthor_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByAuthor_id($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`Author_id` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByAuthor_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByAuthor_idOrderById($Author_id, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`author_id = ?', array($Author_id));
		return $result;
	}
	
	public function GetAllBanner_areaByAuthor_idOrderByIdWithLimit($Author_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`author_id = ?', array($Author_id));
		return $result;
	}

	public function deleteFromBanner_areaByAuthor_id($Author_id) {
		$where = array('`author_id` = ?' => $Author_id);
		return $this -> delete($where);
	}

	public function updateBanner_areaAuthor_idColumnById($Id, $Author_id) {
		$where = array('`id` = ?' => $Id);
		$data = array('author_id' => $Author_id);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByLocked_by($sorting = 'DESC') {
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByLocked_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByLocked_by($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByLocked_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByLocked_byOrderById($Locked_by, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_by = ?', array($Locked_by));
		return $result;
	}
	
	public function GetAllBanner_areaByLocked_byOrderByIdWithLimit($Locked_by, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_by = ?', array($Locked_by));
		return $result;
	}

	public function deleteFromBanner_areaByLocked_by($Locked_by) {
		$where = array('`locked_by` = ?' => $Locked_by);
		return $this -> delete($where);
	}

	public function updateBanner_areaLocked_byColumnById($Id, $Locked_by) {
		$where = array('`id` = ?' => $Id);
		$data = array('locked_by' => $Locked_by);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByLocked_time($sorting = 'DESC') {
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByLocked_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByLocked_time($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByLocked_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByLocked_timeOrderById($Locked_time, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_time = ?', array($Locked_time));
		return $result;
	}
	
	public function GetAllBanner_areaByLocked_timeOrderByIdWithLimit($Locked_time, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_time = ?', array($Locked_time));
		return $result;
	}

	public function deleteFromBanner_areaByLocked_time($Locked_time) {
		$where = array('`locked_time` = ?' => $Locked_time);
		return $this -> delete($where);
	}

	public function updateBanner_areaLocked_timeColumnById($Id, $Locked_time) {
		$where = array('`id` = ?' => $Id);
		$data = array('locked_time' => $Locked_time);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByModified_by($sorting = 'DESC') {
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByModified_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByModified_by($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByModified_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByModified_byOrderById($Modified_by, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_by = ?', array($Modified_by));
		return $result;
	}
	
	public function GetAllBanner_areaByModified_byOrderByIdWithLimit($Modified_by, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_by = ?', array($Modified_by));
		return $result;
	}

	public function deleteFromBanner_areaByModified_by($Modified_by) {
		$where = array('`modified_by` = ?' => $Modified_by);
		return $this -> delete($where);
	}

	public function updateBanner_areaModified_byColumnById($Id, $Modified_by) {
		$where = array('`id` = ?' => $Id);
		$data = array('modified_by' => $Modified_by);
		return $this -> update($data, $where);
	}
	
	public function GetAllBanner_areaOrderByModified_time($sorting = 'DESC') {
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaOrderByModified_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select();
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByModified_time($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	
	public function GetAllBanner_areaByIdOrderByModified_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select('`id = ?', array($Id));
		return $result;
	}
	 
	public function GetAllBanner_areaByModified_timeOrderById($Modified_time, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_time = ?', array($Modified_time));
		return $result;
	}

	public function deleteFromBanner_areaByModified_time($Modified_time) {
		$where = array('`modified_time` = ?' => $Modified_time);
		return $this -> delete($where);
	}

	public function updateBanner_areaModified_timeColumnById($Id, $Modified_time) {
		$where = array('`id` = ?' => $Id);
		$data = array('modified_time' => $Modified_time);
		return $this -> update($data, $where);
	}

	public function deleteFromBanner_areaByPublish_from($Publish_from) {
		$where = array('`publish_from` = ?' => $Publish_from);
		return $this -> delete($where);
	}

	public function updateBanner_areaPublish_fromColumnById($Id, $Publish_from) {
		$where = array('`id` = ?' => $Id);
		$data = array('publish_from' => $Publish_from);
		return $this -> update($data, $where);
	}
	
	public function deleteFromBanner_areaByPublish_to($Publish_to) {
		$where = array('`publish_to` = ?' => $Publish_to);
		return $this -> delete($where);
	}

	public function updateBanner_areaPublish_toColumnById($Id, $Publish_to) {
		$where = array('`id` = ?' => $Id);
		$data = array('publish_to' => $Publish_to);
		return $this -> update($data, $where);
	}

	public function deleteFromBanner_areaByComments($Comments) {
		$where = array('`comments` = ?' => $Comments);
		return $this -> delete($where);
	}

	public function updateBanner_areaCommentsColumnById($Id, $Comments) {
		$where = array('`id` = ?' => $Id);
		$data = array('comments' => $Comments);
		return $this -> update($data, $where);
	}
	
	public function deleteFromBanner_areaByOptions($Options) {
		$where = array('`options` = ?' => $Options);
		return $this -> delete($where);
	}

	public function updateBanner_areaOptionsColumnById($Id, $Options) {
		$where = array('`id` = ?' => $Id);
		$data = array('options' => $Options);
		return $this -> update($data, $where);
	}

}*/
