<?
session_start();
include ('incs/head.php');

if($_SESSION['session_on'] == 1)
{
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

$inschrijf_check = mysql_query("SELECT * FROM event_inschrijvingen WHERE studentnr='".$_SESSION['usr_id']."'");
$inschrijf_count = mysql_num_rows($inschrijf_check);

$event_id = addslashes($_GET['id']);
$event_info = "SELECT * FROM itevents WHERE event_id='".$event_id."'";
$info_sql = mysql_query($event_info);
$event_check = mysql_num_rows($info_sql);

while ($info_row = mysql_fetch_array($info_sql))
	{
	print '
	<div id="event_info">
	<span class="event_titel">Evenement '.$info_row[eventnaam].' - '.$info_row[eventdatum].'</span>
	<span>'.$info_row[beschrijving].'</span>';
	
	// Ophalen van ingeschreven student evenement
	while ($inschrijf_row = mysql_fetch_array($inschrijf_check))
		{
		print 'Je staat momenteel ingeschreven voor: '.$inschrijf_row[eventnaam].'<br>';
		}
		if ($inschrijf_count >= 1)
			{
			print '
			<form method="POST" action="">
			<input class="uitschrijf_btn" type="submit" name="uitschrijven" value="Uitschrijven">
			</form>
			';
			}
		else
			{
			?>
			<form id="event-register-form" method="POST" action="">
			<table class="event_register" border="0">
			<tr>
				<td><b>Gegevens student</b></td>
				<td></td>
			</tr>
			<tr>
				<td>Naam:</td>
				<td>
				<div class="form-row">
				<? print $_SESSION['auth_name']; ?>
				</div>
				</td>
			</tr>
			<tr>
				<td>Studentnr:</td>
				<td>
				<? print $_SESSION['usr_id']; ?>
				</td>
			</tr>
			<tr>
				<td>Klas:</td>
				<td>
				<? print $_SESSION['klas']; ?>
				</td>
			</tr>
			<tr>
				<td>Adres:</td>
				<td>
				<? print $_SESSION['adres']; ?>
				</td>
			</tr>
			<tr>
				<td>Woonplaats</td>
				<td>
				<? print $_SESSION['woonplaats']; ?>
				</td>
			</tr>
			<tr>
				<td>GSM:</td>
				<td>
				<? print $_SESSION['gsm']; ?>
				</td>
			</tr>
			<tr>
				<td>Bezit OV (week-) kaart:</td>
				<td>
				<span class="radio-row">
				<input type="radio" name="ov" value="ja">Ja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ov" value="nee">Nee
				</span>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Contactpersoon (bij calamiteiten)</b></td>
				<td></td>
			</tr>
			<tr>
				<td>Naam:</td>
				<td><input type="text" name="contnaam"></td>
			</tr>
			<tr>
				<td>Relatie:</td>
				<td><input type="text" name="contrel"></td>
			</tr>
			<tr>
				<td>Telefoon:</td>
				<td><input type="text" name="conttel" maxlength="10"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Medische gegevens</b></td>
				<td></td>
			</tr>
			<tr>
				<td>Medicijnen</td>
				<td><textarea name="medgegevens"></textarea></td>
			</tr>
			<tr>
				<td>Allergieën:</td>
				<td><textarea name="alergie"></textarea></td>
			</tr>
			<tr>
				<td>Evt. overig:</td>
				<td><textarea name="medoverig"></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Voedsel</b></td>
				<td></td>
			</tr>
			<tr>
				<td>Dieet:</td>
				<td><textarea name="dieet"></textarea></td>
			</tr>
			<tr>
				<td>Evt. overig:</td>
				<td><textarea name="voedseloverig"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>
				<span class="checkdoos">Ik ga akkoord met de <span class="voorwaarden" onClick="popup(<? print $event_id; ?>)">algemene voorwaarden</span>:</span>&nbsp;<input class="checkdoos" type="checkbox" name="voorwaarden">
				</td>
			</tr>
			<tr>
				<td><input class="inschrijf_btn" type="submit" name="inschrijven" value="Inschrijven"></td>
				<td></td>
			</tr>
			</table>
			</form>
			<?
			}
	print '</div>';
	$eventnaam_full = $info_row[eventnaam].' '.$info_row[eventdatum];
	}

// Evenement documenten weergeven bij een leraar
if ($_SESSION['teacher'] == 1)
{
$desired_extension_doc = 'doc'; // Welke extentie te zoeken in opgegeven map
$desired_extension_docx = 'docx';
$desired_extension_xls = 'xls';
$desired_extension_xlsx = 'xlsx';
$dirname = '../itevent/upload/events/'.$eventnaam_full;
$dir = opendir($dirname); 

while(false != ($file = readdir($dir))) { 
	if(($file != ".") and ($file != "..") and ($file != "index.php")) { 
		$fileChunks = explode(".", $file); 
			if($fileChunks[1] == $desired_extension_doc) {
				print '<ul>';
				print '<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a></li>'; 
				print '</ul>'; 
			} 
			if($fileChunks[1] == $desired_extension_docx) {
				print '<ul>';
				print '<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a></li>'; 
				print '</ul>'; 
			}
			if($fileChunks[1] == $desired_extension_xls) {
				print '<ul>';
				print '<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a></li>'; 
				print '</ul>'; 
			}
			if($fileChunks[1] == $desired_extension_xlsx) {
				print '<ul>';
				print '<li><a href="'.$dirname.'/'.$file.'" target="_parent">'.$file.'</a></li>'; 
				print '</ul>'; 
			}
	}
}
closedir($dir);
}// Sluit leraar status check


// Voer gegevens in bij het inscrijven
if (isset($_REQUEST['inschrijven']))
	{
	$ov				= $_REQUEST['ov'];
	$contnaam		= $_REQUEST['contnaam'];
	$contrel		= $_REQUEST['contrel'];
	$conttel		= $_REQUEST['conttel'];
	$medgegevens	= $_REQUEST['medgegevens'];
	$alergie		= $_REQUEST['alergie'];
	$medoverig		= $_REQUEST['medoverig'];
	$dieet			= $_REQUEST['dieet'];
	$voedseloverig	= $_REQUEST['voedseloverig'];
	$voorwaarden	= $_REQUEST['voorwaarden'];

	$inschrijven = "INSERT INTO event_inschrijvingen 
	(studentnr, event_id, eventnaam, ov, contactnaam, contactrelatie, contacttel, medgegevens, alergie, medoverig, dieet, voedseloverig, voorwaarden) 
	VALUES('".$_SESSION['usr_id']."', '".$event_id."', '".$eventnaam_full."', '".$ov."', '".$contnaam."', '".$contrel."', '".$conttel."', '".$medgegevens."', '".$alergie."', '".$medoverig."', '".$dieet."', '".$voedseloverig."', '".$voorwaarden."')";
	if (mysql_query($inschrijven))
		{
		print 'Je bent ingeschreven.<br>';
		}
	else
		{
		print 'Fout bij het inschrijven.<br>'.mysql_error();
		}
	}

	// Verwijder gegevens bij het uitschrijven
if (isset($_REQUEST['uitschrijven']))
	{
	$uitschrijven = "DELETE FROM event_inschrijvingen WHERE studentnr='".$_SESSION['usr_id']."'";
	if (mysql_query($uitschrijven))
		{
		print 'Je bent uitgeschreven.';
		}
	else
		{
		print 'Fout bij het inschrijven.<br>'.mysql_error();
		}
	}


if(isset($_REQUEST['inschrijven2']))
	{
	
	}



print '</div>'; // Sluit event info div
	
}// Sluit if session
else
	{
	print 'Alleen voor geregistreerde gebruikers.';
	}

include ('incs/footer.php');
?>