  $(document).ready(function(){

 $("#encabezado").hide();

 function notificacion(titulo,cuerpo,tipo){
	$.pnotify({
	pnotify_title: titulo,
	  pnotify_text: cuerpo,
	  pnotify_type: tipo,
	  pnotify_hide: true
	}); 
  }   

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}

$("#ExcelExp").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#exportar").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});



  
  var URL ="";
  var buscardor_ubicacion = false;
  var guardar_ubicacion = false;
  
    //***************************************************Guarda el activo******************************************
$("#btn_guardar_activo").click(function(event){
		
		event.preventDefault();	
		if($("#txt_activo").val() =="" ) {  
        	notificacion("Error!!","Debes ingresar el nombre del activo","error"); 				        	
        	return false;  
    	} 

		if($("#txt_placa").val() =="" ) {  
        	notificacion("Error!!","Debes ingresar la placa del activo","error"); 				        	
        	return false;  
    	}  
		
		var estado 		=  $("#cmb_estado option:selected").val();
		var ubicacion 	= $("#cmb_ubicacion option:selected").val();
		var categoria 	= $("#cmb_categoria option:selected").val();
		var marca 		= $("#cmb_marca option:selected").val();
		var responsable = $("#cmb_res option:selected").val();
		var metodo      ="";
		var parametros  ="";
		var precio      = 0;
		var usuario     =$("#USUARIO").val();
		var prestamo    =$("#cmb_pres option:selected").val();
		var oaf			=$("#cmb_oaf option:selected").val();
		var moneda			=$("#cmb_moneda option:selected").val();
		
		if($("#txt_precio").val() != 0){
			precio = $("#txt_precio").val();
		}
		
			
		if($('#tipo_query').val() == 0){
		
			parametros = $('#tipo_query').val() + "|" + $("#txt_activo").val()  + "|" +  estado 
			+ "|" + ubicacion + "|" + categoria + "|" + marca 
			+ "|" +  $("#txt_modelo").val() + "|" +  $("#txt_serie").val() + "|" + $("#txt_desc").val() 
			+ "|" +  $("#txt_placa").val() + "|" +  precio + "|" + $("#txt_documento").val() + "|" +  usuario + "|" + responsable + "|" + prestamo  + "|" +  oaf  + "|" + $("#txt_factura").val() + "|" + $("#cmb_moneda").val() ;
		
			metodo = "guarda_activo";
		}else{
		
			parametros = $('#tipo_query').val() + "|" + $("#txt_activo").val()  + "|" +  estado 
			+ "|" + ubicacion + "|" + categoria + "|" + marca 
			+ "|" +  $("#txt_modelo").val() + "|" +  $("#txt_serie").val() + "|" + $("#txt_desc").val() 
			+ "|" +  $("#txt_placa").val() + "|" +  precio + "|" + $("#txt_documento").val() + "|" +  usuario + "|" + responsable + "|" + prestamo  + "|" +  oaf  + "|" + $("#txt_factura").val()+ "|" + $("#cmb_moneda").val() ;
		
			metodo = "actualiza_activo";
		}
	
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","El activo fue guardado correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_activos.php")},1000);   						
		}else if (datos["resultado"]=="EXISTE"){
				notificacion("Mensaje Enviado!!","Este activo posee el mismo numero de placa que otro activo.","error"); 				
		}else{
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});//end ajax function			
		
});
 
 
 
 $("#txt_precio").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
 
 $("#btn_cancelar_activo").on("click", function() {
		window.location.assign("lista_activos.php");
})
 
 /*********************************************UBICACION*********************************************************/
 
$("#busca_ubi").on("click", function() {
	
	if(buscardor_ubicacion==false){
		$("#div_ubicacion_buscar").css('display','inline');
		$("#titulo_buscador_ubicacion").text("Cerrar buscador");
		$("#div_ubicacion_guardar").css('display','none');
		$("#titulo_crear_ubicacion").text("Crear Ubicación");
		buscardor_ubicacion= true;
		guardar_ubicacion= false;
	}else{
		window.location.assign("lista_ubicacion.php");

	}


})

