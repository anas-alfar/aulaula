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
 * @package Poll
 * @subpackage Controller
 * @name Poll_Controller_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Poll_Controller_Default extends Aula_Controller_Action {

	private $pollObj = Null;
	private $answerObj = Null;
	private $voteObj = Null;
	private $defaultAnswer = 2;

	protected function _init() {
		$this -> pollObj = new Poll_Model_Default();
		$this -> answerObj = new Poll_Model_Answer();
		$this -> defualtAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'answerLabel_1' => array('text', 1), 'answerTitle_1' => array('text', 1), 'votesCount_1' => array('numeric', 1, 0), 'answerId_1' => array('numeric', 0), 'answerLabel_2' => array('text', 1), 'answerTitle_2' => array('text', 1), 'votesCount_2' => array('numeric', 1, 0), 'answerId_2' => array('numeric', 0), 'answerLabel_3' => array('text', 0), 'answerTitle_3' => array('text', 0), 'votesCount_3' => array('numeric', 0, 0), 'answerId_3' => array('numeric', 0), 'answerLabel_4' => array('text', 0), 'answerTitle_4' => array('text', 0), 'votesCount_4' => array('numeric', 0, 0), 'answerId_4' => array('numeric', 0), 'answerLabel_5' => array('text', 0), 'answerTitle_5' => array('text', 0), 'votesCount_5' => array('numeric', 0, 0), 'answerId_5' => array('numeric', 0), 'answerLabel_6' => array('text', 0), 'answerTitle_6' => array('text', 0), 'votesCount_6' => array('numeric', 0, 0), 'answerId_6' => array('numeric', 0), 'answerLabel_7' => array('text', 0), 'answerTitle_7' => array('text', 0), 'votesCount_7' => array('numeric', 0, 0), 'answerId_7' => array('numeric', 0), 'answerLabel_8' => array('text', 0), 'answerTitle_8' => array('text', 0), 'votesCount_8' => array('numeric', 0, 0), 'answerId_8' => array('numeric', 0), 'answerLabel_9' => array('text', 0), 'answerTitle_9' => array('text', 0), 'votesCount_9' => array('numeric', 0), 'answerId_9' => array('numeric', 0, 0), 'answerLabel_10' => array('text', 0), 'answerTitle_10' => array('text', 0), 'votesCount_10' => array('numeric', 0, 0), 'answerId_10' => array('numeric', 0), 'status' => array('text', 0), 'pollId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'published' => array('text', 0, $this -> pollObj -> published), 'approved' => array('text', 0, $this -> pollObj -> approved), 'comment' => array('text', 0, $this -> pollObj -> comments), 'option' => array('text', 0, $this -> pollObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $this -> pollObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> pollObj -> publishTo), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function listAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function viewAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

	public function voteAction() {
		echo '<br />' . __FUNCTION__;
		echo '<br />' . __CLASS__;
		echo '<br />' . __METHOD__;
		exit();
	}

}
