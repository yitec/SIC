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
<div class="header" style=" width:3800px;">Base Datos Energ&iacute;as</div>
<div class="linea_azul" style=" width:3800px;"></div>
<div  id="Exportar_a_Excel">
<table   style=" width:3820px;" border="1"  cellpadding="0" cellspacing="0" id="Exportar_a_Excel">
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
    	<div style="width: 60px;">Cafeina</div>
  	</th>   
    <th>
      <div style="width: 60px;">Gosipol_T</div>
    </th>    
	<th>
    	<div style="width: 60px;">Gosipol_L</div>
  	</th>              
    <th>
      <div style="width: 60px;">Taninos</div>
    </th>
    <th>
      <div style="width: 60px;">Aflatoxina</div>
    </th>
    <th>
      <div style="width: 60px;">E_Bruta</div>
    </th>
    <th>
      <div style="width: 60px;">E_Neta</div>
    </th>
    <th>
      <div style="width: 60px;">E_Metab</div>
    </th>
    <th>
      <div style="width: 60px;">ACD_Total</div>
    </th>
    <th>
      <div style="width: 60px;">DIMS</div>
    </th>
    <th>
      <div style="width: 60px;">D_Pepsina</div>
    </th>
    <th>
      <div style="width: 60px;">SOL_KOH</div>
    </th>
    <th>
      <div style="width: 60px;">ACD_Grs_Li</div>
    </th>
    <th>
      <div style="width: 60px;">Materia Seca</div>
    </th>
    <th>
      <div style="width: 60px;">Grados Brix</div>
    </th>    
    <th>
      <div style="width: 60px;">Indice ACD</div>
    </th>
    <th>
      <div style="width: 60px;">Impurezas</div>
    </th>
    <th>
      <div style="width: 60px;">Calidad</div>
    </th>
    <th>
      <div style="width: 60px;">Lisina</div>
    </th>
    <th>
      <div style="width: 60px;">Metionina</div>
    </th>
    <th>
      <div style="width: 60px;">Tronina</div>
    </th>    
    <th>
      <div style="width: 60px;">Valina</div>
    </th>    
    <th>
      <div style="width: 60px;">Tnd</div>
    </th>    
    <th>
      <div style="width: 60px;">Taurina</div>
    </th>    
    <th>
      <div style="width: 60px;">Triftofano</div>
    </th>    
    <th>
      <div style="width: 60px;">Sulf_Lisin</div>
    </th>                        
    <th>
      <div style="width: 60px;">S_En_Koh</div>
    </th>                        
    <th>
      <div style="width: 60px;">Met_Hidrox</div>
    </th>                        
    <th>
      <div style="width: 60px;">T2</div>
    </th>                                    
    <th>
      <div style="width: 60px;">M1</div>
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

	$result=mysql_query("select * from bd_materiasprimas.tbl_energias where  fecha_creacion>='".$fecha_ini."' and fecha_creacion<='".$fecha_fin."'   order by id")or throw_ex(mysql_error());
 
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
  <td style="width: 60px;"title="Cafeina" class="datos"><?=utf8_encode($row['cafeina']);?></td>
  <td style="width: 60px;"title="Gosipol_T" class="datos"><?=utf8_encode($row['gosipol_t']);?></td>  
  <td style="width: 60px;"title="Gosipol_L" class="datos"><?=utf8_encode($row['gosipol_l']);?></td>
  <td style="width: 60px;"title="Taninos" class="datos"><?=utf8_encode($row['taninos']);?></td>
  <td style="width: 60px;"title="Aflatoxina" class="datos"><?=utf8_encode($row['aflatoxina']);?></td>
  <td style="width: 60px;"title="E_Bruta" class="datos"><?=utf8_encode($row['e_bruta']);?></td>    
  <td style="width: 60px;"title="E_Neta" class="datos"><?=utf8_encode($row['e_neta']);?></td>      
  <td style="width: 60px;"title="E_Matab"class="datos"><?=utf8_encode($row['e_metab']);?></td>  
  <td style="width: 60px;"title="ACD_Total"class="datos"><?=utf8_encode($row['acd_total']);?></td>
  <td style="width: 60px;"title="Dims"class="datos"><?=utf8_encode($row['dims']);?></td>
  <td style="width: 60px;"title="D_Pepsina"class="datos"><?=utf8_encode($row['d_pepsina']);?></td>
  <td style="width: 60px;"title="Sol_Koh"class="datos"><?=utf8_encode($row['sol_koh']);?></td>
  <td style="width: 60px;"title="Acd_grs_li"class="datos"><?=utf8_encode($row['acd_grs_li']);?></td>
  <td style="width: 60px;"title="Materia Seca"class="datos"><?=utf8_encode($row['mat_seca']);?></td>
  <td style="width: 60px;"title="Grados Brix"class="datos"><?=utf8_encode($row['grados_brix']);?></td>
  <td style="width: 60px;"title="Indice ACD"class="datos"><?=utf8_encode($row['indice_acd']);?></td>
  <td style="width: 60px;"title="Impurezas"class="datos"><?=utf8_encode($row['impurezas']);?></td>
  <td style="width: 60px;"title="Calidad"class="datos"><?=utf8_encode($row['calidad']);?></td>
  <td style="width: 60px;"title="Lisina"class="datos"><?=utf8_encode($row['lisina']);?></td>
  <td style="width: 60px;"title="Metionina"class="datos"><?=utf8_encode($row['metionina']);?></td>
  <td style="width: 60px;"title="Tronina"class="datos"><?=utf8_encode($row['tronina']);?></td>
  <td style="width: 60px;"title="Valina"class="datos"><?=utf8_encode($row['valina']);?></td>
  <td style="width: 60px;"title="Tnd"class="datos"><?=utf8_encode($row['tnd']);?></td>
  <td style="width: 60px;"title="Taurina"class="datos"><?=utf8_encode($row['taurina']);?></td>
  <td style="width: 60px;"title="Triftofano"class="datos"><?=utf8_encode($row['triftofano']);?></td>
  <td style="width: 60px;"title="Sulf_Lisin"class="datos"><?=utf8_encode($row['sulf_lisn']);?></td>
  <td style="width: 60px;"title="S_En_koh"class="datos"><?=utf8_encode($row['s_en_koh']);?></td>
  <td style="width: 60px;"title="Met_Hidrox"class="datos"><?=utf8_encode($row['met_hidrox']);?></td>
  <td style="width: 60px;"title="T2"class="datos"><?=utf8_encode($row['t2']);?></td>
  <td style="width: 60px;"title="M1"class="datos"><?=utf8_encode($row['m1']);?></td>
  

  


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
