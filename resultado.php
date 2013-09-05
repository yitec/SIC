<?
session_start();
require_once('cnx/session_activa.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
</head>
<script>
//window.parent.location="http://www.google.com"
//window.open('http://www.google.com','_parent')
$(document).ready(function() {
						   
  //window.location.href = 'http://domain.com/xxx/p' + $(this).val();
	 variable='http://siccina.ucr.ac.cr/SIC/contrato.php?contrato='+$("#contrato").val()+'&muestras='+$("#muestras").val()+'&oficiales='+$("#oficiales").val()+'&forrajes='+$("#forrajes").val();
	 window.open('http://siccina.ucr.ac.cr/SIC/contrato.php?contrato='+$("#contrato").val()+'&muestras='+$("#muestras").val()+'&oficiales='+$("#oficiales").val()+'&forrajes='+$("#forrajes").val()+'&usuario='+$("#usuario").val(),'_blank');
	 //window.open('http://siccina.ucr.ac.cr/SIC/contrato.php?contrato='+$("#contrato").val()+'&muestras='+$("#muestras").val()+'&oficiales='+$("#oficiales").val()+'&forrajes='+$("#forrajes").val(),'_blank');
	 window.open('http://siccina.ucr.ac.cr/SIC/etiquetas_contrato.php?contrato='+$("#contrato").val()+'&numero_muestras='+$("#numero_muestras").val(),'_blank');
        return false;
});
</script>


<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm" align="center">
<br />
<br /><br />

<div style="margin-left:700px;  margin-top:5px; " class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>
<div id="mainAzulFondo" align="center" style="width:400px; height:300px;" >
<div id="mainBlancoFondo" style="width:350px; height:250px; margin-top:25px">
	<br />
    <br /><br />
	<div align="center" class="Arial18Morado">Contrato creado con exito !!! </div>
    <br />
    <br />
     <div align="center"><a href="menu.php"><img src="img/menu.png" width="235" height="45" /><input name="contrato" id="contrato"  type="hidden" value="<?=$_REQUEST['contrato']; ?>" />
 <input name="muestras" id="muestras"  type="hidden" value="<?=$_REQUEST['muestras']; ?>" />
 <input name="oficiales" id="oficiales"  type="hidden" value="<?=$_REQUEST['oficiales']; ?>" />
 <input name="forrajes" id="forrajes"  type="hidden" value="<?=$_REQUEST['forrajes']; ?>" />
 <input name="usuario" id="usuario"  type="hidden" value="<?=$_REQUEST['usuario']; ?>" />
 <input name="numero_muestras" id="numero_muestras"  type="hidden" value="<?=$_REQUEST['numero_muestras']; ?>" /></a></div>
</div><!--fin cuadro blanco-->      
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

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
