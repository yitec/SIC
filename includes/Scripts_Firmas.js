
$(document).ready(function(){
						   
//********cargo el vector de usuarios *********
var availableTags;
		
		
						   
						   
//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=14&contrato="+$('#txt_contrato_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			if(datos=="error"){
				$.pnotify({
			    pnotify_title: 'El contrato no se encontro',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			}else{
			var v_resultado=datos.split("|");
			$('#txt_equimica').attr('value',v_resultado[0]);
			$('#txt_fquimica').attr('value',v_resultado[1]);
			$('#txt_emicro').attr('value',v_resultado[2]);
			$('#txt_fmicro').attr('value',v_resultado[3]);
			$('#txt_ebroma').attr('value',v_resultado[4]);
			$('#txt_fbroma').attr('value',v_resultado[5]);
			$('#txt_ezootecnia').attr('value',v_resultado[6]);
			$('#txt_fzootecnia').attr('value',v_resultado[7]);			
			$('#txt_contrato').attr('value',$('#txt_contrato_buscar').val());
				
			$('#opcion').attr('value','3');
			}
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		event.preventDefault();	
		if($("#txt_contrato").val()=="") {  
        	$.pnotify({
			    pnotify_title: 'Error en contrato!!',
    			pnotify_text: 'Revisa el numero de contato no debe estar vacio',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
        	return false;  
    	}  
  
		

		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=15&contrato="+$('#txt_contrato').val()+"&txt_equimica="+$('#txt_equimica').val()+"&txt_fquimica="+$('#txt_fquimica').val()+"&txt_emicro="+$('#txt_emicro').val()+"&txt_fmicro="+$('#txt_fmicro').val()+"&txt_ebroma="+$('#txt_ebroma').val()+"&txt_fbroma="+$('#txt_fbroma').val()+"&txt_ezootecnia="+$('#txt_ezootecnia').val()+"&txt_fzootecnia="+$('#txt_fzootecnia').val(),        		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Modificaci&oacute;n de firmas!!',
    			pnotify_text: 'Las firmas fueron modificadas',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Hubo un error intente de nuevo',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_contrato').focus();	
		
limpiar();
});


$("#btn_eliminar").click(function(event){
	event.preventDefault();	
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_clientes.php",
        data: "opcion=4&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),
        success: function(datos){

				$.pnotify({
			    pnotify_title: 'Cliente Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar();

});

function limpiar(){
			$('#txt_equimica').attr('value','');
			$('#txt_fquimica').attr('value','');
			$('#txt_emicro').attr('value','');
			$('#txt_fmicro').attr('value','');
			$('#txt_ebroma').attr('value','');
			$('#txt_fbroma').attr('value','');
			$('#txt_ezootecnia').attr('value','');
			$('#txt_fzootecnia').attr('value','');			
			$('#txt_contrato').attr('value','');
			$('#txt_contrato_buscar').attr('value','');
}

																   

})// JavaScript Document

					   
