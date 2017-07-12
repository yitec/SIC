<?
session_start();
require_once('cnx/conexion_compras.php');
conectarc();

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
        <link rel="stylesheet" href="css/normalize_dropdown.css">
        <link rel="stylesheet" href="css/stylesheet_dropdown.css">
        <script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
        <script src="includes/selectize_dropdown.js"></script>
        <script src="includes/index_dropdown.js"></script>
        <title>SIC-CINA</title>
    </head>
    <body >
        <div align="center"><h2>Nuevo articulo</h2></div>                  
        <div id="productos_dinamicos"><!--Dentro de este div se cargan todos los articulos -->            
        </div><!--Dentro de este div se cargan todos los articulos -->
        <br><br>
          
        <div id="siguiente" align="center">
            <input  id="btn_siguiente"  type="image"  src="img/btn_continuar.png" /><br />
        </div>    	
    </body>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>

</html>

