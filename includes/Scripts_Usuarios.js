

//variables globales
var v_nombres=new Array();
var v_reportes=new Array();

$(document).ready(function(){
$('#quimica').hide();						   
$('#microbiologia').hide();						   
$('#bromatologia').hide();
$('#reportes').hide();

//********cargo el vector de usuarios *********
var availableTags;
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=6",
        success: function(datos){			
			 availableTags =datos;			
		}//end succces function
		});//end ajax function	
		availableTags=availableTags.split(",");
		$( "#txt_usuario_buscar" ).autocomplete({
			source: availableTags
		});
		

//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=2&usuario="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			var v_resultado=datos.split("|");
			$('#txt_usuario').attr('value',v_resultado[0]);
			$('#txt_nombre').attr('value',v_resultado[1]);
			$('#txt_apellidos').attr('value',v_resultado[2]);
			$('#txt_cedula').attr('value',v_resultado[3]);
			$('#txt_pass').attr('value',v_resultado[4]);
			$('#txt_fecha').attr('value',v_resultado[5]);
			$('#opcion').attr('value','3');
			ids_analisis=v_resultado[7];
			ids_reportes=v_resultado[8];
			//desconcateno el vector de permisos		
			v_resultado=v_resultado[6].split(",");
			
			if(v_resultado.indexOf("1")>=0){
				$("#chk_c_contrato").attr("checked","checked");
			}
			if(v_resultado.indexOf("2")>=0){
				$("#chk_m_contrato").attr("checked","checked");
			}			
			if(v_resultado.indexOf("3")>=0){
				$("#chk_v_contrato").attr("checked","checked");
			}
			if(v_resultado.indexOf("4")>=0){
				$("#chk_molienda").attr("checked","checked");
			}
			if(v_resultado.indexOf("5")>=0){
				$("#chk_quimica").attr("checked","checked");
				$('#quimica').show();
				muestraQuimica(ids_analisis);				
			}
			if(v_resultado.indexOf("6")>=0){
				$("#chk_microb").attr("checked","checked");
				$('#microbiologia').show();
				muestraMicro(ids_analisis);	
			}			
			if(v_resultado.indexOf("7")>=0){
				$("#chk_broma").attr("checked","checked");
				$('#bromatologia').show();
				muestraBroma(ids_analisis);	
			}
			if(v_resultado.indexOf("8")>=0){
				$("#chk_rquimi").attr("checked","checked");
			}				
			if(v_resultado.indexOf("9")>=0){
				$("#chk_rmicro").attr("checked","checked");
			}			
							
			if(v_resultado.indexOf("10")>=0){
				$("#chk_rbroma").attr("checked","checked");
			}						
			if(v_resultado.indexOf("11")>=0){
				$("#chk_reportes").attr("checked","checked");
				$('#reportes').show();
				muestraReportes(ids_reportes);
			}						
			if(v_resultado.indexOf("12")>=0){
				$("#chk_usuarios").attr("checked","checked");
			}			
			if(v_resultado.indexOf("13")>=0){
				$("#chk_clientes").attr("checked","checked");
			}
			if(v_resultado.indexOf("14")>=0){
				$("#chk_rEtiquetas").attr("checked","checked");
			}
			if(v_resultado.indexOf("15")>=0){
				$("#chk_mMuestras").attr("checked","checked");
			}
			if(v_resultado.indexOf("16")>=0){
				$("#chk_mAnalisis").attr("checked","checked");
			}
			if(v_resultado.indexOf("17")>=0){
				$("#chk_pQuimica").attr("checked","checked");
			}
			if(v_resultado.indexOf("18")>=0){
				$("#chk_iActuales").attr("checked","checked");
			}
			if(v_resultado.indexOf("19")>=0){
				$("#chk_iAntiguos").attr("checked","checked");
			}
			if(v_resultado.indexOf("20")>=0){
				$("#chk_cActuales").attr("checked","checked");
			}
			if(v_resultado.indexOf("21")>=0){
				$("#chk_cAntiguos").attr("checked","checked");
			}
			if(v_resultado.indexOf("22")>=0){
				$("#chk_crearAnalisis").attr("checked","checked");
			}
			if(v_resultado.indexOf("23")>=0){
				$("#chk_precios").attr("checked","checked");
			}
			if(v_resultado.indexOf("24")>=0){
				$("#chk_firmas").attr("checked","checked");
			}
			if(v_resultado.indexOf("25")>=0){
				$("#chk_tipos").attr("checked","checked");
			}
			if(v_resultado.indexOf("26")>=0){
				$("#chk_inventario").attr("checked","checked");
			}
			if(v_resultado.indexOf("27")>=0){
				$("#chk_impuestos").attr("checked","checked");
			}
			if(v_resultado.indexOf("28")>=0){
				$("#chk_materias").attr("checked","checked");
			}
			if(v_resultado.indexOf("29")>=0){
				$("#chk_eliminarAnalisis").attr("checked","checked");
			}
			if(v_resultado.indexOf("30")>=0){
				$("#chk_cpedidos").attr("checked","checked");
			}
			if(v_resultado.indexOf("31")>=0){
				$("#chk_apedidos").attr("checked","checked");
			}
			if(v_resultado.indexOf("32")>=0){
				$("#chk_ccalidad").attr("checked","checked");
			}
			if(v_resultado.indexOf("33")>=0){
				$("#chk_mdocumento").attr("checked","checked");
			}
			if(v_resultado.indexOf("34")>=0){
				$("#chk_docoficiales").attr("checked","checked");
			}
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
								 
		if($("#txt_nombre").val()==""||$("#txt_apellidos").val()==""||$("#txt_usuario").val()==""||$("#txt_pass").val()==""){
			$.pnotify({
			    pnotify_title: 'Nuevo Usuario!!',
    			pnotify_text: 'Nombre-Apellidos-Usuario-Password son obligatorios',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});

			return;
		}
		
		var permisos;
		if ($("#chk_c_contrato").is(":checked")){
			permisos=permisos+","+1;	
		}
		if ($("#chk_m_contrato").is(":checked")){
			permisos=permisos+","+2;	
		}		
		if ($("#chk_v_contrato").is(":checked")){
			permisos=permisos+","+3;	
		}
		if ($("#chk_molienda").is(":checked")){
			permisos=permisos+","+4;	
		}
		if ($("#chk_quimica").is(":checked")){
			permisos=permisos+","+5;	
		}
		if ($("#chk_microb").is(":checked")){
			permisos=permisos+","+6;	
		}
		if ($("#chk_broma").is(":checked")){
			permisos=permisos+","+7;	
		}
		if ($("#chk_rquimi").is(":checked")){
			permisos=permisos+","+8;	
		}
		if ($("#chk_rmicro").is(":checked")){
			permisos=permisos+","+9;	
		}
		if ($("#chk_rbroma").is(":checked")){
			permisos=permisos+","+10;	
		}
		if ($("#chk_reportes").is(":checked")){
			permisos=permisos+","+11;	
		}
		if ($("#chk_usuarios").is(":checked")){
			permisos=permisos+","+12;	
		}
		if ($("#chk_clientes").is(":checked")){
			permisos=permisos+","+13;	
		}				
		if ($("#chk_rEtiquetas").is(":checked")){
			permisos=permisos+","+14;	
		}				
		if ($("#chk_mMuestras").is(":checked")){
			permisos=permisos+","+15;	
		}				
		if ($("#chk_mAnalisis").is(":checked")){
			permisos=permisos+","+16;	
		}				
		if ($("#chk_pQuimica").is(":checked")){
			permisos=permisos+","+17;	
		}				
		if ($("#chk_iActuales").is(":checked")){
			permisos=permisos+","+18;	
		}				
		if ($("#chk_iAntiguos").is(":checked")){
			permisos=permisos+","+19;	
		}
		
		if ($("#chk_cActuales").is(":checked")){
			permisos=permisos+","+20;	
		}
		if ($("#chk_cAntiguos").is(":checked")){
			permisos=permisos+","+21;	
		}
		if ($("#chk_crearAnalisis").is(":checked")){
			permisos=permisos+","+22;	
		}
		if ($("#chk_precios").is(":checked")){
			permisos=permisos+","+23;	
		}
		if ($("#chk_firmas").is(":checked")){
			permisos=permisos+","+24;	
		}
		if ($("#chk_tipos").is(":checked")){
			permisos=permisos+","+25;	
		}
		if ($("#chk_inventario").is(":checked")){
			permisos=permisos+","+26;	
		}
		if ($("#chk_impuestos").is(":checked")){
			permisos=permisos+","+27;	
		}
		if ($("#chk_materias").is(":checked")){
			permisos=permisos+","+28;	
		}
		if ($("#chk_eliminarAnalisis").is(":checked")){
			permisos=permisos+","+29;	
		}
		if ($("#chk_cpedidos").is(":checked")){
			permisos=permisos+","+30;	
		}
		if ($("#chk_apedidos").is(":checked")){
			permisos=permisos+","+31;	
		}
		if ($("#chk_ccalidad").is(":checked")){
			permisos=permisos+","+32;	
		}
		if ($("#chk_mdocumento").is(":checked")){
			permisos=permisos+","+33;	
		}
		if ($("#chk_docoficiales").is(":checked")){
			permisos=permisos+","+34;	
		}		
		
		
		event.preventDefault();				  				
		if($('#opcion').val()==1){	
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos+"&ids_analisis="+v_nombres+"&ids_reportes="+v_reportes,        		
		success: function(datos){

		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Usuario!!',
    			pnotify_text: 'El Usuario fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El usuario ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_codigo').focus();	
		}else{

		//modifico los datos del producto
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=3&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos+"&ids_analisis="+v_nombres+"&ids_reportes="+v_reportes+"&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),		
		success: function(datos){
				
				$.pnotify({
			    pnotify_title: 'Usuario Modificado',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
			});		
		}//end succces function
		});//end ajax function			
		}//end if 
		
