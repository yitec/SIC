<?
session_start();
require_once('../cnx/session_activa.php');
require_once('../cnx/conexion_inventario.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 

<script src="../includes/jquery.ui.core.js"></script>
<script src="../includes/jquery.ui.widget.js"></script>
<script src="../includes/jquery.ui.autocomplete.js"></script>
<script src="../includes/jquery.ui.position.js"></script>

<script >
$(document).ready(function(){
$("#btn_guardare").click(function(event){
		
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
        url: "../operaciones/opr_materias.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val(),        		
		success: function(datos){
			$.pnotify({
			    pnotify_title: 'Nuevo Empresa!!',
    			pnotify_text: 'La empresa fue guardada exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		

/*		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Empresa!!',
    			pnotify_text: 'La empresa fue guardada exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'La empresa ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
*/				
				
		}//end succces function
		});//end ajax function			
		$('#txt_nombre').val("");
		$('#txt_nombre').focus();	
		
		

});
})
</script> 



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Mantenimiento Empresas</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	
    <input id="opcion" name="opcion" type="hidden" value="1" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Nombre de la empresa</div>
	<table>
	  <tr>
      	<td class="Arial14Negro"><div align="center">Nombre</div></td>
	    
	    
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><input id="txt_nombre" class="inputbox" type="text" /></td>
	    
	    </tr>
	
	        
	  </table>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardare" id="btn_guardare" type="image" src="../img/btn_guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="../img/btn_eliminar.png" /></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Control e Informaci&oacute;n.  
</div>
<div align="center" style="float:left" class="Arial8azul">&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
