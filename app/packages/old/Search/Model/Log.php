<?php
/**
 * 
 * This class generates standard stored methods for every table in your database
 * This means that at the end of execution you'll have 5 stored methods for each table 
 * Those stored methods are:
 * 
 * - Get All Fields and Records From Table
 * - Get All Fields From Table By Primary Key
 * - Get All Fields From Table By Each Column
 * - Insert Into Table
 * - Update Statement By Primary Key
 * - Update Statement By Each Column
 * - Update Statement for Each Column By Primary Key
 * - Delete from Table By Primary Key
 * - Delete from Table By Each Column
 * 
 * 
 * @name Search_Model_Log
 * @author Anas K. Al-Far <anas@al-far.com>
 * @copyright http://anas.al-far.com/ 
 * @copyright Anas K. Al-Far
 * @copyright The Stored Methods Auto Generator Class has been released with source code under the LGPL free software license.
 * @access public
 *
 */
class Search_Model_Log {
	
	public $dbLink = null;
	public $_totalRecordsFound = 0;
	
	/**
	 * @Table Columns
	 */
	public $tablename = 'search_log';
	public $columns = array ('search_term', 'hits');
	public $start = 0;
	public $limit = 10;
	public $sorting = 'DESC';
	public $Search_term = '';
	public $Hits = '0';
	
	public function __construct() {
		$this->dbLink = Aula_Model_Db::__getInstance ();
	}
	
