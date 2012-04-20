<?php

class Object_Controller_RatingAdmin extends Aula_Controller_Action {
	
	protected function _init() {
		$this->fields = array ('redirectURI' => array ('uri', 0, '' ), 'status' => array ('text', 0 ), 'ratingId' => array ('numeric', 0 ), 'Id' => array ('numeric', 0 ), 'token' => array ('text', 1 ), 'title' => array ('text', 1 ), 'label' => array ('text', 1 ), 'titleArticle' => array ('text', 0 ), 'aliasArticle' => array ('text', 0 ), 'introTextArticle' => array ('text', 0 ), 'fullTextArticle' => array ('text', 0 ), 'sourceArticle' => array ('numeric', 0 ), 'createdDateArticle' => array ('longDateTime', 0 ), 'publishFromArticle' => array ('longDateTime', 0 ), 'publishToArticle' => array ('longDateTime', 0 ), 'titlePhoto' => array ('text', 0 ), 'aliasPhoto' => array ('text', 0 ), 'introTextPhoto' => array ('text', 0 ), 'sourcePhoto' => array ('numeric', 0 ), 'takenDatePhoto' => array ('longDateTime', 0 ), 'takenLocationPhoto' => array ('text', 0 ), 'filePhoto' => array ('text', 0 ), 'publishFromPhoto' => array ('longDateTime', 0 ), 'publishToPhoto' => array ('longDateTime', 0 ), 'titleVideo' => array ('text', 0 ), 'aliasVideo' => array ('text', 0 ), 'introTextVideo' => array ('text', 0 ), 'sourceVideo' => array ('numeric', 0 ), 'takenDateVideo' => array ('longDateTime', 0 ), 'takenLocationVideo' => array ('text', 0 ), 'encodedVideo' => array ('text', 0 ), 'fileVideo' => array ('text', 0 ), 'publishFromVideo' => array ('longDateTime', 0 ), 'publishToVideo' => array ('longDateTime', 0 ), 'titleSource' => array ('numeric', 0 ), 'descriptionSource' => array ('numeric', 0 ), 'typeSource' => array ('numeric', 0 ), 'urlSource' => array ('numeric', 0 ), 'localeSource' => array ('numeric', 0 ), 'timeDelaySource' => array ('numeric', 0 ), 'countrySource' => array ('numeric', 0 ), 'titleUrl' => array ('text', 0 ), 'aliasUrl' => array ('text', 0 ), 'introTextUrl' => array ('text', 0 ), 'sourceUrl' => array ('numeric', 0 ), 'urlUrl' => array ('url', 0 ), 'styleUrl' => array ('text', 0 ), 'urlTypeUrl' => array ('numeric', 0 ), 'titleStatic' => array ('text', 0 ), 'aliasStatic' => array ('text', 0 ), 'introTextStatic' => array ('text', 0 ), 'fullTextStatic' => array ('text', 0 ), 'UrlStatic' => array ('text', 0 ), 'createdDateStatic' => array ('longDateTime', 0 ), 'publishFromStatic' => array ('longDateTime', 0 ), 'publishToStatic' => array ('longDateTime', 0 ), 'titleTag' => array ('text', 0 ), 'titleAbuse' => array ('text', 0 ), 'labelAbuse' => array ('text', 0 ), 'descriptionAbuse' => array ('text', 0 ), 'titleDirectory' => array ('text', 0 ), 'labelDirectory' => array ('text', 0 ), 'descriptionDirectory' => array ('text', 0 ), 'parentDirectory' => array ('numeric', 0 ), 'titleFile' => array ('text', 0 ), 'nameFile' => array ('text', 0 ), 'descriptionFile' => array ('text', 0 ), 'directoryFile' => array ('text', 0 ), 'object' => array ('numeric', 0 ), 'locale' => array ('numeric', 0 ), 'tag' => array ('text', 0 ), 'pageTitle' => array ('text', 0 ), 'originalAuthor' => array ('text', 0 ), 'showInList' => array ('text', 0 ), 'published' => array ('text', 0 ), 'approved' => array ('text', 0 ), 'comment' => array ('text', 0 ), 'option' => array ('text', 0 ), 'createdDate' => array ('longDateTime', 0 ), 'metaTitle' => array ('text', 0 ), 'metaKey' => array ('text', 0 ), 'metaDesc' => array ('text', 0 ), 'metaData' => array ('text', 0 ), 'layout' => array ('numeric', 0 ), 'template' => array ('numeric', 0 ), 'skin' => array ('numeric', 0 ), 'createdDate' => array ('longDateTime', 0 ), 'publishFrom' => array ('longDateTime', 0 ), 'publishTo' => array ('longDateTime', 0 ), 'comment' => array ('text', 0 ), 'option' => array ('text', 0 ), 'resetFilter' => '', 'search' => '', 'dateAddedFrom' => array ('longDateTime', 0 ), 'dateAddedTo' => array ('longDateTime', 0 ), 'notification' => '', 'success' => '', 'error' => '', 'btn_submit' => array ('', 0, 2 ) );
		$this->view->sanitized = $this->filterObj->initData ( $this->fields, $this->view->sanitized );
		$this->view->sanitized ['token'] ['value'] = md5 ( time () . 'qwiedkhjsafg' );
		$this->view->sanitized ['locale'] ['value'] = 1;
	}
	
