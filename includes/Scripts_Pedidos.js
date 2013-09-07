$(document).ready(function(){

//$("#productos").hide();	
//$("#comprade").hide();	

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
  $("#productos:hidden").clone().appendTo("#2");
  //$("productos2").clone().appendTo("productos3");
});

function oculta_divs(){
	//$("#productos").hide();	
	$("#comprade").hide();	
	$("#reparacion").hide();	
	//$("#generico").hide();	
	$("#generico").css("visibility", "hidden");
	$("#reactivos").hide();	
	$("#gases").hide();	
	$("#estandar").hide();	
	$("#interlaboratoriales").hide();	
	$("#calibracion").hide();
}

})// JavaScript Document

