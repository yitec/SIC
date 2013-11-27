<?php

function conectar()
{	
	$_SESSION['connectid'] = mysql_connect('localhost', 'root', '1q2w3e');
	mysql_select_db("bd_calidad"); 
}

function desconectar()
{
	mysql_close();
}

?>