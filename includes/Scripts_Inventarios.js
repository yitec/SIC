
$(document).ready(function(){
		var cant;				   
		var bot;
//********cargo el vector de usuarios *********
		var availableTags;
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=5",
        success: function(datos){			
			 availableTags =datos;			
		}//end succces function
		});//end ajax function	
		availableTags=availableTags.split(",");
		$( "#txt_articulo_buscar" ).autocomplete({
			source: availableTags
		});
		
//oculto los divs de Cristaleria 
$("#cristaleria").hide();
$("#medios").hide();
$("#botellas").hide();
$("#detalles").hide();
$("#n_botellas").hide();

//despliego los divs de botellas y medios de cultivo
$("#cmb_categoria").change(function(event){
		$("#cristaleria").hide();
		$("#n_botellas").hide();
		$("#medios").hide();
	if ($("#cmb_categoria").val()==2 ){
		$("#cristaleria").show();	
	}
	if ($("#cmb_categoria").val()==20 ){
		$("#medios").show();
	}
})


//**********************************************
$("#btn_codigos").click(function(event){
		
		
		$("#mainGrisFondo").show();
		$("#botellas").show();		
		
		cant++;
		
		$("#linea"+cant).html('<td class="Arial14Negro" align="center" with="373"><input id="txt_codigo'+cant+'" class="inputboxPequeno" size="5" type="text" /></td><td class="Arial14Negro"  align="center" with="374"><input id="txt_volumen'+cant+'" class="inputboxPequeno" size="5" type="text" /></td>');

})


//**********************************************

$("#btn_codigosar").click(function(event){
		
		$("#botellas").empty();
		bot='<br /><span class="Arial18Azul">Ingrese los códigos de las botellas</span><br /><table><tr id="linea1"></tr><tr id="linea2"></tr><tr id="linea3"></tr><tr id="linea4"></tr><tr id="linea5"></tr><tr id="linea6"></tr><tr id="linea7"></tr><tr id="linea8"></tr><tr id="linea9"></tr><tr id="linea10"></tr><tr id="linea11"></tr><tr id="linea12"></tr><tr id="linea13"></tr><tr id="linea14"></tr><tr id="linea15"></tr><tr id="linea16"></tr><tr id="linea17"></tr><tr id="linea18"></tr><tr id="linea19"></tr><tr id="linea20"></tr></table>';
		$("#botellas").html(bot);		
		
		
		cant=$("#txt_cbotellas").val();
		for (i=1;i<=cant;i++) {
		$("#linea"+i).html('<td class="Arial14Negro" align="center" with="373">Código '+i+'</td><td class="Arial14Negro" align="center" with="373"><input id="txt_codigo'+i+'" class="inputboxPequeno" size="5" type="text" /></td><td class="Arial14Negro" align="center" with="373">Cantidad '+i+'</td><td class="Arial14Negro"  align="center" with="374"><input id="txt_volumen'+i+'" class="inputboxPequeno" size="5" type="text" /></td>');
		}
		$("#botellas").show();

})


//****************************************************actualiza dropdow articulos


$('#cmb_categoria').change(function(event){
	$('#cmb_nombrei').find('option').remove();
	$('#cmb_nombrei').append('<option value="'+0+'" >Seleccione</option>'); 					
	$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=10&valor="+$('#cmb_categoria').val(),
        success: function(datos){			
			var v_resultado=datos.split("|");
				for (i=1;i<v_resultado.length;i++) { 
					$('#cmb_nombrei').append('<option value="'+v_resultado[i]+'" >'+v_resultado[i]+'</option>'); 					
				} 
			 
		}//end succces function
		});//end ajax function	
	
});

//***************************************Actualizar existencia al cambiar el articulo*****************

