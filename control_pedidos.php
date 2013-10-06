<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="css/pedidos.css" type="text/css" />
        <link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
        <link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css' />
        <title>SIC-CINA</title>
    </head>
    <body >
    		<div class="header"></div>
    		<div class="box">
        <div style="margin-top:20px;"><?require_once('menu_superior.php');?></div>                               
                <div class="box_azul">
                    <div class="box_blanco">
                        <div>                       
                        <div class="titulo1" align="center"><h2>Control Pedidos</h2></div>                        
<!-- Pedidos Pendiente-->                        
                        <div class="titulo2">Pedidos Pendientes</div>
                        <div class="subtitulos ancho_100">Consecutivo</div>
                        <div class="subtitulos ancho_150">Solicitante</div>
                        <div class="subtitulos ancho_150">Categoria</div>
                        <div class="subtitulos ancho_75">Secci&oacute;n</div>
                        <div class="subtitulos ancho_150">Ingreso</div>
                        <div class="subtitulos ancho_115">Acci&oacute;n</div>
						</div>
<?  
$result=mysql_query(" select  * from tbl_pedidos where estado=0 ");
//$result=mysql_query("select m.codigo,m.fecha_ingreso,a.id,a.nombre,a.observaciones, a.id_laboratorio from tbl_analisis a,tbl_muestras m where a.id_laboratorio=1 and a.estado=1 and a.id_muestra=m.id");
    while ($row=mysql_fetch_object($result)){
?>        
                        <div  class="ancho_100 rows_centrado"><?=$row->consecutivo;?></div>
                        <div  class="ancho_150 rows_izquierda"><?=utf8_encode($row->solicitante);?></div>
                       <?if ($row->tipo==1){?>
                       <div  class="ancho_150 rows_izquierda">Instalaciones</div>
                       <?}elseif ($row->tipo==2){ ?>
                       <div  class="ancho_150 rows_izquierda">Servicio T&eacute;cnico</div>
                       <?}elseif ($row->tipo==3) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==4) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==5) {?>
                       <div  class="ancho_150 rows_izquierda">Compra de:</div>
                       <?}?>


                        <div  class="ancho_75 rows_centrado"><?=utf8_decode($row->seccion);?></div>
                        <div  class="ancho_150 rows_centrado"><?=utf8_encode($row->fecha_creacion);?></div>
                        <div  class="ancho_115 rows_centrado"><a id="btn_consultar" consecutivo="<?=$row->id;?>" class="acciones" href="consulta_pedido.php?id=<?=$row->id?>&accion=1" title="Consultar"><img src="img/search.png" width="25" height="25" /></a>&nbsp;<a id="btn_modifica" consecutivo="<?=$row->id;?>" class="acciones" href="modifica_pedido.php?id=<?=$row->id?>&accion=1" title="Modificar"><img src="img/edit_lapiz.png" width="25" height="25" /></a>&nbsp;<a id="btn_aprobar" consecutivo="<?=$row->consecutivo;?>" class="acciones" title="Aprobar"><img src="img/check.png" width="25" height="25" /></a>&nbsp;<a id="btn_rechazar"  consecutivo="<?=$row->consecutivo;?>" class="acciones"  title="Rechazar"><img src="img/del.png" width="25" height="25" /></a></div>        
        <?  
    }echo '<br></br> <br></br> <br></br><br></br> <br></br>'; 
?>

<!-- Pedidos Aprobados-->                        
                        <div class="titulo2">Pedidos Aprobados</div>
                        <div class="subtitulos ancho_100">Consecutivo</div>
                        <div class="subtitulos ancho_150">Solicitante</div>
                        <div class="subtitulos ancho_150">Categoria</div>
                        <div class="subtitulos ancho_75">Secci&oacute;n</div>
                        <div class="subtitulos ancho_150">Ingreso</div>
                        <div class="subtitulos ancho_115">Acci&oacute;n</div>
<?  
$result=mysql_query(" select  * from tbl_pedidos where estado=1 ");
//$result=mysql_query("select m.codigo,m.fecha_ingreso,a.id,a.nombre,a.observaciones, a.id_laboratorio from tbl_analisis a,tbl_muestras m where a.id_laboratorio=1 and a.estado=1 and a.id_muestra=m.id");
    while ($row=mysql_fetch_object($result)){
?>        
                        <div  class="ancho_100 rows_centrado"><?=$row->consecutivo;?></div>
                        <div  class="ancho_150 rows_izquierda"><?=utf8_encode($row->solicitante);?></div>
                       <?if ($row->tipo==1){?>
                       <div  class="ancho_150 rows_izquierda">Instalaciones</div>
                       <?}elseif ($row->tipo==2){ ?>
                       <div  class="ancho_150 rows_izquierda">Servicio T&eacute;cnico</div>
                       <?}elseif ($row->tipo==3) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==4) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==5) {?>
                       <div  class="ancho_150 rows_izquierda">Compra de:</div>
                       <?}?>


                        <div  class="ancho_75 rows_centrado"><?=utf8_decode($row->seccion);?></div>
                        <div  class="ancho_150 rows_centrado"><?=utf8_encode($row->fecha_creacion);?></div>
                        <div  class="ancho_115 rows_centrado"><a id="consultar" consecutivo="<?=$row->id;?>" class="acciones" href="consulta_pedido.php?id=<?=$row->id?>&accion=2" title="Consultar"><img src="img/search.png" width="25" height="25" /></a>&nbsp;&nbsp;&nbsp;<a id="btn_entregar" consecutivo="<?=$row->consecutivo;?>" class="acciones" href="#" title="Entregar"><img src="img/entregar.png" width="25" height="25" /></a></div>        
						
        <?  
    }echo '<br></br> <br></br> <br></br><br></br> <br></br>'; 
