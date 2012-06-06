<?php

class Aula_Model_Upload_Video extends Aula_Model_Upload {
	public $width = 0;
	public $height = 0;
	
	function __construct($htmlFileObj) {
		parent::__construct ();
		$this->htmlFileObj = $htmlFileObj;
		//$this->allowedTypes = array ('video/mpeg', 'video/mp4', 'video/ogg', 'video/quicktime', 'video/x-ms-wmv', 'video/x-flv', 'video/3gpp' );
		$this->allowedTypes = array ('video/x-flv' );
		if (isset ( $_FILES [$this->htmlFileObj] ) and ! empty ( $_FILES [$this->htmlFileObj] ['name'] )) {
			list ( $this->width, $this->height ) = @getimagesize ( $_FILES [$this->htmlFileObj] ['tmp_name'] );
			$this->mime = $_FILES [$this->htmlFileObj] ['type'];
			$this->size = $_FILES [$this->htmlFileObj] ['size'];
			$this->height = '230';
			$this->width = '480';
			$this->extension = '.flv';
			$this->takenTime = '';
			$this->takenLocation = '';
		}
	}
}
