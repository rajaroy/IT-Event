<?
session_start();
include ('incs/head.php');

// Registreren niet mogelijk wanneer sessie actief
if($_SESSION['session_on'] == 1)
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
      <span class="label">Voornaam *</span>
      <input type="text" name="voornaam">
  		</div>

  		<div class="form-row">
      <span class="label">Achternaam *</span>
      <input type="text" name="achternaam">
  		</div>

		<div class="form-row">
      <span class="label">E-Mail *</span>
      <input type="text" name="email">
  		</div>
		
		<div class="form-row">
      <span class="label">Adres *</span>
      <input type="text" name="adres">
  		</div>

		<div class="form-row">
      <span class="label">Woonplaats *</span>
      <input type="text" name="woonplaats">
  		</div>

		<div class="form-row">
      <span class="label">GSM *</span>
      <input type="text" name="gsm" maxlength="10">
  		</div>

		<div class="form-row">
      <span class="label">Studenten.nr *</span>
      <input type="text" name="stu_num">
  		</div>

		<div class="form-row">
      <span class="label">Klas *</span>
      <input type="text" name="klas">
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
	$achternaam = $_REQUEST['achternaam'];
	$email = $_REQUEST['email'];
	$adres = addslashes($_REQUEST['adres']);
	$woonplaats = $_REQUEST['woonplaats'];
	$gsm = $_REQUEST['gsm'];
	$stu_num = $_REQUEST['stu_num'];
	$klas = addslashes($_REQUEST['klas']);
	$pass1 = addslashes($_REQUEST['ww1']);
	$pass2 = md5($_REQUEST['ww2']);

	$sql = mysql_query("SELECT * FROM itevent_usr WHERE usr_id = '".$stu_num."' LIMIT 1");
	$count = mysql_num_rows($sql);
	
	if ($count >= 1)
		{
		print 'Student is al geregistreerd met studentnr: '.$stu_num;
		}
	else
		{
		$insert = "INSERT INTO itevent_usr 
		(usr_id, klas, voornaam, achternaam, password, password_md5, email, adres, woonplaats, gsm, last_date, last_time)
		VALUES ('".$stu_num."', '".$klas."', '".$voornaam."', '".$achternaam."', '".$pass1."', '".$pass2."', '".$email."', '".$adres."', '".$woonplaats."', '".$gsm."', '".$today."', '".$tijd."')";

		if (mysql_query($insert))
			{
			print 'Registratie succesvol.';
			}
		else
			{
			print 'Fout bij het registreren, probeer opnieuw.<br />'.mysql_error();
			}
		} // Sluit count
	} // Sluit isset register

include ('incs/footer.php');
?>