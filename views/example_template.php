<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!--Meta Tags-->
<?
	echo html::meta(array('content-type' => 'text/html;charset=utf-8', 'Content-Style-Type' => 'text/css'));
?>
<!--End Meta Tags-->
<title>CssMySite - <?=$title?></title>
<!--Stylesheets-->
<?
	echo html::stylesheet(array ('media/css/form' ),
				array('screen'), FALSE);
?>
<!--End Stylesheets-->
</head>
<body>

<div class="bodyWrapper">
<?php
			echo $content;
?>
</div> <!-- bodyWrapper -->
</body>
</html>