limpiar();
});


$("#btn_eliminar").click(function(event){
	event.preventDefault();	
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=4&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			alert(datos);
				$.pnotify({
			    pnotify_title: 'Usuario Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar();

});

/****************************Activar checkbox de quimica*********/
$("#chk_quimica").click(function(event){
		if ($("#chk_quimica").attr("checked")){
			$('#quimica').show();	
			
		}else{
			$('#quimica').hide();						   								 
		}								
});

/****************************Activar checkbox de microbiologia*********/
$("#chk_microb").click(function(event){
		if ($("#chk_microb").attr("checked")){
			$('#microbiologia').show();
			
		}else{
			$('#microbiologia').hide();						   								 
		}																
});

/****************************Activar checkbox de bromatologia*********/
$("#chk_broma").click(function(event){

		if ($("#chk_broma").attr("checked")){
			$('#bromatologia').show();	
			
		}else{
			$('#bromatologia').hide();						   								 
		}								
});

/****************************Activar checkbox de Reportes*********/
$("#chk_reportes").click(function(event){

		if ($("#chk_reportes").attr("checked")){
			$('#reportes').show();	
			
		}else{
			$('#reportes').hide();						   								 
		}								
});


/****************************Marcar todos los checkbox de quimica*********/
$("#chk_todosQuimica").click(function(event){
	var encontrado=false;
	$(".qm:checkbox:not(:checked)").attr("checked", "checked");							 
		$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=5&laboratorio=1",
        		success: function(datos){
					
					var v_resultado=datos.split("|");
					for (i=0;i<v_resultado.length;i++) { 
						encontrado=false;
						if(v_nombres.length>0){
						for (j=0;j<v_nombres.length;j++) { 
							
							if (v_nombres[j]==v_resultado[i]){
							v_nombres.splice(j,1);
							encontrado=true;
							}		
						} //END FOR 2
						}else{
							v_nombres[i]=v_resultado[i];
							encontrado=true
						}
					if(encontrado==false){
						v_nombres[j]=v_resultado[i];			
					}	

					
					}//end for 1

				}//end succces function
				});//end ajax function		
});


