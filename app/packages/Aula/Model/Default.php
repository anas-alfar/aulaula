<?php

class Aula_Model_Default {
	
	protected $_dbLink = NULL;
	protected $_settings = NULL;
	
	public function __construct($params = NULL) {
		if (method_exists ( $this, '_init' )) {
			if (is_null ( $params )) {
				$this->_init ();
			} else {
				$this->_init ( $params );
			}
		}
		
		return $this;
	}
}