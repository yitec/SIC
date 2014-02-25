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
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style="width:1200px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Status An&aacute;lisis</div><div align="right" ></div> </div>
<div class="der_sup_g" style=" margin-left:1201px;" ></div>
<div class="lineaAzul" style="width:1208px;"></div>
<div class="izq_lat_g" style="height:5000px; "></div>
<div    class="contenido_gm" >



<div id="mainAzulFondo" align="center" style=" width: 1080px; height:auto; " >
<div id="mainBlancoFondo" align="center" style="padding: 20 20 20 20;">
<br />
<?
	$result=mysql_query("select c.nombre,ct.fecha_ingreso from tbl_clientes c inner JOIN tbl_contratos ct on ct.consecutivo='".$_REQUEST['id']."' and ct.id_cliente=c.id ");
	$row=mysql_fetch_object($result)
?>
	<div align="left" class="Arial14Negro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cliente: <?=$row->nombre?></div>
	<br>
	<div align="left" class="Arial14Negro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fecha Ingreso: <?=$row->fecha_ingreso?></div>
	<br>
	<table width="1008"  height="22" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td width="94"><div align="center" class="Arial14Azul" style="margin-top:5px;">Contrato</div></td>
    <td width="119"><div align="center" class="Arial14Azul">Muestra</div></td>    
    <td width="118"><div align="center" class="Arial14Azul">An&aacute;lisis</div></td>
    <td width="118"><div align="center" class="Arial14Azul">Laboratorio</div></td>
    <td width="114"><div align="center" class="Arial14Azul">Status actual</div></td>                
    <td width="136"><div align="center" class="Arial14Azul">Fecha Molienda</div></td>    
    <td width="143"><div align="center" class="Arial14Azul">Fecha Resultados</div></td>
    <td width="132"><div align="center" class="Arial14Azul">Fecha Rechazado</div></td>        
    <td width="134"><div align="center" class="Arial14Azul">Fecha Aprobado</div></td>            
    </tr>	
<?

$result=mysql_query("select * from tbl_analisis where id_contrato='".$_REQUEST['id']."' order by id");
	while ($row=mysql_fetch_assoc($result)){
		$result2=mysql_query("select codigo from tbl_muestras where id_contrato='".$row['id_contrato']."' and numero_muestra='".$row['id_muestra']."'");
		$row2=mysql_fetch_assoc($result2);
		$result3=mysql_query("select nombre from tbl_categoriasanalisis where id='".$row['id_analisis']."'");
		$row3=mysql_fetch_assoc($result3);
		$total++;
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
    <td><div align="center" class="Arial11Negro" style="margin-top:5px;"><?=$row['id_contrato'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row2['codigo'];?></div></td>    
    <td><div align="center" class="Arial11Negro"><?=utf8_encode($row3['nombre']);?></div></td>    
    <td><div align="center" class="Arial11Negro">
    <?
    if($row['id_laboratorio']==1)
    	echo "Qu&iacute;mica";
    if($row['id_laboratorio']==2)
    	echo "Microbiolog&iacute;a";
    if($row['id_laboratorio']==3)
    	echo "Bromatolog&iacute;a";
    
    

    ?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$actual;?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_molienda'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_analisis'];?></div></td>
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_rechazado'];?></div></td>    
    <td><div align="center" class="Arial11Negro"><?=$row['fecha_gerentes'];?></div></td> 


    </tr>	

<?
	}
?>
</table>

<br />
<div align="center" class="Arial14Morado" > Total An&aacute;lisis = <?=$total;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Pendientes = <?=$molienda+$analisis;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En molienda = <?=$molienda;?> &nbsp;&nbsp;&nbsp;&nbsp; En an&aacute;lisis = <?=$analisis;?> &nbsp;&nbsp;&nbsp;&nbsp; Por aprobar = <?=$aprobacion;?>&nbsp;&nbsp;&nbsp;&nbsp; Aprobados = <?=$aprobados;?>  </div>
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
