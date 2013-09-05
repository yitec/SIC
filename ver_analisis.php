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

	$(".procesar").live("click", function(event){
		 if(confirm('¿Seguro que desea procesar este analisis?')){

		  var current_id = $(this).attr("id");
		  var current_muestra= $(this).attr("name");
		  var current_contrato= $(this).attr("value");
		  var current_nombre=$(this).attr("nombre_analisis");
		  var current_codigo=$(this).attr("codigo");
		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=1&id="+current_id+"&contrato="+current_contrato,
        success: function(datos){
			
		}//end succces function
		});//end ajax function		
		  // window.open('http://www.siccina.ucr.ac.cr/SIC/etiquetas_analisis.php?contrato='+current_contrato+'&muestra='+current_muestra+'&nombre='+current_nombre+'&codigo='+current_codigo,'_blank');
		  		top.location.href = 'ver_analisis.php?muestra='+current_muestra+'&contrato='+current_contrato+'&id='+$('#id').val();
		 }else{
			return;
		 }

	});
	
$("#chk_todas").live("click", function(event){
		 if(confirm('¿Seguro que desea procesar todos los análisis de esta muestra')){
			  var muestra= $(this).attr("muestra");
		  	  var contrato= $(this).attr("contrato");
			  

			$.ajax({
        	type: "POST",
			async: false,
        	url: "operaciones/opr_analisis.php",		
        	data: "opcion=8&muestra="+muestra+"&contrato="+contrato,
        	success: function(datos){
			
			}//end succces function
			});//end ajax function		
 		 
		 }else{
			return;
		 }
		top.location.href = 'ver_analisis.php?muestra='+muestra+'&contrato='+contrato+'&id='+$('#id').val();
	});	

$(".trabajando").live("click", function(event){
		 if(confirm('¿Seguro que desea marcar este analisis?')){

		  var current_id = $(this).attr("id");
		  
		  $.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_analisis.php",		
        data: "opcion=2&id="+current_id,
        success: function(datos){
		
			
		}//end succces function
		});//end ajax function		
		  		
		 }else{
			return;
		 }

	});

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
<div class="izq_lat_g" style=" height:3000px;"></div>
<div    class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
  <div id="mainBlacoFondo" style=" margin-top:10px; margin-bottom:10px; ">
    

    <div align="center" id="mainBlancoMolienda">
	    <div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">An&aacute;lisis de Muestra
	      <input type="hidden"  id="id"  value="<?=$_REQUEST['id'];?>"/>
	    </div>

	<table class="table_td" width="669"   border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td class=" table_td" width="123" ><div align="center" class="Arial14Azul">C&oacute;digo</div></td>
    <td class=" table_td" width="220" ><div align="center" class="Arial14Azul">An&aacute;lisis</div></td>
    <td class=" table_td" width="75" ><div align="center" class="Arial14Azul">Estado</div></td>
    <td class=" table_td" width="78" ><div align="center" class="Arial14Azul">Trabajando</div></td>
    <td class=" table_td" width="85" ><div align="center" class="Arial14Azul">Imprimir</div></td>
    
    </tr>	
<?


$result2=mysql_query("select c.nombre,a.id,a.codigo,a.trabajando,a.fecha_molienda, a.estado from tbl_analisis a, tbl_categoriasanalisis c where a.id_contrato='".$_REQUEST['contrato']."' and a.id_muestra='".$_REQUEST['muestra']."' and c.id=a.id_analisis order by a.estado");
//$result=mysql_query("select con.consecutivo as consecutivo,m.id,m.codigo,m.id_analisis,m.nombreMuestra as nombre,c.nombre as categoria,s.nombre as subcategoria from `tbl_contratos` as `con`, `tbl_muestras` as m, `tbl_categoriasmuestras` as c, `tbl_subcatmuestras` as s where m.id_contrato='".$_REQUEST['id']."' and con.`id`=m.`id_contrato` and  c.`id`=m.`id_categoria` and s.`id`=m.`id_subCategoria`");
	while ($row2=mysql_fetch_assoc($result2)){
?>	
	<tr>
    <td class=" table_td"><div align="center" class="Arial14Negro"><?=$row2['codigo'];?></div></td>
    <td class=" table_td"><div align="center" class="Arial14Negro"><?=utf8_encode($row2['nombre']);?></div></td>
    <? if($row2['estado']==0){
	?>	
	<td class=" table_td"><div align="center" class="Arial14Negro">Pendiente</div></td>
    <?
    }if($row2['estado']==1){
	?>
    <td class=" table_td"><div align="center" class="Arial14Negro">Lista</div></td>
    <?
    }if($row2['estado']==2){
	?>
    <td class=" table_td"><div align="center" class="Arial14Negro">Lista</div></td>
    <?
    }if($row2['estado']==3){
	?>
    <td class=" table_td"><div align="center" class="Arial14Negro">Lista</div></td>
    <?
	}if($row2['estado']==4){
	?>
    <td class=" table_td"><div align="center" class="Arial14Negro">Desactivado</div></td>
    <?
	}    
    ?>
    <td class="table_td"><div align="center" class="Arial14Negro">
            <input id="<?=$row2['id'];?>" class="trabajando"  <? if($row2['trabajando']==1){?> checked="checked"<? }?> type="checkbox" value="" />
    </div></td>
    <td class=" table_td" width="154"><div align="center" class="Arial14Negro">
          <? if($row2['estado']==0){
	?>	
      <input type="image" codigo="<?=$row2['codigo'];?>" nombre_analisis="<?=utf8_encode($row2['nombre'])?>" name="<?=$_REQUEST['muestra'];?>" id="<?=$row2['id'];?>" value="<?=$_REQUEST['contrato'];?>" title="<?=$row2['id'];?>" class="procesar" src="img/btn_procesar.png"  />
     <?
		  }else{
	?>
    <? echo $row2['fecha_molienda'];
		  }
	?>
    </div></td>

	  </tr>	
    
<?	
	}

?>
	</table><br />
    <div  class="Arial14Azul" align="center">Procesar Todas <input name="chk_todas" muestra="<?=$_REQUEST['muestra'];?>" contrato="<?=$_REQUEST['contrato'];?>"  id="chk_todas" type="checkbox" value="" /></div>

    </div>



</div><!--fin cuadro blanco--> 
</div><!--fin cuadro Azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style=" height:3000px;"></div>
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
