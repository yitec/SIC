
$(document).ready(function(){
						   
//********cargo el vector de usuarios *********
var availableTags;
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_proveedores.php",
        data: "opcion=5",
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
        url: "operaciones/opr_proveedores.php",
        data: "opcion=2&usuario="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			if(datos=="error"){
				$.pnotify({
			    pnotify_title: 'El cliente no se encontro',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			}else{
			var v_resultado=datos.split("|");
			$('#txt_nombre').attr('value',v_resultado[0]);
			$('#txt_cedula').attr('value',v_resultado[1]);
			$('#txt_correo').attr('value',v_resultado[2]);
			$('#txt_marcas').attr('value',v_resultado[3]);
			$('#txt_tel_cel').attr('value',v_resultado[4]);
			$('#txt_tel_fijo').attr('value',v_resultado[5]);
			$('#txt_fax').attr('value',v_resultado[6]);			
			$('#txt_nota').attr('value',v_resultado[7]);			
			$('#txt_contacto').val(v_resultado[8]); 			
			if (v_resultado[9]==1){
				$("#rnd_activo_1").attr('checked', 'checked');
			}else{
				$("#rnd_activo_0").attr('checked', 'checked');				
			}
				
			$('#opcion').attr('value','3');
			}
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		event.preventDefault();	
		if($("#txt_correo").val().indexOf('@', 0) == -1 || $("#txt_correo").val().indexOf('.', 0) == -1) {  
        	$.pnotify({
			    pnotify_title: 'Error en correo!!',
    			pnotify_text: 'Revisa el correo debe tener @ y un "."',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
        	return false;  
    	}  
  
		
		if($('#opcion').val()==1){			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_proveedores.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_correo="+$('#txt_correo').val()+"&txt_fax="+$('#txt_fax').val()+"&txt_direccion="+$('#txt_direccion').val()+"&txt_tel_fijo="+$('#txt_tel_fijo').val()+"&txt_tel_cel="+$('#txt_tel_cel').val()+"&cmb_tipo="+$('#cmb_tipo').val()+"&txt_consumible="+$('#txt_consumible').val()+"&txt_consumido="+$('#txt_consumido').val()+"&rnd_credito="+$('input[name=rnd_credito]:checked').attr('value'),        		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Proveedor!!',
    			pnotify_text: 'El proveedor fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El proveedor ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_codigo').focus();	
		}else{

		//modifico los datos del producto
		cadena="opcion=3&txt_nombre="+$('#txt_nombre').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_correo="+$('#txt_correo').val()+"&txt_marcas="+$('#txt_marcas').val()+"&txt_tel_cel="+$('#txt_tel_cel').val()+"&txt_tel_fijo="+$('#txt_tel_fijo').val()+"&txt_fax="+$('#txt_fax').val()+"&txt_nota="+$('#txt_nota').val()+"&txt_contacto="+$('#txt_contacto').val()+"&rnd_activo="+$('input[name=rnd_activo]:checked').attr('value')+"&txt_usuario_buscar="+$('#txt_usuario_buscar').val();
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_proveedores.php",
        data: cadena,		
		success: function(datos){

				$.pnotify({
			    pnotify_title: 'Proveedor Modificado',
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
        url: "operaciones/opr_proveedores.php",
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
			$('#txt_nombre').attr('value','');
			$('#txt_cedula').attr('value','');
			$('#txt_correo').attr('value','');
			$('#txt_tel_cel').attr('value','');
			$('#txt_tel_fijo').attr('value','');
			$('#txt_fax').attr('value','');
			$('#txt_marcas').attr('value','');
			$('#txt_contacto').attr('value','');
			$('#txt_nota').attr('value','');			
			$('#txt_usuario_buscar').attr('value','');						
			$('#opcion').attr('value','1');	
}

																   

})// JavaScript Document

					   
