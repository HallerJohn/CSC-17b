<?php 
//this page shows the items for sale
$page_title = 'Browse the Prints';
include ('../user_login/Includes/login_functions.php');
include ('Includes/Header.php');
require ('../dbConnect.php');
 
$q = "SELECT item_id, item_name, price, description, image_name  FROM haller_shop_entity_items";

echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
		<td align="left" width="20%"><b>Item Name</b></td>
		<td align="left" width="40%"><b>Description</b></td>
		<td align="right" width="20%"><b>Price</b></td>
	</tr>';

$r = mysqli_query ($conn, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
	
	echo "\t<tr>
                <td align=\"left\"><a href=\"display_item.php?iid={$row['item_id']}\">{$row['item_name']}</a></td>
		<td align=\"left\">{$row['description']}</td>
		<td align=\"right\">\${$row['price']}</td>
	</tr>\n";
} 
echo '</table>';
mysqli_close($conn);
include ('Includes/Footer.php');
?>