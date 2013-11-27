<?
session_start();
include('../cnx/conexion.php');
conectar();
$meses = array(
'01' => 'Enero',
'02' => 'Febrero',
'03' => 'Marzo',
'04' => 'Abril',
'05' => 'Mayo',
'06' => 'Junio',
'07' => 'Julio',
'08' => 'Agosto',
'09' => 'Setiembre',
'10' => 'Octubre',
'11' => 'Noviembre',
'12' => 'Diciembre'
);

$years = array(
'1985' => '1985',
'1986' => '1986',
'1987' => '1987',
'1988' => '1988',
'1989' => '1989',
'1990' => '1990',
'1991' => '1991',
'1992' => '1992',
'1993' => '1993',
'1994' => '1994',
'1995' => '1995',
'1996' => '1996',
'1997' => '1997',
'1998' => '1998',
'1999' => '1999',
'2000' => '2000',
'2001' => '2001',
'2002' => '2002',
'2003' => '2003',
'2004' => '2004',
'2005' => '2005',
'2006' => '2006',
'2007' => '2007',
'2008' => '2008',
'2009' => '2009',
'2010' => '2010',
'2011' => '2011',
'2012' => '2012',
'2013' => '2013',
'2014' => '2014',
'2015' => '2015',
'2016' => '2016',
'2017' => '2017',
'2018' => '2018',
'2019' => '2019',
'2020' => '2020',
);
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
	top.location.href = 'reporte_minerales.php?mes_ini='+$('#mes_ini').val()+'&year_ini='+$('#year_ini').val()+'&mes_fin='+$('#mes_fin').val()+'&year_fin='+$('#year_fin').val()+'&cmb_materia='+$('#cmb_materia').val()+'&proximal='+proximal+'&minerales='+minerales+'&micotoxinas='+micotoxinas+'&energias='+energias;
}





});

</script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style=" width:1100px"><div  class="Arial14blanco"  align="left" style="float:left; margin-top:18px;">Reporte Minerales entre fechas</div><div align="right"></div> </div>
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
    <td>
		<select name="mes_ini" id="mes_ini" class="combos">
		<option value="">&nbsp;&nbsp;&nbsp;Mes&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<?
		$to = count($meses);
		$i = 0; 
		foreach($meses as $key => $mes)
		{
			$i = $i+1;
		?>
		<option value="<?php echo $key;?>" <?php echo ($_POST["mes_ini"] == $key) ? " selected" : ""; ?>><?php echo $mes; ?></option>
		<?
		}
		?>
		</select>

		<select name="year_ini" id="year_ini" class="combos">
		<option value="">&nbsp;&nbsp;&nbsp;Año&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<?
		$to = count($meses);
		$i = 0; 
		foreach($years as $key => $year)
		{
			$i = $i+1;
		?>
		<option value="<?php echo $key;?>" <?php echo ($_POST["year_ini"] == $key) ? " selected" : ""; ?>><?php echo $year; ?></option>
		<?
		}
		?>
		</select>
    </td>
    </tr>
    <tr>
    <td class="Arial14Negro">Fecha Fin:</td>
    <td>
    	<select name="mes_fin" id="mes_fin" class="combos">
		<option value="">&nbsp;&nbsp;&nbsp;Mes&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<?
		$to = count($meses);
		$i = 0; 
		foreach($meses as $key => $mes)
		{
			$i = $i+1;
		?>
		<option value="<?php echo $key;?>" <?php echo ($_POST["mes_fin"] == $key) ? " selected" : ""; ?>><?php echo $mes; ?></option>
		<?
		}
		?>
		</select>
		<select name="year_fin" id="year_fin" class="combos">
		<option value="">&nbsp;&nbsp;&nbsp;Año&nbsp;&nbsp;&nbsp;&nbsp;</option>
		<?
		$to = count($years);
		$i = 0; 
		foreach($years as $key => $year)
		{
			$i = $i+1;
		?>
		<option value="<?php echo $key;?>" <?php echo ($_POST["year_fin"] == $key) ? " selected" : ""; ?>><?php echo $year; ?></option>
		<?
		}
		?>
		</select>
    </td>
    </tr>
    <input name="opcion" type="hidden" value="1" />
    
    </table>
    
    
<table> 
<tr>
<td><div align="center" class=" Arial14Negro">--------------------------------------</div></td>
</tr>
<tr>

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
<script language="javascript">
$(document).ready(function() {

  $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
  });
});//end ready


var arrayOfRolloverClasses = new Array();
var arrayOfClickClasses = new Array();
var activeRow = false;
var activeRowClickArray = new Array();
function highlightTableRow()
{
var tableObj = this.parentNode;
if(tableObj.tagName!='TABLE')tableObj = tableObj.parentNode;
if(this!=activeRow){
this.setAttribute('origCl',this.className);
this.origCl = this.className;
}
this.className = arrayOfRolloverClasses[tableObj.id];
activeRow = this;
}
function clickOnTableRow()
{
var tableObj = this.parentNode;
if(tableObj.tagName!='TABLE')tableObj = tableObj.parentNode;
if(activeRowClickArray[tableObj.id] && this!=activeRowClickArray[tableObj.id]){
activeRowClickArray[tableObj.id].className='';
}
this.className = arrayOfClickClasses[tableObj.id];
activeRowClickArray[tableObj.id] = this;
}
function resetRowStyle()
{
var tableObj = this.parentNode;
if(tableObj.tagName!='TABLE')tableObj = tableObj.parentNode;
if(activeRowClickArray[tableObj.id] && this==activeRowClickArray[tableObj.id]){
this.className = arrayOfClickClasses[tableObj.id];
return;
}
var origCl = this.getAttribute('origCl');
if(!origCl)origCl = this.origCl;
this.className=origCl;
}
function addTableRolloverEffect(tableId,whichClass,whichClassOnClick)
{
arrayOfRolloverClasses[tableId] = whichClass;
arrayOfClickClasses[tableId] = whichClassOnClick;
var tableObj = document.getElementById(tableId);
var tBody = tableObj.getElementsByTagName('TBODY');
if(tBody){
var rows = tBody[0].getElementsByTagName('TR');
}else{
var rows = tableObj.getElementsByTagName('TR');
}
for(var no=0;no<rows.length;no++){
rows[no].onmouseover = highlightTableRow;
rows[no].onmouseout = resetRowStyle;
if(whichClassOnClick){
rows[no].onclick = clickOnTableRow;
}
}
}
addTableRolloverEffect('Exportar_a_Excel','tableRollOverEffect','tableRowClickEffect');
</script>

</html>
