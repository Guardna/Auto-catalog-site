<?php
if(isset($_REQUEST['Search']))
	{
		unset($_COOKIE['pretraga']);
		$vrednostPolja = $_REQUEST['keyword'];
		
		$cookie_name = "pretraga";
		$cookie_value = $vrednostPolja;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	};
		?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Auto Garage</title>
	<meta name="description" content="Auto garage">
	<meta name="keywords" content="Mercedes,BMW,Tesla,Volkswagen" />
	<meta name="author" content="Stefan Popovic">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="source/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="source/font-awesome-4.5.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="style/slider.css">
	<link rel="stylesheet" type="text/css" href="style/mystyle.css">
	<script type="text/javascript" src="js/provera.js"></script>
	<script type="text/javascript" src="js/poll.js"></script>
	<script>
		$(document).ready(function(){
			$('#login-trigger').find('span').html('&#x25BC;');
		  $('#login-trigger').click(function(){
			$(this).next('#login-content').slideToggle();
			$(this).toggleClass('active');          
			if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
			  else $(this).find('span').html('&#x25BC;')
			})
		});
	</script>
</head>