<?
session_start();
?>
<ul class="menu">
	<?
	if($_SESSION['session_cms'] == 1)
		{
		print '<li><a href="index.php">HOME</a></li>';
		}
	if($_SESSION['session_cms'] != 1)
		{
		print '<li><a href="register.php">REGISTREREN</a></li>';
		}
	if($_SESSION['session_cms'] == 1)
		{
		print '<li><a href="events.php">EVENTS</a></li>';
		}
	if($_SESSION['session_cms'] == 1)
		{
		print '<li><a href="gallery.php">GALLERIJ</a></li>';
		}
	if($_SESSION['session_cms'] == 1)
		{
		print '<li><a href="page_edit.php">PAGINA BEHEER</a></li>';
		}
	if($_SESSION['session_cms'] == 1)
		{
		print '<li><a href="inschrijvingen.php">INSCHRIJVINGEN</a></li>';
		}
	if($_SESSION['session_cms'] != 1)
		{
		print '<li><a href="login.php">INLOGGEN</a></li>';
		}
	?>
</ul>