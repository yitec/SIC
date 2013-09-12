$(document).ready(function(){

//$("#productos").hide();	
//$("#comprade").hide();	
var nproductos=1;
oculta_divs();

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
		oculta_divs();
		$("#comprade").show();	
	}else{
		//$("#productos").hide();	
		$("#comprade").hide();
		oculta_divs();
		$("#generico").show();
	}	
})

$('#productos_dinamicos').on('change', '.combos', function() {
  var numero=$(this).attr("numero");
  opcion=$("#cmb_compra_"+numero).val();  
  despliega_divs(numero,opcion);  
});

//despliego los divs de cada articulo :
$("#cmb_compra_1").change(function(event){	
	var numero=$(this).attr("numero");
  opcion=$("#cmb_compra_"+numero).val();  
  despliega_divs(numero,opcion);  		
});

/***********************************************Boton guardar pedido**********************************************/

$("#btn_siguiente").click(function(event){
		
	event.preventDefault();	
	var id_pedido;
	
	//guardo el pedido
	var parametros=$("#txt_consecutivo").val()+","+$("#cmb_proveedor").val()+","+$("#txt_nombre").val()+","+$("#cmb_seccion").val()+","+$("#txt_asunto").val()+","+$("#txt_nom_proyecto").val()+","+$("#txt_num_proyecto").val()+","+$("#cmb_tipo").val();	
	$.ajax({ 
    data: "metodo=crea_pedido&parametros="+parametros,
    type: "POST",
    async:false,
    dataType: "json",
    url: "operaciones/opr_pedidos.php",
    success: function (data){
      if (data.resultado!="Success"){
      	notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error"); 
        id_pedido=data.id_pedido;
      }//end if      
	  }//end succces function
  });//end ajax function   
	
    //Dependiendo de la cantida de articulos recorro los divs
	for (i=1;i<=$("#txt_cantidad").val();i++){
		parametros=busca_valores(id_pedido,$("#cmb_tipo").val())

		//guardo el detalle del pedido por articulo
    	$.ajax({ 
    	data: "metodo=agrega_articulos&parametros="+parametros,
    	type: "POST",
    	async:false,
    	dataType: "json",
    	url: "operaciones/opr_pedidos.php",
    	success: function (data){
      	if (data.resultado=="Success"){
      	 notificacion("Pedido Creado","El pedido se ha creado correctamente","info");             	
	  	  }else{
	  		 notificacion("Error","Ha ocurrido un error, intente de nuevo!!","error");       
        }//end if
	  	  }//end succces function
    	});//end ajax function   

	}//end for


});

/***********************************************Boton agregar un  item**********************************************/
$("#btn_agregar").click(function(){
  //$("#productos:hidden").clone().appendTo("#2");  
  //$("productos2").clone().appendTo("productos3");
  nproductos++;
  $("#txt_cantidad_lineas").attr('value',nproductos);  
  llena_divs(nproductos);
  oculta_divs();
});


/*****************************************Funciones********************************/


function oculta_divs(){
	//$("#productos").hide();	
	//$("#comprade_"+nproductos).hide();	
	$("#reparacion_"+nproductos).hide();	
	$("#generico_"+nproductos).hide();		
	$("#reactivos_"+nproductos).hide();	
	$("#gases_"+nproductos).hide();	
	$("#estandar_"+nproductos).hide();	
	$("#interlaboratoriales_"+nproductos).hide();	
	$("#calibracion_"+nproductos).hide();
}

