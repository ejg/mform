<?php defined('SYSPATH') or die('No direct script access.');

class Example_form_Model extends Model {


	function __contruct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function send_mail($my_info)
    {
		$post = new Validation($my_info);

		if ($this->validate($post) )
		{
// save info in database or send email
		}
		else
		{
			throw new Form_Exception($post->errors('form_error_messages'));
		}

    }

	public function validate($post)
	{

		$post->add_rules('name', 'required');
		$post->add_rules('email', 'required', array('valid','email'));
		return $post->validate();
	}

}
?>