$('#busca_ubi').hover(function() {
        $(this).css('cursor','pointer');
});

      
$("busca_ubi").mouseout(function(){
  $("titulo_buscador_ubi").css("text-decoration","underline");
  $("titulo_buscador_ubi").css("color","#2E2EFE");
}); 


/////////////////////////////////////////////////////////////

$("#guardar_ubi").on("click", function() {

		$("#div_ubicacion_guardar").css('display','inline');
		$("#div_ubicacion_buscar").css('display','none');
		buscardor_ubicacion= false;
		$("#tabla_datos").css('display','none');
		$("#div_menu").css('display','none');


})


$("#btn_cancelar_ubicacion").on("click", function() {

		window.location.assign("lista_ubicacion.php");


})


$("#btn_cancelar_eliminar_ubicacion").on("click", function() {
		window.location.assign("lista_ubicacion.php");
})


$('#guardar_ubi').hover(function() {
        $(this).css('cursor','pointer');
});

      
$("guardar_ubi").mouseout(function(){
  $("titulo_crear_ubicacion").css("text-decoration","underline");
  $("titulo_crear_ubicacion").css("color","#2E2EFE");
}); 



/////////////////////////////////////////////////////////////////////////

$("#btn_guardar_ubicacion").click(function(event){
	
	if($('#txt_nombre_guardar').val()==""){
        notificacion("Error!!","Debes ingresar una ubicación","error"); 				        	
        return false;  
	}
	
	var parametros  ="";
	var metodo ="";
	var usuario     =$("#USUARIO").val();
	
	if($('#tipo_query').val()==""){
		metodo = "guardar_ubicacion";
		parametros = $('#txt_nombre_guardar').val() + "|" + $('#txt_desc_ubi_guardar').val()  + "|" + usuario;
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La ubicacion fue guardado correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_ubicacion.php")},997);   						
		}else if (datos["resultado"]=="EXISTE"){
				notificacion("Error!!","Esta ubicacion ya existe.","error"); 
		}else if (datos["resultado"]=="ACTIVO"){
				notificacion("Error!!","Esta ubicacion esta siendo utilizada por un activo.","error"); 
				notificacion("Error!!","Para eliminarla tiene que des-seleccionarla de todos los activos que la posean.","error"); 
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
		
	
	}else if($('#tipo_query').val()=="E"){
		metodo = "actualizar_ubicacion";
		parametros =  $('#ID_UBI').val() + "|" + $('#txt_nombre_guardar').val() + "|" + $('#txt_desc_ubi_guardar').val() + "|" + usuario;
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La ubicacion fue guardado correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_ubicacion.php")},997);   						
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
	
	}else if($('#tipo_query').val()=="D"){
		metodo = "eliminar_ubicacion";
		parametros =  $('#ID_UBI').val() + "|" + usuario;
		
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La ubicacion fue eliminada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_ubicacion.php")},997);   						
		}else if (datos["resultado"]=="EXISTE"){
				var error = datos["resultado"];
				notificacion("Error!!","No se puede eliminar es ubicacion ya que esta siendo utilizada por un activo","error"); 
				notificacion("Error!!","Si desea eliminarla primero elimine todos los activos que estan asociadas con ella.","error"); 
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
	
	}
	
	
	
	
});

$("#txt_nombre_buscar_ubicacion").on('keypress', function (e) {
    if(e.which == 13) {
		if($('#tipo_query').val()==""){
			var parametros = $('#txt_nombre_buscar_ubicacion').val() + "|" + $('#txt_desc_ubi_buscar').val();
			metodo = "busqueda_ubicacion";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		}
    }
});

