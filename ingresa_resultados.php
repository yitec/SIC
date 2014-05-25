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
	if ($('#laboratorio').val()==2){
			if($('#txt_resultado').val()==""||$('#txt_unidades').val()==""){
			
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Debe ingresar Resultado-Unidades. El resultado no puede ser 0',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			return;
		}
		
	}else{
		if($('#txt_resultado').val()==""||$('#txt_resultado').val()==0||$('#txt_unidades').val()==""||$('#txt_incertidumbre').val()==""){
			
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Debe ingresar Resultado-Incertidumbre-Unidades. El resultado no puede ser 0 ',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			return;
		}
	}//end if laboratorio
		
		 if(confirm('¿Seguro que desea procesar este análisis?')){

		  var current_id = $(this).attr("id");
		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=3&id="+$('#id').val()+"&metodo="+$('#cmb_metodo').val()+"&resultado="+$('#txt_resultado').val()+"&fresca="+$('#txt_fresca').val()+"&seca="+$('#txt_seca').val()+"&incertidumbre="+$('#txt_incertidumbre').val()+"&unidades="+$('#txt_unidades').val()+"&observaciones_analista="+$('#txt_observaciones_analista').val()+"&laboratorio="+$('#laboratorio').val()+"&rechazado="+$('#rechazado').val(),
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
<div id="mainBlancoFondo" ><input id="id" type="hidden" value="<?=$_REQUEST['id'];?>" /><input id="rechazado" type="hidden" value="<?=$_REQUEST['rechazado'];?>" />
<input id="laboratorio" type="hidden" value="<?=$_REQUEST['laboratorio'];?>" />


<div align="center" style="margin-top:18px;" class=" Arial18Morado">C&oacute;digo = <?=$_REQUEST['codigo'];?>&nbsp;&nbsp;&nbsp;An&aacute;lisis = <span class=" Arial18Morado" style="margin-top:18px;">
  <?
$var=utf8_decode($_REQUEST['nombre']);
$var=utf8_encode($var);
echo $var;?>
</span></div><div style=" margin-top:5px;" align="center" >
				<a target="_blank"  href="info_muestra.php?id=<?=$_REQUEST['id'];?>"><img title="Informaci&oacute;n de la muestra" src="img/search_rojo.png"/></a>
                <a target="_blank"  href="info_forrajes.php?id=<?=$_REQUEST['id'];?>"><img title="Informaci&oacute;n Forrajes" src="img/search_verde.png"/></a>
                <a target="_blank"  href="info_resultados.php?contrato=<?=$_REQUEST['contrato'];?>"><img title="Informaci&oacute;n Otros Resultados" src="img/search_azul.png"/></a>             
                </div>
                
<?

$nombre=utf8_encode($_REQUEST['nombre']);
if ($nombre==utf8_encode("Humedad 135° C")||$nombre==utf8_encode("Extracto etéreo")||$nombre==utf8_encode("Proteína Cruda")){


$result2=mysql_query("select id from tbl_analisis  where codigo='".$_REQUEST['codigo']."' and (id_analisis=23 or id_analisis=111 or id_analisis=198 or id_analisis=285 or id_analisis=372 or id_analisis=459 or id_analisis=546 or id_analisis=1329 or id_analisis=1416) ");

	if (mysql_num_rows($result2)>0){
			echo '<div align="center" class="Arial20rojo"><img src="img/exclamation.png" /><br>Análisis relacionado a Pepsina, guardar muestra desengrasada</div>	';
	}
mysql_free_result($result2);
}

?>                
                <br />
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

            </select>
         	<?	if ($_REQUEST['rechazado']==1){
         		//si el analisis es un rechazo traigo los resultados anteriores y los imprimo.
				$result4=mysql_query("select * from tbl_resultados where id_analisis='".$_REQUEST['id']."'");
				$row4=mysql_fetch_object($result4);
				}
			?>
			</td>
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Resultado:</div></td>
            <td><textarea class="textArea" id="txt_resultado" cols="45" rows="2"><? if ($_REQUEST['rechazado']==1){echo utf8_encode($row4->resultado);}?></textarea>
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
            <td><input name="txt_incertidumbre" class="inputbox" id="txt_incertidumbre" value="<? if ($_REQUEST['rechazado']==1){echo utf8_encode($row4->incertidumbre);}else{echo "±";}?>"/></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Unidades:</div></td>
            <td><input id="txt_unidades" class="inputbox" type="text" value="<? if ($_REQUEST['rechazado']==1){echo utf8_encode($row4->unidades);}?>" /></td>        
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
