<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>IT-event CMS</title>
<meta  http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/labelfy.js"></script>
<script type="text/javascript" src="../js/form.validate.js"></script> 

<script type="text/javascript">
		// Contact formulier controle
		$(document).ready(function() {
			$("#fvujq-form1").validate({
				submitHandler:function(form) {
					SubmittingForm();
				},
				rules: {
					name: {
						required: true,
						letters: true
					},
					email: {
						required: true,
						email: true
					},
					url: {
						url: true
					},
					comment: {
						required: true
					}
				},
				messages: {
					comment: "Vergeet uw bericht niet."
				}
			});
		});


// Registreer formulier controle
		$(document).ready(function() {
			$("#register-form").validate({
				submitHandler:function(form) {
					SubmittingForm();
				},
				rules: {
					voornaam: {
						required: true,
						letters: true
					},
					ww1: {
						required: true
					},
					ww2: {
						required: true,
						equalTo: $("#ww1")
					},
					comment: {
						required: true
					}
				},
				messages: {
					comment: "Vergeet uw bericht niet."
				}
			});
		});

	</script>

</head>
<body>
<div id="page">
<div id="head">
<? include "incs/menu.php"; ?>
</div>

<div id="content">

<script type="text/javascript">
$(document).ready(function(){
  $("input#stnummer").labelify({text: function(input) { return "Gebruikersnaam"; }, labelledClass: "labelinside"});
  $("input#password").labelify({text: function(input) { return "Wachtwoord"; }, labelledClass: "labelinside"});
});
</script>
<style type="text/css">
input.labelinside {
  color: #999;
}
</style>

<?
session_start();
include_once ('incs/class.php');
$x = new functie();

$session_id = $_SESSION['cms_id'];

// Controleer gebruiker en maak sessies aan.
if (isset($_REQUEST['submit']))
	{
	$username = addslashes($_REQUEST['username']);
	$password = addslashes($_REQUEST['password']);
	

	if ($x -> check($username, $password) == 1)
		{
		$_SESSION['session_cms'] = 1;
		$_SESSION['cms_name'] = $x -> name($username, $password);
		$_SESSION['cms_id'] = $x -> usr_id($username, $password);
		header ('Location: index.php');
		}
	else
		{
		if($x -> check($username, $password) == 2)
			{
			$invalid_usr = 'Uw account is nog niet actief.';
			}
		else
			{
			$invalid_usr = 'Inlog gegevens zijn onjuist!';
			}
		}
	}

// Als er geen sessie bestaat inlog formulier weergeven.
if($_SESSION['session_cms'] != 1)
	{
?>
<div id="login_content_off">
<div id="slot"></div>
<form method="POST" action="">
<ul class="login">
	<li>
	<input id="stnummer" type="text" name="username">&nbsp;&nbsp;&nbsp;&nbsp;
	</li>
	<li>
	<input id="password" type="password" name="password">&nbsp;&nbsp;
	</li>
</ul>
<input class="s_button" type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
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
	print 'U bent reeds ingelogd.';
	header ('Refresh: 3 index.php');
	}
?>
</div> <!-- Content End -->
</div> <!-- Page End -->
</body>
</html>