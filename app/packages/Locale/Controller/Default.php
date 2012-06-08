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
 * in the future. If you wish to customize Magento for your needs please refer to
 * http://www.aulaula.com for more information.
 *
 * @category Aula
 * @package Aula_Locale
 * @subpackage Controller
 * @name Locale_Controller_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Locale_Controller_Default extends Aula_Controller_Action {

	private $localeObj = Null;

	protected function _init() {
		$this -> localeObj = new Locale_Model_Default();
		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'status' => array('text', 0), 'localeId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'locale' => array('text', 1), 'localeTitle' => array('text', 1), 'published' => array('text', 0, $this -> localeObj -> published), 'approved' => array('text', 0, $this -> localeObj -> approved), 'order' => array('numericUnsigned', 0, $this -> localeObj -> order), 'afterId' => array('numeric', 0), 'comment' => array('text', 0, $this -> localeObj -> comments), 'resetFilter' => array('', 0), 'search' => array('', 0), 'dateAddedFrom' => array('shortDateTime', 0), 'dateAddedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');

		//order list
		$this -> afterIdList = '';
		$this -> afterIdListResult = $this -> localeObj -> getAllLocaleOrderById();
		if (!empty($this -> afterIdListResult)) {
			foreach ($this->afterIdListResult as $key => $value) {
				$selectedItem = ($value['id'] == $this -> view -> sanitized['afterId']['value']) ? 'selected="selected"' : '';
				$this -> afterIdList .= '<option value="' . $value['id'] . '"' . $selectedItem . '>' . $value['title'] . '</option>';
			}
		}
		$this -> view -> afterIdList = $this -> afterIdList;
	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/locale/action/';
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
			$this -> view -> sanitized -> redirectURI -> value = $_SERVER['REQUEST_URI'];
		}

		if ($_GET['success'] == 'approve') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Approved');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'publish') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Published');
			$this -> view -> successMessageStyle = 'display: block;';
		} elseif ($_GET['success'] == 'delete') {
			$this -> view -> successMessage = $this -> view -> __('Records successfully Deleted');
			$this -> view -> successMessageStyle = 'display: block;';
		}

		//sortin
		$this -> view -> sort -> title -> cssClass = 'sort-title';
		$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
		$this -> view -> sort -> localeTitle -> cssClass = 'sort-title';
		$this -> view -> sort -> localeTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/localeTitle/asc';
		$this -> view -> sort -> showInMenu -> cssClass = 'sort-title';
		$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/asc';
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['localeTitle']) && $_GET['localeTitle'] == 'asc') {
			$this -> view -> sort -> localeTitle -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> localeTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/localeTitle/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByLocale_titleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['localeTitle']) && $_GET['localeTitle'] == 'desc') {
			$this -> view -> sort -> localeTitle -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> localeTitle -> href = $this -> view -> sanitized -> actionURI -> value . 'list/localeTitle/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByLocale_titleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInMenu']) && $_GET['showInMenu'] == 'asc') {
			$this -> view -> sort -> showInMenu -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByShow_in_menuWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['showInMenu']) && $_GET['showInMenu'] == 'desc') {
			$this -> view -> sort -> showInMenu -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> showInMenu -> href = $this -> view -> sanitized -> actionURI -> value . 'list/showInMenu/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByShow_in_menuWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$localeListResult = $this -> localeObj -> getAllLocaleOrderByIdWithLimit($this -> start, $this -> limit);
		}

		//listing
		$localeList = '';
		$localeIfnoList = '';
		if (!empty($localeListResult) and false != $localeListResult) {
			foreach ($localeListResult as $key => $value) {
				$localeList .= '<tr>';
				$localeList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="localeId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$localeList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$localeList .= '<td class="jstalgntop">' . $value['locale_title'] . '</td>';
				$localeList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$localeList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$localeList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$localeList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/locale/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$localeList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> localeList = $localeList;
		$this -> view -> render('locale/listLocale.phtml');
		exit();
	}

}
