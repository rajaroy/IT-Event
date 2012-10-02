<?
session_start();
include ('incs/head.php');

if($_SESSION['session_on'] == 1)
	{
	print 'session is aan.';
	}
else
	{
	print 'Er is geen sessie.';
	}

include ('incs/footer.php');
?>