$("#cmb_nombrei").change(function(event){

	event.preventDefault();	
	$("#actual").empty();
	$("#botellas").hide();
	$("#detalles").hide();	
	
	$.ajax({
        type: "POST",

		dataType: "json",
        url: "../operaciones/opr_inventario.php",
        data: "opcion=7&nombre="+$('#cmb_nombrei').val(),
        success: function(data){
		
		$("#actual").html('<table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="../img/azul_izquierda.png" /></td><td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Detalle del articulo<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div></td><td><img src="../img/azul_derecha.png" /></td></tr></table><table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2"><tr><td><div align="center" class="azulColumn">Existente</div></td><td><div align="center" class="azulColumn">Existencia mínima</div></td><td><div align="center" class="azulColumn">Unidades</div></td><td><div align="center" class="azulColumn">Ubicación</div><td><div align="center" class="azulColumn">Código</div></td></td></tr><tr><td align="center">'+data.existencia+'</td><td align="center">'+data.minima+'</td><td align="center">'+data.unidades+'</td><td align="center">'+data.ubicacion+'</td><td align="center">'+data.codigo+'</td></tr></table>');
		
		if (data.botellas==1){
		$("#botellas").show();
		$("#detalles").show();	
		if ($("#accion").val()=="restar"){	
			$("#mainGrisFondo").hide();	
		}
		if ($("#accion").val()=="sumar"){	
			$("#n_botellas").show();	
			$("#botellas").html('<table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="../img/azul_izquierda.png" /></td><td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Detalle del articulo<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div></td><td><img src="../img/azul_derecha.png" /></td></tr></table><table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2"><tr><td width="200"><div align="center" class="azulColumn">Código</div></td><td width="200"><div align="center" class="azulColumn">Cantidad Actual</div></td></td></tr></table>');
		
		var v_codigos=data.codigos.split(",");
		var v_existencia=data.volumenes.split(",");		
		var tot=v_codigos.length-1;
		cant=tot;
		$("#total_codigos").attr("value",tot);
		for (i=1;i<=tot;i++){
		$("#linea"+i).html('<td width="373" class="Arial14Negro"><div align="center" >'+v_codigos[i-1]+'</div></td><td width="374" class="Arial14Negro"><div align="center" >'+v_existencia[i-1]+'</div></td>');
		}
		
		
		}//end if sumar
		
		
		
		if ($("#accion").val()=="restar"){	
		$("#botellas").html('<table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="../img/azul_izquierda.png" /></td><td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Detalle del articulo<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div></td><td><img src="../img/azul_derecha.png" /></td></tr></table><table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2"><tr><td width="200"><div align="center" class="azulColumn">Código</div></td><td width="200"><div align="center" class="azulColumn">Cantidad Actual</div></td><td width="347"><div align="center" class="azulColumn">Cantidad a Retirar</div></td></td></tr></table>');
		
		var v_codigos=data.codigos.split(",");
		var v_existencia=data.volumenes.split(",");		
		var tot=v_codigos.length-1;
		cant=tot;
		$("#total_codigos").attr("value",tot);
		for (i=1;i<=tot;i++){
		$("#linea"+i).html('<td width="200" class="Arial14Negro"><div align="center" >'+v_codigos[i-1]+'</div></td><td width="200" class="Arial14Negro"><div align="center" >'+v_existencia[i-1]+'</div></td><td  width="345" ><div align="center" ><input id="txt_cantidadr'+i+'" codigo="'+v_codigos[i-1]+'" existencia='+v_existencia[i-1]+' class="inputboxPequeno" size="5" type="text" /></div></td>');
		}
		}//end if restar
		
		if ($("#accion").val()=="reporte"){	
		$("#botellas").html('<table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="../img/azul_izquierda.png" /></td><td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Detalle del articulo<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div></td><td><img src="../img/azul_derecha.png" /></td></tr></table><table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2"><tr><td width="200"><div align="center" class="azulColumn">Código</div></td><td width="200"><div align="center" class="azulColumn">Cantidad Actual</div></td></td></tr></table>');
		var v_codigos=data.codigos.split(",");
		var v_existencia=data.volumenes.split(",");		
		var tot=v_codigos.length-1;
		cant=tot;
		$("#total_codigos").attr("value",tot);
		for (i=1;i<=tot;i++){
		$("#linea"+i).html('<td width="373" class="Arial14Negro"><div align="center" >'+v_codigos[i-1]+'</div></td><td width="374" class="Arial14Negro"><div align="center" >'+v_existencia[i-1]+'</div></td>');
		
		}		
		}//end if reporte
		
		
		}else{
			$("#mainGrisFondo").show();	
		}//end if botellas
		
//		Existente = '+data.existencia+' Existencia Minima = '+ data.minima+ ' Ubicacion = '+data.ubicacion);
			
		
				
		}//end succces function
		});//end ajax function			





});


						   
//busca un item en el inventario
$("#btn_buscar_articulo").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=3&txt_articulo_buscar="+$('#txt_articulo_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			if(datos=="error"){
				$.pnotify({
			    pnotify_title: 'El articulo no se encontro',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			}else{
			var v_resultado=datos.split("|");
			$("#cmb_categoria option[value='"+v_resultado[0]+"']").attr("selected","selected");
			$('#txt_codigo').attr('value',v_resultado[1]);
			$('#txt_nombre').attr('value',v_resultado[2]);
			$('#txt_existenciam').attr('value',v_resultado[3]);
			$('#txt_ubicacion').attr('value',v_resultado[4]);
			$('#txt_unidades').attr('value',v_resultado[5]);
			$('#txt_existencia').attr('value',v_resultado[6]);
			if (v_resultado[7]==1){
				$("#rnd_botellas_1").attr('checked', 'checked');
			}else{
				$("#rnd_botellas_0").attr('checked', 'checked');				
			}
			$('#txt_cbotellas').attr('value',v_resultado[8]);
			$("#cmb_tipo option[value='"+v_resultado[9]+"']").attr("selected","selected");
			$('#txt_capacidad').attr('value',v_resultado[10]);
			$('#txt_presentacion').attr('value',v_resultado[11]);
			$('#txt_fabricante').attr('value',v_resultado[12]);
			$('#txt_referencia').attr('value',v_resultado[13]);
			$('#txt_lote').attr('value',v_resultado[14]);
			$('#txt_fecha').attr('value',v_resultado[15]);

			if ($("#cmb_categoria").val()==2 ){
				$("#cristaleria").show();	
			}
			if ($("#cmb_categoria").val()==20 ){
				$("#medios").show();
			}

			
				
			$('#opcion').attr('value','4');
			}
		}//end succces function
		});//end ajax function	
});						   
	
