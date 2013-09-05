<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
$hoy=date("Y-m-d H:i:s");
$result=mysql_query("select SUM(precio) as total from tbl_analisis where id_contrato='".$_SESSION['contrato']."' ");
$row=mysql_fetch_assoc($result);
$total=$row['total'];
$_SESSION['total']=$total;


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<style type=text/css>
.boton { 
  font-family: Arial; 
  font-size: 16px;
  color:#FFF;
  text-decoration:none;
  border-bottom:none;
  border-right:none;
  border-left:none;
  border-top:none;
  
  height:45px;
  width:235px;
  
  
  background:url(img/btn_verde.png);

  font-weight: bold}
</style>
<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
$(document).ready(function() {

$('#muestras').hide();
$('#oficiales').hide();
$('#forrajes').hide();
			
			$("#ver").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

$("#ing1").live("click", function(event){
	$('#act_muestras').attr('value','1');							  
	$('#muestras').show();								  

});

$("#ing2").live("click", function(event){
	$('#act_oficiales').attr('value','1');
	$('#oficiales').show();								  

});


$("#ing3").live("click", function(event){
	$('#act_forrajes').attr('value','1');
	$('#forrajes').show();								  

});



$("#cmb_provincia").change(function(event){
	$("#cmb_cantones").find('option').remove();
	cadena="opcion=10&cmb_provincia="+$('#cmb_provincia').val();								
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: cadena,
        success: function(datos){			
		
		var v_resultado=datos.split("|");
			total=v_resultado.length-2;
			for (i=0;i<=total;i++) { 
				v_data=v_resultado[i].split(",");
				$('#cmb_cantones').append('<option value="'+v_data[0]+'" selected="selected">'+v_data[1]+'</option>');  
			}
		}//end succces function
		});//end ajax function
	
	$("#cmb_cantones option[value='0']").attr("selected","selected");
});



$("#cmb_cantones").change(function(event){
	$("#cmb_distritos").find('option').remove();
	cadena="opcion=11&cmb_cantones="+$('#cmb_cantones').val();								
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: cadena,
        success: function(datos){			
		
		var v_resultado=datos.split("|");
			total=v_resultado.length-2;
			for (i=0;i<=total;i++) { 
				v_data=v_resultado[i].split(",");
				$('#cmb_distritos').append('<option value="'+v_data[0]+'" selected="selected">'+v_data[1]+'</option>');  
			}
		}//end succces function
		});//end ajax function

});




						   
});	

function validar(){

	if ($('#txt_tipoAlimento').val()==""){
		alert("Debe seleccionar el tipo de muestra");
		return false;
	}else{ 
		if(confirm('¿Seguro(a) que desea crear el contrato?')){
			return true;
		}else{
			return false;
		}
	}
}
</script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1700px;" ></div>
<div class="contenido_gm">


<div style="margin-left:700px;  margin-top:5px; " class=" Arial14Negro"><a href="menu">Men&uacute;</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>
<div id="mainAzulFondo" align="center" style="padding: 20px; margin-left:50px;  width:700px;">
<div id="mainBlancoFondo" >
<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Revisi&oacute;n del Contrato</div>

