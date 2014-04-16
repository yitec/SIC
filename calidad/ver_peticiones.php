<?php
include ('../cnx/Conexion_Calidad.php');
conectarc();


$result=mysql_query("SELECT pen.id_pendiente,pen.comentario,pen.nuevo_archivo,pen.url_online,pen.fecha_solicitud,arc.nombre_archivo,arc.id_archivo FROM tbl_pendientes pen, tbl_archivos arc WHERE pen.estado = 1 and pen.id_archivo=arc.id_archivo  ORDER  BY fecha_solicitud ASC");
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
<div style="margin-left:650px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="control_calidad.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">R-GE-04  v9 Solicitud de modificaci&oacute;n o elaboraci&oacute;n de documentos</div>

<div id="tabla">
<div class="filatitulo">
    <span class="celda">Archivo</span>
    <span class="celda">Comentario</span>
    <span class="celda">Fecha</span>
    <span class="celda">Acciones</span>
</div>
<?php				
if (mysql_num_rows($result)>0)
{     
while($row=mysql_fetch_object($result))
{

										$tot++;
										$nuevoarchivo=$row->nuevo_archivo;
                     echo '<div class="fila">
                      <span class="celda">'.utf8_decode($row->nombre_archivo).'</span>
                      <span class="celda">'.utf8_decode($row->comentario).'</span>
                      <span class="celda">'.$row->fecha_solicitud.'</span>
                      <span class="celda"><a href="archivos/Pendientes/'.$nuevoarchivo.'"><input name="button" id="btn_descargar" class="btn_descargar"  title="Descargar" value="'.$row->id_pendiente.'" type="image" src="../img/descargar.png"></a>&nbsp;&nbsp;&nbsp;<input name="button"  class="btn_aprobar" title="Aprobar" value="'.$row->id_pendiente.'" id_archivo="'.$row->id_archivo.'" nombre_archivo="'.$nuevoarchivo.'"  type="image" src="../img/aprove_icon.png">&nbsp&nbsp&nbsp;<input  name="button2" title="Rechazar" class="btn_rechazar" value="'.$row->id_pendiente.'" id_archivo="'.$row->id_archivo.'" nombre_archivo="'.$nuevoarchivo.'" type="image" src="../img/deny_icon.png"></span>
                      </div>';
                    
}//end while
}else{
  echo 'No hay pendientes';
  
}//end if
?>
  
	
</div><!--fin div de tabla-->






</td></tr></table>
</div><!--fin div de centrado-->
</div><!--fin div de box-->	

    </body>
<script src="../includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="../includes/Scripts_Calidad.js" type="text/javascript"></script> 
</html>

