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
					   
				
$("#chk_todos").live("click", function(event){
    var contrato= $(this).attr("contrato");
        if(confirm('¿Seguro que desea procesar todos los análisis de esta contrato?')){
              
              
              

            $.ajax({
            type: "POST",
            async: false,
            url: "operaciones/opr_analisis.php",        
            data: "opcion=16&contrato="+contrato,
            success: function(datos){             
            }//end succces function
            });//end ajax function      
         
         }else{
            return;
         }
        top.location.href = 'molienda.php';    
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
<div class="izq_lat_g" style="height:5000px;"></div>
<div    class="contenido_gm" align="center" >


<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style=" padding:10px;   height:auto; width:auto;">
<div id="mainBlancoFondo" >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Muestras contrato </div>
    <div align="center" id="mainBlancoMolienda">
    <form action="imprime_muestras.php" method="get">
	<table width="727" height="68" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td height="39"><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">C&oacute;digo</div></td>    
    <td><div align="center" class="Arial14Azul">Nombre Muestra</div></td>
    <td><div align="center" class="Arial14Azul">Observaciones</div></td>
    <td><div align="center" class="Arial14Azul">Procesar</div></td>        
    <td><div align="center" class="Arial14Azul">Imprimir</div></td>        
    
    </tr>	
<?
$result=mysql_query("select m.id_contrato,m.codigo,m.nombre_muestra,m.id,m.numero_muestra,m.observaciones, c.consecutivo from tbl_muestras m,tbl_contratos c where c.id='".$_REQUEST['id']."' and m.id_contrato=c.consecutivo");
//$result=mysql_query("select con.consecutivo as consecutivo,m.id,m.codigo,m.id_analisis,m.nombreMuestra as nombre,c.nombre as categoria,s.nombre as subcategoria from `tbl_contratos` as `con`, `tbl_muestras` as m, `tbl_categoriasmuestras` as c, `tbl_subcatmuestras` as s where m.id_contrato='".$_REQUEST['id']."' and con.`id`=m.`id_contrato` and  c.`id`=m.`id_categoria` and s.`id`=m.`id_subCategoria`");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
    $contrato=$row['id_contrato'];
	while ($row=mysql_fetch_assoc($result)){
         $contrato=$row['id_contrato'];
?>	
	<tr>
    <td><div align="center" class="Arial14Negro"><?=$row['id_contrato'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['codigo'];?></div></td>    
    <td><div align="center" class="Arial14Negro"><?=$row['nombre_muestra'];?></div></td>
    <td><div align="center" class="Arial14Negro"><?=$row['observaciones'];?></div></td>
    <td><div align="center" class="Arial14Negro"><a id="ver" href="ver_analisis.php?muestra=<?=$row['numero_muestra'];?>&contrato=<?=$row['id_contrato'];?>&id=<?=$_REQUEST['id'];?>">
     Ver</a>     
    </div></td>  
    <td><div align="center" class="Arial14Negro"><a id="ver" href="etiquetas_muestra.php?codigo=<?=$row['codigo'];?>&contrato=<?=$row['id_contrato'];?>&id=<?=$_REQUEST['id'];?>&numero=<?=$row['numero_muestra'];?>&id_muestra=<?=$row['id'];?>">
     <img src="img/print.png" width="30" height="30" /></a>     
    </div></td>  
    
    
    </tr>	
    
<?	
	}

?>
	</table>
    <br>
    <div align="center" class="Arial14Negro">Marcar todas como listas <input type="checkbox" contrato="<?=$contrato;?>" id="chk_todos"></div>
    </form>
    </div>



</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:5000px;"></div>
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
