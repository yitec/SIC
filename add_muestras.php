<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
$(document).ready(function() {
					   
				$("#ver").live.fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
						   
});						   
</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style="width:1101px;">
  <div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Mantenimiento Muestras</div><div align="right"></div> </div>
<div class="der_sup_g_m" ></div>
<div class="lineaAzul_m"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm" align="center" >


<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:980px;">
<div id="mainBlancoFondo" >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Agregar Muestras</div>
    <div align="center" id="mainBlancoMolienda" style="width:960px;">
	<? include('tabs_amuestras.php'); ?>

    <div align="center"><input name="btn_agregar" id="btn_agregar" type="image" src="img/btn_agregar.png" /></div>

    </div>



</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g_m" style=" height:3000px;" ></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g" style="width:1101px;"></div>
<div class="der_inf_g_m"></div>

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




</body>

</html>