/****************************Marcar todos los checkbox de microbiologia*********/
$("#chk_todosMicro").click(function(event){
	var encontrado=false;
	$(".mb:checkbox:not(:checked)").attr("checked", "checked");							 
		$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=5&laboratorio=2",
        		success: function(datos){
					
					var v_resultado=datos.split("|");
					for (i=0;i<v_resultado.length;i++) { 
						encontrado=false;
						if(v_nombres.length>0){
						for (j=0;j<v_nombres.length;j++) { 
							
							if (v_nombres[j]==v_resultado[i]){
							v_nombres.splice(j,1);
							encontrado=true;
							}		
						} //END FOR 2
						}else{
							v_nombres[i]=v_resultado[i];
							encontrado=true
						}
					if(encontrado==false){
						v_nombres[j]=v_resultado[i];			
					}	

					
					}//end for 1

				}//end succces function
				});//end ajax function		
});


/****************************Marcar todos los checkbox de bromatologia*********/
$("#chk_todosBroma").click(function(event){
	var encontrado=false;
	$(".br:checkbox:not(:checked)").attr("checked", "checked");							 
		$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=5&laboratorio=3",
        		success: function(datos){
					
					var v_resultado=datos.split("|");
					for (i=0;i<v_resultado.length;i++) { 
						encontrado=false;
						if(v_nombres.length>0){
						for (j=0;j<v_nombres.length;j++) { 
							
							if (v_nombres[j]==v_resultado[i]){
							v_nombres.splice(j,1);
							encontrado=true;
							}		
						} //END FOR 2
						}else{
							v_nombres[i]=v_resultado[i];
							encontrado=true
						}
					if(encontrado==false){
						v_nombres[j]=v_resultado[i];			
					}	

					
					}//end for 1

				}//end succces function
				});//end ajax function		
});



