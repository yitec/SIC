<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>SIC-CINA</title>

<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script>
$(document).ready(function() {

	$("#btn_guardar").live("click", function(event){
		 if(confirm('¿Seguro que desea modificar la muestra?')){


		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_muestras.php",		
        data: "opcion=1&contrato="+$('#contrato').val()+"&tipo_alimento="+$('#txt_tipoAlimento').val()+"&nombre_producto="+$('#txt_nombreProducto').val()+"&condicion_muestra="+$('#txt_presentacionMuestra').val()+"&fecha_muestra="+$('#txt_ftomaMuestra').val()+"&forma_muestreo="+$('#txt_formaMuestreo').val()+"&proceso_elaboracion="+$('#txt_procesoElaboracion').val()+"&parte_planta="+$('#txt_parte').val()+"&importado="+$('#txt_importado').val()+"&elaborado="+$('#txt_elaborado').val()+"&observaciones="+$('#txt_observacionesc').val()+"&factura="+$('#txt_factura').val(),
        success: function(datos){
			$.pnotify({

    			pnotify_text: 'Cambios realizados',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}//end succces function
		});//end ajax function		
		  		
		 }else{
			return;
		 }

	});

});						   

</script>

</head>

<body>
<?

$result=mysql_query("select id_contrato from tbl_analisis where id='".$_REQUEST['id']."'");
$row=mysql_fetch_assoc($result);
$contrato=$row['id_contrato'];

mysql_free_result($result);
if ($_REQUEST['opcion']==1){
		$contrato=$_REQUEST['contrato'];
	}
?>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Informaci&oacute;n de muestra</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">
<div id="mainAzulFondo" align="center" style=" padding:20px;   height:auto; width:auto;">
<div id="mainBlancoFondo">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n general de muestra contrato <?=$contrato?> </div>
    <div align="center" ><input id="contrato" type="hidden" value="<?=$_REQUEST['contrato']?>" />
    
    
    <?
	//si es mantenimiento de contrato el contrato me lo mandan  por url
	
	$result=mysql_query("select * from tbl_infmuestras where cons_contrato='".$contrato."'");
	
	$row=mysql_fetch_assoc($result);
	
	$v_procedencia=explode(",",$row['procedencia']);
	
	if(isset($row['procedencia'])){

		$result3=mysql_query("select p.nombre, c.nombre, d.nombre from tbl_provincias p, tbl_cantones c, tbl_distritos d where p.id='".$v_procedencia[0]."' and c.id='".$v_procedencia[1]."' and d.id='".$v_procedencia[2]."' ");
$row3=mysql_fetch_array($result3);
	}
	
	?>
    <table>
    <tr>
    	<td height="47" class="Arial14Morado">Tipo Muestra:</td>
        <td ><textarea name="txt" id="txt_tipoAlimento" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['tipo_alimento']);?></textarea></td>
    </tr>
    <tr>
    	<td height="55" class="Arial14Morado">Nombre Producto:</td>
        <td class="Arial14Negro"><textarea id="txt_nombreProducto" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['nombre_producto']);?></textarea></td>
    </tr>
    <tr>
    	<td height="51" class="Arial14Morado">Presentaci&oacute;n Muestra:</td>
        <td class="Arial14Negro"><textarea id="txt_presentacionMuestra" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['condicion_muestra']);?></textarea></td>
    </tr>
    <tr>
    	<td height="44" class="Arial14Morado">Fecha toma Muestra:</td>
        <td><textarea id="txt_ftomaMuestra" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['fecha_muestra']);?></textarea></td>
    </tr>
    <tr>
    	<td height="46" class="Arial14Morado">Forma Muestreo:</td>
        <td><textarea id="txt_formaMuestreo" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['forma_muestreo']);?></textarea></td>
    </tr>
    <tr>
    	<td height="57" class="Arial14Morado">Proceso Elaboraci&oacute;n:</td>
        <td><textarea id="txt_procesoElaboracion" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['proceso_elaboracion']);?></textarea></td>
    </tr>
    <tr>
    	<td height="55" class="Arial14Morado">Parte de planta o animal:</td>
        <td><textarea id="txt_parte" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['parte_planta']);?></textarea></td>
    </tr>
    <tr>
    	<td height="61" class="Arial14Morado">Procedencia Geogr&aacute;fica:</td>
        <td><textarea disabled="disabled" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row3[0])."-".utf8_encode($row3[1])."-".utf8_encode($row3[2]);?></textarea>
        
        </td>
    </tr>
    <tr>
    	<td height="57" class="Arial14Morado">Importado</td>
        <td class="Arial14Negro"><textarea id="txt_importado" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['importado']);?></textarea></td>
    </tr>
    
<? if($_REQUEST['opcion']==1){
?>
    <tr>
    	<td height="57" class="Arial14Morado">Elaborado por:</td>
        <td class="Arial14Negro"><textarea id="txt_elaborado" name="txt" class="textArea"  cols="45" rows="2"><?=utf8_encode($row['elaborado']);?></textarea></td>
    </tr>
<?
}
?>
    
    <?
	mysql_free_result($result);
	$result=mysql_query("select observaciones from tbl_contratos where consecutivo='".$contrato."'");
	$row=mysql_fetch_assoc($result);
	?>
    <tr>
    	<td class="Arial14Morado">Observaciones:</td>
        <td><textarea  class="textArea"  name="txt_observacionesc" id="txt_observacionesc" cols="45" rows="3"><?=utf8_encode($row['observaciones'])?></textarea></td>
    </tr>
    <?
	mysql_free_result($result);
	$result=mysql_query("select factura from tbl_contratos where consecutivo='".$contrato."'");
	$row=mysql_fetch_assoc($result);
	?>
    <tr>
    	<td class="Arial14Morado">Factura:</td>
        <td><input name="txt_factura" id="txt_factura" type="text" class="inputbox" value="<?=$row['factura']?>" />
		</td>
    </tr>
    </table>
<?
if ($_REQUEST['opcion']==1){
?>
    <div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" />
	</div>    
<?
}
?>

	

    <?
    mysql_free_result($result);
	desconectar();
	
	?>
    
    
    </div>
</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 

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

</html>
