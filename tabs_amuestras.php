<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Tabs - Vertical Tabs functionality</title>
	<link rel="stylesheet" href="css/ui-lightness/jquery.ui.all.css">
	<script src="includes/jquery-1.7.1.js"></script>
	<script src="includes/jquery.ui.core.js"></script>
	<script src="includes/jquery.ui.widget.js"></script>
	<script src="includes/jquery.ui.tabs.js"></script>
    
	<link rel="stylesheet" href="css/ui-lightness/demos.css">

<script>	
var Url = location.href;
Url = Url.replace(/.*\?(.*?)/,"$1");
Variables = Url.split ("&");
for (i = 0; i < Variables.length; i++) {
       Separ = Variables[i].split("=");
       eval ('var '+Separ[0]+'="'+Separ[1]+'"');
}

			var tab_counter = 0;
			var analisis;
			var repeticiones=1;
			var v_analisis=new Array();
			var v_aAnterior=new Array();//estos 4 vectores me sirven para copiar la muestra anterior
			var v_mAnterior=new Array();			
			var v_aActual=new Array();
			var v_mActual=new Array();
			var contAnalisis=0;//contador que lleva el numero de analisis por muestra




$(function() {

		$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		
		muestra_label=tab_counter+1;

		var $tabs = $( "#tabs").tabs({
		tabTemplate: "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'>Remove Tab</span></li>",
			add: function( event, ui ) {
				//tab_content ='Muestra:<input id="txt_muestra'+tab_counter+'">';
				tab_content ='<div align="center" id="loading'+tab_counter+'"></div><h2 class="Arial18Morado" >Muestra '+muestra_label+'</h2><div align="left" id="form'+tab_counter+'"><table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td><td width="170" align="left" class="Arial12Azul">Categor&iacute;a</td><td align="left" width="149" class="Arial12Azul">Tipo</td></tr></table><select id="cmb_laboratorio_1_'+tab_counter+'" title="q"><option value="1">Qu&iacute;mica</option></select><select class="combos" title="q" id="cmb_categoria_1_'+tab_counter+'" onChange="actualiza_tipo(1)"><option value="0">Seleccione</option><option value="1">Subproducto origen animal</option><option value="2">Granos, cereales</option><option value="3">Subproducto origen vegetal</option><option value="4">Plantas, sin procesar</option><option value="5">Pastos y forrajes</option><option value="6">Alimento terminado</option><option value="7">Ensilajes</option><option value="8">Otros</option><option value="9">Aguas</option><option value="10">Sedimentos</option><option value="11">L&aacute;cteos</option><option value="12">Minerales y Suplementos</option><option value="13">Semillas</option></select><select class="combos" title="q" id="cmb_subcategoria_1_'+tab_counter+'" onChange="cargaAnalisis(1)"></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_1_'+tab_counter+'"></div><br><div align="left" id="form'+tab_counter+'"><table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td></tr></table><select title="m" id="cmb_laboratorio_2_'+tab_counter+'"><option value="2">Microbiolog&iacute;a</option></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_2_'+tab_counter+'"></div><br><div align="left" id="form'+tab_counter+'"><table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td></tr></table><select title="b" id="cmb_laboratorio_3_'+tab_counter+'"><option value="3">Bromatolog&iacute;a</option></select></div><br><div align="left	" class="muestra_3_'+tab_counter+'"><br></div><div align="center"  class="Arial12Azul"><table width="424"><tr><td align="center" width="207"> Nombre Muestra</td><td align="center" width="205">Observaciones</td></tr></table></div><div align="center"><table><tr><td><textarea id="txt_nombre_'+tab_counter+'" cols="35" rows="3"  class="textArea"></textarea></td><td><textarea id="txt_observaciones_'+tab_counter+'" cols="35" rows="3"  class="textArea"></textarea></td></tr></table></div>';
				
				$( ui.panel ).append(tab_content);
			}
		});


			

});
		
		
		
		
		
		
		
/********************Add tab*********************/
function addTab() {
			tab_counter++;
			if (tab_counter>0){//vacio los vectores de los datos anteriores para copiar el nuevo
				v_aAnterior = v_aActual.slice(0);
				v_mAnterior = v_mActual.slice(0);				
				v_aActual=null;				
				v_mActual=null;
				v_aActual=new Array();
				v_mActual=new Array();
				//contAnalisis=0;
				
			}
						
			muestra_label=tab_counter+1;


			$("#tabs").tabs("add","#tabs-"+tab_counter,"Muestra "+muestra_label);
			
}//end add tap