	public function addAction() {
	}
	
	public function editAction() {
	}
	
	public function deleteAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->ratingId->value )) {
			foreach ( $this->view->sanitized->ratingId->value as $id => $value ) {
				$ratingDelete = $this->ratingObj->deleteFromObject_ratingById ( $id );
			}
			if (! empty ( $ratingDelete )) {
				header ( 'Location: /admin/handle/pkg/object-rating/action/list/success/delete' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/object-rating/action/list/' );
		exit ();
	}
	
	public function publishAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->ratingId->value )) {
			foreach ( $this->view->sanitized->ratingId->value as $id => $value ) {
				$ratingPublish = $this->ratingObj->updateObject_ratingPublishedColumnById ( $id, $this->view->sanitized->status->value );
			}
			if (! empty ( $ratingPublish )) {
				header ( 'Location: /admin/handle/pkg/object-rating/action/list/success/publish' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/object-rating/action/list/' );
		exit ();
	}
	
	public function approveAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		if (! empty ( $this->view->sanitized->ratingId->value )) {
			foreach ( $this->view->sanitized->ratingId->value as $id => $value ) {
				$ratingAprrove = $this->ratingObj->updateObject_ratingApprovedColumnById ( $id, $this->view->sanitized->status->value );
			}
			if (! empty ( $ratingAprrove )) {
				header ( 'Location: /admin/handle/pkg/object-rating/action/list/success/approve' );
				exit ();
			}
		}
		header ( 'Location: /admin/handle/pkg/object-rating/action/list/' );
		exit ();
	}
	
	public function listAction() {
		$this->view->arrayToObject ( $this->view->sanitized );
		$this->view->sanitized->actionURI->value = '/admin/handle/pkg/object-rating/action/';
		if (isset ( $_SERVER ['REQUEST_URI'] ) and ! empty ( $_SERVER ['REQUEST_URI'] )) {
			$this->view->sanitized->redirectURI->value = $_SERVER ['REQUEST_URI'];
		}
		
		if ($_GET ['success'] == 'approve') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Approved' );
			$this->view->successMessageStyle = 'display: block;';
		} elseif ($_GET ['success'] == 'publish') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Published' );
			$this->view->successMessageStyle = 'display: block;';
		} elseif ($_GET ['success'] == 'delete') {
			$this->view->successMessage = $this->view->__ ( 'Records successfully Deleted' );
			$this->view->successMessageStyle = 'display: block;';
		}
	}

}
