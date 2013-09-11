$(document).ready(function(){

//$("#productos").hide();	
//$("#comprade").hide();	
var nproductos=1;
oculta_divs();


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

//despliego los divs de cada articulo :
$("#cmb_compra").change(function(event){	
	opcion=$("#cmb_compra").val();	
	switch(opcion)
		{
			case "0":
  				oculta_divs();
  			break;
			case "1":
  				$("#reactivos").show();	
  				$("#reparacion").hide();
  				$("#generico").hide();	
  				$("#gases").hide();
  				$("#estandar").hide();	
				$("#interlaboratoriales").hide();	
			    $("#calibracion").hide();		
  			break;
			case "2":
  				$("#gases").show();
  				$("#generico").hide();		
  				$("#estandar").hide();	
  				$("#reactivos").hide();	
  				$("#reparacion").hide();
  				$("#interlaboratoriales").hide();	
			    $("#calibracion").hide();		
  			break;
  			case "3":
  				$("#estandar").show();	
  				$("#gases").hide();
  				$("#generico").hide();		  				
  				$("#reactivos").hide();	
  				$("#reparacion").hide();
  				$("#interlaboratoriales").hide();	
			    $("#calibracion").hide();		
  			break;
  			case "4":
  				$("#interlaboratoriales").show();
  				$("#gases").hide();
  				$("#generico").hide();		
  				$("#estandar").hide();	
  				$("#reactivos").hide();	
  				$("#reparacion").hide();  				
			    $("#calibracion").hide();			
  			break;
  			case "5":
  				$("#generico").show();	
  				$("#gases").hide();  				
  				$("#estandar").hide();	
  				$("#reactivos").hide();	
  				$("#reparacion").hide();
  				$("#interlaboratoriales").hide();	
			    $("#calibracion").hide();		
  			break;  
  			case "6":
  				$("#calibracion").show();	
  				$("#gases").hide();
  				$("#generico").hide();		
  				$("#estandar").hide();	
  				$("#reactivos").hide();	
  				$("#reparacion").hide();
  				$("#interlaboratoriales").hide();				    
  			break;			
  			case "7":
  				$("#calibracion").show();	
  				$("#gases").hide();
  				$("#generico").hide();		
  				$("#estandar").hide();	
  				$("#reactivos").hide();	
  				$("#reparacion").hide();
  				$("#interlaboratoriales").hide();				    
  			break;
			default:
  				$("#generico").show();
  				$("#gases").hide();  				
  				$("#estandar").hide();	
  				$("#reactivos").hide();	
  				$("#reparacion").hide();
  				$("#interlaboratoriales").hide();	
			    $("#calibracion").hide();			
		}
		
})

$("#btn_agregar").click(function(){
  //$("#productos:hidden").clone().appendTo("#2");  
  //$("productos2").clone().appendTo("productos3");
  nproductos++;
  llena_divs(nproductos);
});

/*****************************************Funciones********************************/

function oculta_divs(){
	//$("#productos").hide();	
	$("#comprade").hide();	
	$("#reparacion").hide();	
	$("#generico").hide();	
	$("#generico").css("visibility", "hidden");
	$("#reactivos").hide();	
	$("#gases").hide();	
	$("#estandar").hide();	
	$("#interlaboratoriales").hide();	
	$("#calibracion").hide();
}

function llena_divs(nproductos){
  $('#productos_'+nproductos).append('<div id="comprade_'+nproductos+'"><h2>Compra de</h2><table><tr><td width="135" class="Arial14Morado">Compra de: </td><td><select class="combos" id="cmb_compra_'+nproductos+'" name="cmb_compra_'+nproductos+'"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Est&aacute;ndares</option><option value="4">Interlaboratoriales</option><option value="5">Cristaler&iacute;a</option><option value="6">Repuestos</option><option value="7">Consumible de equipos</option><option value="8">Muebler&iacute;a</option><option value="9">Equipo Descripci&oacute;n</option><option value="10">Medio de Cultivo</option><option value="11">Materiales y &uacute;tiles de laboratorio varios</option><option value="12">Materiales de Oficina</option><option value="13">Materiales de Limpieza</option><option value="14">Muebler&iacute;a</option><option value="15">Software</option></select></td></tr></table></div>');
  $('#productos_'+nproductos).append('<div id="generico_'+nproductos+'">',
                            '<h2>Generico</h2>',
                              '<div class="Arial14Morado subtitulos fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulos fl ml ">Observaciones:</div><br class="none">',
                              '<div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div>',
                              '<div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div>',    
                            '</div>',
                            '<div id="reparacion_'+nproductos+'">',
                            '<h2>Reparacion</h2>',
                              '<div class="Arial14Morado subtitulos fl">Equipo:</div>',
                              '<div class="Arial14Morado subtitulos fl">C&oacute;digo Equipo:</div>',
                              '<div class="Arial14Morado subtitulos fl">Placa:</div><div style="float: none;"></div>',
                              '<br class="none">',
                              '<div  class=" fl input25"><input  id="txt_equipo_'+nproductos+'" name="txt_equipo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div>',
                              '<div  class="fl input25"><input  id="txt_cequipo_'+nproductos+'"  name="txt_cequipo_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                              '<div class="fl input25" ><input  id="txt_placa_'+nproductos+'" name="txt_placa_'+nproductos+'"   value="" class="inputbox"  type="text" /></div>',
                              '<br class="none"><br class="none">',
                              '<div class="Arial14Morado subtitulos fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulos fl ml ">Observaciones:</div><br class="none">',
                              '<div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div>',
                              '<div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div>',    

                            '</div>',
                            '<div id="calibracion_'+nproductos+'">',
                            '<h2>Calibracion</h2>',
                                '<div class="Arial14Morado subtitulos fl">Equipo:</div>',
                                '<div class="Arial14Morado subtitulos fl">C&oacute;digo Equipo:</div>',
                                '<div class="Arial14Morado subtitulos fl">Marca:</div><br class="none">',
                                '<div  class=" fl input25"><input  id="txt_equipo_'+nproductos+'" name="txt_equipo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div>',
                                '<div  class="fl input25"><input  id="txt_cequipo_'+nproductos+'"  name="txt_cequipo_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div class="fl input25" ><input  id="txt_marca_'+nproductos+'" name="txt_marca_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br>',
                                '<div class="Arial14Morado subtitulos fl">Modelo:</div>',
                                '<div class="Arial14Morado subtitulos fl">Serie:</div>',
                                '<div class="Arial14Morado subtitulos fl">Placa:</div><br class="none">',
                                '<div  class=" fl input25"><input  id="txt_modelo_'+nproductos+'" name="txt_modelo_'+nproductos+'"   value="" class="inputbox"  type="text" /></div>',
                                '<div  class="fl input25"><input  id="txt_serie_'+nproductos+'"  name="txt_serie_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div class="fl input25" ><input  id="txt_placa_'+nproductos+'" name="txt_placa_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br>',
                                '<div class="Arial14Morado subtitulos fl">Descripci&oacute;n:</div><div class="Arial14Morado subtitulos fl ml ">Observaciones:</div><br class="none">',
                              '<div class="fl"><textarea  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div>',
                              '<div ><textarea class="ml"  rows="4" cols="25" name="txt_descripcion_'+nproductos+'" id="txt_descripcion_'+nproductos+'" ></textarea></div>',                                
                            '</div>',
                            '<div id="reactivos_'+nproductos+'">',
                            '<h2>Reactivos</h2>',
                                '<div class="Arial14Morado subtitulos fl">Presentaci&oacute;n</div>',
                                '<div class="Arial14Morado subtitulos fl">Pureza</div><br class="none">',                                
                                '<div  class=" fl input25"><input  id="txt_presentacion_'+nproductos+'" name="txt_presentacion_'+nproductos+'"   value="" class="inputbox"  type="text" /></div>',
                                '<div  class="fl input25"><input  id="txt_pureza_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" /></div><br class="none">',
                            '</div>',
                            '<div id="gases_'+nproductos+'">',
                            '<h2>Gases</h2>',
                                '<div class="Arial14Morado subtitulos fl">Pureza</div>',                                
                                '<div class="Arial14Morado subtitulos fl">Capacidad</div><br class="none">',
                                '<div  class="fl input25"><input  id="txt_pureza_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div  class=" fl input25"><input  id="txt_capacidad_'+nproductos+'" name="txt_capacidad_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br>',                                
                                '<div class="Arial14Morado subtitulos fl">Volumen Cilindro</div>',                                
                                '<div class="Arial14Morado subtitulos fl">Tipo Conecci&oacute;n</div><br class="none">',
                                '<div  class="fl input25"><input  id="txt_volument_'+nproductos+'"  name="txt_volument_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div  class=" fl input25"><input  id="txt_tipoc_'+nproductos+'" name="txt_tipoc_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none">',                                                                
                            '</div>',
                            '<div id="estandar_'+nproductos+'">',
                            '<h2>Estandar</h2>',
                                '<div class="Arial14Morado subtitulos fl">Pureza</div>',                                
                                '<div class="Arial14Morado subtitulos fl">Certificador</div><br class="none">',
                                '<div  class="fl input25"><input  id="txt_pureza_'+nproductos+'"  name="txt_pureza_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div  class=" fl input25"><input  id="txt_certificador_'+nproductos+'" name="txt_certificador_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br>',                                
                                '<div class="Arial14Morado subtitulos fl">Volumen Cilindro</div>',                                
                                '<div class="Arial14Morado subtitulos fl">Tipo Conecci&oacute;n</div><br class="none">',
                                '<div  class="fl input25"><input  id="txt_volument_'+nproductos+'"  name="txt_volument_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div  class=" fl input25"><input  id="txt_tipoc_'+nproductos+'" name="txt_tipoc_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none">',                                                                                                
                            '</div>',
                            '<div id="interlaboratoriales_'+nproductos+'">',
                             '<h2>Interlaboratoriales</h2>',
                             '<div class="Arial14Morado subtitulos fl">Matriz</div>',                                
                                '<div class="Arial14Morado subtitulos fl">Certificador</div><br class="none">',
                                '<div  class="fl input25"><input  id="txt_matriz_'+nproductos+'"  name="txt_matriz_'+nproductos+'"  value="" class="inputbox"  type="text" /></div>',
                                '<div  class=" fl input25"><input  id="txt_certificador_'+nproductos+'" name="txt_certificador_'+nproductos+'"   value="" class="inputbox"  type="text" /></div><br class="none"><br>',                                                                
                            '</div>');
}

})// JavaScript Document

