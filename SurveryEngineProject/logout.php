<?php 

session_start(); //start session

if (!isset($_SESSION['account_id'])) {//checks if session is active
	//not active
	require ('Includes/login_functions.php');
	redirect_user();	
	
} else { //active session
	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.
}
// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include ('Includes/Header.php');
// Print a customized message:
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";
include ('Includes/Footer.php');
?>