<?php

/*
 * form extension
 *
 * MY_form
 *
 * This extends the form_Core because form_Core does not have all parameters in the same order
 *
 * ie. input has the order ($data, $value, $extra, $options) while
 * dropdown has the order ($data, $options, $value, $extra)
 *
 * This is needed because the Form_Pair expects every form function to have the parameters in the same order
 *
 */
class Form extends Kohana_Form {


public static function dropdown($name,  $value = NULL, $attr = NULL, array $options = NULL)
{
	return parent::select($name, $options, $value, $attr);
}

public static function xxselect($name, $value = NULL, array $attr = NULL, array $options = NULL)
{
echo 'here';
//	return parent::select($name, $options, $value, $attr);

}

public static function cb($name = '', $value = '', $attr = '', $options = FALSE)
{
	$my_value = ($value == '') ? $name : $value;
	return parent::checkbox($name, $my_value, $options, $attr);

}

public static function rb($name = '', $value = '', $attr = '', $options = FALSE)
{
	return parent::radio($name, $value, $options, $attr);

}

public static function xxhidden($name = '', $value = '', $attr = '', $options = FALSE)
{
		return '<div class="hidden_row">'.parent::hidden($name,$value).'</div>';
}


}




?>