<div align="center" style="margin-top:10px; margin-bottom:10px;" ><img src="img/uno.png" width="48" height="48" /><img src="img/2_verde.png" width="48" height="48" /><img src="img/3_verde.png" width="48" height="48" /></div>
<!--action="operaciones/opr_contratos.php"-->

	<form  method="get" name="fvalida"  action="operaciones/opr_contratos.php" onsubmit="return validar(this);">
   <!-- <form  method="get"   action="operaciones/opr_contratos.php">-->
    <input id="opcion" name="opcion" type="hidden" value="6" /><input id="usuario" name="usuario" type="hidden" value="<?=$_SESSION['nombre_usuario'];?>" /><input id="txt_muestras" name="txt_muestras" type="hidden" value="<? echo $tot=$_REQUEST['muestras']+1;?>" />
	<table>
    <tr>
    	<td height="29" class="Arial14Morado">Consecutivo:</td>
        <td><input name="txt_consecutivo" id="txt_consecutivo" value="<?=$_SESSION['contrato'];?>" disabled="disabled" class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td height="25" class="Arial14Morado">Cliente:</td>
        <td valign="top"><div style="float:left;">
          <input name="txt_nombre" id="txt_nombre" value="<?=$_SESSION['nombre_cliente'];?>"  size="50" class="inputbox" type="text" />
        </div>
          
          <div style="margin-top:2px; float:left;"></div>
          </td>
    </tr>
	<tr>
    	<td height="25" class="Arial14Morado">Nombre Solicitante:</td>
        <td><input name="txt_nombreSolicitante" value="<?=$_SESSION['nombre'];?>" id="txt_nombreSolicitante" size="50" class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td height="25" class="Arial14Morado">Tel&eacute;fono Solicitante:</td>
        <td><input name="txt_telefonoSolicitante" id="txt_telefonoSolicitante" value="<?=$_SESSION['telefono'];?>" class="inputbox" type="text" /></td>
    </tr>    
    
    
	<tr>
    	<td height="29" class="Arial14Morado">Tipo Pago:</td>
        <td class="Arial14Morado"><?=$_SESSION['tipo_pago']; ?></td>
    </tr>
	<tr>
	  <td height="31" class="Arial14Morado">Total de Muestras:</td>
	  <td class="Arial14Morado"><? echo $tot=$_REQUEST['muestras']+1;?></td>
	  </tr>
	<tr>
	  <td class="Arial14Morado">Total de An&aacute;lisis:</td>
	  <td class="Arial14Morado"><?=$_REQUEST['analisis'];?><input name="txt_totAnalisis" type="hidden" value="<?=$_REQUEST['analisis'];?>" />
	    <a id="ver" href="ver_analisis_total.php?contrato=<?=$_SESSION['contrato'];?>"><img src="img/search.png" width="25" height="25" /></a></td>
	  </tr>
	<tr>
	  <td height="35" class="Arial14Morado">Sub Total:</td>
	  <td class="Arial14Azul"><? echo "¢ ". $tot = number_format($total,2,',','.');?></td>
	  </tr>
      <? 
	  if($_SESSION['tipoCliente']=="Investigacion"){
	  ?>
      <tr>
	  <td height="35" class="Arial14Morado">Descuento 30%:</td>
	  <td class="Arial14Azul">¢ 
	  <?
      $subtotal=$total*descuento;
	  $total=$total-$subtotal;
	  $_SESSION['total']=$total;
	  echo  $tot = number_format($subtotal,2,',','.');

	  ?></td>
      </tr>
      <?  
	  }
	  ?>
      
      <tr>
	
	  <td height="43" class="Arial14Morado">Total:</td>
	  <td class="Arial20rojo">
      <? if($_SESSION['tipoCliente']=="Exonerado"){ ?>
       
	  <?
		  echo "Exonerado";
	  }else{
		  echo "¢ ". $tot = number_format($total,2,',','.');
		  
	  }
	  ?>
	  </td>
	  </tr>
      <tr>
        <td height="43" class="Arial14Morado">Factura:</td>
        <td class="Arial20rojo"><label for="txt_factura"></label>
          <input type="text" class="inputbox" name="txt_factura" id="txt_factura" /></td>
      </tr> 
                 
    </table>
    <br />
    <div align="center" class="Arial14Morado">-------------------------------------------------------------------------</div>
    <table>
    <tr><td align="center" class="Arial14Morado"><div id="ing1">Ingresar Informaci&oacute;n de muestras&nbsp;&nbsp;<img src="img/down_arrow.png" width="35" height="35" /></div><input name="act_muestras" id="act_muestras" type="hidden" value="0" /></td></tr>    
    </table>
    <br />
    <div id="muestras">
    <table>
    <tr>
    	<td class="Arial14Morado">Tipo Muestra:</td>
        <td><input name="txt_tipoAlimento" id="txt_tipoAlimento" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Nombre Producto:</td>
        <td><input name="txt_nombreProducto" id="txt_nombreProducto" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Presentaci&oacute;n Muestra:</td>
        <td><input  name="txt_condicionMuestra" id="txt_condicionMuestra" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Fecha toma Muestra:</td>
        <td><input  name="txt_fechaMuestra" id="txt_fechaMuestra" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Forma Muestreo:</td>
        <td><input  name="txt_formaMuestreo" id="txt_formaMuestreo" value=""  class="inputbox" type="text"/></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Proceso Elaboraci&oacute;n:</td>
        <td><input  name="txt_procesoElaboracion" id="txt_procesoElaboracion" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Parte de planta o animal:</td>
        <td><input  id="txt_partePm" name="txt_partePm" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Procedencia Geogr&aacute;fica:</td>
        <td><select name="cmb_provincia" id="cmb_provincia" style=" font:Arial, Helvetica, sans-serif; font-size:10px;">
        	<option value="Seleccione"></option>
        <?	$result=mysql_query("Select id,nombre from tbl_provincias");
			while($row=mysql_fetch_assoc($result)){
				echo '<option value="'.$row['id'].'">'.utf8_encode($row['nombre']).'</option>';
			}
		?> 
        </select>
        <select name="cmb_cantones" id="cmb_cantones"  style=" font:Arial, Helvetica, sans-serif; font-size:10px;"></select>
        <select name="cmb_distritos" id="cmb_distritos"  style=" font:Arial, Helvetica, sans-serif; font-size:10px;"></select>
        
        </td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Importado</td>
        <td class="Arial14Negro"><input type="radio" name="rnd_importado" value="SI"  />
	        Si
	        <input type="radio" name="rnd_importado" value="NO"  />
	        No</td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Elaborado por:</td>
        <td><input  name="txt_elaborado"  id="txt_elaborado" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Observaciones:</td>
        <td><textarea class="textArea"  name="txt_observacionesc" id="txt_observacionesc" cols="45" rows="3"></textarea></td>
    </tr>
    </table>
    </div>
    <br />
    <div align="center" class="Arial14Morado">-------------------------------------------------------------------------</div>
    <table>
    <tr><td align="center" class="Arial14Morado"><div id="ing2">Ingresar Informaci&oacute;n de muestras oficiales&nbsp;&nbsp;<img src="img/down_arrow.png" width="35" height="35" /><input name="act_oficiales" id="act_oficiales" type="hidden" value="0" /></div></td></tr>    
    </table>
    <br />
    <div id="oficiales">
    <table>
    <tr>
    	<td class="Arial14Morado">Empresa:</td>
        <td><input  id="txt_empresa" name="txt_empresa" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Inspector:</td>
        <td><input  name="txt_inspector" id="txt_inspector" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Licencia DAA:</td>
        <td><input  id="txt_lisencia" name="txt_lisencia" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Boleta de campo:</td>
        <td><input  id="txt_boleta" name="txt_boleta" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Muestreado en:</td>
        <td><input  id="txt_muestreado" name="txt_muestreado"  value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Fecha Elaboraci&oacute;n:</td>
        <td><input  id="txt_fechaE" name="txt_fechaE"  value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Fecha Vencimiento:</td>
        <td><input  id="txt_fechaV" name="txt_fechaV" value=""  class="inputbox" type="text" /></td>
    </tr>
    </table>
    
    
    </div>
     <div align="center" class="Arial14Morado">-------------------------------------------------------------------------</div>
     <br />
    
    <table>
    <tr><td align="center" class="Arial14Morado"><div id="ing3">Ingresar Informaci&oacute;n de forrajes&nbsp;&nbsp;<img src="img/down_arrow.png" width="35" height="35" /><input name="act_forrajes" id="act_forrajes" type="hidden" value="0" /></div></td></tr>    
    </table>
    <br />
     
    <div id="forrajes">
    <table>
    <tr>
    	<td class="Arial14Morado">Tipo:</td>
        <td><select name="cmb_tipo" id="cmb_tipo" class="combos">
        <option>TIERNO (ANTES DE FLORACION)</option>
        <option>MADURO (POST FLORACION)</option>
        <option>PASTO SECO (HENO EN PIE)</option>
        <option>HENOS PROCESADOS</option>
        <option>ENSILADO</option>
        <option>OTROS FORRAJES TOSCOS (RASTROJOS, CASCARAS, ETC)</option>
        <option selected="selected">SE DESCONOCE</option>
        <option>PASTO DE CORTE</option>
        <option>MEZCLAS DE FORRAJES</option>
        <option>NO APLICA</option>
        <option>LEGUMINOSAS</option>
        </select>
        </td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Origen:</td>
        <td>          
          <select name="cmb_origen" id="cmb_origen" class="combos">
          <option>PARCELA EXPERIMENTAL</option>
          <option>PRADERA EN PASTORERO ROTACIONAL</option>
          <option>PRADERA EN PASTOREO EXTENSIVO</option>
          <option>PASTO DE CORTA</option>
          <option>SE DESCONOCE</option>
          <option selected="selected">NO APLICA</option>
          <option>ESTABULACION COMPLETA</option>          
          </select></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Fertilizacion:</td>
        <td><select name="cmb_fertilizacion" id="cmb_fertilizacion" class="combos">
        <option>Si</option>
        <option>No</option>
        <option selected="selected">SE DESCONOCE</option>
        </select></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Aplicaci&oacute;n:</td>
        <td><input  id="txt_aplicacion" name="txt_aplicacion" value=""  class="inputbox" type="text" /></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Edad:</td>
        <td><input  id="txt_edad" name="txt_edad" value=""  class="inputbox" type="text" /></td>
    </tr>
