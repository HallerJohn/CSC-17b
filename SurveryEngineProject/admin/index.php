<?php # Script 3.4 - index.php
 session_start();
$page_title = 'Admin it up!';
include ('View/Header.php');
?>
<h1>Admin Page</h1>
<p>Use the above links to add a question or change account info.</p>
<?php
include ('View/Footer.php');
?>