/****************************Marcar todos los checkbox de Reportes*********/
$("#chk_todosReporte").click(function(event){
	var encontrado=false;
	$(".rp:checkbox:not(:checked)").attr("checked", "checked");							 
		$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=7",
        		success: function(datos){
					
					var v_resultado=datos.split("|");
					for (i=0;i<v_resultado.length;i++) { 
						encontrado=false;
						if(v_reportes.length>0){
						for (j=0;j<v_reportes.length;j++) { 
							
							if (v_reportes[j]==v_resultado[i]){
							v_reportes.splice(j,1);
							encontrado=true;
							}		
						} //END FOR 2
						}else{
							v_reportes[i]=v_resultado[i];
							encontrado=true
						}
					if(encontrado==false){
						v_reportes[j]=v_resultado[i];			
					}	

					
					}//end for 1

				}//end succces function
				});//end ajax function		
});


function limpiar(){
			$('#txt_nombre').attr('value','');
			$('#txt_apellidos').attr('value','');
			$('#txt_cedula').attr('value','');
			$('#txt_usuario').attr('value','');
			$('#txt_pass').attr('value','');
			$('#txt_fecha').attr('value','');
			$('#txt_usuario_buscar').attr('value','');						
			$('#opcion').attr('value','1');
			$(".ck:checkbox:checked").removeAttr("checked");
			$(".qm:checkbox:checked").removeAttr("checked");
			$(".mb:checkbox:checked").removeAttr("checked");
			$(".br:checkbox:checked").removeAttr("checked");
			$(".rp:checkbox:checked").removeAttr("checked");
			$("#chk_todosQuimica").removeAttr("checked");
			$("#chk_todosMicro").removeAttr("checked");
			$("#chk_todosBroma").removeAttr("checked");
			$("#chk_rEtiquetas").removeAttr("checked"); 
			$("#chk_mMuestras").removeAttr("checked"); 
			$("#chk_mAnalisis").removeAttr("checked"); 
			$("#chk_pQuimica").removeAttr("checked"); 
			$("#chk_gInformes").removeAttr("checked"); 
			$("#chk_iAntiguos").removeAttr("checked");
			
			
	
	
}



																   

})// JavaScript Document



//*********************************Agregar Analisis*********************************
function agregaAnalisis(id){

//esta funcionrecibe en el parametro tipo el tipo de laboratio que es y en seleccionada el tap a que pertenece 1=quimica 2=micro 3= broma 
		
		var encontrado=false;
		
		 //metos los datos de los analisis en un array y luego los mando a guardar
		for (i=0;i<v_nombres.length;i++) { 
			if (v_nombres[i]==id){
				v_nombres.splice(i,1);
				encontrado=true;
			}		
		} 
		if(encontrado==false){
			v_nombres[i]=String(id);			
		}	
		 

		  

}//end agrega analisis