$("#txt_desc_ubi_buscar").on('keypress', function (e) {
        if(e.which == 13) {
		if($('#tipo_query').val()==""){
			var parametros = $('#txt_nombre_buscar_ubicacion').val() + "|" + $('#txt_desc_ubi_buscar').val();
			metodo = "busqueda_ubicacion";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		}
    }
});



 /*********************************************FIN UBICACION*********************************************************/



 /************************************************CATEGORIA*********************************************************/


$("#busca_cate").on("click", function() {
	
	if(buscardor_ubicacion==false){
		$("#div_categoria_buscar").css('display','inline');
		$("#titulo_buscador_categoria").text("Cerrar buscador");
		$("#div_categoria_guardar").css('display','none');
		$("#titulo_crear_categoria").text("Crear Ubicación");
		buscardor_ubicacion= true;
	}else{
		window.location.assign("lista_categoria.php");

	}


})

$('#busca_cate').hover(function() {
        $(this).css('cursor','pointer');
});

      
$("busca_cate").mouseout(function(){
  $("titulo_buscador_ubi").css("text-decoration","underline");
  $("titulo_buscador_ubi").css("color","#2E2EFE");
}); 


/////////////////////////////////////////////////////////////

$("#guardar_cate").on("click", function() {

		$("#div_categoria_guardar").css('display','inline');
		$("#div_categoria_buscar").css('display','none');
		buscardor_ubicacion= false;
		$("#tabla_datos").css('display','none');
		$("#div_menu").css('display','none');


})


$("#btn_cancelar_categoria").on("click", function() {

		window.location.assign("lista_categoria.php");


})


$("#btn_cancelar_eliminar_ubicacion").on("click", function() {
		window.location.assign("lista_categoria.php");
})


$('#guardar_cate').hover(function() {
        $(this).css('cursor','pointer');
});

      
$("guardar_cate").mouseout(function(){
  $("titulo_crear_categoria").css("text-decoration","underline");
  $("titulo_crear_categoria").css("color","#2E2EFE");
}); 



/////////////////////////////////////////////////////////////////////////

$("#btn_guardar_categoria").click(function(event){
	
	if($('#txt_nombre_guardar').val()==""){
        notificacion("Error!!","Debes ingresar una categoria","error"); 				        	
        return false;  
	}
	
	var parametros  ="";
	var metodo ="";
	var usuario     =$("#USUARIO").val();
	
	if($('#tipo_query').val()==""){
		metodo = "guardar_categoria";
		parametros = $('#txt_nombre_guardar').val() + "|" + $('#txt_desc_cate_guardar').val() + "|" + usuario;
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La categoria fue guardada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_categoria.php")},997);   						
		}else if (datos["resultado"]=="EXISTE"){
				notificacion("Error!!","Esta categoria ya existe.","error"); 
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
		
	
	}else if($('#tipo_query').val()=="E"){
		metodo = "actualizar_categoria";
		parametros =  $('#ID_CATE').val() + "|" + $('#txt_nombre_guardar').val() + "|" + $('#txt_desc_cate_guardar').val() + "|" + usuario;
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La categoria fue guardada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_categoria.php")},997);   						
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
	
	}else if($('#tipo_query').val()=="D"){
		metodo = "eliminar_categoria";
		parametros =  $('#ID_CATE').val() + "|" + usuario;
		
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La categoria fue eliminada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_categoria.php")},997);   						
		}else if (datos["resultado"]=="EXISTE"){
				var error = datos["resultado"];
				notificacion("Error!!","No se puede eliminar esta categoria ya que esta siendo utilizada por un activo","error"); 
				notificacion("Error!!","Si desea eliminarla primero elimine todos los activos que estan asociadas con ella.","error"); 
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
	
	}
	
	
	
	
});

$("#txt_nombre_buscar").on('keypress', function (e) {
    if(e.which == 13) {
		if($('#tipo_query').val()==""){
			var parametros = $('#txt_nombre_buscar').val() + "|" + $('#txt_desc_cate_buscar').val();
			metodo = "busqueda_categoria";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		}
    }
});

