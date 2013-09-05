<?
session_start();
require_once('../cnx/conexion.php');
require_once('../cnx/session_activa.php');
conectar();
$hoy=date("Y-m-d H:i:s");
$ano=substr($_REQUEST['fecha_ini'], 0, 4);
$mes=substr($_REQUEST['fecha_ini'], 5, 2);
$dia=substr($_REQUEST['fecha_ini'], 8, 2);
 
$fecha_ini=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";


$ano=substr($_REQUEST['fecha_fin'], 0, 4);
$mes=substr($_REQUEST['fecha_fin'], 5, 2);
$dia=substr($_REQUEST['fecha_fin'], 8, 2);

$fecha_fin=$ano."-".$mes."-".$dia." ".$_GET['cmb_fin'].":00";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/jquery-1.7.1.js"></script>
<script>
function redirigir(id){
window.location = "imprime_muestras.php?id="+id;	
}

</script>
<script language="javascript">
$(document).ready(function() {

	$(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Reportes Contratos por tipo pago</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:8000px;"></div>
<div    class="contenido_gm">


<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo" >

<div align="center" id="Exportar_a_Excel">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Contratos por tipo pago entre <?=$_REQUEST['fecha_ini']?> y <?=$_REQUEST['fecha_fin']?></div>
    <div align="center" id="mainBlancoMolienda">
    
	<table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Cliente</div></td>    
    <td><div align="center" class="Arial14Azul">Tipo Pago</div></td>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td><div align="center" class="Arial14Azul">Monto</div></td>    
    <td><div align="center" class="Arial14Azul">Factura</div></td>    
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
         
    </tr>	
<?

$result=mysql_query("select * from tbl_contratos where tipo_pago='".$_REQUEST['cmb_tipoPago']."' and fecha_ingreso>='".$fecha_ini."' and fecha_ingreso<='".$fecha_fin."'   order by fecha_ingreso");
	while ($row=mysql_fetch_assoc($result)){
	$result2=mysql_query("select nombre from tbl_clientes where id='".$row['id_cliente']."'");
	$row2=mysql_fetch_assoc($result2);
	$cont++;
	$monto=$monto+$row['monto_total'];
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['consecutivo'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row2['nombre']);?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['tipo_pago'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$row['numero_muestras'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['monto_total'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['factura'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['fecha_ingreso'];?></div></td>    
    
    </tr>	
    
<?	
	}

?>
	</table>
    
    </div>

</div><!--div de centrado-->  

<div align="center" class="Arial14Morado">Total de Contrato : <?=$cont?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Monto Total : 
  <?=$monto?>
</div>  
    
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>  

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:8000px;"></div>
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

<?
//**********************************************funcion que recibe los errores**********************************************

function throw_ex($er){  
  throw new Exception($er);  
}  		
?>

</body>

</html>
