<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Add an Item</title>
</head>
<body>
<?php
    require('../../dbConnect.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors = array();
        
        if(!empty($_POST['item_name'])){
            $itemName = trim($_POST['item_name']);
        } else {
            echo $_POST["item_name"];
            $errors[] = 'Enter an item name.';
        }
        
        if(is_uploaded_file($_FILES['image']['tmp_name'])){
            
            $temp = '../Images/' . md5($_FILES['image']['name']);

            if(move_uploaded_file($_FILES['image']['tmp_name'], $temp)){
                echo '<p>The file has been uploaded!</p>';

                $i = $_FILES['image']['name'];
            }
        } else {
            $errors[] = 'No file was uploaded.';
            $temp = NULL;
        }

        if (is_numeric($_POST['price']) && ($_POST['price'] > 0)) {
                $price = (float) $_POST['price'];
        } else {
                $errors[] = 'Please enter the print\'s price!';
        }

        $desc = (!empty($_POST['description'])) ? trim($_POST['description']) : NULL;

        if(empty($errors)){
            $query = "INSERT INTO entity_items (item_name, price, description, image_name) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sdss', $itemName, $price, $desc, $i);
            mysqli_stmt_execute($stmt);
            
            if (mysqli_stmt_affected_rows($stmt) == 1) {
                // Print a message:
                echo '<p>The item has been added.</p>';

                // Rename the image:
                $id = mysqli_stmt_insert_id($stmt); // Get the item ID.
                rename ($temp, "../Images/$id.jpg");

                $_POST = array();

            } else {
                echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
            }
            mysqli_stmt_close($stmt);
        }
        if ( isset($temp) && file_exists ($temp) && is_file($temp) ) {
                        unlink ($temp);
        }
            
    }
    
    if ( !empty($errors) && is_array($errors) ) {
	echo '<h1>Error!</h1>
	<p style="font-weight: bold; color: #C00">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo 'Please reselect the print image and try again.</p>';
}
    
?>
    <!--Display the form...-->
<h1>Add an Item</h1>
<form enctype="multipart/form-data" action="addItem.php" method="post">

	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	
	<fieldset><legend>Fill out the form to add an item:</legend>
	
	<p><b>Item Name:</b> <input type="text" name="item_name" size="30" maxlength="60" value="<?php if (isset($_POST['item_name'])) echo htmlspecialchars($_POST['']); ?>" /></p>
	
	<p><b>Image:</b> <input type="file" name="image" /></p>
	
	<p><b>Price:</b> <input type="text" name="price" size="10" maxlength="10" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" /> <small>Do not include the dollar sign or commas.</small></p>
	
	<p><b>Description:</b> <textarea name="description" cols="40" rows="5"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea> (optional)</p>
	
	</fieldset>
		
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>

</form>

</body>
</html>