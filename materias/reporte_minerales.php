<?
session_start();
include('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
$ano=$_REQUEST['year_ini'];
$mes=$_REQUEST['mes_ini'];
$dia="01";

$fecha_ini=$ano."-".$mes."-".$dia." 00:00:00";

$ano=$_REQUEST['year_fin'];
$mes=$_REQUEST['mes_fin'];
$dia="31";

$fecha_fin=$ano."-".$mes."-".$dia." 23:59:59";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/materias.css" rel="stylesheet" type="text/css" />
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

body{
	padding: 0; margin: 0;
	width: 100%;
	
}

</style>
</head>
<body style="margin-left:50px;">
<div class="header" style=" width:3180px;">Base Datos Minerales</div>
<div class="linea_azul" style=" width:3180px;"></div>
<div  id="Exportar_a_Excel">
<table   style=" width:3200px;" border="1"  cellpadding="0" cellspacing="0" id="Exportar_a_Excel">
<thead>
  <tr>
    <th>
      <div style="width: 100px;">Registro</div>
    </th> 
    <th>
    	<div style="width: 100px;">Cifra 1</div>
  	</th> 
    <!--<th>
    	<div style="width: 100px;">Clase Alimento</div>
  	</th>-->
    <th>
    	<div style="width: 100px;">Cifra 2</div>
  	</th>
    <th>
      <div style="width: 100px;">Cifra 3</div>
    </th> 
    <th>
    	<div style="width: 100px;">Cifra 4</div>
  	</th> 
    <th>
      <div style="width: 100px;">Cifra 5</div>
    </th> 
    <th>
    	<div style="width: 60px;">Cifra 6</div>
  	</th> 
    <th>
    	<div style="width: 100px;">Cifra7</div>
  	</th> 
    <th>
      <div style="width: 100px;">Cifra 8</div>
    </th>     
    <th>
      <div style="width: 100px;">Cifra 9</div>
    </th>     
	<th>
    	<div style="width: 60px;">Cifra 10</div>
  	</th>
  <th>
      <div style="width: 60px;">Cifra 11</div>
    </th>    
    <th>
    	<div style="width: 160px;">Nombre</div>
  	</th>           
	<th>
    	<div style="width: 60px;">Fecha</div>
  	</th>       
	<th>
    	<div style="width: 60px;">Calcio</div>
  	</th>   
    <th>
      <div style="width: 60px;">Fosoforo</div>
    </th>    
	<th>
    	<div style="width: 60px;">Fosforo_d</div>
  	</th>              
    <th>
      <div style="width: 60px;">Fosforo_t</div>
    </th>
    <th>
      <div style="width: 60px;">Magnesio</div>
    </th>
    <th>
      <div style="width: 60px;">Potasio</div>
    </th>
    <th>
      <div style="width: 60px;">Sal</div>
    </th>
    <th>
      <div style="width: 60px;">Hierro</div>
    </th>
    <th>
      <div style="width: 60px;">Cobre</div>
    </th>
    <th>
      <div style="width: 60px;">Manganeso</div>
    </th>
    <th>
      <div style="width: 60px;">Zinc</div>
    </th>
    <th>
      <div style="width: 60px;">Cobalto</div>
    </th>
    <th>
      <div style="width: 60px;">Molibdeno</div>
    </th>
    <th>
      <div style="width: 60px;">Ph</div>
    </th>
    <th>
      <div style="width: 60px;">Carbonatos</div>
    </th>
    <th>
      <div style="width: 60px;">Sodio</div>
    </th>
    <th>
      <div style="width: 60px;">Materia_Seca</div>
    </th>
 </tr>
</thead>
<thead >  
  <tr >
    <th >
      <div style="width: 60px;"  ><strong></strong></div>      
    </th> 
    <th >
      <div style="width: 60px;"  ><strong>(1)</strong></div>      
    </th> 
    <th>
      <div  style="width: 60px;" ><strong>(2)</strong></div>
    </th>
    <th>
      <div  style="width: 60px;" ><strong>(3)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(4)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(5)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(6)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(7)</strong></div>
    </th>
    <th>
      <div  style="width: 60px;" ><strong>(8)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;" ><strong>(9)</strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong>(10)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(11)</strong></div>
    </th>     
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th> 
  <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>   
  <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>   
  <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>   
  <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>    
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong></strong></div>
    </th>       
  </tr>           
</thead>
<tbody>
<?

if ($_REQUEST['mineral']==0){
  $sql="select * from bd_materiasprimas.tbl_minerales where  cifra10='".$_REQUEST['year']."' order by fecha_creacion ASC";  
}else{
  $sql="select * from bd_materiasprimas.tbl_minerales where  cifra10='".$_REQUEST['year']."' and cifra5='".$_REQUEST['mineral']."' order by fecha_creacion ASC";  
}	
  $result=mysql_query($sql)or throw_ex(mysql_error());
 
$cont=0;
while($row=mysql_fetch_assoc($result)){
	$cont++;

  $ano=substr($row['fecha_creacion'], 0, 4);
  $mes=substr($row['fecha_creacion'], 5, 2);
  $dia=substr($row['fecha_creacion'], 8, 2);
  $fecha=$dia."-".$mes."-".$ano;
?>
  <tr>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['registro']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra1']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra2']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra3']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra4']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra5']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra6']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra7']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra8']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra9']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra10']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['cifra11']);?></td>
  <td style="width: 60px;" class="datos"><div align="left"><?=utf8_encode($row['nombre']);?></div></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($fecha);?></td>
  <td style="width: 60px;"title="Calcio" class="datos"><?=utf8_encode($row['calcio']);?></td>
  <td style="width: 60px;"title="Fosforo" class="datos"><?=utf8_encode($row['fosforo']);?></td>  
  <td style="width: 60px;"title="Fosoforo D" class="datos"><?=utf8_encode($row['fosforo_d']);?></td>
  <td style="width: 60px;"title="Fosforo T" class="datos"><?=utf8_encode($row['fosforo_t']);?></td>
  <td style="width: 60px;"title="Magnesio" class="datos"><?=utf8_encode($row['magnesio']);?></td>
  <td style="width: 60px;"title="Potasio" class="datos"><?=utf8_encode($row['potasio']);?></td>    
  <td style="width: 60px;"title="Sal" class="datos"><?=utf8_encode($row['sal']);?></td>      
  <td style="width: 60px;"title="Hierro"class="datos"><?=utf8_encode($row['hierro']);?></td>  
  <td style="width: 60px;"title="Cobre"class="datos"><?=utf8_encode($row['cobre']);?></td>
  <td style="width: 60px;"title="Manganeso"class="datos"><?=utf8_encode($row['manganeso']);?></td>
  <td style="width: 60px;"title="Zinc"class="datos"><?=utf8_encode($row['zinc']);?></td>
  <td style="width: 60px;"title="Cobalto"class="datos"><?=utf8_encode($row['cobalto']);?></td>
  <td style="width: 60px;"title="Molibdeno"class="datos"><?=utf8_encode($row['molibdeno']);?></td>
  <td style="width: 60px;"title="Ph"class="datos"><?=utf8_encode($row['ph']);?></td>
  <td style="width: 60px;"title="Carbonatos"class="datos"><?=utf8_encode($row['carbonatos']);?></td>
  <td style="width: 60px;"title="Sodio"class="datos"><?=utf8_encode($row['sodio']);?></td>
  <td style="width: 60px;"title="Materia Seca"class="datos"><?=utf8_encode($row['mat_seca']);?></td>
  </tr>
<?
}
?>
</tbody>  
  
</table>
<br />
<div align="center" class="Arial14Morado">Total de registros: <?=$cont?></div>
<br />      
</div><!--div de centrado-->        
<form action="../reportes/reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>    
<?
//**********************************************funcion que recibe los errores**********************************************

function throw_ex($er){  
  throw new Exception($er);  
}  		
?>
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