//***************************************************Guardar categori******************************************
$("#btn_guardarc").click(function(event){
		
		event.preventDefault();	
		if($("#txt_nombre").val() =="" ) {  
        	$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Debes indicar un nombre',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
        	return false;  
    	}  
  
		
	
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val(),        		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Categoria!!',
    			pnotify_text: 'La categoria fue guardada exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'La categoria ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_nombre').focus();	
		
		
limpiar();
});


//***************************************************Guardar nuevo articulo******************************************
$("#btn_guardara").click(function(event){
		var codigos,volumenes,amount,parametros,bot=0;
		event.preventDefault();	
		if($("#cmb_categoria").val()=="Seleccione"){
			message("Error","Debes indicar la categoria","error")
        	return false;  
		}
		
		if($("#txt_nombre").val() =="" || $("#txt_cantidad").val() ==""|| $("#txt_existencia").val() =="" ) {  
        	$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Debes indicar un nombre y cantidad',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
        	return false;  
    	} 
		if($("#cmb_categoria").val()=="2"&&$("#cmb_tipo").val()=="Seleccione"){
				$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Debe elegír el tipo de cristalería',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
		}    	 

		if($("#rnd_botellas_1").is(':checked')) {  
		if($("#txt_cbotellas").val()==""){
				$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'Marcaste Botellas, debes indicar el número',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
		}       
  
  		codigos=$("#txt_codigo1").val();
  		volumenes=$("#txt_volumen1").val();		
		amount=parseInt($("#txt_volumen1").val());
		bot++;
		for (i=2;i<=cant;i++){
			codigos=codigos+","+$("#txt_codigo"+i).val();
			volumenes=volumenes+","+$("#txt_volumen"+i).val();	
			amount=parseInt(amount)+parseInt($("#txt_volumen"+i).val());
			bot++;
		}
		if(amount!=$("#txt_existencia").val()){
				$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'El volumen de las botellas no es igual a la existencia',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
		}
		if(bot!=$("#txt_cbotellas").val()){
				$.pnotify({
			    pnotify_title: 'Error ',
    			pnotify_text: 'El numero de botellas no es igual al numero de codigos',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
        	return false;  
		}
		
		}//end if rnd_botellas
		
		
		
		if($('#opcion').val()==1){
//defino los parametros a pasa si hay mas datos los agrego a la cadena
		parametros="opcion=2&txt_nombre="+$('#txt_nombre').val()+"&cmb_categoria="+$('#cmb_categoria').val()+"&txt_codigo="+$('#txt_codigo').val()+"&txt_existenciam="+$('#txt_existenciam').val()+"&txt_ubicacion="+$('#txt_ubicacion').val()+"&txt_unidades="+$('#txt_unidades').val()+"&txt_existencia="+$('#txt_existencia').val()+"&txt_cbotellas="+$('#txt_cbotellas').val()+"&rnd_botellas="+$('input[name=rnd_botellas]:checked').attr('value')+"&codigos="+codigos+"&volumenes="+volumenes;
		//Verifico si es cristaleria o medios de cultivo
		if ($('#cmb_categoria').val()==2){
			parametros=parametros+"&cmb_tipo="+$("#cmb_tipo").val()+"&txt_capacidad="+$("#txt_capacidad").val()+"&txt_presentacion="+$("#txt_presentacion").val();
		}

		if ($('#cmb_categoria').val()==20){
			parametros=parametros+"&txt_fabricante="+$("#txt_fabricante").val()+"&txt_referencia="+$("#txt_referencia").val()+"&txt_lote="+$("#txt_lote").val()+"&txt_fecha="+$("#txt_fecha").val();
		}	
	
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: parametros,        		
		success: function(datos){
		alert(datos);	

		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Articulo!!',
    			pnotify_text: 'El articulo fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El articulo ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_nombre').focus();	
		}else{
			
			$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=4&txt_nombre="+$('#txt_nombre').val()+"&cmb_categoria="+$('#cmb_categoria').val()+"&txt_codigo="+$('#txt_codigo').val()+"&txt_existenciam="+$('#txt_existenciam').val()+"&txt_ubicacion="+$('#txt_ubicacion').val()+"&txt_unidades="+$('#txt_unidades').val()+"&txt_existencia="+$('#txt_existencia').val()+"&txt_cbotellas="+$('#txt_cbotellas').val()+"&rnd_botellas="+$('input[name=rnd_botellas]:checked').attr('value')+"&txt_articulo_buscar="+$('#txt_articulo_buscar').val(),        		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Articulo modificado!!',
    			pnotify_text: 'El articulo fue modificado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Ups sucedio un error',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
		}//end succces function
		});//end ajax function			
		
		}

		
limpiar_articulo();
});








