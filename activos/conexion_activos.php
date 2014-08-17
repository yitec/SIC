<?php

function conectara()
{	
	$_SESSION['conectact'] = mysql_connect('localhost', 'root', 'dmurillo89');
	mysql_select_db("bd_activos"); 
}

function desconectara()
{
	mysql_close();
}

?>