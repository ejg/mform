<?php

/*
 * Em_Form
 *
 * Author - Emily Gillcoat
 *
 * creates a label/form element pair wrapped in a div
 *
 */
class Form_Driver {

	private $id = '';
	private $values = array();
	private $optionals = array();
	private $decimals = array();

public function __construct($values=array())
{
	$this->values = $values;
}

public function open($action = NULL, $attr = array())
{
	if (array_key_exists('id', $attr))
	{
		$this->id = $attr['id'];
	}
	return form::open($action, $attr);
}

public function set_id($id)
{
	$this->id = $id;
	return $this;
}

public function close()
{
	return form::close();
}

public function set_decimals($decimals)
{
	$this->decimals = $decimals;
}
/*
 * set the values after a post
 */
public function set_values($values)
{
	$this->values = $values;
	foreach ($this->decimals as $field=>$place)
	{
		if (isset($values[$field]) && (is_numeric($values[$field])))
		{
			$this->values[$field] = number_format($values[$field], $place);
		}
	}
}

public function set_optionals($optionals)
{
	$this->optionals = $optionals;
}

public function get_optionals()
{
	return $this->optionals;
}

/*
 * creates a form pair
 *
 * if there is a value for this data (from a $_POST), set it
 *
 * if there are options defined in the form_options_model, it is a select and set the options.
 */
public function pair($data, $data_opt = NULL)
{
	$pair = new Form_Pair($data, $this->id);
	$name = $pair->get_name();
	$val = '';

	if (!isset($this->values[$name]))
	{
		$val = isset($this->optionals[$name]) ? $this->optionals[$name] : $this->get_value($this->values,$name);
	}
	$pair->value( (isset($this->values[$name])) ? $this->values[$name] : $val);

	if (method_exists('Model_Form_options', $name))
	{
		if ($data_opt === NULL)
		{
			$pair->options(Model_Form_options::$name());
		}
		else
		{
			$pair->options(Model_Form_options::$name($data_opt));
		}
	}
	return $pair;
}

function get_values()
{
	return $this->values;
}


function get_value($array, $string)
{
	$val = '';
    $i = preg_split('/[][]+/', $string, -1, PREG_SPLIT_NO_EMPTY);

	if (count($i) > 1)
	{
		$first = $i[0];
		$second = $i[1];
		if (isset($array[$first]))
		{
			$val = $array[$first][$second];
		}
	}
    return $val;
}




public function get_form_fields()
{
	return $this->form_fields;
}

/*
 * return true if this option is the first option
 */
public function is_first_option($opt)
{
	return (Form_options_Model::is_first_option($opt));
}

/*
 * return true if this option is the last option
 */
public function is_last_option($opt)
{
	return (Form_options_Model::is_last_option($opt));
}

}




?>