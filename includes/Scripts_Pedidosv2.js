$(document).ready(function(){
	var tot_articles=0;
	//var allFields = $( [] ).add( txt_numero );




/****************************************
Dialog Form agregar articulo
*****************************************/

var dialog_window=$( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 350,
      width: 550,
      modal: true,
      buttons: {
        "Guardar": function() {
			tot_articles++;
			vhtml='<tr class="articles" id="row_'+tot_articles+'"><td>'+$("#txt_pre").val()+'</td><td>'+$("#txt_con").val()+'</td><td>'+$("#txt_sim").val()+'</td><td><a id="modificar" num_art="1">Modificar</a>|<a class="del_articulo" num_art="'+tot_articles+'">Eliminar</a></td></tr>';
        $('#tbl_articles').append(vhtml);
		
        	$( this ).dialog( "close" );
        },
        Cancelar: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        //allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
/****************************************
Eliminar un articulo
*****************************************/

$(".del_articulo").live("click",function(event){ 
	tot_articles--;
    $("#row_"+$(this).attr("num_art")).remove();
    return false;
});

/****************************************
Abrir el modal
*****************************************/
$( "#btn_addarticle" ).click(function() {
    $( "#dialog-form" ).dialog( "open" );
});


$("#cmb_tipoart").change(function(event){
 if($(this).val()==1){
 	add_reactivos();	
 }
});

function add_reactivos(){
	html=
 '<div id="reactivos">'
+'<div align="left" class="Arial14Morado subtitulosl ">Cantidad</div>'
+'<div><input id="txt_cantidad" name="txt_cantidad" size="10"  value="" class="inputbox"  type="text" /></div><br>'
+'<div align="left" class="Arial14Morado subtitulosl ">Plazo de entrega</div>'
+'<div>'
  +'<span class="small_text">D&iacute;as</span><input  id="txt_dias" value="" class="mininputbox"  type="text" />'
  +'<span class="small_text">Semanas</span><input  id="txt_semanas" value="" class="mininputbox"  type="text" />'
  +'<span class="small_text">Meses</span><input  id="txt_meses" value="" class="mininputbox"  type="text" />'
+'</div><br>'
+'<div align="left" class="Arial14Morado subtitulosl ">Existente en GECO</div>'
+'<div>'
  +'<span class="small_text">C&oacute;digo de Agrupaci&oacute;n</span><input  id="txt_codagrup" value="" class="midinputbox"  type="text" />'
  +'<span class="small_text">C&oacute;digo de Articulo</span><input  id="txt_codart" value="" class="midinputbox"  type="text" />'
+'</div><br>'
+'<div align="left" class="Arial14Morado subtitulosl ">Proveedores</div>'
+'<div>'
+'<select type="text" id="input-tags2" multiple class="demo-default">'
+'<option>Gollo</option>'
+'<option>Verdugo</option>'
+'<option>Casa Blanca</option>'
+'</select>'
+'</div><br>'
+'<table border="1">'
+'<tr>'
+'<td class="Arial14Morado subtitulosl ">Nombre</td>'
+'<td class="Arial14Morado subtitulosl ">Pureza</td>'
+'<td class="Arial14Morado subtitulosl ">Grado</td>'
+'</tr><tr>'
+'<td  class="  input25">'
  +'<input  id="txt_nombrere" name="txt_nombrer"   value="" class="inputbox"  type="text" />'
+'</td>'
+'<td  class=" input25">'
  +'<input  id="txt_purezare"  name="txt_pureza"  value="" class="inputbox"  type="text" />'
+'</td>'
+'<td  class="  input25">'
  +'<input  id="txt_gradore" name="txt_grado"   value="" class="inputbox"  type="text" />'
+'</td>'
+'</tr><tr>'
+'<td class="Arial14Morado subtitulosl ">Presentación</td>'
+'<td class="Arial14Morado subtitulosl ">Tipo de almacenamiento</td>'
+'<td class="Arial14Morado subtitulosl ">Similar a marca</div></td>'
+'</tr><tr>'
+'<td  class="  input25">'
  +'<input  id="txt_presentacionre"    value="" class="inputbox"  type="text" />'
+'</td>'
+'<td  class=" input25">'
  +'<input  id="txt_condicionesre"    value="" class="inputbox"  type="text" />'
+'</td>'
+'<td  class="  input25">'
  +'<input  id="txt_similarmre"    value="" class="inputbox"  type="text" />'
+'</td>'
+'</tr><tr>'
+'<td class="Arial14Morado subtitulosl ">Similar # catálogo</td>'
+'<td class="Arial14Morado subtitulosl "># Cotizaci&oacute;n</td>'
+'<td class="Arial14Morado subtitulosl ">Otros detalles</td>'
+'</tr><tr>'
+'<td  class="  input25">'
  +'<input  id="txt_similarcre"    value="" class="inputbox"  type="text" />'
+'</td>'
+'<td  class="  input25">'
  +'<input  id="txt_cotizacionre"    value="" class="inputbox"  type="text" />'
+'</td>'
+'<td  class="  input25">'
  +'<input  id="txt_otrosre"    value="" class="inputbox"  type="text" />'
+'</td>'
+'</tr><tr>'
+'<td class="Arial14Morado subtitulosl ">Monto</div><br>'

+'<td  class="  input25">'
+'<span class="small_text">Colones</span><input  id="txt_colones" value="" class="midinputbox"  type="text" />'
+'<span class="small_text">Dolares</span><input  id="txt_dolares" value="" class="midinputbox"  type="text" />'
+'</td>'
  
+'</tr></table>'

//$("#tbl_articles").append(html);
dialog_window.html(html);
}

})// JavaScript Document