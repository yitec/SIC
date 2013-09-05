<?php
define ("descuento","0.30");
function conectar()
{
	//mysql_connect("localhost", "sid", "mizard777");
	//mysql_select_db("bdsms");
	
	//$_SESSION['connectid'] = mysql_connect("localhost","root","1q2w3e"); 
	//mysql_connect('localhost', 'root', '1q2w3e');
	//mysql_select_db("bd_svi");
	
	//$_SESSION['connectid'] = mysql_connect('bdsic.db.8845103.hostedresource.com', 'bdsic', 'Sic_2012');
	//mysql_select_db("bdsic");
	
	$_SESSION['connectid'] = mysql_connect('localhost', 'root', '1q2w3e');
	mysql_select_db("bd_inventarios"); 

}

function desconectar()
{
	mysql_close();
}
?>