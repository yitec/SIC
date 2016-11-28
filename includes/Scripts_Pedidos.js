$(document).ready(function(){

$("#ver").fancybox({
        'width'       : '75%',
        'height'      : '75%',
        'autoScale'     : false,
        'transitionIn'    : 'fade',
        'transitionOut'   : 'fade',
        'type'        : 'iframe'
});
$("#ver1").fancybox({
        'width'       : '75%',
        'height'      : '75%',
        'autoScale'     : false,
        'transitionIn'    : 'fade',
        'transitionOut'   : 'fade',
        'type'        : 'iframe'
});     
$("#ver2").fancybox({
        'width'       : '75%',
        'height'      : '75%',
        'autoScale'     : false,
        'transitionIn'    : 'fade',
        'transitionOut'   : 'fade',
        'type'        : 'iframe'
});         

var nproductos=1;
$("#geco").hide();
$("#tipo_presupuesto").hide();
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


$('#productos_dinamicos').on('change', '.combos', function() {
  var numero=$(this).attr("numero");
  opcion=$("#cmb_compra_"+numero).val();    
  $("#detalle_"+numero).html('');
  agrega_inputs(numero,opcion);
});

$("#cmb_presupuesto").change(function(event){
  if ($("#cmb_presupuesto").val()=='SUMINISTROS'){
    $("#tipo_presupuesto").show();
  }else{
    $("#tipo_presupuesto").hide();
  }
});

/*$(".rnd_tpres").click(function() {  
        if($("#rnd_tpres").is(':checked')) {  
            alert($( "#rnd_tpres:checked" ).val());
        } else {  
            alert($( "#rnd_tpres:checked" ).val());
        }  
    });  */


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
  if($('#cmb_tipo_compra').val()==0){
    notificacion("Error","Debe seleccionar el tipo de compra","error"); 
    $('#cmb_tipo_compra').focus();
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
  
  parametros=$("#txt_consecutivo").val()+","+$("#txt_nombresoli").val()+","+$("#cmb_seccion").val()+
  ","+$("#txt_justificacion").val()+","+$("#rnd_geco").val()+","+$("#txt_cagrup").val()+
  ","+$("#txt_carti").val()+","+$("#txt_correo").val()+","+$("#txt_cantidad_lineas").val();	
	$.ajax({ 
    data: "metodo=crea_pedido&parametros="+parametros,
    type: "POST",
    async:false,
    dataType: "json",
    url: "operaciones/opr_pedidos.php",
    success: function (data){
      if (data['resultado']!="Success"){
      	notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");         
      }else{
        id_pedido=data.id_pedido;
      }//end if
	  }//end succces function
  });//end ajax function   

  
  for (i=1;i<=$("#txt_cantidad_lineas").val();i++){//Dependiendo de la cantida de articulos recorro los divs
		parametros=busca_valores(id_pedido,$("#cmb_compra_"+i).val(),i)     
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
    notificacion("Solicitud Guardada","La solicitud se almaceno con exito!!","info"); 
    setInterval(function(){window.location.assign("menu.php")},2000);   
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


/***********************************************Boton Aprobar todo un pedido**********************************************/
$("#btn_finalizar").click(function(){  
  if (confirm('Seguro que desea aprobar este pedido?')) {
    if ($("#cmb_presupuesto").val()=='SUMINISTROS'){
      parametros=$(this).attr('id_pedido')+','+$("#cmb_presupuesto").val()+','+$( "#rnd_tpres:checked" ).val();  
    } else {  
      parametros=$(this).attr('id_pedido')+','+$("#cmb_presupuesto").val();
    }  
  
  $.ajax({ 
      data: "metodo=aprueba_pedidost&parametros="+parametros,
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
  setInterval(function(){window.location.assign("listado_pedidos.php")},2000); 
  } else {
    return;
  }  
});

/***********************************************Boton Aprobar un articulo**********************************************/
$(".aprobara").live("click",function(event){ 
  if (confirm('Seguro que desea aprobar este articulo?')) {  

  parametros=$(this).attr('tabla')+','+$(this).attr('id_articulo');
  $.ajax({ 
      data: "metodo=aprueba_articulos&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");          
        }else{
          notificacion("Articulo Aprobado","El articulo se ha aprobado correctamente","info");          
        }
        }//end succces function
      });//end ajax function   
  
  } else {
    return;
  }  
});
/***********************************************Boton Rechazar un pedido**********************************************/
$(".btn_rechazart").live("click",function(event){ 
  
  var razon=prompt("Motivo del rechazo:","");
  if (razon != null) {
  parametros=$(this).attr('id_pedido')+'|'+razon;
  $.ajax({ 
      data: "metodo=rechaza_pedidost&parametros="+parametros,
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
      setInterval(function(){window.location.assign("listado_pedidos.php")},2000);   
  } else {
    return;
  }
});

/***********************************************Boton Rechazar un articulo**********************************************/
$(".rechazara").live("click",function(event){ 
  
  if (confirm('Seguro que desea aprobar este articulo?')) {    
  parametros=$(this).attr('tabla')+','+$(this).attr('id_articulo');
  $.ajax({ 
      data: "metodo=rechaza_articulos&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");          
        }else{
          notificacion("Articulo Rechazado","El articulo se ha rechazado correctamente","info");          
        }
        }//end succces function
      });//end ajax function
  } else {
    return;
  }
});

/***********************************************Boton eliminar un articulo**********************************************/
$(".eliminara").live("click",function(event){ 
  if (confirm('Seguro que desea eliminar este articulo?')) {  

  parametros=$(this).attr('tabla')+','+$(this).attr('id_articulo');
  $.ajax({ 
      data: "metodo=eliminar_articulos&parametros="+parametros,
      type: "POST",
      async:false,
      dataType: "json",
      url: "operaciones/opr_pedidos.php",
      success: function (data){
        if (data.resultado!="Success"){
         notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");          
        }else{
          notificacion("Articulo eliminado","El articulo se ha eliminado correctamente","info");  
          setInterval(function(){window.location.assign("listado_pedidos.php")},2000);         
        }
        }//end succces function
      });//end ajax function   
  
  } else {
    return;
  }  
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
  if (id_categoria==1){
    datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","+$("#txt_nombrere_"+i).val()+","+$("#txt_purezare_"+i).val()+","+$("#txt_gradore_"+i).val()+","+$("#txt_presentacionre_"+i).val()+","+$("#txt_condicionesre_"+i).val()+","+$("#txt_similarmre_"+i).val()+","+$("#txt_similarcre_"+i).val()+","+$("#txt_plazore_"+i).val()+","+$("#txt_otrosre_"+i).val()+","+$("#txt_proveedoresre_"+i).val()+","+$("#txt_cotizacionre_"+i).val()+","+$("#txt_montore_"+i).val();         
  }
  if (id_categoria==2){
    datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","+$("#txt_nombrega_"+i).val()+","+$("#txt_purezaga_"+i).val()+","+$("#txt_presentacionga_"+i).val()+","+$("#txt_plazoga_"+i).val()+","+$("#txt_otrosga_"+i).val()+","+$("#txt_proveedoresga_"+i).val()+","+$("#txt_cotizacionga_"+i).val()+","+$("#txt_montoga_"+i).val();         
  }
  if (id_categoria==3){
    datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","+$("#txt_nombrecri_"+i).val()+","+$("#txt_clasecri_"+i).val()+","+$("#txt_capacidadcri_"+i).val()+","+$("#txt_presentacioncri_"+i).val()+","+$("#txt_similarcri_"+i).val()+","+$("#txt_numerocri_"+i).val()+","+$("#txt_plazocri_"+i).val()+","+$("#txt_otroscri_"+i).val()+","+$("#txt_proveedorescri_"+i).val()+","+$("#txt_cotizacioncri_"+i).val()+","+$("#txt_montocri_"+i).val();         
  }
  if (id_categoria==4){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombrerep_"+i).val()+","
    +$("#txt_marcaequirep_"+i).val()+","
    +$("#txt_modeloequirep_"+i).val()+","
    +$("#txt_catalogorep_"+i).val()+","
    +$("#txt_representanterep_"+i).val()+","
    +$("#txt_garantiarep_"+i).val()+","
    +$("#txt_otrosrep_"+i).val()+","
    +$("#txt_proveedoresrep_"+i).val()+","
    +$("#txt_cotizacionrep_"+i).val()+","
    +$("#txt_montorep_"+i).val()+","
    +$("#txt_marcarep_"+i).val();  
  }
  if (id_categoria==5){
    datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombreequi_"+i).val()+","
    +$("#txt_representanteequi_"+i).val()+","
    +$("#txt_similarmarequi_"+i).val()+","
    +$("#txt_similarmodequi_"+i).val()+","
    +$("#txt_similarcatequi_"+i).val()+","
    +$("#txt_plazoequi_"+i).val()+","
    +$("#txt_garantiafabequi_"+i).val()+","
    +$("#txt_garantiamanequi_"+i).val()+","
    +$("#txt_capacitacionequi_"+i).val()+","
    +$("#txt_instalacionequi_"+i).val()+","
    +$("#txt_lugarequi_"+i).val()+","
    +$("#txt_otrosequi_"+i).val()+","
    +$("#txt_proveedoresequi_"+i).val()+","
    +$("#txt_cotizacionequi_"+i).val()+","
    +$("#txt_montoequi_"+i).val();         
  }
  if (id_categoria==6){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombreremat_"+i).val()+","
    +$("#txt_similarmat_"+i).val()+","
    +$("#txt_similarcat_"+i).val()+","
    +$("#txt_plazomat_"+i).val()+","
    +$("#txt_otrosmat_"+i).val()+","
    +$("#txt_proveedorermat_"+i).val()+","
    +$("#txt_cotizacionmat_"+i).val()+","
    +$("#txt_montomat_"+i).val()+","
    +$("#"+i).val(); 
  }
  if (id_categoria==7){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombrerecal_"+i).val()+","
    +$("#txt_codcal_"+i).val()+","
    +$("#txt_placacal_"+i).val()+","
    +$("#txt_ubicacioncal_"+i).val()+","
    +$("#txt_lugarcal_"+i).val()+","
    +$("#txt_montocal_"+i).val()+","
    +$("#txt_otroscal_"+i).val()+","
    +$("#txt_proveedorescal_"+i).val()+","
    +$("#txt_cotizacioncal_"+i).val()+","
    +$("#"+i).val();         
  }
  if (id_categoria==8){
    datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombrerepa_"+i).val()+","
    +$("#txt_codrepa_"+i).val()+","
    +$("#txt_placarepa_"+i).val()+","
    +$("#txt_ubicacionrepa_"+i).val()+","
    +$("#txt_otrosrepa_"+i).val()+","
    +$("#txt_proveedoresrepa_"+i).val()+","
    +$("#txt_cotizacionrepa_"+i).val()+","
    +$("#txt_montorepa_"+i).val()+","
    +$("#"+i).val();         
  }
  if (id_categoria==9){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_analisisinte_"+i).val()+","
    +$("#txt_rondainte_"+i).val()+","
    +$("#txt_ontrointe_"+i).val()+","
    +$("#txt_proveedoresinte_"+i).val()+","
    +$("#txt_cotizacioninte_"+i).val()+","
    +$("#txt_montointe_"+i).val()+","  
    +$("#"+i).val();         
  }
  if (id_categoria==10){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombremed_"+i).val()+","
    +$("#txt_tipomed_"+i).val()+","
    +$("#txt_similarmarmed_"+i).val()+","
    +$("#txt_similarcatmed_"+i).val()+","
    +$("#txt_plazomed_"+i).val()+","
    +$("#txt_presentacionmed_"+i).val()+","
    +$("#txt_otrosmed_"+i).val()+","
    +$("#txt_proveedoresmed_"+i).val()+","
    +$("#txt_cotizacionmed_"+i).val()+","
    +$("#txt_montomed_"+i).val(); 
  }
  if (id_categoria==11){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_nombresoft_"+i).val()+","
    +$("#txt_desarrolladorsoft_"+i).val()+","
    +$("#txt_versionsoft_"+i).val()+","
    +$("#txt_otrossoft_"+i).val()+","
    +$("#txt_proveedoressoft_"+i).val()+","
    +$("#txt_cotizacionsoft_"+i).val()+","
    +$("#txt_montosoft_"+i).val()+","
    +$("#"+i).val();
  }
  if (id_categoria==12){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_proveedorcapa_"+i).val()+","
    +$("#txt_temacapa_"+i).val()+","
    +$("#txt_fechacapa_"+i).val()+","
    +$("#txt_costocapa_"+i).val()+","
    +$("#txt_cotizacioncapa_"+i).val()+","
    +$("#txt_otroscapa_"+i).val()+","
    +$("#txt_provinvicapa_"+i).val()+","
    +$("#"+i).val();
  }
  if (id_categoria==13){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_temains_"+i).val()+","
    +$("#txt_fechains_"+i).val()+","
    +$("#txt_costoins_"+i).val()+","
    +$("#txt_otrosins_"+i).val()+","
    +$("#txt_organizadoresins_"+i).val()+","    
    +$("#"+i).val();      

  }
  if (id_categoria==14){
     datos=id_pedido+","+id_categoria+","+$("#txt_cantidad_"+i).val()+","
    +$("#txt_tiporef_"+i).val()+","
    +$("#txt_presentacionref_"+i).val()+","
    +$("#txt_cotizacionref_"+i).val()+","
    +$("#txt_proveedoresref_"+i).val()+","
    +$("#"+i).val();    
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
  $('#productos_dinamicos').append('<div style="margin-top 50px; color: #ffffff;">&nbsp;&nbsp.:::::::::::::::::::::</div><br><br><br><br><br>');
  $('#productos_dinamicos').append('<div style="margin-top 50px;" class="lineaAzul"></div>');
  $('#productos_dinamicos').append('<div id="productos_'+nproductos+'"></div>');  
  $('#productos_'+nproductos).append('<h2 align="center" class="Arial18Morado">Articulo '+nproductos+'</h2>');
  //$('#productos_'+nproductos).append('<div id="comprade_'+nproductos+'"><div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br class="none"><div class="Arial14Morado subtitulosl fl">Tipo de compra: </div><div><select class="combos" id="cmb_compra_'+nproductos+'" numero="'+nproductos+'" name="cmb_compra_'+nproductos+'"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Cristalería</option><option value="4">Repuestos/Consumible de equipo</option><option value="5">Equipos</option><option value="6">Materiales Laboratorio</option><option value="7">Calibraciones</option><option value="8">Reparación o mantenimiento de equipo</option><option value="9">interlaboratoriales</option><option value="10">Medio de Cultivo</opcionption><option value="11">Software</option><option value="12">Capacitaciones</option><option value="13">Inscripciones, congresos etc</option><option value="14">Materiales de referencia</option></select></div><br>');
  $('#productos_'+nproductos).append('<div id="comprade_'+nproductos+'"><br class="none"><div class="Arial14Morado subtitulosl fl">Tipo de compra: </div><div><select class="combos" id="cmb_compra_'+nproductos+'" numero="'+nproductos+'" name="cmb_compra_'+nproductos+'"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Cristalería</option><option value="4">Repuestos/Consumible de equipo</option><option value="5">Equipos</option><option value="6">Materiales Laboratorio</option><option value="7">Calibraciones</option><option value="8">Reparación o mantenimiento de equipo</option><option value="9">interlaboratoriales</option><option value="10">Medio de Cultivo</opcionption><option value="11">Software</option><option value="12">Capacitaciones</option><option value="13">Inscripciones, congresos etc</option><option value="14">Materiales de referencia</option></select></div><br>');
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
+'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
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
    +'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
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
      +'<input  id="txt_presentacionga_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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
    +'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
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
      +'<input  id="txt_cotizacioncri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_montocri_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'
    

    +'</div>'
    +'<div>&nbsp;&nbsp;<br><br></div>';      
  }

  if (parseInt(opcion)==4){
    html=
    '<div id="repuestos_'+nproductos+'">'
    +'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
    +'<div class="Arial14Morado subtitulosl fl">Nombre Repuesto</div>'
    +'<div class="Arial14Morado subtitulosl fl">Marca Equipo</div>'
    +'<div class="Arial14Morado subtitulosl fl">Modelo Equipo</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombrerep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_marcaequirep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_modeloequirep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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
    +'<div class="Arial14Morado subtitulosl fl">Marca Repuesto</div>'    
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionrep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_montorep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
      +'<input  id="txt_marcarep_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'</div>'
    +'<div>&nbsp;&nbsp;</div>';      
  }    

  if (parseInt(opcion)==5){
    html=
    '<div id="equipos_'+nproductos+'">'
    +'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
    +'<div class="Arial14Morado subtitulosl fl">Nombre</div>'
    +'<div class="Arial14Morado subtitulosl fl">Representantes CR</div>'
    +'<div class="Arial14Morado subtitulosl fl">Similar a marca</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombreequi_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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

    +'</div><br><br>'
    +'<div>&nbsp;&nbsp;<br><br></div>';      
  }

  if (parseInt(opcion)==6){
    html=
    '<div id="materiales_'+nproductos+'">'
    +'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
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
      +'<input  id="txt_cotizacionmat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_montomat_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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

    +'<div class="Arial14Morado subtitulosl fl">Calibración acreditada INTE-ISO/IEC 17025</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'    
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div  class=" fl input25">'
      +'<span class="Arial14Negro">No</span><input type="radio" value="0" id="rnd_acreditadocal_'+nproductos+'" name="rnd_acreditadocal_'+nproductos+'" ><span class="Arial14Negro">S&iacute;</span><input type="radio" value="1" id="rnd_acreditadocal_'+nproductos+'" name="rnd_acreditadocal_'+nproductos+'">'      
    +'</div>'
    +'<div  class="fl input25">&nbsp;&nbsp;'      
    +'</div>'
    +'<div  class=" fl input25">&nbsp;&nbsp;'      
    +'</div>'

    +'</div><br><br>'
    +'<div>&nbsp;&nbsp;<br><br></div>';      
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
    +'<div class="Arial14Morado subtitulosl fl">Ronda INTE-ISO/IEC 17043</div>'
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
      +'<input  id="txt_similarcatmed_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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

    +'</div><br><br>'
    +'<div>&nbsp;&nbsp;<br><br></div>';      
  }

if (parseInt(opcion)==11){
    html=
    '<div id="software_'+nproductos+'">'
    +'<div align="left" class="Arial14Morado subtitulosl fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+'"" name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br>'
    +'<div class="Arial14Morado subtitulosl fl">Nombre del programa</div>'
    +'<div class="Arial14Morado subtitulosl fl">Desarrollador</div>'
    +'<div class="Arial14Morado subtitulosl fl">Versión</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_nombresoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_desarrolladorsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_versionsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Otros detalles</div>'
    +'<div class="Arial14Morado subtitulosl fl">Proveedores a invitar</div>'
    +'<div class="Arial14Morado subtitulosl fl"># de cotización</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_otrossoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_proveedoressoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'      
    +'</div>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_cotizacionsoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'

    +'<div class="Arial14Morado subtitulosl fl">Monto</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_montosoft_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<div  class=" fl input25">&nbsp;&nbsp;'        
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
      +'<input  id="txt_provinvicapa_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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
    +'<div class="Arial14Morado subtitulosl fl">Organizadores</div>'
    +'<div class="Arial14Morado subtitulosl fl">&nbsp;&nbsp;</div><br>'
    +'<div  class=" fl input25">'
      +'<input  id="txt_otrosins_'+nproductos+'"    value="" class="inputbox"  type="text" />'
    +'</div>'
    +'<div  class="fl input25">'
      +'<input  id="txt_organizadoresins_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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
      +'<input  id="txt_proveedoresref_'+nproductos+'"    value="" class="inputbox"  type="text" />'
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

