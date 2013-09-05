
$(document).ready(function(){
						   
$("#ver").fancybox({
				'width'				: '50%',
				'height'			: '60%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
});						   
						   
//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_impuestos.php",
        data: "opcion=3&txt_recibo_buscar="+$('#txt_recibo_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			if(datos=="error"){
				$.pnotify({
			    pnotify_title: 'El recibo no se encontro',
    			pnotify_text: '',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			}else{
			var v_resultado=datos.split("|");
			
			$('#txt_empresa').attr('value',v_resultado[0]);			
			$('#txt_recibo').attr('value',v_resultado[1]);
			$('#txt_deposito').attr('value',v_resultado[2]);
			$('#txt_monto').attr('value',v_resultado[3]);
			$('#txt_mora').attr('value',v_resultado[4]);
			$('#txt_fecha').attr('value',v_resultado[5]);
			$('#imagen').html('<div><img src="img_impuestos/'+v_resultado[6]+'"></div>');
			$('#txt_semestre').attr('value',v_resultado[7]);
			$("#cmb_tipopago option[value='"+v_resultado[8]+"']").attr("selected","selected");
				
			$('#opcion').attr('value','2');
			}
		}//end succces function
		});//end ajax function	
});						   


//***************************************************Guardar nuevo articulo******************************************
$("#btn_guardar").click(function(event){
		
		event.preventDefault();	
		if($("#txt_empresa").val() ==""||$("#txt_recibo").val() =="" ) {  
        	$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Debes indicar la empresa y el recibo',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
    	}  
  
		if($('#opcion').val()==1){
	
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_impuestos.php",
		data: "opcion=1&txt_empresa="+$('#txt_empresa').val()+"&txt_recibo="+$('#txt_recibo').val()+"&txt_deposito="+$('#txt_deposito').val()+"&txt_monto="+$('#txt_monto').val()+"&txt_mora="+$('#txt_mora').val()+"&txt_fecha="+$('#txt_fecha').val()+"&txt_semestre="+$('#txt_semestre').val()+"&cmb_tipopago="+$('#cmb_tipopago').val()+"&txt_recibo_buscar="+$('#txt_recibo_buscar').val(),      	
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo impuesto!!',
    			pnotify_text: 'El impuesto fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El impuesto ya existe',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		
		}else{
			
			$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_impuestos.php",
		data: "opcion=2&txt_empresa="+$('#txt_empresa').val()+"&txt_recibo="+$('#txt_recibo').val()+"&txt_deposito="+$('#txt_deposito').val()+"&txt_monto="+$('#txt_monto').val()+"&txt_mora="+$('#txt_mora').val()+"&txt_fecha="+$('#txt_fecha').val()+"&txt_semestre="+$('#txt_semestre').val()+"&cmb_tipopago="+$('#cmb_tipopago').val()+"&txt_recibo_buscar="+$('#txt_recibo_buscar').val(),              		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Impuestos modificado!!',
    			pnotify_text: 'El impuesto fue modificado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Ups sucedio un error',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			
		}
		}//end succces function
		});//end ajax function			
		
		}
$('#txt_empresa').focus();	
		
limpiar();
});




$("#btn_eliminar").click(function(event){
	event.preventDefault();	
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_impuestos.php",
        data: "opcion=6&txt_recibo_buscar="+$('#txt_recibo_buscar').val(),
        success: function(datos){

				$.pnotify({
			    pnotify_title: 'Articulo Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar_articulo();

});



//****************************************************Limpiar formulario crear articulo
function limpiar(){
			$('#txt_empresa').attr('value','');
			$('#txt_recibo').attr('value','');
			$('#txt_deposito').attr('value','');
			$('#txt_monto').attr('value','');
			$('#txt_mora').attr('value','');
			$('#txt_fecha').attr('value','');
			$('#txt_semestre').attr('value','');
	
			$('#opcion').attr('value','1');	
}







																   

})// JavaScript Document

					   
