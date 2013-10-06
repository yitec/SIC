  $(document).ready(function(){
  
  
  //***************************************************Guardar categoria******************************************
$("#btn_guardar").click(function(event){
		
		event.preventDefault();	
		if($("#txt_nombre").val() =="" ) {  
        	notificacion("Error!!","Debes indicar un nombre","error"); 				        	
        	return false;  
    	}  
  
		
	var parametros=$("#txt_nombre").val();
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Calidad.php",
		data: "metodo=crea_categorias&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Nuevo Categoria!!","La categoria fue guardada exitosamente.","info"); 				
				setInterval(function(){window.location.assign("control_calidad.php")},2000);   						
		}else{
				notificacion("Error!!","La categoria ya existe","error"); 														
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_nombre').focus();	
		
		
limpiar();
});
  
  
  //***************************************************Guardar SUBcategoria******************************************
$("#btn_guardar_s").click(function(event){
		
		event.preventDefault();
		if($("#cmb_categoria").val()=="0"){
			notificacion("Error!!","Debes indicar una categoria","error"); 								
		}	
		if($("#txt_subcat").val() =="" ) {  
        	notificacion("Error!!","Debes indicar un nombre","error"); 			
        	return false;  
    	}  
  
		
	var parametros=$("#cmb_categoria").val()+","+$("#txt_subcat").val();
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Calidad.php",
		data: "metodo=crea_subcategorias&parametros="+parametros,
		 		
		success: function(datos){

		
		if (datos["resultado"]=="Success"){
			notificacion("Nueva SubCategoria!!","La Sub Categoria fue guardada exitosamente.","info"); 								
			setInterval(function(){window.location.assign("control_calidad.php")},2000);   						
		}else{
			notificacion("Error!!","La Sub Categoria ya existe","error"); 									
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_nombre').focus();	
		
		
limpiar();
});


//***************************************************Guardar Archivo******************************************
$("#guardar_archivo").click(function(event){
		
		event.preventDefault();	
		if($("#txt_nombre").length < 0) {  
			notificacion("Error!!","Debes Inidicar un nombre","error"); 						        	
        	return false;  
    	}  
  
		var archivo = subirArchivo('../operaciones/subir.php');

		var parametros=$("#txt_nombre").val()+','+$("#txt_version").val()+','+$("#cmb_categoria").val()+','+$("#cmb_subcategoria").val()+','+archivo;
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=crear_archivo&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]=="Success"){						
						notificacion("Nuevo Archivo!!","El archivo fue guardado exitosamente.","info"); 
						setInterval(function(){window.location.assign("control_calidad.php")},2000);   						
				}else{						
						notificacion("Error!!","El archivo ya existe","error"); 					
				}				
				}//end succces function
		});//end ajax function			
		
		
//limpiar();
}); 
   
//***************************************************Editar Categoria******************************************
$("#guardar_editar_categoria").click(function(event){
		
		event.preventDefault();	
		if($("#txt_nombre").length < 0) {  
			notificacion("Error!!","Debes indicar un nombre","error"); 						        	
        	return false;  
    	}  
  

		var parametros=$("#txt_nombre").val()+','+$("#cmb_categoria_edit").val();
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=editar_categoria&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]	=="Success"){
						notificacion("Nuevo Archivo!!","El nombre fue editado correctamente","info"); 												
						setInterval(function(){window.location.assign("control_calidad.php")},2000);   						
				}else{
					notificacion("Error!!","El nombre ya existe","error"); 												
				}
						
				
				}//end succces function
		});//end ajax function			
		
		
//limpiar();
});

//***************************************************Eliminar Categoria******************************************
$("#eliminar_categoria").click(function(event){
		
		event.preventDefault();	
		 {  
        	if (confirm('¿Desea eliminar la categoría?')) {
				var parametros=$("#txt_nombre").val()+','+$("#cmb_categoria_edit").val();
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=eliminar_categoria&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]	=="Success"){
						location.href=location.href;
						alert('Categoria Eliminada!');
						setInterval(function(){window.location.assign("control_calidad.php")},2000);   						
				}else{
						$.pnotify({
						pnotify_hide: true
						});
					
				}
						
				
				}//end succces function
		});//end ajax function	

} else { 				
		
}
} 		
//limpiar();
}); 


//***************************************************Editar Subcategoria******************************************
$("#guardar_editar_subcat").click(function(event){
		
		event.preventDefault();	
		if($("#txt_nombre").length < 0) {  
			notificacion("Error!!","Debes indicar un nombre","error"); 						        	
        	return false;  
    	}  
  

		var parametros=$("#txt_nombre").val()+','+$("#cmb_subcat_edit").val();
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=editar_subcategoria&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]	=="Success"){
					notificacion("Edición Correcta!!","La sub categoria se edito correctamente","info"); 																								
				}else{
						notificacion("Error!!","El nombre ya existe","error"); 						
					
				}
						
				
				}//end succces function
		});//end ajax function			
		
		
//limpiar();
}); 

//***************************************************Eliminar Categoria******************************************
$("#eliminar_subcategoria").click(function(event){
		
		event.preventDefault();	
		 {  
        	if (confirm('¿Desea eliminar la Subcategoría?')) {
				var parametros=$("#txt_nombre").val()+','+$("#cmb_subcat_edit").val();
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=eliminar_subcategoria&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]	=="Success"){
						location.href=location.href;
						alert('Categoria Eliminada!');
						setInterval(function(){window.location.assign("control_calidad.php")},2000);   						
				}else{
						$.pnotify({
						pnotify_hide: true
						});
					
				}
						
				
				}//end succces function
		});//end ajax function	

} else { 

				
		
}
} 		
//limpiar();
}); 

