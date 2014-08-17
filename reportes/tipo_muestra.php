<?
session_start();
require_once('../cnx/conexion.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/jquery-1.7.1.js"></script>
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
<div class="cen_sup_g" style="width:1200px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Status Contratos</div><div align="right" ></div> </div>
<div class="der_sup_g" style=" margin-left:1201px;" ></div>
<div class="lineaAzul" style="width:1208px;"></div>
<div class="izq_lat_g" style="height:5000px; "></div>
<div    class="contenido_gm" >



<div id="mainAzulFondo" align="center" style=" width: 1080px; height:auto; " >
<div id="mainBlancoFondo" align="center" style="padding: 20 20 20 20;">
<div align="center" id="Exportar_a_Excel">
	<table width="727"  height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td width="93"><div align="center" class="Arial14Azul">Contrato</div></td>
    <td width="87"><div align="center" class="Arial14Azul">Tipo Muestra</div></td>    
    <td width="87"><div align="center" class="Arial14Azul">Nombre Producto</div></td> 
    <td width="96"><div align="center" class="Arial14Azul">Fecha Toma Muestra</div></td>    
    </tr>	
<?

$result=mysql_query("select * from tbl_infmuestras order by cons_contrato  desc");
	while ($row=mysql_fetch_assoc($result)){
		
?>
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['cons_contrato'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row['tipo_alimento']);?></div></td>  
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row['nombre_producto']);?></div></td>  
    <td><div align="center" class="Arial14Negro"><?=$row['fecha_muestra'];?></div></td>    
    </tr>	

<?
	}
?>
</table>
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>  
</div><!--div cuadro excel--> 
</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:5000px; margin-left:1201px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g" style="width:1200px;"></div>
<div class="der_inf_g" style="margin-left:1201px;"></div>

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
