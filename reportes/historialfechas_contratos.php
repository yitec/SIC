<?
session_start();
require_once('../cnx/conexion.php');
conectar();
$total=0;
$molienda=0;
$analisis=0;
$aprobacion=0;
$aprobados=0;

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
<div class="cen_sup_g" style="width:1200px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Historial contratos entre fechas</div><div align="right" ></div> </div>
<div class="der_sup_g" style=" margin-left:1201px;" ></div>
<div class="lineaAzul" style="width:1208px;"></div>
<div class="izq_lat_g" style="height:5000px; "></div>
<div    class="contenido_gm" >



<div id="mainAzulFondo" align="center" style=" width: 1080px; height:auto; " >
<div id="mainBlancoFondo" align="center" style="padding: 20 20 20 20;">

<div align="center" id="Exportar_a_Excel">
<br />    
<br />
<br />
	<table width="1008"  height="22" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td width="94"><div align="center" class="Arial14Azul" style="margin-top:5px;">Contrato</div></td>
    <td width="94"><div align="center" class="Arial14Azul" style="margin-top:5px;">Fecha Ingreso</div></td>
    <td width="119"><div align="center" class="Arial14Azul">Muestra</div></td>    
    <td width="118"><div align="center" class="Arial14Azul">An&aacute;lisis</div></td>
    <td width="114"><div align="center" class="Arial14Azul">Status actual</div></td>                
    <td width="136"><div align="center" class="Arial14Azul">Fecha Molienda</div></td>
    <td width="136"><div align="center" class="Arial14Azul">Fecha Trabajando</div></td>    
    <td width="143"><div align="center" class="Arial14Azul">Fecha Resultados</div></td>
    <td width="132"><div align="center" class="Arial14Azul">Fecha Rechazado</div></td>        
    <td width="134"><div align="center" class="Arial14Azul">Fecha Aprobado</div></td>            
    </tr>	
<?
$tot_contratos=0;
$con_actual='GE-0';
$result=mysql_query("SELECT con.consecutivo,con.fecha_ingreso,cat.nombre, ana.* FROM tbl_contratos as con JOIN tbl_analisis as ana ON con.consecutivo=ana.id_contrato JOIN tbl_categoriasanalisis cat ON ana.id_analisis=cat.id LEFT JOIN tbl_clientes cli on con.id_cliente=cli.id WHERE con.fecha_ingreso>='".$_REQUEST['fecha_ini']."' AND con.fecha_ingreso<='".$_REQUEST['fecha_fin']."' AND cli.tipo_cliente='".$_REQUEST['tipo_cliente']."' order by con.consecutivo,ana.id");
while ($row=mysql_fetch_assoc($result)){
    if($con_actual<>$row['id_contrato']){
        $tot_contratos++;
        $con_actual=$row['consecutivo'];
    }
   
		switch ($row['estado']){
		case 0:
			$actual="Molienda";
			$molienda++;
			break;
		case 1:
			$actual="Pendiente de An&aacute;lisis";
			$analisis++;
			break;
		case 2:
			$actual="Pendiente de Aprobaci&oacute;n";
			$aprobacion++;
			break;
		case 3:
			$actual="Aprobado";	
			$aprobados++;
			break;
		}
		if($row['estado']==1 and $row['trabajando']==1){
			$actual="Realizando Analisis";	
		}
		
			
		
?>
	<tr>
    <td><div align="center" class="Arial11Negro"><?=$row['id_contrato'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_ingreso'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['codigo'];?></div></td>    
    <td><div align="center" class="Arial11Negro"><?=utf8_encode($row['nombre']);?></div></td>    
    <td><div align="center" class="Arial11Negro"><?=$actual;?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_molienda'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_trabajando'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_analisis'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_rechazado'];?></div></td>    
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_gerentes'];?></div></td> 


    </tr>	

<?

}//end recorre contratos
?>
</table>

<br />
<div align="center" class="Arial14Morado" > Total Contratos = <?=$tot_contratos;?></div>

</div>

<br />
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>  

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:5000px; margin-left:1201px;"></div>
<div class="izq_inf_g"></div>

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
