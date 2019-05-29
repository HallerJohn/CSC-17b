<?php 

$page_title = 'Order Confirmation';
include ('../user_login/Includes/login_functions.php');
include ('Includes/Header.php');

require ('../dbConnect.php'); 

mysqli_autocommit($conn, FALSE);

//only play with carts if user is logged in
if(isset($_SESSION['account_id'])){
    $cid=$_SESSION['account_id'];
    $total=$_SESSION['total'];

    //Insert into xref table
    $q1 = "INSERT INTO xref_account_orders (account_id) VALUES ($cid)";
    mysqli_query($conn,$q1);

    // Add the order to the orders table
    $q = "INSERT INTO entity_orders (total, order_date) VALUES ($total,NOW())";
    $r = mysqli_query($conn, $q);
    if (mysqli_affected_rows($conn) == 1) {
        $oid = mysqli_insert_id($conn);
        console_log('order id');
        console_log($oid);

        $q = "INSERT INTO entity_order_contents (item_id, quantity, price) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $q);
        mysqli_stmt_bind_param($stmt, 'iid', $item_id, $qty, $price);

        $affected = 0;
        foreach ($_SESSION['cart'] as $item_id => $item) {
                $qty = $item['quantity'];
                $price = $item['price'];
                mysqli_stmt_execute($stmt);
                $affected += mysqli_stmt_affected_rows($stmt);
        }
        mysqli_stmt_close($stmt);

        console_log("AFFECTED");
        console_log($affected);
        console_log(count($_SESSION['cart']));
        if ($affected == count($_SESSION['cart'])) { 

            mysqli_commit($conn);

            unset($_SESSION['cart']);

            echo '<p>Thank you for your order. You will be notified when the items ship.</p>';


        } else {

            mysqli_rollback($conn);

            echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';

        }
        $q2 = "INSERT INTO xref_orders_contents (order_id) VALUES ($oid)";
        mysqli_query($conn,$q2);
        mysqli_commit($conn);
    } else { // Rollback and report the problem.
            mysqli_rollback($conn);
            echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';


    }
} else {
    echo('Please log in before checking out');
}
mysqli_close($conn);
include ('Includes/Footer.php');
?>