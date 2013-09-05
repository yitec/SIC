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
<link rel="stylesheet" href="../css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="../includes/jquery-1.7.1.js"></script>
<script src="../includes/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
function redirigir(id){
window.location = "imprime_muestras.php?id="+id;	
}

</script>
<script language="javascript">
$(document).ready(function() {
event.preventDefault();	
$("#ver").fancybox({
				'width'				: '50%',
				'height'			: '60%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
});

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
<div class="cen_sup_g" style="width:1200px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Reporte de recaudación de impuestos</div><div align="right"></div> </div>
<div class="der_sup_g" style=" margin-left:1201px;"></div>
<div class="lineaAzul" style="width:1208px;"></div>
<div class="izq_lat_g" style="height:8000px;"></div>
<div    class="contenido_gm">


<div id="mainAzulFondo" align="center" style="   height:auto; width:1080px;">
<div id="mainBlancoFondo" >

<div align="center" id="Exportar_a_Excel">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Reporte de recaudacion de impuestos <?=$fecha_ini;?> y <?=$fecha_fin;?></div>
    <div align="center" id="mainBlancoMolienda">
    
	<table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td width="104"><div align="center" class="Arial14Azul">Empresa</div></td>
    <td width="82"><div align="center" class="Arial14Azul">Recibo</div></td>
    <td width="142"><div align="center" class="Arial14Azul">Número deposito</div></td>    
    <td width="130"><div align="center" class="Arial14Azul">Monto</div></td>        
    <td width="125"><div align="center" class="Arial14Azul">Mora</div></td>
    <td width="125"><div align="center" class="Arial14Azul">Semestre</div></td>
    <td width="125"><div align="center" class="Arial14Azul">Tipo pago</div></td>
    <td width="150"><div align="center" class="Arial14Azul">Imagen</div></td>
    
         
    </tr>	
<?


$result=mysql_query("select * from tbl_impuestos where fecha_pago>='".$fecha_ini."' and fecha_pago<='".$fecha_fin."' order by id");
if (!$result) {//si da error que me despliegue el error del queryt
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	while ($row=mysql_fetch_assoc($result)){
		
		
	
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row['empresa']);?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['n_recibo'];?></div></td>
    <td><div align="centar" class="Arial14Negro"><?=$row['n_deposito'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$row['monto'];?></div></td>
    <td ><div align="center" class="Arial14Negro"><?=$row['mora'];?></div></td>
    <td ><div align="center" class="Arial14Negro"><?=$row['semestre'];?></div></td>
    <td ><div align="center" class="Arial14Negro"><?=$row['tipo_pago'];?></div></td>
    <td><div align="center" class="Arial14Negro"><a target="_blank"  href="ver_scaneada.php?img=<?=$row['img'];?>"><?=$row['img'];?></a></div></td>    
    
    </tr>	
    
<?	
	}

?>
	</table>
    
    </div>

</div><!--div de centrado-->    
    
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>  

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:8000px; margin-left:1200px; "></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g" style="width:1200px;"></div>
<div class="der_inf_g" style="margin-left:1200px;"></div>

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
