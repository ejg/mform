<?php defined('SYSPATH') OR die('No direct access allowed.');

class Example_form_Controller extends Website_Controller {

	protected $form;
	protected $form_model;

	public function __construct()
   {
		parent::__construct();
//		$this->template = new View('template');
		$this->form = new Em_Form;
		$this->form_model = new Example_form_Model;
   }


	public function index()
	{
		$this->template->content = new View('example_form');
		$this->template->title = 'Form Examples';
		$this->template->content->form = $this->form;

		$value = $this->input->post();
		if ($value == NULL)
		{
			$this->template->content->messages	= '';
		}
		else
		{
			try
			{
//	valid form...do whatever here!
				$this->form_model->send_mail($value);
				$this->template->content->messages = 'Your form has been submitted!';
			}
			catch (Form_Exception $e)
			{
// not valid form...reset values and display the errors
				$this->form->set_values($value);
				$this->template->content->messages = $e->get_errors();
			}
		}

	}
}
?>