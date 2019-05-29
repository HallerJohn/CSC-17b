<?php 
//this page handles the registration of new users and stores data in database

session_start();//start seeions
$page_title = 'Register';
include ('Includes/Header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('../dbConnect.php'); // Connect to the db.
	$errors = array();
        
        //Check first name
        if(empty($_POST['first_name'])){
            $errors[] = 'You did not enter a first name.';
        } else {
            $firstName = mysqli_real_escape_string($conn,trim($_POST['first_name']));
        }
	
        //Check last name
        if(empty($_POST['last_name'])){
            $errors[] = 'You did not enter a last name.';
        } else {
            $lastName = mysqli_real_escape_string($conn,trim($_POST['last_name']));
        }
        
        //Check email address
        if(empty($_POST['email'])){
            $errors[] = 'You did not enter an email address.';
        } else {
            $query = mysqli_query($conn,"SELECT email_address FROM entity_account_information WHERE email_address='".$_POST['email']."'");
            if(mysqli_num_rows($query) != 0){
                $errors[] = 'That email is associated with another account.';
            } else {
                $email = mysqli_real_escape_string($conn,trim($_POST['email']));
            }
        }
        
        //Check password
        if(empty($_POST['pass1'])){
            $errors[] = 'You did not enter a password.';
        } else {
            if($_POST['pass1']==$_POST['pass2']){
                $password = mysqli_real_escape_string($conn,trim($_POST['pass1']));
            } else {
                $errors[] = 'Your passwords did not match.';
            }
        }
        
        if(empty($errors)){
            //query to input data to database
            $query = "INSERT INTO entity_account_information (email_address, first_name, last_name, password,registration_date) VALUES ('$email', '$firstName', '$lastName','$password',NOW())";
            
            if ($conn->query($query) === TRUE) {
                echo "You have succesfully registered";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
            mysqli_close($conn);
            include ('Includes/Footer.php'); 
            exit();
        } else {//print errors
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) { 
                    echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
        }
        
}

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

?>
<h1>Register</h1>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>
<?php include ('Includes/Footer.php'); ?>