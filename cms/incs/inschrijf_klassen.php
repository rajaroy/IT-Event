<?
$host = "localhost";
$gebruiker = "student";
$wachtwoord = "5117rsgs";
$DBnaam = "school";
$verbinding = mysql_connect ($host, $gebruiker, $wachtwoord);
mysql_select_db ($DBnaam);

$event_id = addslashes($_GET['event_id']);

if (!empty($event_id))
	{
	$sql_insch_klassen = mysql_query("SELECT * FROM itevent_usr WHERE event_id='".$event_id."' GROUP BY klas");
	while ($row_klassen = mysql_fetch_array($sql_insch_klassen))
		{
		?>
		<span onClick="keuzeKlas('<? print $row_klassen[klas]; ?>')"><? print $row_klassen[klas]; ?></span><br>
		<?
		}
	}

$klas_id = addslashes($_GET['klas_id']);

if (!empty($klas_id))
	{
	$sql_insch_klassen = mysql_query("SELECT * FROM itevent_usr WHERE klas='".$klas_id."'");
	while ($row_klassen = mysql_fetch_array($sql_insch_klassen))
		{
		print $row_klassen[usr_id];
		}
	}

?>