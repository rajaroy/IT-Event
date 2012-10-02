<?
include ('incs/head.php');
include ('incs/connection.php');

$get_tekst = mysql_query("SELECT * FROM itevent_contents WHERE destination='contact'");

while ($row_tekst = mysql_fetch_array($get_tekst))
	{
	print $row_tekst[content];
	}
?> 

<div class="form-div">
	<div id="mail_logo"></div>
 	<form id="fvujq-form1" method="post" action="">
  		<div class="form-row">
      <span class="label">Naam *</span>
      <input type="text" name="name">

  		</div>
  		<div class="form-row">
      <span class="label">E-Mail *</span>
      <input type="text" name="email">
  		</div>

  		<div class="form-row">
      <span class="label">Uw bericht *</span>
      <textarea name="comment"></textarea>
  		</div>
  		<div class="form-row">
      <input class="submit" type="submit" value="">
  		</div>
 	</form>
</div>

<?include ('incs/footer.php');?>