<?
include ('incs/head.php');

session_start();

if($_SESSION['session_cms'] == 1)
	{
	print 'session is aan.';
	}
else
	{
	print 'Er is geen sessie.';
	}
include ('incs/footer.php');
?>