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
<div class="cen_sup_g">
  <div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Informaci&oacute;n</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">
<div id="mainAzulFondo" align="center" style=" padding:20px;   height:auto; width:auto;">
<div id="mainBlancoFondo">

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n especial <?=$contrato?> </div>
    <div align="center" >
    
    <?
	$result=mysql_query("
        SELECT
    cli.tipo_cliente,
    tio.lisencia,
    tim.tipo_alimento,
    tim.procedencia,
    con.fecha_ingreso 
    from 
    tbl_clientes cli join
    tbl_contratos con on
    cli.id=con.id_cliente and con.consecutivo='".$_REQUEST['contrato']."' join
    tbl_infoficiales tio on 
    tio.cons_contrato=con.consecutivo join
    tbl_infmuestras tim  on
    tim.cons_contrato= con.consecutivo
    ");
	
	
	$row=mysql_fetch_assoc($result);
	$v_procedencia=explode(',',$row['procedencia']);
	$result3=mysql_query("select p.nombre, c.nombre, d.nombre from tbl_provincias p, tbl_cantones c, tbl_distritos d where p.id='".$v_procedencia[0]."' and c.id='".$v_procedencia[1]."' and d.id='".$v_procedencia[2]."' ");
    $row3=mysql_fetch_array($result3);
    $pro=$row3[0]."-".$row3[1]."-".$row3[2]
	
	?>
    <table>
    <tr>
    	<td width="90" class="Arial14Morado">Tipo de Cliente:</td>
        <td width="307"><textarea name="txt2" id="txt" cols="45" rows="2" class="textArea" ><?=utf8_encode($row['tipo_cliente'])?></textarea>
        </td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Lisencia DAA:</td>
        <td><textarea name="txt2" id="txt" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['lisencia'])?></textarea></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Tipo de alimento:</td>
        <td><textarea name="txt2" id="txt" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['tipo_alimento'])?></textarea></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Procedencia:</td>
        <td><textarea name="txt2" id="txt" cols="45" rows="2"  class="textArea" ><?=utf8_encode($pro)?></textarea></td>
    </tr>
    <tr>
    	<td class="Arial14Morado">Fecha de Recepcion:</td>
        <td><textarea name="txt" id="txt2" cols="45" rows="2"  class="textArea" ><?=utf8_encode($row['fecha_ingreso'])?>
        </textarea></td>
    </tr>
    <tr>
    </table>
    <?
    mysql_free_result($result);
	desconectar();
	
	?>
    
    
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
