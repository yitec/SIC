<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="css/general_v2.css" type="text/css" />
        <link rel ="stylesheet" href="css/cuadros.css" type="text/css" />
        <link rel ="stylesheet" href="css/jquery.pnotify.default.css" type="text/css" />
        <link rel ="stylesheet" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css' />
        <title>XPD</title>
    </head>
    <body >
    		<div class="header"></div>
    		<div class="box">
         <div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Categorias</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">

<div style="margin-left:650px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="menu_inventario.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Buscar Archivo:</div>
	<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script language="JavaScript" src="includes/jquery.watermarkinput.js"></script>

<script type="text/javascript">
$(document).ready(function(){

$(".busca").keyup(function() //se crea la funcioin keyup
{
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'palabra='+ texto;//se guarda en una variable nueva para posteriormente pasarla a search.php
if(texto=='')//si no tiene ningun valor la caja de texto no realiza ninguna accion
{
}
else
{
$.ajax({//metodo ajax
type: "POST",//aqui puede  ser get o post
url: "operaciones/search.php",//la url adonde se va a mandar la cadena a buscar
data: dataString,
cache: false,
success: function(html)//funcion que se activa al recibir un dato
{
$("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
	}
});
}return false;    
});
});
jQuery(function($){//funcion jquery que muestra el mensaje "Buscar archivos..." en la caja de texto
   $("#caja_busqueda").Watermark("Buscar archivos...");
   });
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Buscar Archivos</title>
</head>

<body>

 <div style=" width:250px; padding-right:100px; " >
  <input type="text" class="busca" id="caja_busqueda" name="clave" /><br />
</div> 
<div id="display"></div>
<p>
</br>
</br>
</br>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Control e Informaci&oacute;n.  
</div>
<div align="center" style="float:left" class="Arial8azul">&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>
           
			</div>		
    </body>

<script src="includes/jquery-1.8.3.js" type="text/javascript"></script> 
<script src="includes/jquery.pnotify.js" type="text/javascript"></script>
<script src="includes/Scripts_Calidad.js" type="text/javascript"></script> 
</html>

