<?
ob_start(); 
session_start();
include ('incs/head.php');
?>
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?
if($_SESSION['session_cms'] == 1)
	{
	print '<div id="page_editor_div">';
	include ('incs/connection.php');
	
	// Pagina's ophalen en weergeven
	print'<div id="pages_div">';
	$get_pages = mysql_query("SELECT * FROM itevent_contents");
	$count_pages = mysql_num_rows($get_pages);

	if ($count_pages <= 0)
		{
		print "Geen pagina's gevonden.";
		}
	else
		{
		while ($row_pages = mysql_fetch_array($get_pages))
			{
			print '<a class="page_links" href="?page_id='.$row_pages[destination].'">'.$row_pages[destination].'</a><br>';
			}
		}
	print '</div>';
	// ########################### //


	$page_id = $_GET['page_id'];
	
	if (isset($page_id))
		{
		$get_tekst = mysql_query("SELECT * FROM itevent_contents WHERE destination='".$page_id."'");

		print '<form method="POST" action="">';
		while ($row_tekst = mysql_fetch_array($get_tekst))
			{
			print '<textarea class="edit_area" style="width: 900px;"; name="area1">'.$row_tekst[content].'</textarea>';
			}
		print '<input type="submit" name="update" value="Update">';
		print '</form>';
		print '</div>';

		if (isset($_REQUEST['update']))
			{
			$content = addslashes($_REQUEST['area1']);

			$update_tekst = "UPDATE itevent_contents SET content='".$content."' WHERE destination='".$page_id."'";
			
			if (mysql_query($update_tekst))
				{
				header ('Location: page_edit.php?page_id='.$page_id);
				}
			else
				{
				print 'Content update mislukt.<br>'.mysql_error();
				}
			}
		}

	}// Sluit sessie on check
else
	{
	print 'Toegang geweigerd.';
	}

include ('incs/footer.php');
ob_end_flush();
?>