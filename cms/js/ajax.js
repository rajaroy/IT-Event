function check(){

var xmlHttp;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
  	return xmlHttp;
}

function keuzeEvent(event_id)
	{

var xmlHttp = check();

	if (xmlHttp)
		{
		xmlHttp.open('GET', 'incs/inschrijf_klassen.php?event_id='+event_id, true);
		xmlHttp.onreadystatechange =
		function()
			{
			if((xmlHttp.readyState == 4) && (xmlHttp.status == 200))
				{
				document.getElementById('rest').innerHTML=xmlHttp.responseText;
				}
			}
			xmlHttp.send(null);
		}
	else
		{
		document.getElementById('rest').innerHTML = 'Foutje?';
		}
	
	}



function keuzeKlas(klas_id)
	{

var xmlHttp = check();

	if (xmlHttp)
		{
		xmlHttp.open('GET', 'incs/inschrijf_klassen.php?klas_id='+klas_id, true);
		xmlHttp.onreadystatechange =
		function()
			{
			if((xmlHttp.readyState == 4) && (xmlHttp.status == 200))
				{
				document.getElementById('rest2').innerHTML=xmlHttp.responseText;
				}
			}
			xmlHttp.send(null);
		}
	else
		{
		document.getElementById('rest2').innerHTML = 'Foutje?';
		}
	
	}