<tr>
    	<td class="Arial14Morado">Madurez:</td>
        <td><select name="cmb_madurez" id="cmb_madurez" class="combos">
        <option>0-10 DIAS</option>
        <option>11-20 DIAS</option>
        <option>21-30 DIAS</option>
        <option>31-40 DIAS</option>
        <option>41-50 DIAS</option>
        <option>51-60 DIAS</option>
        <option>61-70 DIAS</option>
        <option>71-80 DIAS</option>
        <option>81-90 DIAS</option>
        <option>91-100 DIAS</option>
        <option>>100 DIAS</option>
        <option>RASTROJO</option>
        <option>HENO EN PIE</option>
        <option selected="selected">SE DESCONOCE</option>                
        
        </select></td>
    </tr>
<tr>
    	<td class="Arial14Morado">Nitrógeno:</td>
        <td><select name="cmb_nitrogeno" id="cmb_nitrogeno" class="combos">
        <option>50-100</option>
        <option>101-150</option>
        <option>151-200</option>
        <option>201-250</option>
        <option>250-300</option>
        <option>>300</option>
        <option selected="selected">NO APLICA</option>
        <option>Desconocido</option>
        </select></td>
    </tr>


    </table>
    
    
    </div>
    
    <br />
	<div align="center">
	  <input  name="btn_imprimir" class="boton"  type="submit" value="Generar" id="btn_imprimir"     />
      <!-- <input  name="btn_imprimir" type="image"  src="img/btn_generar.png"  id="btn_imprimir"     />-->

	</div>
	</form>

  


</div><!--fin cuadro gris--> 



</div><!--fin cuadro morado--> 
</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1700px;"></div>
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
