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
	function check($username, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_cms WHERE username='".$username."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				if($row[status] == 0)
					{
					return '2';
					}
				else
					{
					$aantal = mysql_num_rows($sql);
					return $aantal;
					}
				}
			}
		}
	
	// // Ingelogde gebruikersnaam ophalen
	function name($username, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_cms WHERE username='".$username."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$name = $row[username];
				return $name;
				}
			}
		}
		
		// Ingelogde gebruikersID ophalen
		function usr_id($username, $password)
		{
		$this -> verbinding();
		$sql = mysql_query ("SELECT * FROM itevent_cms WHERE username='".$username."' AND password='".$password."' LIMIT 1");

		if(!$sql)
			{
			print 'Invalid query! <br /><br />'.mysql_error();
			}
		else
			{
			while ($row = mysql_fetch_array($sql))
				{
				$usr_id = $row[cms_id];
				return $usr_id;
				}
			}
		}

	} // Einde class functie
?>