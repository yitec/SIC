<?php
include ('../cnx/Conexion_Calidad.php');
conectar();
$consulta = "SELECT * FROM `vista_maestro` WHERE `estado` =1 ORDER BY `nombre_archivo` ASC";	

$dt=mysql_query($consulta);

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
<div class="box">
<div align="center">
<table><tr><td> 
<div class="contenido_gm">
<div style="margin-left:650px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="menu_inventario.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Control Maestro:</div>
    <div align="center" class=" Arial14Negro" style="margin-bottom:10px; margin-top:10px;">
    <div class="maestro_titulo">Categoría</div>
    <div class="maestro_titulo">Subcategoría</div>
    <div class="maestro_titulo">Nombre</div>
    <div class="maestro_titulo">Versión</div>
    <div class="maestro_titulo">Archivo</div></br></br></br>
     <?php				
    while($info=mysql_fetch_array($dt)){
	echo '<div class="maestro_lista">'.utf8_encode($info[9]).'</div><div class="maestro_lista">'.utf8_encode($info[10]).'</div><div class="maestro_lista">'.utf8_encode($info[3]).'</div><div class="maestro_lista">'.utf8_encode($info[4]).'</div><div class="maestro_lista"><a target="_blank" href="'.($info[8]).'">Ver Archivo</a></div>
   </br>';} echo '<br><br><br><br>';?>
    </div>
	<div align="center" style="margin-top:20px; margin-bottom:20px;">
	  <a href="../includes/genera_maestroExcell.php" target="_blank"> <input type="button" name="boton" value="Generar Archivo Excell" /> </a>
	</div>    

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
<br><br>
</div>		
</body>
<script src="../includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="../includes/Scripts_Calidad.js" type="text/javascript"></script> 
</html>