//*********************************Agregar Reportes*********************************
function agregaReporte(id){

//esta funcionrecibe en el parametro el id del reporte que deseo agregar al perfil
		
		var encontrado=false;
		
		 //metos los datos de los analisis en un array y luego los mando a guardar
		for (i=0;i<v_reportes.length;i++) { 
			if (v_reportes[i]==id){
				v_reportes.splice(i,1);
				encontrado=true;
			}		
		} 
		if(encontrado==false){
			v_reportes[i]=String(id);			
		}	
		 

		  

}//end agrega analisis


//********************************Muestra los análisis de quimica*****************

					   
function muestraQuimica(ids){
	//recibo el vector de ids de analisis como parametro
			v_ids=ids.split(",");
			
				
			var cont=0;		
			$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=8",
        		success: function(datos){
					$('.checkboxQuimica').html("");
					var v_datos=datos.split("|");
					posiciones=v_datos.length-1;
					for (i=0;i<posiciones;i++) { 
						
						var v_detalles=v_datos[i].split(",");
						
						residuo=i%2
						if(residuo==0){	
								//si esta en el vector de ids lo marco
							if(v_ids.indexOf(v_detalles[0])>=0){
							
							$('.checkboxQuimica').append('<div style="float:left; width:230px;"><input type="checkbox" class="qm" checked onclick="agregaAnalisis('+v_detalles[0]+')" name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div><br>');
							pos=v_nombres.length;
							v_nombres[pos]=v_detalles[0];
							}else{

							$('.checkboxQuimica').append('<div style="float:left; width:230px;"><input type="checkbox" class="qm" onclick="agregaAnalisis('+v_detalles[0]+')" name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div><br>');
								
								}
								
						}else{//else residuo
						
							if(v_ids.indexOf(v_detalles[0])>=0){
							$('.checkboxQuimica').append('<div style="float:left; width:230px;"><input type="checkbox" class="qm" onclick="agregaAnalisis('+v_detalles[0]+')" checked name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div>');
							pos=v_nombres.length;
							v_nombres[pos]=v_detalles[0];

							}else{
								
							$('.checkboxQuimica').append('<div style="float:left; width:230px;"><input type="checkbox" class="qm" onclick="agregaAnalisis('+v_detalles[0]+')"  name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div>');	
							
							}
						}//end if residuo
					cont++;
					
					}//end for
				
				  }//end succces function
				});//end ajax function

			
}



//********************************Muestra los análisis de Microbiologia*****************

					   
function muestraMicro(ids){
	//recibo el vector de ids de analisis como parametro
			v_ids=ids.split(",");
			
				
			var cont=0;		
			$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=9",
        		success: function(datos){
					$('.checkboxMicrobiologia').html("");
					var v_datos=datos.split("|");
					posiciones=v_datos.length-1;
					for (i=0;i<posiciones;i++) { 
						
						var v_detalles=v_datos[i].split(",");
						
						residuo=i%2
						if(residuo==0){	
								//si esta en el vector de ids lo marco
							if(v_ids.indexOf(v_detalles[0])>=0){
							
							$('.checkboxMicrobiologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="mb" checked onclick="agregaAnalisis('+v_detalles[0]+')" name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div><br>');
							pos=v_nombres.length;
							v_nombres[pos]=v_detalles[0];
							}else{

							$('.checkboxMicrobiologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="mb" onclick="agregaAnalisis('+v_detalles[0]+')" name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div><br>');
								
								}
								
						}else{//else residuo
						
							if(v_ids.indexOf(v_detalles[0])>=0){
							$('.checkboxMicrobiologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="mb" onclick="agregaAnalisis('+v_detalles[0]+')" checked name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div>');
							pos=v_nombres.length;
							v_nombres[pos]=v_detalles[0];

							}else{
								
							$('.checkboxMicrobiologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="mb" onclick="agregaAnalisis('+v_detalles[0]+')"  name="CheckboxGroupMicro" value="'+v_detalles[0]+'" id="CheckboxGroupMicro_'+cont+'" />'+v_detalles[1]+'</div>');	
							
							}
						}//end if residuo
					cont++;
					
					}//end for
				
				  }//end succces function
				});//end ajax function

			
}





