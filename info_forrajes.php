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
        data: "opcion=3&contrato="+$('#contrato').val()+"&tipo="+$('#txt_tipo').val()+"&origen="+$('#txt_origen').val()+"&fertilizacion="+$('#txt_fertilizacion').val()+"&aplicacion="+$('#txt_aplicacion').val()+"&edad="+$('#txt_edad').val(),
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
if ($_REQUEST['opcion']==1){
		$contrato=$_REQUEST['contrato'];
	}	

mysql_free_result($result);
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
<input id="contrato" type="hidden" value="<?=$_REQUEST['contrato']?>" />
	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n general de forrajes contrato <?=$contrato?> </div>
    <div align="center" >
    
    <?
	$result=mysql_query("select * from tbl_infforrajes where cons_contrato='".$contrato."'");
	
	$row=mysql_fetch_assoc($result);
	
	
	?>
    <table>
    <tr>
    	<td width="90" class="Arial14Morado">Tipo:</td>
        <td width="307"><textarea name="txt2" id="txt_tipo" cols="45" rows="2" class="textArea" ><?=utf8_encode($row['tipo'])?></textarea>
        </td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Origen:</td>
        <td><textarea name="txt2" id="txt_origen" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['origen'])?></textarea></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Fertilizacion:</td>
        <td><textarea name="txt2" id="txt_fertilizacion" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['fertilizacion'])?></textarea></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Aplicaci&oacute;n:</td>
        <td><textarea name="txt2" id="txt_aplicacion" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['aplicacion'])?></textarea></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Edad:</td>
        <td><textarea name="txt2" id="txt_edad" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['edad'])?></textarea></td>
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
