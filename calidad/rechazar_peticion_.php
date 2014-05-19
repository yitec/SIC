<?php
include ('../cnx/conexion_calidad.php');
conectar();


$dt=mysql_query("SELECT * FROM tbl_pendientes WHERE estado = 1  ORDER  BY fecha_solicitud ASC");
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
    		<div class="box">
         <div align="center">
<table><tr><td> 
<div    class="contenido_gm">
<div style="margin-left:650px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="menu_inventario.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">	
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Rechazar Petición:</div>
    <div align="center" class=" Arial14Negro" style="margin-bottom:10px; margin-top:10px;">
    <div class="lista_titulo"><strong>Archivo</strong></div><div class="lista_titulo"><strong>Comentario</strong></div><div class="lista_titulo"><strong>Fecha</strong></div></br></br></br></br>
     <?php				
if (mysql_num_rows($dt)>0)
{     
while($info=mysql_fetch_array($dt))
{

										$idpeticion=$info[0];
										$nuevoarchivo=$info[3];
										echo '
    <div class="lista"><a href="archivos/ControlCalidad/'.($nuevoarchivo).'">Ver Archivo</a></div><div class="lista">'.utf8_encode($info[2]).'</div><div class="lista">'.utf8_encode($info[4]).'</div><div class="lista_botones">
      <input name="button" id="btn_aprobar" value="'.$idpeticion.'" type="image" src="../img/btn_aprobar.png">
	  <input type="hidden" id="id_archivo" name="id_archivo" value="'.utf8_encode($info[1]).'">
	  <input type="hidden" id="nuevo_archivo" name="nuevo_archivo" value="'.$nuevoarchivo.'">
      <input  name="button2" id="btn_rechazar" value="'.$idpeticion.'" type="image" src="../img/btn_rechazar.png">
    </div></br></br></br></br></br></br>';
}//end while
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

