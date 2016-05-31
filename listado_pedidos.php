<?
session_start();
require_once('cnx/session_activa.php');
require_once('cnx/conexion_compras.php');
conectarc();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel ="stylesheet" href="css/pedidos.css" type="text/css" />
    <link rel ="stylesheet" href="css/pedidos_tablas.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
    <link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css' />
    <title>SIC-CINA</title>
</head>
    <body>
        <table    border="1"  cellpadding="0" cellspacing="0" >
        <thead>
        <tr>
        <th>
            <div style="width: 15px;">Consecutivo</div>
        </th> 
        <th>
            <div style="width: 50px;">Solicitante</div>
        </th>         
        <th>
            <div style="width: 25px;">Sección</div>
        </th> 
        <th>
            <div style="width: 25px;">Fecha Ingreso</div>
        </th>
        <th>
            <div style="width: 50px;">Acción</div>
        </th>  
        </thead>

        <tbody>
        <?
        
        $result=mysql_query("select ped.id_pedido, ped.consecutivo, ped.solicitante, ped.seccion, ped.fecha_creacion, arc.nombre  from tbl_pedidos ped join tbl_archivos arc on ped.consecutivo=arc.consecutivo where estado=0 ");
        while ($row=mysql_fetch_object($result)){
            echo '<tr><td class="datos">'.$row->consecutivo.'</td><td class="datos">'.utf8_decode($row->solicitante).'</td><td class="datos">'.utf8_decode($row->seccion).'</td><td class="datos">'.
            $row->fecha_creacion.'</td><td class="datos"><span><a  id="btn_consultar"  title="Consultar" href="detalle_pedido.php?id='.$row->id_pedido.'">Consultar
            </a></span><span>| <a class="datos" id="btn_aprobart" href="presupuesto_pedidos.php?id_pedido='.$row->id_pedido.'" id_pedido="'.$row->id_pedido.'">Aprobar</a></span><span> | <a class="datos" href="#" id="btn_rechazart" id_pedido="'.$row->id_pedido.'">Rechazar</a> | <a class="datos" target="blank" href="img_cotizaciones/'.$row->nombre.'" id="btn_archivo" archivo="'.$row->nombre.'">Archivo</a></span></td></tr>';
        }
        
        ?>
        </tbody>
        </table>

    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
</html>