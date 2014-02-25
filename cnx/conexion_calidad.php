<?php

function conectarc()
{	
	$_SESSION['connectidc'] = mysql_connect('localhost', 'root', '1q2w3e');
	mysql_select_db("bd_calidad"); 
}

function desconectarc()
{
	mysql_close();
}

?>