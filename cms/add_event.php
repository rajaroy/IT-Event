<?
session_start();
include "incs/head.php";
include "incs/logoff.php";
?>

<script type="text/javascript">
$(document).ready(function(){
  $("input#e_naam").labelify({text: function(input) { return "Eventnaam"; }, labelledClass: "labelinside"});
});
</script>
<style type="text/css">
input.labelinside {
  color: #999;
}
</style>

<?
//Dag in een variabel
$dag = 1;

//Maand in een variabel
$maand = 1;

//Huidige jaar in een variabel
$jaar = date ("Y");
$jaar_optel = $jaar + 5;

if($_SESSION['session_cms'] == 1)
	{
	include ('incs/connection.php');
	$get_events = "SELECT * FROM itevents";
	$events_sql = mysql_query($get_events);
	
	print '
	<div id="add_event_form">
	<p class="cms_titel">Nieuw evenement aanmaken</p>
	<form id="event-form" method="POST" action="" enctype="multipart/form-data">
	<table>
	<tr>
		<td>
		<input type="text" id="e_naam" name="event_naam">
		</td>
	</tr>
	<tr>
		<td>
			<select class="datum_e" name="dag">';
			while ($dag <= 31)
				{
				print '<option value="'.$dag.'">'.$dag.'</option>';
				$dag++;
				}
		print'
			</select>

			<select class="datum_e" name="maand">';

			while ($maand <= 12)
				{
				print '<option value="'.$maand.'">'.$maand.'</option>';
				$maand++;
				}
		print'
			</select>

			<select class="datum_e" name="jaar">';

			while ($jaar <= $jaar_optel)
				{
				print '<option value="'.$jaar.'">'.$jaar.'</option>';
				$jaar++;
				}
		print'
			</select>
			</td>
	</tr>
	<tr>
		<td><input type="file" name="file" id="file"></td>
		<td>(max 5MB)</td>
	</tr>
	<tr>
		<td><input type="submit" name="create_event" value="Event aanmaken"></td>
	</tr>
	</table>
	</form>
	</div>
	
	
	<div id="file_upload_form">
	<p class="cms_titel">Bestand uploaden voor een evenement</p>
	<form method="POST" action="" enctype="multipart/form-data">
	<table>
	<tr>
		<td>
		<select name="file_eventnaam">';
		while ($events_row = mysql_fetch_array($events_sql))
			{
			print '<option value="'.$events_row[eventnaam].' '.$events_row[eventdatum].'">'.$events_row[eventnaam].' '.$events_row[eventdatum].'</option>';
			}
print'	</select>
		</td>
	</tr>
	<tr>
		<td><input type="file" name="file"></td>
		<td>(max 5MB)</td>
	</tr>
	<tr>
		<td><input type="submit" name="upload_file" value="Uploaden"></td>
	</tr>
	</table>
	</form>
	</div>
	';

include ("incs/file_uploader.php");

	} // Sluit session on check

include "incs/footer.php";
?>