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
			var repeticiones=1;
			var v_analisis=new Array();
			var v_aAnterior=new Array();//estos 4 vectores me sirven para copiar la muestra anterior
			var v_mAnterior=new Array();			
			var v_aActual=new Array();
			var v_mActual=new Array();
			var contAnalisis=0;//contador que lleva el numero de analisis por muestra
			
$(document).ready(function() {

var monto=0;
			
						   
$(".id").live("click", function(event){	
		 if(confirm('¿Seguro que desea eliminar este análisis?')){
			 id=$(this).attr('id');			 
			 muestra=$(this).attr('muestra');
			 contrato=$(this).attr('contrato');
			 precio=$(this).attr('precio');			 
			 $.ajax({
        	type: "POST",
			async: false,
        	url: "operaciones/opr_analisis.php",		
        	data: "opcion=11&id="+id+"&muestra="+muestra+"&contrato="+contrato+"&precio="+precio,
        	success: function(datos){

			}//end succces function
			});//end ajax function	
						   

		 }else{
			return;
		 }
		top.location.href = 'mantenimiento_analisis.php?muestra='+muestra+'&contrato='+contrato+'&id='+$('#id').val();
});


});//end jquery

///*******************************Actualiza tipo***********************************	

function actualiza_tipo(tipo){

//esta funcionrecibe en el parametro tipo el tipo de laboratio que es y en seleccionada el tap a que pertenece 1=quimica 2=micro 3= broma 
		seleccionada=1;	
		$('#cmb_subcategoria_'+tipo+'_'+seleccionada).find('option').remove();
		$('#cmb_subcategoria_'+tipo+'_'+seleccionada).append('<option>Seleccione</option>');
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=3&valor="+$('#cmb_categoria_'+tipo+'_'+seleccionada).val(),
        success: function(datos){			
			var v_resultado=datos.split("|");
				for (i=1;i<v_resultado.length;i++) { 
					$('#cmb_subcategoria_'+tipo+'_'+seleccionada).append('<option value="'+v_resultado[i]+'" >'+v_resultado[i]+'</option>'); 					
				} 
			 
		}//end succces function
		});//end ajax function
		

}//end actualiza tipo