$("#txt_desc_cate_buscar").on('keypress', function (e) {
        if(e.which == 13) {
		if($('#tipo_query').val()==""){
			var parametros = $('#txt_nombre_buscar').val() + "|" + $('#txt_desc_cate_buscar').val();
			metodo = "busqueda_categoria";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		}
    }
});

 /************************************************FIN CATEGORIA*********************************************************/



 /************************************************MARCA*********************************************************/



$("#busca_marca").on("click", function() {
	
	if(buscardor_ubicacion==false){
		$("#div_marca_buscar").css('display','inline');
		$("#titulo_buscador_marca").text("Cerrar buscador");
		$("#div_ubicacion_marca").css('display','none');
		$("#titulo_crear_marca").text("Crear Marca");
		buscardor_ubicacion= true;
		guardar_ubicacion= false;
	}else{
		window.location.assign("lista_marca.php");

	}


})

$('#busca_marca').hover(function() {
        $(this).css('cursor','pointer');
});

      
$("busca_marca").mouseout(function(){
  $("titulo_buscador_ubi").css("text-decoration","underline");
  $("titulo_buscador_ubi").css("color","#2E2EFE");
}); 


/////////////////////////////////////////////////////////////

$("#guardar_marca").on("click", function() {

		$("#div_ubicacion_marca").css('display','inline');
		$("#div_marca_buscar").css('display','none');
		buscardor_ubicacion= false;
		$("#tabla_datos").css('display','none');
		$("#div_menu").css('display','none');


})


$("#btn_cancelar_marca").on("click", function() {

		window.location.assign("lista_marca.php");


})


$("#btn_cancelar_eliminar_ubicacion").on("click", function() {
		window.location.assign("lista_ubicacion.php");
})


$('#guardar_marca').hover(function() {
        $(this).css('cursor','pointer');
});

      
$("guardar_marca").mouseout(function(){
  $("titulo_crear_marca").css("text-decoration","underline");
  $("titulo_crear_marca").css("color","#2E2EFE");
}); 



/////////////////////////////////////////////////////////////////////////

$("#btn_guardar_marca").click(function(event){
	
	if($('#txt_nombre_guardar').val()==""){
        notificacion("Error!!","Debes ingresar una marca","error"); 				        	
        return false;  
	}
	
	var parametros  ="";
	var metodo ="";
	var usuario     =$("#USUARIO").val();
	if($('#tipo_query').val()==""){
		metodo = "guardar_marca";
		parametros = $('#txt_nombre_guardar').val() + "|" + $('#txt_desc_marca_guardar').val() + "|" + usuario;
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La marca fue guardada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_marca.php")},997);   						
		}else if (datos["resultado"]=="EXISTE"){
				notificacion("Error!!","Esta ubicacion ya existe.","error"); 
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
		
	
	}else if($('#tipo_query').val()=="E"){
		metodo = "actualizar_marca";
		parametros =  $('#ID_MARCA').val() + "|" + $('#txt_nombre_guardar').val() + "|" + $('#txt_desc_marca_guardar').val() + "|" + usuario;
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La marca fue guardada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_marca.php")},997);   						
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
	
	}else if($('#tipo_query').val()=="D"){
		metodo = "eliminar_marca";
		parametros =  $('#ID_MARCA').val() + "|" + usuario;
		
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La marca fue eliminada correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_marca.php")},997);   						
		}else if (datos["resultado"]=="EXISTE"){
				var error = datos["resultado"];
				notificacion("Error!!","No se puede eliminar esta marca ya que esta siendo utilizada por un activo","error"); 
				notificacion("Error!!","Si desea eliminarla primero elimine todos los activos que estan asociadas con ella.","error"); 
		}else {
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo guardar los datos","error"); 														
		}
				
				
		}//end succces function
		});
	
	}
	
	
	
	
});

