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
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
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
        <div class="box_blanco " style="height:400px;">
        <?
        $result=mysql_query("select count(1) as total from tbl_pedidos where estado=0 ");
        $row=mysql_fetch_object($result);
        $pendientes=$row->total;
        $result=mysql_query("select count(1) as total from tbl_pedidos where estado=1 ");
        $row=mysql_fetch_object($result);
        $aprobados=$row->total;
        $result=mysql_query("select count(1) as total from tbl_pedidos where estado=2 ");
        $row=mysql_fetch_object($result);
        $rechazados=$row->total;
        $result=mysql_query(" select count(1) as total from tbl_pedidos");
        $row=mysql_fetch_object($result);
        $total=$row->total;
        ?>
        <div class="rectangulo_titulo"><p class="texto_titulo">Detalle Pedidos</p></div>
        <a id="ver" href="listado_pedidos.php"><div class="rectangulo "><p class="texto_cuadros_blanco">Total= <?=$pendientes?></p><div class="mini_rectangulo"><p class="texto_cuadros_sombreado">Pendientes</p></div></div></a>
        <div class="rectangulo2"><p class="texto_cuadros_blanco">Total= <?=$aprobados?></p><div class="mini_rectangulo"><p class="texto_cuadros_sombreado">Aprobados</p></div></div>
        <div class="rectangulo3"><p class="texto_cuadros_blanco">Total= <?=$rechazados?></p><div class="mini_rectangulo"><p class="texto_cuadros_sombreado">Rechazados</p></div></div>
        <div class="rectangulo4"><p class="texto_cuadros_blanco">Total= <?=$total?></p><div class="mini_rectangulo"><p class="texto_cuadros_sombreado">Total General</p></div></div>
   

				</div> <!-- end div blanco-->  
        </div><!-- end div azul-->  
      </div><!-- end div cuadro gris-->             				                        	
    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
</html>

