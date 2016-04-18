$(document).ready(function(){


var nproductos=1;
$("#geco").hide();
if ($("#txt_cantidad_lineas").val()>1){
  var totl=parseInt($("#txt_cantidad_lineas").val());
  totl++;
  llena_divs(totl,0);  
  $("#txt_cantidad_lineas").attr("value",totl);  
}else{
  llena_divs(1,0);
}



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


$('#form_radio input').on('change', function() {
  if($('input[name=rnd_geco]:checked', '#form_radio').val()==1){
    $("#geco").show();
  }
  if($('input[name=rnd_geco]:checked', '#form_radio').val()==0){
    $("#geco").hide();
  }

   
});

//despliego los divs de compra de:
$("#cmb_tipo").change(function(event){	
	/*if ($("#cmb_tipo").val()==5 ){
    $('#generico').html('');
		$("#productos_dinamicos").show();
    $("#agregar").show();
	}else{		
		$("#productos_dinamicos").hide();    
    $("#agregar").hide();
    $('#generico').html('');
    $('#generico').append('<div class="Arial14Morado subtitulosl fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulosl fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_g" id="txt_descripcion_g" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_observaciones_g" id="txt_observaciones_g" ></textarea></div>');
	}	*/
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
	
  //validaciones
  if($('#cmb_tipo').val()==0){
    notificacion("Error","Debe seleccionar el tipo de pedido!!","error"); 
    $('#cmb_tipo').focus();
    return;
  }
  for (i=1;i<=$("#txt_cantidad_lineas").val();i++){
    if($('#cmb_compra_'+i).val()==0){
      notificacion("Error","Debe seleccionar el tipo de compra!!","error"); 
    $('#cmb_compra_'+i).focus();
    return;
    }
  }


	//guardo el pedido
  
  parametros=$("#txt_consecutivo").val()+","+$("#cmb_proveedor").val()+","+$("#txt_nombresoli").val()+","+$("#cmb_seccion").val()+","+$("#txt_justificacion").val()+","+$("#cmb_tipo_compra").val()+","+$("#rnd_geco").val()+","+$("#txt_cagrup").val()+","+$("#txt_carti").val()+",mizard6@yahoo.es";	
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

  
  for (i=1;i<=$("#txt_cantidad_lineas").val();i++){//Dependiendo de la cantida de articulos recorro los divs
		parametros=busca_valores(id_pedido,$("#cmb_tipo_compra").val(),i)     
		//guardo el detalle del pedido por articulo
    	$.ajax({ 
    	data: "metodo=agrega_articulos&parametros="+parametros,
    	type: "POST",
    	async:false,
    	dataType: "json",
    	url: "operaciones/opr_pedidos.php",
    	success: function (data){
      	if (data.resultado!="Success"){
      	 alert(data.resultado);
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error"); 
         exito=0;
	  	  }
	  	  }//end succces function
    	});//end ajax function   
  
	}//end for
  

  if (exito=1){
    notificacion("Solicitud Guardada","La solicitud se almaceno con exito!!","info"); 
    //setInterval(function(){window.location.assign("menu.php")},2000);   
  }

});

/***********************************************Boton guardar items de modificar pedido*****************************/

$("#btn_siguientem").click(function(event){
  exito=1;
  //al ser una modificacion debo empezar por los items que ya tiene + 1
  var inicial=parseInt($("#txt_cantidad_lineas").attr("inicial"));
  //inicial++;
  for (i=1;i<=$("#txt_cantidad_lineas").val();i++){
    if($('#cmb_compra_'+i).val()==0){
      notificacion("Error","Debe seleccionar el tipo de compra!!","error"); 
    $('#cmb_compra_'+i).focus();
    return;
    }
  }
  for (i=inicial;i<=$("#txt_cantidad_lineas").val();i++){//Dependiendo de la cantida de articulos recorro los divs
    parametros=busca_valores($("#txt_cantidad_lineas").attr("idpedido"),'5',i)     
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
if (exito=1){
    notificacion("Articulos Guardados","Los articulos se guardaron con exito!!","info"); 
    setInterval(function(){window.location.assign("modifica_pedido.php?id="+$("#txt_cantidad_lineas").attr("idpedido"))},2000);   
  }


});

/***********************************************Boton agregar un  item**********************************************/
$("#btn_agregar").click(function(){
  nproductos++;
  $("#txt_cantidad_lineas").attr('value',nproductos);  
  llena_divs(nproductos);  
});

/***********************************************Boton agregar un  item de pedido modificado*************************/
$("#btn_agregarm").click(function(){  
  var total=parseInt($("#txt_cantidad_lineas").val());
  total++;  
  llena_divs(total);  
  $("#txt_cantidad_lineas").attr("value",total);
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


/***********************************************Boton elimnar un  item**********************************************/

$('#listado_productos').on('click', '.eliminar', function() {        
  $( "#dialog-confirm" ).attr("idpedido",$(this).attr("idpedido"))
  $( "#dialog-confirm" ).attr("idregistro",$(this).attr("idregistro"))
    $( "#dialog-confirm" ).dialog( "open" );
    //eliminar_item($(this).attr("idregistro"),$(this).attr("idpedido"));
});


/******************************************Ventana Modal******************************************************/

$( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 200,
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
        $( this ).dialog( "close" );
      }
    });

/********************************************Confirm modal********************************************/
$(function() {
    $( "#dialog-confirm" ).dialog({
      autoOpen: false,
      resizable: false,
      height:200,
      modal: true,
      buttons: {
        "Aceptar": function() {
          eliminar_item($(this).attr("idregistro"),$(this).attr("idpedido"));
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });

/****************************************************Funciones*******************************************************/
/********************************************************************************************************************/
/********************************************************************************************************************/

function eliminar_item(id,pedido){
    parametros=id+',';
  $.ajax({ 
      data: "metodo=elimina_item&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");          
        }else{
          notificacion("Item eliminado","El fue eliminado del pedido","info");          
        }
        }//end succces function
      });//end ajax function
      setInterval(function(){window.location.assign("modifica_pedido.php?id="+pedido)},1500);   
}



function busca_valores(id_pedido,id_categoria,i){
	var datos;

  alert ($("#txt_consecutivo").val());
  alert ($("#txt_nombresoli").val());
  
  if (id_categoria==1){
    datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","+$("#txt_nombrere_"+i).val()+","+$("#txt_purezare_"+i).val()+","+$("#txt_gradore_"+i).val()+","+$("#txt_presentacionre_"+i).val()+","+$("#txt_condicionesre_"+i).val()+","+$("#txt_similarmre_"+i).val()+","+$("#txt_similarcre_"+i).val()+","+$("#txt_plazore_"+i).val()+","+$("#txt_otrosre_"+i).val()+","+$("#txt_proveedoresre_"+i).val()+","+$("#txt_cotizacionre_"+i).val()+","+$("#txt_montore_"+i).val();         
  }

    if ($("#cmb_compra_"+i).val()==1){
      /*alert ($("#txt_nombrere_"+i).val());
      alert ($("#txt_purezare_"+i).val());
      alert ($("#txt_gradore_"+i).val());*/
    }		
		//datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","+$("#txt_descripcion_"+i).val()+","+$("#txt_observaciones_"+i).val()+","+$("#txt_equipo_"+i).val()+","+$("#txt_cequipo_"+i).val()+","+$("#txt_placa_"+i).val()+","+$("#txt_serie_"+i).val()+","+$("#txt_marca_"+i).val()+","+$("#txt_modelo_"+i).val()+","+$("#txt_presentacion_"+i).val()+","+$("#txt_p_"+i).val()+","+$("#txt_grado_"+i).val()+","+$("#txt_capacidad_"+i).val()+","+$("#txt_tipoc_"+i).val()+","+$("#txt_certificador_"+i).val()+","+$("#txt_volument_"+i).val();					
		return datos;	
}


function llena_divs(nproductos,opcion){
  $('#productos_dinamicos').append('<div style="margin-top 50px; color: #ffffff;">&nbsp;&nbsp.:::::::::::::::::::::</div>');
  $('#productos_dinamicos').append('<div style="margin-top 50px;" class="lineaAzul"></div>');
  $('#productos_dinamicos').append('<div id="productos_'+nproductos+'"></div>');  
  $('#productos_'+nproductos).append('<h2 align="center" class="Arial18Morado">Articulo '+nproductos+'</h2>');
  $('#productos_'+nproductos).append('<div id="comprade_'+nproductos+'"><div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br class="none"><div class="Arial14Morado subtitulosl fl">Tipo de compra: </div><div><select class="combos" id="cmb_compra_'+nproductos+'" numero="'+nproductos+'" name="cmb_compra_'+nproductos+'"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Cristalería</option><option value="4">Repuestos/Consumible de equipo</option><option value="5">Equipos</option><option value="6">Materiales Laboratorio</option><option value="7">Calibraciones</option><option value="8">Reparación o mantenimiento de equipo</option><option value="9">interlaboratoriales</option><option value="10">Medio de Cultivo</opcionption><option value="11">Software</option><option value="12">Capacitaciones</option><option value="13">Inscripciones, congresos etc</option><option value="14">Materiales de referencia</option></select></div><br>');
  $('#productos_dinamicos').append('<div id="detalle_'+nproductos+'"></div>');  
}

function agrega_inputs(nproductos,opcion){
  
  if (parseInt(opcion)==0){
   opcion=0; 
  }else if (parseInt(opcion)==1){  
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==2){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==3){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==4){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==5){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==6){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==7){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==8){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));    
  }else if (parseInt(opcion)==9){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==10){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));    
  }else if (parseInt(opcion)==11){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==12){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==13){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else if (parseInt(opcion)==14){
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }else{
    $('#detalle_'+nproductos).append(getform(nproductos,opcion));
  }

}

/********************************************************
Obtengo el html del form segun la categoria
*********************************************************/
function getform(nproductos,opcion){
  var html;
  if (parseInt(opcion)==1){
    html=
 '<div id="reactivos_'+nproductos+'">'
+'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
+'<div class="Arial14Morado subtitulosl fl">Pureza</div>'
+'<div class="Arial14Morado subtitulosl fl">Grado</div><br>'
+'<div  class=" fl input25">'
  +'<input  id="txt_nombrere_'+nproductos+'" name="txt_nombrer_'+nproductos+'"   value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class="fl input25">'
  +'<input  id="txt_purezare_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class=" fl input25">'
  +'<input  id="txt_gradore_'+nproductos+'" name="txt_grado_'+nproductos+'"   value="" class="inputbox"  type="text" />'
+'</div>'

+'<div class="Arial14Morado subtitulosl fl">Presentación</div>'
+'<div class="Arial14Morado subtitulosl fl">Tipo de almacenamiento</div>'
+'<div class="Arial14Morado subtitulosl fl">Similar a marca</div><br>'
+'<div  class=" fl input25">'
  +'<input  id="txt_presentacionre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class="fl input25">'
  +'<input  id="txt_condicionesre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class=" fl input25">'
  +'<input  id="txt_similarmre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'

+'<div class="Arial14Morado subtitulosl fl">Similar # catálogo</div>'
+'<div class="Arial14Morado subtitulosl fl">Plazo de entrega</div>'
+'<div class="Arial14Morado subtitulosl fl">Otros detalles</div><br>'
+'<div  class=" fl input25">'
  +'<input  id="txt_similarcre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class="fl input25">'
  +'<input  id="txt_plazore_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class=" fl input25">'
  +'<input  id="txt_otrosre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'

+'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
+'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
+'<div class="Arial14Morado subtitulosl fl">Monto</div><br>'
+'<div  class=" fl input25">'
  +'<input  id="txt_proveedoresre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class="fl input25">'
  +'<input  id="txt_cotizacionre_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'
+'<div  class=" fl input25">'
  +'<input  id="txt_montore_'+nproductos+'"    value="" class="inputbox"  type="text" />'
+'</div>'

+'</div>'
+'<div>&nbsp;&nbsp;</div>';      

  }

  if (parseInt(opcion)==2){
    html=
    '<div id="gases_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Pureza</div>'
    +'<div class="Arial14Morado subtitulosl fl">Presentación</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrega_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_purezaga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_gradoga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Plazo entrega</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a Invitar</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazoga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otrosga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoresga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_montoga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;'
    +'</div>'
    

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }

  if (parseInt(opcion)==3){
    html=
    '<div id="cristaleria_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Clase</div>'
    +'<div class="Arial14Morado subtitulosl fl">Capacidad</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrecri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_clasecri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_capacidadcri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Presentación</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar a marca</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar # catalogo</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_presentacioncri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_similarcri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_numerocri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Plazo entrega</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros Detalles</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazocri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otroscri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedorescri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazocri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otroscri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'
    

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }

  if (parseInt(opcion)==4){
    html=
    '<div id="repuestos_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Marca</div>'
    +'<div class="Arial14Morado subtitulosl fl">Modelo</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrerep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_marcarep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_capacidadcri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl"># de catálogo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Representante(Equipo-Marca)</div>'
    +'<div class="Arial14Morado subtitulosl fl">Plazo de entrega</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_catalogorep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_representanterep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazorep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Garantia en meses</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_garantiarep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otrosrep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoresrep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazorep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otrosrep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }    

  if (parseInt(opcion)==5){
    html=
    '<div id="equipos_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Representantes CR</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar a marca</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrerequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_representanteequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_similarmarequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Similan a modelo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar # catálogo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Plazo de entrega</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_similarmodequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_similarcatequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazoequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Garantía en fabricación</div>'
    +'<div class="Arial14Morado subtitulosl fl">Garantía en mantenimiento</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Requiere capacitación</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_garantiafabequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_garantiamanequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_capacitacionequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Requiere instalación</div>'
    +'<div class="Arial14Morado subtitulosl fl">Lugar entrega</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_instalacionequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_lugarequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_otrosequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoresequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_cotizacionequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_montoequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'</div>';
  }

  if (parseInt(opcion)==6){
    html=
    '<div id="materiales_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar a marca</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar # catálogo</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombreremat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_similarmat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_similarcat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Plazo de entrega</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_plazomat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otrosmat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedorermat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'


    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoresequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_cotizacionequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>';
  }

  if (parseInt(opcion)==7){
    html=
    '<div id="calibraciones_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre equipo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Código</div>'
    +'<div class="Arial14Morado subtitulosl fl">Placa</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrerecal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_codcal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_placacal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Ubicación</div>'
    +'<div class="Arial14Morado subtitulosl fl">Lugar de calibración</div>'
    +'<div class="Arial14Morado subtitulosl fl">Monto</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_ubicacioncal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_lugarcal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_montocal_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'


    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'    
    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_otroscal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_proveedorescal_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacioncal_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Calibración acreditada</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div  class=" fl input25">'
      +'<span class="Arial14Negro">No</span><input type="radio" value="1" id="rnd_acreditadocal_'+nproductos+'" name="rnd_acreditadocal_'+nproductos+'" ><span class="Arial14Negro">S&iacute;</span><input type="radio" value="1" id="rnd_acreditadocal_'+nproductos+' name="rnd_acreditadocal_'+nproductos+'">'      
    +'</div>'
    +'<div  class="fl input25">&nbsp;&nbsp;'      
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>';
  }

  if (parseInt(opcion)==8){
    html=
    '<div id="reparaciones_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre equipo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Código</div>'
    +'<div class="Arial14Morado subtitulosl fl">Placa</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrerepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_codrepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_placarepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Ubicación</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_ubicacionrepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otrosrepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoresrepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'


    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionrepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_montorepa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>';
  }

    if (parseInt(opcion)==9){
    html=
    '<div id="interlaboratoriales_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Análisis solicitados</div>'
    +'<div class="Arial14Morado subtitulosl fl">Ronda Acreditada</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_analisisinte_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_rondainte_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_ontrointe_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div class="Arial14Morado subtitulosl fl">Monto</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoresinte_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_cotizacioninte_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_montointe_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }

if (parseInt(opcion)==10){
    html=
    '<div id="medios_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre del medio</div>'
    +'<div class="Arial14Morado subtitulosl fl">Tipo de medio</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar a marca</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombremed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_tipomed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_similarmarmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Similar # de catálogo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Plazo de entrega</div>'
    +'<div class="Arial14Morado subtitulosl fl">Presentación</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_similarmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_plazomed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_presentacionmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'


    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'    
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'    
    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_otrosmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_proveedoresmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_montomed_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'
    +'<div  class="fl input25">&nbsp;&nbsp;'      
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }

if (parseInt(opcion)==11){
    html=
    '<div id="software_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Nombre del programa</div>'
    +'<div class="Arial14Morado subtitulosl fl">Cantidad licencias</div>'
    +'<div class="Arial14Morado subtitulosl fl">Desarrollador</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombresoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_cantidadsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_desarrolladorsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Versión</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_versionsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_otrossoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedoressoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl"># de cotización</div>'
    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_montosoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }  

if (parseInt(opcion)==12){
    html=
    '<div id="capacitaciones_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Proveedor</div>'
    +'<div class="Arial14Morado subtitulosl fl">Tema capacitación</div>'
    +'<div class="Arial14Morado subtitulosl fl">Fecha</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_proveedorcapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_temacapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_fechacapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Costo</div>'
    +'<div class="Arial14Morado subtitulosl fl"># cotización</div>'
    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_costocapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_cotizacioncapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_otroscapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">&nbsp;&nbsp;'      
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>';
    +'<div>&nbsp;&nbsp;</div>';      
  }  

if (parseInt(opcion)==13){
    html=
    '<div id="inscripciones_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Tema/Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Fecha</div>'
    +'<div class="Arial14Morado subtitulosl fl">Costo</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_temains_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_fechains_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_costoins_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_costocapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_cotizacioncapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }

  if (parseInt(opcion)==14){
    html=
    '<div id="referencia_'+nproductos+'">'
    +'<div class="Arial14Morado subtitulosl fl">Tipo material</div>'
    +'<div class="Arial14Morado subtitulosl fl">Presentación</div>'
    +'<div class="Arial14Morado subtitulosl fl"># de cotización</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_tiporef_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_presentacionref_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionref_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_costocapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">&nbsp;&nbsp;'      
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }  

  return html;
}//end function

function notificacion(titulo,cuerpo,tipo){
  $.pnotify({
  pnotify_title: titulo,
    pnotify_text: cuerpo,
    pnotify_type: tipo,
    pnotify_hide: true
  }); 
}



})// JavaScript Document

