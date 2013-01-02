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

<?php echo $login_fieldset; ?>

<h5>Username:</h5>
<?php echo $username_field; ?>

<h5>Password:</h5>
<?php echo $password_field; ?>

<?php echo $forgot_password_link; ?>

<?php echo $submit_button; ?>

<?php echo $close_fieldset; ?>

<?php echo $form_close; ?>
</body>
</html>