//depliega los div dependiendo de la opcion seleccionada en el div
function despliega_divs(numero,opcion){
  switch(opcion)
    {
      case "0":
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#generico_"+numero).hide();  
          $("#gases_"+numero).hide();
          $("#estandar_"+numero).hide();  
          $("#interlaboratoriales_"+numero).hide(); 
          $("#calibracion_"+numero).hide();   
        break;
      case "1":
          $("#reactivos_"+numero).show(); 
          $("#reparacion_"+numero).hide();
          $("#generico_"+numero).hide();  
          $("#gases_"+numero).hide();
          $("#estandar_"+numero).hide();  
          $("#interlaboratoriales_"+numero).hide(); 
          $("#calibracion_"+numero).hide();   
        break;
      case "2":
          $("#gases_"+numero).show();
          $("#generico_"+numero).hide();    
          $("#estandar_"+numero).hide();  
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#interlaboratoriales_"+numero).hide(); 
          $("#calibracion_"+numero).hide();   
        break;
        case "3":
          $("#estandar_"+numero).show();  
          $("#gases_"+numero).hide();
          $("#generico_"+numero).hide();              
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#interlaboratoriales_"+numero).hide(); 
          $("#calibracion_"+numero).hide();   
        break;
        case "4":
          $("#interlaboratoriales_"+numero).show();
          $("#gases_"+numero).hide();
          $("#generico_"+numero).hide();    
          $("#estandar_"+numero).hide();  
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();          
          $("#calibracion_"+numero).hide();     
        break;
        case "5":
          $("#generico_"+numero).show();  
          $("#gases_"+numero).hide();         
          $("#estandar_"+numero).hide();  
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#interlaboratoriales_"+numero).hide(); 
          $("#calibracion_"+numero).hide();   
        break;  
        case "6":
          $("#calibracion_"+numero).show(); 
          $("#gases_"+numero).hide();
          $("#generico_"+numero).hide();    
          $("#estandar_"+numero).hide();  
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#interlaboratoriales_"+numero).hide();           
        break;      
        case "7":
          $("#calibracion_"+numero).show(); 
          $("#gases_"+numero).hide();
          $("#generico_"+numero).hide();    
          $("#estandar_"+numero).hide();  
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#interlaboratoriales_"+numero).hide();           
        break;
      default:
          $("#generico_"+numero).show();
          $("#gases_"+numero).hide();         
          $("#estandar_"+numero).hide();  
          $("#reactivos_"+numero).hide(); 
          $("#reparacion_"+numero).hide();
          $("#interlaboratoriales_"+numero).hide(); 
          $("#calibracion_"+numero).hide();     
    }
}

function busca_valores(id_pedido,id_categoria){
	var datos;		
		datos=id_pedido+","+id_categoria+","+$("#txt_cantidad"+i).val()+","+$("#txt_descripcion_"+i).val()+","+$("#txt_observaciones_"+i).val()+","+$("#txt_equipo_"+i).val()+","+$("#txt_cequipo_"+i).val()+","+$("#txt_placa_"+i).val()+","+$("#txt_serie_"+i).val()+","+$("#txt_marca_"+i).val()+","+$("#txt_modelo_"+i).val()+","+$("#txt_presentacion_"+i).val()+","+$("#txt_pureza_"+i).val()+","+$("#txt_grado_"+i).val()+","+$("#txt_capacidad_"+i).val()+","+$("#txt_tipoc_"+i).val()+","+$("#txt_certificador_"+i).val();					
		return datos;	
}


