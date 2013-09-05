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
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
var v_subcategorias=new Array();	
$(document).ready(function() {
$("#cmb_categoria").change(function(event){									
			cat=$("#cmb_categoria").val();
			$('#cmb_analisis').find('option').remove();
			$.ajax({
        	type: "POST",
			async: false,
        	url: "operaciones/opr_analisis.php",		
        	data: "opcion=12&id="+$("#cmb_categoria").val()+"&laboratorio="+$("#cmb_laboratorio").val(),
        	success: function(datos){				
				var v_resultado=datos.split("|");
				posiciones=parseInt(v_resultado.length)-1;
				$('#cmb_analisis').append('<option>Seleccione</option>');
				for (i=0;i<posiciones;i++) {
					var v_datos=v_resultado[i].split(",");
					$('#cmb_analisis').append('<option value="'+v_datos[0]+'" >'+v_datos[1]+'</option>');					
				}//end for
			}//end succces function
			});//end ajax function									  
});
$("#cmb_analisis").change(function(event){								
			$.ajax({
        	type: "POST",
			async: false,
        	url: "operaciones/opr_analisis.php",		
        	data: "opcion=13&id="+$("#cmb_categoria").val()+"&laboratorio="+$("#cmb_laboratorio").val()+"&analisis="+$("#cmb_analisis").val(),
        	success: function(datos){
				$('#txt_precio').attr('value',datos);
				
			}//end succces function
			});//end ajax function									  
});					
});//end jquery
///********************continuar***************+///////////
$("#btn_eliminar").live("click", function(event){
	if(confirm('¿Seguro que desea eliminar este análisis?')){		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",
		data: "opcion=17&id="+$("#cmb_categoria").val()+"&laboratorio="+$("#cmb_laboratorio").val()+"&analisis="+$("#cmb_analisis").val()+"&precio="+$("#txt_precio").val(),
success: function(datos){					
		}//end succces function
		});//end ajax function		
		top.location.href = 'eliminar_analisis.php';									  
 	}else{
		return;
 	}									  
});
</script>
</head>
<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style=" padding:10px;">
  <div id="mainBlacoFondo" >
    

    <div align="center" id="mainBlancoMolienda"><br />
    
    <h2 class="Arial18Morado" >Eliminar An&aacute;lisis</h2><div align="left" id="form'+tab_counter+'">
    <table border="0" ><tr>

	<td width="157" align="left" class="Arial12Azul">Laboratorio</td>
    <td width="156" align="left" class="Arial12Azul">Categor&iacute;a</td>
    <td width="205" align="left" class="Arial12Azul">An&aacute;lisis</td>    
   
    <td align="left" width="35" class="Arial12Azul">Precio</td>
    
    </tr></table>
    <table width="754">
    <tr>
		<td width="131">
    	<select class="combos"   id="cmb_laboratorio" title="q">
        <option  selected="selected" value="1">Qu&iacute;mica</option>
        <option value="2">Microbiolog&iacute;a</option>
        <option value="3">Bromatolog&iacute;a</option>
        </select>
    	</td>
    	<td width="163">
        <?
		$result=mysql_query("select * from tbl_categoriasmuestras");
		?>
    	<select class="combos"  title="q" id="cmb_categoria" onChange=""><option value="0" selected >Seleccione</option>
		<? while($row=mysql_fetch_assoc($result))
		{
			echo '<option value="'.$row['id'].'">'.utf8_encode($row['nombre']).'</option>';
		}
		?>
		</select>
		</td>
        <td width="180">
          <select id="cmb_analisis" class="combos"  name="cmb_analisis">
            <option>Seleccione</option>
            </select>
        </td>
        <td width="104">
          <input id="txt_precio" class="inputboxPequeno" style="font-size:14px; height:17px;" size="10" type="text" />
        </td>
		
        </tr>
    </table>

 </div><br>

   <div align="center"><input id="btn_eliminar" type="image" src="img/btn_eliminar.png" /></div> 
    </div>

</div>

</div><!--fin cuadro blanco--> 
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
