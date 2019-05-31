<?php 

//this page allows user to change their password

session_start();//start session
$page_title = 'Change Your Password';
include ('Includes/Header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('../dbConnect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($conn, trim($_POST['email']));
	}
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($conn, trim($_POST['pass']));
	}
	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($conn, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { 
		$q = "SELECT account_id FROM haller_shop_entity_account_information WHERE (email_address='$e' AND password='$p' )";
		$r = @mysqli_query($conn, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) { // Match was made.
	
			$row = mysqli_fetch_array($r, MYSQLI_NUM);
			$q = "UPDATE haller_shop_entity_account_information SET password='$np' WHERE account_id=$row[0]";//query to update password	
			$r = @mysqli_query($conn, $q);
			
			if (mysqli_affected_rows($conn) == 1) { //check if password was updated
				echo '<h1>Thank you!</h1>
				<p>Your password has been updated. Now you can log in!</p><p><br /></p>';	
			} else { //password not updated
				echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
	
				echo '<p>' . mysqli_error($conn) . '<br /><br />Query: ' . $q . '</p>';
	
			}
			mysqli_close($conn); 
			include ('includes/Footer.php'); 
			exit();
				
		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The email address and password do not match those on file.</p>';
		}
		
	} else { //print errors
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { 
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	
	}
	mysqli_close($conn);
		
} 
?>
<h1>Change Your Password</h1>
<form action="password.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Change Password" /></p>
</form>
<?php include ('Includes/Footer.php'); ?>