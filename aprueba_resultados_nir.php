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
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script>
$(document).ready(function() {

$("#btn_aprobar").live("click", function(event){
		if($('#txt_resultado').val()==""||$('#txt_unidades').val()==""||$('#txt_incertidumbre').val()==""){
			alert("El resultado esta vacio")
			return;
		}
		
		
		 if(confirm('¿Seguro que desea aprobar este resultado?')){		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=4&id="+$('#id').val()+"&laboratorio="+$('#laboratorio').val()+"&contrato="+$('#contrato').val()+"&base_fresca="+$('#txt_fresca').val()+"&incertidumbre_fresca="+$('#txt_incertidumbre_fresca').val()+"&base_seca="+$('#txt_seca').val()+"&incertidumbre_seca="+$('#txt_incertidumbre_seca').val()+"&observaciones_gerente="+$('#txt_observaciones_gerente').val(),
        success: function(datos){
        	/*if (datos=="Success"){
        		
        	}
        	else{
        		alert (datos);
        	}*/
        	
		}//end succces function
		});//end ajax function		
		        if($('#laboratorio').val()==1){
                top.location.href = 'resultados_quimica.php';
                }
                if($('#laboratorio').val()==2){
                top.location.href = 'resultados_micro.php';
                }
                if($('#laboratorio').val()==3){
                top.location.href = 'resultados_bromatologia.php';
                }

		 }else{
			return;
		 }

	});




$("#btn_rechazar").live("click", function(event){
		if($('#txt_resultado').val()==""||$('#txt_unidades').val()==""||$('#txt_incertidumbre').val()==""){
			alert("El resultado esta vacio")
			return;
		}
		if($('#txt_observaciones_gerente').val()==""){
			alert("Debe indicar observaciones Gerente para rechazar un resultado")
			return;
		}		
		
		//determino si debo rechazar a zootecnista o anlaista
		if($("#rnd_rechazarz").is(':checked')) {  
			var rechazar=2;
		}else{
			var rechazar=1;
		}
            

		
		 if(confirm('¿Seguro que desea rechazar este resultado?')){		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=5&id="+$('#id').val()+"&laboratorio="+$('#laboratorio').val()+"&observaciones_gerente="+$('#txt_observaciones_gerente').val()+"&rechazar="+rechazar,
        success: function(datos){
        	if (datos=="Success"){
        	if($('#laboratorio').val()==1){
				top.location.href = 'resultados_quimica.php';
				}
				if($('#laboratorio').val()==2){
				top.location.href = 'resultados_micro.php';
				}
				if($('#laboratorio').val()==3){
				top.location.href = 'resultados_bromatologia.php';
				}
			}else{
        		alert (datos);
        	}
		
		}//end succces function
		});//end ajax function		
		  		
		 }else{
			return;
		 }

	});
	
	$("#btn_modificar").live("click", function(event){
		if($('#txt_resultado').val()==""||$('#txt_unidades').val()==""||$('#txt_incertidumbre').val()==""){
			alert("El resultado esta vacio")
			return;
		}		
		
		 if(confirm('¿Seguro que desea modificar este resultado?')){		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=6&id="+$('#id').val()+"&resultado="+$('#txt_resultado').val()+"&fresca="+$('#txt_fresca').val()+"&seca="+$('#txt_seca').val()+"&incertidumbre="+$('#txt_incertidumbre').val()+"&unidades="+$('#txt_unidades').val()+"&observaciones="+$('#txt_observaciones').val()+"&laboratorio="+$('#laboratorio').val(),
        success: function(datos){
			alert(datos);
		}//end succces function
		});//end ajax function		
		  		if($('#laboratorio').val()==1){
				top.location.href = 'resultados_quimica.php';
				}
				if($('#laboratorio').val()==2){
				top.location.href = 'resultados_micro.php';
				}
				if($('#laboratorio').val()==3){
				top.location.href = 'resultados_bromatologia.php';
				}
		 }else{
			return;
		 }

	});



});						   
</script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Resultados</div></div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1600px;"></div>
<div    class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo"  >
<div align="center" style="margin-top:18px;" class=" Arial18Morado">
  <input type="hidden" name="id" id="id" value="<?=$_REQUEST['id'];?>" />
    <input type="hidden" name="laboratorio" id="laboratorio" value="<?=$_REQUEST['laboratorio'];?>" />
    <input type="hidden" name="contrato" id="contrato" value="<?=$_REQUEST['contrato'];?>" />
  Contrato = <?=$_REQUEST['contrato'];?>&nbsp;&nbsp;&nbsp; C&oacute;digo = <span class=" Arial18Morado" style="margin-top:18px;"><span class=" Arial18Azul" style="margin-top:18px;"><span class=" Arial18Morado" style="margin-top:18px;">
  <?=$_REQUEST['codigo'];?>
</span></span></span>&nbsp;&nbsp;&nbsp;An&aacute;lisis = <?
$var=utf8_decode($_REQUEST['nombre']);
$var=utf8_encode($var);
echo $var;?></div>

<?
$result=mysql_query("select * from tbl_resultados where id='".$_REQUEST['id']."'");
$row=mysql_fetch_assoc($result);
?>
<div style=" margin-top:5px;" align="center" >
				<a target="_blank"  href="info_muestra.php?id=<?=$_REQUEST['id_analisis'];?>"><img title="Informaci&oacute;n de la muestra" src="img/search_rojo.png"/>
                </a>
                <a target="_blank"  href="info_forrajes.php?id=<?=$_REQUEST['id_analisis'];?>"><img title="Informaci&oacute;n Forrajes" src="img/search_verde.png"/>
                </a>
                <a target="_blank"  href="info_resultados.php?contrato=<?=$_REQUEST['contrato'];?>"><img title="Informaci&oacute;n Otros Resultados" src="img/search_azul.png"/>
                </a>            
                </div>

