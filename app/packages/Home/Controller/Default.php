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
 * @package Home
 * @subpackage Controller
 * @name Home_Controller_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Mohammad R. Mousa <mohammad.riad@gmail.com>
 *
 */

class Home_Controller_Default extends Aula_Controller_Action {

	private $bannerObj = '';
	private $bannerAreaObj = '';
	private $featureList = '';
	private $articleObj = '';
	private $photoObj = '';
	private $usersObj = '';
	private $menuObj = '';
	private $featureArticles = '';

	private $newsInternationalList = NULL;
	private $newsEntertainmentList = NULL;

	protected function _init() {
		/*
		 $layout = new Zend_Layout();
		 $layout -> setLayout('layout');

		 $layout -> setLayoutPath($this -> fc -> settings -> directories -> frontend_default_theme_layout);
		 $layout -> content = '$content//////////////////';
		 $layout -> nav = '$nav';
		 echo $layout -> render();*/
	}

	public function defaultAction() {
		$this -> view -> render('index.phtml');
	}

	public function contactusAction() {
		if (isset($_POST) AND !empty($_POST)) {
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$body = trim($_POST['body']);

			if (!empty($name) AND !empty($email) AND !empty($body)) {
				try {
					$configMail = array('auth' => 'login', 'username' => 'mohammad.riad@gmail.com', 'password' => 'ccfkwndyrrtfwefh', 'ssl' => 'ssl', 'port' => 465);

					$email_body = 'This email From: <b>' . $name . '</b><br />';
					$email_body .= 'His/Her email is: <b>' . $email . '</b><br />';
					$email_body .= 'And the message is:<br /><br /> ' . $body;

					$mailTransport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $configMail);
					Zend_Mail::setDefaultTransport($mailTransport);

					$mail = new Zend_Mail('utf-8');
					$mail -> setFrom('mohammad.riad@gmail.com', $name);
					$mail -> setBodyHtml($email_body);
					$mail -> addTo('mohammad.riad@gmail.com', 'Mohammad R. Mousa');
					$mail -> setSubject('CAR2DAR Contact us');
					$mail -> send();

				} catch (Zend_Exception $e) {
				}
			}
		}
		$this -> view -> render('contactus.phtml');
	}

}
