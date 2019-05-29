<?php

include ('Includes/Header.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    require ('dbConnect.php');
    $errors = array();
    
    
    //Check if first name was input
    if(empty($_POST['first_name'])){
        $errors[] = "You did not enter a first name";
    } else {
        $first_name = mysqli_real_escape_string($conn,trim($_POST['first_name']));
    }
    
    //Check is last name was input
    if(empty($_POST['last_name'])){
        $errors[] = "You did not enter a last name";
    } else {
        $last_name = mysqli_real_escape_string($conn,trim($_POST['last_name']));
    }
    
    //Check if email address was input
    if(empty($_POST['email'])){
        $errors[] = "You did not enter an email address";
    } else {
        $query = mysqli_query($conn,"SELECT email FROM entity_accounts WHERE email='".$_POST['email']."'");
        if(mysqli_num_rows($query)!=0){
            $errors [] = "That email is associated with another account";
        } else {
            $email = mysqli_real_escape_string($conn,trim($_POST['email']));
        }
    }
    
    //Check if password is empty
    if(empty($_POST['pass1'])||empty($_POST['pass2'])){
        $errors[] = "You need to enter and confirm your password";
    } else {
        if($_POST['pass1']!==$_POST['pass2']){
            $errors[] = "Your passwords did not match";
        } else {
            $password = mysqli_real_escape_string($conn,trim($_POST['pass1']));
        }
    }
    
    //if no errors
    if(empty($errors)){
        $query = "INSERT INTO entity_accounts (email, first_name, last_name, password, registration_date) VALUES ('$email', '$first_name', '$last_name', '$password', NOW())";
        if ($conn->query($query) === TRUE){
            echo "You have succesfully registered";
        } else {
            echo "error: ".$query . "<br>" . $conn->error;
        }
        mysqli_close($conn);
        include ('Includes/Footer.php');
        exit();
    } else {
        echo '<h1>Error!</h1>'
        . '<p class="error">The following errors occured:<br />';
        foreach($errors as $msg){
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><br /></p>';
    }
    
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