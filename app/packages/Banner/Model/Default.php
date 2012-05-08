<?php

class Banner_Model_Default extends Aula_Model_DbTable {
	
	protected $_name = 'banner';
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
		
		$this -> cols = $this -> _cols = array('id', 'banner_area_id', 'title', 'label', 'type', 'mime_type', 'size', 'extension', 'source', 'target', 'author_id', 'published', 'approved', 'locked_by', 'locked_time', 'modified_by', 'modified_time', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `banner_area_id`, `title`, `label`, `type`, `mime_type`, `size`, `extension`, `source`, `target`, `author_id`, `published`, `approved`, `locked_by`, `locked_time`, `modified_by`, `modified_time`, `date_added`, `comments`, `options` ';
		parent::__construct();
	}

	/*public function insertIntoBanner($Id, $Area_id, $Title, $Label, $Type = "image file", $Mime_type = "", $Size = "", $Extension = "", $Full_path = "", $Link = "", $Published = "No", $Approved = "No", $Author_id = 0, $Comments = "", $Options = "", $Publish_from = "0000-00-00 00:00:00", $Publish_to = "0000-00-00 00:00:00", $Locked_by = 0, $Locked_time = "0000-00-00 00:00:00", $Modified_by = 0, $Modified_time = "0000-00-00 00:00:00") {
		$data = array('id' => $Id, 'area_id' => $Area_id, 'title' => $Title, 'label' => $Label, 'type' => $Type, 'mime_type' => $Mime_type, 'size' => $Size, 'extension' => $Extension, 'context' => $Full_path, 'target' => $Link, 'published' => $Published, 'approved' => $Approved, 'author_id' => $Author_id, 'comments' => $Comments, 'options' => $Options, 'publish_from' => $Publish_from, 'publish_to' => $Publish_to, 'locked_by' => $Locked_by, 'locked_time' => $Locked_time, 'modified_by' => $Modified_by, 'modified_time' => $Modified_time);
		return $this -> insert($data);
	}//end function insertIntoBanner

	public function deleteFromBannerById($Id) {
		$where = array('`id` = ?' => $Id);
		return $this -> delete($where);
	}//end function deleteFromBannerById

	public function updateBannerById($Id, $Area_id, $Title, $Label, $Type = "image file", $Mime_type = "", $Size = "", $Extension = "", $Full_path = "", $Link = "", $Published = "No", $Approved = "No", $Author_id = 0, $Comments = "", $Options = "", $Publish_from = "0000-00-00 00:00:00", $Publish_to = "0000-00-00 00:00:00", $Locked_by = 0, $Locked_time = "0000-00-00 00:00:00", $Modified_by = 0, $Modified_time = "0000-00-00 00:00:00") {
		$where = array('`id` = ?' => $Id);
		$data = array('area_id' => $Area_id, 'title' => $Title, 'label' => $Label, 'type' => $Type, 'mime_type' => $Mime_type, 'size' => $Size, 'extension' => $Extension, 'context' => $Full_path, 'target' => $Link, 'published' => $Published, 'approved' => $Approved, 'author_id' => $Author_id, 'comments' => $Comments, 'options' => $Options, 'publish_from' => $Publish_from, 'publish_to' => $Publish_to, 'locked_by' => $Locked_by, 'locked_time' => $Locked_time, 'modified_by' => $Modified_by, 'modified_time' => $Modified_time);
		return $this -> update($data, $where);
	}//end function updateBannerById

	public function getAllBannerOrderById($sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderById

	public function getAllBannerOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByIdWithLimit

	public function getBannerDetailsById($Id) {
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getBannerDetailsById

	public function getAllBannerByIdOrderById($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderById

	public function getAllBannerByIdOrderByIdWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByIdWithLimit

	public function getAllBannerOrderByArea_id($sorting = 'DESC') {
		$this -> _orderBy = "`area_id` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByArea_id

	public function getAllBannerOrderByArea_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`area_id` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByArea_idWithLimit

	public function getAllBannerByIdOrderByArea_id($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`area_id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByArea_id

	public function getAllBannerByIdOrderByArea_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`area_id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByArea_idWithLimit

	public function getAllBannerByArea_idOrderById($Area_id, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`area_id` = ?', array($Area_id));
		return $result;
	}//end function getAllBannerByArea_idOrderById

	public function getAllBannerByArea_idOrderByIdWithLimit($Area_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`area_id` = ?', array($Area_id));
		return $result;
	}//end function getAllBannerByArea_idOrderByIdWithLimit

	public function deleteFromBannerByArea_id($Area_id) {
		$where = array('`area_id` = ?' => $Area_id);
		return $this -> delete($where);
	}//end function deleteFromBannerByArea_id

	public function updateBannerArea_idColumnById($Id, $Area_id) {
		$where = array('`id` = ?' => $Id);
		$data = array('`area_id`' => $Area_id);
		return $this -> update($data, $where);
	}//end function updateBannerArea_idColumnById

	public function getAllBannerOrderByTitle($sorting = 'DESC') {
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByTitle

	public function getAllBannerOrderByTitleWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByTitleWithLimit

	public function getAllBannerByIdOrderByTitle($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByTitle

	public function getAllBannerByIdOrderByTitleWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`title` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByTitleWithLimit

	public function getAllBannerByTitleOrderById($Title, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`title` = ?', array($Title));
		return $result;
	}//end function getAllBannerByTitleOrderById

	public function getAllBannerByTitleOrderByIdWithLimit($Title, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`title` = ?', array($Title));
		return $result;
	}//end function getAllBannerByTitleOrderByIdWithLimit

	public function deleteFromBannerByTitle($Title) {
		$where = array('`title` = ?' => $Title);
		return $this -> delete($where);
	}//end function deleteFromBannerByTitle

	public function updateBannerTitleColumnById($Id, $Title) {
		$where = array('`id` = ?' => $Id);
		$data = array('`title`' => $Title);
		return $this -> update($data, $where);
	}//end function updateBannerTitleColumnById

	public function getAllBannerOrderByLabel($sorting = 'DESC') {
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLabel

	public function getAllBannerOrderByLabelWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLabelWithLimit

	public function getAllBannerByIdOrderByLabel($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLabel

	public function getAllBannerByIdOrderByLabelWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`label` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLabelWithLimit

	public function getAllBannerByLabelOrderById($Label, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`label` = ?', array($Label));
		return $result;
	}//end function getAllBannerByLabelOrderById

	public function getAllBannerByLabelOrderByIdWithLimit($Label, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`label` = ?', array($Label));
		return $result;
	}//end function getAllBannerByLabelOrderByIdWithLimit

	public function deleteFromBannerByLabel($Label) {
		$where = array('`label` = ?' => $Label);
		return $this -> delete($where);
	}//end function deleteFromBannerByLabel

	public function updateBannerLabelColumnById($Id, $Label) {
		$where = array('`id` = ?' => $Id);
		$data = array('`label`' => $Label);
		return $this -> update($data, $where);
	}//end function updateBannerLabelColumnById

	public function getAllBannerOrderByType($sorting = 'DESC') {
		$this -> _orderBy = "`type` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByType

	public function getAllBannerOrderByTypeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`type` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByTypeWithLimit

	public function getAllBannerByIdOrderByType($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`type` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByType

	public function getAllBannerByIdOrderByTypeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`type` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByTypeWithLimit

	public function getAllBannerByTypeOrderById($Type, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`type` = ?', array($Type));
		return $result;
	}//end function getAllBannerByTypeOrderById

	public function getAllBannerByTypeOrderByIdWithLimit($Type, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`type` = ?', array($Type));
		return $result;
	}//end function getAllBannerByTypeOrderByIdWithLimit

	public function deleteFromBannerByType($Type) {
		$where = array('`type` = ?' => $Type);
		return $this -> delete($where);
	}//end function deleteFromBannerByType

	public function updateBannerTypeColumnById($Id, $Type) {
		$where = array('`id` = ?' => $Id);
		$data = array('`type`' => $Type);
		return $this -> update($data, $where);
	}//end function updateBannerTypeColumnById

	public function getAllBannerOrderByMime_type($sorting = 'DESC') {
		$this -> _orderBy = "`mime_type` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByMime_type

	public function getAllBannerOrderByMime_typeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`mime_type` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByMime_typeWithLimit

	public function getAllBannerByIdOrderByMime_type($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`mime_type` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByMime_type

	public function getAllBannerByIdOrderByMime_typeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`mime_type` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByMime_typeWithLimit

	public function getAllBannerByMime_typeOrderById($Mime_type, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`mime_type` = ?', array($Mime_type));
		return $result;
	}//end function getAllBannerByMime_typeOrderById

	public function getAllBannerByMime_typeOrderByIdWithLimit($Mime_type, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`mime_type` = ?', array($Mime_type));
		return $result;
	}//end function getAllBannerByMime_typeOrderByIdWithLimit

	public function deleteFromBannerByMime_type($Mime_type) {
		$where = array('`mime_type` = ?' => $Mime_type);
		return $this -> delete($where);
	}//end function deleteFromBannerByMime_type

	public function updateBannerMime_typeColumnById($Id, $Mime_type) {
		$where = array('`id` = ?' => $Id);
		$data = array('`mime_type`' => $Mime_type);
		return $this -> update($data, $where);
	}//end function updateBannerMime_typeColumnById

	public function getAllBannerOrderBySize($sorting = 'DESC') {
		$this -> _orderBy = "`size` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderBySize

	public function getAllBannerOrderBySizeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`size` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderBySizeWithLimit

	public function getAllBannerByIdOrderBySize($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`size` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderBySize

	public function getAllBannerByIdOrderBySizeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`size` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderBySizeWithLimit

	public function getAllBannerBySizeOrderById($Size, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`size` = ?', array($Size));
		return $result;
	}//end function getAllBannerBySizeOrderById

	public function getAllBannerBySizeOrderByIdWithLimit($Size, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`size` = ?', array($Size));
		return $result;
	}//end function getAllBannerBySizeOrderByIdWithLimit

	public function deleteFromBannerBySize($Size) {
		$where = array('`size` = ?' => $Size);
		return $this -> delete($where);
	}//end function deleteFromBannerBySize

	public function updateBannerSizeColumnById($Id, $Size) {
		$where = array('`id` = ?' => $Id);
		$data = array('`size`' => $Size);
		return $this -> update($data, $where);
	}//end function updateBannerSizeColumnById

	public function getAllBannerOrderByExtension($sorting = 'DESC') {
		$this -> _orderBy = "`extension` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByExtension

	public function getAllBannerOrderByExtensionWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`extension` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByExtensionWithLimit

	public function getAllBannerByIdOrderByExtension($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`extension` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByExtension

	public function getAllBannerByIdOrderByExtensionWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`extension` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByExtensionWithLimit

	public function getAllBannerByExtensionOrderById($Extension, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`extension` = ?', array($Extension));
		return $result;
	}//end function getAllBannerByExtensionOrderById

	public function getAllBannerByExtensionOrderByIdWithLimit($Extension, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`extension` = ?', array($Extension));
		return $result;
	}//end function getAllBannerByExtensionOrderByIdWithLimit

	public function deleteFromBannerByExtension($Extension) {
		$where = array('`extension` = ?' => $Extension);
		return $this -> delete($where);
	}//end function deleteFromBannerByExtension

	public function updateBannerExtensionColumnById($Id, $Extension) {
		$where = array('`id` = ?' => $Id);
		$data = array('`extension`' => $Extension);
		return $this -> update($data, $where);
	}//end function updateBannerExtensionColumnById

	public function getAllBannerOrderByFull_path($sorting = 'DESC') {
		$this -> _orderBy = "`context` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByFull_path

	public function getAllBannerOrderByFull_pathWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`context` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByFull_pathWithLimit

	public function getAllBannerByIdOrderByFull_path($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`context` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByFull_path

	public function getAllBannerByIdOrderByFull_pathWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`context` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByFull_pathWithLimit

	public function getAllBannerByFull_pathOrderById($Full_path, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`context` = ?', array($Full_path));
		return $result;
	}//end function getAllBannerByFull_pathOrderById

	public function getAllBannerByFull_pathOrderByIdWithLimit($Full_path, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`context` = ?', array($Full_path));
		return $result;
	}//end function getAllBannerByFull_pathOrderByIdWithLimit

	public function deleteFromBannerByFull_path($Full_path) {
		$where = array('`context` = ?' => $Full_path);
		return $this -> delete($where);
	}//end function deleteFromBannerByFull_path

	public function updateBannerFull_pathColumnById($Id, $Full_path) {
		$where = array('`id` = ?' => $Id);
		$data = array('`context`' => $Full_path);
		return $this -> update($data, $where);
	}//end function updateBannerFull_pathColumnById

	public function getAllBannerOrderByLink($sorting = 'DESC') {
		$this -> _orderBy = "`target` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLink

	public function getAllBannerOrderByLinkWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`target` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLinkWithLimit

	public function getAllBannerByIdOrderByLink($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`target` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLink

	public function getAllBannerByIdOrderByLinkWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`target` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLinkWithLimit

	public function getAllBannerByLinkOrderById($Link, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`target` = ?', array($Link));
		return $result;
	}//end function getAllBannerByLinkOrderById

	public function getAllBannerByLinkOrderByIdWithLimit($Link, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`target` = ?', array($Link));
		return $result;
	}//end function getAllBannerByLinkOrderByIdWithLimit

	public function deleteFromBannerByLink($Link) {
		$where = array('`target` = ?' => $Link);
		return $this -> delete($where);
	}//end function deleteFromBannerByLink

	public function updateBannerLinkColumnById($Id, $Link) {
		$where = array('`id` = ?' => $Id);
		$data = array('`target`' => $Link);
		return $this -> update($data, $where);
	}//end function updateBannerLinkColumnById
	
	public function getAllBannerOrderByPublished($sorting = 'DESC') {
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByPublished

	public function getAllBannerOrderByPublishedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByPublishedWithLimit

	public function getAllBannerByIdOrderByPublished($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByPublished

	public function getAllBannerByIdOrderByPublishedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`published` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByPublishedWithLimit

	public function getAllBannerByPublishedOrderById($Published, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`published` = ?', array($Published));
		return $result;
	}//end function getAllBannerByPublishedOrderById

	public function getAllBannerByPublishedOrderByIdWithLimit($Published, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`published` = ?', array($Published));
		return $result;
	}//end function getAllBannerByPublishedOrderByIdWithLimit

	public function deleteFromBannerByPublished($Published) {
		$where = array('`published` = ?' => $Published);
		return $this -> delete($where);
	}//end function deleteFromBannerByPublished

	public function updateBannerPublishedColumnById($Id, $Published) {
		$where = array('`id` = ?' => $Id);
		$data = array('`published`' => $Published);
		return $this -> update($data, $where);
	}//end function updateBannerPublishedColumnById

	public function getAllBannerOrderByApproved($sorting = 'DESC') {
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByApproved

	public function getAllBannerOrderByApprovedWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByApprovedWithLimit

	public function getAllBannerByIdOrderByApproved($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByApproved

	public function getAllBannerByIdOrderByApprovedWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`approved` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByApprovedWithLimit

	public function getAllBannerByApprovedOrderById($Approved, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`approved` = ?', array($Approved));
		return $result;
	}//end function getAllBannerByApprovedOrderById

	public function getAllBannerByApprovedOrderByIdWithLimit($Approved, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`approved` = ?', array($Approved));
		return $result;
	}//end function getAllBannerByApprovedOrderByIdWithLimit

	public function deleteFromBannerByApproved($Approved) {
		$where = array('`approved` = ?' => $Approved);
		return $this -> delete($where);
	}//end function deleteFromBannerByApproved

	public function updateBannerApprovedColumnById($Id, $Approved) {
		$where = array('`id` = ?' => $Id);
		$data = array('`approved`' => $Approved);
		return $this -> update($data, $where);
	}//end function updateBannerApprovedColumnById

	public function getAllBannerOrderByAuthor_id($sorting = 'DESC') {
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByAuthor_id

	public function getAllBannerOrderByAuthor_idWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByAuthor_idWithLimit

	public function getAllBannerByIdOrderByAuthor_id($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByAuthor_id

	public function getAllBannerByIdOrderByAuthor_idWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`author_id` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByAuthor_idWithLimit

	public function getAllBannerByAuthor_idOrderById($Author_id, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`author_id` = ?', array($Author_id));
		return $result;
	}//end function getAllBannerByAuthor_idOrderById

	public function getAllBannerByAuthor_idOrderByIdWithLimit($Author_id, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`author_id` = ?', array($Author_id));
		return $result;
	}//end function getAllBannerByAuthor_idOrderByIdWithLimit

	public function deleteFromBannerByAuthor_id($Author_id) {
		$where = array('`author_id` = ?' => $Author_id);
		return $this -> delete($where);
	}//end function deleteFromBannerByAuthor_id

	public function updateBannerAuthor_idColumnById($Id, $Author_id) {
		$where = array('`id` = ?' => $Id);
		$data = array('`author_id`' => $Author_id);
		return $this -> update($data, $where);
	}//end function updateBannerAuthor_idColumnById

	public function getAllBannerOrderByComments($sorting = 'DESC') {
		$this -> _orderBy = "`comments` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByComments

	public function getAllBannerOrderByCommentsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`comments` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByCommentsWithLimit

	public function getAllBannerByIdOrderByComments($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`comments` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByComments

	public function getAllBannerByIdOrderByCommentsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`comments` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByCommentsWithLimit

	public function getAllBannerByCommentsOrderById($Comments, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`comments` = ?', array($Comments));
		return $result;
	}//end function getAllBannerByCommentsOrderById

	public function getAllBannerByCommentsOrderByIdWithLimit($Comments, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`comments` = ?', array($Comments));
		return $result;
	}//end function getAllBannerByCommentsOrderByIdWithLimit

	public function deleteFromBannerByComments($Comments) {
		$where = array('`comments` = ?' => $Comments);
		return $this -> delete($where);
	}//end function deleteFromBannerByComments

	public function updateBannerCommentsColumnById($Id, $Comments) {
		$where = array('`id` = ?' => $Id);
		$data = array('`comments`' => $Comments);
		return $this -> update($data, $where);
	}//end function updateBannerCommentsColumnById

	public function getAllBannerOrderByOptions($sorting = 'DESC') {
		$this -> _orderBy = "`options` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByOptions

	public function getAllBannerOrderByOptionsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`options` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByOptionsWithLimit

	public function getAllBannerByIdOrderByOptions($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`options` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByOptions

	public function getAllBannerByIdOrderByOptionsWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`options` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByOptionsWithLimit

	public function getAllBannerByOptionsOrderById($Options, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`options` = ?', array($Options));
		return $result;
	}//end function getAllBannerByOptionsOrderById

	public function getAllBannerByOptionsOrderByIdWithLimit($Options, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`options` = ?', array($Options));
		return $result;
	}//end function getAllBannerByOptionsOrderByIdWithLimit

	public function deleteFromBannerByOptions($Options) {
		$where = array('`options` = ?' => $Options);
		return $this -> delete($where);
	}//end function deleteFromBannerByOptions

	public function updateBannerOptionsColumnById($Id, $Options) {
		$where = array('`id` = ?' => $Id);
		$data = array('`options`' => $Options);
		return $this -> update($data, $where);
	}//end function updateBannerOptionsColumnById

	public function getAllBannerOrderByPublish_from($sorting = 'DESC') {
		$this -> _orderBy = "`publish_from` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByPublish_from

	public function getAllBannerOrderByPublish_fromWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`publish_from` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByPublish_fromWithLimit

	public function getAllBannerByIdOrderByPublish_from($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`publish_from` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByPublish_from

	public function getAllBannerByIdOrderByPublish_fromWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`publish_from` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByPublish_fromWithLimit

	public function getAllBannerByPublish_fromOrderById($Publish_from, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`publish_from` = ?', array($Publish_from));
		return $result;
	}//end function getAllBannerByPublish_fromOrderById

	public function getAllBannerByPublish_fromOrderByIdWithLimit($Publish_from, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`publish_from` = ?', array($Publish_from));
		return $result;
	}//end function getAllBannerByPublish_fromOrderByIdWithLimit

	public function deleteFromBannerByPublish_from($Publish_from) {
		$where = array('`publish_from` = ?' => $Publish_from);
		return $this -> delete($where);
	}//end function deleteFromBannerByPublish_from

	public function updateBannerPublish_fromColumnById($Id, $Publish_from) {
		$where = array('`id` = ?' => $Id);
		$data = array('`publish_from`' => $Publish_from);
		return $this -> update($data, $where);
	}//end function updateBannerPublish_fromColumnById

	public function getAllBannerOrderByPublish_to($sorting = 'DESC') {
		$this -> _orderBy = "`publish_to` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByPublish_to

	public function getAllBannerOrderByPublish_toWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`publish_to` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByPublish_toWithLimit

	public function getAllBannerByIdOrderByPublish_to($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`publish_to` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByPublish_to

	public function getAllBannerByIdOrderByPublish_toWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`publish_to` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByPublish_toWithLimit

	public function getAllBannerByPublish_toOrderById($Publish_to, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`publish_to` = ?', array($Publish_to));
		return $result;
	}//end function getAllBannerByPublish_toOrderById

	public function getAllBannerByPublish_toOrderByIdWithLimit($Publish_to, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`publish_to` = ?', array($Publish_to));
		return $result;
	}//end function getAllBannerByPublish_toOrderByIdWithLimit

	public function deleteFromBannerByPublish_to($Publish_to) {
		$where = array('`publish_to` = ?' => $Publish_to);
		return $this -> delete($where);
	}//end function deleteFromBannerByPublish_to

	public function updateBannerPublish_toColumnById($Id, $Publish_to) {
		$where = array('`id` = ?' => $Id);
		$data = array('`publish_to`' => $Publish_to);
		return $this -> update($data, $where);
	}//end function updateBannerPublish_toColumnById

	public function getAllBannerOrderByLocked_by($sorting = 'DESC') {
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLocked_by

	public function getAllBannerOrderByLocked_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLocked_byWithLimit

	public function getAllBannerByIdOrderByLocked_by($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLocked_by

	public function getAllBannerByIdOrderByLocked_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_by` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLocked_byWithLimit

	public function getAllBannerByLocked_byOrderById($Locked_by, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_by` = ?', array($Locked_by));
		return $result;
	}//end function getAllBannerByLocked_byOrderById

	public function getAllBannerByLocked_byOrderByIdWithLimit($Locked_by, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_by` = ?', array($Locked_by));
		return $result;
	}//end function getAllBannerByLocked_byOrderByIdWithLimit

	public function deleteFromBannerByLocked_by($Locked_by) {
		$where = array('`locked_by` = ?' => $Locked_by);
		return $this -> delete($where);
	}//end function deleteFromBannerByLocked_by

	public function updateBannerLocked_byColumnById($Id, $Locked_by) {
		$where = array('`id` = ?' => $Id);
		$data = array('`locked_by`' => $Locked_by);
		return $this -> update($data, $where);
	}//end function updateBannerLocked_byColumnById

	public function getAllBannerOrderByLocked_time($sorting = 'DESC') {
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLocked_time

	public function getAllBannerOrderByLocked_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByLocked_timeWithLimit

	public function getAllBannerByIdOrderByLocked_time($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLocked_time

	public function getAllBannerByIdOrderByLocked_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`locked_time` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByLocked_timeWithLimit

	public function getAllBannerByLocked_timeOrderById($Locked_time, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_time` = ?', array($Locked_time));
		return $result;
	}//end function getAllBannerByLocked_timeOrderById

	public function getAllBannerByLocked_timeOrderByIdWithLimit($Locked_time, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`locked_time` = ?', array($Locked_time));
		return $result;
	}//end function getAllBannerByLocked_timeOrderByIdWithLimit

	public function deleteFromBannerByLocked_time($Locked_time) {
		$where = array('`locked_time` = ?' => $Locked_time);
		return $this -> delete($where);
	}//end function deleteFromBannerByLocked_time

	public function updateBannerLocked_timeColumnById($Id, $Locked_time) {
		$where = array('`id` = ?' => $Id);
		$data = array('`locked_time`' => $Locked_time);
		return $this -> update($data, $where);
	}//end function updateBannerLocked_timeColumnById

	public function getAllBannerOrderByModified_by($sorting = 'DESC') {
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByModified_by

	public function getAllBannerOrderByModified_byWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByModified_byWithLimit

	public function getAllBannerByIdOrderByModified_by($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByModified_by

	public function getAllBannerByIdOrderByModified_byWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_by` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByModified_byWithLimit

	public function getAllBannerByModified_byOrderById($Modified_by, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_by` = ?', array($Modified_by));
		return $result;
	}//end function getAllBannerByModified_byOrderById

	public function getAllBannerByModified_byOrderByIdWithLimit($Modified_by, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_by` = ?', array($Modified_by));
		return $result;
	}//end function getAllBannerByModified_byOrderByIdWithLimit

	public function deleteFromBannerByModified_by($Modified_by) {
		$where = array('`modified_by` = ?' => $Modified_by);
		return $this -> delete($where);
	}//end function deleteFromBannerByModified_by

	public function updateBannerModified_byColumnById($Id, $Modified_by) {
		$where = array('`id` = ?' => $Id);
		$data = array('`modified_by`' => $Modified_by);
		return $this -> update($data, $where);
	}//end function updateBannerModified_byColumnById

	public function getAllBannerOrderByModified_time($sorting = 'DESC') {
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByModified_time

	public function getAllBannerOrderByModified_timeWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select();
		return $result;
	}//end function getAllBannerOrderByModified_timeWithLimit

	public function getAllBannerByIdOrderByModified_time($Id, $sorting = 'DESC') {
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByModified_time

	public function getAllBannerByIdOrderByModified_timeWithLimit($Id, $sorting = 'DESC', $start = 0, $limit = 10) {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`modified_time` $sorting";
		$result = $this -> select('`id` = ?', array($Id));
		return $result;
	}//end function getAllBannerByIdOrderByModified_timeWithLimit

	public function getAllBannerByModified_timeOrderById($Modified_time, $sorting = 'DESC') {
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_time` = ?', array($Modified_time));
		return $result;
	}//end function getAllBannerByModified_timeOrderById

	public function getAllBannerByModified_timeOrderByIdWithLimit($Modified_time, $start = 0, $limit = 10, $sorting = 'DESC') {
		$start = (int)($start);
		$limit = (int)($limit);
		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`id` $sorting";
		$result = $this -> select('`modified_time` = ?', array($Modified_time));
		return $result;
	}//end function getAllBannerByModified_timeOrderByIdWithLimit

	public function deleteFromBannerByModified_time($Modified_time) {
		$where = array('`modified_time` = ?' => $Modified_time);
		return $this -> delete($where);
	}//end function deleteFromBannerByModified_time

	public function updateBannerModified_timeColumnById($Id, $Modified_time) {
		$where = array('`id` = ?' => $Id);
		$data = array('`modified_time`' => $Modified_time);
		return $this -> update($data, $where);
	}//end function updateBannerModified_timeColumnById

	public function GetCleanBannerAndAreaByAreaTitleOrderByColumnWithLimit($AreaId, $start = 0, $limit = 1, $Column = 'id', $sorting = 'DESC') {

		$start = ( int )($start);
		$limit = ( int )($limit);
		$Column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);
		$AreaId = ( int )($AreaId);
		$this -> _selectQuery = "
				SELECT   
					SQL_CALC_FOUND_ROWS `id`,
					`area_id`, 
					`title`, 
					`label`, 
					`type`, 
					`mime_type`, 
					`size`, 
	  				`extension`, 
	  				`context`, 
	  				`target`,
	  				`source`, 
	  				`publish_from`, 
	  				`publish_to`, 
	  				`date_added`, 
	  				`comments`, 
	  				`options`
				FROM   `banner` ";

		$this -> _limit = "$start, $limit";
		$this -> _orderBy = "`$Column` $sorting";
		$result = $this -> select('`area_id` = ? AND `published` = ? AND `approved` ', array($AreaId, 'Yes', 'Yes'));

		return $result;

	}//End Function GetCleanBannerAndAreaByAreaTitleOrderByColumnWithLimit

	public function GetCleanDistinctBannerAndAreaOrderByColumn($Column = 'b.`date_added`', $sorting = 'DESC') {

		$Column = mysql_escape_string($Column);
		$sorting = mysql_escape_string($sorting);

		$this -> _selectQuery = "SELECT   
					SQL_CALC_FOUND_ROWS DISTINCT(b.`area_id`), b.`id`, 
					b.`title`, b.`label`, 
					b.`type`, 
					b.`mime_type`, 
					b.`size`, 
 					b.`extension`, 
 					b.`context`, 
 					b.`source`,
 					b.`target`, 
 					b.`publish_from`, 
 					b.`publish_to`,  
 					b.`date_added`, 
 					b.`comments`, 
 					b.`options`, 
					ba.`title` AS `area_title`, 
					ba.`label` AS `area_label`   
					FROM 
						`banner` AS b 
					INNER JOIN 
						`banner_area` AS ba ON b.`area_id` = ba.`id` ";

		$this -> _orderBy = "$Column $sorting";
		$result = $this -> select('b.`published` = ? AND b.`approved` = ? ', array('Yes', 'Yes'));
		return $result;
	} //End Function GetCleanDistinctBannerAndAreaOrderByColumn*/

}