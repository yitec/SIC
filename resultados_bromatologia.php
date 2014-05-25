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
function redirigir(id){
window.location = "imprime_muestras.php?id="+id;	
}

</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Resultados Bromatolog&iacute;a</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1000px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo"  >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Resultados Bromatolog&iacute;a</div>
    <div align="center" id="mainBlancoMolienda">
    <table cellpadding="0" cellspacing="0" border="0">
        
        <tr>
          <td><img src="img/azul_izquierda.png" /></td>
          <td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Pendientes<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div>
                                              
          </td>
          <td><img src="img/azul_derecha.png" /></td>
        </tr>
      </table>
      <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
        <tr>
          <td><div align="center" class="azulColumn">Contrato</div></td>
          <td><div align="center" class="azulColumn">C&oacute;go An&aacute;lisis</div></td>          
          <td><div align="center" class="azulColumn">Fecha Ingreso</div></td>
          <td><div align="center" class="azulColumn">An&aacute;lisis</div></td>
          <td><div align="center" class="azulColumn">Observaciones</div></td>
          <td><div align="center" class="azulColumn">Ver Resultados</div></td>
        </tr>
        <?	

$result=mysql_query(" select a.id_contrato,a.id as id_analisis, a.codigo,a.id_contrato,r.id, r.fecha_ingreso,r.observaciones_analista, c.nombre from tbl_resultados r,tbl_categoriasanalisis c, tbl_analisis a where r.estado='"."0"."' and r.id_laboratorio='"."3"."' and r.id_analisis=a.id  and a.id_analisis=c.id");
//$result=mysql_query("select m.codigo,m.fecha_ingreso,a.id,a.nombre,a.observaciones, a.id_laboratorio from tbl_analisis a,tbl_muestras m where a.id_laboratorio=1 and a.estado=1 and a.id_muestra=m.id");
	while ($row=mysql_fetch_assoc($result)){
?>
        <tr>
          <td><div align="center" class="Arial14Negro"><?=$row['id_contrato'];?></div></td>
          <td><div align="center" class="Arial14Negro"><?=$row['codigo'];?></div></td>
          <td><div align="center" class="Arial14Negro"><?=$row['fecha_ingreso'];?></div></td>
          <td><div align="center" class="Arial14Negro"><?=utf8_encode($row['nombre']);?>	
          </div></td>
          <td><div align="left" class="Arial10Negro"><?=utf8_encode($row['observaciones_analista']);?></div></td>
          <td><div align="center" class="Arial14Negro"><a id="ver" href="aprueba_resultados.php?id=<?=$row['id'];?>&codigo=<?=$row['codigo'];?>&nombre=<?=utf8_encode($row['nombre']);?>&laboratorio=<? echo"3";?>&contrato=<?=$row['id_contrato'];?>&id_analisis=<?=$row['id_analisis'];?>&contrato=<?=$row['id_contrato'];?>"><img src="img/search.png" width="25" height="25" /></a></div></td>
        </tr>
        <?	
	}

?>
      </table>
    </div>
</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1000px;"></div>
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
