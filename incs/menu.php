<?
session_start();
?>
<ul class="menu">
	<li><a href="index.php">HOME</a></li>
	<?
	if($_SESSION['session_on'] == 1)
		{
		}
	else
		{
		print '<li><a href="register.php">REGISTREREN</a></li>';
		}
	?>
	<li><a href="events.php">EVENTS</a></li>
	<li><a href="gallery.php">GALLERIJ</a></li>
	<li><a href="contact.php">CONTACT</a></li>
</ul>