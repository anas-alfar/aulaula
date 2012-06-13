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
 * @package Sitemap
 * @subpackage Controller
 * @name Sitemap_Controller_Default
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

class Sitemap_Controller_Default extends Aula_Controller_Action {
	
	private $articleObj = NULL;
	
	protected function _init() {
		$this->articleObj = new Object_Model_Article ();
		$this->categoryObj = new Category_Model_Default ();
		$this->defualtAction = 'default';
	}
	
	public function defaultAction() {
		$settings = Zend_Registry::get ( 'settings' );
		$articleResult = $this->articleObj->GetAllCleanObject_articleIdAndAliasAndDate_addedOrderByIdWithLimit ( 0, 49000 );
		$categoryResult = $this->categoryObj->GetAllCleanCategoryIdAndDate_addedOrderByIdWithLimit ( 0, 49000 );
		$changeFreq = null;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings->domain . '/]]></loc>
						<lastmod>' . date ( 'Y-m-d' ) . '</lastmod>
						<changefreq>always</changefreq>
					</url>';
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings->domain . '/object-article/add-article]]></loc>
						<changefreq>never</changefreq>
					</url>';
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings->domain . '/object-article/add-news]]></loc>
						<changefreq>never</changefreq>
					</url>';
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings->domain . '/index/contact-us]]></loc>
						<changefreq>never</changefreq>
					</url>';
		if (is_array ( $categoryResult ) && ! empty ( $categoryResult )) {
			for($i = 0; $i < $this->categoryObj->totalRecordsFound; $i ++) {
				$sitemap .= '<url>
								<loc><![CDATA[http://' . $settings->domain . '/object-article/list/category/' . $categoryResult [$i] ['id'] . ']]></loc>
								<lastmod>' . date ( 'Y-m-d' ) . '</lastmod>
								<changefreq>daily</changefreq>
							</url>';
			}
		}
		if (is_array ( $articleResult ) && ! empty ( $articleResult )) {
			for($i = 0; $i < $this->articleObj->totalRecordsFound; $i ++) {
				$articleTime = strtotime ( $articleResult [$i] ['date_added'] );
				$now = time ();
				$secondsDiff = ($now - $articleTime);
				
				switch ($secondsDiff) {
					case ($secondsDiff < 1 * 60 * 60) :
						$changeFreq = 'hourly';
						break;
					case ($secondsDiff < 24 * 60 * 60) :
						$changeFreq = 'hourly';
						break;
					case ($secondsDiff < 7 * 24 * 60 * 60) :
						$changeFreq = 'weekly';
						break;
					case ($secondsDiff < 30 * 24 * 60 * 60) :
						$changeFreq = 'monthly';
						break;
					default :
						$changeFreq = 'yearly';
						break;
				}
				$sitemap .= '<url>
								<loc><![CDATA[http://' . $settings->domain . '/object-article/view/id/' . $articleResult [$i] ['id'] . ']]></loc>
								<lastmod>' . substr ( $articleResult [$i] ['date_added'], 0, 10 ) . '</lastmod>
								<changefreq>' . $changeFreq . '</changefreq>
							</url>';
			}
			$sitemap .= PHP_EOL . "\t</urlset>";
		}
		
		header ( 'Content-type: application/xml' );
		echo $sitemap;
		exit ();
	}

}