//************carga Analisis***********************************************************
function cargaAnalisis(tipo,copiar){
		//copiar me indica si estoy cargando chechbox copiados	
		//guardo los valores de la categoria y subcategoari
		v_mActual[0]= $('#cmb_categoria_1_'+seleccionada).val();
		v_mActual[1]=$('#cmb_subcategoria_1_'+seleccionada).val();
		$('#loading'+tab_counter).html('cargando');
//		$('#loading'+tab_counter).empty().html('<img src="img/loadingAnimation.gif" />').delay(2000).fadeIn(400);

		seleccionada=$("#tabs").tabs('option', 'selected');	
		$('.muestra_'+tipo+'_'+seleccionada).html('');
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
       // data: "opcion=2&valor="+$('#cmb_categoria_'+tipo+'_'+seleccionada).val()+"&laboratorio="+$('#cmb_laboratorio_'+tipo+'_'+seleccionada).val()+"&sub="+$('#cmb_subcategoria_'+tipo+'_'+seleccionada).val(),
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
							
							
							$('.muestra_'+tipo+'_'+seleccionada).append('<div align="left" style=" float:left; width:220px"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" checked onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
							reagregaAnalisis(v_datos[0],$('#cmb_laboratorio_'+tipo+'_'+seleccionada).val(),seleccionada,v_datos[3]);							
						
						}else{//else de reimprimiedo
						
							
							$('.muestra_'+tipo+'_'+seleccionada).append('<div align="left" style=" float:left; width:220px"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
						}//fin if reimprimiendo
					
					
					
					}else{//else de residuo o
						
					
					
							if(v_aAnterior.indexOf(parseFloat(v_datos[0]))>=0&&copiar==true){
							$('.muestra_'+tipo+'_'+seleccionada).append('<div align="left" style=" float:left; width:220px;"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" checked onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
							reagregaAnalisis(v_datos[0],$('#cmb_laboratorio_'+tipo+'_'+seleccionada).val(),seleccionada,v_datos[3]);				
							
							
						}else{//else reimprimiendo sin residuo 0
							
							
							
							$('.muestra_'+tipo+'_'+seleccionada).append('<div align="left" style=" float:left; width:220px;"><input id="'+v_datos[0]+'" type="checkbox" title="'+v_datos[3]+'" laboratorio="'+v_datos[1]+'" onclick="agregaAnalisis('+v_datos[0]+','+v_datos[1]+','+seleccionada+','+v_datos[3]+','+v_datos[4]+')" value="'+v_datos[0]+'">'+v_datos[2]+'</div>');
						
						
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






	

///*******************************Actualiza tipo***********************************	

function actualiza_tipo(tipo){

//esta funcionrecibe en el parametro tipo el tipo de laboratio que es y en seleccionada el tap a que pertenece 1=quimica 2=micro 3= broma 
		seleccionada=$("#tabs").tabs('option', 'selected');	
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






//*********************************Agregar Analisis*********************************
function agregaAnalisis(id,laboratorio,tab,precio,ligados){

//esta funcionrecibe en el parametro tipo el tipo de laboratio que es y en seleccionada el tap a que pertenece 1=quimica 2=micro 3= broma 
		
		var encontrado=false;
		var data=id+','+laboratorio+','+tab+','+precio+'|';
		 //metos los datos de los analisis en un array y luego los mando a guardar
		for (i=0;i<v_analisis.length;i++) { 
			if (v_analisis[i]==data){
				v_analisis.splice(i,1);
				encontrado=true;
			}		
		} 
		if(encontrado==false){
			v_analisis[i]=data;
			v_aActual[contAnalisis]=parseFloat(id);
			contAnalisis++;
			if(ligados != 0) {	
			marcaLigados(id,laboratorio,tab,precio,ligados);//si este checkbox tiene un analisis ligado lo marco con esta funcion 
			}
		}	
		 

		  

}//end agrega analisis





//*********************************ReAgregar Analisis*********************************
function reagregaAnalisis(id,laboratorio,tab,precio){

//esta funcio se llama cuando se copia el ultimo analisis, agrega el analisis marcado al vector de analisis total

		var data=id+','+laboratorio+','+tab+','+precio+'|';
		 //metos los datos de los analisis en un array y luego los mando a guardar
		ultimo=v_analisis.length;
	
		v_analisis[ultimo]=data;
		v_aActual[contAnalisis]=parseFloat(id);
			contAnalisis++;
		 
}//end reagrega analisis




//*********************************Marcar Analisis Ligados*********************************

function marcaLigados(id,laboratorio,tab,precio,ligados){

//esta funcion se llama cuando marco un analisis y se verifica si tienen otros ligados y los marca
		
		var v_resultado=ligados.split(":");
		
		for (i=0;i<v_resultado.length;i++) { 
			precio=$('#'+v_resultado[i]).attr("title");//me actualiza el precio
			laboratorio=$('#'+v_resultado[i]).attr("laboratorio");//laboratorio es una atributo del chechkbox
			$('#'+v_resultado[i]).attr("checked","checked");
			var dato=v_resultado[i]+','+laboratorio+','+tab+','+precio+'|';
			v_analisis[contAnalisis]=dato;
			v_aActual[contAnalisis]=parseFloat(v_resultado[i]);
			contAnalisis++;
			
		}//end for
		
		
		
		 
}//end marcar analisis ligados








//****************Copiar analisis**********///
function copiarAnalisis(){
	seleccionada=$("#tabs").tabs('option', 'selected');	
	 //$('#cmb_categoria_1_'+seleccionada+' option').attr('selected',v_mAnterior[0]);
	 //$("#holder option").eq(N).attr("selected", "selected");
	 $("#cmb_categoria_1_"+seleccionada+" option[value='"+v_mAnterior[0]+"']").attr("selected","selected");
	actualiza_tipo(1);
	$("#cmb_subcategoria_1_"+seleccionada+" option[value='"+v_mAnterior[1]+"']").attr("selected","selected");
	cargaAnalisis(1,true);

}//end copiar analisis








///********************continuar***************+///////////
$("#btn_agregar").live("click", function(event){

		//meto las observaciones de todas las muestras en un vector
		var v_observaciones;
		
		for (i=0;i<=tab_counter;i++) { 

		nombre=$('#txt_nombre_'+i).val();
		observaciones=$('#txt_observaciones_'+i).val();
		v_observaciones=v_observaciones+"|"+i+","+nombre+","+observaciones; 
					
		}//end for

		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=8&contrato="+$('#txt_contrato').val()+'&muestras='+tab_counter+'&observaciones='+v_observaciones,
        success: function(datos){			
			
			
		}//end succces function
		});//end ajax function
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=9&datos="+v_analisis+"&contrato="+$('#txt_contrato').val(),
        success: function(datos){			
			
			
		}//end succces function
		});//end ajax function
		
		top.location.href = 'mantenimiento_muestras.php';
									  


									  
});

</script>
    
    
    
    
    
    
    
	<style>
	.ui-tabs-vertical { width: 900px; }
	.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
	.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
	.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
	.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
	.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 730px;}
	
	</style>
