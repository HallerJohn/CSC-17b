<?php

session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){
    require('View/login_functions.php');
    require('../dbConnect.php');
    
    list ($check, $data) = check_login($conn, $_POST['email'], $_POST['pass']);
    if($check){
        echo 'Logged in!';
        $_SESSION['account_id'] = $data['account_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
        
        redirect_user('loggedin.php');
    } else {
        $errors[] = $data;
    }
    mysqli_close($conn);
    
    
}

$page_title = 'Login';
include ('View/Header.php');
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}


?><h1>Login</h1>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" /> </p>
	<p>Password: <input type="password" name="pass" size="20" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form>

<?php include ('View/Footer.php');