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
 * @name Object_Model_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */
 
class Object_Model_Default extends Aula_Model_DbTable {

	protected $_name = 'object';
	protected $_primary = 'id';

	/**
	 * @Table Columns
	 */
	public $_selectColumnsList = '';
	public $Id = NULL;
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $parentId = 0;
	public $source = 0;
	public $OriginalAuthor = '';
	public $showInList = 'Yes';
	public $published = 'No';
	public $approved = 'No';
	public $comments = '';
	public $options = '';
	public $dateAdded = 'CURRENT_TIMESTAMP';
	public $createdDate = '0000-00-00';

	private $object_info;
	private $object_file;
	private $object_photo;
	private $object_video;
	private $object_article;

	public function __construct() {
		$this -> cols = $this -> _cols = array('id', 'title', 'created_date', 'author_id', 'source_id', 'hash_key', 'tags', 'page_title', 'meta_title', 'meta_key', 'meta_desc', 'meta_data', 'type_id', 'category_id', 'locale_id', 'guid_url', 'original_author', 'parent_id', 'show_in_list', 'published', 'approved', 'date_added');
		$this -> _selectColumnsList = ' SQL_CALC_FOUND_ROWS `id`, `title`, `created_date`, `author_id`, `source_id`, `hash_key`, `tags`, `page_title`, `meta_title`, `meta_key`, `meta_desc`, `meta_data`, `type_id`, `category_id`, `locale_id`, `guid_url`, `original_author`, `parent_id`, `show_in_list`, `published`, `approved`, `date_added` ';

		$this -> object_info = $this -> _name . '_info';
		$this -> object_file = $this -> _name . '_file';
		$this -> object_photo = $this -> _name . '_photo';
		$this -> object_video = $this -> _name . '_video';
		$this -> object_article = $this -> _name . '_article';

		parent::__construct();
	}

	public function deleteObjectById($object_id) {
		$object_id = (int)$object_id;
		
		$objInfo = new Object_Model_Info();
		$objArticle = new Object_Model_Article();
		$objPhoto = new Object_Model_Photo();
		$objVideo = new Object_Model_Video();
		$objFile = new Object_Model_File();


		$object = $this -> find($object_id) -> current();
		if (!empty($object)) {
			$object -> delete();
		}

		$objectInfo = $objInfo -> fetchRow('object_id = ' . $object_id);
		if (!empty($objectInfo)) {
			$objectInfo -> delete();
		}

		$objectFile = $objFile -> fetchRow('object_id = ' . $object_id);
		if (!empty($objectFile)) {
			$objectFile -> delete();
		}

		$objectArticle = $objArticle -> fetchRow('object_id = ' . $object_id);
		if (!empty($objectArticle)) {
			$objectArticle -> delete();
		}
		
		$objectVideo = $objVideo -> fetchRow('object_id = ' . $object_id);
		if (!empty($objectVideo)) {
			$objectVideo -> delete();
		}

		$objectPhoto = $objPhoto -> select() -> where('object_id= ?', $object_id) -> query() -> fetchAll() ;
		if ( !empty($objectPhoto)) {
			foreach ($objectPhoto as $value) {
				if ( !empty($value['id' ]) ) {
					$row = $objPhoto -> find( $value['id'] ) -> current( ) ;
					if ( !empty($row) ) {
						$row -> delete();
					}
				}
			}
		}
		return true;
	}

	public function getAllObject_OrderByColumnWithLimit($column, $sorting, $start, $limit) {
		$start = ( int )($start);
		$limit = ( int )($limit);
		$column = mysql_escape_string($column);
		$sorting = mysql_escape_string($sorting);

		$column = $this -> _name . '.' . $column;

		$result = $this 
		-> select() 
		-> from($this -> _name, 
					array(new Zend_Db_Expr('SQL_CALC_FOUND_ROWS *'), "id AS {$this->_name}_id", "published AS {$this->_name}_published", "approved AS {$this->_name}_approved", "show_in_list AS {$this->_name}_show_in_list", "date_added AS {$this->_name}_date_added")) 
		-> joinLeft($this -> object_article, "$this->_name.id=$this->object_article.object_id", 
					array("id As {$this->object_article}_id", "date_added AS {$this->object_article}_date_added", "alias As {$this->object_article}_alias")) 
		-> joinLeft($this -> object_photo, "$this->_name.id=$this->object_photo.object_id", 
					array("id As {$this->object_photo}_id", "date_added AS {$this->object_photo}_date_added", "alias As {$this->object_photo}_alias")) 
		-> joinLeft($this -> object_video, "$this->_name.id=$this->object_video.object_id", 
					array("id As {$this->object_video}_id", "date_added AS {$this->object_video}_date_added", "alias As {$this->object_video}_alias", "extension As {$this->object_video}_extension")) 
		-> joinLeft($this -> object_file, "$this->_name.id=$this->object_file.object_id", 
					array("id As {$this->object_file}_id", "date_added AS {$this->object_file}_date_added", "extension As {$this->object_file}_extension")) 
		-> order("$column $sorting") 
		-> limit("$start, $limit") 
		-> setIntegrityCheck(false) 
		-> query() 
		-> fetchAll();

		return $result;
	}

}
