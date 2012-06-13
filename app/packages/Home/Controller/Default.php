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
	
	public function aboutusAction() {
		$this -> view -> render('aboutus.phtml');
	}
	
	public function contactusAction() {
		$this -> view -> render('contactus.phtml');
	}
	
	public function missionAction() {
		$this -> view -> render('mission.phtml');
	}
	
	public function servicesAction() {
		$this -> view -> render('services.phtml');
	}

}
