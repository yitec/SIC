<?
session_start();
require_once('../cnx/conexion_compras.php');
require_once('../cnx/session_activa.php');
conectarc();
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
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Proveedores</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">


<?
require_once('../menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo" >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">
	 Calificaci&oacute;n Proveedores
	</div>
    <div align="center" id="mainBlancoMolienda">
<?

	  
    $result=mysql_query("select nombre,contacto,marcas,tel_fijo,tel_cel,nota from tbl_proveedores  order  by nombre");
	  
	echo '<div align="center" id="year_2012">    
    <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Nombre</div></td>
    <td><div align="center" class="Arial14Azul">Cont&aacute;cto</div></td>    
    <td><div align="center" class="Arial14Azul">Marcas</div></td>
    <td><div align="center" class="Arial14Azul">Tel&eacute;fono</div></td>
    <td><div align="center" class="Arial14Azul">Nota</div></td>        
    </tr>';
    while ($row=mysql_fetch_assoc($result)){
        echo '<tr>
    <td><div align="center" class="Arial14Negro">'.$row['nombre'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['contacto'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['marcas'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['tel_fijo'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['nota'].'</div></td>        
    </tr>';
    }
    echo '</table>
    </div>';  

?>
    
</div>



</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 

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

<script src="../includes/Scripts_Years.js"></script>
</html>