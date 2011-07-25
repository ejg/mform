<h2><a href="/em_form.zip">Download Em_Form</a></h2>

<?
	if (is_array($messages))
	{
		echo '<div class="error_message">';
			foreach ($messages as $message)
			{
				echo "<p>$message</p>";
			}
		echo '</div>';
	}
	elseif ($messages != '')
	{
		echo '<p class="message">'.$messages.'</p>';
	}


	$form->open(NULL, array('id'=>'example'),array('hidden_input'=>'hide_me'));
	$form->pair('name')->create();
	$form->pair('email')->label('Your Email')->create();

	$form->pair('comment')->type('textarea')->create();

	$form->pair('example')->type('dropdown')->create();

	$form->pair('allany')->type('radio')->div('cbrow')->label(array('Radio Button'=>'all','Another Radio Button'=>'any'))->def('all')->create();

	$form->pair('password')->type('password')->create();

	$form->pair('checkbox')->type('checkbox')->value('aaa')->div('cbrow')->create();
	$form->pair('another')->type('checkbox')->value('bbb')->div('cbrow')->label('Another Checkbox')->def(TRUE)->label_extra('title="Uncheck this!"')->create();

	$form->pair('submit')->type('submit')->div('button')->value('Submit')->label(false)->create();
	$form->pair('print')->type('submit')->div('button')->value('Print')->label(false)->extra('onclick="window.print();return false;"')->create();

	$form->close();
?>