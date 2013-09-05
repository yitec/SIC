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
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
$(document).ready(function() {
				$("#ver").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
						   
});						   
</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">An&aacute;lisis</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1250px;"></div>
<div    class="contenido_gm">




<div id="mainGris" style="height:1200px;">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Muestras contrato </div>
    <div align="center" id="mainBlancoMolienda">
    <form action="imprime_muestras.php" method="get">
	<table width="747" height="68" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td height="39"><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Muestra</div></td>    
    <td><div align="center" class="Arial14Azul">Laboratorio</div></td>
    <td><div align="center" class="Arial14Azul">C&oacute;digo</div></td>        
    <td><div align="center" class="Arial14Azul">Nombre</div></td>       
    <td><div align="center" class="Arial14Azul">Precio</div></td>     
          
    </tr>	
<?

$result=mysql_query("select a.id,a.codigo,a.id_muestra,a.precio,l.nombre as laboratorio,ca.nombre from tbl_analisis a,tbl_categoriasanalisis ca,tbl_laboratorios l where a.id_contrato='".$_REQUEST['contrato']."' and a.id_analisis=ca.id and a.id_laboratorio=l.id  order by a.id_muestra,a.id_laboratorio");
	while ($row=mysql_fetch_assoc($result)){
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$_REQUEST['contrato'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['id_muestra'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row['laboratorio']);?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['codigo'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=utf8_encode($row['nombre']);?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['precio'];?></div></td>
    
    </tr>	
    
<?	
	}

?>
	</table>
    </form>
    </div>



</div><!--fin cuadro gris--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1250px;"></div>
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