</head>
<body>


<div align="right"><a href="#" onClick="addTab()"><img src="img/plus.png" title="Agregar Muestra" width="20" height="20"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="copiarAnalisis(1)"><img title="Copiar muestra anterior" src="img/copy.png" width="20" height="20"></a></div>
<input name="txt_contrato" id="txt_contrato" type="hidden" value="<?=$_REQUEST['contrato']; ?>">


<div id="tabs">
	<ul>
		<li><a href="#tabs-0">Muestra <?=$tot;?></a></li>
	</ul>
<? 
$tot=$_REQUEST['total']+1;

?>
<input name="txt_muestras" id="txt_muestras" type="hidden" value="<?=$tot; ?>">
    
<div id="tabs-0"   >
		<div align="center" id="loading0"></div>
	<h2 class="Arial18Morado" >Muestra <?=$tot; ?></h2><div align="left" id="form'+tab_counter+'"><table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td><td width="170" align="left" class="Arial12Azul">Categor&iacute;a</td><td align="left" width="149" class="Arial12Azul">Tipo</td></tr></table><select disabled id="cmb_laboratorio_1_0" title="q"><option value="1">Qu&iacute;mica</option></select><select class="combos" title="q" id="cmb_categoria_1_0" onChange="actualiza_tipo(1)"><option value="0" selected >Seleccione</option><option value="1">Subproducto origen animal</option><option value="2">Granos, cereales</option><option value="3">Subproducto origen vegetal</option><option value="4">Plantas, sin procesar</option><option value="5">Pastos y forrajes</option><option value="6">Alimento terminado</option><option value="7">Ensilajes</option><option value="8">Otros</option><option value="9">Aguas</option><option value="10">Sedimentos</option><option value="11">L&aacute;cteos</option><option value="12">Minerales y Suplementos</option><option value="13">Semillas</option></select><select class="combos" title="q" id="cmb_subcategoria_1_0" onChange="cargaAnalisis(1)"></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_1_0"></div><br><div align="left" id="form'+tab_counter+'"><div align="center" class="Arial12Azul">*************************************************************************************************************************************************</div><table border="0" width="101"><tr><td class="Arial12Azul" width="95">Laboratorio</td></tr></table><select disabled title="m" id="cmb_laboratorio_2_0"><option value="2">Microbiolog&iacute;a</option></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_2_0"></div><br><div align="left" id="form0"><div align="center" class="Arial12Azul">*************************************************************************************************************************************************</div><table border="0" width="440"><tr><td class="Arial12Azul" width="95">Laboratorio</td></tr></table><select disabled title="b" id="cmb_laboratorio_3_0"><option value="3">Bromatolog&iacute;a</option></select></div><br><div align="left" class="Arial12Azul">An&aacute;lisis</div><div align="left	" class="muestra_3_0"></div><div align="center" class="Arial12Azul">*************************************************************************************************************************************************</div><br>
<div align="center"  class="Arial12Azul"><table width="424"><tr><td align="center" width="207"> Nombre Muestra</td><td align="center" width="205">Observaciones</td></tr></table></div><div align="center"><table><tr><td><textarea id="txt_nombre_0" cols="35" rows="3"  class="textArea"></textarea></td><td><textarea id="txt_observaciones_0" cols="35" rows="3"  class="textArea"></textarea></td></tr></table></div>
</div>
</div>
</div>


    </div>


</body>
</html>