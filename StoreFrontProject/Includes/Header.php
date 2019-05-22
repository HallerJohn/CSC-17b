<?php # Script - header.html
// This page begins the session, the HTML page, and the layout table.

session_start(); // Start a session.
?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo (isset($page_title)) ? $page_title : 'Welcome!'; ?></title>
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="600">
	<tr>
		<td align="center" colspan="3"><img src="images/title.jpg" width="600" height="61" border="0" alt="title" /></td>
                <td align="center" colspan="3"><a href="login.php"><img src="images/login.jpg" width="100" height="61" border="0" alt="Home page" /></a></td>
	</tr>
	<tr>
		<td><a href="index.php"><img src="images/homePage.jpg" width="200" height="39" border="0" alt="Home page" /></a></td>
                <td><a href="Inventory.php"><img src="images/ViewItems.jpg" width="200" height="39" border="0" alt="View our items" /></a></td>
		<td><a href="view_cart.php"><img src="images/ViewCart.jpg" width="200" height="39" border="0" alt="View your cart" /></a></td>
	</tr>
	<tr>
		<td align="left" colspan="3" bgcolor="#666666"><br />