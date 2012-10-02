<?
session_start();
include ('incs/head.php');

print '<div id="page_inschr_div">';

if($_SESSION['session_cms'] == 1)
	{
	include ('incs/connection.php');
	
	$sql_events = mysql_query("SELECT * FROM itevents");

	if (!$sql_events)
		{
		print 'Fout bij query uitvoeren.<br>'.mysql_error();
		}
	else
		{
		while ($row_events = mysql_fetch_array($sql_events))
			{
			?>
			<span onClick="keuzeEvent(<? print $row_events[event_id]; ?>)"><? print $row_events[eventnaam]; ?></span><br>
			<?
			}
		}
	
	$event_id = $_GET['event_id'];
	$sql_event_usr = mysql_query("SELECT * FROM itevent_usr WHERE event_id='".$event_id."' GROUP BY klas");
	$event_usr_count = mysql_num_rows($sql_event_usr);
	if($event_usr_count <= 0)
		{
		print 'Geen inschrijvingen gevonden.';
		}
	else
		{
		while ($row_event_usr = mysql_fetch_array($sql_event_usr))
			{
			print '
			<div id="event_klassen">
			'.$row_event_usr[klas].'
			</div>
			';
			}
		}

	print '
	<br><br>
	<span>Klassen</span>
	<div id="rest">
	</div>
	';

	print '
	<br><br>
	<span>Studenten</span>
	<div id="rest2"></div>
	';

	}// Sluit sessie check
else
	{
	print 'Toegang geweigerd.';
	}

print '</div>';// Sluit page_inschr_div
include ('incs/footer.php');
?>