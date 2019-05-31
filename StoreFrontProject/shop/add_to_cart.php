<?php 
//adds item to cart
$page_title = 'Add to Cart';
include ('Includes/Header.php');

if (isset ($_GET['iid']) && filter_var($_GET['iid'], FILTER_VALIDATE_INT, array('min_range' => 1))  ) { 
	$iid = $_GET['iid'];
	
	if (isset($_SESSION['cart'][$iid])) {
		$_SESSION['cart'][$iid]['quantity']++; 
		// Display a message:
		echo '<p>Another copy of the print has been added to your shopping cart.</p>';
		
	} else { 
		require ('../dbConnect.php'); 
		$q = "SELECT price FROM haller_shop_entity_items WHERE item_id=$iid";
		$r = mysqli_query ($conn, $q);		
		if (mysqli_num_rows($r) == 1) { 
			list($price) = mysqli_fetch_array ($r, MYSQLI_NUM);
			
			$_SESSION['cart'][$iid] = array ('quantity' => 1, 'price' => $price);
			
			echo '<p>The item has been added to your shopping cart.</p>';
		} else { 
			echo '<div align="center">This page has been accessed in error!</div>';
		}
		
		mysqli_close($conn);
	} 
} else { 
	echo '<div align="center">This page has been accessed in error!</div>';
}
include ('Includes/Footer.php');
?>