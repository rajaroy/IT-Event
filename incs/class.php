<?
class connect
	{
	private $host;
	private $gebruiker;
	private $wachtwoord;
	private $DBnaam;

	protected function verbinding()
		{
		$verbinding = mysql_connect($this -> host, $this -> gebruiker, $this -> wachtwoord)
		or die("De verbinding kan niet worden gemaakt!<br>".mysql_error());
		mysql_select_db($this -> DBnaam);
		}
	// Constructor
	public function __construct()
		{
		$this -> host = "localhost";
		$this -> gebruiker = "student";
		$this -> wachtwoord = "5117rsgs";
		$this -> DBnaam = "school";
		}

	} // Afsluiting class connect

class functie extends connect
	{

	// Controller op bestaande gebruiker
	function check($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			$aantal = mysql_num_rows($sql);
			return $aantal;
			}
		}
	
	// // Ingelogde gebruikersnaam ophalen
	function name($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$name = $row[voornaam].' '.$row[achternaam];
				return $name;
				}
			}
		}
		
		// Ingelogde gebruikersID ophalen
		function usr_id($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$usr_id = $row[usr_id];
				return $usr_id;
				}
			}
		}

	// Ingelogde gebruikers klas ophalen
	function klas($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$klas = $row[klas];
				return $klas;
				}
			}
		}

	// Gebruikers adres ophalen
	function adres($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$adres = $row[adres];
				return $adres;
				}
			}
		}

	// Gebruikers woonplaats ophalen
	function woonplaats($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$woonplaats = $row[woonplaats];
				return $woonplaats;
				}
			}
		}

	// Gebruikers gsm ophalen
	function gsm($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$gsm = $row[gsm];
				return $gsm;
				}
			}
		}
	
	
	// Leraar status ophalen.
	function status($stu_nummer, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$stu_nummer."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$status = $row[leraar];
				return $status;
				}
			}
		}

	// Laatste bezoek ophalen uit database.
	function get_last_visit($session_id)
		{
		include ('vars.php');
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_usr WHERE usr_id='".$session_id."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$date_time = 'Je laatste bezoek, '.$row[last_date].' om '.$row[last_time];
				return $date_time;
				}
			}
		}

	// Laatste bezoek updaten in database.
	function up_last_visit($session_id)
		{
		include ('vars.php');
		$this -> verbinding();
		$sql = mysql_query ("UPDATE itevent_usr SET last_date='".$today."', last_time='".$tijd."' WHERE usr_id='".$session_id."'");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			return 'update succesvol.'.$today;
			}
		}
	}
?>