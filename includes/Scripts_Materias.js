
$(document).ready(function(){



//busca un registro de un mineral para modificarlo manual
$("#btn_buscar_mine").live("click", function(event){
//$("#btn_buscar").click(function(event){
    if($('#txt_registro_buscar').val()==''||$('#txt_year_buscar').val()==''){
        alert('Debe ingresar el numero de registro y el año en formato cifra10');
        return;
    }
        event.preventDefault();         
        $.ajax({
        type: "POST",
        async: false,
        url: "../operaciones/opr_materias.php",
        data: "opcion=4&registro="+$('#txt_registro_buscar').val()+"&year="+$('#txt_year_buscar').val(),
        success: function(datos){
            //desconcateno el resultado la primera posicion me indica si fue exitoso
            if(String(datos)=='error'){
                $.pnotify({
                pnotify_title: 'El contrato no se encontro',
                pnotify_text: '',
                pnotify_type: 'info',
                pnotify_hide: true
                });
            }else{
            var v_resultado=datos.split("|");
            $('#txt_contrato').attr('value',v_resultado[0]);
            $('#txt_nombre').attr('value',v_resultado[1]);
            $('#txt_cifra1').attr('value',v_resultado[2]);
            $('#txt_cifra2').attr('value',v_resultado[3]);
            $('#txt_cifra3').attr('value',v_resultado[4]);
            $('#txt_cifra4').attr('value',v_resultado[5]);
            $('#txt_cifra5').attr('value',v_resultado[6]);
            $('#txt_cifra6').attr('value',v_resultado[7]);
            $('#txt_cifra7').attr('value',v_resultado[8]);
            $('#txt_cifra8').attr('value',v_resultado[9]);
            $('#txt_cifra9').attr('value',v_resultado[10]);
            $('#txt_cifra10').attr('value',v_resultado[11]);
            $('#txt_calcio').attr('value',v_resultado[12]);
            $('#txt_fosforo').attr('value',v_resultado[13]);
            $('#txt_fosforo_d').attr('value',v_resultado[14]);
            $('#txt_magnesio').attr('value',v_resultado[15]);
            $('#txt_potasio').attr('value',v_resultado[16]);
            $('#txt_sal').attr('value',v_resultado[17]);
            $('#txt_hierro').attr('value',v_resultado[18]);
            $('#txt_cobre').attr('value',v_resultado[19]);
            $('#txt_manganeso').attr('value',v_resultado[20]);
            $('#txt_zinc').attr('value',v_resultado[21]);          
            $('#txt_cobalto').attr('value',v_resultado[22]);
            $('#txt_molibdeno').attr('value',v_resultado[23]);
            $('#txt_ph').attr('value',v_resultado[24]);
            $('#txt_carbonatos').attr('value',v_resultado[25]);
            $('#txt_sodio').attr('value',v_resultado[26]);
            $('#txt_materia_seca').attr('value',v_resultado[27]);
            $('#txt_arsenico').attr('value',v_resultado[28]);
            $('#txt_plomo').attr('value',v_resultado[29]);
            $('#txt_cadmio').attr('value',v_resultado[30]);
            $('#txt_mercurio').attr('value',v_resultado[31]);
            $('#txt_aminoacidos').attr('value',v_resultado[32]);
            $('#txt_humedad').attr('value',v_resultado[33]);
            $('#txt_proteina').attr('value',v_resultado[34]);
            $('#txt_energia').attr('value',v_resultado[35]);
            $('#txt_fluor').attr('value',v_resultado[40]);
            $('#opcion').attr('value','2');
            }
        }//end succces function
        });//end ajax function  
});                        
    
						   						   						  
/*****************************************Nueva Materia Prima************************************************
  Acccion:Llama al archivo de operaciones para crear una nueva materia prima.
  Parametros: Clasificacion, Sub categoria, nombre, fuente.
*****************************************************************************/
$("#btn_guardarm").click(function(event){		
		event.preventDefault();	
		if($("#txt_nombre").val() =="" || $("#txt_fuente").val()=="" || $("#cmb_categoria_1_1").val()=="Seleccione" ) {  
        	$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Todos los campos son obligatorios',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
    	}   			
		$.ajax({
        type: "POST",
        dataType: "json",
        url: "../operaciones/opr_materias.php",
        data: "opcion=1&nombre="+$('#txt_nombre').val()+"&clasificacion="+$("#cmb_clasificacion").val()+"&sub_categoria="+$('#cmb_subcategoria_1_1').val()+"&fuente="+$('#txt_fuente').val()+"&codigo="+$('#txt_codigo').val(),        		
		success: function(datos){
			//alert (datos.resultado);
		if (datos.resultado=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo codigo!!',
    			pnotify_text: 'Nuevo codigo creado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
				setInterval(function(){window.location.assign("menu_principal.php")},2000); 
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Ha sucedido un error revise que el codigo no fuera creado anteriormente',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			
		}								
		}//end succces function
		});//end ajax function		
		limpiar();			
});

/*****************************************Nueva muestra de minerales************************************************
  Acccion:Llama al archivo de operaciones para crear una nueva materia prima.
  Parametros: Clasificacion, Sub categoria, nombre, fuente.
*****************************************************************************/
$("#btn_guardar_mine").click(function(event){		
		event.preventDefault();	
		if($("#txt_nombre").val() =="" || $("#txt_fuente").val()=="" || $("#cmb_categoria_1_1").val()=="Seleccione" ) {  
        	$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Todos los campos son obligatorios',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
    	}   			
		$.ajax({
        type: "POST",
        dataType: "json",
        url: "../operaciones/opr_materias.php",
        data: "opcion=3&contrato="+$('#txt_contrato').val()+
        "&cifra1="+$("#txt_cifra1").val()+
        "&cifra2="+$("#txt_cifra2").val()+
        "&cifra3="+$("#txt_cifra3").val()+
        "&cifra4="+$("#txt_cifra4").val()+
        "&cifra5="+$("#txt_cifra5").val()+
        "&cifra6="+$("#txt_cifra6").val()+
        "&cifra7="+$("#txt_cifra7").val()+
        "&cifra8="+$("#txt_cifra8").val()+
        "&cifra9="+$("#txt_cifra9").val()+
        "&cifra10="+$("#txt_cifra10").val()+
        "&nombre="+$('#txt_nombre').val()+
        "&calcio="+$('#txt_calcio').val()+
        "&fosforo="+$('#txt_fosforo').val()+
        "&fosforo_d="+$('#txt_fosforo_d').val()+
        "&magnesio="+$('#txt_magnesio').val()+
        "&potasio="+$('#txt_potasio').val()+
        "&sal="+$('#txt_sal').val()+
        "&hierro="+$('#txt_hierro').val()+
        "&cobre="+$('#txt_cobre').val()+
        "&manganeso="+$('#txt_manganeso').val()+
        "&zinc="+$('#txt_zinc').val()+
        "&cobalto="+$('#txt_cobalto').val()+
        "&molibdeno="+$('#txt_molibdeno').val()+
        "&ph="+$('#txt_ph').val()+
        "&carbonatos="+$('#txt_carbonatos').val()+
        "&sodio="+$('#txt_sodio').val()+
        "&materia_seca="+$('#txt_materia_seca').val()+
        "&arsenico="+$('#txt_arsenico').val()+
        "&plomo="+$('#txt_plomo').val()+
        "&cadmio="+$('#txt_cadmio').val()+
        "&mercurio="+$('#txt_mercurio').val()+
        "&aminoacidos="+$('#txt_aminoacidos').val()+
        "&humedad="+$('#txt_humedad').val()+
        "&proteina="+$('#txt_proteina').val()+
        "&energia="+$('#txt_energia').val()+
        "&fluor="+$('#txt_fluor').val(),        		
		success: function(datos){
			//alert (datos.resultado);
		if (datos.resultado=="Success"){
				$.pnotify({
			    pnotify_title: 'Nueva muestra creada!!',
    			pnotify_text: ' Muestra creada exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
				 
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Ha sucedido un error revise los datos',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			
		}								
		}//end succces function
		});//end ajax function		
		limpiar();			
});

/*****************************************eliminar mineral************************************************
  Acccion:Llama al archivo de operaciones para eliminar una muestra de mineral.
  Parametros: numero registro y año.
*****************************************************************************/
$("#btn_eliminar_mine").click(function(event){       
        event.preventDefault(); 
        if($('#txt_registro_buscar').val()==''||$('#txt_year_buscar').val()==''){
                alert('Debe ingresar el numero de registro y el año en formato cifra10 antes de borrar');
                return;
        }               
        $.ajax({
        type: "POST",
        dataType: "json",
        url: "../operaciones/opr_materias.php",
        data: "opcion=5&registro="+$('#txt_registro_buscar').val()+
        "&year="+$("#txt_year_buscar").val(),                
        success: function(datos){
            //alert (datos.resultado);
        if (datos.resultado=="Success"){
                $.pnotify({
                pnotify_title: 'Registro Eliminado',
                pnotify_text: ' Registro eliminado exitosamente.',
                pnotify_type: 'info',
                pnotify_hide: true
                });
                 
        }else{
                $.pnotify({
                pnotify_title: 'Error!!',
                pnotify_text: 'Ha sucedido un error revise los datos',
                pnotify_type: 'error',
                pnotify_hide: true
                });
            
        }                               
        }//end succces function
        });//end ajax function      
        limpiar();          
});






//****************************************************Limpiar formulario crear articulo
function limpiar(){
	$('input[type=text]').each(function() {
		$(this).val('');
	}); 
			$("#cmb_clasificacion option[value='0']").attr("selected","selected");
			$("#cmb_cmb_categoria_1_1 option[value='0']").attr("selected","Seleccione");
			$("#cmb_cmb_subcategoria_1_1 option[value='0']").attr("selected","Selecccione");
}
													
})// JavaScript Document

///*******************************Actualiza tipo***********************************	
/**********************************************************
	Accion:actualiza el combo de subcategorias
	Parametros: Combo Categoria
**********************************************************/
function actualiza_tipo(tipo){

//esta funcionrecibe en el parametro tipo el tipo de laboratio que es y en seleccionada el tap a que pertenece 1=quimica 2=micro 3= broma 
		seleccionada=1;	
		$('#cmb_subcategoria_'+tipo+'_'+seleccionada).find('option').remove();
		$('#cmb_subcategoria_'+tipo+'_'+seleccionada).append('<option>Seleccione</option>');
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_contratos.php",
        data: "opcion=3&valor="+$('#cmb_categoria_'+tipo+'_'+seleccionada).val(),
        success: function(datos){			
			var v_resultado=datos.split("|");
				for (i=1;i<v_resultado.length;i++) { 
					$('#cmb_subcategoria_'+tipo+'_'+seleccionada).append('<option value="'+v_resultado[i]+'" >'+v_resultado[i]+'</option>'); 					
				} 
			 
		}//end succces function
		});//end ajax function
		

}//end actualiza tipo					   