<div align="left">
<br />
<?  
    $result4=mysql_query("select * from tbl_resultados where id='".$_REQUEST['id']."'");
    $row4=mysql_fetch_assoc($result4);
    $resultado=explode('|',$row4['resultado']);
    $sep=explode('|',$row4['incertidumbre']);
?>
<table>
        <tr>
            <td width="111">
                <div class="Arial14Morado">Metodo:</div>
            </td>
            <td>
                <div align="left" class="Arial14Morado"><?=$row4['metodo'];?> </div>            
            </td>
        </tr>
        <tr>
        <td></td>
        <td><div class="Arial14Morado">Resultado:</div></td>
        <td><div class="Arial14Morado">SEP</div></td>
        <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">Cenizas:</div></td>
            <td><textarea class="textArea" id="txt_cenizas" cols="35" rows="1"><? echo utf8_encode($resultado[0]);?></textarea></td>
            <td><textarea class="textArea" id="txt_sepcenizas" cols="35" rows="1"><? echo utf8_encode($sep[0]);?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">Fibra Cruda:</div></td>
            <td><textarea class="textArea" id="txt_fibra" cols="35" rows="1"><?echo utf8_encode($resultado[1]);?></textarea></td>
            <td><textarea class="textArea" id="txt_sepfibra" cols="35" rows="1"><? echo utf8_encode($sep[1]);?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">Proteína cruda:</div></td>
            <td><textarea class="textArea" id="txt_proteina" cols="35" rows="1"><? echo utf8_encode($resultado[2]);?></textarea></td>
            <td><textarea class="textArea" id="txt_sepproteina" cols="35" rows="1"><? echo utf8_encode($sep[2]);?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">Extracto etéreo:</div></td>
            <td><textarea class="textArea" id="txt_extracto" cols="35" rows="1"><? echo utf8_encode($resultado[3]);?></textarea></td>
            <td><textarea class="textArea" id="txt_sepextracto" cols="35" rows="1"><? echo utf8_encode($sep[3]);?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>        
        <tr>
            <td><div class="Arial14Morado">Humedad:</div></td>
            <td><textarea class="textArea" id="txt_humedad" cols="35" rows="1"><? echo utf8_encode($resultado[4]);?></textarea></td>
            <td><textarea class="textArea" id="txt_sephumedad" cols="35" rows="1"><? echo utf8_encode($sep[4]);?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
         <tr>
            <td><div class="Arial14Morado">FAD:</div></td>
            <td><textarea class="textArea" id="txt_fad" cols="35" rows="1"><? echo utf8_encode($resultado[5]);?></textarea></td>
            <td><textarea class="textArea" id="txt_sepfad" cols="35" rows="1"><? echo utf8_encode($sep[5]);?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
         <tr>
            <td><div class="Arial14Morado">E. Bruta:</div></td>
            <td><textarea class="textArea" id="txt_ebruta" cols="35" rows="1"><? echo utf8_encode($resultado[6]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">EM aves:</div></td>
            <td><textarea class="textArea" id="txt_emaves" cols="35" rows="1"><? echo utf8_encode($resultado[7]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">TND vcs:</div></td>
            <td><textarea class="textArea" id="txt_tndvcs" cols="35" rows="1"><? echo utf8_encode($resultado[8]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">ED vcs:</div></td>
            <td><textarea class="textArea" id="txt_edvcs" cols="35" rows="1"><? echo utf8_encode($resultado[9]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">EM vcs:</div></td>
            <td><textarea class="textArea" id="txt_emvcs" cols="35" rows="1"><? echo utf8_encode($resultado[10]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">TND crds:</div></td>
            <td><textarea class="textArea" id="txt_tndcrds" cols="35" rows="1"><? echo utf8_encode($resultado[11]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">ED crds:</div></td>
            <td><textarea class="textArea" id="txt_edcrds" cols="35" rows="1"><? echo utf8_encode($resultado[12]);?></textarea></td>
            <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">EM crds:</div></td>
            <td><textarea class="textArea" id="txt_emcrds" cols="35" rows="1"><? echo utf8_encode($resultado[13]);?></textarea></td>
           <td><label class="Arial14Morado">Los valores de energía son estimaciones a partir del análisis proximal</label></td>
        </tr>
        <tr>
            <td></td>
            <td>µ&nbsp;°&nbsp;±&nbsp;%</td>
            <td></td>
        </tr>
        <tr>
            <td><div class="Arial14Morado">Observaciones:</div></td>
            <td><textarea class="textArea" id="txt_observaciones_analista" cols="35" rows="4"></textarea></td>        
        </tr>         
        <tr>
            <td><div class="Arial14Morado">Observaciones Analista:</div></td>
            <td><textarea class="textArea" id="txt_observaciones_analista" cols="35" rows="2"><?=utf8_encode($row['observaciones_analista']);?></textarea></td>        
        </tr> 
        <tr>
            <td><div class="Arial14Morado">Observaciones Gerente:</div></td>
            <td><textarea class="textArea" id="txt_observaciones_gerente" cols="35" rows="2"><?=$row['observaciones_gerente'];?></textarea></td>        
        </tr>                   
    </table>
<br>
</div><!--fin align left--> 
<div align="center"><input id="btn_aprobar" type="image" src="img/btn_aprobar.png" />
  <input id="btn_rechazar" type="image" src="img/btn_rechazar.png" />
</div>
</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 
</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1600px;"></div>
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
