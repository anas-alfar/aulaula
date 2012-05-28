<?php

class Poll_Controller_DefaultAdmin extends Aula_Controller_Action {

	private $pollObj = Null;
	private $answerObj = Null;
	private $voteObj = Null;
	private $defaultAnswer = 2;

	protected function _init() {
		$this -> pollObj = new Poll_Model_Default();
		$this -> answerObj = new Poll_Model_Answer();
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('redirectURI' => array('uri', 0, ''), 'answerLabel_1' => array('text', 1), 'answerTitle_1' => array('text', 1), 'votesCount_1' => array('numeric', 1, 0), 'answerId_1' => array('numeric', 0), 'answerLabel_2' => array('text', 1), 'answerTitle_2' => array('text', 1), 'votesCount_2' => array('numeric', 1, 0), 'answerId_2' => array('numeric', 0), 'answerLabel_3' => array('text', 0), 'answerTitle_3' => array('text', 0), 'votesCount_3' => array('numeric', 0, 0), 'answerId_3' => array('numeric', 0), 'answerLabel_4' => array('text', 0), 'answerTitle_4' => array('text', 0), 'votesCount_4' => array('numeric', 0, 0), 'answerId_4' => array('numeric', 0), 'answerLabel_5' => array('text', 0), 'answerTitle_5' => array('text', 0), 'votesCount_5' => array('numeric', 0, 0), 'answerId_5' => array('numeric', 0), 'answerLabel_6' => array('text', 0), 'answerTitle_6' => array('text', 0), 'votesCount_6' => array('numeric', 0, 0), 'answerId_6' => array('numeric', 0), 'answerLabel_7' => array('text', 0), 'answerTitle_7' => array('text', 0), 'votesCount_7' => array('numeric', 0, 0), 'answerId_7' => array('numeric', 0), 'answerLabel_8' => array('text', 0), 'answerTitle_8' => array('text', 0), 'votesCount_8' => array('numeric', 0, 0), 'answerId_8' => array('numeric', 0), 'answerLabel_9' => array('text', 0), 'answerTitle_9' => array('text', 0), 'votesCount_9' => array('numeric', 0), 'answerId_9' => array('numeric', 0, 0), 'answerLabel_10' => array('text', 0), 'answerTitle_10' => array('text', 0), 'votesCount_10' => array('numeric', 0, 0), 'answerId_10' => array('numeric', 0), 'status' => array('text', 0), 'pollId' => array('numeric', 0), 'Id' => array('numeric', 0), 'token' => array('text', 1), 'title' => array('text', 1), 'label' => array('text', 1), 'published' => array('text', 0, $this -> pollObj -> published), 'approved' => array('text', 0, $this -> pollObj -> approved), 'comment' => array('text', 0, $this -> pollObj -> comments), 'option' => array('text', 0, $this -> pollObj -> options), 'resetFilter' => array('', 0), 'search' => array('', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $this -> pollObj -> publishFrom), 'publishTo' => array('shortDateTime', 0, $this -> pollObj -> publishTo), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;
	}

	public function addAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			$answer = array();
			for ($i = 1; $i <= 10; $i++) {
				$answer[$i]['title'] = $this -> view -> sanitized -> {"answerTitle_$i"} -> value;
				$answer[$i]['label'] = $this -> view -> sanitized -> {"answerLabel_$i"} -> value;
				$answer[$i]['votesCount'] = $this -> view -> sanitized -> {"votesCount_$i"} -> value;
				$answer[$i]['id'] = $this -> view -> sanitized -> {"answerId_$i"} -> value;
			}
			if (empty($this -> errorMessage)) {
				$result = $this -> pollObj -> insertIntoPoll(Null, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> userId, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				$this -> view -> sanitized -> Id -> value = $result[0];
				for ($i = 1; $i <= 10; $i++) {
					if (empty($answer[$i]['title']) && empty($answer[$i]['label'])) {
						continue;
					}
					$result = $this -> answerObj -> insertIntoPoll_answer(Null, $this -> view -> sanitized -> Id -> value, $answer[$i]['title'], $answer[$i]['label'], $answer[$i]['votesCount'], $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $i, $this -> view -> userId);
				}
				if ($result !== false) {
					$this -> view -> sanitized -> general -> successMessage = $this -> view -> __('Record successfully added');
					$this -> view -> sanitized -> general -> successMessageStyle = 'display: block;';
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/poll/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/poll/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on add record');
				}
			}
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}
		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
		}
		$answerList = '';
		$this -> defaultAnswer = 10;
		for ($i = 1; $i <= 10; $i++) {
			if (empty($answer[$i]['title']) && empty($answer[$i]['label']) && $i != 1 && $i != 2) {
				$this -> defaultAnswer--;
				continue;
			}
			$answerList .= '
<!-- Answer_' . $i . '-->
<div class="entrdcont"  id="answer_' . $i . '" >
<div class="wdthauto">
<table class="formlist">
	<tr>
		<td class="lable jstalgntop">' . $this -> view -> __('Poll_Answer') . ':</td>
		<td class="lablvalue jstalgntop">
		<input type="hidden" name="answerId_' . $i . '" id="answerId_' . $i . '" value="' . $this -> view -> sanitized -> {"answerId_$i"} -> value . '" />
		<input type="text" class="inptflx"
			id="answerTitle_' . $i . '" name="answerTitle_' . $i . '"
			value="' . $this -> view -> sanitized -> {"answerTitle_$i"} -> value . '" />
		<div class="validat" style="' . $this -> view -> sanitized -> {"answerTitle_$i"} -> errorMessageStyle . '">
		' . $this -> view -> sanitized -> {"answerTitle_$i"} -> errorMessage . '</div>
		</td>
	</tr>
	<tr>
		<td class="lable jstalgntop">' . $this -> view -> __('Poll_Label') . ':</td>
		<td class="lablvalue jstalgntop"><input type="text" class="inptflx"
			id="answerLabel_' . $i . '" name="answerLabel_' . $i . '" value="' . $this -> view -> sanitized -> {"answerLabel_$i"} -> value . '" />
		<div class="validat" style="' . $this -> view -> sanitized -> {"answerLabel_$i"} -> errorMessageStyle . '">
		' . $this -> view -> sanitized -> {"answerLabel_$i"} -> errorMessage . '</div>
		</td>
	</tr>
	<tr>
		<td class="lable jstalgntop">' . $this -> view -> __('Poll_Votes count') . ':</td>
		<td class="lablvalue jstalgntop"><input type="text" class="inptflx"
			id="votesCount_' . $i . '" name="votesCount_' . $i . '" value="' . $this -> view -> sanitized -> {"votesCount_$i"} -> value . '" />
		<div class="validat" style="' . $this -> view -> sanitized -> {"votesCount_$i"} -> errorMessageStyle . '">
		' . $this -> view -> sanitized -> {"votesCount_$i"} -> errorMessage . '</div>';
			if ($i != 1 && $i != 2) {
				$answerList .= '&nbsp;<br /><a href="#" class="save-btn"  style="float:right;"><em><button onclick="javascript:removeAnswer(' . $i . ');" type="button" value="' . $i . '" class="emptbtn" >' . $this -> view -> __('Poll_Delete') . '</button></em></a>';
			}
			$answerList .= '</td>
	</tr>
</table>
</div>
</div>
<br id=answer_br_' . $i . '  />';
			'<!-- end Answer_' . $i . ' -->';
		}
		$this -> view -> answerList = $answerList;
		$this -> view -> defaultAnswer = $this -> defaultAnswer;

