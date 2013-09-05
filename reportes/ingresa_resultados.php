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
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 


<script>
$(document).ready(function() {

$("#btn_guardar").live("click", function(event){
		if($('#txt_resultado').val()==""||$('#txt_unidades').val()==""||$('#txt_incertidumbre').val()==""){
			
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Debe ingresar Resultado-Incertidumbre-Unidades',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			return;
		}
		
		
		 if(confirm('¿Seguro que desea procesar este análisis?')){

		  var current_id = $(this).attr("id");
		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=3&id="+$('#id').val()+"&metodo="+$('#cmb_metodo').val()+"&resultado="+$('#txt_resultado').val()+"&fresca="+$('#txt_fresca').val()+"&seca="+$('#txt_seca').val()+"&incertidumbre="+$('#txt_incertidumbre').val()+"&unidades="+$('#txt_unidades').val()+"&observaciones_analista="+$('#txt_observaciones_analista').val()+"&laboratorio="+$('#laboratorio').val(),
        success: function(datos){
			
		}//end succces function
		});//end ajax function		
		  		if($('#laboratorio').val()==1){
				top.location.href = 'analisis_quimica.php';
				}
				if($('#laboratorio').val()==2){
				top.location.href = 'analisis_micro.php';
				}
				if($('#laboratorio').val()==3){
				top.location.href = 'analisis_bromatologia.php';
				}
		 }else{
			return;
		 }

});

$("#btn_cancelar").live("click", function(event){
				if($('#laboratorio').val()==1){
					top.location.href = 'analisis_quimica.php';
				}
				if($('#laboratorio').val()==2){
					top.location.href = 'analisis_micro.php';
				}
				if($('#laboratorio').val()==3){
					top.location.href = 'analisis_bromatologia.php';
				}	
});				
						   
});						   
</script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Ingresa Resultados</div></div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1000px;"></div>
<div    class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style=" padding:10px;   height:auto; width:auto;">
<div id="mainBlancoFondo" ><input id="id" type="hidden" value="<?=$_REQUEST['id'];?>" />
<input id="laboratorio" type="hidden" value="<?=$_REQUEST['laboratorio'];?>" />


<div align="center" style="margin-top:18px;" class=" Arial18Morado">C&oacute;digo = <?=$_REQUEST['codigo'];?>&nbsp;&nbsp;&nbsp;An&aacute;lisis = <span class=" Arial18Morado" style="margin-top:18px;">
  <?
$var=utf8_decode($_REQUEST['nombre']);
$var=utf8_encode($var);
echo $var;?>
</span></div><div style=" margin-top:5px;" align="center" >
				<a target="_blank"  href="info_muestra.php?id=<?=$_REQUEST['id'];?>"><img title="Informaci&oacute;n de la muestra" src="img/search_rojo.png"/>
                </a>
                <a target="_blank"  href="info_forrajes.php?id=<?=$_REQUEST['id'];?>"><img title="Informaci&oacute;n Forrajes" src="img/search_verde.png"/>
                </a>
                
                
                </div><br />
<div align="left">
	<table>
    	<tr>
        	<td width="111"><div class="Arial14Morado">M&eacute;todo:</div></td><td width="380"><select id="cmb_metodo">
            
            <? 
			$result2=mysql_query("select id_analisis from tbl_analisis where id='".$_REQUEST['id']."'");
			if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
			$row2=mysql_fetch_assoc($result2);
			$result3=mysql_query("select metodo from tbl_categoriasanalisis where id='".$row2['id_analisis']."'");
			
				$row3=mysql_fetch_assoc($result3);
						if (!$result3) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 		
					echo '<option value"'.$row3['metodo'].'">'.$row3['metodo'].'</option>';							
				
			?>

            </select></td>
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Resultado:</div></td>
            <td><textarea class="textArea" id="txt_resultado" cols="45" rows="2"></textarea>
            <table width="337">
            <tr>
            <td width="73" align="center">µ</td>
            <td width="54" align="center">°</td>
            <td width="84" align="center">±</td>
            <td width="106" align="center">%</td>
            </tr>
            </table>
            
            </td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Incertidumbre:</div></td>
            <td><textarea name="txt_incertidumbre" cols="45" rows="2" class="textArea" id="txt_incertidumbre">±</textarea></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Unidades:</div></td>
            <td><input id="txt_unidades" class="inputbox" type="text" /></td>        
        </tr>
           
        
        <tr>
        	<td><div class="Arial14Morado">Observaciones:</div></td>
            <td><textarea class="textArea" id="txt_observaciones_analista" cols="45" rows="4"></textarea></td>        
        </tr> 
        
    
    </table>
<br />

</div><!--fin align left--> 
<div align="center"><input id="btn_guardar" type="image" src="img/btn_guardar.png" /><input id="btn_cancelar" type="image" src="img/btn_cancelar.png" />
</div>
<br>

</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1000px;"></div>
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
