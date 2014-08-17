<?php

function conectara()
{	
	$_SESSION['conectact'] = mysql_connect('localhost', 'root', '1q2w3e');
	mysql_select_db("bd_activos"); 
}

function desconectara()
{
	mysql_close();
}

?>