<?
session_start();
include ('incs/head.php');

if($_SESSION['session_on'] == 1)
	{
?>
	
<div id="event_register">
<form id="event-register-form" method="POST" action="">
<div class="form-row">
	<span class="label">Voornaam *</span>
	<input type="text" name="voornaam">
</div>

<div class="form-row">
	<span class="label">Achternaam *</span>
	<input type="text" name="achternaam">
</div>

<div class="form-row">
	<span class="label">Student nummer *</span>
	<input type="text" name="studentnr">
</div>

<div class="form-row">
	<span class="label">Email *</span>
	<input type="text" name="email">
</div>

<div class="form-row">
	<span class="label"> *</span>
	<input type="text" name="achternaam">
</div>

<div class="form-row">
<input class="submit" type="submit" name="register_event" value="">
</div>

</form>
</div>

<?	}// Sluit session check

include ('incs/footer.php');
?>