	/**
	 * This Method is Script Generated 
	 * insertIntoSearch_log
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function insertIntoSearch_log($Search_term = '', $Hits = '0') {
		
		$Search_term = mysql_escape_string ( $Search_term );
		$Hits = ( int ) $Hits;
		
		$query = "CALL SP_insertIntoSearch_log ('$Search_term', '$Hits')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return $result;
	} //End Function insertIntoSearch_log
	

	/**
	 * This Method is Script Generated 
	 * deleteFromSearch_logById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromSearch_logById() {
		
		$query = "CALL SP_deleteFromSearch_logById ('')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromSearch_logById
	

	/**
	 * This Method is Script Generated 
	 * updateSearch_logById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateSearch_logById($Search_term = '', $Hits = '0') {
		
		$Search_term = mysql_escape_string ( $Search_term );
		$Hits = ( int ) $Hits;
		
		$query = "CALL SP_updateSearch_logById ('$Search_term', '$Hits')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateSearch_logById
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logOrderById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logOrderById($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logOrderById ('$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logOrderByIdWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logOrderByIdWithLimit($start = 0, $limit = 10, $sorting = 'DESC') {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logOrderByIdWithLimit ('$start' , '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getSearch_logDetailsByIdWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getSearch_logDetailsByIdWithLimit($start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		
		$query = "CALL SP_getSearch_logDetailsByIdWithLimit ('', '$start' , '$limit')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getSearch_logDetailsByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * getSearch_logDetailsById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function getSearch_logDetailsById() {
		
		$query = "CALL SP_getSearch_logDetailsById ('')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function getSearch_logDetailsById
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logOrderBySearch_term
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logOrderBySearch_term($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logOrderBySearch_term ('$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logOrderBySearch_term
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logOrderBySearch_termWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logOrderBySearch_termWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logOrderBySearch_termWithLimit ('$sorting', '$start' , '$limit')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logOrderBySearch_termWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logByIdOrderBySearch_term
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logByIdOrderBySearch_term($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logByIdOrderBySearch_term (, '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logByIdOrderBySearch_term
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logByIdOrderBySearch_termWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logByIdOrderBySearch_termWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logByIdOrderBySearch_termWithLimit ('', '$sorting', '$start' , '$limit')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logByIdOrderBySearch_termWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logBySearch_termOrderById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logBySearch_termOrderById($Search_term = '', $sorting = 'DESC') {
		
		$Search_term = mysql_escape_string ( $Search_term );
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logBySearch_termOrderById ('$Search_term', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logBySearch_termOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logBySearch_termOrderByIdWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logBySearch_termOrderByIdWithLimit($Search_term = '', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Search_term = mysql_escape_string ( $Search_term );
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logBySearch_termOrderByIdWithLimit ('$Search_term', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logBySearch_termOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromSearch_logBySearch_term
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromSearch_logBySearch_term($Search_term = '') {
		
		$Search_term = mysql_escape_string ( $Search_term );
		
		$query = "CALL SP_deleteFromSearch_logBySearch_term ('$Search_term')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromSearch_logBySearch_term
	

	/**
	 * This Method is Script Generated 
	 * updateSearch_logSearch_termColumnById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateSearch_logSearch_termColumnById($Search_term = '') {
		
		$Search_term = mysql_escape_string ( $Search_term );
		
		$query = "CALL SP_updateSearch_logSearch_termColumnById ('', '$Search_term')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateSearch_logSearch_termColumnById
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logOrderByHits
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logOrderByHits($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logOrderByHits ('$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logOrderByHits
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logOrderByHitsWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logOrderByHitsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logOrderByHitsWithLimit ('$sorting', '$start' , '$limit')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logOrderByHitsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logByIdOrderByHits
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logByIdOrderByHits($sorting = 'DESC') {
		
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logByIdOrderByHits (, '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logByIdOrderByHits
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logByIdOrderByHitsWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logByIdOrderByHitsWithLimit($sorting = 'DESC', $start = 0, $limit = 10) {
		
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logByIdOrderByHitsWithLimit ('', '$sorting', '$start' , '$limit')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logByIdOrderByHitsWithLimit
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logByHitsOrderById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logByHitsOrderById($Hits = '0', $sorting = 'DESC') {
		
		$Hits = ( int ) $Hits;
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logByHitsOrderById ('$Hits', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logByHitsOrderById
	

	/**
	 * This Method is Script Generated 
	 * GetAllSearch_logByHitsOrderByIdWithLimit
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function GetAllSearch_logByHitsOrderByIdWithLimit($Hits = '0', $start = 0, $limit = 10, $sorting = 'DESC') {
		
		$Hits = ( int ) $Hits;
		$start = ( int ) ($start);
		$limit = ( int ) ($limit);
		$sorting = mysql_escape_string ( $sorting );
		
		$query = "CALL SP_GetAllSearch_logByHitsOrderByIdWithLimit ('$Hits', '$start', '$limit', '$sorting')";
		
		$result = $this->dbLink->fetch ( $query );
		
		if (! $result) {
			return false;
		}
		
		$query = "SELECT FOUND_ROWS()";
		$this->_totalRecordsFound = $this->dbLink->fetch ( $query );
		
		if (is_null ( $this->_totalRecordsFound ) || ! is_array ( $this->_totalRecordsFound ) || ! isset ( $this->_totalRecordsFound [0] [0] )) {
			$this->_totalRecordsFound = 0;
		} else {
			$this->_totalRecordsFound = $this->_totalRecordsFound [0] [0];
		}
		
		return $result;
	} //End Function GetAllSearch_logByHitsOrderByIdWithLimit
	

	/**
	 * This Method is Script Generated 
	 * deleteFromSearch_logByHits
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function deleteFromSearch_logByHits($Hits = '0') {
		
		$Hits = ( int ) $Hits;
		
		$query = "CALL SP_deleteFromSearch_logByHits ('$Hits')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function deleteFromSearch_logByHits
	

	/**
	 * This Method is Script Generated 
	 * updateSearch_logHitsColumnById
	 * Generated Date: 2010-04-26 02:08:47 
	 * Author: Anas K. Al-Far 
	 * Copyright: anas@alfar.com 
	 * Copyright: http://anas.al-far.com/ 
	 */
	public function updateSearch_logHitsColumnById($Hits = '0') {
		
		$Hits = ( int ) $Hits;
		
		$query = "CALL SP_updateSearch_logHitsColumnById ('', '$Hits')";
		
		$result = $this->dbLink->query ( $query );
		
		if (! $result) {
			return false;
		}
		
		return true;
	} //End Function updateSearch_logHitsColumnById
}