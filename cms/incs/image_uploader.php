<?
	 if(isset($_POST['Submit']))
 	 {
 	     include ('incs/connection.php');
		 
		 $albumdir = $_REQUEST['album'];
		 $filedir = '../upload/gallery/'.$albumdir.'/'; // the directory for the original image
  	     $thumbdir = '../upload/gallery/'.$albumdir.'/thumb/'; // the directory for the thumbnail image
		
		 $size = 150; // the thumbnail height
  	     $prefix = 'small_'; // the prefix to be added to the original name
  	     $maxfile = '2097152';
 	     $mode = '0666';
  	     $userfile_name = $_FILES['image']['name'];
  	     $userfile_tmp = $_FILES['image']['tmp_name'];
  	     $userfile_size = $_FILES['image']['size'];
  	     $userfile_type = $_FILES['image']['type'];
  	     
		// Controleer of het naam in het album al voorkomt.
		$check_file = mysql_query("SELECT * FROM gallery WHERE album='".$albumdir."' AND extensie='".$userfile_name."'");
		$output_check = mysql_num_rows($check_file);
		if ($output_check >= 1) // Bestandnaam check
			{
			print 'Bestandsnaam is in gebruik binnen dit album.';
			}
		else
			{
		$extension = array();
		$extension[] = "image/gif";
		$extension[] = "image/jpg";
		$extension[] = "image/jpeg";
		 
		 if(!in_array($_FILES['image']['type'], $extension)) // Extensie check
			 {
			 print 'Bestands extensie niet toegestaan!';
			 }
		else
			{

			if($userfile_size > $maxfile)
				{
				print 'Bestand mag niet groter dan 2MB zijn.';
				}
			else
				{
		
		// Maak album mappen aan als deze niet bestaan
		 if (!is_dir($filedir))
			{
			mkdir('../upload/gallery/'.$albumdir.'') or die ('Kan geen locatie aanmaken');
			if (!is_dir($thumbdir))
				{
				mkdir('../upload/gallery/'.$albumdir.'/thumb') or die ('Kan geen locatie aanmaken');
				}
			}

		 // Foto formaat aanpassen en uploaden
		 if (isset($_FILES['image']['name'])) 
  	     {
  	         $prod_img = $filedir.$userfile_name;
  	         $prod_img_thumb = $thumbdir.$prefix.$userfile_name;
  	         move_uploaded_file($userfile_tmp, $prod_img);
  	         chmod ($prod_img, octdec($mode));
  	         $sizes = getimagesize($prod_img);
  	         $aspect_ratio = $sizes[1]/$sizes[0]; 
  	         if ($sizes[1] <= $size)
  	         {
  	             $new_width = $sizes[0];
  	             $new_height = $sizes[1];
  	         }else{
  	             $new_height = $size;
  	             $new_width = abs($new_height/$aspect_ratio);
  	         }
  	         $destimg=ImageCreateTrueColor($new_width,$new_height)
  	             or die('Fouten bij het genereren van afbeelding.');
  	         $srcimg=ImageCreateFromJPEG($prod_img)
  	             or die('Fout bij het openen van afbeelding.');
  	         if(function_exists('imagecopyresampled'))
  	         {
  	             imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
  	             or die('Fout bij het afmeting aanpassen.');
  	         }else{
  	             Imagecopyresized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
  	             or die('Fout bij het afmeting aanpassen.');
  	         }
  	         ImageJPEG($destimg,$prod_img_thumb,90)
  	             or die('Fout bij het opslaan');
  	         imagedestroy($destimg);
  	     } // Sluit isset image name


  	     echo '
  	     <a href="'.$prod_img.'">
  	         <img src="'.$prod_img_thumb.'" width="'.$new_width.'" heigt="'.$new_height.'">
  	     </a>';
		
		$titel = $_REQUEST['titel'];
		$sql = "INSERT INTO gallery (naam, album, extensie, thumb_extensie) VALUES ('".$titel."', '".$albumdir."', '".$userfile_name."', '".$prefix.$userfile_name."')";
		if (mysql_query($sql))
			{
			print 'Uw afbeelding is succesvol ge-upload.';
			}
		else
			{
			print 'Uploaden mislukt.<br><br>'.mysql_error();
			}
		
		} // Sluit bestands grootte check
  		} // Sluit else extentie check
		} // Sluit else bestandsnaam check
	 } // Sluit submit check
?>