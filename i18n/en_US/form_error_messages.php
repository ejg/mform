<?php defined('SYSPATH') or die('No direct access allowed.');

$lang = array
(
	'name' => Array
		(
			'required' => 'Name is a required field.',
			'default' => 'Invalid Input.'
		),
	'email' => Array
		(
			'required' => 'Email is a required field.',
			'email' => 'Please enter a valid email address',
			'default' => 'Invalid Input.'
		),
	'captcha_response' => Array
		(
			'required' => 'Validation Code is a required field.',
			'default' => 'Invalid Validation Code.'
		)
);

?>