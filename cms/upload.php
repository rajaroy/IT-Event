<?
ob_start(); 
session_start();
include "incs/head.php";
include "incs/logoff.php";
?>

<script type="text/javascript">
$(document).ready(function(){
  $("input#album_naam").labelify({text: function(input) { return "Albumnaam"; }, labelledClass: "labelinside"});
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
$jaar_optel = $jaar -5;

if($_SESSION['session_cms'] == 1)
	{
	include "incs/connection.php";
	
	$get_albums = "SELECT * FROM itevent_albums";
	$sql = mysql_query($get_albums);
	if (!$sql)
		{
		print 'Query niet kunnen uitvoeren!<br>'.mysql_error();
		}

	print '	
		 <form method="POST" action="">
		 <input class="new_album_btn" type="submit" name="new_album" value="Nieuw album">
		 </form>
		 
		 <div id="album_form">
		 <form id="upload-form" method="POST" action="" enctype="multipart/form-data">
		 <table>
		 <tr>
  			<td>Album:</td>
			<td>
			<select class="album_select" name="album">
			';
			while ($row = mysql_fetch_array($sql))
				{
				print '<option>'.$row[albums].' '.$row[datum].'</option>';
				}
			print'
			</select>
			</td>
		</tr>
		 <tr>
  			<td>Titel:</td>
			<td>
			<div class="form-row">
			<input type="text" name="titel">
			</div>
			</td>
		</tr>
		<tr>
  			<td></td>
			<td><input type="file" name="image"></td>
			<td>(max 2MB)</td>
		 </tr>
		 <tr>
  			<td></td>
			<td><input type="Submit" name="Submit" value="Submit"></td>
		 </tr>
		 </table>
  	     </form>
		 </div>
			';

	// Formulier voor een nieuwe album
	if (isset($_REQUEST['new_album']))
		{
		print'
		<div id="new-album">
		<form method="POST" action="">
		<table border="0">
		<tr>
			<td><input type="text" id="album_naam" name="album_naam"></td>
			<td>
			<select class="datum" name="dag">';

			while ($dag <= 31)
				{
				print '<option value="'.$dag.'">'.$dag.'</option>';
				$dag++;
				}
		print'
			</select>
			</td>
			<td>
			<select class="datum" name="maand">';

			while ($maand <= 12)
				{
				print '<option value="'.$maand.'">'.$maand.'</option>';
				$maand++;
				}
		print'
			</select>
			</td>
			<td>
			<select class="datum" name="jaar">';

			while ($jaar >= $jaar_optel)
				{
				print '<option value="'.$jaar.'">'.$jaar.'</option>';
				$jaar--;
				}
		print'
			</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="maak_album" value="Album aanmaken"></td>
		</tr>
		</table>
		</form>
		';
		}

	if(isset($_REQUEST['maak_album']))
		{
		include "incs/connection.php";

		$album_naam = $_REQUEST['album_naam'];
		$album_datum = $_REQUEST['dag'].'-'.$_REQUEST['maand'].'-'.$_REQUEST['jaar'];
		
		$check_album = mysql_query("SELECT * FROM itevent_albums WHERE albums='".$album_naam."' AND datum='".$album_datum."'");
		$count_album = mysql_num_rows($check_album);

		if($count_album == 0)
			{
			$insert_album = "INSERT INTO itevent_albums (albums, datum) VALUES ('".$album_naam."', '".$album_datum."')";

			if(mysql_query($insert_album))
				{
				print 'Nieuwe album aangemaakt.';
				header ('Refresh: 2');
				}
			}
		else
			{
			print 'Deze album bestaat al!';
			header ('Refresh: 2');
			}
		} // Sluit isset maak_album
		
		// Sluit div nieuwe album aanmaak
		print '
		</div>
		';

	include ("incs/image_uploader.php");
	} // Sluit session on check

include "incs/footer.php";
ob_end_flush();
?>
