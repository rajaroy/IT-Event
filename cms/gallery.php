<?
session_start();
include "incs/head.php";

if($_SESSION['session_cms'] == 1)
	{
	include "incs/logoff.php";
	include "incs/connection.php";

	print '	
			<a href="upload.php" name="Uploaden"><div id="upload_link"></div></a>
			';

	$select_albums = "SELECT * FROM itevent_albums GROUP BY albums";
	$sql = mysql_query($select_albums);

	if ($sql)
		{
		print	'
				<div id="gallery-div">
				<form method="POST" action="">
				<ul>';
				while ($row = mysql_fetch_array($sql))
					{
					print '<li><a href="gallery.php?id='.$row[albums].' '.$row[datum].'">'.$row[albums].' '.$row[datum].'</a></li>';
					}
		print	'
				</ul>
				</form>';
				if (mysql_num_rows($sql) == 0)
					{
					print '<span>Geen albums gevonden.</span>';
					}
		print	'</div>
				';
		}

	$albumid = $_GET['id'];
	$get_gallery = "SELECT * FROM gallery WHERE album='".$albumid."'";
	$sql = mysql_query($get_gallery);
	$pad = '../upload/gallery/'.$albumid.'/';
	$thumb_pad = '../upload/gallery/'.$albumid.'/thumb/';

	while ($row = mysql_fetch_array($sql))
		{
		print '
		<ul class="thumb_gallery">
		<li><a href="'.$pad.$row[extensie].'" rel="shadowbox['.$albumid.']" title="'.$row[naam].'"><img src="'.$thumb_pad.$row[thumb_extensie].'"></a></li>
		</ul>
		';
		}
	}// Sluit sessie check
else
	{
	print 'Toegang geweigerd.';
	}
include "incs/footer.php";
?>