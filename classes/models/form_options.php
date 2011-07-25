<?php defined('SYSPATH') or die('No direct script access.');

/* Class Form_options
 *
 * This class holds all the data for the dropdowns - state, country, months, years
 */

class Form_options_Model extends Model {


	static public function css_type()
	{
		return array ('default'=>'Default','none'=>'None','3270_terminal'=>'3270 Terminal','frontpage'=>'Frontpage','business'=>'Business','web_2.0'=>'Web 2.0','textures'=>'Textures','dark'=>'Dark');
	}

	static public function example()
	{
		return array ('one'=>'This One','two'=>'Two','three'=>'More');
	}

	static public function is_first_option($opt)
	{
		$types = Form_options_Model::css_type();
		return (reset($types) == $types[$opt]);
	}

	static public function is_last_option($opt)
	{
		$types = Form_options_Model::css_type();
		return (end($types) == $types[$opt]);
	}

}
?>