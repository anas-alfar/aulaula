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
 * @name Object_Model_Info
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Object_Model_Info extends Aula_Model_DbTable {

	protected $_name = 'object_info';
	protected $_primary = 'id';
	
	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = ''; 
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $totalViews = 0;
	public $totalComments = 0;
	public $totalRating = 0;
	public $layoutId = 1;
	public $templateId = 1;
	public $skinId = 1;
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $themePublishFrom = '0000-00-00';
	public $themePublishTo = '0000-00-00';
	
	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'object_id', 'total_views', 'total_comments', 'total_rating', 'layout_id', 'template_id', 'skin_id', 'theme_publish_from', 'theme_publish_to', 'date_added', 'comments', 'options');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `object_id`, `total_views`, `total_comments`, `total_rating`, `layout_id`, `template_id`, `skin_id`, `theme_publish_from`, `theme_publish_to`, `comments`, `options` ';
		parent::__construct();
	}
	
}