$("#txt_nombre_buscar").on('keypress', function (e) {
    if(e.which == 13) {
		if($('#tipo_query').val()==""){
			var parametros = $('#txt_nombre_buscar').val() + "|" + $('#txt_desc_marca_buscar').val();
			metodo = "busqueda_marca";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		}
    }
});

$("#txt_desc_marca_buscar").on('keypress', function (e) {
        if(e.which == 13) {
		if($('#tipo_query').val()==""){
			var parametros = $('#txt_nombre_buscar').val() + "|" + $('#txt_desc_marca_buscar').val();
			metodo = "busqueda_marca";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST", URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		}
    }
});








$('#lnk_busca_persona').hover(function() {
        $(this).css('cursor','pointer');
});

$("#btn_cancelar_persona").on("click", function() {
		window.location.assign("lista_personal.php");
});

$("#lnk_busca_persona").on("click", function() {
	
	if(buscardor_ubicacion==false){
		$("#div_busca_persona").css('display','inline');
		$("#titulo_busca_persona").text("Cerrar buscador");
		buscardor_ubicacion= true;
		guardar_ubicacion= false;
	}else{
		window.location.assign("lista_personal.php");

	}


});

$("#btn_guardar_persona").on("click", function() {
		
	if(	$('#txt_nombre_persona').val() ==""){
		notificacion("Error!!!","Por favor introduzca el nombre..","info"); 	
		return;	
	}
	
	var metodo = "";
	var parametros = "";
	var tipo="";	
	var usuario     =$("#USUARIO").val();
	var email		=$("#txt_email_persona").val();
	
	
	if(email!=""){
		if( !validateEmail(email)) { 
			notificacion("Error!!","Este email no es valido.","error"); 
			return;
		}
	}
	
	
	
	if($('#ACCION').val() ==""){
	
		metodo 					= "guardar_persona";
		tipo  					=  $("#cmb_iden_persona option:selected").val();
		parametros 				= $('#txt_nombre_persona').val() + "|" +  $('#txt_ident_persona').val() + "|" +  tipo + "|" +  $('#txt_desc_persona').val() + "|" + usuario + "|" + email;
		

		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if (resultado=="Success"){
						notificacion("Mensaje Enviado!!","Los datos se guardaron correctamente.","info"); 				
						setInterval(function(){window.location.assign("lista_personal.php")},997);   						
					}else if (resultado=="EXISTE"){
						var error = resultado;
						notificacion("Error!!","Esta persona ya existe en base de datos.","error"); 
					}else {
						var error = resultado;
						notificacion("Error!!","No se pudo guardar los datos","error"); 														
					}
			
				}
			}

			xmlhttp.open("POST", URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);		 		
		
	
	}else if($('#ACCION').val() =="E"){
		metodo 					= "actualizar_persona";
		tipo  					=  $("#cmb_iden_persona option:selected").val();
		parametros 				=$('#ID').val() + "|" + $('#txt_nombre_persona').val() + "|" +  $('#txt_ident_persona').val() + "|" +  tipo + "|" +  $('#txt_desc_persona').val() + "|" + usuario + "|" + email;
		
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if (resultado=="Success"){
						notificacion("Mensaje Enviado!!","Los datos se guardaron correctamente.","info"); 				
						setInterval(function(){window.location.assign("lista_personal.php")},997);   						
					}else if (resultado=="EXISTE"){
						var error = resultado;
						notificacion("Error!!","Esta persona ya existe en base de datos.","error"); 
					}else {
						var error = resultado;
						notificacion("Error!!","No se pudo guardar los datos","error"); 														
					}
			
				}
			}

			xmlhttp.open("POST", URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);		

	}else if($('#ACCION').val() =="D"){
		metodo 					= "eliminar_persona";
		parametros 				= $('#ID').val() + "|" + usuario;
		
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if (resultado=="Success"){
						notificacion("Mensaje Enviado!!","Los datos se eliminaron correctamente.","info"); 				
						setInterval(function(){window.location.assign("lista_personal.php")},997);   						
					}else if (resultado=="EXISTE"){
						var error = resultado;
						notificacion("Error!!","Esta persona tiene en estos momento un tramite de activo.","error"); 
						notificacion("Error!!","Si desea eliminarlo, elimine el tramite que posee de activos..","error"); 
					}else {
						var error = resultado;
						notificacion("Error!!","No se pudo eliminar los datos","error"); 														
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);		
		
	}
		
});


