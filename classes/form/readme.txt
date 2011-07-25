Em_Form - a form generation module for Kohana 2.3

Author: Emily Gillcoat
-----------------------------------------

Em_Form removes the redundancy in creating labels with corresponding input fields all wrapped in a div. 

The input fields are assigned an id. Each label is generated with the 'for' attribute so the label/input field are associated (so if a label is clicked, the corresponding input field gets focus or in the case of a checkbox/radio button - checked or unchecked). 

Each label and input pair is wrapped in a div for easy CSS styling. 

The label can either be automatically created from the input field name or assigned a value or not generated at all. 

Select options are automatically set from a form_option_model class.

------------------------------------------
Examples
------------------------------------------
The Em_Form code is above the code it generates. 

1. $form->pair('name')->create();

<div class="row">
	<label for="name">Name</label>
	<input type="text" value="" name="name" id="name"/>
</div>


2. $form->pair('example')->type('dropdown')->label('My Label')->create();

<div class="row">
	<label for="example">My Label</label>
	<select name="example" id="example">
		<option value="one">This One</option>
		<option value="two">Two</option>
		<option value="three">More</option>
	</select>
</div>

------------------------------------------
Classes
------------------------------------------

Em_Form 
This class controls the form creation. It opens the form, closes the form and creates the form pair. 

It is created in the controller and passed to the view.

Form_Pair
This is created by Em_Form in the view. Its methods are chainable.

This defines the type and attributes for an label/input field and calls the form helper.

This class is transparent to the form helper functions and will work automatically if 
the form helper is expanded to create other form types as long as the parameters are in 
the order of: ($data, $value, $extra, $options)

MY_form
A extension of the Form helper.  The Form helper functions dropdown(), checkbox() and radio()
do not follow the standard order of parameters.  

This extension rearranges the parameters and calls the form helper. 


------------------------------------------
Public Functions
------------------------------------------

Em_Form

	open($action, $attr, $hidden)
		opens the form

		action - string: form action
		attr - array: attributes for form -- 'id'=>'myform'
		hidden - array of hidden fields  -- 'name'=>'hidden_name'

	close()
		closes the form

	set_values($values)
		Em_Form will hold the values until the correct form_pair is created

		$values - array: $_POST values from from input

	pair($data)
		creates the form_pair. Sets the value if it exists in $value.
		sets the options for dropdown lists from form_option_model

		$data - string or array of attributes
	
Form_Pair	

	get_name()
		returns the name

	label($label)
		sets the label

		$label - mixed   If label is not set, the default is the input name capitalized. 
				If $label is set to FALSE, the label tags will not be created.  

	label_extra($label_extra)
		sets extra information like title or javascript on label tag

		$label_extra - string

	type($type)
		sets the type. Default is 'input'

	options($options)
		sets the options for dropdown lists/checkboxes

		$options - array or boolean

	div($div)
		sets the class name for the div. Default is 'row'

		$div - string

	def($default)
		sets the default for radio buttons and checkboxes

		$default - string

	value($value)
		sets the default value of the input field if there has not been a $_POST

		$value - mixed

	extra($extra)
		sets extra information javascript on input field

		$extra - string

	create()
		creates the div, label and input field based on values previously set
