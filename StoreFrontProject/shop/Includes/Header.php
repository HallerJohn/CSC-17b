<?php # Script - header.html
// This page begins the session, the HTML page, and the layout table.
if(!isset($_SESSION)){
    session_start(); // Start a session.
}
?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo (isset($page_title)) ? $page_title : 'Welcome!'; ?></title>
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="600">
	<tr>
		<td align="center" colspan="3"><img src="Images/title.jpg" width="600" height="61" border="0" alt="title" /></td>
                <?php if(isset($_SESSION['account_id'])){ ?>
                    <td align="center" colspan="3"><a href="logout.php"><img src="Images/logout.jpg" width="100" height="61" border="0" alt="Home page" /></a></td>
                <?php }else{ ?>
                    <td align="center" colspan="3"><a href="login.php"><img src="Images/login.jpg" width="100" height="61" border="0" alt="Home page" /></a></td>
                    <td align="center" colspan="3"><a href="register.php"><img src="Images/register.jpg" width="100" height="61" border="0" alt="Home page" /></a></td>
                <?php } ?>
	</tr>
	<tr>
		<td><a href="index.php"><img src="Images/HomePage.jpg" width="200" height="39" border="0" alt="Home page" /></a></td>
                <td><a href="view_items.php"><img src="Images/ViewItems.jpg" width="200" height="39" border="0" alt="View our items" /></a></td>
		<td><a href="view_cart.php"><img src="Images/ViewCart.jpg" width="200" height="39" border="0" alt="View your cart" /></a></td>
	</tr>
	<tr>
		<td align="left" colspan="3" bgcolor="#666666"><br />