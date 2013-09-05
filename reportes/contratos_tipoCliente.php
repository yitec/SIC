<?
session_start();
include('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
$dia=substr($_REQUEST['fecha_ini'], 3, 2);
$ano=substr($_REQUEST['fecha_ini'], 6, 4);
$mes=substr($_REQUEST['fecha_ini'], 0, 2);

$fecha_ini=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

$dia=substr($_REQUEST['fecha_fin'], 3, 2);
$ano=substr($_REQUEST['fecha_fin'], 6, 4);
$mes=substr($_REQUEST['fecha_fin'], 0, 2);

$fecha_fin=$ano."-".$mes."-".$dia." ".$_GET['cmb_fin'].":00";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/jquery-1.7.1.js"></script>
<script language="javascript">
$(document).ready(function() {

	$(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
<style>
a:visited{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 		
}

a:link{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}

a:hover{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}


</style>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reportes Contratos por tipo de cliente</div><div align="right"></div> </div>
<div class="der_sup_g" style=" position:relative; margin-left:1101px;" ></div>
<div class="lineaAzul" style="width:1109px;"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">



<div id="mainAzulFondo" style=" width:1000px;padding:5px;" >
<div id="mainBlancoFondo" style="width:985px;" >
<div align="center" id="Exportar_a_Excel">
<br />
<div align="center" class="Arial18Morado"> Contratos para <?=$_REQUEST['cmb_tipo']?></div>
<br />
<table width="900" border="1"  cellpadding="0" cellspacing="0">
  <tr>
    <td width="66">
    	<div style=" background:url(../img/centro_grid.png);" class=" Arial14Morado"><strong>Contrato</strong></div>
  	</td> 
    <td width="58">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Cliente</strong></div>
  	</td> 
    <td width="97" >
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Muestras</strong></div>
  	</td> 
    <td width="36">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Monto</strong></div>
  	</td> 
    
  </tr>
<?
$cont=0;
$monto=0;
$result=mysql_query("select * from tbl_clientes where tipo_cliente='".$_REQUEST['cmb_tipo']."'");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
while ($row=mysql_fetch_assoc($result)){

$result2=mysql_query("select * from tbl_contratos where id_cliente='".$row['id']."'");
if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
			
		} 

while($row2=mysql_fetch_assoc($result2)){
	$cont++;
	$monto=$monto+$row2['monto_total'];
?>
  
  <tr>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row2['consecutivo']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['nombre']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row2['numero_muestras']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row2['monto_total']);?></td>
    
  </tr>
<?
}
}
?>
  
  
</table>
<br />
<div align="center" class="Arial14Morado">Total de contratos : <?=$cont?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Monto Total : <?=$monto?></div>
    
  <br />  
    
</div><!--div de centrado-->    
    
    
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>      
    
    
	
    

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style=" margin-left:1101px; height:1000px"></div>


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
