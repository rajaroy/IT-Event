<?
	 if(isset($_POST['create_event']))
 	 {
 	     include ('incs/connection.php');
		 
		 $eventnaam = $_REQUEST['event_naam'];
		 $eventdate = $_REQUEST['dag'].'-'.$_REQUEST['maand'].'-'.$_REQUEST['jaar'];
		 $eventdir = $eventnaam.' '.$eventdate;
		 $filedir = '../upload/events/'.$eventdir.'/'; // the directory for the file
		
  	     $maxfile = '5242880';
 	     $mode = '0666';
  	     $userfile_name = $_FILES['file']['name'];
  	     $userfile_tmp = $_FILES['file']['tmp_name'];
  	     $userfile_size = $_FILES['file']['size'];
  	     $userfile_type = $_FILES['file']['type'];
		 $parts = pathinfo($userfile_name);
  	     $file_extension = $parts['extension'];

		// Controleer of het naam in het album al voorkomt.
		$check_file = mysql_query("SELECT * FROM itevents WHERE eventnaam='".$eventnaam."' AND eventdatum='".$eventdate."'");
		$output_check = mysql_num_rows($check_file);
		if ($output_check >= 1) // Bestandnaam check
			{
			print 'Een evenement bestaat al met deze naam-datum.';
			}
		else
			{
		$extension = array();
		$extension[] = "doc";
		$extension[] = "docx";
		$extension[] = "xls";
		$extension[] = "xlsx";
		 
		 if(!in_array($file_extension, $extension)) // Extensie check
			 {
			 print 'Bestands extensie niet toegestaan!<br>';
			 }
		else
			{
			
			// Controleer bestands grootte
			if($userfile_size > $maxfile)
				{
				print 'Bestand mag niet groter dan 5MB zijn.';
				}
			else
				{

		// Maak een map aan als deze nog niet bestaat
		 if (!is_dir($filedir))
			{
			mkdir('../upload/events/'.$eventdir.'') or die ('Kan geen locatie aanmaken');
			}
		 
		 // Uploaden van bestand
		 if (isset($_FILES['file']['name'])) 
  	     {
  	     move_uploaded_file($userfile_tmp,
		 $filedir.$userfile_name);
  	     } // Sluit isset image name
		
		$titel = $_REQUEST['event_naam'];
		$sql = "INSERT INTO itevents (eventnaam, eventdatum) VALUES ('".$titel."', '".$eventdate."')";
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






	 	 if(isset($_POST['upload_file']))
 		 {
 	     include ('incs/connection.php');
		 
		 $eventnaam = $_REQUEST['file_eventnaam'];
		 $filedir = '../upload/events/'.$eventnaam.'/'; // the directory for the file
		
  	     $maxfile = '5242880';
 	     $mode = '0666';
  	     $userfile_name = $_FILES['file']['name'];
  	     $userfile_tmp = $_FILES['file']['tmp_name'];
  	     $userfile_size = $_FILES['file']['size'];
  	     $userfile_type = $_FILES['file']['type'];
		 $parts = pathinfo($userfile_name);
  	     $file_extension = $parts['extension'];

		$extension = array();
		$extension[] = "doc";
		$extension[] = "docx";
		$extension[] = "xls";
		$extension[] = "xlsx";
		 
		 if(!in_array($file_extension, $extension)) // Extensie check
			 {
			 print 'Bestands extensie niet toegestaan!<br>';
			 }
		else
			{
			
			// Controleer bestands grootte
			if($userfile_size > $maxfile)
				{
				print 'Bestand mag niet groter dan 5MB zijn.';
				}
			else
				{

		// Maak een map aan als deze nog niet bestaat
		 if (!is_dir($filedir))
			{
			mkdir('../upload/events/'.$eventnaam.'') or die ('Kan geen locatie aanmaken');
			}
		 
		 // Uploaden van bestand
		 if (isset($_FILES['file']['name'])) 
  			{
  			move_uploaded_file($userfile_tmp,
			$filedir.$userfile_name);
			print 'Bestand '.$userfile_name.' succesvol ge-upload.';
  			} // Sluit isset image name


		} // Sluit bestands grootte check
		} // Sluit else extentie check
	 } // Sluit submit check
?>