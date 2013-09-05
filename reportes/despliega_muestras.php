<?
session_start();
require_once('../cnx/conexion.php');
require_once('../cnx/session_activa.php');
conectar();
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
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Reportes Muestras por contrato</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">



<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo" >

<div align="center" id="Exportar_a_Excel">
	<div align="center"  class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Contrato <?=$_REQUEST['txt_contrato']?></div>
    <div align="center" id="mainBlancoMolienda">
    
	<table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>
    <td><div align="center" class="Arial14Azul">An&aacute;lisis</div></td>    
    <td><div align="center" class="Arial14Azul">Pendientes</div></td>
    <td><div align="center" class="Arial14Azul">Completos</div></td>        
    </tr>	
<?

$result=mysql_query("select * from tbl_contratos where consecutivo='".$_REQUEST['txt_contrato']."'");
$row=mysql_fetch_assoc($result);
$result2=mysql_query("select Count(*) as analisis from tbl_analisis where id_contrato='".$_REQUEST['txt_contrato']."'");
$row2=mysql_fetch_assoc($result2);
$result3=mysql_query("select Count(*) as completos from tbl_analisis where id_contrato='".$_REQUEST['txt_contrato']."' and estado='"."3"."'");
$row3=mysql_fetch_assoc($result3);


$pendientes=$row2['analisis']-$row3['completos'];
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['numero_muestras'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row2['analisis']);?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$pendientes;?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row3['completos']?></div></td>        
    </tr>	
    

	</table>
    
    </div>


</div><!--fin div de centrado--> 

<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>   


</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 


</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:3000px;"></div>
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
