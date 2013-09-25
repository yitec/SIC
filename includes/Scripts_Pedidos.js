$(document).ready(function(){


var nproductos=1;
llena_divs(1,0);



//loading del ajax
$("body").on({
    // When ajaxStart is fired, add 'loading' to body class
    ajaxStart: function() { 
        $(this).addClass("loading"); 
    },
    // When ajaxStop is fired, rmeove 'loading' from body class
    ajaxStop: function() { 
        $(this).removeClass("loading"); 
    }    
});

//despliego los divs de compra de:
$("#cmb_tipo").change(function(event){	
	if ($("#cmb_tipo").val()==5 ){
    $('#generico').html('');
		$("#productos_dinamicos").show();
    $("#agregar").show();
	}else{		
		$("#productos_dinamicos").hide();    
    $("#agregar").hide();
    $('#generico').html('');
    $('#generico').append('<div class="Arial14Morado subtitulosl fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulosl fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_g" id="txt_descripcion_g" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_observaciones_g" id="txt_observaciones_g" ></textarea></div>');
	}	
})

$('#productos_dinamicos').on('change', '.combos', function() {
  var numero=$(this).attr("numero");
  opcion=$("#cmb_compra_"+numero).val();    
  $("#detalle_"+numero).html('');
  agrega_inputs(numero,opcion);
});


/***********************************************Boton guardar pedido**********************************************/

$("#btn_siguiente").click(function(event){
		
	event.preventDefault();	
	var id_pedido,parametros,exito;
  exito=1;
	
	//guardo el pedido
  
  parametros=$("#txt_consecutivo").val()+","+$("#cmb_proveedor").val()+","+$("#txt_nombre").val()+","+$("#cmb_seccion").val()+","+$("#txt_asunto").val()+","+$("#txt_nom_proyecto").val()+","+$("#txt_num_proyecto").val()+","+$("#cmb_tipo").val();	
	$.ajax({ 
    data: "metodo=crea_pedido&parametros="+parametros,
    type: "POST",
    async:false,
    dataType: "json",
    url: "operaciones/opr_pedidos.php",
    success: function (data){
      if (data.resultado!="Success"){
      	notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error"); 
        
      }else{
        id_pedido=data.id_pedido;
      }//end if
	  }//end succces function
  });//end ajax function   

  if (parseInt($("#cmb_tipo").val())!=parseInt(5) ){
      parametros=id_pedido+","+$("#cmb_tipo").val()+",0,"+$("#txt_descripcion_g").val()+","+$("#txt_observaciones_g").val();
      $.ajax({ 
      data: "metodo=agrega_articulos&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
            notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error"); 
            exito=0;
        }else{
          id_pedido=data.id_pedido;
        }//end if      
      }//end succces function
      });//end ajax function   
  }else{      
	
  for (i=1;i<=$("#txt_cantidad_lineas").val();i++){//Dependiendo de la cantida de articulos recorro los divs
		parametros=busca_valores(id_pedido,$("#cmb_tipo").val(),i)     
		//guardo el detalle del pedido por articulo
    	$.ajax({ 
    	data: "metodo=agrega_articulos&parametros="+parametros,
    	type: "POST",
    	async:false,
    	dataType: "json",
    	url: "operaciones/opr_pedidos.php",
    	success: function (data){
      	if (data.resultado!="Success"){
      	 notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error"); 
         exito=0;
	  	  }
	  	  }//end succces function
    	});//end ajax function   
  
	}//end for
  }//end if  

  if (exito=1){
    notificacion("Solicitud Guardada","La solicitud se almaceno con exito!!","info"); 
    setInterval(function(){window.location.assign("menu.php")},2000);   
  }

});

/***********************************************Boton agregar un  item**********************************************/
$("#btn_agregar").click(function(){
  nproductos++;
  $("#txt_cantidad_lineas").attr('value',nproductos);  
  llena_divs(nproductos);  
});

/***********************************************Boton Aprobar**********************************************/
$("#btn_aprobar").click(function(){  
 parametros=$(this).attr('consecutivo')+',';
  $.ajax({ 
      data: "metodo=aprueba_pedidos&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");          
        }else{
          notificacion("Pedido Aprobado","El pedido se ha aprobado correctamente","info");          
        }
        }//end succces function
      });//end ajax function   
  setInterval(function(){window.location.assign("control_pedidos.php")},2000);   
});
/***********************************************Boton Rechazar**********************************************/
$("#btn_rechazar").click(function(){  
  
  var razon=prompt("Motivo del rechazo:","");
  parametros=$(this).attr('consecutivo')+'|'+razon;
  $.ajax({ 
      data: "metodo=rechaza_pedidos&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");          
        }else{
          notificacion("Pedido Rechazado","El pedido se ha rechazado correctamente","info");          
        }
        }//end succces function
      });//end ajax function
      setInterval(function(){window.location.assign("control_pedidos.php")},2000);   
});
/***********************************************Boton Entregar**********************************************/
$("#btn_entregar").click(function(){
 $("#txt_detalle").attr("consecutivo",$(this).attr("consecutivo")) ; 
 $( "#dialog-form" ).dialog( "open" );
});


