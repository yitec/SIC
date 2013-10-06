<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
$result1=mysql_query("select * from tbl_pedidos where id='".$_REQUEST['id']."'");
$row=mysql_fetch_object($result1);
echo mysql_error();
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
    		<div class="header2"></div>
    		<div class="box2">     
            <div align="right"style="margin-top:20px; margin-right:25px;"><?require_once('menu_superior.php');?></div>                                          
                <div class="box_azul2">
                    <div class="box_blanco2">
                        
                        <div class="titulo1" align="center"><h2>Detalle Pedidos</h2></div>  
                        <div  align="right">
                        <? if ($_REQUEST['accion']==1||$_REQUEST['accion']==3){?>
                            <a id="btn_aprobar" consecutivo="<?=$row->consecutivo;?>"  class="acciones" title="Aprobar"><img src="img/check.png" width="25" height="25" /></a>
                        <?}if ($_REQUEST['accion']==1){?>
                        &nbsp;&nbsp;&nbsp;<a id="btn_rechazar"  consecutivo="<?=$row->consecutivo;?>" class="acciones" href="#" title="Rechazar"><img src="img/del.png" width="25" height="25" /></a></div></td>                              
                        <?}
                        $result=mysql_query("select nombre from Tbl_proveedores where id='".$row->id_proveedor."'");
                        $r1=mysql_fetch_object($result);
                        $proveedor=$r1->nombre;

                        ?>


                        <div class="titulo2">Informaci&oacute;n General </div>
                        <div class="subtitulos2 ancho_75">Consecutivo</div>
                        <div class="subtitulos2 ancho_75">Secci&oacute;n</div>
                        <div class="subtitulos2 ancho_150">Solicitante</div>
                        <div class="subtitulos2 ancho_150">Proveedor</div>
                        <div class="subtitulos2 ancho_175">Categoria</div>
                        <div class="subtitulos2 ancho_100">Ingreso</div>
                        <br>
                        <div  class="ancho_75 rows_centrado2"><?=$row->consecutivo;?></div>
                        <div  class="ancho_75 rows_centrado2"><?=utf8_decode($row->seccion);?></div>
                        <div  class="ancho_150 rows_izquierda2"><?=utf8_encode($row->solicitante);?></div>
                        <div  class="ancho_150 rows_izquierda2"><?=utf8_encode($proveedor);?></div>
                       <?if ($row->tipo==1){?>
                       <div  class="ancho_175 rows_izquierda2">Instalaciones</div>
                       <?}elseif ($row->tipo==2){ ?>
                       <div  class="ancho_175 rows_izquierda2">Servicio T&eacute;cnico</div>
                       <?}elseif ($row->tipo==3) {?>
                       <div  class="ancho_175 rows_izquierda2">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==4) {?>
                       <div  class="ancho_175 rows_izquierda2">Calibraci&oacute;n</div>
                       <?}elseif ($row->tipo==5) {?>
                       <div  class="ancho_175 rows_izquierda2">Compra de:</div>
                       <?}?>
                       <div  class="ancho_100 rows_centrado2"><?=utf8_encode($row->fecha_creacion);?></div>

                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="subtitulos2 ancho_450">Asunto</div>
                        <div class="subtitulos2 ancho_150">Proyecto</div>
                        <div class="subtitulos2 ancho_75"># Proyecto</div>                        
                        <br>
                        <div  class="ancho_450 rows_izquierda2"><?=utf8_decode($row->asunto);?></div>
                        <div  class="ancho_150 rows_centrado2"><?=utf8_decode($row->proyecto_nombre);?></div>
                        <div  class="ancho_75 rows_centrado2"><?=utf8_decode($row->proyecto_numero);?></div>
                        
                        
                                            

<?  
echo '<br><br><br><br>';