//********************************Muestra los análisis de Bromatología*****************

					   
function muestraBroma(ids){
	//recibo el vector de ids de analisis como parametro
			v_ids=ids.split(",");
			
				
			var cont=0;		
			$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=10",
        		success: function(datos){
					$('.checkboxBromatologia').html("");
					var v_datos=datos.split("|");
					posiciones=v_datos.length-1;
					for (i=0;i<posiciones;i++) { 
						
						var v_detalles=v_datos[i].split(",");
						
						residuo=i%2
						if(residuo==0){	
								//si esta en el vector de ids lo marco
							if(v_ids.indexOf(v_detalles[0])>=0){
							
							$('.checkboxBromatologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="br" checked onclick="agregaAnalisis('+v_detalles[0]+')" name="CheckboxGroupBroma" value="'+v_detalles[0]+'" id="CheckboxGroupBroma_'+cont+'" />'+v_detalles[1]+'</div><br>');
							pos=v_nombres.length;
							v_nombres[pos]=v_detalles[0];
							}else{

							$('.checkboxBromatologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="br" onclick="agregaAnalisis('+v_detalles[0]+')" name="CheckboxGroupBroma" value="'+v_detalles[0]+'" id="CheckboxGroupBroma_'+cont+'" />'+v_detalles[1]+'</div><br>');
								
								}
								
						}else{//else residuo
						
							if(v_ids.indexOf(v_detalles[0])>=0){
							$('.checkboxBromatologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="br" onclick="agregaAnalisis('+v_detalles[0]+')" checked name="CheckboxGroupBroma" value="'+v_detalles[0]+'" id="CheckboxGroupBroma_'+cont+'" />'+v_detalles[1]+'</div>');
							pos=v_nombres.length;
							v_nombres[pos]=v_detalles[0];

							}else{
								
							$('.checkboxBromatologia').append('<div style="float:left; width:200px;"><input type="checkbox" class="br" onclick="agregaAnalisis('+v_detalles[0]+')"  name="CheckboxGroupBroma" value="'+v_detalles[0]+'" id="CheckboxGroupBroma_'+cont+'" />'+v_detalles[1]+'</div>');	
							
							}
						}//end if residuo
					cont++;
					
					}//end for
				
				  }//end succces function
				});//end ajax function

			
}


//********************************Muestra los reportes*****************

					   
function muestraReportes(ids){
	//recibo el vector de ids de analisis como parametro
			v_ids=ids.split(",");
			
				
			var cont=0;		
			$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=11",
        		success: function(datos){
					$('.checkboxReportes').html("");
					var v_datos=datos.split("|");
					posiciones=v_datos.length-1;
					for (i=0;i<posiciones;i++) { 
						
						var v_detalles=v_datos[i].split(",");
						
						residuo=i%2
						
								//si esta en el vector de ids lo marco
							if(v_ids.indexOf(v_detalles[0])>=0){
							
							$('.checkboxReportes').append('<div style="float:left; width:400px;"><input type="checkbox" class="rp" checked onclick="agregaReporte('+v_detalles[0]+')" name="CheckboxGroupReportes" value="'+v_detalles[0]+'" id="CheckboxGroupReportes_'+cont+'" />'+v_detalles[1]+'</div><br>');
							pos=v_reportes.length;
							v_reportes[pos]=v_detalles[0];
							}else{

							$('.checkboxReportes').append('<div style="float:left; width:400px;"><input type="checkbox" class="rp" onclick="agregaReporte('+v_detalles[0]+')" name="CheckboxGroupReportes" value="'+v_detalles[0]+'" id="CheckboxGroupReportes_'+cont+'" />'+v_detalles[1]+'</div><br>');
								
								}
								
						
					cont++;
					
					}//end for
				
				  }//end succces function
				});//end ajax function

			
}
