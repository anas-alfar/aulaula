<?php

class Sitemap_Controller_Default extends Aula_Controller_Action {

	private $articleObj = NULL;

	protected function _init() {
		$this -> articleObj = new Object_Model_Article();
		$this -> categoryObj = new Category_Model_Default();
		$this -> defualtAction = 'default';
	}

	public function defaultAction() {
		$settings = Zend_Registry::get('settings');
		$articleResult = $this -> articleObj -> GetAllCleanObject_articleIdAndAliasAndDate_addedOrderByIdWithLimit(0, 49000);
		$categoryResult = $this -> categoryObj -> GetAllCleanCategoryIdAndDate_addedOrderByIdWithLimit(0, 49000);
		$changeFreq = null;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings -> domain . '/]]></loc>
						<lastmod>' . date('Y-m-d') . '</lastmod>
						<changefreq>always</changefreq>
					</url>';
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings -> domain . '/object-article/add-article]]></loc>
						<changefreq>never</changefreq>
					</url>';
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings -> domain . '/object-article/add-news]]></loc>
						<changefreq>never</changefreq>
					</url>';
		$sitemap .= '<url>
						<loc><![CDATA[http://' . $settings -> domain . '/index/contact-us]]></loc>
						<changefreq>never</changefreq>
					</url>';
		if (is_array($categoryResult) && !empty($categoryResult)) {
			for ($i = 0; $i < $this -> categoryObj -> _totalRecordsFound; $i++) {
				$sitemap .= '<url>
								<loc><![CDATA[http://' . $settings -> domain . '/object-article/list/category/' . $categoryResult[$i]['id'] . ']]></loc>
								<lastmod>' . date('Y-m-d') . '</lastmod>
								<changefreq>daily</changefreq>
							</url>';
			}
		}
		if (is_array($articleResult) && !empty($articleResult)) {
			for ($i = 0; $i < $this -> articleObj -> _totalRecordsFound; $i++) {
				$articleTime = strtotime($articleResult[$i]['date_added']);
				$now = time();
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
								<loc><![CDATA[http://' . $settings -> domain . '/object-article/view/id/' . $articleResult[$i]['id'] . ']]></loc>
								<lastmod>' . substr($articleResult[$i]['date_added'], 0, 10) . '</lastmod>
								<changefreq>' . $changeFreq . '</changefreq>
							</url>';
			}
			$sitemap .= PHP_EOL . "\t</urlset>";
		}

		header('Content-type: application/xml');
		echo $sitemap;
		exit();
	}

}
