<?php 

//this page edits account first name, last name, or email
$page_title = 'Edit a User';
include ('Includes/Header.php');
echo '<h1>Edit a User</h1>';
// Check for a valid account ID
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { // No valid ID, exit page
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('Includes/Footer.php'); 
	exit();
}
require ('../dbConnect.php'); 
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($conn, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($conn, trim($_POST['last_name']));
	}
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($conn, trim($_POST['email']));
	}
	
	if (empty($errors)) { //if there are no errors
	
		$query = "SELECT account_id FROM entity_account_information WHERE email_address='$e' AND account_id != $id";
		$r = @mysqli_query($conn, $query);
		if (mysqli_num_rows($r) == 0) {
			$query = "UPDATE entity_account_information SET first_name='$fn', last_name='$ln', email_address='$e' WHERE account_id=$id LIMIT 1";//query to update account info
			$r = @mysqli_query ($conn, $query);
			if (mysqli_affected_rows($conn) == 1) { // If it ran OK.
				// Print a message:
				echo '<p>The user has been edited.</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($conn) . '<br />Query: ' . $query . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
	} else { // Report the errors.
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} 
} 
$q = "SELECT first_name, last_name, email_address FROM entity_account_information WHERE account_id=$id";//get the new first,last name and email	
$r = @mysqli_query ($conn, $query);
if (mysqli_num_rows($r) == 1) { 
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	echo '<form action="edit_user.php" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>
<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';
} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}
mysqli_close($conn);
		
include ('Includes/Footer.php');
?>