$("#txt_nombre_persona").on('keypress', function (e) {
    if(e.which == 13) {
		
			var parametros = $('#txt_nombre_persona').val() + "|" + $('#txt_identi_persona').val();
			metodo = "busqueda_persona";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		
    }
});


$("#txt_identi_persona").on('keypress', function (e) {
    if(e.which == 13) {
		
			var parametros = $('#txt_nombre_persona').val() + "|" + $('#txt_identi_persona').val();
			metodo = "busqueda_persona";
			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
			
		
    }
});



 /************************************************PEDIDO*********************************************************/

	
	
$(function() {

$.datepicker.regional['es'] =
{
 closeText: 'Cerrar',
 prevText: 'Previo',
 nextText: 'Próximo',
 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
 monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
 dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 initStatus: 'Selecciona la fecha', isRTL: false
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);


    $("#txt_fecha_pedido").datepicker();
    $('#txt_fecha_pedido').datepicker('option', {dateFormat: 'DD, d MM, yy'});
	
	$( "#datepicker" ).datepicker( $.datepicker.regional[ "es" ] );
	

	if( $('#FECHA_LARGA').val() !="" ){
		 $("input[name='txt_fecha_pedido']").val($('#FECHA_LARGA').val());
		 $("input[name='txt_fecha_pedido']").val($('#FECHA_LARGA').val());
	}
	
	
  });
  
 $('#txt_fecha_pedido').datepicker({
    onSelect: function(dateText, inst) {
	
	
	var dia = inst.selectedDay;
	var mes = (inst.selectedMonth) + 1;
	var ano = inst.selectedYear;
	
	var fecha = ano + "-" + (mes<10 ? '0' : '') + mes + '-' + (dia<10 ? '0' : '') + dia + " 00:00";
	
    $("input[name='FECHA']").val(fecha);
	
	if($('#ACCION').val() =="B"){
			var parametros = $('#txt_busca_nombre_pedido').val() + "|" + $('#txt_busca_activo_pedido').val()  + "|" +   $('#FECHA').val()  + "|" +
			$("#cmb_busca_activo_persona option:selected").val();
			
			metodo = "busqueda_pedido";			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST", URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
	
	}
	
	
	
    }
});