//************carga Analisis***********************************************************
function cargaAnalisis(tipo,copiar){
		tab_counter=1;
		//copiar me indica si estoy cargando chechbox copiados	
		//guardo los valores de la categoria y subcategoari
		v_mActual[0]= $('#cmb_categoria_1_'+seleccionada).val();
		v_mActual[1]=$('#cmb_subcategoria_1_'+seleccionada).val();
		$('#loading'+tab_counter).html('cargando');
//		$('#loading'+tab_counter).empty().html('<img src="img/loadingAnimation.gif" />').delay(2000).fadeIn(400);

		seleccionada=1;	
		$('.muestra_'+tipo+'_'+seleccionada).html('');
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
      
	   data: "opcion=2&valor="+$('#cmb_categoria_1_'+seleccionada).val()+"&laboratorio="+$('#cmb_laboratorio_'+tipo+'_'+seleccionada).val()+"&sub="+$('#cmb_subcategoria_1_'+seleccionada).val(),
        success: function(datos){			
			var v_resultado=datos.split("|");			
				for (i=1;i<v_resultado.length;i++) { 
					v_datos=v_resultado[i].split(",");
					residuo=i%5
					if(residuo==0){					
						$('.muestra_'+tipo+'_'+seleccionada).append('<div><br></div>');
						//evaluo si estoy reimprimiendo un analisis, si si le pongo el cheked
						if(v_aAnterior.indexOf(parseFloat(v_datos[0]))>=0&&copiar==true){
							
							
							$('.muestra_'+tipo+'_'+seleccionada).append('<div class="Arial11Negro" align="left" style=" float:left; width:240px"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" checked onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
							reagregaAnalisis(v_datos[0],$('#cmb_laboratorio_'+tipo+'_'+seleccionada).val(),seleccionada,v_datos[3]);							
						
						}else{//else de reimprimiedo
						
							
							$('.muestra_'+tipo+'_'+seleccionada).append('<div class="Arial11Negro" align="left" style=" float:left; width:240px"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
						}//fin if reimprimiendo
					
					
					
					}else{//else de residuo o
						
					
					
							if(v_aAnterior.indexOf(parseFloat(v_datos[0]))>=0&&copiar==true){
							$('.muestra_'+tipo+'_'+seleccionada).append('<div class="Arial11Negro" align="left" style=" float:left; width:240px;"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" checked onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
							reagregaAnalisis(v_datos[0],$('#cmb_laboratorio_'+tipo+'_'+seleccionada).val(),seleccionada,v_datos[3]);				
							
							
						}else{//else reimprimiendo sin residuo 0
							
							
							
							$('.muestra_'+tipo+'_'+seleccionada).append('<div class="Arial11Negro" align="left" style=" float:left; width:240px;"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
						
						
						}//end if reimprimiedo sin residuo 0
					
					}//end if residuo 0
				} 
			 
		}//end succces function
		});//end ajax function
$('.muestra_'+tipo+'_'+seleccionada).append('<div></div><br><br><div align="left"><br></div>	');
	//esta funcion es recursiva se llama a si misma 3 veces para cargar los en los divs los checkbox de los analisis	
	if (repeticiones<=3){
		repeticiones++;
		if (copiar==true){
			cargaAnalisis(repeticiones,true);
		}else{	
		cargaAnalisis(repeticiones);
		}
	}else{
		repeticiones=1;
		$('#loading'+tab_counter).empty();
	}
}//end function




//*********************************Agregar Analisis*********************************
function agregaAnalisis(id,laboratorio,tab,precio,ligados){

//esta funcionrecibe en el parametro tipo el tipo de laboratio que es y en seleccionada el tap a que pertenece 1=quimica 2=micro 3= broma 
		
		//este if me valida si es TH2, acetil, o fumonisina b2 que tiene que ser precio 0		
		if (id=="1682"||id=="1684"||id=="1687"){
			precio=0;
		}

		var encontrado=false;
		var data=id+','+laboratorio+','+$('#numero_muestra').val()+','+precio+'|';
		 //metos los datos de los analisis en un array y luego los mando a guardar
		for (i=0;i<v_analisis.length;i++) { 
			if (v_analisis[i]==data){
				monto=monto-precio;
				$('#monto').html("Total = "+monto);
				v_analisis.splice(i,1);
				encontrado=true;
			}		
		} 
		if(encontrado==false){
			v_analisis[i]=data;
			v_aActual[contAnalisis]=parseFloat(id);
			contAnalisis++;
			
		}	
		 

		  

}//end agrega analisis



///********************continuar***************+///////////
$("#btn_agregar").live("click", function(event){
 if(confirm('¿Seguro que desea agregar este análisis?')){
		
		if($('#chk_molienda').is(':checked')){
			molienda=1;
		}else{
			molienda=0;
		}
		
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=12&datos="+v_analisis+"&contrato="+$('#numero_contrato').val()+"&molienda="+molienda,
        success: function(datos){			
			
			
		}//end succces function
		});//end ajax function
		
		top.location.href = 'mantenimiento_analisis.php?muestra='+$('#numero_muestra').val()+"&contrato="+$('#numero_contrato').val();
									  
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
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
  <div id="mainBlacoFondo" style=" margin-top:10px; margin-bottom:10px; ">
    

    <div align="center" id="mainBlancoMolienda">
	    <div align="center" class="Arial18Morado"  style="margin-bottom:10px; margin-top:10px;">Mantenimiento An&aacute;lisis de Muestra = <?=$_REQUEST['muestra'];?> Contrato = <?=$_REQUEST['contrato'];?>
	      <input type="hidden"  id="id"  value="<?=$_REQUEST['id'];?>"/>
          <input type="hidden"  id="numero_muestra"  value="<?=$_REQUEST['muestra'];?>"/>
          <input type="hidden"  id="numero_contrato"  value="<?=$_REQUEST['contrato'];?>"/>
	    </div>

	<table class="table_td" width="669"   border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td class=" table_td" width="123" ><div align="center" class="Arial14Azul">C&oacute;digo</div></td>
    <td class=" table_td" width="220" ><div align="center" class="Arial14Azul">An&aacute;lisis</div></td>
    <td class=" table_td"width="85" ><div align="center" class="Arial14Azul">Estado</div></td>
    <td class=" table_td"width="85" ><div align="center" class="Arial14Azul">Desactivar</div></td>
    
    </tr>	
<?


$result2=mysql_query("select c.nombre,a.id,a.precio,a.codigo,a.fecha_molienda, a.estado from tbl_analisis a, tbl_categoriasanalisis c where a.id_contrato='".$_REQUEST['contrato']."' and a.id_muestra='".$_REQUEST['muestra']."' and c.id=a.id_analisis order by a.estado");
//$result=mysql_query("select con.consecutivo as consecutivo,m.id,m.codigo,m.id_analisis,m.nombreMuestra as nombre,c.nombre as categoria,s.nombre as subcategoria from `tbl_contratos` as `con`, `tbl_muestras` as m, `tbl_categoriasmuestras` as c, `tbl_subcatmuestras` as s where m.id_contrato='".$_REQUEST['id']."' and con.`id`=m.`id_contrato` and  c.`id`=m.`id_categoria` and s.`id`=m.`id_subCategoria`");
	while ($row2=mysql_fetch_assoc($result2)){
?>	
	<tr>
    <td class=" table_td"><div align="center" class="Arial14Negro"><?=$row2['codigo'];?></div></td>
    <td class=" table_td"><div align="center" class="Arial14Negro"><?=utf8_encode($row2['nombre']);?></div></td>
    <? if($row2['estado']==4){
	?>	
	<td class=" table_td"><div align="center" class="Arial14Negro">Desactivada</div></td>
    <?
    }else{
	?>
    <td class=" table_td"><div align="center" class="Arial14Negro">Activa</div></td>
    <?
	}
	?>
    
    <td class=" table_td" width="154"><div align="center" class="Arial14Negro">
          <? if($row2['estado']==4){
			  echo "Desactiva";
			  }else{
			  
	?>	
      <input type="image" muestra="<?=$_REQUEST['muestra'];?>" id="<?=$row2['id'];?>" precio="<?=$row2['precio'];?>" class="id" contrato="<?=$_REQUEST['contrato'];?>" title="<?=$row2['id'];?>"  src="img/delete.png" />
     
    <? 
		  }
	?>
    </div></td>

	  </tr>	
    
<?	
	}

?>
	</table><br />
    
    <h2 class="Arial18Morado" >Agregar An&aacute;lisis</h2><div align="left" id="form'+tab_counter+'">
    <div align="center" class="Arial14Negro"><input type="checkbox" name="chk_molienda" id="chk_molienda" />Agregar en Molienda</div>
    <table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td><td width="170" align="left" class="Arial12Azul">Categor&iacute;a</td><td align="left" width="149" class="Arial12Azul">Tipo</td></tr></table><select disabled id="cmb_laboratorio_1_1" title="q"><option value="1">Qu&iacute;mica</option></select>&nbsp;&nbsp;<select class="combos" title="q" id="cmb_categoria_1_1" onChange="actualiza_tipo(1)"><option value="0" selected >Seleccione</option><option value="1">Subproducto origen animal</option><option value="2">Granos-Cereales</option><option value="3">Subproducto origen vegetal</option><option value="4">Plantas, sin procesar</option><option value="5">Pastos y forrajes</option><option value="6">Alimento terminado</option><option value="7">Ensilajes</option><option value="8">Otros</option><option value="9">Aguas</option><option value="10">Sedimentos</option><option value="11">L&aacute;cteos</option><option value="12">Minerales y Suplementos</option><option value="13">Semillas</option><option value="14">Leguminosas</option><option value="15">Plasma</option></select> &nbsp;&nbsp;<select class="combos" title="q" id="cmb_subcategoria_1_1" onChange="cargaAnalisis(1)"></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left" class="muestra_1_1"></div><br><div align="left" id="form'+tab_counter+'"><div align="center" class="Arial12Azul">*************************************************************************************************************************************************</div><table border="0" width="101"><tr><td class="Arial12Azul" width="95">Laboratorio</td></tr></table><select disabled title="m" id="cmb_laboratorio_2_1"><option value="2">Microbiolog&iacute;a</option></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_2_1"></div><br><div align="left" id="form0"><div align="center" class="Arial12Azul">*************************************************************************************************************************************************</div><table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td></tr></table><select disabled title="b" id="cmb_laboratorio_3_1"><option value="3">Bromatolog&iacute;a</option></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_3_1"></div><div align="center" class="Arial12Azul">*************************************************************************************************************************************************</div><br>

   <div align="center"><input id="btn_agregar" type="image" src="img/btn_agregar.png" /></div> 
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
