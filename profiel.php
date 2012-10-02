<?
session_start();
include ('incs/head.php');
include_once ('incs/connection.php');

if($_SESSION['session_on'] == 1)
	{
	$usr_id = $_SESSION['usr_id'];
	
	if(isset($_REQUEST['update']))
		{
		$voornaam = $_REQUEST['voornaam'];
		$achternaam = $_REQUEST['achternaam'];
		$email = $_REQUEST['email'];
		$klas = addslashes($_REQUEST['klas']);
		$pass1 = addslashes($_REQUEST['ww1']);
		$pass2 = md5($_REQUEST['ww2']);

		$update_sql = "UPDATE itevent_usr SET klas='".$klas."', voornaam='".$voornaam."', achternaam='".$achternaam."', password='".$pass1."', password_md5='".$pass2."', email='".$email."' 
						WHERE usr_id='".$usr_id."'";
		if(mysql_query($update_sql))
			{
			print 'Gegevens succesvol aangepast.<br /><img src="imgs/loader.gif">Updating';
			header ('Refresh: 3');
			die();
			}
		}

	$select = mysql_query("SELECT * FROM itevent_usr WHERE usr_id = '".$usr_id."' LIMIT 1");

	// Aanpas formulier
	if(isset($_REQUEST['aanpassen']))
		{
		while ($row = mysql_fetch_array($select))
			{
			print	'
				<div class="register-div">
					<div id="register_logo"></div>
 					<form id="register-form" method="post" action="">

  					<div class="form-row">
					<span class="label">Voornaam *</span>
					<input type="text" name="voornaam" value="'.$row[voornaam].'">
  					</div>

  					<div class="form-row">
					<span class="label">Achternaam *</span>
					<input type="text" name="achternaam" value="'.$row[achternaam].'">
  					</div>

					<div class="form-row">
					<span class="label">E-Mail *</span>
					<input type="text" name="email" value="'.$row[email].'">
  					</div>

					<div class="form-row">
					<span class="label">Klas *</span>
					<input type="text" name="klas" value="'.$row[klas].'">
  					</div>

					<div class="form-row">
					<span class="label">Wachtwoord *</span>
					<input id="ww1" class="confirm_pass" type="password" name="ww1" value="'.$row[password].'">
  					</div>

					<div class="form-row">
					<span class="label">Bevestig Wachtwoord *</span>
					<input class="confirm_pass" type="password" name="ww2" value="'.$row[password].'">
  					</div>

  					<div class="form-row">
					<input class="submit" type="submit" name="update" value="">
  					</div>
 					</form>
				</div>
				';
			}
		}// Sluit if isset aanpassen
	else
		{
		// Ingelogde student gegevens weergeven
		while ($row = mysql_fetch_array($select))
			{
		print	'
				<div class="register-div">
				<form method="POST" action="">
				<table class="user_info" border="0">
				<tr>
					<td>Studentennummer:</td>
					<td>'.$row[usr_id].'</td>
				</tr>
				<tr>
					<td>Voornaam: </td>
					<td>'.$row[voornaam].'</td>
				</tr>
				<tr>
					<td>Achternaam: </td>
					<td>'.$row[achternaam].'</td>
				</tr>
				<tr>
					<td>Email: </td>
					<td>'.$row[email].'</td>
				</tr>
				<tr>
					<td>Klas: </td>
					<td>'.$row[klas].'</td>
				</tr>
				</table>
				<input type="submit" name="aanpassen" value="Gegevens aanpassen"></td>
				</form>
				</div>
				';
			}
		}// Sluit else isset aanpassen

	}// Sluit if session
else
	{
	print 'Toegang geweigerd!';
	}

include ('incs/footer.php');
?>