/***********************************************Boton aprobar un  item**********************************************/
//$( "#consultar" ).on( "click", function() {
$('#listado').on('click', '.acciones', function() {  
    
    alert($(this).attr("id"));
    alert($(this).attr("consecutivo"));
});
/*$( "#aprobar" ).on( "click", function() {
alert("entro");
}
$( "#rechazar" ).on( "click", function() {
alert("entro");
}*/

$( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 350,
      width: 420,
      modal: true,
      buttons: {
        "Aceptar": function() {
          var parametros=$("#txt_detalle").val()+"|"+$("#txt_detalle").attr("consecutivo");
          $.ajax({ data: "metodo=entrega_pedidos&parametros="+parametros,
      type: "POST",
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function(data){ 
        if (data.resultado!="Success"){
          notificacion("Error","Intente de nuevo","error");         
        }else{
            notificacion("Pedido Entregado","El Expediente fue entregado exitosamente.","info");
            setInterval(function(){window.location.assign("control_pedidos.php")},2000);       
        }       
      } 
      });
          $( this ).dialog( "close" );
        },
        Cancelar: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        
      }
    });
/****************************************************Funciones*******************************************************/
/********************************************************************************************************************/
/********************************************************************************************************************/



function busca_valores(id_pedido,id_categoria,i){
	var datos;		
		datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","+$("#txt_descripcion_"+i).val()+","+$("#txt_observaciones_"+i).val()+","+$("#txt_equipo_"+i).val()+","+$("#txt_cequipo_"+i).val()+","+$("#txt_placa_"+i).val()+","+$("#txt_serie_"+i).val()+","+$("#txt_marca_"+i).val()+","+$("#txt_modelo_"+i).val()+","+$("#txt_presentacion_"+i).val()+","+$("#txt_p_"+i).val()+","+$("#txt_grado_"+i).val()+","+$("#txt_capacidad_"+i).val()+","+$("#txt_tipoc_"+i).val()+","+$("#txt_certificador_"+i).val()+","+$("#txt_volument_"+i).val();					
		return datos;	
}


function llena_divs(nproductos,opcion){

  $('#productos_dinamicos').append('<div class="lineaAzul"></div>');
  $('#productos_dinamicos').append('<div id="productos_'+nproductos+'"></div>');  
  $('#productos_'+nproductos).append('<h2 align="center" class="Arial18Morado">Artiulo '+nproductos+'</h2>');
  $('#productos_'+nproductos).append('<div id="comprade_'+nproductos+'"><div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br class="none"><div class="Arial14Morado subtitulosl fl">Compra de: </div><div><select class="combos" id="cmb_compra_'+nproductos+'" numero="'+nproductos+'" name="cmb_compra_'+nproductos+'"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Est&aacute;ndares</option><option value="4">Interlaboratoriales</option><option value="5">Cristaler&iacute;a</option><option value="6">Repuestos</option><option value="7">Consumible de equipos</option><option value="8">Muebler&iacute;a</option><option value="9">Equipo Descripci&oacute;n</option><option value="10">Medio de Cultivo</option><option value="11">Materiales y &uacute;tiles de laboratorio varios</option><option value="12">Materiales de Oficina</option><option value="13">Materiales de Limpieza</option><option value="14">Software</option></select></div><br>');
  $('#productos_dinamicos').append('<div id="detalle_'+nproductos+'"></div>');  
}

