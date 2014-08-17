<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
		
var v_subcategorias=new Array();
			
			
///********************continuar***************+///////////
$("#btn_guardar").live("click", function(event){
 if(confirm('¿Seguro que desea modificar esta muestra?')){
		
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",
		data: "opcion=18&id="+$("#txt_id_muestra").val()+"&nombre="+$("#txt_nombre_muestra").val(),
success: function(datos){			
	
			
		}//end succces function
		});//end ajax function
		
		top.location.href = 'menu.php';
									  
 }else{
	 return;
 }

									  
});






</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style=" padding:10px;">
  <div id="mainBlacoFondo" >
<?
$result=mysql_query("select nombre_muestra from tbl_muestras where id='".$_REQUEST['id']."'");
$row=mysql_fetch_object($result)

?>    

    <div align="center" id="mainBlancoMolienda"><br />
    
    <h2 class="Arial18Morado" >Cambio Nombre Muestras</h2><div align="left" id="form'+tab_counter+'">
    <table border="0" >
    <tr>
	<td width="257" align="left" class="Arial12Azul">Nombre Antiguo</td>
    <td width="256" align="left" class="Arial12Azul">Nuevo Nombre</td>      
    </tr>
    </table>
    <table>
    <tr>
		<td width="257">
          <input size="30" id="txt_nombre_muestra_ant" width="50" value="<?=$row->nombre_muestra?>"  style="font-size:14px; height:17px;" size="10" type="text" />
          <input type="hidden" id="txt_id_muestra" value="<?=$_REQUEST['id'];?>">
        </td>
        <td width="256">
          <input size="30" id="txt_nombre_muestra"  style="font-size:14px; height:17px;" size="10" type="text" />
        </td>
		
        </tr>
    </table>

 </div><br>

   <div align="center"><input id="btn_guardar" type="image" src="img/btn_guardar.png" /></div> 
    </div>

</div>

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro Azul--> 


</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:3000px;"></div>
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
