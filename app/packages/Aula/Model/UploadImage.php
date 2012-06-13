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
 * @name Aula_Model_UploadImage
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Aula_Model_UploadImage extends Aula_Model_Default {
	private $imageTypes = null;
	private $imageSize = '';
	private $newImageName = '';
	
	function __construct() {
		$this->imageTypes = array ('image/gif', 'image/pjpeg', 'image/jpeg', 'image/x-png', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'application/pdf' );
		$this->imageSize = '800000';
	}
	
	private function CheckIfThereIsFile($htmlFileObj) {
		if ($_FILES [$htmlFileObj] ['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		}
		return true;
	}
	
	private function CheckIfThereIsNoErrorInUpload($htmlFileObj) {
		if ($_FILES [$htmlFileObj] ['error'] != UPLOAD_ERR_OK) {
			return false;
		}
		return true;
	}
	
	public function validatedMime($htmlFileObj) {
		if ($this->CheckIfThereIsFile ( $htmlFileObj ) === true) {
			if ($this->CheckIfThereIsNoErrorInUpload ( $htmlFileObj ) === true) {
				$fileMime = $_FILES [$htmlFileObj] ['type'];
				if (! in_array ( $fileMime, $this->imageTypes )) {
					return false;
				}
			}
		}
		return true;
	}
	
	public function validatedSize($htmlFileObj) {
		$fileSize = $_FILES [$htmlFileObj] ['size'];
		if ($fileSize > $this->imageSize) {
			return false;
		}
		return true;
	}
	
	public function resizeUploadImage($htmlFileObj, $newwidth, $newheight, $fileId, $path) {
		
		$uploadedfile = $_FILES [$htmlFileObj] ['tmp_name'];
		
		$mimetype = $_FILES [$htmlFileObj] ['type'];
		
		switch ($mimetype) {
			case "image/jpg" :
			case "image/jpeg" :
				$src = imagecreatefromjpeg ( $uploadedfile );
				break;
			case "image/gif" :
				$src = imagecreatefromgif ( $uploadedfile );
				break;
			case "image/png" :
				$src = imagecreatefrompng ( $uploadedfile );
				break;
		}
		
		$width = 0;
		$height = 0;
		
		list ( $width, $height ) = @getimagesize ( $uploadedfile );
		
		if ($width > $height) {
			$percent = $width / $height;
			if ($newwidth > $width) {
				$newwidth = $width;
				$newheight = $newwidth / $percent;
			} else {
				$newheight = $newwidth / $percent;
			}
		} else if ($height > $width) {
			$percent = $height / $width;
			if ($newheight > $height) {
				$newheight = $height;
				$newwidth = $newheight / $percent;
			} else {
				$newwidth = $newheight / $percent;
			}
		}
		
		$tmp = @imagecreatetruecolor ( $newwidth, $newheight );
		@imagecopyresampled ( $tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
		
		$this->newImageName = md5 ( GRIM_HASH . $fileId );
		$fileType = strstr ( $_FILES [$htmlFileObj] ['type'], '/' );
		$filename ['path'] = $path . $this->newImageName . '.jpg';
		$filename ['link'] = $path . $this->newImageName . '.jpg';
		
		@imagejpeg ( $tmp, $filename ['path'], 100 );
		@imagedestroy ( $src );
		@imagedestroy ( $tmp );
		return $filename;
	}
	
	public function uploadFile($htmlFileObj, $fileId, $extenstion = false) {
		$this->newImageName = md5 ( GRIM_HASH . $fileId );
		$fileType = strstr ( $_FILES [$htmlFileObj] ['type'], '/' );
		$newFileName ['link'] = AMERGROUP_UPLOAD_LARGE_LINK . $this->newImageName . '.jpg';
		$newFileName ['path'] = AMERGROUP_UPLOAD_LARGE_PATH . $this->newImageName . '.jpg';
		$filePath = AMERGROUP_UPLOAD_LARGE_PATH . $this->newImageName . '.' . substr ( $fileType, 1, strlen ( $fileType ) );
		$_FILES [$htmlFileObj] ['tmp_name'];
		
		copy ( $_FILES [$htmlFileObj] ['tmp_name'], $filePath );
		return $newFileName;
	}
}