$result2=mysql_query("SELECT d.id_pedido,d.id_categoria,d.cantidad,d.descripcion,d.observaciones,d.equipo,d.codigo_equipo,d.placa,d.serie,d.marca,d.modelo,d.presentacion,d.pureza,d.grado,d.capacidad,d.tipo_coneccion,d.certificador,d.volumen,d.fecha_recepcion,d.estado,c.nombre FROM tbl_detalle_pedidos d inner join tbl_categorias_pedidos c WHERE d.id_categoria=c.id and d.id_pedido='".$row->id."'");
echo mysql_error();
//$result=mysql_query("select m.codigo,m.fecha_ingreso,a.id,a.nombre,a.observaciones, a.id_laboratorio from tbl_analisis a,tbl_muestras m where a.id_laboratorio=1 and a.estado=1 and a.id_muestra=m.id");
    while ($r2=mysql_fetch_object($result2)){
                        $i++;
                        echo '<br><div align="left" class="Arial18Morado">Articulo '.$i.'</div>';
                        if($r2->cantidad!=''&&$r2->cantidad!='undefined'){?>
                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_50">Cantidad</td></tr>
                            <tr><td  class="ancho_50 row_reset"><?=utf8_decode($r2->cantidad);?></td></tr></table>

                        <?}if($r2->id_categoria!=''&&$r2->id_categoria!='undefined'){?>
                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_150">Compra de</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->nombre);?></td></tr></table>


                        <?}    if($r2->descripcion!=''&&$r2->descripcion!='undefined'){?>
                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_200">Descripcion</td></tr>
                            <tr><td  class="ancho_200 row_reset"><?=utf8_decode($r2->descripcion);?></td></tr></table>

                        <?} if($r2->observaciones!=''&&$r2->observaciones!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_200">Observaciones</td></tr>
                            <tr><td  class="ancho_200 row_reset"><?=utf8_decode($r2->observaciones);?></td></tr></table>
                        
                         <?} if($r2->equipo!=''&&$r2->equipo!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_100">Equipo</td></tr>
                            <tr><td  class="ancho_100 row_reset"><?=utf8_decode($r2->equipo);?></td></tr></table>
                        
                        <?} if($r2->codigo_equipo!=''&&$r2->codigo_equipo!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Codigo</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->codigo_equipo);?></td></tr></table>
                        <?} if($r2->placa!=''&&$r2->placa!='undefined') { ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_50">Placa</td></tr>
                            <tr><td  class="ancho_50 row_reset"><?=utf8_decode($r2->placa);?></td></tr></table>
                        <?} if($r2->serie!=''&&$r2->serie!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_50">Serie</td></tr>
                            <tr><td  class="ancho_50 row_reset"><?=utf8_decode($r2->serie);?></td></tr></table>
                        <?} if($r2->marca!=''&&$r2->marca!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Marca</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->marca);?></td></tr></table>
                        <?} if($r2->modelo!=''&&$r2->modelo!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_50">Modelo</td></tr>
                            <tr><td  class="ancho_50 row_reset"><?=utf8_decode($r2->modelo);?></td></tr></table>
                        <?} if($r2->presentacion!=''&&$r2->presentacion!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_100">Presentaci&oacute;n</td></tr>
                            <tr><td  class="ancho_100 row_reset"><?=utf8_decode($r2->presentacion);?></td></tr></table>
                        <?} if($r2->pureza!=''&&$r2->pureza!='undefined') { ?>
                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Pureza</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->pureza);?></td></tr></table>
                        <?} if($r2->grado!=''&&$r2->grado!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_50">Grado</td></tr>
                            <tr><td  class="ancho_50 row_reset"><?=utf8_decode($r2->grado);?></td></tr></table>
                        <?} if($r2->capacidad!=''&&$r2->capacidad!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Capacidad</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->capacidad);?></td></tr></table>                            
                        <?} if($r2->tipo_coneccion!=''&&$r2->tipo_coneccion!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Conecci&oacute;n</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->tipo_coneccion);?></td></tr></table>
                        <?} if($r2->certificador!=''&&$r2->certificador!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Certificador</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->certificador);?></td></tr></table>                            
                        <?} if($r2->volumen!=''&&$r2->volumen!='undefined'){ ?>

                            <table class="tabla_izquierda"><tr><td class="subtitulos2 ancho_75">Volumen</td></tr>
                            <tr><td  class="ancho_75 row_reset"><?=utf8_decode($r2->volumen);?></td></tr></table>
                        <? }                            
                         echo '<br><br><br><br>'; 
                                                 
    }//end while
?>
                                                                    
                    </div>
                </div>           
			</div>	            
<div id="dialog-form" title="Informaci&oacute;n de la Entrega">
  <form>
  <fieldset>
  <div class="Arial14Morado">Detalle de la entrega</div>
  <div><textarea rows="4" cols="40" name="txt_detalle" consecutivo="" id="txt_detalle" ></textarea></div>
  </fieldset>
  </form>
</div> 
    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
</html>

