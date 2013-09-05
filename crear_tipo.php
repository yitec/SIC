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
									 
			$('.sub_categoria').html('');
			$.ajax({
        	type: "POST",
			async: false,
        	url: "operaciones/opr_analisis.php",		
        	data: "opcion=9&id="+$("#cmb_categoria").val(),
        	success: function(datos){
				var v_resultado=datos.split("|");
				posiciones=parseInt(v_resultado.length)-1;
				for (i=0;i<posiciones;i++) { 
					v_datos=v_resultado[i].split(",");
					residuo=i%5
					if(residuo==0){
						$('.sub_categoria').append('<div class="Arial11Negro" align="left" style=" float:left; width:240px"><input id="'+v_datos[0]+'" class="sub_cat"  nombre="'+v_datos[1]+'" type="checkbox"   title="'+v_datos[1]+'" value="'+v_datos[1]+'">'+v_datos[1]+'</div>');
					}else{//else residuo
						$('.sub_categoria').append('<div class="Arial11Negro" align="left" style=" float:left; width:240px"><input id="'+v_datos[0]+'" class="sub_cat" nombre="'+v_datos[1]+'" type="checkbox" title="'+v_datos[1]+'"   value="'+v_datos[1]+'">'+v_datos[1]+'</div>');
					}
					
				}//end for
			}//end succces function
			});//end ajax function									  
});

						   
//*********************************************Cargo el vector con las subcategorias seleccionadas**************++

$(".sub_cat").live("click", function(event){
			var encontrado=false;
		var data=$(this).attr('id')+','+$(this).attr('nombre')+'|';
		 //metos los datos de los analisis en un array y luego los mando a guardar
		for (i=0;i<v_subcategorias.length;i++) { 
			if (v_subcategorias[i]==data){				
				v_subcategorias.splice(i,1);
				encontrado=true;
			}		
		} 
		if(encontrado==false){
			v_subcategorias[i]=data;
			
		}								 
								
								
});




});//end jquery







///********************continuar***************+///////////
$("#btn_agregar").live("click", function(event){
 if(confirm('¿Seguro que desea crear este tipo?')){
		
		if ($('#cmb_categoria').val()==0 || $('#txt_nombre').val()=="" ){
			alert("Debe llenar todos los datos");
			return;
		}
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",
        data: "opcion=15&categoria="+$('#cmb_categoria').val()+"&nombre="+$('#txt_nombre').val(),
        success: function(datos){			
	
			
		}//end succces function
		});//end ajax function
		
		top.location.href = 'crear_tipo.php';
									  
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
    
    <h2 class="Arial18Morado" >Crear Tipo de Muestra</h2><div align="center" id="form'+tab_counter+'"><table border="0" width="535"><tr><td width="178" align="left" class="Arial12Azul">Categor&iacute;a</td>
    <td align="left" width="347" class="Arial12Azul">Tipo muestra</td>
        
    </tr></table>
    <table width="539">
    <tr>
    	
    	<td width="193">
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
        <td width="549">
        <input id="txt_nombre" class="inputboxPequeno" style="font-size:14px; height:17px;" size="40" type="text" />
        </td>
  
        
        
    </tr>
    </table>

 </div><br>

   <div align="center"><input id="btn_agregar" type="image" src="img/btn_agregar.png" /></div> 
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
