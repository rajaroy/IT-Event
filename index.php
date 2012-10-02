<?include ('incs/head.php');?>

<div id="home_tekst">
<?
include ('incs/connection.php');

$get_tekst = mysql_query("SELECT * FROM itevent_contents WHERE destination='index'");

while ($row_tekst = mysql_fetch_array($get_tekst))
	{
	print $row_tekst[content];
	}
?>
</div>

<?include ('incs/footer.php');?>