?>						
<!-- Pedidos Rechazados-->


                        <div class="titulo2">Pedidos Rechazados</div>
                        <div class="subtitulos ancho_100">Consecutivo</div>
                        <div class="subtitulos ancho_150">Solicitante</div>
                        <div class="subtitulos ancho_150">Categoria</div>
                        <div class="subtitulos ancho_75">Secci&oacute;n</div>
                        <div class="subtitulos ancho_150">Ingreso</div>
                        <div class="subtitulos ancho_115">Acci&oacute;n</div>
<?  
$result=mysql_query(" select  * from tbl_pedidos where estado=2 ");
//$result=mysql_query("select m.codigo,m.fecha_ingreso,a.id,a.nombre,a.observaciones, a.id_laboratorio from tbl_analisis a,tbl_muestras m where a.id_laboratorio=1 and a.estado=1 and a.id_muestra=m.id");
    while ($row=mysql_fetch_object($result)){
?>        
                        <div  class="ancho_100 rows_centrado"><?=$row->consecutivo;?></div>
                        <div  class="ancho_150 rows_izquierda"><?=utf8_encode($row->solicitante);?></div>
                       <?if ($row->tipo==1){?>
                       <div  class="ancho_150 rows_izquierda">Instalaciones</div>
                       <?}elseif ($row->tipo==2){ ?>
                       <div  class="ancho_150 rows_izquierda">Servicio T&eacute;cnico</div>
                       <?}elseif ($row->tipo==3) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==4) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==5) {?>
                       <div  class="ancho_150 rows_izquierda">Compra de:</div>
                       <?}?>


                        <div  class="ancho_75 rows_centrado"><?=utf8_decode($row->seccion);?></div>
                        <div  class="ancho_150 rows_centrado"><?=utf8_encode($row->fecha_creacion);?></div>
                        <div  class="ancho_115 rows_centrado"><a id="btn_aprobar" consecutivo="<?=$row->id;?>" class="acciones" href="consulta_pedido.php?id=<?=$row->id?>&accion=3" title="Consultar"><img src="img/search.png" width="25" height="25" /></a>&nbsp;&nbsp;&nbsp;<a id="btn_modifica" consecutivo="<?=$row->id;?>" class="acciones" href="modifica_pedido.php?id=<?=$row->id?>&accion=1" title="Modificar"><img src="img/edit_lapiz.png" width="25" height="25" /></a>&nbsp;&nbsp;&nbsp;<a id="aprobar" consecutivo="<?=$row->id;?>" href="#" class="acciones" title="Aprobar"><img src="img/check.png" width="25" height="25" /></a></div>        
        <?  
    }echo '<br></br> <br></br> <br></br><br></br> <br></br>'; 
?>


<!-- Pedidos Entregados-->
                       
                        <div class="titulo2">Pedidos Entregados</div>
                        <div class="subtitulos ancho_100">Consecutivo</div>
                        <div class="subtitulos ancho_150">Solicitante</div>
                        <div class="subtitulos ancho_150">Categoria</div>
                        <div class="subtitulos ancho_75">Secci&oacute;n</div>
                        <div class="subtitulos ancho_150">Ingreso</div>
                        <div class="subtitulos ancho_115">Acci&oacute;n</div>
<?  
$result=mysql_query(" select  * from tbl_pedidos where estado=3 ");
//$result=mysql_query("select m.codigo,m.fecha_ingreso,a.id,a.nombre,a.observaciones, a.id_laboratorio from tbl_analisis a,tbl_muestras m where a.id_laboratorio=1 and a.estado=1 and a.id_muestra=m.id");
    while ($row=mysql_fetch_object($result)){
?>        
                        <div  class="ancho_100 rows_centrado"><?=$row->consecutivo;?></div>
                        <div  class="ancho_150 rows_izquierda"><?=utf8_encode($row->solicitante);?></div>
                       <?if ($row->tipo==1){?>
                       <div  class="ancho_150 rows_izquierda">Instalaciones</div>
                       <?}elseif ($row->tipo==2){ ?>
                       <div  class="ancho_150 rows_izquierda">Servicio T&eacute;cnico</div>
                       <?}elseif ($row->tipo==3) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==4) {?>
                       <div  class="ancho_150 rows_izquierda">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==5) {?>
                       <div  class="ancho_150 rows_izquierda">Compra de:</div>
                       <?}?>


                        <div  class="ancho_75 rows_centrado"><?=utf8_decode($row->seccion);?></div>
                        <div  class="ancho_150 rows_centrado"><?=utf8_encode($row->fecha_creacion);?></div>
                        <div  class="ancho_115 rows_centrado"><a id="btn_aprobar" consecutivo="<?=$row->id;?>" class="acciones" href="consulta_pedido.php?id=<?=$row->id?>&accion=4" title="Consultar"><img src="img/search.png" width="25" height="25" /></a>&nbsp;&nbsp;&nbsp;</div>        
						
        <?  
    }echo '<br></br> <br></br> <br></br><br></br> <br></br>'; 
?>
  <div id="dialog-form" title="Informaci&oacute;n de la Entrega">  
    <div class="Arial14Morado">Detalle de la entrega</div>
    <div><textarea rows="4" cols="40" name="txt_detalle" consecutivo="" id="txt_detalle" ></textarea></div>  
  </div>
					

					</div> <!-- end div blanco-->  
        </div><!-- end div azul-->  
      </div><!-- end div cuadro gris-->             
				            
            	
    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
</html>