		$this -> view -> render('poll/addPoll.phtml');
		exit();
	}

	public function editAction() {
		if ($this -> isPagePostBack) {
			$this -> filterObj -> trimData($this -> view -> sanitized);
			$this -> filterObj -> sanitizeData($this -> view -> sanitized);
			$this -> errorMessage = $this -> validationObj -> validator($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
			$answer = array();
			for ($i = 1; $i <= 10; $i++) {
				$answer[$i]['title'] = $this -> view -> sanitized -> {"answerTitle_$i"} -> value;
				$answer[$i]['label'] = $this -> view -> sanitized -> {"answerLabel_$i"} -> value;
				$answer[$i]['votesCount'] = $this -> view -> sanitized -> {"votesCount_$i"} -> value;
				$answer[$i]['id'] = $this -> view -> sanitized -> {"answerId_$i"} -> value;
			}
			if (empty($this -> errorMessage)) {
				$result = $this -> pollObj -> updatePollById($this -> view -> sanitized -> Id -> value, $this -> view -> sanitized -> title -> value, $this -> view -> sanitized -> label -> value, $this -> view -> sanitized -> comment -> value, $this -> view -> sanitized -> option -> value, $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $this -> view -> userId, $this -> view -> sanitized -> publishFrom -> value, $this -> view -> sanitized -> publishTo -> value);
				for ($i = 1; $i <= 10; $i++) {
					if (empty($answer[$i]['title']) && empty($answer[$i]['label'])) {
						if (!empty($answer[$i]['id'])) {
							$result = $this -> answerObj -> deleteFromPoll_answerById($answer[$i]['id']);
						}

						continue;
					}
					$result = $this -> answerObj -> updatePoll_answerById($answer[$i]['id'], $this -> view -> sanitized -> Id -> value, $answer[$i]['title'], $answer[$i]['label'], $answer[$i]['votesCount'], $this -> view -> sanitized -> published -> value, $this -> view -> sanitized -> approved -> value, $i, $this -> view -> userId);
				}
				if ($result !== false) {
					$this -> view -> sanitized -> general -> successMessage = $this -> view -> __('Record successfully added');
					$this -> view -> sanitized -> general -> successMessageStyle = 'display: block;';
					if (isset($this -> view -> sanitized -> btn_submit -> value) and (1 == $this -> view -> sanitized -> btn_submit -> value)) {
						header('Location: /admin/handle/pkg/poll/action/list/s/1');
						exit();
					}
					header('Location: /admin/handle/pkg/poll/action/edit/s/1/id/' . $this -> view -> sanitized -> Id -> value);
					exit();
				} else {
					$this -> errorMessage['general'] = $this -> view -> __('Error on edit record');
				}
			}
		} elseif (isset($_GET['id']) and is_numeric($_GET['id'])) {
			$result = $this -> pollObj -> getPollDetailsById(( int )$_GET['id']);
			$result = $result[0];
			$resultAnswers = $this -> answerObj -> GetAllPoll_answerByPoll_idOrderById(( int )$_GET['id'], 'ASC');
			$this -> defaultAnswer = $this -> answerObj -> totalRecordsFound;
			for ($k = 0; $k < 10; $k++) {
				if (!isset($resultAnswers[$k])) {
					$resultAnswers[$k]['label'] = NULL;
					$resultAnswers[$k]['title'] = NULL;
					$resultAnswers[$k]['votes_count'] = NULL;
					$resultAnswers[$k]['id'] = NULL;
				}
			}
			$result['publish_from'] = substr($result['publish_from'], 0, 10);
			$result['publish_to'] = substr($result['publish_to'], 0, 10);
			$this -> fields = array('redirectURI' => array('uri', 0, ''), 'answerLabel_1' => array('text', 1, $resultAnswers[0]['label']), 'answerTitle_1' => array('text', 1, $resultAnswers[0]['title']), 'votesCount_1' => array('numeric', 1, $resultAnswers[0]['votes_count']), 'answerId_1' => array('numeric', 0, $resultAnswers[0]['id']), 'answerLabel_2' => array('text', 1, $resultAnswers[1]['label']), 'answerTitle_2' => array('text', 1, $resultAnswers[1]['title']), 'votesCount_2' => array('numeric', 1, $resultAnswers[1]['votes_count']), 'answerId_2' => array('numeric', 0, $resultAnswers[1]['id']), 'answerLabel_3' => array('text', 0, $resultAnswers[2]['label']), 'answerTitle_3' => array('text', 0, $resultAnswers[2]['title']), 'votesCount_3' => array('numeric', 0, $resultAnswers[2]['votes_count']), 'answerId_3' => array('numeric', 0, $resultAnswers[2]['id']), 'answerLabel_4' => array('text', 0, $resultAnswers[3]['label']), 'answerTitle_4' => array('text', 0, $resultAnswers[3]['title']), 'votesCount_4' => array('numeric', 0, $resultAnswers[3]['votes_count']), 'answerId_4' => array('numeric', 0, $resultAnswers[3]['id']), 'answerLabel_5' => array('text', 0, $resultAnswers[4]['label']), 'answerTitle_5' => array('text', 0, $resultAnswers[4]['title']), 'votesCount_5' => array('numeric', 0, $resultAnswers[4]['votes_count']), 'answerId_5' => array('numeric', 0, $resultAnswers[4]['id']), 'answerLabel_6' => array('text', 0, $resultAnswers[5]['label']), 'answerTitle_6' => array('text', 0, $resultAnswers[5]['title']), 'votesCount_6' => array('numeric', 0, $resultAnswers[5]['votes_count']), 'answerId_6' => array('numeric', 0, $resultAnswers[5]['id']), 'answerLabel_7' => array('text', 0, $resultAnswers[6]['label']), 'answerTitle_7' => array('text', 0, $resultAnswers[6]['title']), 'votesCount_7' => array('numeric', 0, $resultAnswers[6]['votes_count']), 'answerId_7' => array('numeric', 0, $resultAnswers[6]['id']), 'answerLabel_8' => array('text', 0, $resultAnswers[7]['label']), 'answerTitle_8' => array('text', 0, $resultAnswers[7]['title']), 'votesCount_8' => array('numeric', 0, $resultAnswers[7]['votes_count']), 'answerId_8' => array('numeric', 0, $resultAnswers[7]['id']), 'answerLabel_9' => array('text', 0, $resultAnswers[8]['label']), 'answerTitle_9' => array('text', 0, $resultAnswers[8]['title']), 'votesCount_9' => array('numeric', 0, $resultAnswers[8]['votes_count']), 'answerId_9' => array('numeric', 0, $resultAnswers[8]['id']), 'answerLabel_10' => array('text', 0, $resultAnswers[9]['label']), 'answerTitle_10' => array('text', 0, $resultAnswers[9]['title']), 'votesCount_10' => array('numeric', 0, $resultAnswers[9]['votes_count']), 'answerId_10' => array('numeric', 0, $resultAnswers[9]['id']), 'status' => array('text', 0), 'pollId' => array('numeric', 0, $result['id']), 'Id' => array('numeric', 0, $result['id']), 'token' => array('text', 1), 'title' => array('text', 1, $result['title']), 'label' => array('text', 1, $result['label']), 'published' => array('text', 0, $result['published']), 'approved' => array('text', 0, $result['approved']), 'comment' => array('text', 0, $result['comments']), 'option' => array('text', 0, $result['options']), 'resetFilter' => array('', 0), 'search' => array('', 0), 'lastModifiedFrom' => array('shortDateTime', 0), 'lastModifiedTo' => array('shortDateTime', 0), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'publishFrom' => array('shortDateTime', 0, $result['publish_from']), 'publishTo' => array('shortDateTime', 0, $result['publish_to']), 'btn_submit' => array('', 0, 2));
			$this -> view -> sanitized = array();
			$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
			$this -> view -> arrayToObject($this -> view -> sanitized);
		} else {
			$this -> view -> arrayToObject($this -> view -> sanitized);
		}

		if (!empty($this -> errorMessage)) {
			foreach ($this->errorMessage as $key => $msg) {
				$this -> view -> sanitized -> $key -> errorMessage = $msg;
				$this -> view -> sanitized -> $key -> errorMessageStyle = 'display: block;';
			}
		}

		$answerList = '';
		if (isset($this -> answerObj -> totalRecordsFound) && !empty($this -> answerObj -> totalRecordsFound)) {
			$counter = $this -> defaultAnswer = $this -> answerObj -> totalRecordsFound;
		} else {
			$counter = 10;
			$this -> defaultAnswer = 10;
		}
		for ($i = 1; $i <= $counter; $i++) {
			if (empty($answer[$i]['title']) && empty($answer[$i]['label']) && $i != 1 && $i != 2 && (!isset($this -> answerObj -> totalRecordsFound) || empty($this -> answerObj -> totalRecordsFound))) {
				$this -> defaultAnswer--;
				continue;
			}
			$answerList .= '
<!-- Answer_' . $i . '-->
<div class="entrdcont"  id="answer_' . $i . '" >
<div class="wdthauto">
<table class="formlist">
	<tr>
		<td class="lable jstalgntop">' . $this -> view -> __('Poll_Answer') . ':</td>
		<td class="lablvalue jstalgntop">
		<input type="hidden" name="answerId_' . $i . '" id="answerId_' . $i . '" value="' . $this -> view -> sanitized -> {"answerId_$i"} -> value . '" />
		<input type="text" class="inptflx"
			id="answerTitle_' . $i . '" name="answerTitle_' . $i . '"
			value="' . $this -> view -> sanitized -> {"answerTitle_$i"} -> value . '" />
		<div class="validat" style="' . $this -> view -> sanitized -> {"answerTitle_$i"} -> errorMessageStyle . '">
		' . $this -> view -> sanitized -> {"answerTitle_$i"} -> errorMessage . '</div>
		</td>
	</tr>
	<tr>
		<td class="lable jstalgntop">' . $this -> view -> __('Poll_Label') . ':</td>
		<td class="lablvalue jstalgntop"><input type="text" class="inptflx"
			id="answerLabel_' . $i . '" name="answerLabel_' . $i . '" value="' . $this -> view -> sanitized -> {"answerLabel_$i"} -> value . '" />
		<div class="validat" style="' . $this -> view -> sanitized -> {"answerLabel_$i"} -> errorMessageStyle . '">
		' . $this -> view -> sanitized -> {"answerLabel_$i"} -> errorMessage . '</div>
		</td>
	</tr>
	<tr>
		<td class="lable jstalgntop">' . $this -> view -> __('Poll_Votes count') . ':</td>
		<td class="lablvalue jstalgntop"><input type="text" class="inptflx"
			id="votesCount_' . $i . '" name="votesCount_' . $i . '" value="' . $this -> view -> sanitized -> {"votesCount_$i"} -> value . '" />
		<div class="validat" style="' . $this -> view -> sanitized -> {"votesCount_$i"} -> errorMessageStyle . '">
		' . $this -> view -> sanitized -> {"votesCount_$i"} -> errorMessage . '</div>';
			if ($i != 1 && $i != 2) {
				$answerList .= '&nbsp;<br /><a href="#" class="save-btn"  style="float:right;"><em><button onclick="javascript:removeAnswer(' . $i . ');" type="button" value="' . $i . '" class="emptbtn" >' . $this -> view -> __('Poll_Delete') . '</button></em></a>';
			}
			$answerList .= '</td>
	</tr>
</table>
</div>
</div>
<br id="answer_br_' . $i . '"  />';
			'<!-- end Answer_' . $i . ' -->';
		}
		$this -> view -> answerList = $answerList;
		$this -> view -> defaultAnswer = $this -> defaultAnswer;

		$this -> view -> render('poll/addPoll.phtml');
		exit();
	}

	public function deleteAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> pollId -> value)) {
			foreach ($this->view->sanitized->pollId->value as $id => $value) {
				$pollDelete = $this -> pollObj -> deleteFromPollById($id);
				$answerResult = $this -> answerObj -> GetAllPoll_answerByPoll_idOrderById($id);
				$countAnswerResult = count($answerResult);
				for ($i = 0; $i < $countAnswerResult; $i++) {
					$answerDelete = $this -> answerObj -> deleteFromPoll_answerById($answerResult[$i]['id']);
				}
			}
			if (!empty($pollDelete)) {
				header('Location: /admin/handle/pkg/poll/action/list/success/delete');
				exit();
			}
		}

		header('Location: /admin/handle/pkg/poll/action/list/');
		exit();
	}

	public function approveAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> pollId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->pollId->value as $id => $value) {
				$pollAprrove = $this -> pollObj -> updatePollApprovedColumnById($id, $this -> view -> sanitized -> status -> value);
				$answerResult = $this -> answerObj -> GetAllPoll_answerByPoll_idOrderById($id);
				$countAnswerResult = count($answerResult);
				for ($i = 0; $i < $countAnswerResult; $i++) {
					$answerApprove = $this -> answerObj -> updatePoll_answerApprovedColumnById($answerResult[$i]['id'], $this -> view -> sanitized -> status -> value);
				}
			}
			if (!empty($pollAprrove)) {
				header('Location: /admin/handle/pkg/poll/action/list/success/approve');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/poll/action/list/');
		exit();
	}

	public function publishAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		if (!empty($this -> view -> sanitized -> pollId -> value)) {
			$this -> view -> sanitized -> status -> value = $this -> view -> sanitized -> status -> value == 'Yes' ? 'Yes' : 'No';
			foreach ($this->view->sanitized->pollId->value as $id => $value) {
				$pollPublish = $this -> pollObj -> updatePollPublishedColumnById($id, $this -> view -> sanitized -> status -> value);
				$answerResult = $this -> answerObj -> GetAllPoll_answerByPoll_idOrderById($id);
				$countAnswerResult = count($answerResult);
				for ($i = 0; $i < $countAnswerResult; $i++) {
					$answerPublish = $this -> answerObj -> updatePoll_answerPublishedColumnById($answerResult[$i]['id'], $this -> view -> sanitized -> status -> value);
				}
			}
			if (!empty($pollPublish)) {
				header('Location: /admin/handle/pkg/poll/action/list/success/publish');
				exit();
			}
		}
		header('Location: /admin/handle/pkg/poll/action/list/');
		exit();
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> sanitized -> actionURI -> value = '/admin/handle/pkg/poll/action/';
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
		$this -> view -> sort -> published -> cssClass = 'sort-title';
		$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
		$this -> view -> sort -> approved -> cssClass = 'sort-title';
		$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
		$this -> view -> sort -> votesCount -> cssClass = 'sort-title';
		$this -> view -> sort -> votesCount -> href = $this -> view -> sanitized -> actionURI -> value . 'list/votesCount/asc';
		$this -> view -> sort -> dateAdded -> cssClass = 'sort-title';
		$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';

		if (isset($_GET['title']) && $_GET['title'] == 'asc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/desc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByTitleWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['title']) && $_GET['title'] == 'desc') {
			$this -> view -> sort -> title -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> title -> href = $this -> view -> sanitized -> actionURI -> value . 'list/title/asc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByTitleWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'asc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/desc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByPublishedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['published']) && $_GET['published'] == 'desc') {
			$this -> view -> sort -> published -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> published -> href = $this -> view -> sanitized -> actionURI -> value . 'list/published/asc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByPublishedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'asc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/desc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByApprovedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['approved']) && $_GET['approved'] == 'desc') {
			$this -> view -> sort -> approved -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> approved -> href = $this -> view -> sanitized -> actionURI -> value . 'list/approved/asc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByApprovedWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['votesCount']) && $_GET['votesCount'] == 'asc') {
			$this -> view -> sort -> votesCount -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> votesCount -> href = $this -> view -> sanitized -> actionURI -> value . 'list/votesCount/desc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByVotes_countWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['votesCount']) && $_GET['votesCount'] == 'desc') {
			$this -> view -> sort -> votesCount -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> votesCount -> href = $this -> view -> sanitized -> actionURI -> value . 'list/votesCount/asc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByVotes_countWithLimit('DESC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'asc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-asc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/desc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByDate_addedWithLimit('ASC', $this -> start, $this -> limit);
		} elseif (isset($_GET['dateAdded']) && $_GET['dateAdded'] == 'desc') {
			$this -> view -> sort -> dateAdded -> cssClass = 'sort-arrow-desc';
			$this -> view -> sort -> dateAdded -> href = $this -> view -> sanitized -> actionURI -> value . 'list/dateAdded/asc';
			$pollListResult = $this -> pollObj -> GetAllPollOrderByDate_addedWithLimit('DESC', $this -> start, $this -> limit);
		} else {
			$pollListResult = $this -> pollObj -> GetAllPollOrderByIdWithLimit($this -> start, $this -> limit, 'DESC');
		}
		$this -> pagingObj -> _init($this -> pollObj -> totalRecordsFound);
		$this -> view -> paging = $this -> pagingObj -> paging;
		$this -> view -> arrayToObject($this -> view -> paging);

		//listing
		$pollList = '';
		if (!empty($pollListResult) and false != $pollListResult) {
			foreach ($pollListResult as $key => $value) {
				$pollList .= '<tr>';
				$pollList .= '<td class="jstalgntop" style="text-align: center;"><input type="checkbox" name="pollId[' . $value['id'] . ']" id="check" value="Yes" /></td>';
				$pollList .= '<td class="jstalgntop">' . $value['title'] . '</td>';
				$pollList .= '<td class="jstalgntop">' . $this -> view -> __($value['published']) . '</td>';
				$pollList .= '<td class="jstalgntop">' . $this -> view -> __($value['approved']) . '</td>';
				$pollList .= '<td class="jstalgntop">' . $value['votes_count'] . '</td>';
				$pollList .= '<td class="jstalgntop">' . $value['date_added'] . '</td>';
				$pollList .= '<td class="jstalgntop last"><a href="/admin/handle/pkg/poll/action/edit/s/1/id/' . $value['id'] . '"
						class="modify fl" title="Edit"></a> <a href="javascript:void(0);"
			class="preview fl" title="Preview"></a></td>';
				$pollList .= '</tr>';
			}
		} else {
			$this -> view -> notificationMessage = $this -> view -> __('Sorry, no records found');
			$this -> view -> notificationMessageStyle = 'display: block;';
		}

		$this -> view -> pollList = $pollList;

		$this -> view -> render('poll/listPoll.phtml');
		exit();
	}

}
