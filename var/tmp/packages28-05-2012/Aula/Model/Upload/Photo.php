<?php

class Aula_Model_Upload_Photo extends Aula_Model_Upload {
	public $width = 0;
	public $height = 0;
	
	function __construct($htmlFileObj) {
		parent::__construct ($htmlFileObj);
		$this->allowedTypes = array ('image/gif', 'image/pjpeg', 'image/jpeg', 'image/x-png', 'image/png' );
		if (isset ( $_FILES [$this->htmlFileObj] ) and ! empty ( $_FILES [$this->htmlFileObj] ['name'] )) {
			try {
				$photoExifInfo = exif_read_data ( $_FILES [$htmlFileObj] ['tmp_name'], 0, true );
				$this->mime = isset($photoExifInfo ['FILE'] ['MimeType'])?$photoExifInfo ['FILE'] ['MimeType']:$_FILES [$this->htmlFileObj]['type'];
				$this->size = $photoExifInfo ['FILE'] ['FileSize'];
				$this->width = $photoExifInfo ['COMPUTED'] ['Width'];
				$this->height = $photoExifInfo ['COMPUTED'] ['Height'];
				$this->takenTime = date ( 'Y-m-d H:i:s', $photoExifInfo ['FILE'] ['FileDateTime'] );
				$this->comments = isset ( $photoExifInfo ['COMMENT'] [0] ) ? $photoExifInfo ['COMMENT'] ['0'] : '';
				$this->isColor = isset ( $photoExifInfo ['COMPUTED'] ['IsColor'] ) ? $photoExifInfo ['COMPUTED'] ['IsColor'] : '';
			} catch ( Exception $ex ) {
				list ( $this->width, $this->height ) = @getimagesize ( $_FILES [$this->htmlFileObj] ['tmp_name'] );
				$this->mime = $_FILES [$this->htmlFileObj] ['type'];
				$this->size = $_FILES [$this->htmlFileObj] ['size'];
				$this->extension = strstr ( basename ( $_FILES [$this->htmlFileObj] ['name'] ), '.' );
			}
		}
	}
	
	public function resizeUploadImage($newwidth, $newheight, $path, $waterMarkFile = NULL) {
		switch ($this->mime) {
			case "image/jpg" :
			case "image/jpeg" :
				$src = imagecreatefromjpeg ( $this->newFileName );
				break;
			case "image/gif" :
				$src = imagecreatefromgif ( $this->newFileName );
				break;
			case "image/png" :
				$src = imagecreatefrompng ( $this->newFileName );
				break;
		}
		
		if ($this->width > $this->height) {
			$percent = $this->width / $this->height;
			if ($newwidth > $this->width) {
				$newwidth = $this->width;
				$newheight = $newwidth / $percent;
			} else {
				$newheight = $newwidth / $percent;
			}
		} else if ($this->height > $this->width) {
			$percent = $this->height / $this->width;
			if ($newheight > $this->height) {
				$newheight = $this->height;
				$newwidth = $newheight / $percent;
			} else {
				$newwidth = $newheight / $percent;
			}
		}
		
		$path .= basename ( $this->newFileName );
		
		$image = imagecreatefromjpeg ( $this->newFileName );
		$image_size_width = imagesx ( $image );
		$image_size_height = imagesy ( $image );
		$resized_img = imagecreatetruecolor ( $newwidth, $newheight );
		imagecopyresized ( $resized_img, $image, 0, 0, 0, 0, $newwidth, $newheight, $image_size_width, $image_size_height );
		
		if (! is_null ( $waterMarkFile ) and file_exists ( $waterMarkFile )) {
			$watermark = imagecreatefrompng ( $waterMarkFile );
			$watermark_width = imagesx ( $watermark );
			$watermark_height = imagesy ( $watermark );
			$resized_watermark = imagecreatetruecolor ( $newwidth, $newheight );
			imagecopyresized ( $resized_watermark, $watermark, 0, 0, 0, 0, $newwidth, $newheight, $watermark_width, $watermark_height );
			$white = imagecolorallocate ( $resized_watermark, 255, 255, 255 );
			imagecolortransparent ( $resized_watermark, $white );
			imagecopymerge ( $resized_img, $resized_watermark, 0, 0, 0, 0, $newwidth, $newheight, 15 );
			imagedestroy ( $resized_watermark );
			unset ( $resized_watermark );
		}
		
		imagejpeg ( $resized_img, $path, 100 );
		
		imagedestroy ( $image );
		imagedestroy ( $resized_img );
		
		if (! is_null ( $waterMarkFile ) and file_exists ( $waterMarkFile ) and isset ( $resized_watermark )) {
			imagedestroy ( $resized_watermark );
		}
		
		return true;
	}
}
