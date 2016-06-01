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
        <div align="center" class="texto_subtitulo">Seleccione el presupuesto</div>
        <br>
        <div align="center">
            <select id="cmb_presupuesto">
                <option value="FUNDEVI">FUNDEVI</option>
                <option value="FONDO DE TRABAJO">FONDO DE TRABAJO</option>
                <option value="PRESUPUESTO ORDINARIO">PRESUPUESTO ORDINARIO</option>
                <option value="SUMINISTROS">SUMINISTROS</option>                
            </select>
        </div><br>
        <div align="center" id="tipo_presupuesto" class="texto_subtitulo">520<input type="radio" class="rnd_tpres" id="rnd_tpres" value="520" name="rnd_tpres"> 1511 <input type="radio" class="rnd_tpres" value="1511" id="rnd_tpres" name="rnd_tpres"> </div>
        <br>
        <div id="siguiente" align="center">
        <input  id="btn_finalizar" id_pedido="<?=$_REQUEST["id_pedido"]?>"  type="image"  src="img/btn_continuar.png" /><br />
        </div>
    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
</html>