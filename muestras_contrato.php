<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
$result=mysql_query("select id from tbl_clientes where nombre='".utf8_decode($_REQUEST['txt_nombre'])."'");

$row=mysql_fetch_assoc($result);

$_SESSION['id_cliente']=$row['id'];
mysql_free_result($result);
$_SESSION['nombre_cliente']=$_REQUEST['txt_nombre'];
$_SESSION['nombre']=$_REQUEST['txt_nombreSolicitante'];
$_SESSION['telefono']=$_REQUEST['txt_telefonoSolicitante'];
$_SESSION['tipo_pago']=$_REQUEST['cmb_tipoPago'];
$_SESSION['xcorreo']=$_REQUEST['cmb_xcorreo'];
$_SESSION['tipoCliente']=$_REQUEST['txt_tipoCliente'];
$_SESSION['contrato']=$_REQUEST['txt_consecutivo'];
$_SESSION['maximo'] = substr($_REQUEST['txt_consecutivo'], 3);
echo $_SESSION['consumible']=$_REQUEST['txt_consumible'];
echo $_SESSION['consumido']=$_REQUEST['txt_consumido'];
//borro todos los datos de los analisis ligados a este contrato por si deje el contrato a la mitad 
mysql_query("Delete from tbl_analisis where id_contrato='".$_SESSION['contrato']."'");

mysql_query("Delete from tbl_muestras where id_contrato='".$_SESSION['contrato']."'");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />

<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/jquery-ui.min.js" type="text/javascript"></script>
<script>



</script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g_m" >
<div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g_m"></div>
<div class="lineaAzul_m"></div>
<div class="izq_lat_g" style="height:1850px;" ></div>
<div    class="contenido_gm" align="center">


<?
require_once('menu_superior.php');
?>

<div id="mainAzulFondo" align="center" style=" margin-left:-10px; height:auto; width:970px;">
<div id="mainBlancoFondo" align="center" style=" margin-top:20px;  height:auto; width:910px;">
<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Muestras del Contrato</div>
<div align="center" style="margin-top:10px; margin-bottom:10px;" ><img src="img/uno.png" width="48" height="48" /><img src="img/2_verde.png" width="48" height="48" /><img src="img/3_gris.png" width="48" height="48" /></div>
	<input id="txt_contrato" type="hidden" value="<?=$_SESSION['contrato'];?>" />
 
	<div align="center">
	<? include('tabs.php'); ?>
    
	<div align="center">
    <br />
    <input  name="btn_siguiente" id="btn_continuar" type="image" src="img/btn_continuar.png" /></div>
	</div>

    </div>


</div><!--fin cuadro gris--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g_m" style="height:1850px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g_m"></div>
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