function llena_divs(nproductos){
  $('#productos_dinamicos').append('<div class="lineaAzul"></div>');
  $('#productos_dinamicos').append('<div id="productos_'+nproductos+'"></div>');  
  $('#productos_'+nproductos).append('<h2 align="center" class="Arial18Morado">Artiulo'+nproductos+'</h2>');
  $('#productos_'+nproductos).append('<div id="comprade_'+nproductos+'"><div align="left" class="Arial14Morado subtitulos fl">Cantidad</div><div><input id="txt_cantidad_'+nproductos+' name="txt_cantidad_'+nproductos+' size="10"  value="" class="inputbox"  type="text" /></div><br class="none"><div class="Arial14Morado subtitulos fl">Compra de: </div><div><select class="combos" id="cmb_compra_'+nproductos+'" numero="'+nproductos+'" name="cmb_compra_'+nproductos+'"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Est&aacute;ndares</option><option value="4">Interlaboratoriales</option><option value="5">Cristaler&iacute;a</option><option value="6">Repuestos</option><option value="7">Consumible de equipos</option><option value="8">Muebler&iacute;a</option><option value="9">Equipo Descripci&oacute;n</option><option value="10">Medio de Cultivo</option><option value="11">Materiales y &uacute;tiles de laboratorio varios</option><option value="12">Materiales de Oficina</option><option value="13">Materiales de Limpieza</option><option value="14">Software</option></select></div><br>');
  $('#productos_'+nproductos).append('<div id="generico_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulos fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div></div>');
  $('#productos_'+nproductos).append('<div id="reparacion_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Equipo:</div><div class="Arial14Morado subtitulos fl">C&oacute;digo Equipo:</div><div class="Arial14Morado subtitulos fl">Placa:</div><div style="float: none;"></div><br class="none"><div  class=" fl input25"><input  id="txt_equipo_'+nproductos+'" name="txt_equipo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_cequipo_'+nproductos+'"  name="txt_cequipo_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_placa_'+nproductos+'" name="txt_placa_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br class="none"><div class="Arial14Morado subtitulos fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulos fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div></div>');
  $('#productos_'+nproductos).append('<div id="calibracion_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Equipo:</div><div class="Arial14Morado subtitulos fl">C&oacute;digo Equipo:</div><div class="Arial14Morado subtitulos fl">Marca:</div><br class="none"><div  class=" fl input25"><input  id="txt_equipo_'+nproductos+'" name="txt_equipo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_cequipo_'+nproductos+'"  name="txt_cequipo_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_marca_'+nproductos+'" name="txt_marca_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulos fl">Modelo:</div><div class="Arial14Morado subtitulos fl">Serie:</div><div class="Arial14Morado subtitulos fl">Placa:</div><br class="none"><div  class=" fl input25"><input  id="txt_modelo_'+nproductos+'" name="txt_modelo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_serie_'+nproductos+'"  name="txt_serie_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div class="fl input25" ><input  id="txt_placa_'+nproductos+'" name="txt_placa_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulos fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulos fl ml ">Observaciones:</div><br class="none"><div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div><div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div></div>');
  $('#productos_'+nproductos).append('<div id="reactivos_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Presentaci&oacute;n</div><div class="Arial14Morado subtitulos fl">Pureza</div><br class="none"><div  class=" fl input25"><input  id="txt_presentacion_'+nproductos+'" name="txt_presentacion_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><div  class="fl input25"><input  id="txt_pureza_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><br class="none"></div>');
  $('#productos_'+nproductos).append('<div id="gases_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Pureza</div><div class="Arial14Morado subtitulos fl">Capacidad</div><br class="none"><div  class="fl input25"><input  id="txt_pureza_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_capacidad_'+nproductos+'" name="txt_capacidad_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulos fl">Volumen Cilindro</div><div class="Arial14Morado subtitulos fl">Tipo Conecci&oacute;n</div><br class="none"><div  class="fl input25"><input  id="txt_volument_'+nproductos+'"  name="txt_volument_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_tipoc_'+nproductos+'" name="txt_tipoc_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"></div>');
  $('#productos_'+nproductos).append('<div id="estandar_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Pureza</div><div class="Arial14Morado subtitulos fl">Certificador</div><br class="none"><div  class="fl input25"><input  id="txt_pureza_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_certificador_'+nproductos+'" name="txt_certificador_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br><div class="Arial14Morado subtitulos fl">Volumen Cilindro</div><div class="Arial14Morado subtitulos fl">Tipo Conecci&oacute;n</div><br class="none"><div  class="fl input25"><input  id="txt_volument_'+nproductos+'"  name="txt_volument_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_tipoc_'+nproductos+'" name="txt_tipoc_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"></div>');
  $('#productos_'+nproductos).append('<div id="interlaboratoriales_'+nproductos+'"><div class="Arial14Morado subtitulos fl">Matriz</div><div class="Arial14Morado subtitulos fl">Certificador</div><br class="none"><div  class="fl input25"><input  id="txt_matriz_'+nproductos+'"  name="txt_matriz_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><div  class=" fl input25"><input  id="txt_certificador_'+nproductos+'" name="txt_certificador_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br></div>');
}


})// JavaScript Document

