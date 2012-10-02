<?
ob_start();
session_start();
include ('incs/vars.php');
include_once ('incs/class.php');
?>

<script type="text/javascript">
$(document).ready(function(){
  $("input#stnummer").labelify({text: function(input) { return "Studentnummer"; }, labelledClass: "labelinside"});
  $("input#password").labelify({text: function(input) { return "Wachtwoord"; }, labelledClass: "labelinside"});
});
</script>
<style type="text/css">
input.labelinside {
  color: #999;
}
</style>

<?
$x = new functie();

$session_id = $_SESSION['usr_id'];

// Sessie vernietigen bij uitlog.
if (isset($_REQUEST['uitlog']))
	{
	print 'Je hebt op uitloggen geklikt.';
	$x -> up_last_visit($session_id);
	session_destroy();
	header ('Location: index.php');
	}

// Controleer gebruiker en maak sessies aan.
if (isset($_REQUEST['inloggen']))
	{
	$stu_nummer = addslashes($_REQUEST['stu_nummer']);
	$password = addslashes($_REQUEST['password']);
	

	if ($x -> check($stu_nummer, $password) == 1)
		{
		$_SESSION['session_on'] = 1;
		$_SESSION['auth_name'] = $x -> name($stu_nummer, $password);
		$_SESSION['usr_id'] = $x -> usr_id($stu_nummer, $password);
		$_SESSION['last_visit'] = $x -> get_last_visit($_SESSION['usr_id']);
		$_SESSION['teacher'] = $x -> status($stu_nummer, $password);
		$_SESSION['klas'] = $x -> klas($stu_nummer, $password);
		$_SESSION['adres'] = $x -> adres($stu_nummer, $password);
		$_SESSION['woonplaats'] = $x -> woonplaats($stu_nummer, $password);
		$_SESSION['gsm'] = $x -> gsm($stu_nummer, $password);
		header ('Refresh: 1');
		}
	else
		{
		$invalid_usr = 'Inlog gegevens zijn onjuist!';
		}
	}

// Als er geen sessie bestaat inlog formulier weergeven.
if($_SESSION['session_on'] != 1)
	{
?>
<div id="login_content_off">
<form method="POST" action="">
<ul class="login">
	<li><img src="imgs/user.png">&nbsp;</li>
	<li>
	<input id="stnummer" type="text" name="stu_nummer">&nbsp;&nbsp;&nbsp;&nbsp;
	</li>
	<li><img class="pass_img" src="imgs/pass.png">&nbsp;</li>
	<li>
	<input id="password" type="password" name="password">&nbsp;&nbsp;
	</li>
	<li><input class="s_button" type="submit" name="inloggen" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"></li>
</ul>
<span class="login_err">
<? print $invalid_usr; ?>
</span>
</form>
</div>

<?
	}

// Als een sessie bestaat geef gegevens weer.
else
	{
	print	'
			<div id="login_content_on">
			<table border="0">
			<tr>
				<td>Welkom, <a href="profiel.php">'.$_SESSION['auth_name'].'</a></td>
			</tr>
				<td>'.$_SESSION['last_visit'].'</td>
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
ob_end_flush();
?>