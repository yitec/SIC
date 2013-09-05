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
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
</head>

<body>
<div align="center">



<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> 
</div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:800px;"></div>
<div    class="contenido_gm">


<br />
<div align="left" style="float:left" class="Arial8negro">Usuario=&nbsp; </div><div align="left"  style="float:left" class="Arial8azul"><?=$_SESSION['nombre_usuario'];?>&nbsp;&nbsp;</div>
<div style="margin-left:700px;  margin-top:5px; " class="Arial18Azul">&nbsp;&nbsp;<a href="login.php">Salir</a></div>
<div align="center"><img src="img/logo_mediano.png" width="142" height="142" /></div><br />
<?
include('menu_central.php');
?>
<br />
<div align="center" class="Arial24Azul">SIC-CINA</div>

<div align="center" class="Arial18Azul">Seleccione una de las opciones</div>

<div style="margin-left:700px;  margin-top:186px; " class="Arial10gris"><a href="login.php">Salir</a></div>
</div>
<div class="der_lat_g" style="height:800px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Informaci&oacute;n y control
</div>
<div align="center" style="float:left" class="Arial8azul">
&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
