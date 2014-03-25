<?
session_start();
include('../cnx/conexion_materias.php');
conectarm();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery-ui-1.9.2.custom" rel="stylesheet" type="text/css" />
<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/jquery-ui-1.9.2.custom.js"></script>
<script>
  $(function() {
    $( "#fecha_ini" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
     $( "#fecha_fin" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
</script>
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
if($('#cmb_cliente').val()==0){
	alert("Todos los campos son obligatorios por favor verifique");
	validado=false;
}
if (validado==true){
	var proximal,minerales,micotoxinas,energias;
	if ($("#chk_proximal").is(":checked")){
			proximal=1;	
	}
	if ($("#chk_minerales").is(":checked")){
			minerales=1;	
	}
	if ($("#chk_micotoxinas").is(":checked")){
			micotoxinas=1;	
	}
	if ($("#chk_energias").is(":checked")){
			energias=1;	
	}
	top.location.href = 'reporte_forrajes.php?year='+$('#cmb_year').val()+'&forraje='+$('#cmb_forraje').val();
}
});
</script>
</head>
<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reporte Forrajes entre fechas</div><div align="right"></div> </div>
<div class="der_sup_g" style=" position:relative; margin-left:1101px;" ></div>
<div class="lineaAzul" style="width:1109px;"></div>
<div class="izq_lat_g" style="height:1000px"></div>
<div    class="contenido_gm">
<div id="mainAzulFondo" style=" width:1000px;padding:5px;" >
<div id="mainBlancoFondo" style="width:985px;" >
<div align="center">
<br />
<div align="center" class="Arial14Morado">Seleccione el a&ntilde;o</div> 
<div align="center">-------------------------</div> 
<table>
<tr>	
	<td class="Arial14Negro">A&ntilde;o:</td>
	<td>
	<select name="cmb_year" id="cmb_year" class="combos">
		<option selected="selected" value="">&nbsp;&nbsp;&nbsp;Mes&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<option value="-1">Antes de 1985 (-1)</option>
		<option value="1">1985 (1)</option>
		<option value="2">1986 (2)</option>
		<option value="3">1987 (3)</option>
		<option value="4">1988 (4)</option>
		<option value="5">1989 (5)</option>
		<option value="6">1990 (6)</option>
		<option value="7">1991 (7)</option>
		<option value="8">1992 (8)</option>
		<option value="9">1993 (9)</option>
		<option value="10">1994 (10)</option>
		<option value="11">1995 (11)</option>
		<option value="12">1996 (12)</option>
		<option value="13">1997 (13)</option>
		<option value="14">1998 (14)</option>
		<option value="15">1999 (15)</option>
		<option value="16">2000 (16)</option>
		<option value="17">2001 (17)</option>
		<option value="18">2002 (18)</option>
		<option value="19">2003 (19)</option>
		<option value="20">2004 (20)</option>
		<option value="21">2005 (21)</option>
		<option value="22">2006 (22)</option>
		<option value="23">2007 (23)</option>
		<option value="24">2008 (24)</option>
		<option value="25">2009 (25)</option>
		<option value="26">2010 (26)</option>
		<option value="27">2011 (27)</option>
		<option value="28">2012 (28)</option>
		<option value="29">2013 (29)</option>
		<option value="30">2014 (30)</option>
		<option value="31">2015 (31)</option>
		<option value="32">2016 (32)</option>
		<option value="33">2017 (33)</option>
		<option value="34">2018 (34)</option>
		<option value="35">2019 (35)</option>
		<option value="36">2020 (36)</option>
		<option value="37">2021 (37)</option>
		<option value="38">2022 (38)</option>
		<option value="39">2023 (39)</option>
		<option value="40">2024 (40)</option>
		<option value="41">2025 (41)</option>
	</select>
	</td>
</tr>
</table>
<div align="center" class="Arial14Morado">Seleccione el tipo de forraje</div> 
<div align="center">-------------------------</div> 
<div align="center">
<select name="cmb_forraje" id="cmb_forraje" class="combos">
<option selected="selected" value="0">Todas</option>
<? $result=mysql_query("select vulgar,nombre from tbl_forrajes group by nombre order by nombre")or throw_ex(mysql_error());
while ($row=mysql_fetch_object($result)){
	echo '<option value="'.$row->vulgar.'">'.utf8_encode(strtoupper($row->nombre)).'</option>';
}
?>
</select>



</div>
    
    <input name="opcion" type="hidden" value="1" />
    
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
