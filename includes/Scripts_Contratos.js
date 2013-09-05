
$(document).ready(function(){
						   
						   
$("#ver").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
});						   
						   

//********cargo el vector de nombres de clientes*********
var availableTags;
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=1",
        success: function(datos){			
			 availableTags =datos;			
		}//end succces function
		});//end ajax function	
		availableTags=availableTags.split(",");
		$( "#txt_nombre" ).autocomplete({
			source: availableTags
		});
		

$("#txt_nombre").live("focusout", function(event){		
			event.preventDefault();			
			
			$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_contratos.php",
        data: "opcion=7&nombre="+$('#txt_nombre').val(),
        success: function(datos){			

			$("#cmb_tipoPago").find("option[value='Credito']").remove();
			$("#cmb_tipoPago").find("option[value='Rebajar']").remove();			
			$("#cmb_tipoPago").find("option[value='Exonerado']").remove();	

			v_resultado=datos.split("|");

		$( "#txt_tipoCliente" ).attr('value',v_resultado[0]);
		if (v_resultado[3]==1){
			$('#cmb_tipoPago').append('<option value="Credito" selected="selected">Credito</option>');
		}		
		if (v_resultado[0]=="Investigacion"){
			$('#consumible').html('Cosumible = '+v_resultado[1]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
			$('#consumido').html('Cosumido = '+v_resultado[2]);	
			$('#cmb_tipoPago').append('<option value="Rebajar" selected="selected">Rebajar de consumible</option>');
			$('#txt_consumible').attr('value',v_resultado[1]);
			$('#txt_consumido').attr('value',v_resultado[2]);
		}
		if (v_resultado[0]=="Exonerado"){
			$('#cmb_tipoPago').append('<option value="Exonerado" selected="selected">Exonerado</option>');
		}
		
		
		
		
		
		}//end succces function
		});//end ajax function	
		
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
				$("#chk_amicro").attr("checked","checked");
			}
			if(v_resultado.indexOf("6")>=0){
				$("#chk_aquimi").attr("checked","checked");
			}			
			if(v_resultado.indexOf("7")>=0){
				$("#chk_abroma").attr("checked","checked");
			}			
			if(v_resultado.indexOf("8")>=0){
				$("#chk_rmicro").attr("checked","checked");
			}			
			if(v_resultado.indexOf("9")>=0){
				$("#chk_rquimi").attr("checked","checked");
			}					
			if(v_resultado.indexOf("10")>=0){
				$("#chk_rbroma").attr("checked","checked");
			}						
			if(v_resultado.indexOf("11")>=0){
				$("#chk_reportes").attr("checked","checked");
			}						
			if(v_resultado.indexOf("12")>=0){
				$("#chk_usuarios").attr("checked","checked");
			}			
			if(v_resultado.indexOf("13")>=0){
				$("#chk_clientes").attr("checked","checked");
			}						
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		var permisos=null;
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
		if ($("#chk_amicro").is(":checked")){
			permisos=permisos+","+5;	
		}
		if ($("#chk_aquimi").is(":checked")){
			permisos=permisos+","+6;	
		}
		if ($("#chk_abroma").is(":checked")){
			permisos=permisos+","+7;	
		}
		if ($("#chk_rmicro").is(":checked")){
			permisos=permisos+","+8;	
		}
		if ($("#chk_rquimi").is(":checked")){
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
		event.preventDefault();				  				
		if($('#opcion').val()==1){	
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos,        		
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
        data: "opcion=3&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos+"&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),		
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
	
	
}

																   

})// JavaScript Document

					   
