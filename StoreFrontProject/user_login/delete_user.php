<?php

//The page deletes a user from the database
$page_title = 'Delete a User';
include ('Includes/Header.php');
echo '<h1>Delete a User</h1>';

//check account_id
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { //if id is not valid exit page
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('Includes/Footer.php'); 
	exit();
}
require ('../dbConnect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['sure'] == 'Yes') { 
		$q = "DELETE FROM entity_account_information WHERE account_id=$id LIMIT 1";	//qeury to delete account	
		$r = @mysqli_query ($conn, $q);
		if (mysqli_affected_rows($conn) == 1) { //check if row in db was deleted
			echo '<p>The user has been deleted.</p>';	
		} else {//error account not deleted
			echo '<p class="error">The user could not be deleted due to a system error.</p>';
			echo '<p>' . mysqli_error($conn) . '<br />Query: ' . $q . '</p>'; 
		}
	
	} else { 
		echo '<p>The user has NOT been deleted.</p>';	
	}
} else { 
	$q = "SELECT CONCAT(last_name, ', ', first_name) FROM entity_account_information WHERE account_id=$id";
	$r = @mysqli_query ($conn, $q);
	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo "<h3>Name: $row[0]</h3>
		Are you sure you want to delete this user?";
		
		// display form
		echo '<form action="delete_user.php" method="post">
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No
	<input type="submit" name="submit" value="Submit" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} else { // Not a valid user ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}
} 
mysqli_close($conn);
		
include ('Includes/Footer.php');
?>