//***************************************************Suma existencia a articulo******************************************
$("#btn_guardari").click(function(event){
		
		event.preventDefault();	
		var codigos,volumenes,amount;
		if($("#txt_cantidad").val() =="" ) {  
        	message('Error','Debes indicar una cantidad','error');
        	return false;  
    	}  


		tot=$("#total_codigos").val();
		
		//si es mayor a 1 significa que es tipo botella
		if(tot>=1){
		
		tot++;	
		codigos=$("#txt_codigo"+tot).val();
  		volumenes=$("#txt_volumen"+tot).val();
		amount=parseInt($("#txt_volumen"+tot).val());
		if( valida_codigo($("#txt_codigo"+tot).val())==0||valida_volumen($("#txt_volumen"+tot).val())==0  ){
			return false;	
		}
		
		tot++;
			
		
		for (i=tot;i<=cant;i++){
			codigos=codigos+","+$("#txt_codigo"+i).val();
			volumenes=volumenes+","+$("#txt_volumen"+i).val();	
			amount=amount+parseInt($("#txt_volumen"+i).val());
			if( valida_codigo($("#txt_codigo"+i).val())==0||valida_volumen($("#txt_volumen"+i).val())==0  ){
				return false;	
			}
		}
		
		if(amount>=1 ) { 
			if(amount!=$("#txt_cantidad").val()){
				message("Error","La cantidad debe coincidir con el total de volumen","error");
        		return false;  
			}	
			
				         	
    	}  
		
		}//end if tipo botella
		
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=8&cmb_nombrei="+$('#cmb_nombrei').val()+"&txt_id="+$('#txt_id').val()+"&txt_cantidad="+$('#txt_cantidad').val()+"&txt_cbotellas="+$('#txt_cbotellas').val()+"&codigos="+codigos+"&volumenes="+volumenes,        		
		success: function(datos){			
		if (datos=="Success"){
				message("Articulo Modificado","El articulo se modifico exitosamente","info");
		}else{
				message("Error","Sucedio un error, intente de nuevo","error");
			
		}
		}//end succces function
		});//end ajax function		
		limpiar_ingresoarticulo();	
		
});

