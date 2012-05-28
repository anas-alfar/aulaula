<?php
class Aula_Model_Paging extends Aula_Model_Default {
	/**
	 * Standard paging variables
	 * Define start position of the items
	 * 
	 * @var integer
	 */
	public $start = 0;
	/**
	 * Standard paging variables
	 * Define items count that should be displayed on the frontend per page so we can calculate the pages count
	 * 
	 * @var integer
	 */
	public $totalRecordsPerPage = 50;
	/**
	 * Standard paging variables
	 * Define current page number
	 * 
	 * @var integer
	 */
	public $page = 1;
	/**
	 * Standard paging variables
	 * Define total number of pages
	 * 
	 * @var integer
	 */
	public $totalPages = 0;
	/**
	 * Standard paging variables
	 * Define total count of the items
	 * 
	 * @var integer
	 */
	public $totalRecordsCount = 0;
	/**
	 * Standard paging variables
	 * Define page URI 
	 * 
	 * @var string
	 */
	public $pageURI = NULL;
	/**
	 * Standard paging variables
	 * Define paging options like next, previous...etc 
	 * 
	 * @var array
	 */
	public $paging = array ();
	
	/**
	 * Display behavior variables
	 * Define pages count that should be displayed
	 * 
	 * @var integer
	 */
	public $displayedPagesCount = 10;
	/**
	 * Display behavior variables
	 * Define (if/if not) to display a "Next" button/image
	 * 
	 * @var boolean
	 */
	public $displayNextPage = true;
	/**
	 * Display behavior variables
	 * Define (if/if not) to display a "Previous" button/image
	 * 
	 * @var boolean
	 */
	public $displayPreviousPage = true;
	/**
	 * Display behavior variables
	 * Define (if/if not) to display a "First Page" button/image
	 * 
	 * @var boolean
	 */
	public $displayFirstPage = true;
	/**
	 * Display behavior variables
	 * Define (if/if not) to display a "Last Page" button/image
	 * 
	 * @var boolean
	 */
	public $displayLastPage = true;
	/**
	 * Display behavior variables
	 * Define (if/if not) to display a pages separator (3 | 4 | 5 | ... | 33 | 34)
	 * 
	 * @var boolean
	 */
	public $displayPagesSeperator = false;
	/**
	 * Display behavior variables
	 * Define position of the separator (after which page position)
	 * 
	 * @example $separatePagesPosition = 5 ; //1 | 2 | 3 | 4 | 5 | ... | 33 | 34
	 * @var integer
	 */
	public $separatePagesPosition = 5;
	/**
	 * Display behavior variables
	 * Define pages count to be displayed before the separator
	 * 
	 * @example $separatePagesPosition = 3 ; //1 | 2 | 3 | ...
	 * @var integer
	 */
	public $pagesBeforeSeparator = 5;
	/**
	 * Display behavior variables
	 * Define pages count to be displayed after the separator
	 * 
	 * @example $separatePagesPosition = 6 ; //... | 41 | 42 | 43 | 44 | 45 | 46 
	 * @var integer
	 */
	public $pagesAfterSeparator = 5;
	
	public function _init($totalRecordsCount = 0, $pageURI = NULL) {
		if (empty ( $totalRecordsCount )) {
			return;
		}

		if (is_null ( $pageURI )) {
			$pageURI = $_SERVER ['REQUEST_URI'];
		}
		
		$pageURI .= '/';
		$this->pageURI = preg_replace ( '#\/page{1}\/{1,}[0-9]{1,}\/+#', '/', $pageURI );
		$this->pageURI = str_replace ( '?', '/', $this->pageURI );
		$this->pageURI = str_replace ( '=', '/', $this->pageURI );
		$this->pageURI = str_replace ( '//', '/', $this->pageURI );
		
		$this->totalRecordsCount = $totalRecordsCount;
		
		if (isset ( $_GET ['page'] ) and is_numeric ( $_GET ['page'] )) {
			$this->page = ( int ) $_GET ['page'];
		}
		if (isset ( $_GET ['start'] ) and is_numeric ( $_GET ['start'] )) {
			$this->start = ( int ) $_GET ['start'];
		}
		if (isset ( $_GET ['limit'] ) and is_numeric ( $_GET ['limit'] )) {
			$this->totalRecordsPerPage = ( int ) $_GET ['limit'];
		}
		$this->totalPages = ceil ( $this->totalRecordsCount / $this->totalRecordsPerPage );
		$this->drawPaging ();
	}
	
	private function drawPaging() {
		if (empty ( $this->totalRecordsCount ) or ($this->totalRecordsCount <= $this->totalRecordsPerPage) or ($this->page > $this->totalPages)) {
			return;
		}
		if (false === $this->displayPagesSeperator) {
			for($i = 1; $i <= $this->totalPages; $i ++) {
				
				if ($this->totalPages > 10) {
					if ($i < ($this->page - 5)) {
						continue;
					}
					if ($i > ($this->page + 5)) {
						break;
					}
				}
				
				$this->paging ['pages'] [$i] ['id'] = $i;
				$this->paging ['pages'] [$i] ['uri'] = $this->pageURI . 'page/' . $i . '/';
				$this->paging ['pages'] [$i] ['class'] = '';
				if ($this->page == $i) {
					$this->paging ['pages'] [$i] ['class'] = 'current';
					$this->paging ['next'] ['class'] = '';
					$this->paging ['next'] ['uri'] = $this->pageURI . 'page/' . ($this->page + 1) . '/';
					$this->paging ['previous'] ['class'] = '';
					$this->paging ['previous'] ['uri'] = $this->pageURI . 'page/' . ($this->page - 1) . '/';
					if ($this->page == 1) {
						$this->paging ['previous'] = NULL;
						$this->paging ['next'] ['uri'] = $this->pageURI . 'page/2/';
						$this->paging ['next'] ['class'] = '';
					} elseif ($this->page == $this->totalPages) {
						$this->paging ['next'] = NULL;
						$this->paging ['previous'] ['uri'] = $this->pageURI . 'page/' . ($this->page - 1) . '/';
						$this->paging ['previous'] ['class'] = '';
					}
				}
			}
		}
	}
}

//$pagingObj = new Aula_Model_Paging ();
//$this->pagingObj->totalRecordsPerPage = $this->limit = 5;
//.....
//$this->buildPaging();
//$this->pagingObj->init ( $this->controllerObj->_totalRecordsFound );
//$this->view->paging = $this->pagingObj->paging;
//$this->view->arrayToObject ( $this->view->paging );
