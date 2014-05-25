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
<style>
a:visited
{
	font-family: Verdana, Geneva, sans-serif;
	font-size:14px;
	text-decoration:none;
	color:#0099FF;
	
	
}

a:active
{
	font-family: Verdana, Geneva, sans-serif;
	font-size:14px;
	text-decoration:none;
	color:#0099FF;
	
	
}

a:link
{
	font-family: Verdana, Geneva, sans-serif;
	font-size:14px;
	text-decoration:none;
	color:#0099FF;
	
	
}


a:hover
{
	font-family: Verdana, Geneva, sans-serif;
	font-size:14px;
	text-decoration:none;
	color:#0099FF;
	
	
}

</style>
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
		  		top.location.href = 'analisis_quimica.php';
		 }else{
			return;
		 }

	});
						   
});						   
</script>


</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">An&aacute;lisis Qu&iacute;mica</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">


<div style="margin-left:650px;  margin-top:5px; " ><a href="menu">Men&uacute;</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>

<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo"  >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">An&aacute;lisis Qu&iacute;mica</div>
    <div align="center" id="mainBlancoMolienda">
    <table cellpadding="0" cellspacing="0" border="0">
        
        <tr>
          <td><img src="img/azul_izquierda.png" /></td>
          <td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Pendientes<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div>
                                              
          </td>
          <td><img src="img/azul_derecha.png" /></td>
        </tr>
      </table>
      <table width="747"  border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
        <tr>
          <td width="78" height="18"><div align="center" class="azulColumn">C&oacute;digo</div></td>
          <td width="133" height="18"><div align="center" class="azulColumn">Fecha Ingreso</div></td>
          <td width="167" height="18"><div align="center" class="azulColumn">An&aacute;lisis</div></td>
          <td width="194" height="18"><div align="center" class="azulColumn">Observaciones</div></td>
          <td width="78" height="18"><div align="center" class="azulColumn">Trabajando</div></td>
          <td width="83" height="18"><div align="center" class="azulColumn"> Resultados</div></td>
        </tr>
        <?	

		
		$j=0;
		
		$result2=mysql_query("select ids_analisis from tbl_usuarios where id='".$_SESSION['usuario']."' ");
		$row2=mysql_fetch_assoc($result2);
		$v_ids = explode(",", $row2['ids_analisis']);
	
		foreach($v_ids as $i){
			$result3=mysql_query("select nombre from tbl_nombresanalisis where id='".$i."' ");
			$row3=mysql_fetch_assoc($result3);
			$v_nombres[$j]=trim(utf8_encode($row3['nombre']));
			$j++;
		}				
		
$result=mysql_query("  select a.id_contrato,a.codigo,a.fecha_molienda,a.id,c.nombre,a.observaciones, a.id_laboratorio,a.trabajando,a.fecha_rechazado from tbl_analisis a,tbl_categoriasanalisis c where a.id_laboratorio='1' and a.estado='1' and c.id=a.id_analisis order by a.trabajando,a.fecha_molienda");
	while ($row=mysql_fetch_assoc($result)){			
		if (in_array(trim(utf8_encode($row['nombre']))	,$v_nombres)){
			
?>
        <tr>
          <td><div align="center" class="Arial14Negro">
            <?=$row['codigo'];?>
          </div></td>
          <td><div align="center" class="Arial14Negro">
            <?=$row['fecha_molienda'];?>
          </div></td>
          <td
          <? if(isset($row['fecha_rechazado'])){			  
	          echo ' align="center" class="Arial12rojo"';
	          $rechazado=1;
		  }else{
			  echo 'align="center" class="Arial14Negro"';
			  $rechazado=0;
		  }
		  ?>
		  
		  >
            <?=utf8_encode($row['nombre']);?>
         </td>
          <td><div align="left" class="Arial10Negro">
            <?=$row['observaciones'];?>
          </div></td>
          <td><div align="center" class="Arial14Negro">
            <input id="<?=$row['id'];?>" class="trabajando" <? if($row['trabajando']==1){?> checked="checked"<? }?> type="checkbox" value="" />
          </div></td>
          <td><div align="center" class="Arial14Negro"><a id="ver" href="ingresa_resultados.php?id=<?=$row['id'];?>&codigo=<?=$row['codigo'];?>&nombre=<?=utf8_encode($row['nombre']);?>&laboratorio=<?=$row['id_laboratorio'];?>&rechazado=<?=$rechazado;?>&contrato=<?=$row['id_contrato'];?>"><img src="img/check.png" width="25" height="25" /></a></div></td>
        </tr>
        <?	
		}//end if
	}//end while

?>
      </table>
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
