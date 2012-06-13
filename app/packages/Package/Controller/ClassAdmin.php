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
 * @package Package
 * @subpackage Controller
 * @name Package_Controller_Class
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Package_Controller_Class extends Aula_Controller_Action {
	
	private $packageObj = Null;
	private $packageInfoObj = Null;
	private $actionObj = Null;
	private $classObj = Null;
	
	protected function _init() {
		$this->packageObj = new Package_Model_Default ();
		$this->classObj = new Package_Model_Class ();
		
		$this->defualtAdminAction = 'list';
		$this->view->sanitized = $_POST;
		$this->view->_init ();
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'Id' => array ('numeric', 0 ), 'classId' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'classTitle' => array ('text', 1 ), 'className' => array ('codeConvention', 1 ), 'classDescription' => array ('text', 1 ), 'fileName' => array ('filePath', 1 ), 'package' => array ('numericUnsigned', 1 ), 'comment' => array ('text', 0, $this->classObj->comments ), 'option' => array ('text', 0, $this->classObj->options ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
		
		//package list
		$this->packageList = '';
		$this->packageListResult = $this->packageObj->getAllPackageOrderById ();
		if (! empty ( $this->packageListResult )) {
			foreach ( $this->packageListResult as $key => $value ) {
				$selectedItem = ($value ['id'] == $this->view->sanitized ['package'] ['value']) ? 'selected="selected"' : '';
				$this->packageList .= '<option value="' . $value ['id'] . '"' . $selectedItem . '>' . $value ['title'] . '</option>';
			}
		}
		$this->view->packageList = $this->packageList;
	}
	
	public function addAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->classObj->insertIntoPackage_class ( Null, $this->view->sanitized->classTitle->value, $this->view->sanitized->className->value, $this->view->sanitized->classDescription->value, $this->view->sanitized->fileName->value, $this->view->sanitized->package->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value );
				$this->view->sanitized->Id->value = $result [0];
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/package-class/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/package-class/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on add record' );
				}
			}
		} else {
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		
		if (! empty ( $this->errorMessage )) {
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		
		$this->view->render ( 'package/addClass.phtml' );
		exit ();
	}
	
	public function editAction() {
		if ($this->isPagePostBack) {
			$this->filterObj->trimData ( $this->view->sanitized );
			$this->filterObj->sanitizeData ( $this->view->sanitized );
			$this->errorMessage = $this->validationObj->validator ( $this->fields, $this->view->sanitized );
			$this->view->arrayToObject ( $this->view->sanitized );
			if (empty ( $this->errorMessage )) {
				$result = $this->classObj->updatePackage_classById ( $this->view->sanitized->Id->value, $this->view->sanitized->classTitle->value, $this->view->sanitized->className->value, $this->view->sanitized->classDescription->value, $this->view->sanitized->fileName->value, $this->view->sanitized->package->value, $this->view->sanitized->comment->value, $this->view->sanitized->option->value );
				if ($result !== false) {
					if (isset ( $this->view->sanitized->btn_submit->value ) and (1 == $this->view->sanitized->btn_submit->value)) {
						header ( 'Location: /admin/handle/pkg/package-class/action/list/s/1' );
						exit ();
					}
					header ( 'Location: /admin/handle/pkg/package-class/action/edit/s/1/id/' . $this->view->sanitized->Id->value );
					exit ();
				} else {
					$this->errorMessage ['general'] = $this->view->__ ( 'Error on edit record' );
				}
			}
		} elseif (isset ( $_GET ['id'] ) and is_numeric ( $_GET ['id'] )) {
			$result = $this->classObj->getPackage_classDetailsById ( ( int ) $_GET ['id'] );
			$result = $result [0];
			$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'Id' => array ('numeric', 0, $result ['class_id'] ), 'classId' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'classTitle' => array ('text', 1, $result ['title'] ), 'className' => array ('codeConvention', 1, $result ['name'] ), 'classDescription' => array ('text', 1, $result ['description'] ), 'fileName' => array ('filePath', 1, $result ['file_name'] ), 'package' => array ('numericUnsigned', 1, $result ['package_id'] ), 'comment' => array ('text', 0, $result ['comments'] ), 'option' => array ('text', 0, $result ['options'] ), 'resetFilter' => array ('', 0 ), 'search' => array ('', 0 ), 'lastModifiedFrom' => array ('shortDateTime', 0 ), 'lastModifiedTo' => array ('shortDateTime', 0 ), 'notification' => array ('', 0 ), 'success' => array ('', 0 ), 'error' => array ('', 0 ), 'btn_submit' => array ('', 0, 2 ) );
			$this->view->sanitized = array ();
			$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
			$this->view->sanitized ['Id'] ['value'] = ( int ) $_GET ['id'];
			$this->view->arrayToObject ( $this->view->sanitized );
		} else {
			$this->view->arrayToObject ( $this->view->sanitized );
		}
		
		if (! empty ( $this->errorMessage )) {
			foreach ( $this->errorMessage as $key => $msg ) {
				$this->view->sanitized->$key->errorMessage = $msg;
				$this->view->sanitized->$key->errorMessageStyle = 'display: block;';
			}
		}
		
		$this->view->render ( 'package/addClass.phtml' );
		exit ();
	}
	
	public function deleteAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->classId->value )) {
			foreach ( $this->view->sanitized->classId->value as $id => $value ) {
				$classDelete = $this->classObj->deleteFromPackage_classById ( $id );
			}
			if (! empty ( $classDelete )) {
				header ( 'Location: /admin/handle/pkg/package-class/action/list/success/delete' );
				exit ();
			}
		}
		
		header ( 'Location: /admin/handle/pkg/pacakge-class/action/list/' );
		exit ();
	}
	
	public function listAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$this->view->sanitized->actionURI->value = '/admin/handle/pkg/package-class/action/';
		if (isset ( $_SERVER ['REQUEST_URI'] ) and ! empty ( $_SERVER ['REQUEST_URI'] )) {
			$this->view->sanitized->redirectURI->value = $_SERVER ['REQUEST_URI'];
		}
		
		if ($_GET ['success'] == 'delete') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Deleted' );
			$this->view->successMessageStyle = 'display: block;';
		}
		//sortin
		$this->view->sort->classTitle->cssClass = 'sort-title';
		$this->view->sort->classTitle->href = $this->view->sanitized->actionURI->value . 'list/classTitle/asc';
		$this->view->sort->className->cssClass = 'sort-title';
		$this->view->sort->className->href = $this->view->sanitized->actionURI->value . 'list/className/asc';
		$this->view->sort->package->cssClass = 'sort-title';
		$this->view->sort->package->href = $this->view->sanitized->actionURI->value . 'list/package/asc';
		$this->view->sort->dateAdded->cssClass = 'sort-title';
		$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/asc';
		if (isset ( $_GET ['classTitle'] ) && $_GET ['classTitle'] == 'asc') {
			$this->view->sort->classTitle->cssClass = 'sort-arrow-asc';
			$this->view->sort->classTitle->href = $this->view->sanitized->actionURI->value . 'list/classTitle/desc';
			$classListResult = $this->classObj->GetAllPackage_classOrderByTitleWithLimit ( 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['classTitle'] ) && $_GET ['classTitle'] == 'desc') {
			$this->view->sort->classTitle->cssClass = 'sort-arrow-desc';
			$this->view->sort->classTitle->href = $this->view->sanitized->actionURI->value . 'list/classTitle/asc';
			$classListResult = $this->classObj->GetAllPackage_classOrderByTitleWithLimit ( 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['className'] ) && $_GET ['className'] == 'asc') {
			$this->view->sort->className->cssClass = 'sort-arrow-asc';
			$this->view->sort->className->href = $this->view->sanitized->actionURI->value . 'list/className/desc';
			$classListResult = $this->classObj->getAllPackage_classOrderByNameWithLimit ( 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['className'] ) && $_GET ['className'] == 'desc') {
			$this->view->sort->className->cssClass = 'sort-arrow-desc';
			$this->view->sort->className->href = $this->view->sanitized->actionURI->value . 'list/className/asc';
			$classListResult = $this->classObj->GetAllPackage_classOrderByNameWithLimit ( 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['package'] ) && $_GET ['package'] == 'asc') {
			$this->view->sort->package->cssClass = 'sort-arrow-asc';
			$this->view->sort->package->href = $this->view->sanitized->actionURI->value . 'list/package/desc';
			$classListResult = $this->classObj->GetAllPackage_classOrderByPackage_idWithLimit ( 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['package'] ) && $_GET ['package'] == 'desc') {
			$this->view->sort->package->cssClass = 'sort-arrow-desc';
			$this->view->sort->package->href = $this->view->sanitized->actionURI->value . 'list/package/asc';
			$classListResult = $this->classObj->GetAllPackage_classOrderByPackage_idWithLimit ( 'DESC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['dateAdded'] ) && $_GET ['dateAdded'] == 'asc') {
			$this->view->sort->dateAdded->cssClass = 'sort-arrow-asc';
			$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/desc';
			$classListResult = $this->classObj->GetAllPackage_classOrderByDate_addedWithLimit ( 'ASC', $this->start, $this->limit );
		} elseif (isset ( $_GET ['dateAdded'] ) && $_GET ['dateAdded'] == 'desc') {
			$this->view->sort->dateAdded->cssClass = 'sort-arrow-desc';
			$this->view->sort->dateAdded->href = $this->view->sanitized->actionURI->value . 'list/dateAdded/asc';
			
			$classListResult = $this->classObj->getAllPackage_classOrderByDate_addedWithLimit ( 'DESC', $this->start, $this->limit );
		} else {
			$classListResult = $this->classObj->getAllPackage_classOrderByIdWithLimit ( $this->start, $this->limit );
		}
		
		$this->pagingObj->_init ( $this->classObj->totalRecordsFound );
		$this->view->paging = $this->pagingObj->paging;
		$this->view->arrayToObject ( $this->view->paging );
		
		$packageListResult = $this->packageObj->getAllPackageOrderById ();
		
		//listing
		$countOfPackageListResult = count ( $packageListResult );
		$packageTitle = array ();
		for($i = 0; $i < $countOfPackageListResult; $i ++) {
			$packageTitle [$packageListResult [$i] ['id']] = $packageListResult [$i] ['title'];
		}
		
		$classList = '';
		if (! empty ( $classListResult ) and false != $classListResult) {
			foreach ( $classListResult as $key => $value ) {
				$classList .= '<tr>';
				$classList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="classId[' . $value ['id'] . ']" id="check" value="Yes" /></td>';
				$classList .= '<td class="jstalgntop">' . $value ['title'] . '</td>';
				$classList .= '<td class="jstalgntop">' . $value ['name'] . '</td>';
				$classList .= '<td class="jstalgntop">' . $packageTitle [$value ['package_id']] . '</td>';
				$classList .= '<td class="jstalgntop">' . $value ['date_added'] . '</td>';
				$classList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/package-class/action/edit/s/1/id/' . $value ['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$classList .= '</tr>';
			}
		} else {
			$this->view->notificationMessage = $this->view->__ ( 'Sorry, no records found' );
			$this->view->notificationMessageStyle = 'display: block;';
		}
		
		$this->view->classList = $classList;
		$this->view->render ( 'package/listPackageClass.phtml' );
		exit ();
	}

}