function agrega_inputs(nproductos,opcion){
  if (parseInt(opcion)==0){
   opcion=0; 
  }else if (parseInt(opcion)==1){
    $('#detalle_'+nproductos).append('<div id="reactivos_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Presentaci&oacute;n</div><div class="Arial14Morado subtitulosl fl">Pureza</div><br class="none"><div  class=" fl input25"><input  id="txt_presentacion_'+nproductos+'" name="txt_presentacion_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_p_'+nproductos+'"  name="txt_p_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><br class="none"></div>');
  }else if (parseInt(opcion)==2){
    $('#detalle_'+nproductos).append('<div id="gases_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Pureza</div><div class="Arial14Morado subtitulosl fl">Capacidad</div><br><div  class=" fl input25"><input  id="txt_p_'+nproductos+'" name="txt_p_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div><input  id="txt_capacidad_'+nproductos+'" name="txt_capacidad_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div class="Arial14Morado subtitulosl fl">Volumen Cilindro</div><div class="Arial14Morado subtitulosl fl">Tipo Conecci&oacute;n</div><br class="none"><div  class="fl input25"><input  id="txt_volument_'+nproductos+'"  name="txt_volument_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_tipoc_'+nproductos+'" name="txt_tipoc_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"></div>');
  }else if (parseInt(opcion)==3){
    $('#detalle_'+nproductos).append('<div id="gases_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Pureza</div><div class="Arial14Morado subtitulosl fl">Capacidad</div><br><div  class=" fl input25"><input  id="txt_p_'+nproductos+'" name="txt_p_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div><input  id="txt_capacidad_'+nproductos+'" name="txt_capacidad_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div class="Arial14Morado subtitulosl fl">Volumen Cilindro</div><div class="Arial14Morado subtitulosl fl">Tipo Conecci&oacute;n</div><br class="none"><div  class="fl input25"><input  id="txt_volument_'+nproductos+'"  name="txt_volument_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_tipoc_'+nproductos+'" name="txt_tipoc_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"></div>');
  }else if (parseInt(opcion)==4){
    $('#detalle_'+nproductos).append('<div id="interlaboratoriales_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Matriz</div><div class="Arial14Morado subtitulosl fl">Certificador</div><br class="none"><div  class="fl input25"><input  id="txt_matriz_'+nproductos+'"  name="txt_matriz_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_certificador_'+nproductos+'" name="txt_certificador_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br></div>');
  }else if (parseInt(opcion)==5){
    $('#detalle_'+nproductos).append('<div id="generico_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulosl fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_observaciones_'+nproductos+'" id="txt_observaciones_'+nproductos+'" ></textarea></div></div>');
  }else if (parseInt(opcion)==6){
    $('#detalle_'+nproductos).append('<div id="calibracion_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Equipo:</div><div class="Arial14Morado subtitulosl fl">C&oacute;digo Equipo:</div><div class="Arial14Morado subtitulosl fl">Marca:</div><br class="none"><div  class=" fl input25"><input  id="txt_equipo_'+nproductos+'" name="txt_equipo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_cequipo_'+nproductos+'"  name="txt_cequipo_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_marca_'+nproductos+'" name="txt_marca_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulosl fl">Modelo:</div><div class="Arial14Morado subtitulosl fl">Serie:</div><div class="Arial14Morado subtitulosl fl">Placa:</div><br class="none"><div  class=" fl input25"><input  id="txt_modelo_'+nproductos+'" name="txt_modelo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_serie_'+nproductos+'"  name="txt_serie_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_placa_'+nproductos+'" name="txt_placa_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulosl fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulosl fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_observaciones_'+nproductos+'" id="txt_observaciones_'+nproductos+'" ></textarea></div></div>');
  }else if (parseInt(opcion)==7){
    $('#detalle_'+nproductos).append('<div id="calibracion_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Equipo:</div><div class="Arial14Morado subtitulosl fl">C&oacute;digo Equipo:</div><div class="Arial14Morado subtitulosl fl">Marca:</div><br class="none"><div  class=" fl input25"><input  id="txt_equipo_'+nproductos+'" name="txt_equipo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_cequipo_'+nproductos+'"  name="txt_cequipo_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_marca_'+nproductos+'" name="txt_marca_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulosl fl">Modelo:</div><div class="Arial14Morado subtitulosl fl">Serie:</div><div class="Arial14Morado subtitulosl fl">Placa:</div><br class="none"><div  class=" fl input25"><input  id="txt_modelo_'+nproductos+'" name="txt_modelo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_serie_'+nproductos+'"  name="txt_serie_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_placa_'+nproductos+'" name="txt_placa_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulosl fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulosl fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div></div>');
  }else{
    $('#detalle_'+nproductos).append('<div id="generico_'+nproductos+'"><div class="Arial14Morado subtitulosl fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulosl fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_observaciones_'+nproductos+'" id="txt_observaciones_'+nproductos+'" ></textarea></div></div>');    
  }

}

function notificacion(titulo,cuerpo,tipo){
  $.pnotify({
  pnotify_title: titulo,
    pnotify_text: cuerpo,
    pnotify_type: tipo,
    pnotify_hide: true
  }); 
}



})// JavaScript Document

