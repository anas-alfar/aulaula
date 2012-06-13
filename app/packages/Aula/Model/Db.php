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
 * @package Aula - Core
 * @subpackage Model
 * @name Aula_Model_Db
 * @copyright Copyright (c) 2012 Aulaula (http://www.aulaula.com/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @author Anas K. Al-Far <anas@al-far.com>
 *
 */

require_once 'Zend/Db.php';
require_once 'Zend/Db/Adapter/Pdo/Mysql.php';
require_once 'Zend/Db/Statement/Mysqli.php';
require_once 'Zend/Db/Table/Abstract.php';

class Aula_Model_Db {
	
	private $profilerLogMsg = '';
	
	public static $connection;
	public static $instance;
	public static $profiler = false;
	
	static public function __getInstance() {
		if (self::$instance instanceof Aula_Model_Db) {
			return self::$instance;
		}
		return self::$instance = new Aula_Model_Db ();
	}
	
	private function profiler($profilerLogMsg = '') {
		if (self::$profiler) {
			$this->profilerLogMsg .= $profilerLogMsg;
		}
	}
	
	public function isConnected() {
		if (! self::$connection->isConnected ()) {
			self::$connection->getConnection ();
			return self::$connection->isConnected ();
		}
		return true;
	}
	
	private function setFetchMode($mode) {
		if ($this->isConnected ()) {
			return self::$connection->setFetchMode ( ( int ) $mode );
		}
		return true;
	}
	
	public function lastInsertId() {
		if ($this->isConnected ()) {
			return self::$connection->lastInsertId ();
		}
		return false;
	}
	
	private function __construct() {
		//get default db settings
		$settings = ( object ) NULL;
		$settings->db = Zend_Registry::get ( 'settings-db' );
		self::$profiler = ( boolean ) $settings->db->params->profiler;
		
		if (self::$profiler) {
			$this->profiler ( 'Trying to connect using Zend_Db_Adapter_Pdo_Mysql at ' . time () . PHP_EOL );
		}
		
		try {
			self::$connection = Zend_Db::factory ( 'Pdo_Mysql', array ('host' => $settings->db->params->host, 'username' => $settings->db->params->user, 'password' => $settings->db->params->pass, 'dbname' => $settings->db->params->name ) );
			$connectivity = $this->isConnected ();
			Zend_Db_Table_Abstract::setDefaultAdapter ( self::$connection );
			
			if ($connectivity) {
				$this->profiler ( 'Connectino to DB establihed at  ' . time () . PHP_EOL );
			}
			$this->setFetchMode ( $settings->db->params->fetch_mode );
		
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
	}
	
	public function __destruct() {
		self::$connection->closeConnection ();
		
		if (self::$profiler) {
			$this->profiler ( 'Trying to close connection at ' . time () . PHP_EOL );
			echo nl2br ( $this->profilerLogMsg );
		}
	}
	
	public function fetch($query) {
		$this->isConnected ();
		if (self::$profiler) {
			$startTime = microtime ( true );
		}
		
		$return = array ();
		
		try {
			$result = self::$connection->fetchAll ( $query );
			
			if (self::$profiler) {
				$endTime = microtime ( true );
				$this->profiler ( 'Timing: ' . ($endTime - $startTime) . PHP_EOL );
				$this->profiler ( '========================================' . PHP_EOL );
				$this->profiler ( '#QUERY:' . $query . PHP_EOL );
			}
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
		return $result;
	}
	
	public function query($query) {
		$this->isConnected ();
		if (self::$profiler) {
			$startTime = microtime ( true );
		}
		
		$return = array ();
		
		try {
			self::$connection->query ( $query );
			$result = self::$connection->commit ();
			
			if (self::$profiler) {
				$endTime = microtime ( true );
				$this->profiler ( 'Timing: ' . ($endTime - $startTime) . PHP_EOL );
				$this->profiler ( '========================================' . PHP_EOL );
				$this->profiler ( '#QUERY:' . $query . PHP_EOL );
			}
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
		return $result;
	}
	
	public function prepare($query, $data) {
		$this->isConnected ();
		if (self::$profiler) {
			$startTime = microtime ( true );
		}
		
		$return = array ();
		
		try {
			/**
			 * this works fine but the second code is better since we don't need to handle the statement type
			 */
			//$stmt = new Zend_Db_Statement_Pdo(self :: $connection, $query);
			//$result = $stmt->execute($data);
			//$result = $stmt->fetchAll();
			

			/**
			 * just working fine
			 */
			$stmt = self::$connection->query ( $query, $data );
			$result = $stmt->fetchAll ();
			
			if (self::$profiler) {
				$endTime = microtime ( true );
				$this->profiler ( 'Timing: ' . ($endTime - $startTime) . PHP_EOL );
				$this->profiler ( '========================================' . PHP_EOL );
				$this->profiler ( '#QUERY:' . $query . PHP_EOL );
			}
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
		return $result;
	}
	
	public function insert($table, $data) {
		$this->isConnected ();
		if (self::$profiler) {
			$startTime = microtime ( true );
		}
		
		try {
			$result = self::$connection->insert ( $table, $data );
			
			if (self::$profiler) {
				$endTime = microtime ( true );
				$this->profiler ( 'Timing: ' . ($endTime - $startTime) . PHP_EOL );
				$this->profiler ( '========================================' . PHP_EOL );
				$this->profiler ( '#QUERY:' . $query . PHP_EOL );
			}
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
		return $result;
	}
	
	public function update($table, $data, $where = '') {
		$this->isConnected ();
		if (self::$profiler) {
			$startTime = microtime ( true );
		}
		
		try {
			$result = self::$connection->update ( $table, $data, $where );
			
			if (self::$profiler) {
				$endTime = microtime ( true );
				$this->profiler ( 'Timing: ' . ($endTime - $startTime) . PHP_EOL );
				$this->profiler ( '========================================' . PHP_EOL );
				$this->profiler ( '#QUERY:' . $query . PHP_EOL );
			}
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
		return $result;
	}
	
	public function delete($table, $where) {
		$this->isConnected ();
		if (self::$profiler) {
			$startTime = microtime ( true );
		}
		
		try {
			$result = self::$connection->delete ( $table, $where );
			
			if (self::$profiler) {
				$endTime = microtime ( true );
				$this->profiler ( 'Timing: ' . ($endTime - $startTime) . PHP_EOL );
				$this->profiler ( '========================================' . PHP_EOL );
				$this->profiler ( '#QUERY:' . $query . PHP_EOL );
			}
		} catch ( Aula_Model_Exception $ex ) {
		/**
		 * @todo: handle errors
		 */
		}
		return $result;
	}
	
	public function totalRecordsFound() {
		$query = "SELECT FOUND_ROWS() AS FOUND_ROWS";
		$totalRecordsFound = $this->fetch ( $query );
		
		if (is_null ( $totalRecordsFound ) || ! is_array ( $totalRecordsFound ) || ! isset ( $totalRecordsFound [0] ['FOUND_ROWS'] )) {
			unset ( $totalRecordsFound );
			return 0;
		}
		return $totalRecordsFound [0] ['FOUND_ROWS'];
	}

}
