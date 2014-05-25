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
		
		
		 if(confirm('¿Seguro que desea procesar este resultado?')){		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=7&id="+$('#id').val()+"&laboratorio="+$('#laboratorio').val()+"&txt_observaciones_gerente="+$('#txt_observaciones_gerente').val()+"&txt_fresca="+$('#txt_fresca').val()+"&txt_seca="+$('#txt_seca').val()+"&txt_incertidumbre_fresca="+$('#txt_incertidumbre_fresca').val()+"&txt_incertidumbre_seca="+$('#txt_incertidumbre_seca').val(),
        success: function(datos){
			
		}//end succces function
		});//end ajax function		
		  		
				top.location.href = 'preresultados_quimica.php';
				
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
			alert("Debe indicar observaciones para rechazar un resultado")
			return;
		}		
		
		
		 if(confirm('¿Seguro que desea rechazar este resultado?')){		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=5&id="+$('#id').val()+"&laboratorio="+$('#laboratorio').val()+"&observaciones_gerente="+$('#txt_observaciones_gerente').val(),
        success: function(datos){
		
		}//end succces function
		});//end ajax function		
		  		if($('#laboratorio').val()==1){
				top.location.href = 'preresultados_quimica.php';
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
<div class="izq_lat_g" style="height:900px;"></div>
<div    class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo"  >
<div align="center" style="margin-top:18px;" class=" Arial18Morado">
  <input type="hidden" name="id" id="id" value="<?=$_REQUEST['id'];?>" />
    <input type="hidden" name="laboratorio" id="laboratorio" value="1" />
  Contrato = <?=$_REQUEST['contrato'];?>&nbsp;&nbsp;&nbsp; C&oacute;digo = <span class=" Arial18Morado" style="margin-top:18px;"><span class=" Arial18Azul" style="margin-top:18px;"><span class=" Arial18Morado" style="margin-top:18px;">
  <?=$_REQUEST['codigo'];?>
</span></span></span>&nbsp;&nbsp;&nbsp;An&aacute;lisis = <?
$var=utf8_decode($_REQUEST['nombre']);
$var=utf8_encode($var);
echo $var;
?></div>
<div style=" margin-top:5px;" align="center" >
				<a target="_blank"  href="info_muestra.php?id=<?=$_REQUEST['id_analisis'];?>"><img title="Informaci&oacute;n de la muestra" src="img/search_rojo.png"/>
                </a>
                <a target="_blank"  href="info_forrajes.php?id=<?=$_REQUEST['id_analisis'];?>"><img title="Informaci&oacute;n Forrajes" src="img/search_verde.png"/>
                </a>
                <a target="_blank"  href="info_resultados.php?contrato=<?=$_REQUEST['contrato'];?>"><img title="Informaci&oacute;n Otros Resultados" src="img/search_azul.png"/>
                </a>
                <a target="_blank"  href="info_quimica.php?contrato=<?=$_REQUEST['contrato'];?>&codigo=<?=$_REQUEST['codigo']?>"><img title="Informaci&oacute;n Especial" src="img/search_amarillo.png"/>
                </a>
                </div>
<?
$result2=mysql_query("select id_analisis from tbl_analisis  where id_contrato='".$_REQUEST['contrato']."' and id_muestra='".$_REQUEST['muestra']."' ");
while ($row2=mysql_fetch_assoc($result2)){

	if($row2['id_analisis']==1567 ||$row2['id_analisis']==1568||$row2['id_analisis']==1569||$row2['id_analisis']==1570||$row2['id_analisis']==1571||$row2['id_analisis']==1572||$row2['id_analisis']==1573||$row2['id_analisis']==1579||$row2['id_analisis']==1580||$row2['id_analisis']==1581){
		echo '<div align="center" class="Arial20rojo"><img src="img/exclamation.png" /><br>Esta Muestra lleva Extracto libre de nitr&oacute;geno</div>	';
	}
}
mysql_free_result($result2);


?>


<?
$result=mysql_query("select * from tbl_resultados where id='".$_REQUEST['id']."'");
$row=mysql_fetch_assoc($result);
?>
<div align="left"> 
<br />
	<table>
    	<tr>
        	<td><div class="Arial14Morado">M&eacute;todo:</div></td><td><div align="left" class="Arial14Morado"><?=$row['metodo'];?> </div></td>
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Resultado:</div></td>
            <td><textarea class="textArea" disabled="disabled"  id="txt_resultado" cols="45" rows="1"><?=utf8_encode($row['resultado']);?></textarea></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Incertidumbre:</div></td>
            <td><textarea class="textArea"  disabled="disabled" id="txt_incertidumbre" cols="45" rows="1"><?=utf8_encode($row['incertidumbre']);?></textarea></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Unidades:</div></td>
            <td><input id="txt_unidades"  disabled="disabled" class="inputbox" type="text" value="<?=$row['unidades'];?>" /></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Resultado en Base Seca:</div></td>
            <td><textarea class="textArea"   id="txt_seca" cols="45" rows="1"><?
			if($row['base_seca']<>"undefined"){
			echo $row['base_seca'];
			}
			?></textarea>
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
        	<td><div class="Arial14Morado">Incertidumbre en Base Seca:</div></td>
            <td>
            <?if($row['incertidumbre_seca']<>"undefined"){
                echo  '<input name="txt_incertidumbre_seca" class="inputbox" id="txt_incertidumbre_seca" value="'.utf8_encode($row['incertidumbre_seca']).'"/>';
            }else{
                echo  '<input name="txt_incertidumbre_seca"  class="inputbox" id="txt_incertidumbre_seca" value="±"/>';
            }
            ?></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Resultado en Base Fresca:</div></td>
            <td><textarea class="textArea"   id="txt_fresca" cols="45" rows="1"><?
			if($row['base_fresca']<>"undefined"){
			echo $row['base_fresca'];
			}
			?></textarea>
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
        	<td><div class="Arial14Morado">Incertidumbre en Base Fresca:</div></td>
            <td>
            <?if($row['incertidumbre_fresca']<>"undefined"){
                echo  '<input name="txt_incertidumbre_fresca" class="inputbox" id="txt_incertidumbre_fresca" value="'.utf8_encode($row['incertidumbre_fresca']).'"/>';
            }else{
                echo  '<input name="txt_incertidumbre_fresca" class="inputbox" id="txt_incertidumbre_fresca" value="±"/>';

            }
            ?></td>        
        </tr>
        <!--<tr>
        	Se quito el valor corregido de este formulario 
            <td><div class="Arial14Morado">Valor Corregido:</div></td>
            <td><textarea class="textArea" id="txt_correjido" cols="45" rows="1"></textarea></td>        
        </tr>-->        

        <tr>
        	<td><div class="Arial14Morado">Observaciones Analista:</div></td>
            <td><textarea class="textArea" id="txt_observaciones_analista" cols="45" rows="1"><?=utf8_encode($row['observaciones_analista']);?></textarea></td>        
        </tr>
        <tr>
        	<td><div class="Arial14Morado">Observaciones:</div></td>
            <td><textarea class="textArea" id="txt_observaciones_gerente" cols="45" rows="1"></textarea></td>        
        </tr> 
        
    
    </table>

</div><!--fin align left--> 
<div align="center"><input id="btn_aprobar" type="image" src="img/btn_aprobar.png" />
  <input id="btn_rechazar" type="image" src="img/btn_rechazar.png" />
</div>


</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:900px;"></div>
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
