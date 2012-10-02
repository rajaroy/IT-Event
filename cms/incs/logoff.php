<?
if($_SESSION['session_cms'] == 1)
	{
	// Sessie vernietigen bij uitlog.
	if (isset($_REQUEST['uitlog']))
		{
		session_unset();
		header ('Location: login.php');
		}

	print	'
			<div id="login_content_on">
			<table border="0">
			<tr>
			<td>Welkom, <a href="profiel.php">'.$_SESSION['cms_name'].'</a></td>
			</tr>
			<td><br /></td>
			</tr>
			<tr>
			<td>
			<form method="POST" action="">
			Uitloggen <input class="off_button" type="submit" name="uitlog" value="">
			</form>
			</td>
			</tr>
			</table>
			</div>
			';
	}
else
	{
	print 'Toegang geweigerd!';
	header ('Refresh: 3 login.php');
	}
?>

