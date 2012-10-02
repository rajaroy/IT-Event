<?
ob_start(); 
session_start();
include "incs/head.php";
?>

<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<?
if($_SESSION['session_cms'] == 1)
	{
	include "incs/logoff.php";

	print '<a href="add_event.php" name="add_event"><div id="event_link"></div></a>';

	include ('incs/connection.php');

	$get_events = "SELECT * FROM itevents";
	$event_sql = mysql_query($get_events);

	if(!$event_sql)
		{
		print 'Event query niet kunnen uitvoeren!<br>'.mysql_error();
		}

	// Alle events ophalen en weergeven in een list
	print '
		<div class="events-div">
		<ul class="events_list">
		';
	while ($event_row = mysql_fetch_array($event_sql))
		{
		print '<li><a href="events.php?id='.$event_row[event_id].'">'.$event_row[eventnaam].' '.$event_row[eventdatum].'</a></li>';
		}
		
		// Controlleer of er events bestaan
		if (mysql_num_rows($event_sql) == 0)
			{
			print '<span>Geen events gevonden.</span>';
			}

	print '
		</ul>
		</div>
		';

	$event_id = $_GET['id'];
	$event_info = "SELECT * FROM itevents WHERE event_id='".$event_id."'";
	$info_sql = mysql_query($event_info);

	while ($info_row = mysql_fetch_array($info_sql))
		{
		print '
		<div id="event_info">
		<span class="event_titel">Evenement '.$info_row[eventnaam].' '.$info_row[eventdatum].'</span>
		<span><br><br><br>'.$info_row[beschrijving].'</span>
		';
		$eventnaam_full = $info_row[eventnaam].' '.$info_row[eventdatum];
		$voorwaarden = $info_row[voorwaarden];
		print '
		<form method="POST" action="">
		<input type="submit" name="edit_voorwaarden" value="Voorwaarden aanpassen">
		</form>
		';
		}
		
	$desired_extension_doc = 'doc'; // Welke extentie te zoeken in opgegeven map
	$desired_extension_docx = 'docx';
	$desired_extension_xls = 'xls';
	$desired_extension_xlsx = 'xlsx';
	$dirname = '../upload/events/'.$eventnaam_full;
	$dir = opendir($dirname); 

	while(false != ($file = readdir($dir))) { 
		if(($file != ".") and ($file != "..") and ($file != "index.php")) { 
			$fileChunks = explode(".", $file); 
				if($fileChunks[1] == $desired_extension_doc) {
					print '<ul>
							<li>
							<a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a>
							<form method="POST" action="">
							<input type="hidden" name="filename" value="'.$file.'" readonly="readonly">
							<input class="delete_btn" type="submit" name="delete_file" value="Delete">
							</form>
							</li>
							</ul>';
				} 
				if($fileChunks[1] == $desired_extension_docx) {
					print '<ul>
							<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a>
							<form method="POST" action="">
							<input type="hidden" name="filename" value="'.$file.'" readonly="readonly">
							<input class="delete_btn" type="submit" name="delete_file" value="Delete">
							</form>
							</li>
							</ul>';
				}
				if($fileChunks[1] == $desired_extension_xls) {
					print '<ul>
							<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a>
							<form method="POST" action="">
							<input type="hidden" name="filename" value="'.$file.'" readonly="readonly">
							<input class="delete_btn" type="submit" name="delete_file" value="Delete">
							</form>
							</li> 
							</ul>';
				}
				if($fileChunks[1] == $desired_extension_xlsx) {
					print '<ul>
							<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a> 
							<form method="POST" action="">
							<input type="hidden" name="filename" value="'.$file.'" readonly="readonly">
							<input class="delete_btn" type="submit" name="delete_file" value="Delete">
							</form>
							</li>
							</ul>';
				}
		} 
	}

	closedir($dir);


// Voorwaarden aanpassen
	if (isset($_REQUEST['edit_voorwaarden']))
		{
		print '
		<form method="POST" action="">
		<textarea style="width: 900px;"; name="area1">'.$voorwaarden.'</textarea>
		<input type="submit" name="update_voorwaarden" value="Update">
		</form>
		';
		}

	if (isset($_REQUEST['update_voorwaarden']))
		{
		$new_voorwaarden = $_REQUEST['area1'];
		$sql_new_vd = "UPDATE itevents SET voorwaarden='".$new_voorwaarden."' WHERE event_id='".$event_id."'";
		if (mysql_query($sql_new_vd))
			{
			print 'Voorwaarden aangepast.';
			}
		}
		




	// Opgegeven bestand verwijderen
	if (isset($_REQUEST['delete_file']))
		{
		$delete_file = $_REQUEST['filename'];
		unlink($dirname.'/'.$delete_file);
		print $delete_file.' succesvol verwijderd.';
		header('refresh:3');
		}

	print '</div>'; // Sluit event info div

	} // Sluit session on check
else
	{
	print 'Toegang geweigerd.';
	}
include "incs/footer.php";
ob_end_flush();
?>