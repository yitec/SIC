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
<link href="css/tablas.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
<script>
$(document).ready(function() {

	$(".trabajando").live("click", function(event){
		 if(confirm('¿Seguro que desea procesar este analisis?')){

		  var current_id = $(this).attr("id");
		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=2&id="+current_id,
        success: function(datos){
			
		}//end succces function
		});//end ajax function		
		  		top.location.href = 'analisis_micro.php';
		 }else{
			return;
		 }

	});

});						   

</script>

</head>

<body>
<?
$result=mysql_query("select id_contrato from tbl_analisis where id='".$_REQUEST['id']."'");
$row=mysql_fetch_assoc($result);
$contrato=$row['id_contrato'];

mysql_free_result($result);
?>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Ayudas tipos de muestras</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">
<div id="mainAzulFondo" align="center" style=" padding:20px;   height:auto; width:auto;">
<div id="mainBlancoFondo">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Ayuda </div>
    <div align="center" >
    
    <p>
      <?
	
	
	
	
	
	?>
    <table  border="1"  cellpadding="0" cellspacing="0">
    
    <tr>
    <td><div align="left" class="Arial14Negro">Digestibilidad por pepsina requiere Humedad a 135 , extracto etereo y proteina cruda. <br /> El sistema los selecciona solos al marcar Digestibilidad por pepsina.</div></td>
    
    </tr>
    </table>
    <br />
     <table  border="1"  cellpadding="0" cellspacing="0">
  <tr>
    <td width="376" >
    	<div style=" background:url(img/centro_grid.png);" class=" Arial14Morado"><strong>Tema</strong></div>
  	</td> 
    <td width="406" >
    	<div style=" background:url(img/centro_grid.png);" class="Arial14Morado"><strong>Comentarios</strong></div>
  	</td>
    
    
  </tr>

  
  <tr>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Metodo Extracto Etereo por Hidrolisis Acida</td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Alimentos Extrusados para tilapia<br /> - Alimentos extrusados para caballos<br /> - Alimentos extrusados para perros<br /> - Alimentos extrusados para gatos<br /> - Grasas protegidas o de sobrepaso</td>
    
  </tr>
  
<tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Metodo Extracto Et&eacute;reo por impurezas </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Aceites<br /> - Grasas </td>
    
  </tr>

<tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Metodo Humedad por Tolueno </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Grasas<br /> - Aceites<br /> - Melazas </td>
    
  </tr>
  <tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">An&aacute;lisis de humedad al vacio </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Todas las etapas de vacas lecheras menos reemplazadores de terneros<br /> - Todas las etapas de ganado de engorde </td>
    
  </tr>
  
  <tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Análisis de fosforo por digestion humeda </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Fosfato Dicalcicos<br /> - Fosfato Monocalcicos<br /> - Fosfatos Tricalcicos<br /> - Fosfatos Monoamonicos </td>
    
  </tr>

  <tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Tama&ntilde;o de muestra que el analista debe tomar para proteina cruda </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Alimentos Balanceados y forrajes 1 GR<br /> - Harina de carne y hueso, pescado, tortaves y aminoacidos 0.3 GR<br /> - Harina de soya, alimento para tilapia, truchas 0.5 GR </td>
    
  </tr>

  <tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Análisis de materia seca a 60 </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - A toda muestra que ingrese fresca y requiera culaquier an&aacute;lisis qu&iacute;mico</td>
    
  </tr>
  
  <tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Solubilidad in vitro del carbonato </td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Se refiere al análisis que determina la velocidad en que una fuente cabonatada reacciona en medio ácido. La muestra no se tritura o muele ya que la velocidad de reacción depende del tamaño de partícula.</td>
    
  </tr>
  
  <tr>  
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas">Neutralización del carbonato</td>
  <td style=" font-size:12px; font-family:Arial, Helvetica, sans-serif" class="tablas"> - Se refiere al análisis para determinar la pureza de una fuente carbonatada. </td>
    
  </tr>
  
</table>
    
    <br />
    
    
    </div>
</div><!--fin cuadro gris--> 
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
