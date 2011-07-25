<?php

/*
 * form_helper extension
 *
 * form_pairs
 *
 * creates a label/form element pair wrapped in a div
 *
 * $data is an array that has the form field attributes plus label, type and class.
 * $value is the default value
 * $extra is a string of extra information (js or such)
 *
 *
 */
class Form_Pair {

	private $name;
	private $data = array();
	private $label = '';
	private $label_extra = array();
	private $value = '';
	private $id = '';
	private $extra = '';
	private $div = 'row';
	private $type = 'input';
	private $attr = array();
	private $options;
	private $default = FALSE;
	private $table = FALSE;
	private $form_id = '';

	private $pair = '';

	/*
	 *  sets the name and data fields based on whether an array or string was passed in
	 *
	 *  sets the form_id so field ids are unique
	 *
	 */
	public function __construct($data,$form_id)
	{
		$this->name = $data;
		$this->form_id = ($form_id == '') ? '' : '-'.$form_id;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function id_add($string)
	{
		$this->name = $this->name.'-'.$string;
		return $this;
	}

	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	public function table($table)
	{
		$this->table = $table;
		return $this;
	}


	/*
	 *  set the extra label info, i.e. title
	 *  the parameter is a string
	 */
	public function label_extra($label_extra)
	{
		$this->label_extra = array_merge($this->label_extra, (array)$label_extra);
//		$this->label_extra = $label_extra;
		return $this;
	}

	/*
	 *  set the type, default is input
	 *  set the options if this is a checkbox that is checked
	 */
	public function type($type)
	{
		$this->type = $type;

		if (($this->type == 'cb') && ($this->value != ''))
		{
			$this->options(TRUE);
		}

		return $this;
	}


	public function options($options)
	{
		$this->options = $options;
		return $this;
	}

	public function attr($attr)
	{
		$this->attr = $attr;
		return $this;
	}


	/*
	 *  set the div	class name, the default is row
	 */
	public function div($div)
	{
		$this->div = $div;
		return $this;
	}

	/*
	 * set the default, used for checkboxes and radio buttons
	 */

	public function def($default)
	{
		$this->default = $default;
		return $this;
	}

	public function value($value)
	{
	// if value is already set from $_POST, do not reset
		if ($this->value === '')
		{
			$this->value = $value;
		}

		return $this;
	}

	public function extra($extra)
	{
		$this->extra = $extra;
		return $this;
	}

	/*
	 * set up the data based on type
	 */
	public function create()
	{

		if (($this->default) && ($this->type=='cb'))
		{
			$this->options(TRUE);
		}

		if ($this->type=='rb')
		{
			$this->create_radio();
		}
		else
		{
			$data = $this->set_data_array();
			$this->create_pair($data,$this->label);
		}

		return $this->pair;
	}

	/*
	 * create the div, label and input
	 * call the form helper based on type to create input
	 *
	 * the form element is given an id and the label uses that id with the for attribute
	 *
	 * Note: the form helper does not have all the parameters in the same order for all
	 * its functions that create form fields. The My_form helper extension is needed to
	 * rearrange the parameters into the correct order.
	 */
	private function create_pair($data,$label)
	{
		if ($this->div !== false)
		{
			$this->pair .= "<div class=\"{$this->div}\">";
		}
		$this->create_label($label);
		$field = $this->type;
		$this->pair .=  form::$field($this->name,$this->value, $this->attr, $this->options);
		if ($this->div !== false)
		{
			$this->pair .=  "</div>";
		}

	}

	/*
	 * create a set of radio buttons. Wrap all button in div rrow - 9/9/10 - removed wrapper rrow div
	 */
	private function create_radio()
	{
		$this->default = ($this->value != '') ? $this->value : $this->default;

		if ($this->table)
		{
			$this->pair .= '<table summary="question" class="rrow">';
				$this->pair .= '<tbody>';

		}
//		else
//		{
//			$this->pair .=  "<div class=\"rrow\">";
//		}
		$i = 1;
		foreach ($this->label as $label=>$value)
		{

			# this is a fix for core grammar because the where the label is in the value because in some labels the
			# only difference is in capitialization which is causing the values to be overwritten
			if ($this->table)
			{
				$data = $this->set_data_radio($label);
				$this->value = $label;
				if ($i % 2 == 0)
				{
					$this->pair .= '<td>';
					$this->create_pair($data,$value);
					$this->pair .='</td></tr>';
				}
				else
				{
					$this->pair .= '<tr><td>';
					$this->create_pair($data,$value);
					$this->pair .='</td>';
				}
			}
			else
			{
				$data = $this->set_data_radio($value);
				$this->value = $value;
				$this->create_pair($data,$label);
			}
			$i++;
		}
		if ($this->table)
		{
				$this->pair .= '</tbody>';
			$this->pair .= '</table>';

		}
//		else
//		{
//			$this->pair .= "</div>";
//		}
	}

	/*
	 *	this takes the name and value and sets them in an array to send to the super form_helper
	 *  this also sets the id to be the name so the label will be associated with this field
	 */
	private function set_data_array()
	{
		if ($this->type != 'hidden') {

			$name = str_replace(' ','_',$this->name);
			$this->id = $name.$this->form_id;

			$this->attr['id'] = $this->id;

			if ($this->type == 'textarea')
			{
				$this->checkRowCol();
			}
		}
		else
		{
			$this->data[$this->name] = $this->value;
			unset($this->data['name']);
		}
		return $this->data;
	}

	public function checkRowCol()
	{
		if (! isset ($this->data['rows'] ))
		{
			$this->data['rows'] = 10;
		}
		if (! isset ($this->data['cols'] ))
		{
			$this->data['cols'] = 15;
		}
		return $this;
	}

	/*
	 * set the radio button ids based off the of common name
	 */
	private function set_data_radio($value)
	{
		$data['name'] = $this->name;
		$data['id'] = $this->name.'_'.$value;
		$this->id = $data['id'];
		$this->attr['id'] = $this->id;
		$this->options = ($value == $this->default);

		return $data;
	}

	private function set_value($data, $value)
	{
		$val = ($value == '' && isset($this->values[$data])) ? $this->values[$data] : $value;
		return $val;
	}

	/*
	 * create the label if it is not set to false
	 */
	private function create_label($label)
	{
		if ($mylabel = $this->get_label($label))
		{
			$this->pair .=  form::label($this->id, $mylabel, $this->label_extra);
		}

	}

	public function get_label($label)
	{
		$alabel = ($label === '') ? $this->get_default_label() : $label;
		return $alabel;
	}

	/*
	 * the default label is the field name with spaces replaced by '_'
	 */
	private function get_default_label()
	{
		return ucfirst(str_replace('_', ' ', $this->name));
	}


	public function get_options()
	{
		return $this->options;
	}



}

?>