//***************************************************Rechazar Peticion******************************************
$("#btn_rechazar").click(function(event){
		
		event.preventDefault();	
		 {  
        	if (confirm('¿Desea rechazar la Solicitud?')) {
				var parametros=$("#btn_rechazar").val();
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=rechazar_peticion&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]	=="Success"){
						  location.href=location.href;
						alert('Solicitud Eliminada!');													
				}else{
						$.pnotify({
						pnotify_hide: true
						});
					
				}
						
				
				}//end succces function
		});//end ajax function	

} else { 

				
		
}
} 		
//limpiar();
}); 

//***************************************************Aceptar Peticion******************************************
$("#btn_aprobar").click(function(event){
		
		event.preventDefault();	
		 {  
        	if (confirm('¿Desea aceptar la Solicitud?')) {
				var parametros=$("#btn_aprobar").val()+','+$("#id_archivo").val()+','+$("#nuevo_archivo").val();
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=aceptar_peticion&parametros="+parametros,
					
			success: function(datos){

				if (datos["resultado"]	=="Success"){
						  location.href=location.href;
						alert('Solicitud Aceptada!');						
				}else{
						$.pnotify({
						pnotify_hide: true
						});
					
				}
						
				
				}//end succces function
		});//end ajax function	

} else { 

				
		
}
} 		
//limpiar();
}); 
   
   
 //***************************************************Modificar Archivo******************************************
$("#btn_guardar_p").click(function(event){
		
		event.preventDefault();	

  
		var archivo = subirArchivo('../operaciones/subirModificado.php');

		var parametros=$("#cmb_archivos").val()+','+$("#txt_comentario").val()+','+archivo;
		$.ajax({
			type: "POST",
			async: false,
			dataType: "json",
			url: "../operaciones/Clase_Calidad.php",
			data: "metodo=modificar_archivo&parametros="+parametros,	
			success: function(datos){

				if (datos["resultado"]	=="Success"){
						notificacion("Nuevo Archivo!!","El nombre fue guardado correctamente","info");					
				}else{
						notificacion("Error!!","El archivo ya existe","error"); 											
				}
				}//end succces function
		});//end ajax function			

//limpiar();
});    
  
  /***************************************Limpiar todos los campos***************************************/
  function limpiar(){
		$('#txt_nombre').attr('value','');
		$('#txt_subcat').attr('value','');
  }
  
  
  
  
  /************************************Tool Tip***********************************************************
  $( document ).tooltip({
		position: {
		  my: "center bottom-20",
		  at: "center top",
		  using: function( position, feedback ) {
			$( this ).css( position );
			$( "<div>" )
			  .addClass( "arrow" )
			  .addClass( feedback.vertical )
			  .addClass( feedback.horizontal )
			  .appendTo( this );
		  }
		}
  });
  */
  /************************************Notificaciones Jquery************************************************************/
  function notificacion(titulo,cuerpo,tipo){
	$.pnotify({
	pnotify_title: titulo,
	  pnotify_text: cuerpo,
	  pnotify_type: tipo,
	  pnotify_hide: true
	}); 
  }
  
  
  })// Document ready Final
  
  
  /****************************************Seleccionar SubCategorias*******************************************************/
  
$("#cmb_categoria").change(function(event){
	$.ajax({
		type: "POST",
		async: false,
		dataType: "json",
		url: "../operaciones/Clase_Calidad.php",
		data: "metodo=seleccionar_subCategoria&parametros="+$(this).val(),
				
		success: function(datos){
			$("#cmb_subcategoria").html(datos["resultado"]);
		}//end succces function
	});//end ajax function	
});


  /****************************************Seleccionar SubCategorias*******************************************************/
  
$("#cmb_subcategoria").change(function(event){
	$.ajax({
		type: "POST",
		async: false,
		dataType: "json",
		url: "../operaciones/Clase_Calidad.php",
		data: "metodo=seleccionar_archivos&parametros="+$(this).val(),
				
		success: function(datos){
			$("#cmb_archivos").html(datos["resultado"]);
		}//end succces function
	});//end ajax function	
});

//**************************************************Subir Archivo ***************************************************
function subirArchivo(url){
	
	var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
	var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
	var texto = '';
	var nombreArchivo = '';
	var data = new FormData();
	for(i=0; i<archivo.length; i++){
	data.append('archivo'+i,archivo[i]);	
	}
	data.append('texto',texto);

	$.ajax({
		url:url, //Url a donde la enviaremos
		type:'POST', //Metodo que usaremos
		contentType:false, //Debe estar en false para que pase el objeto sin procesar
		async: false,
		data:data, //Le pasamos el objeto que creamos con los archivos
		processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
		cache:false, //Para que el formulario no guarde cache
		/*success: function(data){
			nombreArchivo = data;

		}*/
	}).done(function(data){nombreArchivo = data})

	return nombreArchivo;
}

  /****************************************Ediar Categorias******************************************************
  
$("#cmb_categoria_edit").change(function(event){
	$.ajax({
		type: "POST",
		async: false,
		dataType: "json",
		url: "../operaciones/Clase_Calidad.php",
		data: "metodo=editar_Categoria&parametros="+$(this).val(),
				
		success: function(datos){
			$("#txt_categoria_edit").html('');
			$("#txt_categoria_edit").html(datos["resultado"]);
		}//end succces function
	});//end ajax function	
});*/