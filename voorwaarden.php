<?
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Voorwaarden</title>

</head>
<body>
<?
if($_SESSION['session_on'] == 1)
{
include ('incs/connection.php');

$event_id = addslashes($_GET['id']);
$get_events = mysql_query("SELECT * FROM itevents WHERE event_id='".$event_id."' LIMIT 1");

while ($rij_vd = mysql_fetch_array($get_events))
	{
	print '
	<div>
	<h2>Voorwaarden</h2>
	<p>'.$rij_vd[eventnaam].' - '.$rij_vd[eventdatum].'</p>
	'.$rij_vd[voorwaarden].'
	</div>
	';
	}
}
?>
</body>
</html>