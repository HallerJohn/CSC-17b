<?php 

//displays the image when looking at a specific item
$image = FALSE;
$name = (!empty($_GET['name'])) ? $_GET['name'] : 'print image';

if (isset($_GET['image']) && filter_var($_GET['image'], FILTER_VALIDATE_INT, array('min_range' => 1))  ) {
	$image = 'Images/' . $_GET['image'].'.jpg';
	if (!file_exists ($image) || (!is_file($image))) {
		$image = FALSE;
	}
	
} 
if (!$image) {
	$image = 'images/unavailable.png';
	$name = 'unavailable.png';
}
$info = getimagesize($image);
$fs = filesize($image);
header ("Content-Type: {$info['mime']}\n");
header ("Content-Disposition: inline; filename=\"$name\"\n");
header ("Content-Length: $fs\n");
readfile ($image);