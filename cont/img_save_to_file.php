<?php
session_start();
$session_id = $_SESSION['id'];
$colum = 'image'.$_POST['colum'];
include ("../cont/bd_user.php");


$name = $session_id.'_image'.$_POST['colum'];
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
    $imagePath = "../uploads/sto_images/full/";
	
	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access'
		);
		print json_encode($response);
		return;
	}
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );
		  $what = getimagesize($filename);
		  switch(strtolower($what['mime']))
{
    case 'image/png':
		$type = '.jpg';
        break;
    case 'image/jpeg':
		$type = '.jpg';
        break;
    case 'image/gif':
		$type = '.jpg';
        break;
    default: die('image type not supported');
}

		   move_uploaded_file($filename,  $imagePath . $name.$type);
			$name_f = $imagePath.$name.$type;
		  $response = array(
			"status" => 'success',
			"url" => $imagePath.$name.$type,
			"width" => $width,
			"height" => $height
		  );
		  
		   mysqli_query($link, "UPDATE `srm_sto_images` SET `$colum`='$name_f' WHERE id_sto='$session_id'");
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
		);
	  }
	  
	  print json_encode($response);

?>
