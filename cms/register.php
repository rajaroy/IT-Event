<?
session_start();
include ('incs/head.php');

// Registreren niet mogelijk wanneer sessie actief
if($_SESSION['session_cms'] == 1)
	{
	print 'Registreren niet mogelijk.<br /> U bent al geregistreerd.';
	}
else
	{
?>
<div class="register-div">
	<div id="register_logo"></div>
 	<form id="register-form" method="post" action="">

  		<div class="form-row">
      <span class="label">Gebruikersnaam *</span>
      <input type="text" name="voornaam">
  		</div>

		<div class="form-row">
      <span class="label">Wachtwoord *</span>
      <input id="ww1" class="confirm_pass" type="password" name="ww1">
  		</div>

		<div class="form-row">
      <span class="label">Bevestig Wachtwoord *</span>
      <input class="confirm_pass" type="password" name="ww2">
  		</div>

  		<div class="form-row">
      <input class="submit" type="submit" name="register" value="">
  		</div>
 	</form>
</div>
<?
	}

if (isset($_REQUEST['register']))
	{
	include_once ('incs/connection.php');

	$voornaam = $_REQUEST['voornaam'];
	$pass1 = addslashes($_REQUEST['ww1']);
	$pass2 = md5($_REQUEST['ww2']);

	$sql = mysql_query("SELECT * FROM itevent_cms WHERE username = '".$voornaam."' LIMIT 1");
	$count = mysql_num_rows($sql);
	
	if ($count >= 1)
		{
		print '	<p class="output_text">
				Gebruikersnaam al in gebruik!
				</p>
				';
		}
	else
		{
		$insert = "INSERT INTO itevent_cms 
		(username, password, password_md5, status)
		VALUES ('".$voornaam."', '".$pass1."', '".$pass2."', '0')";

		if (mysql_query($insert))
			{
			print '	<p class="output_text">
					Registratie succesvol.<br />
					Uw account staat op non-actief, activeren kan alleen door Administrator.
					</p>
					';
			}
		else
			{
			print '	<p class="output_text">
					Fout bij het registreren, probeer opnieuw.<br />'.mysql_error().'
					</p>
					';
			}
		} // Sluit count
	} // Sluit isset register

include ('incs/footer.php');
?>