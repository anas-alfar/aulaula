<?php 

class Aula_Model_Validator_NumericUnsigned extends Zend_Validate_Abstract {
	const NOT_NUMERIC_UNSIGNED = 'valueIsNotNumericUnsigned';

	protected $_messageTemplates = array(self::NOT_NUMERIC_UNSIGNED => 'Value is not Numeric Unsigned');

	/**
	 * Check if the element using this validator is valid
	 *
	 * This method will compare the $value of the element to the other elements
	 * it needs to match. If they all match, the method returns true.
	 *
	 * @param $value string
	 * @param $context array All other elements from the form
	 * @return boolean Returns true if the element is valid
	 */
	public function isValid($value, $context = null) {
		$value = (string)$value;
		$this -> _setValue($value);

		$error = false;

		if (!is_numeric($value) || $value < 0) {
			$error = true;
			$this -> _error(self::NOT_NUMERIC_UNSIGNED);
		}

		return !$error;
	}

}
