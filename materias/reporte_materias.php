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
$dia="01";

$fecha_fin=$ano."-".$mes."-".$dia." 00:00:00";

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
<div class="header" style=" width:3980px;">Base Datos Materias Primas</div>
<div class="linea_azul" style=" width:3980px;"></div>
<div  id="Exportar_a_Excel">
<table   style=" width:3900px;" border="1"  cellpadding="0" cellspacing="0" id="Exportar_a_Excel">
<thead>
  <tr>
    <th>
      <div style="width: 100px;">Id</div>
    </th> 
    <th>
    	<div style="width: 100px;">Tipo_muestreo</div>
  	</th> 
    <!--<th>
    	<div style="width: 100px;">Clase Alimento</div>
  	</th>-->
    <th>
    	<div style="width: 100px;">Tipo Alimento</div>
  	</th>
    <th>
      <div style="width: 100px;">Código Alimento</div>
    </th> 
    <th>
    	<div style="width: 100px;">Clasificacion</div>
  	</th> 
    <th>
      <div style="width: 100px;">Procedencia Geografica</div>
    </th> 
    <th>
    	<div style="width: 60px;">Año</div>
  	</th> 
    <th>
    	<div style="width: 100px;">Procesamiento</div>
  	</th> 
    <th>
      <div style="width: 100px;">Nombre</div>
    </th>     
    <th>
      <div style="width: 100px;">Fecha</div>
    </th>     
	<th>
    	<div style="width: 60px;">Humedad 135</div>
  	</th>
  <th>
      <div style="width: 60px;">Materia Seca</div>
    </th>    
    <th>
    	<div style="width: 60px;">Cenizas</div>
  	</th>           
	<th>
    	<div style="width: 60px;">Fibra Cruda</div>
  	</th>       
	<th>
    	<div style="width: 60px;">Extracto Etereo</div>
  	</th>   
    <th>
      <div style="width: 60px;">ELN</div>
    </th>    
	<th>
    	<div style="width: 60px;">Proteina Cruda</div>
  	</th>              
    <th>
      <div style="width: 60px;">Silica</div>
    </th>
    <th>
      <div style="width: 60px;">Celulosa</div>
    </th>
    <th>
      <div style="width: 60px;">Lignina</div>
    </th>
    <th>
      <div style="width: 60px;">FND</div>
    </th>
    <th>
      <div style="width: 60px;">FAD</div>
    </th>
    <th>
      <div style="width: 60px;">Dims</div>
    </th>
    <th>
      <div style="width: 60px;">Calcio</div>
    </th>
    <th>
      <div style="width: 60px;">Fosforo T</div>
    </th>
    <th>
      <div style="width: 60px;">Fosforo D</div>
    </th>
    <th>
      <div style="width: 60px;">Magneso</div>
    </th>
    <th>
      <div style="width: 60px;">Potasio</div>
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
      <div style="width: 60px;">Sodio</div>
    </th>
    <th>
      <div style="width: 60px;">Ebruta</div>
    </th>
    <th>
      <div style="width: 60px;">Azufre</div>
    </th>
    <th>
      <div style="width: 60px;">Cloro</div>
    </th>
    <th>
      <div style="width: 60px;">Ph</div>
    </th>
    <th>
      <div style="width: 60px;">Hemicelulosa</div>
    </th>
    <th>
      <div style="width: 60px;">Ceinsolu</div>
    </th>
    <th>
      <div style="width: 60px;">NFND</div>
    </th>
    <th>
      <div style="width: 60px;">NFAD</div>
    </th>
    <th>
      <div style="width: 60px;">CNE</div>
    </th>
    <th>
      <div style="width: 60px;">Enl</div>
    </th>
    <th>
      <div style="width: 60px;">Fa1/div>
    </th>
    <th>
      <div style="width: 60px;">Fb1</div>
    </th>
    <th>
      <div style="width: 60px;">Fb2</div>
    </th>
    <th>
      <div style="width: 60px;">Fb3</div>
    </th>
    <th>
      <div style="width: 60px;">Fc</div>
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
    <!--<th>
      <div  style="width: 60px;" ><strong>(2)</strong></div>
    </th> -->
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
      <div  style="width: 60px;"><strong>(10)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(11)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(12)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(13)</strong></div>
    </th> 
        <th>
      <div  style="width: 60px;"><strong>(10)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(11)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(12)</strong></div>
    </th> 
  <th>
      <div  style="width: 60px;"><strong>(13)</strong></div>
    </th>
    <th>
      <div  style="width: 60px;"><strong>(14)</strong></div>
    </th> 
    <th>
      <div  style="width: 60px;"><strong>(15)</strong></div>
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

	$result=mysql_query("select * from bd_materiasprimas.tbl_muestras where  fecha_creacion>='".$fecha_ini."' and fecha_creacion<='".$fecha_fin."' and codigo >1   order by id")or throw_ex(mysql_error());
 