//***************************************************Resta existencia a articulo******************************************
$("#btn_guardars").click(function(event){
		
		event.preventDefault();	
		var codigos,volumenes,reducir;
		
		
		
		cant=$("#total_codigos").val();
		codigos=$("#txt_cantidadr1").attr("codigo")+",";
  		volumenes=$("#txt_cantidadr1").attr("existencia")+",";		
  		reducir=$("#txt_cantidadr1").val()+",";				
		
		for (i=2;i<=cant;i++){
		codigos=codigos+$("#txt_cantidadr"+i).attr("codigo")+",";
		volumenes=volumenes+$("#txt_cantidadr"+i).attr("existencia")+",";	
		reducir=reducir+$("#txt_cantidadr"+i).val()+",";
		}
		
		
		$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=9&cmb_nombrei="+$('#cmb_nombrei').val()+"&txt_cantidad="+$('#txt_cantidad').val()+"&txt_codigo="+$('#txt_codigo').val()+"&txt_cbotellas="+$('#txt_cbotellas').val()+"&codigos="+codigos+"&volumenes="+volumenes+"&reducir="+reducir,        		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Articulo modificado!!',
    			pnotify_text: 'El articulo fue modificado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Ups sucedio un error',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
		}//end succces function
		});//end ajax function		
		limpiar_ingresoarticulo();	

});


//*************************************************Eliminar///////////////

$("#btn_eliminar").click(function(event){
	event.preventDefault();	
	$.ajax({
        type: "POST",
		async: false,
        url: "../operaciones/opr_inventario.php",
        data: "opcion=6&txt_articulo_buscar="+$('#txt_articulo_buscar').val(),
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
function limpiar_articulo(){
			$('#txt_codigo').attr('value','');
			$('#txt_nombre').attr('value','');
			$('#txt_existenciam').attr('value','');
			$('#txt_ubicacion').attr('value','');
			$('#txt_unidades').attr('value','');
			$('#txt_existencia').attr('value','');
			$('#txt_cbotellas').attr('value','');
			$('#txt_articulo_buscar').attr('value','');
			$('#txt_presentacion').attr('value','');
			$('#txt_capacidad').attr('value','');
			$('#txt_lote').attr('value','');
			$('#txt_referencia').attr('value','');
			$('#txt_fecha').attr('value','');
			$('#opcion').attr('value','1');	
			$("#cmb_tipo").attr("selected","Seleccione");
			$("#cmb_categoria option[value=Seleccione]").attr("selected","selected");
			$("#cmb_tipo option[value=Seleccione]").attr("selected","selected");			
			$("#botellas").hide();
			$("#cristaleria").hide();
}


//****************************************************Limpiar formulario de suma inventario
function limpiar_ingresoarticulo(){
	$("#actual").empty();
	$("#botellas").empty();
	$("#detalles").hide();
	$("#cmb_categoria option[value=Seleccione]").attr("selected","selected");
	$("#cmb_nombrei").find('option').remove();
	$('#txt_cantidad').attr('value','');
	$('#opcion').attr('value','1');	
	
}


//**********************************************************
function message(title,text,type){

				$.pnotify({
			    pnotify_title: title,
    			pnotify_text: text,
    			pnotify_type: type,
    			pnotify_hide: true
				});		

}

//**********************************************************
function valida_codigo(texto){
	var paso=1;
	var pos = texto.indexOf('.');
	if (pos<0){
		message('Error','El codigo debe contener un "."','info');
		paso=0;
	}else{
		total = texto.length;
		ant = texto.substring(0,pos);     // porcion = "Mundo"
		des = texto.substring(pos+1,total);     // porcion = "ndo"
		if (isNaN(ant)){
			paso=0;
			message('Error','El codigo debe tener ser "numeros.letras"','error');
		}else{
			paso=paso;
		}
		if (isNaN(des)){
			paso=paso;
		}else{
			paso=0;
			message('Error','El codigo debe tener ser "numeros.letras"','error');
		}
	}
		return paso;	
}


//**********************************************************
function valida_volumen(texto){
	var paso=1;	
		if (texto==""){
			paso=0;
			message('Error','Debe indicar el volumen','error');			
		}
		if (isNaN(texto)){
			paso=0;
			message('Error','El volumen debe ser numerico','error');
		}else{
			paso=paso;

		}
	
		return paso;	
}




																   

})// JavaScript Document

					   
