<?
session_start();
include('../cnx/conexion.php');
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
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reportes Listado de An&aacute;lisis por cliente</div><div align="right"></div> </div>
<div class="der_sup_g" style=" position:relative; margin-left:1101px;" ></div>
<div class="lineaAzul" style="width:1109px;"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">



<div id="mainAzulFondo" style=" width:1000px;padding:5px;" >
<div id="mainBlancoFondo" style="width:985px;" >
<div align="center" id="Exportar_a_Excel">
<br />
<?
$result=mysql_query("select nombre from tbl_clientes where id='".$_REQUEST['cmb_cliente']."'");
$row=mysql_fetch_assoc($result);
?>
<div align="center" class="Arial18Morado"> Analisis para <?=utf8_encode($row['nombre']);?> entre <?=$_REQUEST['fecha_ini']?> y <?=$_REQUEST['fecha_fin']?></div>
<br />
<table width="900" border="1"  cellpadding="0" cellspacing="0">
  <tr>
    <td width="66">
    	<div style=" background:url(../img/centro_grid.png);" class=" Arial14Morado"><strong>Contrato</strong></div>
  	</td> 
    <td width="58">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>An&aacute;lisis</strong></div>
  	</td> 
    <td width="97" >
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Monto</strong></div>
  	</td> 
    <td width="36">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Tipo Pago</strong></div>
  	</td> 
<td width="98">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Fecha Ingreso</strong></div>
  	</td>
<td width="98">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Resultados</strong></div>
  	</td>
    
    
  </tr>

<?
$monto=0;
$result=mysql_query("select * from tbl_contratos where id_cliente='".$_REQUEST['cmb_cliente']."' and fecha_ingreso>='".$fecha_ini."' and fecha_ingreso<='".$fecha_fin."' ");
$cont=0;
while($row=mysql_fetch_assoc($result)){

$result2=mysql_query("select * from tbl_analisis where id_contrato='".$row['consecutivo']."' ");	
while($row2=mysql_fetch_assoc($result2)){
	$cont++;
	$monto=$monto+$row2['precio'];
	$result3=mysql_query("select * from tbl_resultados where id_analisis='".$row2['id']."' ");	
		$row3=mysql_fetch_assoc($result3);
	$result4=mysql_query("select nombre from tbl_categoriasanalisis where id='".$row2['id_analisis']."' ");	
	$row4=mysql_fetch_assoc($result4);
?>
  
  <tr>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['consecutivo']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row4['nombre']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row2['precio']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['tipo_pago']);?></td>
  <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['fecha_ingreso']);?></td>
    <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif" class="tablas"><span class="tablas" style=" font-size:14px; font-family:Arial, Helvetica, sans-serif">
      <?
    //pregunto si hay resultado en base fresca, si la hay primero va el resultado en base fresca y luego seca
	//valor corregido&incertidumbre
	if ($row3['base_fresca']<>""){	
	
		
		if ($row3['base_seca']<>""){//pregunto si tiene resultado en base seca
			
				if ($row3['valor_corregido']<>""){	//pregunto si tiene valor corregido
			
			$resultado="(".utf8_decode($row3['valor_correjido']).utf8_encode($row3['incertidumbre_fresca']).")".$row3['unidades']." [".utf8_decode($row3['base_seca']).utf8_encode($row3['incertidumbre_seca'])."]".$row3['unidades'];	
				}else{
			$resultado="(".utf8_decode($row3['base_fresca']).utf8_encode($row3['incertidumbre_fresca']).")".$row3['unidades']." [".utf8_decode($row3['base_seca']).utf8_encode($row3['incertidumbre_seca'])."]".$row3['unidades'];	
				}
		
		}else{
			
				
				
				if ($row3['valor_correjido']<>""){	//pregunto si tiene valor corregido			
			$resultado="(".utf8_decode($row3['valor_correjido']).utf8_encode($row3['incertidumbre_fresca']).")".$row3['unidades']." [".utf8_decode($row3['resultado']).utf8_encode($row3['incertidumbre'])."]".$row3['unidades'];	
			}else{
			$resultado="(".utf8_decode($row3['base_fresca']).utf8_encode($row3['incertidumbre_fresca']).")".$row3['unidades']." [".utf8_decode($row3['resultado']).utf8_encode($row3['incertidumbre'])."]".$row3['unidades'];	
			}
		
			
		
		
		}//fin base seca
		
	
	}else{
		
		// no tiene resultado en base fresca	
		if ($row3['base_seca']<>""){// pregunto si hay resultado en base seca	
		
			if ($row3['valor_correjido']<>""){	
				$resultado="(".utf8_decode($row3['valor_correjido']).utf8_encode($row3['incertidumbre_seca']).")".$row3['unidades']	;
			}else{
				$resultado="(".utf8_decode($row3['base_seca']).utf8_encode($row3['incertidumbre_seca']).")".$row3['unidades']	;
			}
		}else{
			if ($row3['valor_correjido']<>""){	
				$resultado="(".utf8_decode($row3['valor_correjido']).utf8_encode($row3['incertidumbre']).")".$row3['unidades']	;
			}else{
				$resultado="(".utf8_decode($row3['resultado']).utf8_encode($row3['incertidumbre']).")".$row3['unidades']	;
			}
		
		}//end if resultado base seca
	}//end if resultado base fresca
	echo $resultado;
	?>
    </span></td>
    
  </tr>
<?
}
}
?>
  
  
</table>
<br />
<div align="center" class="Arial14Morado">Total de An&aacute;lisis : <?=$cont?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Monto Total : 
  <?=$monto?>
</div>
    
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