<?php 
$row = FALSE; 

include ('../user_login/Includes/login_functions.php');

if (isset($_GET['iid']) && filter_var($_GET['iid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) { 
	$iid = $_GET['iid'];
	require ('../dbConnect.php'); 
	$q = "SELECT item_name, price, description, image_name FROM haller_shop_entity_items WHERE item_id=$iid";
	$r = mysqli_query ($conn, $q);
	if (mysqli_num_rows($r) == 1) { 
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
		$page_title = $row['item_name'];
		include ('Includes/Header.php');
	
		// Display a header:
		echo "<div align=\"center\">
		<b>{$row['item_name']}</b> 
		<br />";
		// Print the size or a default message:
		echo "<br />\${$row['price']} 
		<a href=\"add_to_cart.php?iid=$iid\">Add to Cart</a>
		</div><br />";
	
		if ($image = @getimagesize ("Images/$iid.jpg")) {
			echo "<div align=\"center\"><img src=\"display_image.php?image=$iid&name=" . urlencode($row['image_name']) . "\" $image[3] alt=\"{$row['item_name']}\" /></div>\n";
                        console_log(' = ');
                        console_log($iid);
		} else {
			echo "<div align=\"center\">No image available.</div>\n"; 
		}
		
		echo '<p align="center">' . ((is_null($row['description'])) ? '(No description available)' : $row['description']) . '</p>';
	
	}
	
	mysqli_close($conn);
} 

if (!$row) { 
	$page_title = 'Error';
	include ('Includes/Header.php');
	echo '<div align="center">This page has been accessed in error!</div>';
}
include ('Includes/Footer.php');
?>