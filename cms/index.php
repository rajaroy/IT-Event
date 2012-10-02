<?
session_start();
include "incs/head.php";

if($_SESSION['session_cms'] == 1)
	{
	include "incs/logoff.php";

	print '	<p>
			Beste beheerder,<br />
			<br />
			Welkom op het CMS van IT-event.<br />
			Binnen deze hebt u het mogelijkheid om media bestanden, documenten en teksten te beheren.
			<p>
			';
	}
else
	{
	header ('Refresh: 0; url=login.php');
	}

include "incs/footer.php";
?>