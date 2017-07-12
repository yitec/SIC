$(document).ready(function(){


var tab_counter = 0;
$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );


$('#btn_addtab').live("click",function(event){
addtab();
}); 

/********************Add tab*********************/
function addtab() {
      tab_counter++;
      
      $("#tabs").tabs("add","#tabs-"+tab_counter,"Articulo "+tab_counter);
      //pongo el focus en el tab agregado
      $("#tabs").tabs('select', "#tabs-"+tab_counter);
          
}//end add tap


function notificacion(titulo,cuerpo,tipo){
  $.pnotify({
  pnotify_title: titulo,
    pnotify_text: cuerpo,
    pnotify_type: tipo,
    pnotify_hide: true
  }); 
}



})// JavaScript Document

