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
<div class="cen_sup_g" style="width:1200px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Reporte de materias</div><div align="right"></div> </div>
<div class="der_sup_g" style=" margin-left:1201px;"></div>
<div class="lineaAzul" style="width:1208px;"></div>
<div class="izq_lat_g" style="height:8000px;"></div>
<div    class="contenido_gm">


<div id="mainAzulFondo" align="center" style="   height:auto; width:1080px;">
<div id="mainBlancoFondo" >

<div align="center" id="Exportar_a_Excel">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Reporte de materias entre <?=$fecha_ini;?> y <?=$fecha_fin;?></div>
    <div align="center" id="mainBlancoMolienda">
    
	<table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Tipo Cliente</div></td>
    <td><div align="center" class="Arial14Azul">Lisencia DAA</div></td>
    <td><div align="center" class="Arial14Azul">Tipo Alimento</div></td>    
    <td><div align="center" class="Arial14Azul">Procedencia</div></td>        
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td><div align="center" class="Arial14Azul">Información</div></td>
    
         
    </tr>	
<?

//$result=mysql_query("select c.consecutivo,c.fecha_ingreso, cl.tipo_cliente, ifm.tipo_alimento, ifm.procedencia from tbl_contratos c, tbl_clientes cl, tbl_infmuestras ifm  where c.fecha_ingreso>='".$fecha_ini."' and c.fecha_ingreso<='".$fecha_fin."' and cl.id=c.id_cliente and ifm.cons_contrato=c.consecutivo ");
$result=mysql_query("select m.id,m.numero_muestra,c.consecutivo,c.fecha_ingreso, cl.tipo_cliente, ifm.tipo_alimento, ifm.procedencia from tbl_contratos c, tbl_clientes cl, tbl_infmuestras ifm, tbl_muestras m  where m.fecha_ingreso>='".$fecha_ini."' and m.fecha_ingreso<='".$fecha_fin."' and c.consecutivo=m.id_contrato and cl.id=c.id_cliente and ifm.cons_contrato=c.consecutivo ");
if (!$result) {//si da error que me despliegue el error del queryt
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	while ($row=mysql_fetch_assoc($result)){
		
		$v_procedencia=explode(',',$row['procedencia']);
		
	$result2=mysql_query("select * from tbl_infoficiales where cons_contrato='".$row['consecutivo']."'");	
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
		$row2=mysql_fetch_assoc($result2);
	$result3=mysql_query("select p.nombre, c.nombre, d.nombre from tbl_provincias p, tbl_cantones c, tbl_distritos d where p.id='".$v_procedencia[0]."' and c.id='".$v_procedencia	[1]."' and d.id='".$v_procedencia[2]."' ");
$row3=mysql_fetch_array($result3);
$pro=utf8_encode($row3[0])."-".utf8_encode($row3[1])."-".utf8_encode($row3[2]);

		$result4=mysql_query("Select a.unidades,a.valor_correjido,a.resultado,a.incertidumbre,a.base_seca,a.incertidumbre_seca, a.base_fresca, a.incertidumbre_fresca,c.nombre from tbl_resultados as a Inner join tbl_analisis as b on a.id_analisis=b.id and a.consecutivo_contrato='".$row['consecutivo']."' inner join tbl_categoriasanalisis as c on b.id_analisis=c.id order by a.id_laboratorio");
		
		
		






	
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['tipo_cliente'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row2['lisencia'];?></div></td>
    <td><div align="left" class="Arial14Negro"><?=utf8_encode($row['tipo_alimento']);?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$pro;?></div></td>
    <td ><div align="center" class="Arial14Negro"><?=$row['fecha_ingreso'];?></div></td>
    <td>
    
<?
	echo '<table border="1"><tr><td class="Arial14Azul">Analisis</td><td class="Arial14Azul">Resultado</td></tr>';
    while($row4=mysql_fetch_assoc($result4)){
    	//pregunto si hay resultado en base fresca, si la hay primero va el resultado en base fresca y luego seca
	//valor corregido&incertidumbre
	if ($row4['base_fresca']<>""){	
	
		
		if ($row4['base_seca']<>""){//pregunto si tiene resultado en base seca
			
				if ($row4['valor_corregido']<>""){	//pregunto si tiene valor corregido
			
			$resultado="(".utf8_decode($row4['valor_corregido']).utf8_encode($row4['incertidumbre_fresca']).")".utf8_decode($row4['unidades'])." [".utf8_decode($row4['base_seca']).$row4['incertidumbre_seca']."]".utf8_decode($row4['unidades']);	
				}else{
			$resultado="(".utf8_decode($row4['base_fresca']).utf8_encode($row4['incertidumbre_fresca']).")".utf8_decode($row4['unidades'])." [".utf8_decode($row4['base_seca']).utf8_encode($row4['incertidumbre_seca'])."]".utf8_decode($row4['unidades']);	
				}
		
		}else{
			
				
				
				if ($row4['valor_corregido']<>""){	//pregunto si tiene valor corregido			
			$resultado="(".utf8_decode($row4['valor_corregido']).$row4['incertidumbre_fresca'].")".$row4['unidades']." [".utf8_decode($row4['resultado']).$row4['incertidumbre']."]".utf8_decode($row4['unidades']);	
			}else{
			$resultado="(".utf8_decode($row4['base_fresca']).$row4['incertidumbre_fresca'].")".$row4['unidades']." [".utf8_decode($row4['resultado']).$row4['incertidumbre']."]".utf8_decode($row4['unidades']);	
			}
		
			
		
		
		}//fin base seca
		
	
	}else{
		
		// no tiene resultado en base fresca	
		if ($row4['base_seca']<>""){// pregunto si hay resultado en base seca	
		
			if ($row4['valor_corregido']<>""){	
				$resultado="(".utf8_decode($row4['valor_corregido']).$row4['incertidumbre_seca'].")".utf8_decode($row4['unidades'])	;
			}else{
				$resultado="(".utf8_decode($row4['base_seca']).$row4['incertidumbre_seca'].")".utf8_decode($row4['unidades'])	;
			}
		}else{
			if ($row4['valor_corregido']<>""){	
				$resultado="(".utf8_decode($row4['valor_corregido']).$row4['incertidumbre'].")".utf8_decode($row4['unidades'])	;
			}else{
				$resultado="(".utf8_decode($row4['resultado']).utf8_encode($row4['incertidumbre']).")".utf8_decode($row4['unidades'])	;
			}
		
		}//end if resultado base seca
	}//end if resultado base fresca
	
	echo '<tr><td align="left" class="Arial11Negro">'.utf8_encode($row4['nombre']).'</td><td align="left" class="Arial11Negro">'.$resultado.'</td></tr>';
	}//end while
	echo '</table>';
?>    
    
    </td>    
    
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
