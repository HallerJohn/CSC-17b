<?php # Script - view_cart.php
// This page displays the contents of the shopping cart.
// This page also lets the user update the contents of the cart.
// Set the page title and include the HTML header:
$page_title = 'View Your Shopping Cart';
include ('Includes/Header.php');
// Check if the form has been submitted (to update the cart):
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Change any quantities:
	foreach ($_POST['qty'] as $k => $v) {
		// Must be integers!
		$iid = (int) $k;
		$qty = (int) $v;
		
		if ( $qty == 0 ) { // Delete.
			unset ($_SESSION['cart'][$iid]);
		} elseif ( $qty > 0 ) { // Change quantity.
			$_SESSION['cart'][$iid]['quantity'] = $qty;
		}
		
	} // End of FOREACH.
	
} // End of SUBMITTED IF.
// Display the cart if it's not empty...
if (!empty($_SESSION['cart'])) {
	// Retrieve all of the information for the prints in the cart:
	require ('../dbConnect.php'); // Connect to the database.
	$q = "SELECT item_id, item_name FROM entity_items WHERE item_id IN (";
	foreach ($_SESSION['cart'] as $iid => $value) {
		$q .= $iid . ',';
	}
	$q = substr($q, 0, -1) . ') ';
	$r = mysqli_query ($conn, $q);
	
	// Create a form and a table:
	echo '<form action="view_cart.php" method="post">
	<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
		<td align="center" width="30%"><b>Item Name</b></td>
		<td align="center" width="10%"><b>Price</b></td>
		<td align="center" width="10%"><b>Qty</b></td>
		<td align="center" width="10%"><b>Total Price</b></td>
	</tr>
	';
	// Print each item...
	$total = 0; // Total cost of the order.
	while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
	
		// Calculate the total and sub-totals.
		$subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
		$total += $subtotal;
		
		// Print the row:
		echo "\t<tr>
		<td align=\"center\">{$row['item_name']}</td>
		<td align=\"center\">\${$_SESSION['cart'][$row['item_id']]['price']}</td>
		<td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\" /></td>
		<td align=\"center\">$" . number_format ($subtotal, 2) . "</td>
		</tr>\n";
	
	} // End of the WHILE loop.
	mysqli_close($conn); // Close the database connection.
	// Print the total, close the table, and the form:
	echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="center">$' . number_format ($total, 2) . '</td>
	</tr>
	</table>
	<div align="center"><input type="submit" name="submit" value="Update My Cart" /></div>
	</form><p align="center">Enter a quantity of 0 to remove an item.
	<br /><br /><a href="checkout.php">Checkout</a></p>';
        $_SESSION['total']=$total;
} else {
	echo '<p>Your cart is currently empty.</p>';
}
include ('Includes/Footer.php');
?>