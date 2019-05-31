<?php 
//
session_start(); // Start the session.

//detects if the session is active
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
	// Need the functions:
	require ('View/login_functions.php');
	redirect_user();	
}
// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('View/Header.php');
// Print message
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['first_name']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";
include ('View/Footer.php');
?>