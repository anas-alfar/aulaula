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
 * @package Aula - Core
 * @subpackage Model
 * @name Aula_Model_Upload
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Aula_Model_Upload extends Aula_Model_Default {
	public $size = 0;
	public $mime = '';
	public $extension = '';
	public $comments = '';
	public $isColor = '';
	public $takenTime = '';
	public $newFileName = NULL;
	
	public $allowedTypes = NULL;
	protected $maxUploadSize = '209715200';
	protected $htmlFileObj = '';
	
	function __construct($htmlFileObj = NULL) {
		parent::__construct ();
		if (! is_null ( $htmlFileObj )) {
			$this->htmlFileObj = $htmlFileObj;
		}
		if (isset ( $_FILES [$this->htmlFileObj] ) and ! empty ( $_FILES [$this->htmlFileObj] ['name'] )) {
			$this->allowedTypes = array ('text/plain', 'application/pdf', 'application/zip', 'application/x-rar-compressed', 'application/octet-stream', 'application/vnd.ms-excel', 'application/msword' );
			$this->mime = $_FILES [$this->htmlFileObj] ['type'];
			$this->size = $_FILES [$this->htmlFileObj] ['size'];
			$this->extension = strstr ( basename ( $_FILES [$this->htmlFileObj] ['name'] ), '.' );
		}
	}
	
	public function CheckIfThereIsFile() {
		if ($_FILES [$this->htmlFileObj] ['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		}
		return true;
	}
	
	public function CheckIfThereIsNoErrorInUpload() {
		if ($_FILES [$this->htmlFileObj] ['error'] != UPLOAD_ERR_OK) {
			return false;
		}
		return true;
	}
	
	public function validatedMime() {
		if ($this->CheckIfThereIsFile () === true) {
			if ($this->CheckIfThereIsNoErrorInUpload () === true) {
				if (! in_array ( $this->mime, $this->allowedTypes )) {
					return false;
				}
			}
		}
		return true;
	}
	
	public function validatedSize() {
		if ($this->size > $this->maxUploadSize) {
			return false;
		}
		return true;
	}
	
	public function uploadFile($path) {
		return move_uploaded_file ( $_FILES [$this->htmlFileObj] ['tmp_name'], $path );
	}
}