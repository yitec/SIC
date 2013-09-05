<?
session_start();
include('../cnx/conexion_inventario.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/jquery-1.7.1.js"></script>
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
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reporte Existencia de articulos</div><div align="right"></div> </div>
<div class="der_sup_g" style=" position:relative; margin-left:1101px;" ></div>
<div class="lineaAzul" style="width:1109px;"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">



<div id="mainAzulFondo" style=" width:1000px;padding:5px;" >
<div id="mainBlancoFondo" style="width:985px;" >
<div align="center" id="Exportar_a_Excel">
<br />
<div align="center" class=" Arial18Morado">Listado de articulos</div>
<br />
<table width="900" border="1"  cellpadding="0" cellspacing="0" >
<?
$id_cat=0;
$result=mysql_query("select * from tbl_articulos order by id_categoria,nombre");
$cont=0;
while($row=mysql_fetch_assoc($result)){
	$cont++;
if ($id_cat!=$row['id_categoria']){
	$id_cat=$row['id_categoria'];
?>	

  <tr>
    <td width="66">
    	<div style=" background:url(../img/centro_grid.png);" class=" Arial14Morado"><strong>Categoria</strong></div>
  	</td> 
    <td width="58">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Código</strong></div>
  	</td> 
    <td width="97" >
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Nombre</strong></div>
  	</td> 
    <td width="30">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Existencia</strong></div>
  	</td> 
<td width="90">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Mínima</strong></div>
  	</td>
    <td width="90" >
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Unidad</strong></div>
  	</td>
<td width="67">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Recipientes</strong></div>
  	</td>
    <td width="91">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial14Morado"><strong>Total Recipientes</strong></div>
  	</td>           
    
    
  </tr>
<?
$result2=mysql_query("select nombre  from tbl_categorias where id='".$row['id_categoria']."'");	

$row2=mysql_fetch_assoc($result2)
?>
  
  <tr>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row2['nombre']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['codigo']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['nombre']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['existencia']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['e_minima']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['unidad']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?
  if($row['botella']==1){
  	echo "Si";
  }else{
	 echo "No";
  }
 

  ?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['c_botellas']);?></td>
  
  
  
  </tr>


<?


}else{
	
	
$result2=mysql_query("select nombre  from tbl_categorias where id='".$row['id_categoria']."'");	

$row2=mysql_fetch_assoc($result2)
?>
  
  <tr>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row2['nombre']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['codigo']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['nombre']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['existencia']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['e_minima']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['unidad']);?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?
  if($row['botella']==1){
  	echo "Si";
  }else{
	 echo "No";
  }
 

  ?></td>
  <td style=" font-size:10px; font-family:Arial, Helvetica, sans-serif" class="tablas"><?=utf8_encode($row['c_botellas']);?></td>
  
  
  
  </tr>
<?
}//end if
?>

<?
}//end while
?>
</table>
  
  

    
  <br />  
    
</div><!--div de centrado-->    
    
    
    
<form action="../reportes/reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
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