$('#btn_guardar_pedido').on("click", function() {
	
	var activo 		= $("#cmb_activo_pedido_guardar option:selected").val();
	var persona 	= $("#cmb_persona_pedido_guardar option:selected").val();
	var descripcion	= $('#txt_descripcion_pedido_guardar').val();
	var fecha		= $('#FECHA').val();
	var accion		= $('#ACCION').val();
	var ID			= $('#ID').val();
	
	if(activo==0){
        notificacion("Error!!","Por favor, seleccione un activo","error"); 				        	
        return false;  
	}
	
	if(persona==0){
        notificacion("Error!!","Por favor, seleccione un responsable","error"); 				        	
        return false;  
	}
	
	if(descripcion==0){
        notificacion("Error!!","Por favor, añada una descripcion","error"); 				        	
        return false;  
	}
	
	if(descripcion==0){
        notificacion("Error!!","Por favor, añada una fecha para la peticion","error"); 				        	
        return false;  
	}
	
	
	if(accion==""){
		parametros  = activo + "|" + persona + "|" + descripcion + "|" + fecha;
		metodo		= "pedido_guardar";
		
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La peticion se creo correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_pedido.php")},1000);   						
		}else if (datos["resultado"]=="EXISTE"){
				var error = datos["resultado"];
				notificacion("Error!!","No se puede crear esta peticion debido a que ya fue solicitado","error"); 	
		}else{
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo procesar la peticion","error"); 														
		}
				
				
		}//end succces function
		});//end ajax function	
	}else if(accion=="E"){
	
		var estatus 	= $("#cmb_activo_pedido_estado option:selected").val();
		parametros  = ID + "|" + activo + "|" + persona + "|" + descripcion + "|" + fecha + "|" + estatus ;
		metodo		= "pedido_actualizar";
		
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La peticion se guardo correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_pedido.php")},1000);   						
		}else if(datos["resultado"]=="EXISTE"){
				notificacion("Error!!","Este activo este activo ya fue asignado a una persona.","error"); 				
		}else{
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo procesar la peticion","error"); 														
		}
				
				
		}//end succces function
		});//end ajax 
	}else if(accion=="D"){
	

		parametros  = ID;
		metodo		= "eliminar_pedido";
		
		$.ajax({
        type: "POST",
		async: false,
		dataType: "json",
        url: "../operaciones/Clase_Activo.php",
		data: "metodo=" + metodo + "&parametros="+parametros,
		 		
		success: function(datos){		
		if (datos["resultado"]=="Success"){
				notificacion("Mensaje Enviado!!","La peticion se borro correctamente.","info"); 				
				setInterval(function(){window.location.assign("lista_pedido.php")},1000);   						
		}else{
				var error = datos["resultado"];
				notificacion("Error!!","No se pudo procesar la peticion","error"); 														
		}
				
				
		}//end succces function
		});//end ajax 
	
	}
	
	
});


$("#lnk_busca_pedido").on("click", function() {
	
	if(buscardor_ubicacion==false){
		$("#div_busca_pedido").css('display','inline');
		$("#titulo_busca_pedido").text("Cerrar buscador");
		buscardor_ubicacion= true;
	}else{
		window.location.assign("lista_pedido.php");

	}


});

$("#btn_cancelar_pedido").on("click", function() {
		window.location.assign("lista_pedido.php");
});


$("#txt_busca_nombre_pedido").on('keypress', function (e) {
    if(e.which == 13) {
			
			var parametros = $('#txt_busca_nombre_pedido').val() + "|" + $('#txt_busca_activo_pedido').val()  + "|" +   $('#FECHA').val()  + "|" +
			$("#cmb_busca_activo_persona option:selected").val();
			
			metodo = "busqueda_pedido";			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);

	}
});


$("#txt_busca_activo_pedido").on('keypress', function (e) {
    if(e.which == 13) {
			
			var parametros = $('#txt_busca_nombre_pedido').val() + "|" + $('#txt_busca_activo_pedido').val()  + "|" +   $('#FECHA').val()  + "|" +
			$("#cmb_busca_activo_persona option:selected").val();
			
			metodo = "busqueda_pedido";			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST", URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);

	}
});

$("#cmb_busca_activo_persona").change(function(){
    var parametros = $('#txt_busca_nombre_pedido').val() + "|" + $('#txt_busca_activo_pedido').val()  + "|" +   $('#FECHA').val()  + "|" +
			$("#cmb_busca_activo_persona option:selected").val();
			
			metodo = "busqueda_pedido";			
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					resultado =xmlhttp.responseText;
				
					if(resultado == "ERROR"){
						alert('No se pudo procesar la consulta.');
						$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					
					}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					$('#tabla_datos').html('<span>No se encontraron datos para visualizar</span>');
					}else{
						$('#tabla_datos').html(resultado);
					}
			
				}
			}

			xmlhttp.open("POST",URL + "../operaciones/Clase_Activo.php" ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("metodo=" + metodo + "&parametros=" + parametros);
});
	

});