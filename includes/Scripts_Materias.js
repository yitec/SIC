
$(document).ready(function(){
						   						   						  
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
        data: "opcion=1&nombre="+$('#txt_nombre').val()+"&clasificacion="+$("#cmb_clasificacion").val()+"&sub_categoria="+$('#cmb_subcategoria_1_1').val()+"&fuente="+$('#txt_fuente').val(),        		
		success: function(datos){
			//alert (datos.resultado);
		if (datos.resultado=="Success"){
				$.pnotify({
			    pnotify_title: 'Nueva Materia Prima!!',
    			pnotify_text: 'Nueva Materia Prima  creada exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Ha sucedido un error intentelo mas tarde',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}								
		}//end succces function
		});//end ajax function		
		limpiar();			
});





//****************************************************Limpiar formulario crear articulo
function limpiar(){
			$('#txt_fuente').attr('value','');
			$('#txt_nombre').attr('value','');
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