$cont=0;
while($row=mysql_fetch_assoc($result)){
	$cont++;

  $ano=substr($row['fecha_creacion'], 0, 4);
  $mes=substr($row['fecha_creacion'], 5, 2);
  $dia=substr($row['fecha_creacion'], 8, 2);
  $fecha=$dia."-".$mes."-".$ano;
?>
  <tr>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['id']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['tipo_muestreo']);?></td>
  <!--<td style="width: 60px;" class="datos"><?=utf8_encode($row['clase_alimento']);?></td>-->
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['tipo_alimento']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['codigo']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['clasificacion_internacional']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['zona_geografica']);?></td>  
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['year']);?></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($row['procesamiento']);?></td>
  <td style="width: 60px;" class="datos"><div align="left"><?=utf8_encode($row['nombre']);?></div></td>
  <td style="width: 60px;" class="datos"><?=utf8_encode($fecha);?></td>
  <td style="width: 60px;"title="Humedad 135" class="datos"><?=utf8_encode($row['humedad_135']);?></td>
  <td style="width: 60px;"title="Materia Seca" class="datos"><?=utf8_encode($row['materia_seca']);?></td>  
  <td style="width: 60px;"title="Cenizas" class="datos"><?=utf8_encode($row['cenizas']);?></td>
  <td style="width: 60px;"title="Fibra Cruda" class="datos"><?=utf8_encode($row['fibra_cruda']);?></td>
  <td style="width: 60px;"title="Extracto Etereo" class="datos"><?=utf8_encode($row['extracto_etereo']);?></td>
  <td style="width: 60px;"title="Eln" class="datos"><?=utf8_encode($row['eln']);?></td>    
  <td style="width: 60px;"title="Proteina Cruda" class="datos"><?=utf8_encode($row['proteina_cruda']);?></td>      
  <td style="width: 60px;"title="Silica"class="datos"><?=utf8_encode($row['silica']);?></td>  
  <td style="width: 60px;"title="Celulosa"class="datos"><?=utf8_encode($row['celulosa']);?></td>
  <td style="width: 60px;"title="Lignina"class="datos"><?=utf8_encode($row['lignina']);?></td>
  <td style="width: 60px;"title="Fnd"class="datos"><?=utf8_encode($row['fnd']);?></td>
  <td style="width: 60px;"title="Fad"class="datos"><?=utf8_encode($row['fad']);?></td>
  <td style="width: 60px;"title="Dims"class="datos"><?=utf8_encode($row['dims']);?></td>
  <td style="width: 60px;"title="Calcio"class="datos"><?=utf8_encode($row['calcio']);?></td>
  <td style="width: 60px;"title="Fosforo T"class="datos"><?=utf8_encode($row['fosforo_t']);?></td>
  <td style="width: 60px;"title="Fosforo D"class="datos"><?=utf8_encode($row['fosforo_d']);?></td>
  <td style="width: 60px;"title="Magnesio"class="datos"><?=utf8_encode($row['magnesio']);?></td>
  <td style="width: 60px;"title="Potasio"class="datos"><?=utf8_encode($row['potasio']);?></td>
  <td style="width: 60px;"title="Hierro"class="datos"><?=utf8_encode($row['hierro']);?></td>
  <td style="width: 60px;"title="Cobre"class="datos"><?=utf8_encode($row['cobre']);?></td>
  <td style="width: 60px;"title="Manganeso"class="datos"><?=utf8_encode($row['manganeso']);?></td>
  <td style="width: 60px;"title="Zinc"class="datos"><?=utf8_encode($row['zinc']);?></td>
  <td style="width: 60px;"title="Cobalto"class="datos"><?=utf8_encode($row['cobalto']);?></td>
  <td style="width: 60px;"title="Molibdeno"class="datos"><?=utf8_encode($row['molibdeno']);?></td>
  <td style="width: 60px;"title="Sodio"class="datos"><?=utf8_encode($row['sodio']);?></td>
  <td style="width: 60px;"title="E Bruta"class="datos"><?=utf8_encode($row['e_bruta']);?></td>
  <td style="width: 60px;"title="Azufre"class="datos"><?=utf8_encode($row['azufre']);?></td>
  <td style="width: 60px;"title="Cloro"class="datos"><?=utf8_encode($row['cloro']);?></td>
  <td style="width: 60px;"title="Ph"class="datos"><?=utf8_encode($row['ph']);?></td>
  <td style="width: 60px;"title="Hemicelulosa"class="datos"><?=utf8_encode($row['hemicelulosa']);?></td>
  <td style="width: 60px;"title="Ceinsolu"class="datos"><?=utf8_encode($row['ceinsolu']);?></td>
  <td style="width: 60px;"title="Nfnd"class="datos"><?=utf8_encode($row['nfnd']);?></td>
  <td style="width: 60px;"title="Nfad"class="datos"><?=utf8_encode($row['nfad']);?></td>
  <td style="width: 60px;"title="Cne"class="datos"><?=utf8_encode($row['cne']);?></td>
  <td style="width: 60px;"title="Enl"class="datos"><?=utf8_encode($row['enl']);?></td>
  <td style="width: 60px;"title="Fa1"class="datos"><?=utf8_encode($row['fa1']);?></td>
  <td style="width: 60px;"title="Fb1"class="datos"><?=utf8_encode($row['fb1']);?></td>
  <td style="width: 60px;"title="Fb2"class="datos"><?=utf8_encode($row['fb2']);?></td>
  <td style="width: 60px;"title="Fb3"class="datos"><?=utf8_encode($row['fb3']);?></td>
  <td style="width: 60px;"title="Fc"class="datos"><?=utf8_encode($row['fc']);?></td>


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
