<?
session_start();
include('../cnx/conexion.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/datetimepicker_css.js"></script>
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
<script>
$("#btn_generar").live("click", function(event){
var validado=true;
if($('#fecha_ini').val()==""){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;
	
}
if($('#fecha_fin').val()==""){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;	
}
if($('#cmb_laboratorio').val()==0){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;
	
}
if (validado==true){
	top.location.href = 'historialfechas_contratos.php?fecha_ini='+$('#fecha_ini').val()+'&fecha_fin='+$('#fecha_fin').val()+'&cmb_ini='+$('#cmb_ini').val()+'&cmb_fin='+$('#cmb_fin').val();
}
});
</script>
</head>
<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reporte Historial de contratos</div><div align="right"></div> </div>
<div class="der_sup_g" style=" position:relative; margin-left:1101px;" ></div>
<div class="lineaAzul" style="width:1109px;"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">


<div id="mainAzulFondo" style=" width:1000px;padding:5px;" >
<div id="mainBlancoFondo" style="width:985px;" >
<div align="center">
<br />
 

<table>
    
    <tr>
    <td class="Arial14Negro">Fecha Inicio:</td>
    <td><input type="Text" name="fecha_ini" class="inputbox" id="fecha_ini" maxlength="20" size="20"/>     <img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('fecha_ini')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Fecha Fin:</td>
    <td><input type="Text" class="inputbox" id="fecha_fin" name="fecha_fin" maxlength="20" size="20"/>     <img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('fecha_fin')" style="cursor:pointer"/></td>
    </tr>
    </table>
    <br />
    <table>
    <tr>
    <td><input id="btn_generar" type="image" src="../img/btn_generar.png" /></td>
    </tr>
    </table>
</div><!--div de centrado-->    
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
