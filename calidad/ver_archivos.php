<?php
include ('../cnx/Conexion_Calidad.php');
conectarc();


$dt=mysql_query("SELECT * FROM tbl_archivos WHERE estado = 1  order by nombre_archivo");
echo mysql_error();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="../css/calidad.css" type="text/css" />
        <link rel ="stylesheet" href="../css/cuadros.css" type="text/css" />
        <link rel ="stylesheet" href="../css/jquery.pnotify.default.css" type="text/css" />
        <link rel ="stylesheet" href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" />        
        <title>SIC CINA</title>
    </head>
    <body >
    		<div class="header"></div>
    		<div class="box"><br><br><br>
         <div align="center">
<table><tr><td> 
<div    class="contenido_gm">
<div style="margin-left:650px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="../menu.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Peticiones Pendientes:</div>
    <div align="center" class=" Arial14Negro" style="margin-bottom:10px; margin-top:10px;">
    <div class="lista_titulo">Archivo</div><div class="lista_titulo">Descargar</div><div class="lista_titulo">Editar en web</div></br></br></br></br>
     <?php				
if (mysql_num_rows($dt)>0)
{     
while($r1=mysql_fetch_object($dt))
{
  echo '
  <div class="lista Arial14Negro">'.$r1->nombre_archivo.'</div>
  <div class="lista"><a href="archivos/ControlCalidad/'.$r1->url_archivo.'">Descargar Archivo</a></div>
  <div class="lista"><a href="despliega_archivo.php?url='.$r1->url_online.'">Editar Online</a></div>';

  

			
}//end while
echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}else{
  echo 'No hay pendientes';
  
}//end if
    ?>
    </div>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 




</div><!--fin div de contenido cudro gm-->
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
<script src="../includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="../includes/Scripts_Calidad.js" type="text/javascript"></script> 
</html>

