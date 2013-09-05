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
	<table width="727"  height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td width="93"><div align="center" class="Arial14Azul">Contrato</div></td>
    <td width="87"><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td width="96"><div align="center" class="Arial14Azul">Pendientes</div></td>
    <td width="92"><div align="center" class="Arial14Azul">An&aacute;lisis</div></td>                
    <td width="109"><div align="center" class="Arial14Azul">Pendientes</div></td>    
    <td width="153"><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td width="81"><div align="center" class="Arial14Azul">Ver detalle</div></td>        
    </tr>	
<?

$result=mysql_query("select * from tbl_contratos where estado='"."1"."' or estado='"."2"."' order by id");
	while ($row=mysql_fetch_assoc($result)){
		$result2=mysql_query("select COUNT(id_contrato) as total_muestras from tbl_muestras where id_contrato='".$row['consecutivo']."' ");
		$row2=mysql_fetch_assoc($result2);
		$result3=mysql_query("select COUNT(id_contrato) as total_pendientes from tbl_muestras where id_contrato='".$row['consecutivo']."' and estado='"."0"."' ");
		$row3=mysql_fetch_assoc($result3);
		$result4=mysql_query("select COUNT(id_contrato) as total_analisis from tbl_analisis where id_contrato='".$row['consecutivo']."' ");
		$row4=mysql_fetch_assoc($result4);
		$result5=mysql_query("select COUNT(id_contrato) as total_apendientes from tbl_analisis where id_contrato='".$row['consecutivo']."' and (estado='"."0"."' or estado='"."1"."' or estado='"."2"."' ) ");
		$row5=mysql_fetch_assoc($result5);

?>
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['consecutivo'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row2['total_muestras'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$row3['total_pendientes'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row4['total_analisis'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row5['total_apendientes'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['fecha_ingreso'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><a href="status_analisis?id=<?=$row['consecutivo'];?>">
      <img src="../img/search.png" width="25" height="25" /></a></div></td>        
    </tr>	

<?
	}
?>
</table>
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
