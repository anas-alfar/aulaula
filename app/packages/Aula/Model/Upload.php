<?php

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
		if (!is_null($htmlFileObj)) {
			$this->htmlFileObj = $htmlFileObj;
		}
		if (isset ( $_FILES [$this->htmlFileObj] ) and ! empty ( $_FILES [$this->htmlFileObj]['name'] )) {
			$this->allowedTypes = array ('text/plain', 'application/pdf','application/zip' ,'application/x-rar-compressed', 'application/octet-stream', 'application/vnd.ms-excel' );
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