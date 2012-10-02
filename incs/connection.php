<?php
// -- Made By ICT-LAB
$host = "localhost";
$gebruiker_mysql = "student";
$wachtwoord2 = "5117rsgs";
$DBNaam = "school";
$Verbinding = mysql_connect("$host", "$gebruiker_mysql", "$wachtwoord2") or die("De verbinding met de database kan niet worden gemaakt<p>".mysql_error());
mysql_select_db($DBNaam) OR die("De database kan niet geselecteerd worden");
?>
