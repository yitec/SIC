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
<link href="css/tablas.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
$(document).ready(function() {

	$(".trabajando").live("click", function(event){
		 if(confirm('¿Seguro que desea procesar este analisis?')){

		  var current_id = $(this).attr("id");
		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=2&id="+current_id,
        success: function(datos){
			
		}//end succces function
		});//end ajax function		
		  		top.location.href = 'analisis_micro.php';
		 }else{
			return;
		 }

	});

});						   

</script>

</head>

<body>
<?
$result=mysql_query("select id_contrato from tbl_analisis where id='".$_REQUEST['id']."'");
$row=mysql_fetch_assoc($result);
$contrato=$row['id_contrato'];

mysql_free_result($result);
?>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Informaci&oacute;n de resultados</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">
<div id="mainAzulFondo" align="center" style=" padding:20px;   height:auto; width:auto;">
<div id="mainBlancoFondo">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n  de resultados <?=$contrato?> </div>
    <div align="center" >
    
    <p>
      <?
	
	
	
	
	
	?>
    <table  border="1"  cellpadding="0" cellspacing="0">
  <tr>
    <td width="61" >
    	<div style=" background:url(img/centro_grid.png);" class=" Arial14Morado"><strong>Contrato</strong></div>
  	</td> 
    <td width="53" >
    	<div style=" background:url(img/centro_grid.png);" class="Arial14Morado"><strong>C&oacute;digo</strong></div>
  	</td>
    <td width="53" >
    	<div style=" background:url(img/centro_grid.png);" class="Arial14Morado"><strong>M&eacute;todo</strong></div>
  	</td>
    <td width="198" >
    	<div style=" background:url(img/centro_grid.png);" class="Arial14Morado"><strong>An&aacute;lisis</strong></div>
  	</td> 
    
   
    
<td width="260">
    	<div style=" background:url(img/centro_grid.png);" class="Arial14Morado"><strong>Resultados</strong></div>
  	</td>
    
    
  </tr>

<?

$result=mysql_query("
select 
ana.codigo, 
res.id,
res.consecutivo_contrato,
res.metodo,
res.base_fresca,
res.base_seca,
res.incertidumbre,
res.incertidumbre_fresca,
res.incertidumbre_seca,
res.valor_correjido,
res.unidades,
res.resultado,
cat.nombre
from tbl_resultados res  join tbl_analisis ana  on res.consecutivo_contrato='".$_REQUEST['contrato']."'
and ana.id=res.id_analisis
 join tbl_categoriasanalisis cat on ana.id_analisis =cat.id ");

while($row=mysql_fetch_assoc($result)){
	

?>
  
  <tr>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['consecutivo_contrato']);?></td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['codigo']);?></td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['metodo']);?></td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['nombre']);?></td>
  
  
    <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">
    <?
    //pregunto si hay resultado en base fresca, si la hay primero va el resultado en base fresca y luego seca
	//valor corregido&incertidumbre
	if ($row['base_fresca']<>""){	
	
		
		if ($row['base_seca']<>""){//pregunto si tiene resultado en base seca
			
				if ($row['valor_corregido']<>""){	//pregunto si tiene valor corregido
			
			$resultado="(".utf8_decode($row['valor_correjido']).utf8_encode($row['incertidumbre_fresca']).")".$row['unidades']." [".utf8_decode($row['base_seca']).$row['incertidumbre_seca']."]".$row['unidades'];	
				}else{
			$resultado="(".utf8_decode($row['base_fresca']).utf8_encode($row['incertidumbre_fresca']).")".$row['unidades']." [".utf8_decode($row['base_seca']).utf8_encode($row['incertidumbre_seca'])."]".$row['unidades'];	
				}
		
		}else{
			
				
				
				if ($row['valor_correjido']<>""){	//pregunto si tiene valor corregido			
			$resultado="(".utf8_decode($row['valor_correjido']).utf8_encode($row['incertidumbre_fresca']).")".$row['unidades']." [".utf8_decode($row['resultado']).utf8_encode($row['incertidumbre'])."]".$row['unidades'];	
			}else{
			$resultado="(".utf8_decode($row['base_fresca']).utf8_encode($row['incertidumbre_fresca']).")".$row['unidades'];
			//." [".utf8_decode($row['resultado']).utf8_encode($row['incertidumbre'])."]".$row['unidades'];	
			}
		
			
		
		
		}//fin base seca
		
	
	}else{
		
		// no tiene resultado en base fresca	
		if ($row['base_seca']<>""){// pregunto si hay resultado en base seca	
		
			if ($row['valor_correjido']<>""){	
				$resultado="(".utf8_decode($row['valor_correjido']).$row['incertidumbre_seca'].")".$row['unidades']	;
			}else{
				$resultado="(".utf8_decode($row['base_seca']).utf8_encode($row['incertidumbre_seca']).")".$row['unidades']	;
			}
		}else{
			if ($row['valor_correjido']<>""){	
				$resultado="(".utf8_decode($row['valor_correjido']).utf8_encode($row['incertidumbre']).")".$row['unidades']	;
			}else{
				$resultado="(".utf8_decode($row['resultado']).utf8_encode($row['incertidumbre']).")".$row['unidades']	;
			}
		
		}//end if resultado base seca
	}//end if resultado base fresca
	echo $resultado;
	?></td>
    
  </tr>
<?
}

?>
  
  
</table>
    
    <br />
    <?
    mysql_free_result($result);
	desconectar();
	
	?>
    
    
    </div>
</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 

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
