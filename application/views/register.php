<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta name="author" content="">
<meta http-equiv="Reply-to" content="@.com">
<meta name="generator" content="PhpED 8.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="creation-date" content="09/06/2012">
<meta name="revisit-after" content="15 days">
<title>Untitled</title>
<link rel="stylesheet" type="text/css" href="my.css">
</head>
<body>
<?php echo validation_errors(); ?>

<?php echo $form_open; ?>

<?php echo $register_fieldset; ?>

<h5>Display Name:</h5>
<?php echo $display_name_field; ?>

<h5>Email Address:</h5>
<?php echo $username_field; ?>

<h5>Confirm Email Address:</h5>
<?php echo $confirm_username_field; ?>

<h5>Password:</h5>
<?php echo $password_field; ?>

<h5>Confirm Password:</h5>
<?php echo $confirm_password_field; ?>

<?php echo $submit_button; ?>

<?php echo $close_fieldset; ?>

<?php echo $form_close; ?>
</body>
</html>
