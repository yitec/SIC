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
<script>
function redirigir(id){
window.location = "despliega_muestras.php?id="+id;	
}

</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Mantenimiento Muestras</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3200px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style=" padding:10px;   height:auto; width:auto;">
<div id="mainBlancoFondo" >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Contratos en producci&oacute;n</div>
    <div align="center" id="mainBlancoMolienda">
    
	<table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td><div align="center" class="Arial14Azul">Procesar</div></td>        
    </tr>	
<?

$result=mysql_query("select * from tbl_contratos where estado='"."1"."' order by id");
	while ($row=mysql_fetch_assoc($result)){
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['consecutivo'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['numero_muestras'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$row['fecha_ingreso'];?></div></td>
    <td><div align="center" class="Arial14Negro"><input onclick="redirigir(<?=$row['id']; ?>)" value="<?=$row['id']; ?>" id="btn_ver" type="image" src="img/search.png" /></div></td>        
    </tr>	
    
<?	
	}

?>
	</table>
    
    </div>



</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:3200px;"></div>
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
