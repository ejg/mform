<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Creates a custom exception.
 */


class Form_Exception extends Kohana_Exception {

 private $errors;
	/**
	 * Set exception title and message.
	 *
	 * @param   string  exception title string
	 * @param   string  exception message string
	 * @param   string  custom error template
	 */
	public function __construct($errors)
	{
		$this->errors = $errors;

	}

	public function get_errors()
	{
		return $this->errors;
	}

} // End Kohana PHP Exception
?>