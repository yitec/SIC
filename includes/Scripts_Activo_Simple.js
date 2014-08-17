var buscador_activo = false; 


 function notificacion(titulo,cuerpo,tipo){
	$.pnotify({
	pnotify_title: titulo,
	  pnotify_text: cuerpo,
	  pnotify_type: tipo,
	  pnotify_hide: true
	}); 
  }  

function Eliminar_activo(ID){
	
	var r = confirm("Esta seguro de que quiere borrar este activo!");
	var usuario     =document.getElementById("USUARIO").value;
	
	if (r == true)
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				resultado =xmlhttp.responseText;
				
				if(resultado == "Success"){
					//alert('El activo fue eliminado correctamente.');
					notificacion("Mensaje Enviado!!","El activo fue eliminado correctamente.","info"); 				
					setInterval(function(){window.location.assign("lista_activos.php")},1500); 
				}else if(resultado == "EXISTE"){
					notificacion("Advertencia!!","Este activo no se puede borrar debido a que se encuentra en un tramite de solicitud, para borrarlo dirijase a la opcion de Peticiones de Activos y borrelo de esa opcion.","info"); 
				}
			
			}
		}

		xmlhttp.open("POST","http://www.siccina.ucr.ac.cr/sergio/SIC/operaciones/Clase_Activo.php" ,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("metodo=elimina_activo&parametros=" + ID + "|" + usuario);
	}
}


function abrir_cerrar_buscador_activo(){
	
	if(buscador_activo==false){
		
		document.getElementById("busqueda").style.display = "inline";
		document.getElementById("titulo_buscador_activos").innerHTML="Ocultar Busqueda";
		buscador_activo = true;
	}else{
		document.getElementById("busqueda").style.display = "none";
		document.getElementById("titulo_buscador_activos").innerHTML="Busqueda";
		document.getElementById("txt_nombre").value="";
		document.getElementById("txt_marca").value="";
		document.getElementById("txt_placa").value="";
		buscador_activo = false;
		
		
		var parametros =  "|" + "|" +  "|";
		
		
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				resultado =xmlhttp.responseText;
				
				if(resultado == "ERROR"){
					alert('No se pudo procesar la consulta.');
					document.getElementById("tabla_datos").innerHTML ='<span>No se encontraron datos para visualizar</span>';
					
				}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					document.getElementById("tabla_datos").innerHTML ='<span>No se encontraron datos para visualizar</span>';
				}else{
					document.getElementById("tabla_datos").innerHTML = resultado;
				}
			
			}
		}

		xmlhttp.open("POST","http://www.siccina.ucr.ac.cr/SIC/operaciones/Clase_Activo.php" ,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("metodo=busqueda_activo&parametros=" + parametros);
		
		
		
	}

}


function busqueda_activo(e){

	if (e.keyCode == 13) {
        
		var parametros =  document.getElementById("txt_nombre").value + "|" +
						  document.getElementById("txt_marca").value + "|" +
					      document.getElementById("txt_placa").value;
		
		
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				resultado =xmlhttp.responseText;
				
				if(resultado == "ERROR"){
					alert('No se pudo procesar la consulta.');
					document.getElementById("tabla_datos").innerHTML ='<span>No se encontraron datos para visualizar</span>';
					
				}else if(resultado == "NADA"){
					alert('No se pudo encontraron coincidencias en la busqueda.');
					document.getElementById("tabla_datos").innerHTML ='<span>No se encontraron datos para visualizar</span>';
				}else{
					document.getElementById("tabla_datos").innerHTML = resultado;
				}
			
			}
		}

		xmlhttp.open("POST","http://www.siccina.ucr.ac.cr/SIC/operaciones/Clase_Activo.php" ,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("metodo=busqueda_activo&parametros=" + parametros);

    }

}
  
  
  
//<![CDATA[ 

var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head>REPORTE<!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
//]]> 
  
  