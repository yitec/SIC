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
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Reportes</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">


<div style="margin-left:700px;  margin-top:5px; " class="Arial10gris"><a href="../menu.php">Volver</a>&nbsp;-&nbsp;<a href="../menu">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
<div id="mainAzulFondo" style=" padding:20px;" >
<div id="mainBlancoFondo" >
<div align="center">
<br />
<table width="376"  cellpadding="0" cellspacing="0">
  <tr>
  	<td width="1">
      	<img src="../img/linea_grid.png" width="1" height="20" />
     </td> 
    <td width="279">
    	<div style=" background:url(../img/centro_grid.png);" class=" Arial18Morado"><strong>&nbsp;&nbsp;Reporte&nbsp;&nbsp;&nbsp;</strong></div>
  	</td> 
    <td width="1">
    	<img src="../img/linea_grid.png" width="1" height="20" />
  	</td> 
    <td width="22">
    	<div style=" background:url(../img/centro_grid.png);" class="Arial18Morado"><strong>&nbsp;&nbsp;Acci&oacute;n&nbsp;&nbsp;</strong></div>
  	</td> 
    <td width="1">
		<img src="../img/linea_grid.png" width="1" height="20" />
  	</td> 
  </tr>
  <tr>
  	<td></td>
  </tr>
</table>
    
<table width="365"  cellpadding="0" cellspacing="0">
<?
$result=mysql_query("select * from tbl_reportes where estado='"."1"."'");
$cont=1;
while($row=mysql_fetch_assoc($result)){
	
	
	$numero=2;
	$res = ($cont % $numero);
			
	if ($res==0){
		
		echo '<tr>
       	<td height="35" class="Arial14Negro"><a href="'.$row['link'].'" target="_blank">'.utf8_encode($row['nombre']).'</a></td><td><a href="'.$row['link'].'" target="_blank"><img src="../img/chart.png" width="25" height="22" /></a></td></tr>';		
	}else{
		echo'<tr>
        <td height="35" class="Arial14Negro" style="background:url(../img/fondo1_grid.png)"><div align="left" ><a href="'.$row['link'].'" target="_blank">'.utf8_encode($row['nombre']).'</a></div></td><td style="background:url(../img/fondo1_grid.png)"><a href="'.$row['link'].'" target="_blank"><img src="../img/chart.png" width="25" height="22" /></a></td></tr>';
	}//end residuo
	
	
	$cont++;
}//end while

?>    
</table>    
  <br />  
    
</div><!--div de centrado-->    
    
    
    
    
    
	
    

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1000px"></div>
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
