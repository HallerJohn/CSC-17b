<?php 
//open the session
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	require ('Includes/login_functions.php');
	require ('../dbConnect.php');
	
	list ($check, $data) = check_login($conn, $_POST['email'], $_POST['pass']);
	
	if ($check) { 
		
            echo ' logged in';
            $_SESSION['account_id'] = $data['account_id'];
            $_SESSION['first_name'] = $data['first_name'];

            $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
            
            redirect_user('loggedin.php');
			
	} else { 
		$errors = $data;
	}
		
	mysqli_close($conn); 
} 

include ('includes/login_page.php');
?>